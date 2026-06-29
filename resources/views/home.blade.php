@extends('layouts.app')

@php
    $specialistName = $globalSettings['specialist_name'] ?? 'Елена Тимофеева';
    $specialistNameGenitive = $globalSettings['specialist_name_genitive'] ?? 'Елены Тимофеевой';
    $brandName = "Школа материнства {$specialistNameGenitive} «Рожаем вместе»";
@endphp

@section('title', $brandName)
@section('description', 'Школа материнства «Рожаем вместе»: подготовка к беременности и родам, партнёрские роды, уход за малышом и послеродовая поддержка в Москве и Московской области.')
@section('og_title', $brandName)
@section('og_description', 'Курсы, доулы и бережная поддержка семьи от подготовки к родам до первых месяцев после рождения малыша.')

@section('structured_data')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@type": "Organization",
  "name": "{{ $brandName }}",
  "url": "{{ url('/') }}",
  "telephone": "{{ $globalSettings['phone'] ?? '' }}",
  "areaServed": [
    {
      "@@type": "City",
      "name": "Москва"
    },
    {
      "@@type": "AdministrativeArea",
      "name": "Московская область"
    }
  ],
  "sameAs": [
    "{{ $globalSettings['telegram_url'] ?? '' }}",
    "{{ $globalSettings['vk_url'] ?? '' }}"
  ]
}
</script>
@endsection

@section('content')
<section class="relative overflow-hidden bg-gradient-hero pt-44">
    <div class="mx-auto grid min-h-[560px] max-w-7xl items-center gap-10 px-4 pb-14 sm:px-6 lg:grid-cols-[1.05fr_0.95fr] lg:px-8">
        <div class="w-full min-w-0 max-w-3xl animate-fade-up">
            <p class="mb-4 text-sm font-semibold text-accent">
                Авторская школа материнства {{ $specialistNameGenitive }}
            </p>
            <h1 class="font-heading text-[2rem] font-bold leading-[1.08] text-text-heading sm:text-5xl lg:text-hero">
                Курсы для будущих <br class="sm:hidden">мам и пап
            </h1>
            <p class="mt-5 max-w-2xl text-lg leading-relaxed text-text-muted">
                Подготовка к родам, партнёрству, уходу за малышом и первым месяцам семьи в онлайн и офлайн форматах.
            </p>
            <p class="mt-3 text-sm font-semibold text-gold-dark">Москва и Московская область</p>

            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                <a href="#online" class="btn-accent btn-lg w-full sm:w-auto">Онлайн-курсы</a>
                <a href="#offline" class="btn-outline btn-lg w-full sm:w-auto">Офлайн-курсы</a>
            </div>
        </div>

        <div class="relative hidden h-full min-h-[420px] lg:block">
            <div class="absolute inset-y-8 right-0 w-[86%] rounded-lg bg-bg-card/70 shadow-card"></div>
            <div class="absolute right-10 top-10 w-[78%] rounded-lg border border-accent/20 bg-bg-card p-8 shadow-card-hover">
                <p class="text-sm font-semibold uppercase tracking-widest text-accent">Каталог</p>
                <div class="mt-6 space-y-4">
                    @foreach($categories as $category)
                        <div class="flex items-center justify-between border-b border-border-soft pb-3 last:border-b-0">
                            <span class="font-medium text-text-heading">{{ $category }}</span>
                            <span class="rounded-full bg-gold/15 px-3 py-1 text-xs font-semibold text-gold-dark">
                                {{ $courses->where('category', $category)->count() }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="absolute bottom-12 left-0 w-[58%] rounded-lg bg-accent p-7 text-white shadow-glow">
                <p class="text-5xl font-bold leading-none">{{ $courses->count() }}</p>
                <p class="mt-2 text-sm font-medium uppercase tracking-widest text-white/85">временных программ</p>
            </div>
        </div>
    </div>
</section>

<section class="bg-bg-base py-16" aria-labelledby="welcome-title">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 sm:px-6 lg:grid-cols-[0.88fr_1.12fr] lg:gap-16 lg:px-8">
        <div class="max-w-xl">
            <span class="section-eyebrow">Рожаем вместе</span>
            <h2 id="welcome-title" class="section-heading mt-2">
                Добро пожаловать в школу материнства «Рожаем вместе»
            </h2>
            <div class="mt-6 space-y-4 text-base leading-relaxed text-text-muted sm:text-lg">
                <p>
                    Беременность и роды — важнейшее путешествие в жизни семьи. Мы рядом, чтобы вы прошли его с радостью, уверенностью и спокойствием.
                </p>
                <p>
                    В школе собрана большая база полезной информации о беременности, родах и уходе за малышом в удобном онлайн- и офлайн-формате.
                </p>
            </div>
            <a href="#courses" class="btn-outline btn-lg mt-8 w-full sm:w-auto">Посмотреть курсы</a>
        </div>

        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-accent">Что мы предлагаем</p>
            <ul class="mt-4 border-t border-border-soft">
                <li class="grid gap-2 border-b border-border-soft py-5 sm:grid-cols-[2.5rem_1fr] sm:gap-4">
                    <span class="font-heading text-2xl font-bold text-gold-dark" aria-hidden="true">01</span>
                    <div>
                        <h3 class="font-heading text-xl font-bold text-text-heading">Подготовка к беременности и родам</h3>
                        <p class="mt-1 text-sm leading-relaxed text-text-muted sm:text-base">Комплексные курсы, которые помогают встретить роды с пониманием происходящего и практическими навыками.</p>
                    </div>
                </li>
                <li class="grid gap-2 border-b border-border-soft py-5 sm:grid-cols-[2.5rem_1fr] sm:gap-4">
                    <span class="font-heading text-2xl font-bold text-gold-dark" aria-hidden="true">02</span>
                    <div>
                        <h3 class="font-heading text-xl font-bold text-text-heading">Партнёрские роды</h3>
                        <p class="mt-1 text-sm leading-relaxed text-text-muted sm:text-base">Специальная подготовка для пар, которые хотят действовать как единая команда.</p>
                    </div>
                </li>
                <li class="grid gap-2 border-b border-border-soft py-5 sm:grid-cols-[2.5rem_1fr] sm:gap-4">
                    <span class="font-heading text-2xl font-bold text-gold-dark" aria-hidden="true">03</span>
                    <div>
                        <h3 class="font-heading text-xl font-bold text-text-heading">Онлайн- и офлайн-форматы</h3>
                        <p class="mt-1 text-sm leading-relaxed text-text-muted sm:text-base">Занимайтесь в подходящем темпе и там, где вам удобно.</p>
                    </div>
                </li>
                <li class="grid gap-2 border-b border-border-soft py-5 sm:grid-cols-[2.5rem_1fr] sm:gap-4">
                    <span class="font-heading text-2xl font-bold text-gold-dark" aria-hidden="true">04</span>
                    <div>
                        <h3 class="font-heading text-xl font-bold text-text-heading">Уход за малышом</h3>
                        <p class="mt-1 text-sm leading-relaxed text-text-muted sm:text-base">Практические знания и навыки, которые пригодятся с первых дней жизни ребёнка.</p>
                    </div>
                </li>
                <li class="grid gap-2 border-b border-border-soft py-5 sm:grid-cols-[2.5rem_1fr] sm:gap-4">
                    <span class="font-heading text-2xl font-bold text-gold-dark" aria-hidden="true">05</span>
                    <div>
                        <h3 class="font-heading text-xl font-bold text-text-heading">Послеродовое сопровождение</h3>
                        <p class="mt-1 text-sm leading-relaxed text-text-muted sm:text-base">Поддержка мамы и семьи после выписки, когда особенно важно не оставаться наедине с вопросами.</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>

<section id="courses" class="bg-bg-base py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-10 flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <span class="section-eyebrow">Каталог курсов</span>
                <h2 class="section-heading mt-2">Выберите формат обучения</h2>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="#online" class="rounded-full border border-accent bg-accent px-4 py-2 text-sm font-semibold text-white shadow-glow">Онлайн</a>
                <a href="#offline" class="rounded-full border border-gold bg-gold/15 px-4 py-2 text-sm font-semibold text-gold-dark">Офлайн</a>
            </div>
        </div>

        <div id="online" class="scroll-mt-28">
            <div class="mb-6 flex items-center justify-between gap-4 border-b border-border-soft pb-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-accent">Онлайн</p>
                    <h3 class="font-heading text-3xl font-bold text-text-heading">Учиться в удобном темпе</h3>
                </div>
                <span class="hidden rounded-full bg-accent/10 px-4 py-2 text-sm font-semibold text-accent sm:inline-flex">
                    {{ $onlineCourses->count() }} курсов
                </span>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                @forelse($onlineCourses as $course)
                    <x-course-card :course="$course" />
                @empty
                    <p class="rounded-lg border border-border-soft bg-bg-section p-6 text-text-muted">Онлайн-курсы скоро появятся.</p>
                @endforelse
            </div>
        </div>

        <div id="offline" class="mt-16 scroll-mt-28">
            <div class="mb-6 flex items-center justify-between gap-4 border-b border-border-soft pb-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-gold-dark">Офлайн</p>
                    <h3 class="font-heading text-3xl font-bold text-text-heading">Живые занятия и интенсивы</h3>
                </div>
                <span class="hidden rounded-full bg-gold/15 px-4 py-2 text-sm font-semibold text-gold-dark sm:inline-flex">
                    {{ $offlineCourses->count() }} курсов
                </span>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                @forelse($offlineCourses as $course)
                    <x-course-card :course="$course" />
                @empty
                    <p class="rounded-lg border border-border-soft bg-bg-section p-6 text-text-muted">Офлайн-курсы скоро появятся.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

<section class="bg-bg-warm py-16" aria-labelledby="school-features-title">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="section-eyebrow">Особенности школы</span>
            <h2 id="school-features-title" class="section-heading mt-2">Больше, чем курсы</h2>
            <p class="section-subheading text-base leading-relaxed sm:text-lg">
                Живое знакомство со специалистами, поддержка доул и встречи с экспертами помогают выбрать свой путь подготовки.
            </p>
        </div>

        <div class="mt-10 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            <article class="border-t-2 border-accent pt-6">
                <p class="text-xs font-semibold uppercase tracking-widest text-accent">Личная поддержка</p>
                <h3 class="mt-3 font-heading text-2xl font-bold text-text-heading">Выбор доулы</h3>
                <p class="mt-3 leading-relaxed text-text-muted">
                    В школе работают опытные, чуткие и профессиональные доулы Москвы и Московской области. Вы сможете познакомиться и выбрать специалиста, рядом с которым вам спокойно.
                </p>
                <a href="{{ route('doulas') }}" class="mt-5 inline-flex font-semibold text-accent transition-colors hover:text-accent-hover">Познакомиться с доулами</a>
            </article>

            <article class="border-t-2 border-gold pt-6">
                <p class="text-xs font-semibold uppercase tracking-widest text-gold-dark">Бесплатные встречи</p>
                <h3 class="mt-3 font-heading text-2xl font-bold text-text-heading">Дульские посиделки</h3>
                <p class="mt-3 leading-relaxed text-text-muted">
                    Приходите знакомиться с нашими специалистами за чашкой чая в спокойной и уютной атмосфере. Участие бесплатное.
                </p>
                <a href="{{ route('contacts') }}#form" class="mt-5 inline-flex font-semibold text-accent transition-colors hover:text-accent-hover">Узнать о ближайшей встрече</a>
            </article>

            <article class="border-t-2 border-text-heading pt-6 md:col-span-2 lg:col-span-1">
                <p class="text-xs font-semibold uppercase tracking-widest text-text-subtle">Профессиональные знания</p>
                <h3 class="mt-3 font-heading text-2xl font-bold text-text-heading">Лекции экспертов</h3>
                <p class="mt-3 leading-relaxed text-text-muted">
                    Вас ждут встречи с акушером-гинекологом, неонатологом, консультантами по детскому сну и грудному вскармливанию.
                </p>
            </article>
        </div>
    </div>
</section>

<section class="bg-bg-section py-16">
    <div class="mx-auto flex max-w-5xl flex-col items-start gap-6 px-4 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-accent">Рожаем вместе</p>
            <h2 class="mt-2 font-heading text-3xl font-bold text-text-heading">Начните путь к осознанному материнству вместе с нами</h2>
            <p class="mt-3 max-w-2xl text-text-muted">Поможем выбрать формат подготовки, чтобы вы подошли к беременности, родам и первым месяцам с малышом спокойнее и увереннее.</p>
        </div>
        <a href="{{ route('contacts') }}#form" class="btn-accent btn-lg shrink-0">Подобрать курс</a>
    </div>
</section>
@endsection
