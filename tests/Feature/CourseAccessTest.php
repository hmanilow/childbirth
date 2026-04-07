<?php

namespace Tests\Feature;

use App\Domain\Core\Enums\PublishStatus;
use App\Domain\Courses\Enums\CourseAccessType;
use App\Domain\Courses\Models\Course;
use App\Domain\Lessons\Models\Lesson;
use App\Domain\Students\Actions\GrantCourseAccessAction;
use App\Domain\Students\Enums\AccessGrantSource;
use App\Domain\Users\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_needs_access_grant_for_private_lesson(): void
    {
        $user = User::factory()->create();
        $course = Course::create([
            'title' => 'Курс',
            'slug' => 'course',
            'price' => 1000,
            'access_type' => CourseAccessType::Paid,
            'status' => PublishStatus::Published,
            'is_active' => true,
            'published_at' => now(),
        ]);
        $lesson = Lesson::create([
            'course_id' => $course->id,
            'title' => 'Урок',
            'slug' => 'lesson',
            'is_published' => true,
            'published_at' => now(),
        ]);

        $this->actingAs($user)->get(route('student.lessons.show', $lesson))->assertForbidden();

        app(GrantCourseAccessAction::class)->execute($user, $course, AccessGrantSource::Admin);

        $this->actingAs($user)->get(route('student.lessons.show', $lesson))->assertOk();
    }
}
