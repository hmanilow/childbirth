<?php

namespace App\Http\Controllers;

use App\Domain\Courses\Models\Course;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $courses = Course::published()
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        $onlineCourses = $courses
            ->where('format', Course::FORMAT_ONLINE)
            ->values();

        $offlineCourses = $courses
            ->where('format', Course::FORMAT_OFFLINE)
            ->values();

        $categories = $courses
            ->pluck('category')
            ->filter()
            ->unique()
            ->values();

        return view('home', compact(
            'courses',
            'onlineCourses',
            'offlineCourses',
            'categories',
        ));
    }
}
