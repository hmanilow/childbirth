@props([
    'name' => 'Имя Фамилия',
    'title' => 'Школа материнства рожаем вместе',
    'headline' => 'Курсы для будущих мам и пап',
    'subline' => 'Онлайн и офлайн подготовка к родам, уходу за малышом и первым месяцам семьи',
    'photo' => null,
    'stats' => [],
])

<section data-hero class="relative flex min-h-[92svh] items-center overflow-hidden bg-gradient-hero pt-44">
    @if($photo)
        <img
            src="{{ $photo }}"
            alt="{{ $name }}"
            class="absolute inset-y-0 right-0 h-full w-full object-cover opacity-25 mix-blend-multiply"
            loading="eager"
        >
    @endif

    <div class="absolute inset-0 bg-[linear-gradient(90deg,rgba(255,255,255,0.98)_0%,rgba(238,241,241,0.93)_44%,rgba(191,212,218,0.42)_100%)]"></div>
    <img
        src="{{ asset('images/site/maternity-logo-web.svg') }}"
        alt=""
        aria-hidden="true"
        class="pointer-events-none absolute right-[-7rem] top-1/2 hidden w-[42rem] -translate-y-1/2 rotate-[-3deg] opacity-[0.18] mix-blend-multiply lg:block"
    >
    <div class="pointer-events-none absolute inset-x-0 bottom-0 h-28 bg-gradient-to-t from-bg-base to-transparent"></div>

    <div class="relative mx-auto w-full max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-20">
        <div class="max-w-2xl animate-fade-up">
            <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-accent/25 bg-white/70 px-4 py-1.5 shadow-card backdrop-blur-sm">
                <span class="h-2 w-2 rounded-full bg-gold"></span>
                <span class="text-sm font-medium tracking-wide text-accent">{{ $title }}</span>
            </div>

            @if($name)
                <p class="mb-3 text-sm uppercase tracking-widest text-text-muted">{{ $name }}</p>
            @endif

            <h1 class="mb-6 font-heading text-[2rem] font-bold leading-[1.08] text-text-heading sm:text-5xl lg:text-hero">
                {!! nl2br(e($headline)) !!}
            </h1>

            <p class="mb-8 max-w-xl text-lg leading-relaxed text-text-muted">
                {{ $subline }}
            </p>

            <div class="flex flex-col gap-4 sm:flex-row">
                <a href="{{ route('contacts') }}#form" class="btn-accent btn-lg">
                    Подобрать курс
                </a>
                <a href="{{ route('courses.index') }}" class="btn-outline btn-lg">
                    Смотреть курсы
                </a>
            </div>

            @if(!empty($stats))
                <div class="mt-10 grid max-w-xl grid-cols-3 gap-5 border-t border-border-soft pt-6">
                    @foreach($stats as $stat)
                        <div>
                            <div class="font-heading text-2xl font-bold text-gold-dark">{{ $stat['value'] }}</div>
                            <div class="mt-1 text-xs leading-snug text-text-muted">{{ $stat['label'] }}</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
