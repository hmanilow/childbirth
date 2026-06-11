<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Domain\Courses\Models\Course;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $staticUrls = [
            ['loc' => url('/'),               'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => url('/about'),          'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => url('/courses'),        'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => url('/contacts'),       'priority' => '0.6', 'changefreq' => 'yearly'],
            ['loc' => url('/privacy'),        'priority' => '0.3', 'changefreq' => 'yearly'],
            ['loc' => url('/terms'),          'priority' => '0.3', 'changefreq' => 'yearly'],
        ];

        $courses = Course::published()->get(['slug', 'updated_at']);
        $news = collect();
        $services = collect();

        $xml = view('sitemap', compact('staticUrls', 'courses', 'news', 'services'));

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
