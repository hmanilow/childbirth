@extends('layouts.app')

@section('title', 'Услуги — Школа материнства рожаем вместе')
@section('description', 'Дополнительные форматы поддержки и подготовки для будущих родителей.')

@section('content')
<main>
    <section class="bg-bg-section pt-36 pb-16">
        <div class="container mx-auto px-4 sm:px-6 text-center">
            <span class="section-eyebrow">Форматы</span>
            <h1 class="section-heading mt-2 mb-4">Услуги</h1>
            <p class="text-text-muted text-lg max-w-2xl mx-auto">
                Дополнительные форматы подготовки и поддержки семьи.
            </p>
        </div>
    </section>

    <section class="py-16">
        <div class="container mx-auto px-4 sm:px-6">
            @if($services->isEmpty())
                <p class="text-center text-text-muted py-16">Информация об услугах скоро появится.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($services as $service)
                        <x-service-card :service="$service" />
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="py-16 bg-bg-card">
        <div class="container mx-auto px-4 sm:px-6 text-center max-w-2xl">
            <h2 class="section-heading mb-4">Остались вопросы?</h2>
            <p class="text-text-muted mb-8">Напишите нам, и мы подскажем подходящий формат.</p>
            <a href="{{ route('contacts') }}" class="btn-accent px-10">Написать</a>
        </div>
    </section>
</main>
@endsection
