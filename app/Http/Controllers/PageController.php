<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Domain\Pages\Models\Page;

class PageController extends Controller
{
    public function show(string $slug): View
    {
        $page = Page::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('page', compact('page'));
    }

    public function privacy(): View
    {
        return view('legal.privacy');
    }

    public function personalDataConsent(): View
    {
        return view('legal.personal-data-consent');
    }

    public function offer(): View
    {
        return view('legal.offer');
    }
}
