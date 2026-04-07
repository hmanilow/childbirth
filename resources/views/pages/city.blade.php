@extends('layouts.app')

@section('content')
    <article class="mx-auto max-w-6xl px-4 py-10">
        <p class="text-sm uppercase tracking-wide text-slate-500">{{ $page->city->name }}</p>
        <h1 class="mt-2 text-4xl font-semibold">{{ $page->seoMeta->h1 ?? $page->title }}</h1>
        <div class="prose mt-8 max-w-none">
            {!! $page->content ?: '<p>Страница готовится. Здесь будет уникальный материал под локальный поисковый интент.</p>' !!}
        </div>
        <section class="mt-12 rounded-lg border border-slate-200 bg-white p-6">
            <h2 class="text-2xl font-semibold">Получить консультацию</h2>
            <livewire:lead-form source="city_{{ $page->intent }}" />
        </section>
    </article>
@endsection
