@extends('layouts.app')

@section('content')
    <article class="mx-auto max-w-6xl px-4 py-10">
        <h1 class="text-4xl font-semibold">{{ $course->seoMeta->h1 ?? $course->title }}</h1>
        <p class="mt-4 max-w-2xl text-lg text-slate-600">{{ $course->short_description }}</p>
        <div class="prose mt-8 max-w-none">{!! $course->full_description !!}</div>
        <section class="mt-10">
            <h2 class="text-2xl font-semibold">Программа курса</h2>
            <div class="mt-4 space-y-4">
                @foreach($course->modules as $module)
                    <div class="rounded-lg border border-slate-200 bg-white p-5">
                        <h3 class="font-semibold">{{ $module->title }}</h3>
                        <ul class="mt-3 space-y-2">
                            @foreach($module->lessons as $lesson)
                                <li>{{ $lesson->title }} @if($lesson->is_preview)<span class="text-sm text-emerald-700">preview</span>@endif</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </section>
    </article>
@endsection
