<?php

namespace App\Http\Controllers\Web;

use App\Domain\News\Models\NewsPost;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class NewsController extends Controller
{
    public function index(): View
    {
        return view('pages.news-index', [
            'posts' => NewsPost::query()->published()->latest('published_at')->paginate(12),
        ]);
    }

    public function show(string $slug): View
    {
        return view('pages.news-show', [
            'post' => NewsPost::query()->with('seoMeta')->published()->where('slug', $slug)->firstOrFail(),
        ]);
    }
}
