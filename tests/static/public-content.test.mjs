import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';
import test from 'node:test';

const read = (path) => readFile(new URL(`../../${path}`, import.meta.url), 'utf8');

test('public branding is neutral and navigation stays visible without a burger menu', async () => {
    const [header, layout, home, footer] = await Promise.all([
        read('resources/views/components/header.blade.php'),
        read('resources/views/layouts/app.blade.php'),
        read('resources/views/home.blade.php'),
        read('resources/views/components/footer.blade.php'),
    ]);
    const publicBranding = `${header}\n${layout}\n${home}\n${footer}`;

    assert.doesNotMatch(publicBranding, /Школа материнства Елены Тимофеевой/);
    assert.doesNotMatch(publicBranding, /Авторская школа материнства Елены Тимофеевой/);
    assert.match(header, /Работаем без выходных!/);
    assert.match(header, /Наши специалисты/);
    assert.match(header, /Центры/);
    assert.match(header, /Акции и новости/);
    assert.match(header, /Курсы и абонементы/);
    assert.match(header, /Наши Доулы/);
    assert.doesNotMatch(header, /Услуги после родов/);
    assert.match(header, /Отзывы/);
    assert.match(header, /'url' => route\('courses\.index'\), 'courses' => true/);
    assert.match(header, /'format' => 'online'/);
    assert.match(header, /'format' => 'offline'/);
    assert.match(header, /grid-cols-6/);
    assert.match(header, /sm:grid-cols-6/);
    assert.doesNotMatch(header, /mobile-navigation/);
    assert.doesNotMatch(header, /aria-label="Открыть меню"/);

    assert.match(home, /Готовим к родам\./);
    assert.match(home, /Сопровождаем в родах\./);
    assert.match(home, /Подготовка к партнёрским родам/);
    assert.match(home, /Уход за малышом и первый месяц/);
    assert.match(home, /Познакомиться с доулами/);
    assert.match(home, /учебных программ/);
    assert.match(home, /Доульские посиделки/);
    assert.doesNotMatch(home, /Дульские посиделки/);
    assert.doesNotMatch(home, /временных программ/);
});

test('centers page uses centralized location data and is exported for GitHub Pages', async () => {
    const [routes, centers, config, footer, contacts, sitemap, exporter] = await Promise.all([
        read('routes/web.php'),
        read('resources/views/centers.blade.php'),
        read('config/centers.php'),
        read('resources/views/components/footer.blade.php'),
        read('resources/views/contacts.blade.php'),
        read('app/Http/Controllers/SitemapController.php'),
        read('scripts/export-static-preview.mjs'),
    ]);

    assert.match(routes, /Route::get\('\/centers'/);
    assert.match(config, /2-я улица Бухвостова, дом 1/);
    assert.match(config, /Преображенская площадь/);
    assert.match(config, /yandex_embed_url/);
    assert.match(config, /yandex_map_url/);
    assert.match(centers, /Центр школы на Преображенской площади/);
    assert.match(centers, /Яндекс Карта/);
    assert.match(centers, /loading="lazy"/);
    assert.match(centers, /EducationalOrganization/);
    assert.match(centers, /PostalAddress/);
    assert.match(footer, /route\('centers'\)/);
    assert.match(contacts, /Карта и схема проезда/);
    assert.match(sitemap, /url\('\/centers'\)/);
    assert.match(exporter, /'\/centers'/);
});

test('about shows four complete specialist profiles and doulas keep their profiles', async () => {
    const [about, doulas] = await Promise.all([
        read('resources/views/about.blade.php'),
        read('resources/views/doulas.blade.php'),
    ]);

    assert.match(about, /Наши специалисты/);
    assert.match(about, /Елена Тимофеева/);
    assert.match(about, /Вячеслав Тимофеев/);
    assert.match(about, /Семейный психолог/);
    assert.match(about, /vyacheslav-specialist\.webp/);
    assert.match(about, /Подготовка к партнёрским родам/);
    assert.match(about, /Аделина/);
    assert.match(about, /adelina-doula\.jpg/);
    assert.match(about, /Екатерина/);
    assert.match(about, /ekaterina-specialist\.webp/);
    assert.match(about, /Член союза профессиональной поддержки материнства/);
    assert.match(about, /Член ассоциации профессиональных доул/);
    assert.match(about, /Детский психолог-консультант[\s\S]{0,200}Специалист по коррекции детского сна/);
    assert.doesNotMatch(about, /Анкета специалиста скоро будет дополнена/);
    assert.doesNotMatch(about, /Подробнее/);
    assert.doesNotMatch(about, /x-show=/);
    assert.match(about, /каждого десятого мужчины/i);
    assert.match(about, /отцовский инстинкт/i);

    assert.match(doulas, /Что важно уточнить перед сопровождением в родах/);
    assert.match(doulas, /Анализы и допуск/);
    assert.match(doulas, /Официальный договор/);
    assert.match(doulas, /Образование и сертификаты/);
    assert.match(doulas, /Пакет Аделины/);
    assert.match(doulas, /Екатерина/);
    assert.match(doulas, /ekaterina-specialist\.webp/);
    assert.match(doulas, /hidden min-h-14 md:flex/);
    assert.doesNotMatch(doulas, /id="adelina-package"/);
});

test('course seeder prepares five offline and eight online programs with three drafts', async () => {
    const seeder = await read('database/seeders/CourseSeeder.php');
    const publishedTitles = [
        'Для будущих и состоявшихся мам',
        'Онлайн-курс для будущих мам',
        'Онлайн-курс для состоявшихся мам',
        'Здоровая беременность',
        'Подготовка к родам',
        'Курс подготовки к родам «Базовый»',
        'Интенсив «Всё о родах» за 4 часа',
        'Интенсив «Всё о детях» за 4 часа',
        'Фитнес для беременных',
        'Фитнес для беременных + дыхание в родах',
    ];
    const draftTitles = ['Восстановление мамы', 'Здоровье новорождённого', 'Будни мамы с ребёнком'];

    for (const title of [...publishedTitles, ...draftTitles]) {
        assert.match(seeder, new RegExp(`'title'\\s*=>\\s*'${title.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')}'`));
    }
    for (const title of draftTitles) {
        const escaped = title.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        assert.match(seeder, new RegExp(`'title'\\s*=>\\s*'${escaped}'[\\s\\S]{0,1000}'is_published'\\s*=>\\s*false`));
    }

    assert.equal((seeder.match(/'title'\s*=>/g) ?? []).length, 13);
    assert.equal((seeder.match(/Course::FORMAT_ONLINE/g) ?? []).length, 8);
    assert.equal((seeder.match(/Course::FORMAT_OFFLINE/g) ?? []).length, 5);
    assert.match(seeder, /'access_type'\s*=>\s*'manual'/);
    assert.match(seeder, /'pricing_options'\s*=>/);
    assert.match(seeder, /'price'\s*=>\s*14900/);
    assert.match(seeder, /'old_price'\s*=>\s*18000/);
    assert.match(seeder, /'access_days'\s*=>\s*180/);
    assert.doesNotMatch(seeder, /позволит родить без боли и травм/i);
    assert.doesNotMatch(seeder, /лучшие роддома/i);
});

test('course pricing options are centralized in the model, migration and admin', async () => {
    const [model, migration, resource, card, coursePage] = await Promise.all([
        read('app/Domain/Courses/Models/Course.php'),
        read('database/migrations/2026_07_27_000001_add_pricing_options_to_courses_table.php'),
        read('app/Filament/Resources/CourseResource.php'),
        read('resources/views/components/course-card.blade.php'),
        read('resources/views/courses/show.blade.php'),
    ]);

    assert.match(model, /'pricing_options'\s*=>\s*'array'/);
    assert.match(model, /function priceLabel/);
    assert.match(migration, /json\('pricing_options'\)/);
    assert.match(resource, /Repeater::make\('pricing_options'\)/);
    assert.match(resource, /'manual'\s*=>\s*'Ручная запись'/);
    assert.match(card, /priceLabel/);
    assert.match(coursePage, /AggregateOffer/);
    assert.match(coursePage, /Полная программа курса/);
});

test('legal documents, form consents and cookie controls are published consistently', async () => {
    const [
        routes,
        controller,
        privacy,
        consent,
        offer,
        footer,
        cookie,
        layout,
        appJs,
        centers,
        contactForm,
        leadForm,
        register,
        checkout,
        registerController,
        checkoutController,
        sitemap,
        exporter,
    ] = await Promise.all([
        read('routes/web.php'),
        read('app/Http/Controllers/PageController.php'),
        read('resources/views/legal/content/privacy.blade.php'),
        read('resources/views/legal/content/personal-data-consent.blade.php'),
        read('resources/views/legal/content/offer.blade.php'),
        read('resources/views/components/footer.blade.php'),
        read('resources/views/components/cookie-consent.blade.php'),
        read('resources/views/layouts/app.blade.php'),
        read('resources/js/app.js'),
        read('resources/views/centers.blade.php'),
        read('resources/views/livewire/contact-form.blade.php'),
        read('resources/views/livewire/lead-form.blade.php'),
        read('resources/views/auth/register.blade.php'),
        read('resources/views/checkout/show.blade.php'),
        read('app/Http/Controllers/Auth/RegisterController.php'),
        read('app/Http/Controllers/CheckoutController.php'),
        read('app/Http/Controllers/SitemapController.php'),
        read('scripts/export-static-preview.mjs'),
    ]);

    assert.match(routes, /Route::get\('\/personal-data-consent'/);
    assert.match(routes, /Route::get\('\/offer'/);
    assert.match(routes, /Route::redirect\('\/terms', '\/offer', 301\)/);
    assert.doesNotMatch(controller, /where\('slug', 'privacy'/);
    assert.doesNotMatch(controller, /where\('slug', 'terms'/);

    assert.match(privacy, /https:\/\/рожаем-вместе\.рф\/privacy/);
    assert.match(privacy, /Контактный телефон: \+7 910 403 14 03/);
    assert.match(privacy, /id="cookies"/);
    assert.match(consent, /Настоящее согласие вступает в силу/);
    assert.match(consent, /адрес: ______/);
    assert.match(offer, /https:\/\/рожаем-вместе\.рф\/offer/);
    assert.match(offer, /ИНН: _______________/);
    assert.match(offer, /Банковские реквизиты: _______________/);

    for (const source of [contactForm, leadForm, register, checkout]) {
        assert.match(source, /Я даю согласие на обработку персональных данных/);
        assert.match(source, /personal-data-consent/);
    }
    assert.match(registerController, /'privacy_consent'\s*=>\s*\['required', 'accepted'\]/);
    assert.match(checkoutController, /'offer_accepted'\s*=>\s*\['required', 'accepted'\]/);
    assert.match(checkout, /Договора-оферты/);

    assert.match(layout, /<x-cookie-consent \/>/);
    assert.match(layout, /type="text\/plain" data-cookie-category="analytics"/);
    assert.match(cookie, /Отказаться \(кроме обязательных\)/);
    assert.match(cookie, /Принять все/);
    assert.match(cookie, /Настроить согласие/);
    assert.match(cookie, /data-cookie-category="functional"/);
    assert.match(appJs, /site_cookie_consent_v1/);
    assert.match(appJs, /cookieLifetime = 60 \* 60 \* 24 \* 365/);
    assert.match(centers, /data-cookie-src=/);
    assert.doesNotMatch(centers, /<iframe\s+src=/);

    assert.match(footer, /Политика обработки персональных данных/);
    assert.match(footer, /Согласие на обработку персональных данных/);
    assert.match(footer, /Договор-оферта/);
    assert.match(footer, /data-cookie-settings/);
    assert.match(sitemap, /url\('\/personal-data-consent'\)/);
    assert.match(sitemap, /url\('\/offer'\)/);
    assert.match(exporter, /'\/personal-data-consent'/);
    assert.match(exporter, /'\/offer'/);
    assert.match(exporter, /\['\/terms', '\/offer'\]/);
});

test('reviews route exists and stays outside the sitemap', async () => {
    const [routes, reviews, sitemap] = await Promise.all([
        read('routes/web.php'),
        read('resources/views/reviews.blade.php'),
        read('app/Http/Controllers/SitemapController.php'),
    ]);

    assert.match(routes, /Route::view\('\/reviews'/);
    assert.match(reviews, /robots[^\n]+noindex/);
    assert.match(reviews, /Отзывы появятся здесь/);
    assert.doesNotMatch(sitemap, /route\('reviews'/);
});
