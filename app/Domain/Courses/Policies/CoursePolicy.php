<?php

namespace App\Domain\Courses\Policies;

use App\Domain\Courses\Models\Course;
use App\Domain\Users\Models\User;

class CoursePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('courses.manage');
    }

    public function view(User $user, Course $course): bool
    {
        return $course->access_type?->value === 'free'
            || $user->can('courses.manage')
            || $user->courseAccessGrants()->active()->where('course_id', $course->id)->exists();
    }

    public function manage(User $user): bool
    {
        return $user->can('courses.manage');
    }

    public function create(User $user): bool
    {
        return $this->manage($user);
    }

    public function update(User $user, Course $course): bool
    {
        return $this->manage($user);
    }

    public function delete(User $user, Course $course): bool
    {
        return $this->manage($user);
    }
}
