@php
    $phone = trim((string) ($globalSettings['phone'] ?? ''));
    $siteName = $globalSettings['site_name'] ?? 'Школа материнства «Рожаем вместе»';
    $logoPath = $globalSettings['site_logo'] ?? '';
    $nav = [
        ['title' => 'Наши специалисты', 'url' => route('about')],
        ['title' => 'Акции и новости', 'url' => route('news.index')],
        ['title' => 'Наши Доулы', 'url' => route('doulas')],
        ['title' => 'Отзывы', 'url' => route('reviews')],
    ];
    $phoneHref = preg_replace('/[^+\d]/', '', $phone);
@endphp

<header
    x-data="{ coursesOpen: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 36 })"
    :class="scrolled ? 'bg-bg-card/[0.96] shadow-card' : 'bg-bg-card/[0.90]'"
    class="fixed left-0 right-0 top-0 z-50 border-b border-border-soft/80 backdrop-blur-md transition-all duration-300"
>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between gap-3 sm:h-28 sm:gap-4">
            <a href="{{ route('home') }}" class="flex min-w-0 flex-shrink-0 items-center gap-3 sm:gap-4">
                @if($logoPath !== '')
                    <img src="{{ Storage::url($logoPath) }}" alt="{{ $siteName }}" class="h-20 w-auto object-contain drop-shadow-lg sm:h-28">
                @else
                    <img src="{{ asset('images/site/maternity-logo-web.svg') }}" alt="{{ $siteName }}" class="h-20 w-auto object-contain drop-shadow-lg sm:h-28">
                @endif
                <span class="hidden min-w-0 sm:block">
                    <span class="block font-heading text-xl font-bold leading-tight text-text-heading lg:text-2xl">Школа материнства</span>
                    <span class="block text-sm font-semibold uppercase tracking-widest text-accent lg:text-base">рожаем вместе</span>
                </span>
            </a>

            <div class="hidden items-center gap-8 xl:flex">
                @if($phone !== '')
                    <a href="tel:{{ $phoneHref }}" class="text-center transition-colors hover:text-accent">
                        <span class="block text-base font-semibold text-text-heading">{{ $phone }}</span>
                        <span class="mt-1 block text-xs text-text-muted">Позвонить нам</span>
                    </a>
                @endif
                <p class="text-sm font-semibold text-text-muted">Работаем без выходных!</p>
                <a href="{{ route('contacts') }}#form" class="btn-accent text-sm">Подобрать курс</a>
            </div>

            <div class="flex shrink-0 items-center gap-2 xl:hidden">
                @if($phone !== '')
                    <a
                        href="tel:{{ $phoneHref }}"
                        class="flex h-10 w-10 items-center justify-center rounded-btn border border-border-soft bg-bg-card text-accent shadow-card transition-colors hover:border-accent"
                        aria-label="Позвонить нам: {{ $phone }}"
                        title="{{ $phone }}"
                    >
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.62 2.63a2 2 0 0 1-.45 2.11L8 9.73a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.85.29 1.73.5 2.63.62A2 2 0 0 1 22 16.92z"/>
                        </svg>
                    </a>
                @endif
                <a href="{{ route('contacts') }}#form" class="btn-accent px-3 py-2 text-xs sm:text-sm">
                    <span class="hidden min-[360px]:inline">Подобрать курс</span>
                    <span class="min-[360px]:hidden">Курс</span>
                </a>
            </div>
        </div>
    </div>

    <div class="border-t border-border-soft/70 bg-accent xl:hidden">
        <nav class="mx-auto grid max-w-7xl grid-cols-6 px-4 sm:grid-cols-5 sm:px-6 lg:px-8" aria-label="Основная навигация">
            @foreach(array_slice($nav, 0, 2) as $item)
                <a href="{{ $item['url'] }}" class="col-span-2 flex min-h-9 items-center justify-center px-1 py-1 text-center text-[10px] font-medium leading-tight text-white transition-colors hover:bg-accent-dark/55 sm:col-span-1 sm:min-h-12 sm:px-2 sm:text-xs">
                    {{ $item['title'] }}
                </a>
            @endforeach

            <div class="relative col-span-2 flex min-h-9 sm:col-span-1 sm:min-h-12" @click.outside="coursesOpen = false">
                <a
                    href="{{ route('courses.index') }}"
                    class="flex flex-1 items-center justify-center py-1 pl-1 text-center text-[10px] font-medium leading-tight text-white transition-colors hover:bg-accent-dark/55 sm:pl-2 sm:text-xs"
                >
                    Курсы и абонементы
                </a>
                <button
                    type="button"
                    @click="coursesOpen = !coursesOpen"
                    :aria-expanded="coursesOpen"
                    class="flex w-7 shrink-0 items-center justify-center text-white transition-colors hover:bg-accent-dark/55 sm:w-8"
                    aria-label="Открыть форматы курсов"
                >
                    <svg class="h-3.5 w-3.5 transition-transform" :class="coursesOpen && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                    </svg>
                </button>
                <div
                    x-show="coursesOpen"
                    x-cloak
                    x-transition
                    class="absolute right-0 top-full z-50 w-56 border border-border-soft bg-bg-card p-2 shadow-card-hover sm:left-1/2 sm:right-auto sm:-translate-x-1/2"
                >
                    <a href="{{ route('courses.index', ['format' => 'online']) }}" class="block rounded-btn px-4 py-3 text-sm font-medium text-text-muted transition-colors hover:bg-bg-light hover:text-accent">Онлайн-курсы</a>
                    <a href="{{ route('courses.index', ['format' => 'offline']) }}" class="block rounded-btn px-4 py-3 text-sm font-medium text-text-muted transition-colors hover:bg-bg-light hover:text-accent">Офлайн-курсы</a>
                </div>
            </div>

            @foreach(array_slice($nav, 2) as $item)
                <a href="{{ $item['url'] }}" class="col-span-3 flex min-h-9 items-center justify-center px-1 py-1 text-center text-[10px] font-medium leading-tight text-white transition-colors hover:bg-accent-dark/55 sm:col-span-1 sm:min-h-12 sm:px-2 sm:text-xs">
                    {{ $item['title'] }}
                </a>
            @endforeach
        </nav>
    </div>

    <div class="hidden border-t border-border-soft/70 bg-accent xl:block">
        <nav class="mx-auto flex h-12 max-w-7xl items-stretch justify-center px-4" aria-label="Основная навигация">
            @foreach(array_slice($nav, 0, 2) as $item)
                <a href="{{ $item['url'] }}" class="flex items-center px-4 text-center text-sm font-medium text-white transition-colors hover:bg-accent-dark/55">
                    {{ $item['title'] }}
                </a>
            @endforeach

            <div class="group relative flex" @mouseenter="coursesOpen = true" @mouseleave="coursesOpen = false">
                <a
                    href="{{ route('courses.index') }}"
                    class="flex items-center pl-4 pr-2 text-sm font-medium text-white transition-colors hover:bg-accent-dark/55"
                >
                    Курсы и абонементы
                </a>
                <button
                    type="button"
                    @click="coursesOpen = !coursesOpen"
                    :aria-expanded="coursesOpen"
                    class="flex items-center px-2 pr-4 text-white transition-colors hover:bg-accent-dark/55"
                    aria-label="Открыть форматы курсов"
                >
                    <svg class="h-4 w-4 transition-transform" :class="coursesOpen && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                    </svg>
                </button>
                <div
                    x-show="coursesOpen"
                    x-cloak
                    x-transition
                    @click.outside="coursesOpen = false"
                    class="absolute left-1/2 top-full z-50 w-64 -translate-x-1/2 border border-border-soft bg-bg-card p-2 shadow-card-hover"
                >
                    <a href="{{ route('courses.index', ['format' => 'online']) }}" class="block rounded-btn px-4 py-3 text-sm font-medium text-text-muted transition-colors hover:bg-bg-light hover:text-accent">Онлайн-курсы</a>
                    <a href="{{ route('courses.index', ['format' => 'offline']) }}" class="block rounded-btn px-4 py-3 text-sm font-medium text-text-muted transition-colors hover:bg-bg-light hover:text-accent">Офлайн-курсы</a>
                </div>
            </div>

            @foreach(array_slice($nav, 2) as $item)
                <a href="{{ $item['url'] }}" class="flex items-center px-4 text-center text-sm font-medium text-white transition-colors hover:bg-accent-dark/55">
                    {{ $item['title'] }}
                </a>
            @endforeach
        </nav>
    </div>
</header>
