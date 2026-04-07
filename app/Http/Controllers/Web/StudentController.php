<?php

namespace App\Http\Controllers\Web;

use App\Domain\Lessons\Models\Lesson;
use App\Domain\Students\Actions\MarkLessonCompletedAction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StudentController extends Controller
{
    public function courses(Request $request): View
    {
        return view('student.courses', [
            'grants' => $request->user()->courseAccessGrants()->active()->with('course.modules.lessons')->get(),
        ]);
    }

    public function lesson(Request $request, Lesson $lesson): View
    {
        abort_unless($lesson->is_preview || $request->user()->courseAccessGrants()->active()->where('course_id', $lesson->course_id)->exists(), 403);

        return view('student.lesson', ['lesson' => $lesson->load('course', 'module')]);
    }

    public function complete(Request $request, Lesson $lesson, MarkLessonCompletedAction $markLessonCompleted): RedirectResponse
    {
        abort_unless($request->user()->courseAccessGrants()->active()->where('course_id', $lesson->course_id)->exists(), 403);

        $markLessonCompleted->execute($request->user(), $lesson);

        return back()->with('status', 'Урок отмечен как просмотренный.');
    }
}
