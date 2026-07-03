@extends('layouts.app')

@section('title', 'Наши специалисты — Школа материнства «Рожаем вместе»')
@section('description', 'Специалисты школы материнства «Рожаем вместе». Знакомьтесь с основателем и руководителем школы Еленой Тимофеевой.')
@section('og_title', 'Наши специалисты — Школа материнства «Рожаем вместе»')
@section('og_description', 'Команда школы материнства «Рожаем вместе». Анкеты специалистов будут дополняться.')

@section('content')
<section class="min-h-[70vh] bg-gradient-hero pb-20 pt-44">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="section-eyebrow">Команда школы</span>
            <h1 class="section-heading mt-2">Наши специалисты</h1>
            <p class="section-subheading text-base leading-relaxed sm:text-lg">
                Здесь мы знакомим вас с людьми, которые создают программы школы и помогают семьям готовиться к важным переменам спокойно и осознанно.
            </p>
        </div>

        <article class="mt-12 grid overflow-hidden rounded-card border border-border-soft bg-bg-card shadow-card-hover md:grid-cols-[minmax(260px,0.8fr)_1.2fr]">
            <div class="min-h-[320px] overflow-hidden bg-gradient-card-muted md:min-h-[480px]">
                <img
                    src="{{ asset('images/site/elena-about.webp') }}"
                    alt="Елена Тимофеева"
                    class="h-full w-full object-cover object-top"
                >
            </div>
            <div class="flex flex-col justify-center p-7 sm:p-10 lg:p-14">
                <p class="text-sm font-semibold uppercase tracking-widest text-accent">Основатель школы</p>
                <h2 class="mt-3 font-heading text-3xl font-bold text-text-heading sm:text-4xl">Елена Тимофеева</h2>
                <p class="mt-4 max-w-2xl text-lg font-semibold leading-relaxed text-text-heading">
                    Основатель и руководитель школы материнства «Рожаем вместе»
                </p>
                <p class="mt-5 max-w-2xl leading-relaxed text-text-muted">
                    Анкета специалиста скоро будет дополнена.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('doulas') }}" class="btn-accent">Сопровождение в родах</a>
                    <a href="{{ route('contacts') }}#form" class="btn-outline">Связаться со школой</a>
                </div>
            </div>
        </article>
    </div>
</section>
@endsection
