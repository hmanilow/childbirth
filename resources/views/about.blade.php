@extends('layouts.app')

@section('title', 'Наши специалисты — Школа материнства «Рожаем вместе»')
@section('description', 'Елена Тимофеева, семейный психолог Вячеслав и доула Екатерина — специалисты школы материнства «Рожаем вместе».')
@section('og_title', 'Наши специалисты — Школа материнства «Рожаем вместе»')
@section('og_description', 'Познакомьтесь с командой школы: подготовка к родам, семейная психология и бережное сопровождение.')

@section('content')
@php
    $specialists = [
        [
            'id' => 'elena',
            'name' => 'Елена Тимофеева',
            'role' => 'Основатель и руководитель школы',
            'image' => 'images/site/elena-about.webp',
            'image_position' => 'object-top',
            'summary' => 'Многодетная мама, профессиональная доула, помощница в родах и специалист по подготовке семьи к материнству.',
        ],
        [
            'id' => 'vyacheslav',
            'name' => 'Вячеслав',
            'role' => 'Семейный психолог',
            'image' => 'images/site/vyacheslav-specialist.webp',
            'image_position' => 'object-top',
            'summary' => 'Многодетный отец и семейный психолог. Помогает парам выстраивать диалог и готовиться к изменениям до и после рождения ребёнка.',
        ],
        [
            'id' => 'ekaterina',
            'name' => 'Екатерина',
            'role' => 'Доула школы',
            'image' => 'images/site/ekaterina-specialist.webp',
            'image_position' => 'object-top',
            'summary' => 'Бережно сопровождает женщину в родах, создавая спокойную атмосферу и поддерживая её собственный темп и выбор.',
        ],
    ];
@endphp

<section class="min-h-[70vh] bg-gradient-hero pb-20 pt-44" x-data="{ active: 'elena' }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="section-eyebrow">Команда школы</span>
            <h1 class="section-heading mt-2">Наши специалисты</h1>
            <p class="section-subheading text-base leading-relaxed sm:text-lg">
                Люди, которые помогают семьям готовиться к родам, проживать перемены с большей опорой и бережно входить в новый этап жизни.
            </p>
        </div>

        <div class="mt-12 grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($specialists as $specialist)
                <article
                    class="group flex h-full flex-col overflow-hidden rounded-card border bg-bg-card shadow-card transition duration-300 hover:-translate-y-1 hover:shadow-card-hover"
                    :class="active === '{{ $specialist['id'] }}' ? 'border-accent/60' : 'border-border-soft'"
                >
                    <div class="aspect-[4/5] overflow-hidden bg-gradient-card-muted">
                        <img
                            src="{{ asset($specialist['image']) }}"
                            alt="{{ $specialist['name'] }}, {{ mb_strtolower($specialist['role']) }}"
                            class="h-full w-full object-cover {{ $specialist['image_position'] }} transition duration-500 group-hover:scale-[1.025]"
                            loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                        >
                    </div>
                    <div class="flex flex-1 flex-col p-6">
                        <h2 class="font-heading text-2xl font-bold text-text-heading">{{ $specialist['name'] }}</h2>
                        <p class="mt-2 text-sm font-semibold text-accent">{{ $specialist['role'] }}</p>
                        <p class="mt-4 flex-1 text-sm leading-relaxed text-text-muted">{{ $specialist['summary'] }}</p>
                        <button
                            type="button"
                            class="btn-outline btn-sm mt-6 w-full"
                            :class="active === '{{ $specialist['id'] }}' ? 'border-accent bg-accent/10 text-accent' : ''"
                            :aria-expanded="active === '{{ $specialist['id'] }}'"
                            aria-controls="specialist-details"
                            @click="active = '{{ $specialist['id'] }}'; $nextTick(() => $refs.details.scrollIntoView({ behavior: 'smooth', block: 'start' }))"
                        >
                            Подробнее
                        </button>
                    </div>
                </article>
            @endforeach
        </div>

        <div id="specialist-details" x-ref="details" class="scroll-mt-40 pt-10">
            <article
                x-show="active === 'elena'"
                x-collapse
                class="overflow-hidden rounded-card border border-border-soft bg-bg-card shadow-card-hover"
            >
                <div class="grid gap-0 lg:grid-cols-[0.75fr_1.25fr]">
                    <div class="bg-bg-warm p-7 sm:p-10 lg:p-12">
                        <span class="section-eyebrow">Основатель школы</span>
                        <h2 class="mt-3 font-heading text-3xl font-bold text-text-heading sm:text-4xl">Елена Тимофеева</h2>
                        <p class="mt-5 leading-relaxed text-text-muted">
                            Меня зовут Елена. Я многодетная мама, основатель и руководитель школы материнства «Рожаем вместе».
                        </p>
                        <p class="mt-4 leading-relaxed text-text-muted">
                            Я объединила свои знания, чтобы материнство начиналось с большей ясностью, спокойствием и радостью.
                        </p>
                    </div>
                    <div class="p-7 sm:p-10 lg:p-12">
                        <h3 class="font-heading text-2xl font-bold text-text-heading">Профессиональные направления</h3>
                        <ul class="mt-6 grid gap-3 sm:grid-cols-2">
                            @foreach([
                                'Профессиональная доула и помощница в родах',
                                'Консультант по материнству и детскому здоровью',
                                'Инструктор по подготовке к родам',
                                'Фитнес-инструктор для беременных',
                                'Детский психолог-консультант',
                                'Специалист по коррекции детского сна',
                                'Консультант по прикорму',
                                'Перинатальный психолог',
                                'Детский нейропсихолог',
                            ] as $qualification)
                                <li class="flex gap-3 text-sm leading-relaxed text-text-muted">
                                    <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-gold/20 text-xs font-bold text-gold-dark">✓</span>
                                    <span>{{ $qualification }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-8 border-t border-border-soft pt-7">
                            <h3 class="font-heading text-xl font-bold text-text-heading">Дополнительное обучение</h3>
                            <p class="mt-4 leading-relaxed text-text-muted">
                                Елена прошла обучение расслаблению с помощью мексиканского ребозо, остеопатическому подходу в помощи беременной и рожающей женщине, а также тейпированию в первые часы после родов.
                            </p>
                        </div>
                    </div>
                </div>
            </article>

            <article
                x-show="active === 'vyacheslav'"
                x-collapse
                x-cloak
                class="overflow-hidden rounded-card border border-border-soft bg-bg-card shadow-card-hover"
            >
                <div class="grid gap-0 lg:grid-cols-[0.75fr_1.25fr]">
                    <div class="bg-bg-warm p-7 sm:p-10 lg:p-12">
                        <span class="section-eyebrow">Семейная психология</span>
                        <h2 class="mt-3 font-heading text-3xl font-bold text-text-heading sm:text-4xl">Вячеслав</h2>
                        <p class="mt-5 leading-relaxed text-text-muted">
                            Вячеслав — многодетный отец и семейный психолог. Он помогает парам преодолевать кризисы, разрешать конфликты и выстраивать более ясную и бережную коммуникацию.
                        </p>
                        <p class="mt-4 leading-relaxed text-text-muted">
                            В перинатальный период его задача — помочь мужчине стать уверенным помощником и эмоциональной опорой для партнёрши.
                        </p>
                    </div>
                    <div class="space-y-8 p-7 sm:p-10 lg:p-12">
                        <section>
                            <h3 class="font-heading text-2xl font-bold text-text-heading">Направления работы</h3>
                            <ul class="mt-5 space-y-3">
                                <li class="leading-relaxed text-text-muted"><strong class="text-text-heading">Семейное и супружеское консультирование.</strong> Помощь в преодолении кризисов, разрешении конфликтов и налаживании общения в паре.</li>
                                <li class="leading-relaxed text-text-muted"><strong class="text-text-heading">Индивидуальная терапия.</strong> Работа с выгоранием, неуверенностью, тревожностью, внутренними конфликтами и поиском опоры.</li>
                                <li class="leading-relaxed text-text-muted"><strong class="text-text-heading">Детско-родительские отношения.</strong> Понимание потребностей детей, доверительные отношения и прохождение возрастных кризисов.</li>
                            </ul>
                        </section>

                        <section class="border-t border-border-soft pt-8">
                            <h3 class="font-heading text-2xl font-bold text-text-heading">Подготовка к партнёрским родам</h3>
                            <p class="mt-4 leading-relaxed text-text-muted">
                                Партнёрские роды требуют не формального присутствия, а осознанного участия. Вячеслав помогает разобраться в этапах родов, проверить собственную мотивацию и проработать страх боли, крови или ощущения беспомощности.
                            </p>
                        </section>

                        <section class="border-t border-border-soft pt-8">
                            <h3 class="font-heading text-2xl font-bold text-text-heading">Поддержка во время родов</h3>
                            <p class="mt-4 leading-relaxed text-text-muted">
                                Партнёр учится создавать для женщины спокойное пространство, брать на себя коммуникацию с внешним миром и поддерживать её решения, не мешая сосредоточиться на собственных ощущениях и работе тела.
                            </p>
                        </section>

                        <section class="border-t border-border-soft pt-8">
                            <h3 class="font-heading text-2xl font-bold text-text-heading">После рождения ребёнка</h3>
                            <p class="mt-4 leading-relaxed text-text-muted">
                                Психологическая поддержка помогает отцу справляться с недосыпом, перегрузкой, тревогой и новой ответственностью. Активное участие в купании, укладывании и ежедневном уходе укрепляет контакт с ребёнком и снижает нагрузку на маму.
                            </p>
                        </section>

                        <section class="border-t border-border-soft pt-8">
                            <h3 class="font-heading text-2xl font-bold text-text-heading">Когда особенно полезна консультация</h3>
                            <ul class="mt-5 grid gap-3 sm:grid-cols-2">
                                @foreach([
                                    'Мужчина сомневается, готов ли присутствовать на родах',
                                    'В паре накопились конфликты или напряжение',
                                    'Есть сильная тревога или страх медицинской обстановки',
                                    'После рождения ребёнка семье трудно адаптироваться к новым ролям',
                                ] as $reason)
                                    <li class="flex gap-3 text-sm leading-relaxed text-text-muted">
                                        <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-gold/20 text-xs font-bold text-gold-dark">✓</span>
                                        <span>{{ $reason }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <p class="mt-6 leading-relaxed text-text-muted">
                                Вячеслав не предлагает универсальных решений, а создаёт безопасное пространство для диалога, в котором пара может найти собственный путь.
                            </p>
                        </section>
                    </div>
                </div>
            </article>

            <article
                x-show="active === 'ekaterina'"
                x-collapse
                x-cloak
                class="overflow-hidden rounded-card border border-border-soft bg-bg-card shadow-card-hover"
            >
                <div class="grid gap-0 lg:grid-cols-[0.75fr_1.25fr]">
                    <div class="bg-bg-warm p-7 sm:p-10 lg:p-12">
                        <span class="section-eyebrow">Бережное сопровождение</span>
                        <h2 class="mt-3 font-heading text-3xl font-bold text-text-heading sm:text-4xl">Екатерина</h2>
                        <p class="mt-5 leading-relaxed text-text-muted">
                            Я рядом с женщиной в один из самых важных моментов её жизни — во время родов.
                        </p>
                        <p class="mt-4 leading-relaxed text-text-muted">
                            Сопровождаю этот путь бережно, без давления и лишних ожиданий. Для меня важно, чтобы женщина чувствовала себя в безопасности, была услышана и могла прожить свой опыт в собственном темпе и ритме.
                        </p>
                    </div>
                    <div class="p-7 sm:p-10 lg:p-12">
                        <h3 class="font-heading text-2xl font-bold text-text-heading">Как я поддерживаю</h3>
                        <ul class="mt-6 space-y-4">
                            @foreach([
                                'Эмоциональная поддержка без оценок и давления',
                                'Создание спокойной и уютной атмосферы',
                                'Физическая поддержка во время схваток: дыхание, положения тела и ароматерапия',
                                'Присутствие, в котором можно расслабиться и быть собой',
                            ] as $support)
                                <li class="flex gap-3 leading-relaxed text-text-muted">
                                    <span class="mt-1 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-gold/20 text-xs font-bold text-gold-dark">✓</span>
                                    <span>{{ $support }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
@endsection
