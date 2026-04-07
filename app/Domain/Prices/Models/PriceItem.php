<?php

namespace App\Domain\Prices\Models;

use App\Domain\Core\Enums\PublishStatus;
use App\Domain\Core\Models\DomainModel;

class PriceItem extends DomainModel
{
    protected $fillable = [
        'title',
        'description',
        'amount',
        'currency',
        'status',
        'sort_order',
        'config',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'status' => PublishStatus::class,
            'sort_order' => 'integer',
            'config' => 'array',
        ];
    }
}
