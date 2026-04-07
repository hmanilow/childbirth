<?php

namespace App\Http\Controllers\Web;

use App\Domain\Pages\Models\Page;
use App\Domain\Seo\Models\CityLandingPage;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class PageController extends Controller
{
    public function home(): View
    {
        return $this->show('home');
    }

    public function show(string $slug): View
    {
        $page = Page::query()
            ->with(['blocks', 'seoMeta'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.show', ['page' => $page]);
    }

    public function city(string $slug): View
    {
        $page = CityLandingPage::query()
            ->with(['city', 'seoMeta'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.city', ['page' => $page]);
    }
}
