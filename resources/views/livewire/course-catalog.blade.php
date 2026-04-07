<div class="mt-8">
    <input class="w-full rounded border border-slate-300 px-3 py-2" type="search" placeholder="Поиск курса" wire:model.live.debounce.400ms="search">
    <div class="mt-6 grid gap-4 md:grid-cols-3">
        @foreach($courses as $course)
            <a class="rounded-lg border border-slate-200 bg-white p-5" href="{{ route('courses.show', $course->slug) }}">
                <h2 class="text-xl font-semibold">{{ $course->title }}</h2>
                <p class="mt-3 text-slate-600">{{ $course->short_description }}</p>
                <p class="mt-4 font-semibold">{{ number_format((float) $course->price, 0, ',', ' ') }} ₽</p>
            </a>
        @endforeach
    </div>
    <div class="mt-8">{{ $courses->links() }}</div>
</div>
