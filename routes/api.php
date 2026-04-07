<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\LeadController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\PublicContentController;
use App\Http\Controllers\Api\V1\StudentController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')->group(function (): void {
    Route::get('/pages/{slug}', [PublicContentController::class, 'page'])->name('pages.show');
    Route::get('/news', [PublicContentController::class, 'news'])->name('news.index');
    Route::get('/news/{slug}', [PublicContentController::class, 'newsShow'])->name('news.show');
    Route::get('/partners', [PublicContentController::class, 'partners'])->name('partners.index');
    Route::get('/services', [PublicContentController::class, 'services'])->name('services.index');
    Route::get('/courses', [PublicContentController::class, 'courses'])->name('courses.index');
    Route::get('/courses/{slug}', [PublicContentController::class, 'courseShow'])->name('courses.show');

    Route::post('/leads', [LeadController::class, 'store'])->middleware('throttle:10,1')->name('leads.store');
    Route::post('/consultations', [LeadController::class, 'store'])->middleware('throttle:10,1')->name('consultations.store');

    Route::post('/auth/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('auth.login');

    Route::middleware('auth:sanctum')->group(function (): void {
        Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
        Route::get('/auth/me', [AuthController::class, 'me'])->name('auth.me');

        Route::get('/me/courses', [StudentController::class, 'courses'])->name('me.courses');
        Route::get('/me/lessons/{lesson}', [StudentController::class, 'lesson'])->name('me.lessons.show');
        Route::post('/me/lessons/{lesson}/complete', [StudentController::class, 'complete'])->name('me.lessons.complete');

        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });
});
