<?php

namespace App\Domain\Lessons\Policies;

use App\Domain\Lessons\Models\Lesson;
use App\Domain\Users\Models\User;

class LessonPolicy
{
    public function view(User $user, Lesson $lesson): bool
    {
        return $lesson->is_preview
            || $user->can('courses.manage')
            || $user->courseAccessGrants()->active()->where('course_id', $lesson->course_id)->exists();
    }

    public function manage(User $user): bool
    {
        return $user->can('courses.manage');
    }

    public function create(User $user): bool
    {
        return $this->manage($user);
    }

    public function update(User $user, Lesson $lesson): bool
    {
        return $this->manage($user);
    }

    public function delete(User $user, Lesson $lesson): bool
    {
        return $this->manage($user);
    }
}
