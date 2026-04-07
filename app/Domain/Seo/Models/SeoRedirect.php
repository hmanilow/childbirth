<?php

namespace App\Domain\Seo\Models;

use App\Domain\Core\Models\DomainModel;
use App\Domain\Seo\Enums\RedirectStatusCode;

class SeoRedirect extends DomainModel
{
    protected $fillable = [
        'source_path',
        'target_url',
        'status_code',
        'is_active',
        'hits',
        'last_hit_at',
    ];

    protected function casts(): array
    {
        return [
            'status_code' => RedirectStatusCode::class,
            'is_active' => 'boolean',
            'hits' => 'integer',
            'last_hit_at' => 'datetime',
        ];
    }
}
