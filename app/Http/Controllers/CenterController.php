<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\View\View;

class CenterController extends Controller
{
    public function index(): View
    {
        $centers = collect(config('centers.locations', []))
            ->filter(fn (array $center): bool => (bool) ($center['active'] ?? false))
            ->values();

        return view('centers', compact('centers'));
    }
}
