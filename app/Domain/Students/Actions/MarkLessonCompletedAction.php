<?php

namespace App\Domain\Students\Actions;

use App\Domain\Lessons\Models\Lesson;
use App\Domain\Students\Models\LessonProgress;
use App\Domain\Users\Models\User;

class MarkLessonCompletedAction
{
    public function execute(User $user, Lesson $lesson): LessonProgress
    {
        return LessonProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'course_id' => $lesson->course_id,
                'lesson_id' => $lesson->id,
            ],
            [
                'completed_at' => now(),
                'last_seen_at' => now(),
                'progress_percent' => 100,
            ],
        );
    }
}
