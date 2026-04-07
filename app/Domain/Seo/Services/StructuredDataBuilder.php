<?php

namespace App\Domain\Seo\Services;

use App\Domain\Courses\Models\Course;
use App\Domain\Settings\Models\SiteSetting;
use Illuminate\Support\Collection;

class StructuredDataBuilder
{
    public function organization(): array
    {
        $settings = SiteSetting::query()->where('key', 'project')->value('value') ?? [];

        return array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $settings['name'] ?? config('app.name'),
            'url' => config('app.url'),
            'email' => $settings['email'] ?? null,
            'telephone' => $settings['phones'][0] ?? null,
            'sameAs' => $settings['social_links'] ?? [],
        ]);
    }

    public function localBusiness(): array
    {
        $settings = SiteSetting::query()->where('key', 'project')->value('value') ?? [];

        return array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => $settings['name'] ?? config('app.name'),
            'url' => config('app.url'),
            'telephone' => $settings['phones'][0] ?? null,
            'email' => $settings['email'] ?? null,
            'address' => $settings['address'] ?? null,
        ]);
    }

    public function course(Course $course): array
    {
        return array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'Course',
            'name' => $course->title,
            'description' => $course->short_description,
            'provider' => $this->organization(),
            'offers' => [
                '@type' => 'Offer',
                'price' => $course->price,
                'priceCurrency' => 'RUB',
                'availability' => $course->is_active ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
            ],
        ]);
    }

    public function breadcrumbs(Collection $items): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items->values()->map(fn (array $item, int $index) => [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['name'],
                'item' => $item['url'],
            ])->all(),
        ];
    }
}
