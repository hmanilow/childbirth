@extends('layouts.app')

@php
    $specialistName = $globalSettings['specialist_name'] ?? 'Елена Тимофеева';
    $sleepSupport = [
        'Наладить сон ребёнка и выстроить подходящий режим дня.',
        'Уйти от привычных ассоциаций на засыпание и поменять место сна.',
        'Мягко обучить ребёнка самостоятельному засыпанию с опорой на бесслёзные методики.',
        'Выстроить личные границы и комфортный ритм семьи.',
    ];
    $motherhoodSupport = [
        'Подготовка к беременности, родам и первым неделям после рождения малыша.',
        'Поддержка во время беременности и после родов.',
        'Помощь с грудным вскармливанием и его мягким завершением.',
        'Уход за ребёнком и питание детей первого года жизни.',
    ];
    $doulaSupport = [
        'С 36-й недели я на связи 24/7: консультирую, отвечаю на вопросы и помогаю подготовиться к родам.',
        'Остаюсь рядом на протяжении всех родов и ещё два часа после рождения малыша.',
        'Использую немедикаментозные способы облегчения ощущений: массаж, дыхание, ароматерапию, смену положений и поз.',
        'Помогаю формулировать вопросы медицинскому персоналу, передавать пожелания и получать необходимую информацию.',
        'Поддерживаю эмоционально, объясняю этапы родов и помогаю сохранять спокойствие.',
        'По желанию делаю фото и видео на ваш телефон и поддерживаю связь с близкими.',
        'Остаюсь рядом до перевода в послеродовое отделение и помогаю с первым прикладыванием к груди.',
        'Месяц после родов остаюсь на связи по вопросам материнства, ухода за малышом и восстановления мамы.',
    ];
@endphp

@section('title', $specialistName . ' — основатель школы материнства «Рожаем вместе»')
@section('description', $specialistName . ' — основатель школы материнства «Рожаем вместе», доула, перинатальный психолог и консультант по материнству. Работа в Москве и Московской области.')
@section('og_title', $specialistName . ' — основатель школы материнства «Рожаем вместе»')
@section('og_description', 'Подготовка к родам, сопровождение в родах и послеродовая поддержка в Москве и Московской области.')

@section('content')
<section class="bg-gradient-hero pb-16 pt-44">
    <div class="mx-auto grid max-w-6xl items-center gap-10 px-4 sm:px-6 lg:grid-cols-[0.9fr_1.1fr] lg:px-8">
        <div class="mx-auto w-full max-w-md lg:mx-0">
            <div class="overflow-hidden rounded-lg border border-accent/20 bg-bg-card shadow-card-hover">
                <img
                    src="{{ asset('images/site/elena-about.webp') }}"
                    alt="Елена Тимофеева, основатель школы материнства «Рожаем вместе»"
                    class="aspect-[4/5] w-full object-cover object-top"
                >
            </div>
        </div>

        <div class="min-w-0">
            <span class="section-eyebrow">Обо мне</span>
            <h1 class="mt-2 font-heading text-4xl font-bold leading-tight text-text-heading lg:text-5xl">
                {{ $specialistName }} — основатель и автор школы материнства «Рожаем вместе»
            </h1>
            <div class="mt-6 space-y-4 text-base leading-relaxed text-text-muted sm:text-lg">
                <p>
                    Меня зовут Елена. Я мама трёх дочерей, профессиональная родовая и послеродовая доула, консультант по детскому сну, материнству и детскому здоровью.
                </p>
                <p>
                    Я также работаю как инструктор по подготовке к родам, перинатальный психолог и детский нейропсихолог. Помогаю семьям на этапе планирования беременности, во время беременности, в родах и после рождения ребёнка, включая послеродовое восстановление с помощью ребозо.
                </p>
            </div>
            <div class="mt-6 inline-flex items-center gap-3 rounded-full border border-gold/30 bg-gold/15 px-4 py-2 text-sm font-semibold text-gold-dark">
                Москва и Московская область
            </div>
            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                <a href="{{ route('courses.index') }}" class="btn-accent btn-lg">Смотреть курсы</a>
                <a href="{{ route('contacts') }}#form" class="btn-outline btn-lg">Задать вопрос</a>
            </div>
        </div>
    </div>
</section>

<section class="bg-bg-base py-16">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="section-eyebrow">Направления работы</span>
            <h2 class="section-heading mt-2">Поддержка на каждом этапе материнства</h2>
            <p class="section-subheading text-base leading-relaxed sm:text-lg">
                От подготовки к беременности и родам до сна ребёнка, грудного вскармливания и восстановления мамы.
            </p>
        </div>

        <div class="mt-10 grid gap-6 lg:grid-cols-2">
            <article class="rounded-lg border border-border-soft bg-bg-card p-6 shadow-card sm:p-8">
                <p class="text-xs font-semibold uppercase tracking-widest text-accent">Детский сон</p>
                <h3 class="mt-3 font-heading text-2xl font-bold text-text-heading">Консультации по сну</h3>
                <ul class="mt-5 space-y-3">
                    @foreach($sleepSupport as $item)
                        <li class="flex gap-3 text-sm leading-relaxed text-text-muted sm:text-base">
                            <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-gold/20 text-xs font-bold text-gold-dark">✓</span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </article>

            <article class="rounded-lg border border-border-soft bg-bg-card p-6 shadow-card sm:p-8">
                <p class="text-xs font-semibold uppercase tracking-widest text-accent">Материнство</p>
                <h3 class="mt-3 font-heading text-2xl font-bold text-text-heading">Здоровье мамы и малыша</h3>
                <ul class="mt-5 space-y-3">
                    @foreach($motherhoodSupport as $item)
                        <li class="flex gap-3 text-sm leading-relaxed text-text-muted sm:text-base">
                            <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-gold/20 text-xs font-bold text-gold-dark">✓</span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </article>
        </div>
    </div>
</section>

<section class="bg-bg-warm py-16">
    <div class="mx-auto grid max-w-6xl gap-8 px-4 sm:px-6 lg:grid-cols-[0.8fr_1.2fr] lg:px-8">
        <div>
            <span class="section-eyebrow">Подготовка к родам</span>
            <h2 class="section-heading mt-2">Практика, которая даёт опору</h2>
            <p class="mt-5 text-base leading-relaxed text-text-muted">
                На занятиях мы отрабатываем дыхательные техники, удобные позиции в родах, партнёрскую поддержку и массажные приёмы, а также бережно работаем со страхами и ожиданиями.
            </p>
            <p class="mt-5 text-base leading-relaxed text-text-muted">
                Формат работы можно выбрать под задачу семьи: от разовой консультации до постоянного сопровождения мамы и близких.
            </p>
        </div>

        <article class="rounded-lg border border-accent/20 bg-bg-card p-6 shadow-card-hover sm:p-8">
            <p class="text-xs font-semibold uppercase tracking-widest text-accent">Сопровождение в родах</p>
            <h3 class="mt-3 font-heading text-3xl font-bold text-text-heading">Как я помогаю как доула</h3>
            <ul class="mt-6 grid gap-4 md:grid-cols-2">
                @foreach($doulaSupport as $item)
                    <li class="flex gap-3 text-sm leading-relaxed text-text-muted">
                        <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-accent/15 text-xs font-bold text-accent">✓</span>
                        <span>{{ $item }}</span>
                    </li>
                @endforeach
            </ul>
            <div class="mt-8 border-t border-border-soft pt-6">
                <p class="text-base font-semibold text-text-heading">Буду рада помочь и ответить на ваши вопросы.</p>
                <p class="mt-2 text-sm leading-relaxed text-text-muted">
                    Выезжаю по Москве и Московской области. Во время сопровождения позабочусь и о простых вещах: помогу отдохнуть, поесть и восстановить силы тёплым послеродовым чаем.
                </p>
            </div>
        </article>
    </div>
</section>
@endsection
