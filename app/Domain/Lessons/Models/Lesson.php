<?php

namespace App\Domain\Lessons\Models;

use App\Domain\Core\Models\DomainModel;
use App\Domain\Courses\Models\Course;
use App\Domain\Courses\Models\CourseModule;
use App\Domain\Students\Models\LessonProgress;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Lesson extends DomainModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'course_id',
        'module_id',
        'title',
        'slug',
        'short_description',
        'content',
        'video_url',
        'duration',
        'is_preview',
        'is_published',
        'published_at',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'duration' => 'integer',
            'is_preview' => 'boolean',
            'is_published' => 'boolean',
            'published_at' => 'datetime',
            'sort_order' => 'integer',
        ];
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(CourseModule::class, 'module_id');
    }

    public function progress(): HasMany
    {
        return $this->hasMany(LessonProgress::class);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)->where('published_at', '<=', now());
    }
}
