<div id="cookie-consent" class="cookie-consent" hidden data-cookie-consent-root>
    <section
        class="cookie-consent__banner"
        data-cookie-banner
        role="region"
        aria-label="Настройки файлов cookie"
        hidden
    >
        <div class="cookie-consent__copy">
            <p class="cookie-consent__title">Файлы cookie</p>
            <p class="cookie-consent__text">
                Мы используем файлы cookie для корректной работы сайта, анализа трафика и улучшения содержания сайта. Продолжая использовать сайт без изменения настроек, вы соглашаетесь на обработку cookie-файлов в соответствии с
                <a href="{{ route('privacy') }}#cookies">Политикой обработки персональных данных</a>.
                Вы можете изменить свой выбор в любой момент в настройках браузера или с помощью кнопок ниже.
            </p>
        </div>
        <div class="cookie-consent__actions">
            <button type="button" class="btn-outline cookie-consent__button" data-cookie-action="reject">
                Отказаться (кроме обязательных)
            </button>
            <button type="button" class="btn-accent cookie-consent__button" data-cookie-action="accept-all">
                Принять все
            </button>
            <button type="button" class="btn-ghost cookie-consent__button" data-cookie-action="settings">
                Настроить согласие
            </button>
        </div>
    </section>

    <div class="cookie-preferences" data-cookie-preferences hidden>
        <button type="button" class="cookie-preferences__backdrop" data-cookie-action="close-settings" aria-label="Закрыть настройки cookie"></button>
        <section
            class="cookie-preferences__dialog"
            role="dialog"
            aria-modal="true"
            aria-labelledby="cookie-preferences-title"
            tabindex="-1"
        >
            <div class="cookie-preferences__header">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-accent">Ваш выбор</p>
                    <h2 id="cookie-preferences-title" class="mt-1 font-heading text-2xl font-bold text-text-heading">Настройки cookie</h2>
                </div>
                <button type="button" class="cookie-preferences__close" data-cookie-action="close-settings" aria-label="Закрыть настройки cookie" title="Закрыть">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 6l12 12M18 6L6 18"/>
                    </svg>
                </button>
            </div>

            <p class="mt-4 text-sm leading-relaxed text-text-muted">
                Выберите категории, которые можно использовать. Обязательные cookie обеспечивают работу сайта и всегда активны.
            </p>

            <div class="cookie-preferences__list">
                <label class="cookie-category">
                    <span>
                        <span class="cookie-category__name">Необходимые</span>
                        <span class="cookie-category__description">Работа сайта, форм, безопасности и сохранение вашего выбора.</span>
                    </span>
                    <input type="checkbox" checked disabled aria-label="Необходимые cookie всегда активны">
                </label>
                <label class="cookie-category">
                    <span>
                        <span class="cookie-category__name">Функциональные</span>
                        <span class="cookie-category__description">Внешние функции сайта, включая интерактивную Яндекс Карту.</span>
                    </span>
                    <input type="checkbox" data-cookie-category="functional">
                </label>
                <label class="cookie-category">
                    <span>
                        <span class="cookie-category__name">Аналитические</span>
                        <span class="cookie-category__description">Обезличенная статистика посещаемости и использования сайта.</span>
                    </span>
                    <input type="checkbox" data-cookie-category="analytics">
                </label>
                <label class="cookie-category">
                    <span>
                        <span class="cookie-category__name">Маркетинговые</span>
                        <span class="cookie-category__description">Оценка эффективности информационных и рекламных материалов.</span>
                    </span>
                    <input type="checkbox" data-cookie-category="marketing">
                </label>
            </div>

            <div class="cookie-preferences__actions">
                <button type="button" class="btn-outline" data-cookie-action="reject">Только необходимые</button>
                <button type="button" class="btn-accent" data-cookie-action="save-settings">Подтвердить выбор</button>
            </div>
        </section>
    </div>
</div>
