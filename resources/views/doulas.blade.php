@extends('layouts.app')

@php
    $specialistName = $globalSettings['specialist_name'] ?? 'Елена Тимофеева';
    $doulas = [
        [
            'initials' => 'ЕТ',
            'name' => $specialistName,
            'role' => 'Основатель школы, доула',
            'description' => 'Анкета скоро будет заполнена.',
        ],
        [
            'initials' => 'Д',
            'name' => 'Доула школы',
            'role' => 'Специалист школы',
            'description' => 'Анкета скоро будет заполнена.',
        ],
        [
            'initials' => 'Д',
            'name' => 'Доула школы',
            'role' => 'Специалист школы',
            'description' => 'Анкета скоро будет заполнена.',
        ],
    ];
@endphp

@section('title', 'Наши доулы — Школа материнства «Рожаем вместе»')
@section('description', 'Доулы школы материнства «Рожаем вместе»: специалисты, которые помогают пройти беременность, роды и первые месяцы материнства с опорой и спокойствием.')
@section('og_title', 'Наши доулы — Школа материнства «Рожаем вместе»')
@section('og_description', 'Познакомьтесь с доулами школы материнства «Рожаем вместе».')

@section('content')
<section class="min-h-screen bg-gradient-hero pb-20 pt-44">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl animate-fade-up">
            <span class="section-eyebrow">Команда школы</span>
            <h1 class="mt-2 font-heading text-4xl font-bold leading-tight text-text-heading sm:text-5xl lg:text-hero">
                Наши доулы
            </h1>
            <p class="mt-5 max-w-2xl text-base leading-relaxed text-text-muted sm:text-lg">
                Специалисты школы, которые помогают пройти беременность, роды и первые месяцы материнства с большей опорой и спокойствием.
            </p>
        </div>

        <div class="mt-12 grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach($doulas as $doula)
                <article class="group flex h-full flex-col overflow-hidden rounded-card border border-border-soft bg-bg-card shadow-card transition duration-300 hover:-translate-y-1 hover:border-accent/50 hover:shadow-card-hover">
                    <div class="flex aspect-[4/3] items-center justify-center bg-gradient-card-muted p-8">
                        <div class="flex h-24 w-24 items-center justify-center rounded-full border border-accent/25 bg-bg-card text-accent shadow-card transition duration-300 group-hover:scale-105">
                            <span class="font-heading text-2xl font-bold">{{ $doula['initials'] }}</span>
                        </div>
                    </div>

                    <div class="flex flex-1 flex-col p-6">
                        <h2 class="font-heading text-2xl font-bold text-text-heading">{{ $doula['name'] }}</h2>
                        <p class="mt-2 text-sm font-semibold text-accent">{{ $doula['role'] }}</p>
                        <p class="mt-4 flex-1 text-sm leading-relaxed text-text-muted">{{ $doula['description'] }}</p>
                        <button type="button" class="btn-outline btn-sm mt-6 w-full" disabled aria-disabled="true">
                            Подробнее
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endsection
