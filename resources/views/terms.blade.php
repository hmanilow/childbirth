@extends('layouts.app')

@section('title', 'Пользовательское соглашение — Школа материнства рожаем вместе')
@section('description', 'Условия использования сайта школы материнства.')

@section('content')
<section class="bg-bg-section pt-36 pb-16">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <span class="section-eyebrow">Документы</span>
        <h1 class="mt-2 font-heading text-4xl font-bold text-text-heading lg:text-5xl">Пользовательское соглашение</h1>
    </div>
</section>

<section class="py-16">
    <div class="prose-dark mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        @if($page?->content)
            {!! $page->content !!}
        @else
            <p>Сайт предназначен для знакомства с курсами школы материнства и отправки заявок на обучение.</p>
            <p>Информация на сайте носит ознакомительный характер и не заменяет консультацию медицинского специалиста.</p>
            <p>Оставляя заявку, вы соглашаетесь, что с вами могут связаться для ответа на вопрос или подбора подходящего курса.</p>
        @endif
    </div>
</section>
@endsection
