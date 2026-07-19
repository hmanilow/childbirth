<?php

namespace Database\Seeders;

use App\Domain\Courses\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'title' => 'Мягкое рождение',
                'slug' => 'myagkoe-rozhdenie',
                'format' => Course::FORMAT_ONLINE,
                'category' => 'Подготовка к родам',
                'short_desc' => 'Короткий онлайн-курс для будущих мам: понятная подготовка к этапам родов, меньше тревоги и больше уверенности в собственных действиях.',
                'cover' => '/images/site/courses/course-online.jpg',
                'badge' => 'Онлайн-курс',
                'is_featured' => true,
                'sort_order' => 10,
            ],
            [
                'title' => 'Базовый полный курс',
                'slug' => 'bazovyy-polnyy-kurs',
                'format' => Course::FORMAT_OFFLINE,
                'category' => 'Подготовка к родам',
                'short_desc' => 'Последовательная программа подготовки к родам и первым дням с малышом для тех, кто хочет подробно разобраться во всех этапах.',
                'cover' => '/images/site/courses/course-birth-preparation.jpg',
                'badge' => 'Полная программа',
                'is_featured' => true,
                'sort_order' => 20,
            ],
            [
                'title' => 'Экспресс-полный курс',
                'slug' => 'ekspress-polnyy-kurs',
                'format' => Course::FORMAT_OFFLINE,
                'category' => 'Подготовка к родам',
                'short_desc' => 'Сжатая полная подготовка: ключевые этапы родов, практические приёмы и основы ухода за новорождённым.',
                'cover' => '/images/site/courses/course-birth-preparation.jpg',
                'badge' => 'Интенсив',
                'is_featured' => false,
                'sort_order' => 30,
            ],
            [
                'title' => 'Экспресс-курс',
                'slug' => 'ekspress-kurs',
                'format' => Course::FORMAT_OFFLINE,
                'category' => 'Подготовка к родам',
                'short_desc' => 'Короткий интенсив об этапах родов, дыхании, сборах в роддом и вопросах, которые важно обсудить заранее.',
                'cover' => '/images/site/courses/course-birth-preparation.jpg',
                'badge' => 'Короткий формат',
                'is_featured' => false,
                'sort_order' => 40,
            ],
            [
                'title' => 'Фитнес для беременных',
                'slug' => 'fitnes-dlya-beremennyh',
                'format' => Course::FORMAT_OFFLINE,
                'category' => 'Движение и дыхание',
                'short_desc' => 'Мягкие занятия для поддержки подвижности и хорошего самочувствия во время беременности с учётом состояния будущей мамы.',
                'cover' => '/images/site/courses/course-movement.jpg',
                'badge' => 'Практика',
                'is_featured' => false,
                'sort_order' => 50,
            ],
            [
                'title' => 'Фитнес + дыхание',
                'slug' => 'fitnes-i-dyhanie',
                'format' => Course::FORMAT_OFFLINE,
                'category' => 'Движение и дыхание',
                'short_desc' => 'Сочетание бережного движения, дыхательных упражнений и расслабления для комфортной подготовки тела.',
                'cover' => '/images/site/courses/course-movement.jpg',
                'badge' => 'Практика',
                'is_featured' => false,
                'sort_order' => 60,
            ],
            [
                'title' => 'Только лекции',
                'slug' => 'tolko-lektsii',
                'format' => Course::FORMAT_OFFLINE,
                'category' => 'Лекции',
                'short_desc' => 'Теоретическая подготовка к родам и первым дням материнства без блока физических упражнений.',
                'cover' => '/images/site/courses/course-lectures.jpg',
                'badge' => 'Теория',
                'is_featured' => false,
                'sort_order' => 70,
            ],
            [
                'title' => 'Дыхание + лекции',
                'slug' => 'dyhanie-i-lektsii',
                'format' => Course::FORMAT_OFFLINE,
                'category' => 'Лекции',
                'short_desc' => 'Понятная теория о родах вместе с практикой дыхания и расслабления, которую можно повторять самостоятельно.',
                'cover' => '/images/site/courses/course-lectures.jpg',
                'badge' => 'Теория и практика',
                'is_featured' => false,
                'sort_order' => 80,
            ],
            [
                'title' => 'Один день «Всё о родах»',
                'slug' => 'odin-den-vse-o-rodah',
                'format' => Course::FORMAT_OFFLINE,
                'category' => 'Однодневные программы',
                'short_desc' => 'Однодневный разбор этапов родов, удобных положений, дыхания и подготовки к поездке в роддом.',
                'cover' => '/images/site/courses/course-birth-preparation.jpg',
                'badge' => '1 день',
                'is_featured' => false,
                'sort_order' => 90,
            ],
            [
                'title' => 'Один день «Всё о детях»',
                'slug' => 'odin-den-vse-o-detyah',
                'format' => Course::FORMAT_OFFLINE,
                'category' => 'Однодневные программы',
                'short_desc' => 'Практичная встреча об уходе за новорождённым, кормлении, сне, гигиене и первых днях семьи дома.',
                'cover' => '/images/site/courses/course-lectures.jpg',
                'badge' => '1 день',
                'is_featured' => false,
                'sort_order' => 100,
            ],
            [
                'title' => 'Партнёрские роды',
                'slug' => 'partnerskie-rody',
                'format' => Course::FORMAT_OFFLINE,
                'category' => 'Для пары',
                'short_desc' => 'Курс для пары о роли партнёра, бережной поддержке женщины и совместных действиях на разных этапах родов.',
                'cover' => '/images/site/courses/course-partners.jpg',
                'badge' => 'Для пары',
                'is_featured' => true,
                'sort_order' => 110,
            ],
            [
                'title' => 'Гипнороды',
                'slug' => 'gipnorody',
                'format' => Course::FORMAT_OFFLINE,
                'category' => 'Спокойные практики',
                'short_desc' => 'Практики расслабления, дыхания и концентрации, которые помогают подойти к родам спокойнее и собраннее.',
                'cover' => '/images/site/courses/course-calm-practices.jpg',
                'badge' => 'Расслабление',
                'is_featured' => false,
                'sort_order' => 120,
            ],
            [
                'title' => 'Йога для беременных',
                'slug' => 'yoga-dlya-beremennyh',
                'format' => Course::FORMAT_OFFLINE,
                'category' => 'Движение и дыхание',
                'short_desc' => 'Бережные движения, внимание к дыханию и расслабление в спокойном темпе во время беременности.',
                'cover' => '/images/site/courses/course-movement.jpg',
                'badge' => 'Практика',
                'is_featured' => false,
                'sort_order' => 130,
            ],
            [
                'title' => 'Домашний курс',
                'slug' => 'domashniy-kurs',
                'format' => Course::FORMAT_OFFLINE,
                'category' => 'Подготовка к родам',
                'short_desc' => 'Компактный формат подготовки в небольшой и спокойной обстановке с вниманием к вопросам участников.',
                'cover' => '/images/site/courses/course-calm-practices.jpg',
                'badge' => 'Камерный формат',
                'is_featured' => false,
                'sort_order' => 140,
            ],
            [
                'title' => 'Школа будущих родителей',
                'slug' => 'shkola-budushchih-roditeley',
                'format' => Course::FORMAT_OFFLINE,
                'category' => 'Для пары',
                'short_desc' => 'Комплексная программа о беременности, родах, первых неделях с малышом и новой роли каждого родителя.',
                'cover' => '/images/site/courses/course-partners.jpg',
                'badge' => 'Для семьи',
                'is_featured' => true,
                'sort_order' => 150,
            ],
            [
                'title' => 'Совместные роды',
                'slug' => 'sovmestnye-rody',
                'format' => Course::FORMAT_OFFLINE,
                'category' => 'Для пары',
                'short_desc' => 'Практическая подготовка женщины и выбранного сопровождающего к взаимодействию, поддержке и общей уверенности.',
                'cover' => '/images/site/courses/course-partners.jpg',
                'badge' => 'Для пары',
                'is_featured' => false,
                'sort_order' => 160,
            ],
            [
                'title' => 'Программа «Лёгкое рождение»',
                'slug' => 'programma-legkoe-rozhdenie',
                'format' => Course::FORMAT_OFFLINE,
                'category' => 'Подготовка к родам',
                'short_desc' => 'Комплексная подготовка с теорией, дыханием и практическими инструментами для спокойного и уверенного настроя.',
                'cover' => '/images/site/courses/course-calm-practices.jpg',
                'badge' => 'Комплексная программа',
                'is_featured' => true,
                'sort_order' => 170,
            ],
        ];

        $slugs = array_column($courses, 'slug');

        Course::query()
            ->whereNotIn('slug', $slugs)
            ->update([
                'is_published' => false,
                'is_featured' => false,
            ]);

        foreach ($courses as $course) {
            $description = '<p>' . e($course['short_desc']) . '</p><p>Подробности программы, стоимость и ближайшее расписание можно уточнить у команды школы.</p>';

            Course::updateOrCreate(
                ['slug' => $course['slug']],
                $course + [
                    'description' => $description,
                    'price' => 0,
                    'old_price' => null,
                    'currency' => 'RUB',
                    'access_type' => 'manual',
                    'access_days' => null,
                    'level' => 'beginner',
                    'duration_hours' => null,
                    'lessons_count' => null,
                    'what_you_learn' => [
                        'Понятная структура подготовки без лишней информации',
                        'Практические ориентиры для будущих родителей',
                        'Возможность заранее обсудить вопросы с командой школы',
                    ],
                    'requirements' => ['Специальная подготовка не требуется'],
                    'includes' => ['Материалы по теме программы', 'Практические рекомендации', 'Связь с командой школы перед записью'],
                    'is_active' => true,
                    'is_published' => true,
                    'status' => 'published',
                    'published_at' => now(),
                    'meta_title' => $course['title'] . ' — Школа материнства «Рожаем вместе»',
                    'meta_description' => $course['short_desc'],
                ],
            );
        }
    }
}
