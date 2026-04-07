<?php

use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\CourseController;
use App\Http\Controllers\Web\LeadController;
use App\Http\Controllers\Web\NewsController;
use App\Http\Controllers\Web\PageController;
use App\Http\Controllers\Web\SeoController;
use App\Http\Controllers\Web\StudentController;
use App\Http\Controllers\Webhooks\YooKassaWebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{slug}', [CourseController::class, 'show'])->name('courses.show');
Route::post('/courses/{course:slug}/checkout', [CheckoutController::class, 'store'])
    ->middleware(['auth', 'throttle:10,1'])
    ->name('courses.checkout');

Route::post('/leads', [LeadController::class, 'store'])->middleware('throttle:10,1')->name('leads.store');
Route::post('/consultations', [LeadController::class, 'store'])->middleware('throttle:10,1')->name('consultations.store');
Route::post('/callback', [LeadController::class, 'store'])->middleware('throttle:10,1')->name('callback.store');
Route::post('/questions', [LeadController::class, 'store'])->middleware('throttle:10,1')->name('questions.store');

Route::get('/payments/yookassa/return', [CheckoutController::class, 'return'])->name('payments.yookassa.return');
Route::post('/webhooks/yookassa', YooKassaWebhookController::class)->name('webhooks.yookassa');

Route::middleware('auth')->prefix('cabinet')->name('student.')->group(function (): void {
    Route::get('/', [StudentController::class, 'courses'])->name('dashboard');
    Route::get('/courses', [StudentController::class, 'courses'])->name('courses');
    Route::get('/lessons/{lesson}', [StudentController::class, 'lesson'])->name('lessons.show');
    Route::post('/lessons/{lesson}/complete', [StudentController::class, 'complete'])->name('lessons.complete');
});

Route::get('/city/{slug}', [PageController::class, 'city'])->name('city.show');

Route::get('/{slug}', [PageController::class, 'show'])
    ->where('slug', 'about|doula|preparation|partner-birth|mother-school|services|prices|partners|faq|contacts|privacy-policy|personal-data-consent|terms')
    ->name('pages.show');
