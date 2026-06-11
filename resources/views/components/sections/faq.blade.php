@props(['items' => []])

<section id="faq" class="py-section bg-bg-base">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center mb-14">
            <div class="inline-flex items-center gap-2 bg-accent/10 border border-accent/20 rounded-full px-4 py-1.5 mb-4">
                <span class="text-sm text-accent uppercase tracking-widest font-medium">FAQ</span>
            </div>
            <h2 class="font-heading font-bold text-section text-text-primary">Частые вопросы</h2>
        </div>

        <div class="space-y-3" x-data="{ open: null }">
            @php
                $questions = !empty($items) ? $items : [
                    ['q' => 'Когда лучше начинать подготовку к родам?', 'a' => 'Обычно удобно начинать со второго триместра, но полезный курс можно подобрать и ближе к родам. Главное — выбрать формат под ваши сроки и вопросы.'],
                    ['q' => 'Можно ли пройти курс онлайн?', 'a' => 'Да, в каталоге есть онлайн-курсы, которые можно проходить в удобном темпе и возвращаться к материалам по необходимости.'],
                    ['q' => 'Есть ли офлайн-занятия?', 'a' => 'Да, в каталоге есть офлайн-интенсивы и очные программы. Актуальные детали уточняются при записи.'],
                    ['q' => 'Есть ли курс для партнёра?', 'a' => 'Да, есть отдельные программы для будущих пап и подготовки пары к совместным родам.'],
                    ['q' => 'Что выбрать, если я не уверена?', 'a' => 'Оставьте заявку, и мы поможем подобрать курс по сроку беременности, формату и темам, которые сейчас важнее всего.'],
                ];
            @endphp

            @foreach($questions as $i => $item)
            <div class="bg-bg-card border border-border-soft rounded-card overflow-hidden transition-all duration-200 hover:border-accent/30">
                <button
                    @click="open === {{ $i }} ? open = null : open = {{ $i }}"
                    class="flex items-center justify-between w-full px-6 py-4 text-left"
                    :aria-expanded="open === {{ $i }}"
                >
                    <span class="font-medium text-text-primary pr-4">{{ is_array($item) ? $item['q'] : $item->question }}</span>
                    <svg
                        class="w-5 h-5 text-accent flex-shrink-0 transition-transform duration-200"
                        :class="open === {{ $i }} ? 'rotate-180' : ''"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div
                    x-show="open === {{ $i }}"
                    x-collapse
                    class="px-6 pb-5"
                >
                    <p class="text-text-muted text-sm leading-relaxed">{{ is_array($item) ? $item['a'] : $item->answer }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <p class="text-text-muted mb-4">Не нашли ответ?</p>
            <a href="{{ route('faq') }}" class="btn-outline mr-4">Все вопросы</a>
            <a href="{{ route('contacts') }}#form" class="btn-accent">Задать вопрос</a>
        </div>
    </div>
</section>
