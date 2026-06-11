@extends('layouts.app')

@section('title', 'Частые вопросы — Школа материнства рожаем вместе')
@section('description', 'Ответы на частые вопросы о курсах, форматах обучения и подготовке к родам.')

@section('content')
<main>
    <section class="bg-bg-section pt-36 pb-16">
        <div class="container mx-auto px-4 sm:px-6 text-center">
            <span class="section-eyebrow">FAQ</span>
            <h1 class="section-heading mt-2 mb-4">Частые вопросы</h1>
        </div>
    </section>

    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6 max-w-3xl">
            <x-sections.faq />

            <div class="mt-12 text-center">
                <p class="text-text-muted mb-4">Не нашли ответ?</p>
                <a href="{{ route('contacts') }}" class="btn-accent px-10">Задать вопрос</a>
            </div>
        </div>
    </section>
</main>
@endsection
