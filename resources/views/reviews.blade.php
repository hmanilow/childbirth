@extends('layouts.app')

@section('title', 'Отзывы — Школа материнства «Рожаем вместе»')
@section('description', 'Раздел отзывов школы материнства «Рожаем вместе» готовится к публикации.')
@section('meta')<meta name="robots" content="noindex, follow">@endsection

@section('content')
<section class="flex min-h-[70vh] items-center bg-gradient-hero pb-20 pt-44">
    <div class="mx-auto w-full max-w-4xl px-4 text-center sm:px-6 lg:px-8">
        <span class="section-eyebrow">Истории семей</span>
        <h1 class="section-heading mt-2">Отзывы появятся здесь</h1>
        <p class="mx-auto mt-5 max-w-2xl text-base leading-relaxed text-text-muted sm:text-lg">
            Мы готовим этот раздел и опубликуем только реальные отзывы с разрешения их авторов.
        </p>
        <a href="{{ route('contacts') }}#form" class="btn-accent mt-8">Задать вопрос</a>
    </div>
</section>
@endsection
