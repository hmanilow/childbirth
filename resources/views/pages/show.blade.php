@extends('layouts.app')

@section('content')
    <article class="mx-auto max-w-6xl px-4 py-10">
        <header class="mb-8">
            <p class="text-sm uppercase tracking-wide text-slate-500">{{ $page->type }}</p>
            <h1 class="mt-2 text-4xl font-semibold">{{ $page->seoMeta->h1 ?? $page->title }}</h1>
            @if($page->excerpt)
                <p class="mt-4 max-w-2xl text-lg text-slate-600">{{ $page->excerpt }}</p>
            @endif
        </header>

        @forelse($page->blocks as $block)
            @includeIf('components.blocks.'.$block->type->value, ['block' => $block])
        @empty
            <div class="prose max-w-none">
                {!! $page->content ?: '<p>Контент страницы скоро появится.</p>' !!}
            </div>
        @endforelse

        <section class="mt-12 rounded-lg border border-slate-200 bg-white p-6">
            <h2 class="text-2xl font-semibold">Оставить заявку</h2>
            <livewire:lead-form source="page_{{ $page->slug }}" />
        </section>
    </article>
@endsection
