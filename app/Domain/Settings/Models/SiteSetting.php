<?php

namespace App\Domain\Settings\Models;

use App\Domain\Core\Models\DomainModel;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class SiteSetting extends DomainModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'key',
        'group',
        'value',
        'type',
        'is_public',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'array',
            'is_public' => 'boolean',
        ];
    }
}
