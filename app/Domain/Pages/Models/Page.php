<?php

namespace App\Domain\Pages\Models;

use App\Domain\Core\Concerns\HasSeoMeta;
use App\Domain\Core\Enums\PublishStatus;
use App\Domain\Core\Models\DomainModel;
use App\Domain\PageBlocks\Models\PageBlock;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Page extends DomainModel implements HasMedia
{
    use HasSeoMeta;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'type',
        'excerpt',
        'content',
        'status',
        'published_at',
        'sort_order',
        'template',
        'settings',
    ];

    protected function casts(): array
    {
        return [
            'status' => PublishStatus::class,
            'published_at' => 'datetime',
            'settings' => 'array',
            'sort_order' => 'integer',
        ];
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(PageBlock::class)->orderBy('sort_order');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', PublishStatus::Published)->whereNotNull('published_at');
    }
}
