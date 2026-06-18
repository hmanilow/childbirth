<!DOCTYPE html>
<html lang="ru" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- SEO Meta --}}
    <title>@yield('title', $globalSettings['site_name'] ?? 'Школа материнства рожаем вместе')</title>
    <meta name="description" content="@yield('description', $globalSettings['meta_description'] ?? 'Онлайн и офлайн курсы для будущих родителей: подготовка к родам, уход за малышом и спокойный старт семьи.')">
    @yield('meta')

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_title', $globalSettings['site_name'] ?? 'Школа материнства рожаем вместе')">
    <meta property="og:description" content="@yield('og_description', $globalSettings['meta_description'] ?? '')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="ru_RU">

    {{-- Canonical --}}
    @hasSection('canonical')
        <link rel="canonical" href="@yield('canonical')">
    @else
        <link rel="canonical" href="{{ url()->current() }}">
    @endif

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon.png') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Styles --}}
    <script>
        (function () {
            try {
                if (window.sessionStorage.getItem('sitePreloaderSeen') !== '1') {
                    document.documentElement.classList.add('site-preloader-enabled');
                }
            } catch (error) {
                document.documentElement.classList.add('site-preloader-enabled');
            }
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    {{-- Analytics --}}
    @if(!empty($globalSettings['yandex_metrica_id']))
        <!-- Yandex.Metrika -->
        <script type="text/javascript">
            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
            ym({{ $globalSettings['yandex_metrica_id'] }}, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true });
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/{{ $globalSettings['yandex_metrica_id'] }}" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    @endif
    @if(!empty($globalSettings['google_analytics_id']))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $globalSettings['google_analytics_id'] }}"></script>
        <script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','{{ $globalSettings['google_analytics_id'] }}');</script>
    @endif

    {{-- JSON-LD Structured Data --}}
    @yield('structured_data')

    @stack('head')
</head>
<body class="bg-bg-base text-text-primary font-body antialiased">
    <div id="site-preloader" class="site-preloader" role="status" aria-live="polite" aria-label="Загрузка сайта">
        <div class="site-preloader__inner">
            <img
                src="{{ asset('images/site/maternity-logo-web.svg') }}"
                alt=""
                aria-hidden="true"
                class="site-preloader__logo"
            >
            <div class="site-preloader__text">
                <p class="site-preloader__eyebrow">Школа материнства</p>
                <p class="site-preloader__brand">Рожаем вместе</p>
            </div>
            <div class="site-preloader__line" aria-hidden="true"></div>
        </div>
    </div>

    {{-- Header --}}
    <x-header />

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-footer />

    {{-- Floating CTA: WhatsApp / Telegram --}}
    <x-floating-cta />

    @livewireScripts
    @stack('scripts')
</body>
</html>
