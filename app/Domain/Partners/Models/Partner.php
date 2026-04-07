<?php

namespace App\Domain\Partners\Models;

use App\Domain\Core\Enums\PublishStatus;
use App\Domain\Core\Models\DomainModel;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Partner extends DomainModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'specialization',
        'url',
        'contacts',
        'status',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'contacts' => 'array',
            'status' => PublishStatus::class,
            'sort_order' => 'integer',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', PublishStatus::Published);
    }
}
