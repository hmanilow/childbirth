<?php

namespace Tests\Feature;

use App\Domain\Courses\Models\Course;
use App\Domain\Users\Models\User;
use App\Filament\Resources\Courses\Pages\ManageCourses;
use Database\Seeders\RolePermissionSeeder;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FilamentCourseResourceTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_course_from_filament_resource(): void
    {
        $this->seed(RolePermissionSeeder::class);

        $admin = User::query()->where('email', 'admin@example.ru')->firstOrFail();

        Filament::setCurrentPanel(Filament::getPanel('admin'));
        $this->actingAs($admin);

        Livewire::test(ManageCourses::class)
            ->assertActionVisible('create')
            ->callAction('create', [
                'title' => 'Test course',
                'slug' => 'test-course',
                'subtitle' => 'Short subtitle',
                'short_description' => 'Short description',
                'full_description' => 'Full description',
                'price' => 9900,
                'old_price' => null,
                'access_type' => 'paid',
                'status' => 'draft',
                'is_active' => true,
                'is_featured' => false,
            ])
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas(Course::class, [
            'title' => 'Test course',
            'slug' => 'test-course',
            'access_type' => 'paid',
            'status' => 'draft',
        ]);
    }
}
