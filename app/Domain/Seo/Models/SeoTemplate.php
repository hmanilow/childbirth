<?php

namespace App\Domain\Seo\Models;

use App\Domain\Core\Models\DomainModel;
use App\Domain\Seo\Enums\SeoEntityType;

class SeoTemplate extends DomainModel
{
    protected $fillable = [
        'entity_type',
        'name',
        'meta_title_template',
        'meta_description_template',
        'h1_template',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'entity_type' => SeoEntityType::class,
            'is_active' => 'boolean',
        ];
    }
}
