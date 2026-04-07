<?php

namespace App\Domain\Services\Models;

use App\Domain\Core\Concerns\HasSeoMeta;
use App\Domain\Core\Enums\PublishStatus;
use App\Domain\Core\Models\DomainModel;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends DomainModel implements HasMedia
{
    use HasSeoMeta;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'full_description',
        'price_from',
        'status',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price_from' => 'decimal:2',
            'status' => PublishStatus::class,
            'sort_order' => 'integer',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', PublishStatus::Published);
    }
}
