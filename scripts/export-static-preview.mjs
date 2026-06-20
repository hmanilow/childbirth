import fs from 'node:fs/promises';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const scriptDir = path.dirname(fileURLToPath(import.meta.url));
const projectRoot = path.resolve(scriptDir, '..');
const publicDir = path.join(projectRoot, 'public');
const docsDir = path.join(projectRoot, 'docs');

const baseUrl = (process.env.STATIC_PREVIEW_BASE ?? 'http://127.0.0.1:8000').replace(/\/+$/, '');
const base = new URL(baseUrl);

const seedPaths = [
    '/',
    '/about',
    '/doulas',
    '/courses',
    '/contacts',
    '/privacy',
    '/terms',
];

const excludedPrefixes = [
    '/admin',
    '/api',
    '/account',
    '/checkout',
    '/doula',
    '/birth-prep',
    '/partner-birth',
    '/school',
    '/services',
    '/news',
    '/partners',
    '/prices',
    '/faq',
    '/forgot-password',
    '/login',
    '/logout',
    '/register',
    '/reset-password',
    '/webhooks',
    '/livewire',
    '/sitemap.xml',
    '/robots.txt',
];

const assetPrefixes = [
    '/build/',
    '/images/',
    '/css/',
    '/js/',
    '/favicon',
    '/storage/',
];

const assetExtension = /\.(avif|css|eot|gif|ico|jpe?g|js|json|map|mjs|pdf|png|svg|ttf|webp|woff2?)$/i;
const maxPages = Number.parseInt(process.env.STATIC_PREVIEW_MAX_PAGES ?? '80', 10);

function toPosix(value) {
    return value.split(path.sep).join('/');
}

function normalizeRoutePath(pathname) {
    let clean = pathname || '/';
    if (!clean.startsWith('/')) {
        clean = `/${clean}`;
    }
    clean = clean.replace(/\/+/g, '/');
    if (clean.length > 1) {
        clean = clean.replace(/\/$/, '');
    }
    return clean;
}

function isAssetPath(pathname) {
    return assetPrefixes.some((prefix) => pathname.startsWith(prefix)) || assetExtension.test(pathname);
}

function isExportablePage(pathname) {
    const clean = normalizeRoutePath(pathname);

    if (isAssetPath(clean)) {
        return false;
    }

    return !excludedPrefixes.some((prefix) => clean === prefix || clean.startsWith(`${prefix}/`));
}

function outputPathFor(routePath) {
    const clean = normalizeRoutePath(routePath);
    if (clean === '/') {
        return 'index.html';
    }

    return `${clean.replace(/^\/+/, '')}/index.html`;
}

function routeDirFor(routePath) {
    const clean = normalizeRoutePath(routePath);
    if (clean === '/') {
        return '';
    }

    return `${clean.replace(/^\/+/, '')}/`;
}

function relativeFrom(outputPath, target, hash = '') {
    const fromDir = path.posix.dirname(outputPath);
    const normalizedFrom = fromDir === '.' ? '' : fromDir;
    let relative = path.posix.relative(normalizedFrom, target);

    if (!relative) {
        relative = './';
    } else if (!relative.startsWith('.')) {
        relative = `./${relative}`;
    }

    if (target.endsWith('/') && !relative.endsWith('/')) {
        relative = `${relative}/`;
    }

    return `${relative}${hash}`;
}

function parseLocalUrl(rawValue, currentRoutePath) {
    if (!rawValue || rawValue.startsWith('#')) {
        return null;
    }

    if (/^(mailto|tel|sms|javascript):/i.test(rawValue)) {
        return null;
    }

    try {
        const url = new URL(rawValue, new URL(currentRoutePath, `${baseUrl}/`));
        if (url.origin !== base.origin) {
            return null;
        }

        return url;
    } catch {
        return null;
    }
}

function extractPageLinks(html, currentRoutePath) {
    const links = new Set();
    const attrPattern = /\bhref=(["'])(.*?)\1/gi;
    let match;

    while ((match = attrPattern.exec(html)) !== null) {
        const localUrl = parseLocalUrl(match[2], currentRoutePath);
        if (!localUrl) {
            continue;
        }

        const nextPath = normalizeRoutePath(localUrl.pathname);
        if (isExportablePage(nextPath)) {
            links.add(nextPath);
        }
    }

    return links;
}

function rewriteHtml(html, routePath, availablePages) {
    const outputPath = outputPathFor(routePath);

    const rewritten = html.replace(/\b(href|src|action|content)=(["'])(.*?)\2/gi, (full, attr, quote, rawValue) => {
        const attrName = attr.toLowerCase();

        if (attrName === 'action') {
            return `${attr}=${quote}#${quote}`;
        }

        if (attrName === 'content' && !/^(https?:\/\/|\/|\.{1,2}\/)/i.test(rawValue)) {
            return full;
        }

        const localUrl = parseLocalUrl(rawValue, routePath);
        if (!localUrl) {
            return full;
        }

        const pathname = normalizeRoutePath(localUrl.pathname);
        const hash = localUrl.hash || '';

        if (isAssetPath(pathname)) {
            const assetTarget = pathname.replace(/^\/+/, '');
            return `${attr}=${quote}${relativeFrom(outputPath, assetTarget, hash)}${quote}`;
        }

        if (availablePages.has(pathname)) {
            return `${attr}=${quote}${relativeFrom(outputPath, routeDirFor(pathname), hash)}${quote}`;
        }

        return `${attr}=${quote}#${quote}`;
    });

    return rewritten.replaceAll(baseUrl, '');
}

async function exists(targetPath) {
    try {
        await fs.access(targetPath);
        return true;
    } catch {
        return false;
    }
}

async function copyIfExists(from, to) {
    if (!(await exists(from))) {
        return;
    }

    await fs.mkdir(path.dirname(to), { recursive: true });
    await fs.cp(from, to, { recursive: true });
}

async function fetchPage(routePath) {
    const response = await fetch(new URL(routePath, `${baseUrl}/`), {
        redirect: 'follow',
        headers: {
            Accept: 'text/html',
        },
    });

    const contentType = response.headers.get('content-type') ?? '';

    if (!response.ok || !contentType.includes('text/html')) {
        return null;
    }

    return response.text();
}

async function exportPreview() {
    const pages = new Map();
    const queued = new Set(seedPaths.map(normalizeRoutePath).filter(isExportablePage));
    const queue = [...queued];

    while (queue.length > 0 && pages.size < maxPages) {
        const routePath = queue.shift();
        if (!routePath || pages.has(routePath)) {
            continue;
        }

        try {
            const html = await fetchPage(routePath);
            if (!html) {
                continue;
            }

            pages.set(routePath, html);

            for (const nextPath of extractPageLinks(html, routePath)) {
                if (!queued.has(nextPath) && pages.size + queue.length < maxPages) {
                    queued.add(nextPath);
                    queue.push(nextPath);
                }
            }
        } catch (error) {
            console.warn(`Skipped ${routePath}: ${error.message}`);
        }
    }

    if (pages.size === 0) {
        throw new Error(`No pages were exported from ${baseUrl}`);
    }

    const resolvedDocs = path.resolve(docsDir);
    if (!resolvedDocs.startsWith(projectRoot) || path.basename(resolvedDocs) !== 'docs') {
        throw new Error(`Unsafe docs output path: ${resolvedDocs}`);
    }

    await fs.rm(docsDir, { recursive: true, force: true });
    await fs.mkdir(docsDir, { recursive: true });

    await copyIfExists(path.join(publicDir, 'build'), path.join(docsDir, 'build'));
    await copyIfExists(path.join(publicDir, 'images'), path.join(docsDir, 'images'));
    await copyIfExists(path.join(publicDir, 'favicon.ico'), path.join(docsDir, 'favicon.ico'));

    const availablePages = new Set(pages.keys());

    for (const [routePath, html] of pages) {
        const outputRelativePath = outputPathFor(routePath);
        const outputFile = path.join(docsDir, outputRelativePath);
        await fs.mkdir(path.dirname(outputFile), { recursive: true });
        await fs.writeFile(outputFile, rewriteHtml(html, routePath, availablePages), 'utf8');
    }

    await fs.writeFile(path.join(docsDir, '.nojekyll'), '', 'utf8');
    await fs.writeFile(
        path.join(docsDir, 'preview-pages.json'),
        `${JSON.stringify([...availablePages].sort(), null, 2)}\n`,
        'utf8',
    );

    console.log(`Exported ${pages.size} static pages to ${toPosix(path.relative(projectRoot, docsDir))}/`);
}

exportPreview().catch((error) => {
    console.error(error);
    process.exitCode = 1;
});
