<?php

namespace App\Providers;

use App\Domain\Courses\Models\Course;
use App\Domain\Courses\Policies\CoursePolicy;
use App\Domain\Leads\Models\Lead;
use App\Domain\Leads\Policies\LeadPolicy;
use App\Domain\Lessons\Models\Lesson;
use App\Domain\Lessons\Policies\LessonPolicy;
use App\Domain\Orders\Models\Order;
use App\Domain\Orders\Policies\OrderPolicy;
use App\Domain\Payments\Models\Payment;
use App\Domain\Payments\Policies\PaymentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Course::class => CoursePolicy::class,
        Lesson::class => LessonPolicy::class,
        Lead::class => LeadPolicy::class,
        Order::class => OrderPolicy::class,
        Payment::class => PaymentPolicy::class,
    ];

    public function boot(): void
    {
        Gate::before(function ($user): ?bool {
            return $user->hasRole('super_admin') ? true : null;
        });
    }
}
