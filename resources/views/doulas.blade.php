@extends('layouts.app')

@php
    $specialistName = $globalSettings['specialist_name'] ?? 'Елена Тимофеева';
    $doulas = [
        [
            'initials' => 'ЕТ',
            'name' => $specialistName,
            'role' => 'Основатель школы, доула',
            'image' => 'images/site/elena-doula.webp',
            'image_position' => 'object-center',
            'description' => 'Меня зовут Елена. Я мама трёх дочерей, основатель школы «Рожаем вместе» и профессиональная доула. Также я консультирую по детскому сну, материнству и детскому здоровью, готовлю к родам, сопровождаю после родов, работаю как перинатальный психолог и детский нейропсихолог.',
            'packages_anchor' => 'elena-packages',
        ],
        [
            'initials' => 'А',
            'name' => 'Аделина',
            'role' => 'Доула школы',
            'image' => 'images/site/adelina-doula.jpg',
            'image_position' => 'object-center',
            'description' => 'Меня зовут Аделина. Я мама погодок и доула по призванию души. Пройдя собственный путь материнства, я поняла, что поддержка женщины в родах — моё истинное дело. Моя цель — помочь вам чувствовать себя защищённо, уверенно и спокойно в этот важный момент.',
            'packages_anchor' => 'adelina-package',
        ],
        [
            'initials' => 'Д',
            'name' => 'Доула школы',
            'role' => 'Специалист школы',
            'image' => null,
            'image_position' => '',
            'description' => 'Анкета скоро будет заполнена.',
            'packages_anchor' => null,
        ],
    ];

    $elenaPackages = [
        [
            'name' => 'Базовый',
            'price' => '45 000 ₽',
            'featured' => false,
            'items' => [
                'Связь и консультации с 36-й недели.',
                'Подготовка к родам и ответы на возникающие вопросы.',
                'Сопровождение на протяжении всех родов.',
            ],
        ],
        [
            'name' => 'Премиум',
            'price' => '55 000 ₽',
            'featured' => true,
            'items' => [
                'Связь с 36-й недели и сопровождение родов.',
                'Безлимитные консультации.',
                'Один выезд после родов.',
                'Поддержка в течение месяца после рождения малыша.',
                'Консультации по сну, грудному вскармливанию, уходу за малышом и восстановлению мамы.',
            ],
        ],
        [
            'name' => 'VIP',
            'price' => '70 000 ₽',
            'featured' => false,
            'items' => [
                'Связь с 36-й недели и сопровождение родов.',
                'Безлимитные консультации.',
                'Два выезда после родов.',
                'Поддержка в течение трёх месяцев после рождения малыша.',
                'Консультации по сну, грудному вскармливанию, уходу за малышом и восстановлению мамы.',
            ],
        ],
    ];
@endphp

@section('title', 'Наши доулы — сопровождение родов в Москве и Московской области')
@section('description', 'Доулы школы материнства «Рожаем вместе»: сопровождение беременности и родов в Москве и Московской области. Пакеты Елены Тимофеевой и Аделины.')
@section('og_title', 'Наши доулы — Школа материнства «Рожаем вместе»')
@section('og_description', 'Познакомьтесь с доулами школы и выберите пакет сопровождения родов в Москве и Московской области.')

@section('content')
<section class="bg-gradient-hero pb-16 pt-44">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl animate-fade-up">
            <span class="section-eyebrow">Команда школы</span>
            <h1 class="mt-2 font-heading text-4xl font-bold leading-tight text-text-heading sm:text-5xl lg:text-hero">
                Наши доулы
            </h1>
            <p class="mt-5 max-w-2xl text-base leading-relaxed text-text-muted sm:text-lg">
                Специалисты школы, которые помогают пройти беременность, роды и первые месяцы материнства с большей опорой и спокойствием.
            </p>
            <p class="mt-3 text-sm font-semibold text-gold-dark">Москва и Московская область</p>
        </div>

        <div class="mt-12 grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($doulas as $doula)
                <article class="group flex h-full flex-col overflow-hidden rounded-card border border-border-soft bg-bg-card shadow-card transition duration-300 hover:-translate-y-1 hover:border-accent/50 hover:shadow-card-hover">
                    <div class="aspect-[4/3] overflow-hidden bg-gradient-card-muted">
                        @if($doula['image'])
                            <img
                                src="{{ asset($doula['image']) }}"
                                alt="{{ $doula['name'] }}, {{ mb_strtolower($doula['role']) }}"
                                class="h-full w-full object-cover {{ $doula['image_position'] }} transition duration-500 group-hover:scale-105"
                            >
                        @else
                            <div class="flex h-full items-center justify-center p-8">
                                <div class="flex h-24 w-24 items-center justify-center rounded-full border border-accent/25 bg-bg-card text-accent shadow-card">
                                    <span class="font-heading text-2xl font-bold">{{ $doula['initials'] }}</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="flex flex-1 flex-col p-6">
                        <h2 class="font-heading text-2xl font-bold text-text-heading">{{ $doula['name'] }}</h2>
                        <p class="mt-2 text-sm font-semibold text-accent">{{ $doula['role'] }}</p>
                        <p class="mt-4 flex-1 text-sm leading-relaxed text-text-muted">{{ $doula['description'] }}</p>
                        @if($doula['packages_anchor'])
                            <a href="#{{ $doula['packages_anchor'] }}" class="btn-outline btn-sm mt-6 w-full">
                                Пакеты сопровождения
                            </a>
                        @else
                            <button type="button" class="btn-outline btn-sm mt-6 w-full" disabled aria-disabled="true">
                                Подробнее
                            </button>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section id="elena-packages" class="scroll-mt-40 bg-bg-base py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="section-eyebrow">Елена Тимофеева</span>
            <h2 class="section-heading mt-2">Пакеты сопровождения</h2>
            <p class="section-subheading text-base leading-relaxed sm:text-lg">
                Выберите объём поддержки, который соответствует вашим ожиданиям от подготовки, родов и первых месяцев с малышом.
            </p>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-5 lg:grid-cols-3">
            @foreach($elenaPackages as $package)
                <article class="{{ $package['featured'] ? 'border-accent/60 shadow-card-hover' : 'border-border-soft shadow-card' }} flex h-full flex-col rounded-card border bg-bg-card p-6 sm:p-8">
                    @if($package['featured'])
                        <span class="mb-5 inline-flex w-fit rounded-full bg-accent/15 px-3 py-1 text-xs font-semibold uppercase tracking-widest text-accent">
                            Расширенная поддержка
                        </span>
                    @endif
                    <p class="text-sm font-semibold text-accent">{{ $package['name'] }}</p>
                    <p class="mt-3 font-heading text-4xl font-bold text-text-heading">{{ $package['price'] }}</p>
                    <ul class="mt-6 flex-1 space-y-3">
                        @foreach($package['items'] as $item)
                            <li class="flex gap-3 text-sm leading-relaxed text-text-muted">
                                <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-gold/20 text-xs font-bold text-gold-dark">✓</span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('contacts') }}#form" class="{{ $package['featured'] ? 'btn-accent' : 'btn-outline' }} mt-8 w-full">
                        Обсудить пакет
                    </a>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section id="adelina-package" class="scroll-mt-40 bg-bg-warm py-16">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <article class="grid overflow-hidden rounded-card border border-border-soft bg-bg-card shadow-card-hover lg:grid-cols-[0.7fr_1.3fr]">
            <img
                src="{{ asset('images/site/adelina-doula.jpg') }}"
                alt="Аделина, доула школы «Рожаем вместе»"
                class="h-full min-h-72 w-full object-cover object-center"
            >
            <div class="flex flex-col p-6 sm:p-8 lg:p-10">
                <span class="text-xs font-semibold uppercase tracking-widest text-accent">Аделина</span>
                <h2 class="mt-3 font-heading text-3xl font-bold text-text-heading">Сопровождение родов</h2>
                <p class="mt-4 font-heading text-4xl font-bold text-text-heading">36 000 ₽</p>
                <ul class="mt-6 grid gap-3 sm:grid-cols-3">
                    @foreach(['Связь с 36-й недели.', 'Сопровождение на протяжении родов.', 'Поддержка в течение двух часов после родов.'] as $item)
                        <li class="flex gap-3 text-sm leading-relaxed text-text-muted">
                            <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-gold/20 text-xs font-bold text-gold-dark">✓</span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
                <a href="{{ route('contacts') }}#form" class="btn-accent mt-8 w-full sm:w-fit">
                    Обсудить пакет
                </a>
            </div>
        </article>
    </div>
</section>
@endsection
