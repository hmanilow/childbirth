<?php

namespace App\Domain\Courses\Models;

use App\Domain\Core\Concerns\HasSeoMeta;
use App\Domain\Core\Enums\PublishStatus;
use App\Domain\Core\Models\DomainModel;
use App\Domain\Courses\Enums\CourseAccessType;
use App\Domain\Students\Models\CourseAccessGrant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Course extends DomainModel implements HasMedia
{
    use HasSeoMeta;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'short_description',
        'full_description',
        'price',
        'old_price',
        'is_active',
        'is_featured',
        'access_type',
        'status',
        'published_at',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'old_price' => 'decimal:2',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'access_type' => CourseAccessType::class,
            'status' => PublishStatus::class,
            'published_at' => 'datetime',
            'sort_order' => 'integer',
        ];
    }

    public function modules(): HasMany
    {
        return $this->hasMany(CourseModule::class)->orderBy('sort_order');
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(\App\Domain\Lessons\Models\Lesson::class)->orderBy('sort_order');
    }

    public function accessGrants(): HasMany
    {
        return $this->hasMany(CourseAccessGrant::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', PublishStatus::Published)
            ->where('is_active', true)
            ->where('published_at', '<=', now());
    }
}
