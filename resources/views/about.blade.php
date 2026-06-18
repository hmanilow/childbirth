@extends('layouts.app')

@section('title', 'Обо мне — Школа материнства рожаем вместе')
@section('description', 'Кратко о специалисте, который ведёт занятия школы материнства и помогает семьям подготовиться к родам и первым месяцам.')

@section('content')
<section class="bg-[linear-gradient(135deg,#FFFFFF_0%,#DED0D3_52%,#BFD4DA_100%)] pt-44 pb-16">
    <div class="mx-auto grid max-w-6xl items-center gap-10 px-4 sm:px-6 lg:grid-cols-[0.9fr_1.1fr] lg:px-8">
        <div class="flex justify-center lg:justify-start">
            <div class="w-full max-w-sm rounded-lg border border-accent/20 bg-white p-10 text-center shadow-card-hover sm:p-12">
                <img
                    src="{{ asset('images/site/maternity-logo-web.svg') }}"
                    alt="Школа материнства рожаем вместе"
                    class="mx-auto h-44 w-auto object-contain drop-shadow-xl sm:h-52 lg:h-56"
                >
                <p class="mt-6 text-sm font-semibold uppercase tracking-widest text-accent">рожаем вместе</p>
                <p class="mt-1 font-heading text-3xl font-bold text-text-heading sm:text-4xl">Школа материнства</p>
            </div>
        </div>

        <div>
            <span class="section-eyebrow">Обо мне</span>
            <h1 class="mt-2 font-heading text-4xl font-bold leading-tight text-text-heading lg:text-5xl">
                Елена, специалист по подготовке к родам
            </h1>
            <div class="mt-6 space-y-4 text-lg leading-relaxed text-text-muted">
                <p>
                    Я веду занятия школы материнства и помогаю будущим родителям разобраться в родах, уходе за малышом и первых неделях после рождения.
                </p>
                <p>
                    В работе мне важно, чтобы семья получала понятные шаги, спокойную поддержку и могла выбрать тот формат подготовки, который подходит именно ей.
                </p>
            </div>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('courses.index') }}" class="btn-accent btn-lg">Смотреть курсы</a>
                <a href="{{ route('contacts') }}#form" class="btn-outline btn-lg">Задать вопрос</a>
            </div>
        </div>
    </div>
</section>

<section class="py-16">
    <div class="mx-auto grid max-w-6xl gap-5 px-4 sm:px-6 md:grid-cols-3 lg:px-8">
        <div class="rounded-lg border border-border-soft bg-white p-6">
            <p class="text-xs font-semibold uppercase tracking-widest text-accent">Подход</p>
            <h2 class="mt-3 font-heading text-2xl font-bold text-text-heading">Без давления</h2>
            <p class="mt-3 text-sm leading-relaxed text-text-muted">Обсуждаем варианты и решения спокойно, без навязывания единственного сценария.</p>
        </div>
        <div class="rounded-lg border border-border-soft bg-white p-6">
            <p class="text-xs font-semibold uppercase tracking-widest text-accent">Практика</p>
            <h2 class="mt-3 font-heading text-2xl font-bold text-text-heading">По делу</h2>
            <p class="mt-3 text-sm leading-relaxed text-text-muted">На занятиях остаются только те знания, которые можно применить в реальной жизни.</p>
        </div>
        <div class="rounded-lg border border-border-soft bg-white p-6">
            <p class="text-xs font-semibold uppercase tracking-widest text-accent">Формат</p>
            <h2 class="mt-3 font-heading text-2xl font-bold text-text-heading">Гибко</h2>
            <p class="mt-3 text-sm leading-relaxed text-text-muted">Можно выбрать онлайн-курс, очное занятие или индивидуальную подготовку.</p>
        </div>
    </div>
</section>
@endsection
