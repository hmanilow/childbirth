@extends('layouts.app')

@section('content')
    <article class="mx-auto max-w-4xl px-4 py-10">
        <p class="text-sm text-slate-500">{{ $lesson->course->title }}</p>
        <h1 class="mt-2 text-4xl font-semibold">{{ $lesson->title }}</h1>
        @if($lesson->video_url)
            <a class="mt-6 inline-flex rounded bg-slate-900 px-4 py-2 text-white" href="{{ $lesson->video_url }}" rel="noreferrer">Открыть видео</a>
        @endif
        <div class="prose mt-8 max-w-none">{!! $lesson->content !!}</div>
        <form class="mt-8" method="post" action="{{ route('student.lessons.complete', $lesson) }}">
            @csrf
            <button class="rounded bg-emerald-700 px-4 py-2 text-white">Отметить просмотренным</button>
        </form>
    </article>
@endsection
