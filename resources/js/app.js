import './bootstrap';
import { Alpine, Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';
import collapse from '@alpinejs/collapse';

// Register Alpine plugins
Alpine.plugin(collapse);

window.Alpine = Alpine;
Livewire.start();

// ============================================================
// Brand preloader
// ============================================================
document.addEventListener('DOMContentLoaded', () => {
    const preloader = document.getElementById('site-preloader');
    if (!preloader) return;

    const root = document.documentElement;
    const shouldShow = root.classList.contains('site-preloader-enabled');

    if (!shouldShow) {
        preloader.remove();
        document.dispatchEvent(new CustomEvent('site-preloader-hidden'));
        return;
    }

    const startedAt = Date.now();
    const minDuration = 1200;
    const maxDuration = 3200;
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    let isHiding = false;

    const hidePreloader = () => {
        if (isHiding) return;
        isHiding = true;

        const remaining = Math.max(0, minDuration - (Date.now() - startedAt));

        window.setTimeout(() => {
            try {
                window.sessionStorage.setItem('sitePreloaderSeen', '1');
            } catch (error) {
                // Session storage can be unavailable in strict privacy modes.
            }

            preloader.setAttribute('aria-hidden', 'true');
            root.classList.add('site-preloader-hiding');

            window.setTimeout(() => {
                preloader.remove();
                root.classList.remove('site-preloader-enabled', 'site-preloader-hiding');
                document.dispatchEvent(new CustomEvent('site-preloader-hidden'));
            }, reduceMotion ? 90 : 680);
        }, remaining);
    };

    if (document.readyState === 'complete') {
        hidePreloader();
    } else {
        window.addEventListener('load', hidePreloader, { once: true });
        window.setTimeout(hidePreloader, maxDuration);
    }
});

// ============================================================
// Cookie consent
// ============================================================
document.addEventListener('DOMContentLoaded', () => {
    const root = document.querySelector('[data-cookie-consent-root]');
    if (!root) return;

    const banner = root.querySelector('[data-cookie-banner]');
    const preferences = root.querySelector('[data-cookie-preferences]');
    const dialog = preferences?.querySelector('[role="dialog"]');
    const cookieName = 'site_cookie_consent_v1';
    const cookieVersion = 1;
    const cookieLifetime = 60 * 60 * 24 * 365;
    const categories = ['functional', 'analytics', 'marketing'];
    let lastFocused = null;

    const readConsent = () => {
        const prefix = `${cookieName}=`;
        const raw = document.cookie
            .split('; ')
            .find((item) => item.startsWith(prefix))
            ?.slice(prefix.length);

        if (!raw) return null;

        try {
            const value = JSON.parse(decodeURIComponent(raw));
            return value?.version === cookieVersion ? value : null;
        } catch (error) {
            return null;
        }
    };

    const writeConsent = (value) => {
        const secure = window.location.protocol === 'https:' ? '; Secure' : '';
        document.cookie = `${cookieName}=${encodeURIComponent(JSON.stringify(value))}; Path=/; Max-Age=${cookieLifetime}; SameSite=Lax${secure}`;
    };

    const activateScripts = (consent) => {
        document.querySelectorAll('script[type="text/plain"][data-cookie-category]').forEach((source) => {
            const category = source.dataset.cookieCategory;
            if (!consent?.[category] || source.dataset.cookieActivated === '1') return;

            const script = document.createElement('script');
            if (source.dataset.cookieSrc) script.src = source.dataset.cookieSrc;
            if (source.hasAttribute('data-cookie-async')) script.async = true;
            if (!source.dataset.cookieSrc) script.textContent = source.textContent;
            source.dataset.cookieActivated = '1';
            source.after(script);
        });
    };

    const syncEmbeds = (consent) => {
        document.querySelectorAll('[data-cookie-embed]').forEach((embed) => {
            const category = embed.dataset.cookieCategory;
            const allowed = Boolean(consent?.[category]);
            const content = embed.querySelector('[data-cookie-content]');
            const placeholder = embed.querySelector('[data-cookie-placeholder]');

            if (!content) return;

            if (allowed) {
                if (!content.getAttribute('src') && content.dataset.cookieSrc) {
                    content.setAttribute('src', content.dataset.cookieSrc);
                }
                content.hidden = false;
                if (placeholder) placeholder.hidden = true;
            } else {
                content.removeAttribute('src');
                content.hidden = true;
                if (placeholder) placeholder.hidden = false;
            }
        });
    };

    const applyConsent = (consent) => {
        syncEmbeds(consent);
        activateScripts(consent);
        document.dispatchEvent(new CustomEvent('cookie-consent-changed', { detail: consent }));
    };

    const setPreferenceInputs = (consent) => {
        categories.forEach((category) => {
            const input = preferences?.querySelector(`[data-cookie-category="${category}"]`);
            if (input) input.checked = Boolean(consent?.[category]);
        });
    };

    const showBanner = () => {
        root.hidden = false;
        banner.hidden = false;
    };

    const hideBanner = () => {
        banner.hidden = true;
        if (preferences.hidden) root.hidden = true;
    };

    const openSettings = (trigger = null) => {
        lastFocused = trigger || document.activeElement;
        setPreferenceInputs(readConsent());
        root.hidden = false;
        preferences.hidden = false;
        document.body.classList.add('cookie-preferences-open');
        window.requestAnimationFrame(() => dialog?.focus());
    };

    const closeSettings = () => {
        preferences.hidden = true;
        document.body.classList.remove('cookie-preferences-open');
        if (readConsent()) {
            root.hidden = true;
        } else {
            showBanner();
        }
        lastFocused?.focus?.();
    };

    const saveConsent = (next) => {
        const previous = readConsent();
        const consent = {
            version: cookieVersion,
            necessary: true,
            functional: Boolean(next.functional),
            analytics: Boolean(next.analytics),
            marketing: Boolean(next.marketing),
            updatedAt: new Date().toISOString(),
        };
        const revokedActiveScript = previous && categories.some((category) => previous[category] && !consent[category] && category !== 'functional');

        writeConsent(consent);
        applyConsent(consent);
        preferences.hidden = true;
        document.body.classList.remove('cookie-preferences-open');
        hideBanner();

        if (revokedActiveScript) window.location.reload();
    };

    document.addEventListener('click', (event) => {
        const settingsTrigger = event.target.closest('[data-cookie-settings]');
        if (settingsTrigger) {
            event.preventDefault();
            openSettings(settingsTrigger);
            return;
        }

        const action = event.target.closest('[data-cookie-action]')?.dataset.cookieAction;
        if (!action) return;

        if (action === 'reject') {
            saveConsent({ functional: false, analytics: false, marketing: false });
        } else if (action === 'accept-all') {
            saveConsent({ functional: true, analytics: true, marketing: true });
        } else if (action === 'settings') {
            openSettings(event.target);
        } else if (action === 'close-settings') {
            closeSettings();
        } else if (action === 'save-settings') {
            const selected = Object.fromEntries(categories.map((category) => {
                const input = preferences.querySelector(`[data-cookie-category="${category}"]`);
                return [category, Boolean(input?.checked)];
            }));
            saveConsent(selected);
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !preferences.hidden) closeSettings();
    });

    const consent = readConsent();
    if (consent) {
        applyConsent(consent);
        return;
    }

    syncEmbeds(null);
    const revealAfterPreloader = () => window.setTimeout(showBanner, 120);
    if (document.documentElement.classList.contains('site-preloader-enabled')) {
        document.addEventListener('site-preloader-hidden', revealAfterPreloader, { once: true });
        window.setTimeout(showBanner, 3600);
    } else {
        revealAfterPreloader();
    }
});

// ============================================================
// Animate on scroll
// ============================================================
document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('in-view');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));
});

// ============================================================
// Sticky booking bar (appears after scrolling past hero)
// ============================================================
document.addEventListener('DOMContentLoaded', () => {
    const bar = document.getElementById('sticky-booking-bar');
    if (!bar) return;

    const hero = document.querySelector('[data-hero]');
    if (!hero) return;

    const io = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            bar.classList.toggle('visible', !entry.isIntersecting);
        });
    }, { threshold: 0.1 });

    io.observe(hero);
});

// ============================================================
// UTM capture — store UTM params in sessionStorage for forms
// ============================================================
(function() {
    const params = new URLSearchParams(window.location.search);
    const utmKeys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term'];
    utmKeys.forEach(key => {
        if (params.has(key)) {
            sessionStorage.setItem(key, params.get(key));
        }
    });
})();

// ============================================================
// Phone mask (simple, no dependency)
// ============================================================
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[data-phone]').forEach(input => {
        input.addEventListener('input', (e) => {
            let val = e.target.value.replace(/\D/g, '');
            if (val.startsWith('8')) val = '7' + val.slice(1);
            if (val.startsWith('7')) {
                val = '+7 (' + val.slice(1, 4) + ') ' + val.slice(4, 7) + '-' + val.slice(7, 9) + '-' + val.slice(9, 11);
            }
            e.target.value = val;
        });
    });
});
