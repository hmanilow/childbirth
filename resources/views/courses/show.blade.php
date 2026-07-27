@extends('layouts.app')

@section('title', $course->meta_title ?: $course->title . ' — Школа материнства «Рожаем вместе»')
@section('description', $course->meta_description ?: $course->short_desc)

@section('structured_data')
@php
    $courseOfferUrl = route('contacts') . '?course=' . rawurlencode($course->slug) . '#form';
    $structuredPrices = collect($course->pricing_options ?? [])
        ->filter(fn ($option) => isset($option['price']) && (float) $option['price'] > 0)
        ->pluck('price')
        ->map(fn ($price) => (float) $price);

    if ($structuredPrices->isEmpty() && (float) $course->price > 0) {
        $structuredPrices->push((float) $course->price);
    }

    $courseSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Course',
        'name' => $course->title,
        'description' => $course->short_desc,
        'provider' => [
            '@type' => 'Organization',
            'name' => $globalSettings['site_name'] ?? 'Школа материнства «Рожаем вместе»',
        ],
    ];

    if ($structuredPrices->isNotEmpty()) {
        $courseSchema['offers'] = $structuredPrices->unique()->count() > 1
            ? [
                '@type' => 'AggregateOffer',
                'lowPrice' => $structuredPrices->min(),
                'highPrice' => $structuredPrices->max(),
                'offerCount' => $structuredPrices->unique()->count(),
                'priceCurrency' => 'RUB',
                'url' => $courseOfferUrl,
            ]
            : [
                '@type' => 'Offer',
                'price' => $structuredPrices->first(),
                'priceCurrency' => 'RUB',
                'availability' => 'https://schema.org/InStock',
                'url' => $courseOfferUrl,
            ];
    }
@endphp
<script type="application/ld+json">
{!! json_encode($courseSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@endsection

@section('content')
@php
    $paymentsEnabled = (bool) (($globalSettings ?? [])['yookassa_enabled'] ?? false);
    $isManual = ($course->access_type ?? '') === 'manual';
    $courseCheckoutUrl = $paymentsEnabled && ! $isManual
        ? route('checkout.show', $course->slug)
        : route('contacts') . '?course=' . rawurlencode($course->slug) . '#form';
    $isFree = ((float) $course->price) <= 0;
    $isOffline = ($course->format ?? '') === \App\Domain\Courses\Models\Course::FORMAT_OFFLINE;
    $formatLabel = method_exists($course, 'formatLabel') ? $course->formatLabel() : 'Онлайн';
    $priceLabel = method_exists($course, 'priceLabel') ? $course->priceLabel() : 'Уточняется';
    $detailLabel = $isOffline ? 'Расписание' : 'Доступ';
    $detailValue = $isOffline
        ? 'По предварительной записи'
        : ($course->access_days ? $course->access_days . ' дней' : 'После оформления');
    $ctaLabel = $isManual ? 'Записаться' : ($isFree ? 'Записаться бесплатно' : 'Записаться за ' . number_format((float) $course->price, 0, '.', ' ') . ' ₽');
@endphp

<main>
    <section class="bg-bg-section pb-0 pt-44">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="grid items-start gap-12 lg:grid-cols-2">
                <div class="py-12">
                    <div class="mb-4 flex flex-wrap gap-2">
                        <span class="{{ $isOffline ? 'badge-gold' : 'badge-accent' }}">{{ $formatLabel }}</span>
                        @if($course->category)
                            <span class="badge-soft">{{ $course->category }}</span>
                        @endif
                        @if($course->badge)
                            <span class="badge-soft">{{ $course->badge }}</span>
                        @endif
                    </div>

                    <h1 class="mb-4 font-heading text-4xl font-bold leading-tight text-text-primary lg:text-5xl">
                        {{ $course->title }}
                    </h1>

                    @if($course->subtitle)
                        <p class="mb-3 text-lg font-semibold leading-relaxed text-text-heading">{{ $course->subtitle }}</p>
                    @endif

                    @if($course->short_desc)
                        <p class="mb-6 text-lg leading-relaxed text-text-muted">{{ $course->short_desc }}</p>
                    @endif

                    <div class="mb-8 grid max-w-lg grid-cols-2 gap-3 rounded-btn border border-border-soft bg-bg-card p-4 text-sm">
                        <div>
                            <span class="block text-text-muted">Стоимость</span>
                            <strong class="mt-1 block text-text-heading">{{ $priceLabel }}</strong>
                            @if($course->hasDiscount())
                                <span class="mt-1 block text-xs text-text-subtle line-through">{{ number_format((float) $course->old_price, 0, '.', ' ') }} ₽</span>
                            @endif
                        </div>
                        <div>
                            <span class="block text-text-muted">{{ $detailLabel }}</span>
                            <strong class="mt-1 block leading-snug text-text-heading">{{ $detailValue }}</strong>
                        </div>
                    </div>

                    <div class="mb-8 flex flex-wrap gap-6 text-sm text-text-muted">
                        @if($course->lessons_count)
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-accent-main" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.36a1 1 0 01-1.447.894L15 14M3 8a2 2 0 012-2h8a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8z"/></svg>
                                {{ $course->lessons_count }} {{ trans_choice('{1} лекция|[2,4] лекции|[5,*] лекций', $course->lessons_count) }}
                            </div>
                        @endif
                        @if($course->duration_hours)
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-accent-main" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $course->duration_hours }} {{ trans_choice('{1} час|[2,4] часа|[5,*] часов', $course->duration_hours) }}
                            </div>
                        @endif
                        @if($course->category)
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4 text-accent-main" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                {{ $course->category }}
                            </div>
                        @endif
                    </div>

                    @if($hasAccess)
                        <a href="{{ route('account.course.show', $course->slug) }}" class="btn-accent px-10 py-4 text-lg">
                            Перейти к обучению
                        </a>
                    @else
                        <a href="{{ $courseCheckoutUrl }}" class="btn-accent px-10 py-4 text-lg">
                            {{ $ctaLabel }}
                        </a>
                    @endif
                </div>

                @if($course->cover)
                    <div class="hidden lg:block">
                        <div class="relative overflow-hidden rounded-2xl shadow-card-hover">
                            <img src="{{ $course->cover }}" alt="{{ $course->title }}" class="h-96 w-full object-cover">
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @if($course->what_you_learn)
        <section class="bg-bg-card py-16">
            <div class="container mx-auto px-4 sm:px-6">
                <h2 class="section-heading mb-8">Что вы узнаете</h2>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($course->what_you_learn as $item)
                        <div class="flex items-start gap-3 rounded-xl border border-border-soft bg-bg-base p-4">
                            <svg class="mt-0.5 h-5 w-5 shrink-0 text-accent-main" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-sm leading-relaxed text-text-primary">{{ $item }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(! empty($course->pricing_options))
        <section class="bg-bg-warm py-16" aria-labelledby="course-pricing-title">
            <div class="container mx-auto px-4 sm:px-6">
                <div class="max-w-3xl">
                    <span class="section-eyebrow">Варианты участия</span>
                    <h2 id="course-pricing-title" class="section-heading mt-2">Стоимость курса</h2>
                </div>
                <div class="mt-8 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
                    @foreach($course->pricing_options as $option)
                        <article class="flex h-full flex-col rounded-card border border-border-soft bg-bg-card p-6 shadow-card">
                            <h3 class="font-heading text-xl font-bold text-text-heading">{{ $option['label'] }}</h3>
                            <div class="mt-4 flex flex-wrap items-baseline gap-2">
                                <strong class="font-heading text-3xl text-text-heading">{{ number_format((float) $option['price'], 0, '.', ' ') }} ₽</strong>
                                @if(! empty($option['old_price']) && (float) $option['old_price'] > (float) $option['price'])
                                    <span class="text-sm text-text-muted line-through">{{ number_format((float) $option['old_price'], 0, '.', ' ') }} ₽</span>
                                @endif
                            </div>
                            @if(! empty($option['note']))
                                <p class="mt-4 text-sm leading-relaxed text-text-muted">{{ $option['note'] }}</p>
                            @endif
                            <a href="{{ $courseCheckoutUrl }}" class="btn-outline btn-sm mt-6 w-full">Выбрать вариант</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($course->description)
        <section class="bg-bg-base py-16">
            <div class="container mx-auto max-w-4xl px-4 sm:px-6">
                <details class="group overflow-hidden rounded-card border border-border-soft bg-bg-card shadow-card">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-6 p-6 sm:p-8">
                        <div>
                            <span class="section-eyebrow">Содержание</span>
                            <h2 class="mt-2 font-heading text-3xl font-bold text-text-heading">Полная программа курса</h2>
                        </div>
                        <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-accent/25 text-accent transition-transform duration-200 group-open:rotate-45" aria-hidden="true">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v14M5 12h14"/></svg>
                        </span>
                    </summary>
                    <div class="border-t border-border-soft px-6 py-8 sm:px-8">
                        <div class="prose prose-lg max-w-none prose-headings:font-heading prose-headings:text-text-heading prose-p:text-text-muted prose-li:text-text-muted prose-strong:text-text-heading">
                            {!! $course->description !!}
                        </div>
                    </div>
                </details>
            </div>
        </section>
    @endif

    @if($course->modules->isNotEmpty())
        <section class="py-16">
            <div class="container mx-auto max-w-3xl px-4 sm:px-6">
                <h2 class="section-heading mb-8">Учебные модули</h2>
                <div class="space-y-3" x-data="{ open: 0 }">
                    @foreach($course->modules as $i => $module)
                        <div class="overflow-hidden rounded-xl border border-border-soft bg-bg-card">
                            <button
                                type="button"
                                @click="open = open === {{ $i }} ? null : {{ $i }}"
                                class="flex w-full items-center justify-between p-5 text-left transition-colors hover:bg-bg-light"
                            >
                                <div>
                                    <span class="text-sm text-text-muted">Модуль {{ $i + 1 }}</span>
                                    <h3 class="mt-0.5 font-semibold text-text-primary">{{ $module->title }}</h3>
                                </div>
                                <svg class="ml-4 h-5 w-5 shrink-0 text-accent-main transition-transform duration-200" :class="open === {{ $i }} ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div x-show="open === {{ $i }}" x-collapse>
                                <ul class="divide-y divide-border-soft px-5 pb-4">
                                    @foreach($module->publishedLessons as $lesson)
                                        <li class="flex items-center gap-3 py-3">
                                            <span class="flex-1 text-sm text-text-primary">{{ $lesson->title }}</span>
                                            @if($lesson->is_preview)
                                                <span class="text-xs text-accent-main">Превью</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @unless($hasAccess)
        <section class="bg-bg-card py-16">
            <div class="container mx-auto max-w-2xl px-4 text-center sm:px-6">
                <h2 class="section-heading mb-4">Хотите записаться?</h2>
                <p class="mb-8 text-text-muted">Оставьте заявку, и команда школы поможет выбрать формат и ответит на вопросы.</p>
                <a href="{{ $courseCheckoutUrl }}" class="btn-accent px-12 py-4 text-lg">{{ $ctaLabel }}</a>
            </div>
        </section>
    @endunless
</main>
@endsection
