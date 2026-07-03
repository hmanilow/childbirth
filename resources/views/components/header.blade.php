@php
    $phone = trim((string) ($globalSettings['phone'] ?? ''));
    $siteName = $globalSettings['site_name'] ?? 'Школа материнства «Рожаем вместе»';
    $logoPath = $globalSettings['site_logo'] ?? '';
    $nav = [
        ['title' => 'Наши специалисты', 'url' => route('about')],
        ['title' => 'Акции и новости', 'url' => route('news.index')],
        ['title' => 'Сопровождение в родах / Доула', 'url' => route('doulas')],
        ['title' => 'Услуги после родов', 'url' => route('services.index')],
        ['title' => 'Отзывы', 'url' => route('reviews')],
    ];
@endphp

<header
    x-data="{ open: false, coursesOpen: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 36 })"
    :class="scrolled ? 'bg-bg-card/[0.96] shadow-card' : 'bg-bg-card/[0.90]'"
    class="fixed left-0 right-0 top-0 z-50 border-b border-border-soft/80 backdrop-blur-md transition-all duration-300"
>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-28 items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="flex min-w-0 flex-shrink-0 items-center gap-4">
                @if($logoPath !== '')
                    <img src="{{ Storage::url($logoPath) }}" alt="{{ $siteName }}" class="h-24 w-auto object-contain drop-shadow-lg sm:h-28">
                @else
                    <img src="{{ asset('images/site/maternity-logo-web.svg') }}" alt="{{ $siteName }}" class="h-24 w-auto object-contain drop-shadow-lg sm:h-28">
                @endif
                <span class="hidden min-w-0 sm:block">
                    <span class="block font-heading text-xl font-bold leading-tight text-text-heading lg:text-2xl">Школа материнства</span>
                    <span class="block text-sm font-semibold uppercase tracking-widest text-accent lg:text-base">рожаем вместе</span>
                </span>
            </a>

            <div class="hidden items-center gap-8 xl:flex">
                @if($phone !== '')
                    <a href="tel:{{ preg_replace('/[^+\d]/', '', $phone) }}" class="text-center transition-colors hover:text-accent">
                        <span class="block text-base font-semibold text-text-heading">{{ $phone }}</span>
                        <span class="mt-1 block text-xs text-text-muted">Позвонить нам</span>
                    </a>
                @endif
                <p class="text-sm font-semibold text-text-muted">Работаем без выходных!</p>
                <a href="{{ route('contacts') }}#form" class="btn-accent text-sm">Подобрать курс</a>
            </div>

            <button
                @click="open = !open"
                class="rounded-btn p-2 text-text-muted transition-colors hover:bg-bg-light hover:text-accent xl:hidden"
                :aria-expanded="open"
                aria-controls="mobile-navigation"
                aria-label="Открыть меню"
            >
                <svg x-show="!open" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" x-cloak class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <div class="hidden border-t border-border-soft/70 bg-accent xl:block">
        <nav class="mx-auto flex h-12 max-w-7xl items-stretch justify-center px-4" aria-label="Основная навигация">
            @foreach(array_slice($nav, 0, 2) as $item)
                <a href="{{ $item['url'] }}" class="flex items-center px-4 text-center text-sm font-medium text-white transition-colors hover:bg-accent-dark/55">
                    {{ $item['title'] }}
                </a>
            @endforeach

            <div class="group relative flex" @mouseenter="coursesOpen = true" @mouseleave="coursesOpen = false">
                <button
                    type="button"
                    @click="coursesOpen = !coursesOpen"
                    :aria-expanded="coursesOpen"
                    class="flex items-center gap-2 px-4 text-sm font-medium text-white transition-colors hover:bg-accent-dark/55"
                >
                    Курсы и абонементы
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

    <div
        id="mobile-navigation"
        x-show="open"
        x-cloak
        x-transition
        @click.outside="open = false"
        class="max-h-[calc(100vh-7rem)] overflow-y-auto border-t border-border-soft bg-bg-card/[0.98] backdrop-blur-md xl:hidden"
    >
        <nav class="mx-auto max-w-7xl space-y-1 px-4 py-4" aria-label="Мобильная навигация">
            @foreach(array_slice($nav, 0, 2) as $item)
                <a href="{{ $item['url'] }}" @click="open = false" class="block rounded-btn px-4 py-3 text-text-muted transition-colors hover:bg-bg-light hover:text-text-primary">{{ $item['title'] }}</a>
            @endforeach

            <button type="button" @click="coursesOpen = !coursesOpen" class="flex w-full items-center justify-between rounded-btn px-4 py-3 text-left text-text-muted transition-colors hover:bg-bg-light hover:text-text-primary">
                <span>Курсы и абонементы</span>
                <svg class="h-4 w-4 transition-transform" :class="coursesOpen && 'rotate-180'" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                </svg>
            </button>
            <div x-show="coursesOpen" x-collapse x-cloak class="ml-4 border-l border-border-soft pl-3">
                <a href="{{ route('courses.index', ['format' => 'online']) }}" @click="open = false" class="block rounded-btn px-4 py-3 text-sm text-text-muted hover:bg-bg-light hover:text-accent">Онлайн-курсы</a>
                <a href="{{ route('courses.index', ['format' => 'offline']) }}" @click="open = false" class="block rounded-btn px-4 py-3 text-sm text-text-muted hover:bg-bg-light hover:text-accent">Офлайн-курсы</a>
            </div>

            @foreach(array_slice($nav, 2) as $item)
                <a href="{{ $item['url'] }}" @click="open = false" class="block rounded-btn px-4 py-3 text-text-muted transition-colors hover:bg-bg-light hover:text-text-primary">{{ $item['title'] }}</a>
            @endforeach

            <div class="space-y-3 border-t border-border-soft pt-4">
                @if($phone !== '')
                    <a href="tel:{{ preg_replace('/[^+\d]/', '', $phone) }}" class="block px-4 py-2 font-medium text-text-heading">{{ $phone }}</a>
                @endif
                <p class="px-4 text-sm font-semibold text-text-muted">Работаем без выходных!</p>
                <a href="{{ route('contacts') }}#form" @click="open = false" class="btn-accent block w-full text-center">Подобрать курс</a>
            </div>
        </nav>
    </div>
</header>
