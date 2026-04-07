<?php

namespace App\Domain\Orders\Models;

use App\Domain\Core\Models\DomainModel;

class PromoCode extends DomainModel
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'starts_at',
        'ends_at',
        'usage_limit',
        'used_count',
        'is_active',
        'config',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'decimal:2',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'usage_limit' => 'integer',
            'used_count' => 'integer',
            'is_active' => 'boolean',
            'config' => 'array',
        ];
    }
}
