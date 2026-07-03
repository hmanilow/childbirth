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
    assert.match(header, /Сопровождение в родах/);
    assert.match(header, /Услуги после родов/);
    assert.match(header, /Отзывы/);
    assert.match(header, /'format' => 'online'/);
    assert.match(header, /'format' => 'offline'/);
});

test('about is a single specialist card and doulas include the verification block', async () => {
    const [about, doulas] = await Promise.all([
        read('resources/views/about.blade.php'),
        read('resources/views/doulas.blade.php'),
    ]);

    assert.match(about, /Наши специалисты/);
    assert.match(about, /Елена Тимофеева/);
    assert.match(about, /Основатель и руководитель школы материнства «Рожаем вместе»/);
    assert.match(about, /Анкета специалиста скоро будет дополнена/);

    assert.match(doulas, /Что важно уточнить перед сопровождением в родах/);
    assert.match(doulas, /Анализы и допуск/);
    assert.match(doulas, /Официальный договор/);
    assert.match(doulas, /Образование и сертификаты/);
});

test('course seeder publishes exactly one online and sixteen offline manual programs', async () => {
    const seeder = await read('database/seeders/CourseSeeder.php');
    const expectedTitles = [
        'Мягкое рождение',
        'Базовый полный курс',
        'Экспресс-полный курс',
        'Экспресс-курс',
        'Фитнес для беременных',
        'Фитнес + дыхание',
        'Только лекции',
        'Дыхание + лекции',
        'Один день «Всё о родах»',
        'Один день «Всё о детях»',
        'Партнёрские роды',
        'Гипнороды',
        'Йога для беременных',
        'Домашний курс',
        'Школа будущих родителей',
        'Совместные роды',
        'Программа «Лёгкое рождение»',
    ];

    for (const title of expectedTitles) {
        assert.match(seeder, new RegExp(`'title'\\s*=>\\s*'${title.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')}'`));
    }

    assert.equal((seeder.match(/'title'\s*=>/g) ?? []).length, 17);
    assert.equal((seeder.match(/Course::FORMAT_ONLINE/g) ?? []).length, 1);
    assert.equal((seeder.match(/Course::FORMAT_OFFLINE/g) ?? []).length, 16);
    assert.match(seeder, /'access_type'\s*=>\s*'manual'/);
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
