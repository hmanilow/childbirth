<?php

namespace App\Domain\News\Models;

use App\Domain\Core\Concerns\HasSeoMeta;
use App\Domain\Core\Enums\PublishStatus;
use App\Domain\Core\Models\DomainModel;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class NewsPost extends DomainModel implements HasMedia
{
    use HasSeoMeta;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'status',
        'published_at',
        'related_services',
        'related_courses',
    ];

    protected function casts(): array
    {
        return [
            'status' => PublishStatus::class,
            'published_at' => 'datetime',
            'related_services' => 'array',
            'related_courses' => 'array',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', PublishStatus::Published)->where('published_at', '<=', now());
    }
}
