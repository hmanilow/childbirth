<?php

namespace App\Http\Controllers\Web;

use App\Domain\Courses\Models\Course;
use App\Domain\News\Models\NewsPost;
use App\Domain\Pages\Models\Page;
use App\Domain\Seo\Models\CityLandingPage;
use App\Domain\Services\Models\Service;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $urls = collect()
            ->merge(Page::query()->published()->with('seoMeta')->get()->map(fn (Page $page) => url($page->slug === 'home' ? '/' : '/'.$page->slug)))
            ->merge(NewsPost::query()->published()->get()->map(fn (NewsPost $post) => route('news.show', $post->slug)))
            ->merge(Service::query()->published()->get()->map(fn (Service $service) => url('/services/'.$service->slug)))
            ->merge(Course::query()->published()->get()->map(fn (Course $course) => route('courses.show', $course->slug)))
            ->merge(CityLandingPage::query()->where('status', 'published')->get()->map(fn (CityLandingPage $page) => route('city.show', $page->slug)))
            ->unique()
            ->values();

        return response()
            ->view('pages.sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }

    public function robots(): Response
    {
        return response("User-agent: *\nAllow: /\nSitemap: ".url('/sitemap.xml')."\n", 200)
            ->header('Content-Type', 'text/plain');
    }
}
