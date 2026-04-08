<?php

namespace Tests\Feature;

use App\Domain\Core\Enums\PublishStatus;
use App\Domain\Courses\Enums\CourseAccessType;
use App\Domain\Courses\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CoursePublicationTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalog_shows_published_active_course_without_published_at(): void
    {
        Course::create([
            'title' => 'Visible course',
            'slug' => 'visible-course',
            'short_description' => 'Course description',
            'price' => 1000,
            'access_type' => CourseAccessType::Paid,
            'status' => PublishStatus::Published,
            'is_active' => true,
            'published_at' => null,
        ]);

        $this->get(route('courses.index'))
            ->assertOk()
            ->assertSee('Visible course');

        $this->getJson('/api/v1/courses')
            ->assertOk()
            ->assertJsonFragment(['title' => 'Visible course']);
    }

    public function test_catalog_hides_published_course_with_future_published_at(): void
    {
        Course::create([
            'title' => 'Future course',
            'slug' => 'future-course',
            'price' => 1000,
            'access_type' => CourseAccessType::Paid,
            'status' => PublishStatus::Published,
            'is_active' => true,
            'published_at' => now()->addDay(),
        ]);

        $this->get(route('courses.index'))
            ->assertOk()
            ->assertDontSee('Future course');

        $this->getJson('/api/v1/courses')
            ->assertOk()
            ->assertJsonMissing(['title' => 'Future course']);
    }
}
