@extends('layouts.app')

@php
    $center = $centers->first();
    $phone = trim((string) ($globalSettings['phone'] ?? '+7 (999) 345-69-96'));
    $schema = $center ? [
        '@context' => 'https://schema.org',
        '@type' => 'EducationalOrganization',
        'name' => 'Школа материнства «Рожаем вместе»',
        'url' => route('centers'),
        'telephone' => $phone,
        'description' => $center['description'],
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => $center['city'],
            'streetAddress' => $center['street_address'],
            'addressCountry' => 'RU',
        ],
        'hasMap' => $center['yandex_map_url'],
    ] : null;
@endphp

@section('title', 'Центр школы на Преображенской площади — «Рожаем вместе»')
@section('description', 'Офлайн-центр школы материнства «Рожаем вместе»: Москва, метро «Преображенская площадь», 2-я улица Бухвостова, дом 1.')
@section('og_title', 'Центр школы «Рожаем вместе» на Преображенской площади')
@section('og_description', 'Офлайн-лекции и очные занятия для будущих родителей в Москве. Адрес, схема проезда и Яндекс Карта.')
@section('canonical', route('centers'))

@if($schema)
    @section('structured_data')
        <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    @endsection
@endif

@section('content')
@if($center)
    <section class="bg-gradient-hero pt-44 pb-16">
        <div class="mx-auto grid max-w-7xl grid-cols-[minmax(0,1fr)] gap-10 px-4 sm:px-6 lg:grid-cols-[minmax(0,1.1fr)_minmax(0,0.9fr)] lg:items-end lg:px-8">
            <div class="min-w-0 max-w-3xl">
                <span class="section-eyebrow">Офлайн-центр</span>
                <h1 class="mt-3 font-heading text-4xl font-bold leading-tight text-text-heading sm:text-5xl lg:text-6xl">
                    Центр школы на Преображенской площади
                </h1>
                <p class="mt-5 max-w-2xl text-lg leading-relaxed text-text-muted">
                    {{ $center['description'] }}
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                    <a href="{{ $center['yandex_map_url'] }}" target="_blank" rel="noopener" class="btn-accent btn-lg w-full sm:w-auto">
                        Открыть в Яндекс Картах
                    </a>
                    <a href="{{ route('courses.index', ['format' => 'offline']) }}" class="btn-outline btn-lg w-full sm:w-auto">
                        Офлайн-курсы
                    </a>
                </div>
            </div>

            <div class="min-w-0 border-l-2 border-accent pl-6 sm:pl-8">
                <p class="text-xs font-semibold uppercase tracking-widest text-accent">Адрес центра</p>
                <address class="mt-3 not-italic">
                    <p class="font-heading text-2xl font-bold text-text-heading">{{ $center['full_address'] }}</p>
                    <p class="mt-3 text-base font-semibold text-gold-dark">м. «{{ $center['metro'] }}»</p>
                </address>
                <p class="mt-5 leading-relaxed text-text-muted">{{ $center['visit_note'] }}</p>
            </div>
        </div>
    </section>

    <section class="bg-bg-base py-16" aria-labelledby="route-title">
        <div class="mx-auto grid max-w-7xl grid-cols-[minmax(0,1fr)] gap-10 px-4 sm:px-6 lg:grid-cols-[minmax(0,1.25fr)_minmax(0,0.75fr)] lg:items-start lg:px-8">
            <div class="min-w-0">
                <span class="section-eyebrow">Яндекс Карта</span>
                <h2 id="route-title" class="section-heading mt-2">Схема проезда</h2>
                <div
                    class="mt-7 h-[320px] w-full max-w-full overflow-hidden rounded-lg border border-border-soft bg-bg-card shadow-card sm:h-[420px] lg:h-[480px]"
                    data-cookie-embed
                    data-cookie-category="functional"
                >
                    <div class="flex h-full flex-col items-center justify-center px-6 text-center" data-cookie-placeholder>
                        <span class="flex h-14 w-14 items-center justify-center rounded-full bg-gold/15 text-gold-dark" aria-hidden="true">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21s6-5.1 6-11a6 6 0 10-12 0c0 5.9 6 11 6 11z"/>
                                <circle cx="12" cy="10" r="2.2" stroke-width="1.8"/>
                            </svg>
                        </span>
                        <h3 class="mt-4 font-heading text-2xl font-bold text-text-heading">Интерактивная карта</h3>
                        <p class="mt-2 max-w-lg text-sm leading-relaxed text-text-muted">
                            Для загрузки Яндекс Карты разрешите функциональные cookie. Адрес и внешняя ссылка доступны без согласия.
                        </p>
                        <div class="mt-5 flex flex-col gap-3 sm:flex-row">
                            <button type="button" class="btn-accent" data-cookie-settings>Настроить cookie</button>
                            <a href="{{ $center['yandex_map_url'] }}" target="_blank" rel="noopener" class="btn-outline">Открыть в Яндекс Картах</a>
                        </div>
                    </div>
                    <iframe
                        data-cookie-src="{{ $center['yandex_embed_url'] }}"
                        data-cookie-content
                        title="Яндекс Карта: {{ $center['full_address'] }}"
                        class="h-full w-full border-0"
                        loading="lazy"
                        allowfullscreen
                        hidden
                    ></iframe>
                </div>
            </div>

            <div class="min-w-0 border-t border-border-soft lg:mt-16">
                <article class="grid grid-cols-[3rem_1fr] gap-4 border-b border-border-soft py-6">
                    <span class="font-heading text-2xl font-bold text-gold-dark" aria-hidden="true">01</span>
                    <div class="min-w-0">
                        <h3 class="font-heading text-xl font-bold text-text-heading">Доехать до метро</h3>
                        <p class="mt-2 leading-relaxed text-text-muted">Сокольническая линия, станция «{{ $center['metro'] }}».</p>
                    </div>
                </article>
                <article class="grid grid-cols-[3rem_1fr] gap-4 border-b border-border-soft py-6">
                    <span class="font-heading text-2xl font-bold text-gold-dark" aria-hidden="true">02</span>
                    <div class="min-w-0">
                        <h3 class="font-heading text-xl font-bold text-text-heading">Открыть маршрут</h3>
                        <p class="mt-2 leading-relaxed text-text-muted">Укажите точку отправления в Яндекс Картах и постройте маршрут до адреса центра.</p>
                        <a href="{{ $center['yandex_map_url'] }}" target="_blank" rel="noopener" class="mt-3 inline-flex font-semibold text-accent transition-colors hover:text-accent-hover">Перейти к маршруту</a>
                    </div>
                </article>
                <article class="grid grid-cols-[3rem_1fr] gap-4 border-b border-border-soft py-6">
                    <span class="font-heading text-2xl font-bold text-gold-dark" aria-hidden="true">03</span>
                    <div class="min-w-0">
                        <h3 class="font-heading text-xl font-bold text-text-heading">Уточнить вход</h3>
                        <p class="mt-2 leading-relaxed text-text-muted">{{ $center['visit_note'] }}</p>
                    </div>
                </article>

                <div class="mt-8 bg-bg-warm p-6 shadow-card sm:p-8">
                    <p class="text-xs font-semibold uppercase tracking-widest text-accent">Перед посещением</p>
                    <h3 class="mt-2 font-heading text-2xl font-bold text-text-heading">Запишитесь на занятие заранее</h3>
                    <p class="mt-3 leading-relaxed text-text-muted">Подтвердим дату и время, ответим на вопросы и отправим точную инструкцию по входу.</p>
                    <a href="{{ route('contacts') }}#form" class="btn-accent mt-6 inline-flex">Записаться</a>
                </div>
            </div>
        </div>
    </section>
@else
    <section class="bg-bg-section pt-44 pb-20">
        <div class="mx-auto max-w-3xl px-4 text-center sm:px-6">
            <h1 class="section-heading">Центры школы</h1>
            <p class="mt-4 text-text-muted">Информация об офлайн-центрах скоро появится.</p>
        </div>
    </section>
@endif
@endsection
