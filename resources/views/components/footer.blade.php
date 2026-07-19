@php
    $phone = trim((string) ($globalSettings['phone'] ?? ''));
    $email = trim((string) ($globalSettings['email'] ?? ''));
    $address = trim((string) ($globalSettings['address'] ?? ''));
    $siteName = $globalSettings['site_name'] ?? 'Школа материнства рожаем вместе';
    $socials = [
        'vk' => $globalSettings['vk_url'] ?? $globalSettings['social_vk'] ?? '',
        'telegram' => $globalSettings['telegram_url'] ?? $globalSettings['social_telegram'] ?? '',
        'youtube' => $globalSettings['youtube_url'] ?? $globalSettings['social_youtube'] ?? '',
        'instagram' => $globalSettings['instagram_url'] ?? $globalSettings['social_instagram'] ?? '',
    ];
@endphp

<footer class="mt-auto border-t border-border-soft bg-bg-card">
    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-10 px-4 py-14 sm:px-6 md:grid-cols-2 lg:grid-cols-[1.3fr_0.8fr_0.8fr_1fr] lg:px-8">
        <div>
            <a href="{{ route('home') }}" class="mb-5 inline-flex items-center gap-4">
                <img
                    src="{{ asset('images/site/maternity-logo-web.svg') }}"
                    alt="{{ $siteName }}"
                    class="h-20 w-auto object-contain drop-shadow-md"
                >
                <span>
                    <span class="block font-heading text-xl font-bold leading-tight text-text-heading">Школа материнства</span>
                    <span class="block text-xs font-semibold uppercase tracking-widest text-accent">рожаем вместе</span>
                </span>
            </a>
            <p class="max-w-sm text-sm font-semibold leading-relaxed text-text-heading">
                Школа материнства «Рожаем вместе»
            </p>
            <p class="mt-2 max-w-sm text-sm leading-relaxed text-text-muted">
                Онлайн и офлайн курсы для будущих родителей: подготовка к родам, уход за малышом и спокойный старт семьи.
            </p>

            <div class="mt-6 flex items-center gap-3">
                @if(!empty($socials['vk']))
                    <a href="{{ $socials['vk'] }}" target="_blank" rel="noopener" class="social-icon" aria-label="ВКонтакте">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M15.684 0H8.316C1.592 0 0 1.592 0 8.316v7.368C0 22.408 1.592 24 8.316 24h7.368C22.408 24 24 22.408 24 15.684V8.316C24 1.592 22.408 0 15.684 0zm3.692 17.123h-1.744c-.66 0-.864-.525-2.05-1.727-1.033-1-1.49-1.135-1.744-1.135-.356 0-.458.102-.458.593v1.575c0 .424-.135.677-1.253.677-1.846 0-3.896-1.118-5.335-3.202C4.624 10.857 4 8.408 4 8.205c0-.254.102-.491.593-.491h1.744c.44 0 .61.203.78.677.864 2.49 2.303 4.675 2.896 4.675.22 0 .322-.102.322-.66V9.721c-.068-1.186-.695-1.287-.695-1.71 0-.203.17-.407.44-.407h2.744c.373 0 .508.203.508.643v3.473c0 .372.17.508.271.508.22 0 .407-.136.813-.542 1.253-1.406 2.151-3.574 2.151-3.574.119-.254.322-.491.763-.491h1.744c.525 0 .643.27.525.643-.22 1.017-2.354 4.031-2.354 4.031-.186.305-.254.44 0 .78.186.254.796.78 1.203 1.253.745.847 1.32 1.558 1.473 2.05.17.491-.085.745-.576.745z"/></svg>
                    </a>
                @endif
                @if(!empty($socials['telegram']))
                    <a href="{{ $socials['telegram'] }}" target="_blank" rel="noopener" class="social-icon" aria-label="Telegram">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                    </a>
                @endif
            </div>
        </div>

        <div>
            <h3 class="mb-4 font-heading text-base font-semibold text-text-heading">Курсы</h3>
            <ul class="space-y-2">
                <li><a href="{{ route('home') }}#online" class="footer-link">Онлайн-курсы</a></li>
                <li><a href="{{ route('home') }}#offline" class="footer-link">Офлайн-курсы</a></li>
                <li><a href="{{ route('courses.index') }}" class="footer-link">Все курсы</a></li>
            </ul>
        </div>

        <div>
            <h3 class="mb-4 font-heading text-base font-semibold text-text-heading">Информация</h3>
            <ul class="space-y-2">
                <li><a href="{{ route('about') }}" class="footer-link">Наши специалисты</a></li>
                <li><a href="{{ route('reviews') }}" class="footer-link">Отзывы</a></li>
                <li><a href="{{ route('contacts') }}" class="footer-link">Контакты</a></li>
                <li><a href="{{ route('privacy') }}" class="footer-link">Политика конфиденциальности</a></li>
                <li><a href="{{ route('terms') }}" class="footer-link">Пользовательское соглашение</a></li>
            </ul>
        </div>

        <div>
            <h3 class="mb-4 font-heading text-base font-semibold text-text-heading">Контакты</h3>
            <ul class="space-y-3">
                @if($phone !== '')
                    <li>
                        <a href="tel:{{ preg_replace('/[^+\d]/', '', $phone) }}" class="footer-link">{{ $phone }}</a>
                    </li>
                @endif
                @if($email !== '')
                    <li>
                        <a href="mailto:{{ $email }}" class="footer-link">{{ $email }}</a>
                    </li>
                @endif
                @if($address !== '')
                    <li class="text-sm text-text-muted">{{ $address }}</li>
                @endif
            </ul>
            <a href="{{ route('contacts') }}#form" class="btn-accent mt-6 inline-flex text-sm">
                Подобрать курс
            </a>
        </div>
    </div>

    <div class="border-t border-border-soft">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-4 py-4 text-xs text-text-subtle sm:flex-row sm:px-6 lg:px-8">
            <p>© {{ date('Y') }} {{ $siteName }}. Все права защищены.</p>
            <a href="{{ route('courses.index') }}" class="transition-colors duration-200 hover:text-accent">Каталог курсов</a>
        </div>
    </div>
</footer>
