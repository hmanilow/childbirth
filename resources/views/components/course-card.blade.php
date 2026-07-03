@props(['course'])

@php
    $slug = (string) ($course->slug ?? '');
    $formatLabel = method_exists($course, 'formatLabel') ? $course->formatLabel() : 'Онлайн';
    $isOffline = ($course->format ?? '') === \App\Domain\Courses\Models\Course::FORMAT_OFFLINE;
    $isFree = ((float) $course->price) <= 0;
    $isManual = ($course->access_type ?? '') === 'manual';
    $iconType = str_contains($slug, 'papa') || str_contains($slug, 'partner')
        ? 'family'
        : (str_contains($slug, 'uhod') || str_contains($slug, 'vskarmlivanie') || str_contains($slug, 'son') ? 'baby' : 'birth');
@endphp

<article class="group flex h-full min-h-[500px] flex-col overflow-hidden rounded-lg border border-border-soft bg-bg-card transition duration-300 hover:-translate-y-1 hover:border-accent/60 hover:shadow-card-hover">
    <a href="{{ route('courses.show', $course->slug) }}" class="block">
        <div class="relative aspect-[16/10] overflow-hidden bg-gradient-card">
            @if($course->cover)
                <img
                    src="{{ $course->cover }}"
                    alt="{{ $course->title }}"
                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                    loading="lazy"
                >
            @else
                <div class="flex h-full w-full items-center justify-center bg-gradient-card-muted">
                    <div class="flex h-20 w-20 items-center justify-center rounded-lg border border-accent/25 bg-bg-card text-accent shadow-card transition duration-300 group-hover:scale-105">
                        @if($iconType === 'family')
                            <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 11a3 3 0 100-6 3 3 0 000 6zm10 0a3 3 0 100-6 3 3 0 000 6zM4 20a5 5 0 0110 0M10 20a5 5 0 0110 0"/>
                            </svg>
                        @elseif($iconType === 'baby')
                            <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 21c4 0 7-3 7-7 0-5-4-9-7-11-3 2-7 6-7 11 0 4 3 7 7 7z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 13h.01M15 13h.01M10 17c1.2.8 2.8.8 4 0"/>
                            </svg>
                        @else
                            <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3c3 2.5 6 6.2 6 10a6 6 0 01-12 0c0-3.8 3-7.5 6-10z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 14c1.6 1.3 4.4 1.3 6 0"/>
                            </svg>
                        @endif
                    </div>
                </div>
            @endif

            <div class="absolute left-3 top-3 flex flex-wrap gap-2">
                <span class="{{ $isOffline ? 'badge-gold' : 'badge-accent' }} text-xs font-semibold">{{ $formatLabel }}</span>
                @if($course->badge && ! in_array($course->badge, ['Онлайн', 'Офлайн'], true))
                    <span class="badge-soft text-xs font-semibold">{{ $course->badge }}</span>
                @endif
            </div>
        </div>
    </a>

    <div class="flex flex-1 flex-col p-5">
        @if($course->category)
            <span class="mb-3 text-xs font-semibold uppercase tracking-widest text-gold-dark">{{ $course->category }}</span>
        @endif

        <a href="{{ route('courses.show', $course->slug) }}" class="mb-3 block">
            <h3 class="font-heading text-xl font-semibold leading-snug text-text-heading transition-colors group-hover:text-accent">
                {{ $course->title }}
            </h3>
        </a>

        @if($course->short_desc)
            <p class="mb-5 flex-1 text-sm leading-relaxed text-text-muted">{{ Str::limit($course->short_desc, 132) }}</p>
        @endif

        <div class="mb-5 grid grid-cols-2 gap-3 rounded-btn bg-bg-light p-3 text-xs text-text-muted">
            <div>
                <span class="block text-text-subtle">Стоимость</span>
                <span class="mt-1 block font-semibold text-text-heading">{{ $isManual ? 'Уточняется' : ($isFree ? 'Бесплатно' : number_format((float) $course->price, 0, '.', ' ') . ' ₽') }}</span>
            </div>
            <div>
                <span class="block text-text-subtle">Расписание</span>
                <span class="mt-1 block font-semibold text-text-heading">Уточняется</span>
            </div>
        </div>

        <div class="mt-auto grid grid-cols-2 gap-3 border-t border-border-soft pt-4">
            <a href="{{ route('courses.show', $course->slug) }}" class="btn-outline btn-sm w-full">
                Подробнее
            </a>
            <a href="{{ route('contacts') }}?course={{ rawurlencode($course->slug) }}#form" class="btn-accent btn-sm w-full">Записаться</a>
        </div>
    </div>
</article>
