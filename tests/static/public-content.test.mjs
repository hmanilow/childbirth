import assert from 'node:assert/strict';
import { readFile } from 'node:fs/promises';
import test from 'node:test';

const view = (name) => readFile(new URL(`../../resources/views/${name}`, import.meta.url), 'utf8');

test('home places welcome before courses and school features after courses', async () => {
    const contents = await view('home.blade.php');
    const welcome = contents.indexOf('Добро пожаловать в школу материнства');
    const courses = contents.indexOf('id="courses"');
    const features = contents.indexOf('Больше, чем курсы');

    assert.notEqual(welcome, -1);
    assert.notEqual(courses, -1);
    assert.notEqual(features, -1);
    assert.ok(welcome < courses);
    assert.ok(courses < features);
    assert.match(contents, /Дульские посиделки/);
    assert.match(contents, /Лекции экспертов/);
});

test('about contains the structured professional biography', async () => {
    const contents = await view('about.blade.php');

    for (const expected of [
        'основатель школы материнства «Рожаем вместе»',
        'Как я помогаю',
        'Подготовка к родам',
        'Сопровождение в родах',
        'Золотой час после рождения малыша',
        'Поддержка после родов',
        'Моя профессиональная база',
        'Почему я рядом',
        'Я не заменяю врача и не принимаю медицинских решений.',
    ]) {
        assert.match(contents, new RegExp(expected.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')));
    }
});
