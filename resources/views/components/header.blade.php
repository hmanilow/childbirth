@php
    $phone = trim((string) ($globalSettings['phone'] ?? ''));
    $siteName = $globalSettings['site_name'] ?? 'Школа материнства рожаем вместе';
    $logoPath = $globalSettings['site_logo'] ?? '';
    $nav = [
        ['title' => 'Курсы', 'url' => route('courses.index')],
        ['title' => 'Обо мне', 'url' => route('about')],
        ['title' => 'Контакты', 'url' => route('contacts')],
    ];
@endphp

<header
    x-data="{ open: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 36 })"
    :class="scrolled ? 'bg-white/94 shadow-card' : 'bg-white/86'"
    class="fixed left-0 right-0 top-0 z-50 border-b border-border-soft/80 backdrop-blur-md transition-all duration-300"
>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-24 items-center justify-between gap-5">
            <a href="{{ route('home') }}" class="flex min-w-0 flex-shrink-0 items-center gap-4">
                @if($logoPath !== '')
                    <img src="{{ Storage::url($logoPath) }}" alt="{{ $siteName }}" class="h-16 w-auto rounded-full bg-white shadow-glow">
                @else
                    <img
                        src="{{ asset('images/site/maternity-logo-11.svg') }}"
                        alt="{{ $siteName }}"
                        class="h-16 w-16 rounded-full border-4 border-white bg-white object-cover object-center p-1 shadow-glow sm:h-[72px] sm:w-[72px]"
                    >
                @endif
                <div class="hidden min-w-0 flex-col sm:flex">
                    <span class="font-heading text-xl font-bold leading-tight text-text-heading lg:text-2xl">Школа материнства</span>
                    <span class="text-sm font-semibold uppercase tracking-widest text-accent">рожаем вместе</span>
                </div>
            </a>

            <nav class="hidden items-center gap-2 lg:flex">
                @foreach($nav as $item)
                    <a
                        href="{{ $item['url'] }}"
                        class="rounded-btn px-4 py-2 text-sm font-medium text-text-muted transition-colors duration-200 hover:bg-bg-light hover:text-accent"
                    >
                        {{ $item['title'] }}
                    </a>
                @endforeach
            </nav>

            <div class="hidden items-center gap-4 lg:flex">
                @if($phone !== '')
                    <a href="tel:{{ preg_replace('/[^+\d]/', '', $phone) }}" class="text-sm font-medium text-text-muted transition-colors duration-200 hover:text-accent">
                        {{ $phone }}
                    </a>
                @endif
                <a href="{{ route('contacts') }}#form" class="btn-accent text-sm">
                    Подобрать курс
                </a>
            </div>

            <button
                @click="open = !open"
                class="rounded-btn p-2 text-text-muted transition-colors duration-200 hover:bg-bg-light hover:text-accent lg:hidden"
                :aria-expanded="open"
                aria-label="Открыть меню"
            >
                <svg x-show="!open" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="border-t border-border-soft bg-white/96 backdrop-blur-md lg:hidden"
        @click.outside="open = false"
    >
        <div class="mx-auto max-w-7xl space-y-1 px-4 py-4">
            @foreach($nav as $item)
                <a href="{{ $item['url'] }}" class="block rounded-btn px-4 py-3 text-text-muted transition-colors duration-200 hover:bg-bg-light hover:text-text-primary">
                    {{ $item['title'] }}
                </a>
            @endforeach

            <div class="space-y-3 border-t border-border-soft pt-4">
                @if($phone !== '')
                    <a href="tel:{{ preg_replace('/[^+\d]/', '', $phone) }}" class="block px-4 py-2 text-text-muted transition-colors duration-200 hover:text-accent">
                        {{ $phone }}
                    </a>
                @endif
                <a href="{{ route('contacts') }}#form" class="btn-accent block w-full text-center">
                    Подобрать курс
                </a>
            </div>
        </div>
    </div>
</header>
