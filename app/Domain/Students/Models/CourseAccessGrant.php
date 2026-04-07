<?php

namespace App\Domain\Students\Models;

use App\Domain\Core\Models\DomainModel;
use App\Domain\Courses\Models\Course;
use App\Domain\Students\Enums\AccessGrantSource;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class CourseAccessGrant extends DomainModel
{
    protected $fillable = [
        'user_id',
        'course_id',
        'granted_by_type',
        'granted_by_id',
        'source',
        'starts_at',
        'ends_at',
        'revoked_at',
        'notes',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'source' => AccessGrantSource::class,
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'revoked_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function grantedBy(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query
            ->whereNull('revoked_at')
            ->where(fn (Builder $query) => $query->whereNull('starts_at')->orWhere('starts_at', '<=', now()))
            ->where(fn (Builder $query) => $query->whereNull('ends_at')->orWhere('ends_at', '>', now()));
    }
}
