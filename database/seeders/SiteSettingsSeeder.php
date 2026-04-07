<?php

namespace Database\Seeders;

use App\Domain\Settings\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::updateOrCreate(['key' => 'project'], [
            'group' => 'general',
            'type' => 'array',
            'is_public' => true,
            'value' => [
                'name' => 'Школа материнства',
                'phones' => [],
                'email' => null,
                'messengers' => [],
                'address' => null,
                'cities' => ['Балашиха', 'Москва'],
                'social_links' => [],
            ],
        ]);

        SiteSetting::updateOrCreate(['key' => 'seo_defaults'], [
            'group' => 'seo',
            'type' => 'array',
            'is_public' => true,
            'value' => [
                'meta_title' => 'Школа материнства и подготовка к родам',
                'meta_description' => 'Подготовка к родам, сопровождение доулы, консультации и онлайн-курсы.',
                'robots_meta' => 'index,follow',
            ],
        ]);

        SiteSetting::updateOrCreate(['key' => 'analytics'], [
            'group' => 'analytics',
            'type' => 'array',
            'is_public' => false,
            'value' => [
                'yandex_metrika_id' => null,
                'ga4_measurement_id' => null,
            ],
        ]);
    }
}
