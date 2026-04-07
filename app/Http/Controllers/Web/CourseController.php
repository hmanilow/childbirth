<?php

namespace App\Http\Controllers\Web;

use App\Domain\Courses\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class CourseController extends Controller
{
    public function index(): View
    {
        return view('courses.index', [
            'courses' => Course::query()->with('seoMeta')->published()->orderBy('sort_order')->paginate(12),
        ]);
    }

    public function show(string $slug): View
    {
        return view('courses.show', [
            'course' => Course::query()
                ->with(['modules.lessons' => fn ($query) => $query->published(), 'seoMeta'])
                ->published()
                ->where('slug', $slug)
                ->firstOrFail(),
        ]);
    }
}
