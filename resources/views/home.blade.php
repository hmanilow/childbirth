@extends('layouts.app')

@php
    $specialistName = $globalSettings['specialist_name'] ?? 'Елена Тимофеева';
    $specialistNameGenitive = $globalSettings['specialist_name_genitive'] ?? 'Елены Тимофеевой';
    $brandName = "Школа материнства {$specialistNameGenitive} «Рожаем вместе»";
@endphp

@section('title', $brandName)
@section('description', 'Курсы подготовки к родам, партнёрству, уходу за малышом и первым месяцам материнства.')
@section('og_title', $brandName)
@section('og_description', 'Курсы подготовки к родам, партнёрству, уходу за малышом и первым месяцам материнства.')

@section('structured_data')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@type": "Organization",
  "name": "{{ $brandName }}",
  "url": "{{ url('/') }}",
  "telephone": "{{ $globalSettings['phone'] ?? '' }}",
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

<section class="bg-bg-section py-16">
    <div class="mx-auto flex max-w-5xl flex-col items-start gap-6 px-4 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-accent">Подбор курса</p>
            <h2 class="mt-2 font-heading text-3xl font-bold text-text-heading">Не знаете, с чего начать?</h2>
            <p class="mt-3 max-w-2xl text-text-muted">Напишите нам, и мы поможем выбрать подходящий формат подготовки.</p>
        </div>
        <a href="{{ route('contacts') }}#form" class="btn-accent btn-lg shrink-0">Подобрать курс</a>
    </div>
</section>
@endsection
