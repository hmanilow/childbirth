@extends('layouts.app')

@section('title', 'Политика конфиденциальности — Школа материнства рожаем вместе')
@section('description', 'Политика обработки персональных данных школы материнства.')

@section('content')
<section class="bg-bg-section pt-44 pb-16">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <span class="section-eyebrow">Документы</span>
        <h1 class="mt-2 font-heading text-4xl font-bold text-text-heading lg:text-5xl">Политика конфиденциальности</h1>
    </div>
</section>

<section class="py-16">
    <div class="prose-dark mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        @if($page?->content)
            {!! $page->content !!}
        @else
            <p>Мы используем данные, которые вы оставляете в формах сайта, чтобы связаться с вами, ответить на вопрос и помочь подобрать курс.</p>
            <p>Данные не передаются третьим лицам без необходимости обработки заявки или требований закона.</p>
            <p>Чтобы уточнить, изменить или удалить свои данные, напишите через форму обратной связи на сайте.</p>
        @endif
    </div>
</section>
@endsection
