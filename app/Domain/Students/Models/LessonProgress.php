<?php

namespace App\Domain\Students\Models;

use App\Domain\Core\Models\DomainModel;
use App\Domain\Courses\Models\Course;
use App\Domain\Lessons\Models\Lesson;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LessonProgress extends DomainModel
{
    protected $fillable = [
        'user_id',
        'course_id',
        'lesson_id',
        'completed_at',
        'last_seen_at',
        'progress_percent',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'completed_at' => 'datetime',
            'last_seen_at' => 'datetime',
            'progress_percent' => 'integer',
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

    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
