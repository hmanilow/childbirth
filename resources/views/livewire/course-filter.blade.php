<div>
    @php
        $formatOptions = [
            'all' => 'Все курсы',
            \App\Domain\Courses\Models\Course::FORMAT_ONLINE => 'Онлайн',
            \App\Domain\Courses\Models\Course::FORMAT_OFFLINE => 'Офлайн',
        ];
    @endphp

    <div class="mb-8 space-y-5">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex flex-wrap gap-2">
                @foreach($formatOptions as $value => $label)
                    <button
                        type="button"
                        wire:click="$set('format', '{{ $value }}')"
                        class="rounded-btn border px-4 py-2 text-sm font-semibold transition duration-200 {{ $format === $value ? 'border-accent bg-accent text-white shadow-glow' : 'border-border-soft bg-white text-text-muted hover:border-accent/60 hover:text-accent' }}"
                    >
                        {{ $label }}
                    </button>
                @endforeach
            </div>

            <div class="grid gap-3 sm:grid-cols-[minmax(0,1fr)_190px] lg:w-[520px]">
                <input
                    wire:model.live.debounce.300ms="search"
                    type="search"
                    class="input"
                    placeholder="Поиск курса"
                >
                <select wire:model.live="sort" class="input">
                    <option value="featured">Популярные</option>
                    <option value="new">Новые</option>
                    <option value="price_asc">Цена ↑</option>
                    <option value="price_desc">Цена ↓</option>
                </select>
            </div>
        </div>

        <div class="flex gap-2 overflow-x-auto pb-1">
            <button
                type="button"
                wire:click="$set('category', '')"
                class="shrink-0 rounded-full border px-4 py-2 text-xs font-semibold transition duration-200 {{ $category === '' ? 'border-gold bg-gold/15 text-gold-dark' : 'border-border-soft bg-white text-text-muted hover:border-gold/70 hover:text-gold-dark' }}"
            >
                Все темы
            </button>
            @foreach($categories as $categoryOption)
                <button
                    type="button"
                    wire:key="category-{{ md5($categoryOption) }}"
                    wire:click="$set('category', '{{ $categoryOption }}')"
                    class="shrink-0 rounded-full border px-4 py-2 text-xs font-semibold transition duration-200 {{ $category === $categoryOption ? 'border-gold bg-gold/15 text-gold-dark' : 'border-border-soft bg-white text-text-muted hover:border-gold/70 hover:text-gold-dark' }}"
                >
                    {{ $categoryOption }}
                </button>
            @endforeach
        </div>
    </div>

    <div wire:loading.class="opacity-50 pointer-events-none transition-opacity">
        @if($courses->isEmpty())
            <div class="rounded-lg border border-border-soft bg-bg-section px-6 py-16 text-center text-text-muted">
                <p>Курсы не найдены. Попробуйте другой запрос.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3">
                @foreach($courses as $course)
                    <x-course-card :course="$course" />
                @endforeach
            </div>

            <div class="mt-10">
                {{ $courses->links() }}
            </div>
        @endif
    </div>
</div>
