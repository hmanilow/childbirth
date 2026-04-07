<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seoTitle ?? ($page ?? null)?->seoMeta?->meta_title ?? ($page ?? null)?->title ?? config('app.name') }}</title>
    @if(! empty(($page ?? null)?->seoMeta?->meta_description))
        <meta name="description" content="{{ ($page ?? null)?->seoMeta?->meta_description }}">
    @endif
    @if(! empty(($page ?? null)?->seoMeta?->canonical_url))
        <link rel="canonical" href="{{ ($page ?? null)?->seoMeta?->canonical_url }}">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('partials.json-ld', ['jsonLd' => $jsonLd ?? null])
    @livewireStyles
</head>
<body class="min-h-screen bg-slate-50 text-slate-950 antialiased">
<header class="border-b border-slate-200 bg-white">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
        <a class="font-semibold" href="{{ route('home') }}">{{ config('app.name') }}</a>
        <nav class="flex flex-wrap gap-4 text-sm">
            <a href="{{ route('pages.show', 'about') }}">Обо мне</a>
            <a href="{{ route('pages.show', 'services') }}">Услуги</a>
            <a href="{{ route('courses.index') }}">Курсы</a>
            <a href="{{ route('news.index') }}">Статьи</a>
            <a href="{{ route('pages.show', 'contacts') }}">Контакты</a>
        </nav>
    </div>
</header>

<main>
    @if(session('status'))
        <div class="mx-auto mt-4 max-w-6xl rounded bg-emerald-50 px-4 py-3 text-emerald-900">{{ session('status') }}</div>
    @endif

    {{ $slot ?? '' }}
    @yield('content')
</main>

<footer class="mt-16 border-t border-slate-200 bg-white">
    <div class="mx-auto grid max-w-6xl gap-4 px-4 py-8 text-sm text-slate-600 md:grid-cols-3">
        <p>{{ config('app.name') }}</p>
        <a href="{{ route('pages.show', 'privacy-policy') }}">Политика конфиденциальности</a>
        <a href="{{ route('pages.show', 'personal-data-consent') }}">Согласие на обработку персональных данных</a>
    </div>
</footer>
@livewireScripts
</body>
</html>
