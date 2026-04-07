<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Lessons\Models\Lesson;
use App\Domain\Students\Actions\MarkLessonCompletedAction;
use App\Http\Resources\V1\CourseResource;
use App\Http\Resources\V1\LessonResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Routing\Controller;

class StudentController extends Controller
{
    public function courses(Request $request): AnonymousResourceCollection
    {
        $courses = $request->user()->courseAccessGrants()->active()->with('course.modules.lessons')->get()->pluck('course');

        return CourseResource::collection($courses);
    }

    public function lesson(Request $request, Lesson $lesson): LessonResource
    {
        abort_unless($lesson->is_preview || $request->user()->courseAccessGrants()->active()->where('course_id', $lesson->course_id)->exists(), 403);

        return new LessonResource($lesson);
    }

    public function complete(Request $request, Lesson $lesson, MarkLessonCompletedAction $markLessonCompleted): JsonResponse
    {
        abort_unless($request->user()->courseAccessGrants()->active()->where('course_id', $lesson->course_id)->exists(), 403);

        $progress = $markLessonCompleted->execute($request->user(), $lesson);

        return response()->json(['data' => ['progress_id' => $progress->id, 'completed_at' => $progress->completed_at?->toISOString()]]);
    }
}
