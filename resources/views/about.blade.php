@extends('layouts.app')

@section('title', 'Наши специалисты — Школа материнства «Рожаем вместе»')
@section('description', 'Специалисты школы материнства «Рожаем вместе». Знакомьтесь с основателем и руководителем школы Еленой Тимофеевой.')
@section('og_title', 'Наши специалисты — Школа материнства «Рожаем вместе»')
@section('og_description', 'Краткое знакомство со специалистами школы материнства «Рожаем вместе».')

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
                <div class="mt-5 max-w-2xl space-y-4 leading-relaxed text-text-muted">
                    <p>
                        Меня зовут Елена Тимофеева. Я многодетная мама, профессиональная доула, помощница в родах, основатель и руководитель школы материнства «Рожаем вместе».
                    </p>
                    <p>
                        Я создала эту школу, чтобы беременность, роды и первые месяцы материнства начинались не со страха и растерянности, а с понимания, спокойствия и уверенности.
                    </p>
                </div>
            </div>
        </article>
    </div>
</section>
@endsection
