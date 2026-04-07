<?php

namespace Database\Seeders;

use App\Domain\Core\Enums\PublishStatus;
use App\Domain\Pages\Models\Page;
use App\Domain\Seo\Models\City;
use App\Domain\Seo\Models\CityLandingPage;
use Illuminate\Database\Seeder;

class StarterContentSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            ['title' => 'Главная', 'slug' => 'home', 'type' => 'static'],
            ['title' => 'Обо мне', 'slug' => 'about', 'type' => 'static'],
            ['title' => 'Доула / сопровождение в родах', 'slug' => 'doula', 'type' => 'service'],
            ['title' => 'Подготовка к родам', 'slug' => 'preparation', 'type' => 'service'],
            ['title' => 'Подготовка к партнёрским родам', 'slug' => 'partner-birth', 'type' => 'service'],
            ['title' => 'Школа материнства', 'slug' => 'mother-school', 'type' => 'static'],
            ['title' => 'Услуги', 'slug' => 'services', 'type' => 'static'],
            ['title' => 'Цены', 'slug' => 'prices', 'type' => 'static'],
            ['title' => 'Партнёры', 'slug' => 'partners', 'type' => 'static'],
            ['title' => 'FAQ', 'slug' => 'faq', 'type' => 'static'],
            ['title' => 'Контакты', 'slug' => 'contacts', 'type' => 'static'],
            ['title' => 'Политика конфиденциальности', 'slug' => 'privacy-policy', 'type' => 'legal'],
            ['title' => 'Согласие на обработку персональных данных', 'slug' => 'personal-data-consent', 'type' => 'legal'],
            ['title' => 'Пользовательское соглашение', 'slug' => 'terms', 'type' => 'legal'],
        ];

        foreach ($pages as $index => $page) {
            Page::updateOrCreate(['slug' => $page['slug']], [
                ...$page,
                'status' => PublishStatus::Draft,
                'sort_order' => $index,
                'settings' => [],
            ]);
        }

        $balashikha = City::updateOrCreate(['slug' => 'balashikha'], [
            'name' => 'Балашиха',
            'region' => 'Московская область',
            'is_active' => true,
            'sort_order' => 10,
        ]);

        $moscow = City::updateOrCreate(['slug' => 'moscow'], [
            'name' => 'Москва',
            'region' => 'Москва',
            'is_active' => true,
            'sort_order' => 20,
        ]);

        $landings = [
            [$balashikha, 'doula', 'doula-balashikha', 'Доула Балашиха'],
            [$moscow, 'doula', 'doula-moscow', 'Доула Москва'],
            [$balashikha, 'birth_support', 'pomoshch-v-rodah-balashikha', 'Помощь в родах Балашиха'],
            [$balashikha, 'birth_preparation', 'podgotovka-k-rodam-balashikha', 'Подготовка к родам Балашиха'],
            [$balashikha, 'mother_school', 'shkola-materinstva-balashikha', 'Школа материнства Балашиха'],
        ];

        foreach ($landings as [$city, $intent, $slug, $title]) {
            CityLandingPage::updateOrCreate(['city_id' => $city->id, 'intent' => $intent], [
                'slug' => $slug,
                'title' => $title,
                'status' => PublishStatus::Draft,
            ]);
        }
    }
}
