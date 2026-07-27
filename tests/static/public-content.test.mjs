import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';
import test from 'node:test';

const read = (path) => readFile(new URL(`../../${path}`, import.meta.url), 'utf8');

test('public branding is neutral and the header has two navigation rows', async () => {
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
    assert.match(header, /Акции и новости/);
    assert.match(header, /Курсы и абонементы/);
    assert.match(header, /Наши Доулы/);
    assert.doesNotMatch(header, /Услуги после родов/);
    assert.match(header, /Отзывы/);
    assert.match(header, /href="\{\{ route\('courses\.index'\) \}\}"/);
    assert.match(header, /'format' => 'online'/);
    assert.match(header, /'format' => 'offline'/);
});

test('about contains two specialists and doulas include Ekaterina and the verification block', async () => {
    const [about, doulas] = await Promise.all([
        read('resources/views/about.blade.php'),
        read('resources/views/doulas.blade.php'),
    ]);

    assert.match(about, /Наши специалисты/);
    assert.match(about, /Елена Тимофеева/);
    assert.match(about, /Вячеслав/);
    assert.match(about, /Семейный психолог/);
    assert.match(about, /vyacheslav-specialist\.webp/);
    assert.match(about, /Профессиональные направления/);
    assert.match(about, /Подготовка к партнёрским родам/);
    assert.doesNotMatch(about, /Екатерина/);
    assert.doesNotMatch(about, /ekaterina-specialist\.webp/);
    assert.doesNotMatch(about, /Анкета специалиста скоро будет дополнена/);
    assert.doesNotMatch(about, /каждого десятого мужчины/i);
    assert.doesNotMatch(about, /отцовский инстинкт/i);

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
