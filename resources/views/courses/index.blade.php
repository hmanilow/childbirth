@extends('layouts.app')

@section('title', 'Курсы — Школа материнства рожаем вместе')
@section('description', 'Каталог онлайн и офлайн курсов для будущих родителей: подготовка к родам, уход за малышом, семья и первые месяцы.')

@section('content')
<section class="bg-[linear-gradient(135deg,#FFFFFF_0%,#EAD5DA_52%,#C9DEE7_100%)] pt-44 pb-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <span class="section-eyebrow">Каталог курсов</span>
            <h1 class="mt-2 font-heading text-[2rem] font-bold leading-[1.08] text-text-heading sm:text-5xl lg:text-hero">Курсы для будущих <br class="sm:hidden">мам и пап</h1>
            <p class="mt-5 text-lg leading-relaxed text-text-muted">
                Онлайн-программы, очные интенсивы и практичные занятия для подготовки к родам, уходу за ребёнком и спокойному семейному старту.
            </p>
        </div>
    </div>
</section>

<section class="py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <livewire:course-filter />
    </div>
</section>
@endsection
