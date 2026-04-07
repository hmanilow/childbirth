<?php

namespace App\Domain\Students\Actions;

use App\Domain\Courses\Models\Course;
use App\Domain\Students\Enums\AccessGrantSource;
use App\Domain\Students\Models\CourseAccessGrant;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Model;

class GrantCourseAccessAction
{
    public function execute(
        User $user,
        Course $course,
        AccessGrantSource $source,
        ?Model $grantedBy = null,
        ?string $notes = null,
        ?array $metadata = null,
    ): CourseAccessGrant {
        $activeGrant = CourseAccessGrant::query()
            ->active()
            ->where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->first();

        if ($activeGrant) {
            return $activeGrant;
        }

        return CourseAccessGrant::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'granted_by_type' => $grantedBy?->getMorphClass(),
            'granted_by_id' => $grantedBy?->getKey(),
            'source' => $source,
            'starts_at' => now(),
            'notes' => $notes,
            'metadata' => $metadata,
        ]);
    }
}
