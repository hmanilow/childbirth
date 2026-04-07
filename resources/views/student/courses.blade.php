@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-6xl px-4 py-10">
        <h1 class="text-4xl font-semibold">Мои курсы</h1>
        <div class="mt-8 grid gap-4 md:grid-cols-2">
            @forelse($grants as $grant)
                <article class="rounded-lg border border-slate-200 bg-white p-5">
                    <h2 class="text-xl font-semibold">{{ $grant->course->title }}</h2>
                    <p class="mt-2 text-slate-600">{{ $grant->course->short_description }}</p>
                </article>
            @empty
                <p class="text-slate-600">Пока нет открытых курсов.</p>
            @endforelse
        </div>
    </section>
@endsection
