@php
    $phone = $globalSettings['phone'] ?? '+7 (999) 000-00-00';
    $siteName = $globalSettings['site_name'] ?? 'Школа материнства';
    $nav = [
        ['title' => 'Обо мне', 'url' => route('about')],
        ['title' => 'Доула', 'url' => route('doula')],
        ['title' => 'Подготовка', 'url' => '#', 'children' => [
            ['title' => 'Подготовка к родам', 'url' => route('birth-prep')],
            ['title' => 'Партнерские роды', 'url' => route('partner-birth')],
            ['title' => 'Школа материнства', 'url' => route('school')],
        ]],
        ['title' => 'Курсы', 'url' => route('courses.index')],
        ['title' => 'Новости', 'url' => route('news.index')],
        ['title' => 'Партнеры', 'url' => route('partners')],
        ['title' => 'Цены', 'url' => route('prices')],
        ['title' => 'Контакты', 'url' => route('contacts')],
    ];
@endphp

<header
    x-data="{ open: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
    :class="scrolled ? 'bg-bg-base/90 shadow-card' : 'bg-bg-base/80'"
    class="fixed left-0 right-0 top-0 z-50 border-b border-border-soft/70 backdrop-blur-md transition-all duration-300"
>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            <a href="{{ route('home') }}" class="flex min-w-0 flex-shrink-0 items-center gap-3">
                @if(!empty($globalSettings['logo']))
                    <img src="{{ Storage::url($globalSettings['logo']) }}" alt="{{ $siteName }}" class="h-12 w-auto">
                @else
                    <img
                        src="{{ asset('images/site/maternity-logo-11.svg') }}"
                        alt="{{ $siteName }}"
                        class="h-12 w-12 rounded-full border border-border-soft bg-white object-cover object-center p-1 shadow-card"
                    >
                    <div class="flex min-w-0 flex-col">
                        <span class="truncate font-heading text-xl font-bold leading-tight text-text-primary">{{ $siteName }}</span>
                        <span class="text-xs font-medium uppercase tracking-widest text-accent">Доула · подготовка к родам</span>
                    </div>
                @endif
            </a>

            <nav class="hidden items-center gap-1 lg:flex">
                @foreach($nav as $item)
                    @if(!empty($item['children']))
                        <div class="relative group" x-data="{ expanded: false }">
                            <button
                                @click="expanded = !expanded"
                                @click.outside="expanded = false"
                                class="flex items-center gap-1 rounded-btn px-3 py-2 text-sm text-text-muted transition-colors duration-200 hover:bg-bg-light hover:text-text-primary group-hover:text-accent"
                            >
                                {{ $item['title'] }}
                                <svg class="h-4 w-4 transition-transform duration-200" :class="expanded ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div
                                x-show="expanded"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-1"
                                class="absolute left-0 top-full mt-2 w-56 overflow-hidden rounded-card border border-border-soft bg-bg-card/95 shadow-card backdrop-blur-md"
                            >
                                @foreach($item['children'] as $child)
                                    <a
                                        href="{{ $child['url'] }}"
                                        class="block border-b border-border-soft px-4 py-3 text-sm text-text-muted transition-colors duration-200 last:border-0 hover:bg-bg-light hover:text-text-primary"
                                    >{{ $child['title'] }}</a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a
                            href="{{ $item['url'] }}"
                            class="relative rounded-btn px-3 py-2 text-sm text-text-muted transition-colors duration-200 hover:bg-bg-light hover:text-accent"
                        >
                            {{ $item['title'] }}
                        </a>
                    @endif
                @endforeach
            </nav>

            <div class="hidden items-center gap-4 lg:flex">
                <a href="tel:{{ preg_replace('/[^+\d]/', '', $phone) }}" class="text-sm text-text-muted transition-colors duration-200 hover:text-accent">
                    {{ $phone }}
                </a>
                <a href="{{ route('contacts') }}#form" class="btn-accent text-sm">
                    Записаться
                </a>
            </div>

            <button
                @click="open = !open"
                class="rounded-btn p-2 text-text-muted transition-colors duration-200 hover:bg-bg-light hover:text-accent lg:hidden"
                :aria-expanded="open"
                aria-label="Открыть меню"
            >
                <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
        class="border-t border-border-soft bg-bg-card/95 backdrop-blur-md lg:hidden"
        @click.outside="open = false"
    >
        <div class="mx-auto max-w-7xl space-y-1 px-4 py-4">
            @foreach($nav as $item)
                @if(!empty($item['children']))
                    <div x-data="{ expanded: false }">
                        <button @click="expanded = !expanded" class="flex w-full items-center justify-between rounded-btn px-4 py-3 text-text-muted transition-colors duration-200 hover:bg-bg-light hover:text-text-primary">
                            <span>{{ $item['title'] }}</span>
                            <svg class="h-4 w-4 transition-transform duration-200" :class="expanded ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="expanded" class="ml-4 mt-1 space-y-1">
                            @foreach($item['children'] as $child)
                                <a href="{{ $child['url'] }}" class="block px-4 py-2 text-sm text-text-muted transition-colors duration-200 hover:text-accent">
                                    {{ $child['title'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ $item['url'] }}" class="block rounded-btn px-4 py-3 text-text-muted transition-colors duration-200 hover:bg-bg-light hover:text-text-primary">
                        {{ $item['title'] }}
                    </a>
                @endif
            @endforeach

            <div class="space-y-3 border-t border-border-soft pt-4">
                <a href="tel:{{ preg_replace('/[^+\d]/', '', $phone) }}" class="block px-4 py-2 text-text-muted transition-colors duration-200 hover:text-accent">
                    {{ $phone }}
                </a>
                <a href="{{ route('contacts') }}#form" class="btn-accent block w-full text-center">
                    Записаться на консультацию
                </a>
            </div>
        </div>
    </div>
</header>
