@extends('layouts.app')

@php
    $specialistName = $globalSettings['specialist_name'] ?? 'Елена Тимофеева';
    $birthPreparationItems = [
        'Выбрать родильный дом.',
        'Составить сценарий родов.',
        'Подготовиться к разным ситуациям.',
        'Потренировать дыхание.',
        'Освоить мягкие способы проживания боли без медикаментов.',
        'Проработать страхи, тревоги и внутреннее напряжение.',
    ];
    $professionalBase = [
        'Профессиональная доула и помощница в родах.',
        'Консультант по материнству и детскому здоровью.',
        'Детский психолог-консультант.',
        'Специалист по коррекции детского сна.',
        'Консультант по грудному вскармливанию.',
        'Консультант по прикорму.',
        'Перинатальный психолог.',
        'Детский нейропсихолог.',
    ];
@endphp

@section('title', $specialistName . ' — основатель школы материнства «Рожаем вместе»')
@section('description', $specialistName . ' — основатель школы материнства «Рожаем вместе», профессиональная доула, перинатальный психолог и консультант по подготовке к родам и материнству.')
@section('og_title', $specialistName . ' — основатель школы материнства «Рожаем вместе»')
@section('og_description', 'О Елене Тимофеевой: подготовка к родам, сопровождение семьи, послеродовая поддержка и профессиональная помощь в первые месяцы материнства.')

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
                {{ $specialistName }} — основатель школы материнства «Рожаем вместе»
            </h1>
            <div class="mt-6 space-y-4 text-base leading-relaxed text-text-muted sm:text-lg">
                <p>
                    Меня зовут Елена Тимофеева. Я многодетная мама, профессиональная доула, помощница в родах, основатель и руководитель школы материнства «Рожаем вместе».
                </p>
                <p>
                    Я создала эту школу, чтобы беременность, роды и первые месяцы материнства начинались не со страха и растерянности, а с понимания, спокойствия и уверенности.
                </p>
                <p>
                    Моя задача — быть рядом с женщиной и семьёй на одном из самых важных этапов жизни: от подготовки к родам до первых недель после появления малыша.
                </p>
                <p class="font-semibold text-text-heading">Я не просто прихожу на роды. Я сопровождаю вас на всём пути.</p>
            </div>
            <div class="mt-6 inline-flex items-center rounded-full border border-gold/30 bg-gold/15 px-4 py-2 text-sm font-semibold text-gold-dark">
                Москва и Московская область
            </div>
            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                <a href="{{ route('courses.index') }}" class="btn-accent btn-lg">Смотреть курсы</a>
                <a href="{{ route('contacts') }}#form" class="btn-outline btn-lg">Задать вопрос</a>
            </div>
        </div>
    </div>
</section>

<section class="bg-bg-base py-16" aria-labelledby="birth-preparation-title">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="section-eyebrow">Как я помогаю</span>
            <h2 id="birth-preparation-title" class="section-heading mt-2">Подготовка к родам</h2>
        </div>

        <div class="mt-8 grid gap-10 lg:grid-cols-[1fr_0.9fr] lg:gap-16">
            <div class="space-y-4 text-base leading-relaxed text-text-muted sm:text-lg">
                <p>
                    В школе «Рожаем вместе» проходят курсы подготовки к родам в онлайн- и офлайн-формате.
                </p>
                <p>
                    На занятиях мы разбираем, как проходят роды, что важно знать заранее, как подготовиться физически и психологически, как снизить тревогу и чувствовать себя увереннее.
                </p>
                <p class="font-semibold text-text-heading">
                    Моя цель — чтобы к родам вы подходили не в состоянии паники, а с пониманием, что происходит и что вы можете делать на каждом этапе.
                </p>
            </div>

            <div class="border-l-2 border-accent pl-5 sm:pl-8">
                <h3 class="font-heading text-2xl font-bold text-text-heading">Я помогаю</h3>
                <ul class="mt-5 space-y-3">
                    @foreach($birthPreparationItems as $item)
                        <li class="flex gap-3 text-sm leading-relaxed text-text-muted sm:text-base">
                            <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-accent/15 text-xs font-bold text-accent" aria-hidden="true">✓</span>
                            <span>{{ $item }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="bg-bg-warm py-16" aria-labelledby="birth-support-title">
    <div class="mx-auto grid max-w-6xl gap-10 px-4 sm:px-6 lg:grid-cols-[1.15fr_0.85fr] lg:items-start lg:px-8">
        <div>
            <span class="section-eyebrow">Бережная опора</span>
            <h2 id="birth-support-title" class="section-heading mt-2">Сопровождение в родах</h2>
            <div class="mt-6 space-y-4 text-base leading-relaxed text-text-muted sm:text-lg">
                <p>
                    Во время родов я рядом с вами с самого начала процесса.
                </p>
                <p>
                    Я помогаю с дыханием, расслаблением, массажем, сменой положений, созданием спокойной и безопасной атмосферы. При необходимости помогаю выстроить бережную коммуникацию с медицинским персоналом.
                </p>
            </div>
        </div>

        <aside class="border-t-2 border-gold pt-6 lg:mt-9" aria-label="Роль доулы">
            <p class="text-xs font-semibold uppercase tracking-widest text-gold-dark">Моя роль</p>
            <p class="mt-3 text-base font-semibold leading-relaxed text-text-heading sm:text-lg">
                Я не заменяю врача и не принимаю медицинских решений.
            </p>
            <p class="mt-3 leading-relaxed text-text-muted">
                Моя роль — быть вашей опорой, поддерживать вас эмоционально и физически, помогать сохранять спокойствие, контакт с собой и ощущение безопасности.
            </p>
        </aside>
    </div>
</section>

<section class="bg-bg-base py-16" aria-labelledby="after-birth-title">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="section-eyebrow">После рождения</span>
            <h2 id="after-birth-title" class="section-heading mt-2">Поддержка в первые важные моменты</h2>
        </div>

        <div class="mt-10 grid gap-6 lg:grid-cols-2">
            <article class="rounded-lg border border-border-soft bg-bg-card p-6 shadow-card sm:p-8">
                <p class="text-xs font-semibold uppercase tracking-widest text-accent">Первая встреча</p>
                <h3 class="mt-3 font-heading text-2xl font-bold text-text-heading">Золотой час после рождения малыша</h3>
                <div class="mt-5 space-y-4 leading-relaxed text-text-muted">
                    <p>Первые минуты после рождения ребёнка — особенное время для мамы, малыша и всей семьи.</p>
                    <p>Я помогаю организовать этот момент максимально спокойно и бережно: создать тёплую атмосферу, поддержать первое прикладывание к груди, помочь маме восстановиться после родов и прожить первую встречу с малышом без лишней суеты.</p>
                </div>
            </article>

            <article class="rounded-lg border border-border-soft bg-bg-card p-6 shadow-card sm:p-8">
                <p class="text-xs font-semibold uppercase tracking-widest text-gold-dark">Адаптация дома</p>
                <h3 class="mt-3 font-heading text-2xl font-bold text-text-heading">Поддержка после родов</h3>
                <div class="mt-5 space-y-4 leading-relaxed text-text-muted">
                    <p>После выписки я не исчезаю из вашей жизни.</p>
                    <p>Я помогаю адаптироваться дома, разобраться с уходом за новорождённым, наладить грудное вскармливание, восстановиться после родов и почувствовать себя увереннее в новой роли.</p>
                    <p>Также я могу помочь с вопросами детского сна, ухода за малышом, восстановления мамы и первых этапов материнства.</p>
                </div>
            </article>
        </div>
    </div>
</section>

<section class="bg-bg-cool py-16" aria-labelledby="professional-base-title">
    <div class="mx-auto grid max-w-6xl gap-10 px-4 sm:px-6 lg:grid-cols-[0.82fr_1.18fr] lg:gap-16 lg:px-8">
        <div>
            <span class="section-eyebrow">Опыт и обучение</span>
            <h2 id="professional-base-title" class="section-heading mt-2">Моя профессиональная база</h2>
            <p class="mt-6 text-base leading-relaxed text-text-muted sm:text-lg">
                Я объединила знания и практический опыт в разных направлениях, чтобы помогать женщинам и семьям комплексно.
            </p>
            <p class="mt-6 border-t border-border-soft pt-6 text-sm leading-relaxed text-text-muted sm:text-base">
                Также я прошла дополнительное обучение по расслаблению с помощью мексиканского ребозо, остеопатическому подходу в помощи беременной и рожающей женщине, а также тейпированию в первые часы после родов.
            </p>
        </div>

        <div>
            <p class="text-xs font-semibold uppercase tracking-widest text-accent">Я являюсь</p>
            <ul class="mt-5 grid gap-x-8 gap-y-4 sm:grid-cols-2">
                @foreach($professionalBase as $item)
                    <li class="flex gap-3 border-b border-border-soft pb-4 text-sm leading-relaxed text-text-heading sm:text-base">
                        <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-gold/20 text-xs font-bold text-gold-dark" aria-hidden="true">✓</span>
                        <span>{{ $item }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

<section class="bg-bg-section py-16" aria-labelledby="why-title">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <span class="section-eyebrow">Рожаем вместе</span>
        <h2 id="why-title" class="section-heading mt-2">Почему я рядом</h2>
        <div class="mt-6 space-y-4 text-base leading-relaxed text-text-muted sm:text-lg">
            <p>Я знаю, как важно женщине в родах чувствовать не одиночество и страх, а поддержку, заботу и уверенность.</p>
            <p>Именно поэтому я создала школу «Рожаем вместе» — пространство, где будущие мамы и семьи получают знания, бережное сопровождение и живую человеческую опору.</p>
            <p class="font-semibold text-text-heading">Моя цель — чтобы ваше материнство начиналось с лёгкостью, спокойствием и радостью.</p>
        </div>
        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
            <a href="{{ route('courses.index') }}" class="btn-accent btn-lg">Выбрать курс</a>
            <a href="{{ route('contacts') }}#form" class="btn-outline btn-lg">Обсудить подготовку</a>
        </div>
    </div>
</section>
@endsection
