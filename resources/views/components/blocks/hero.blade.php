<section class="rounded-lg bg-white p-8">
    <h2 class="text-3xl font-semibold">{{ $block->title }}</h2>
    @if($block->subtitle)
        <p class="mt-3 text-lg text-slate-600">{{ $block->subtitle }}</p>
    @endif
    @if($block->body)
        <div class="prose mt-6 max-w-none">{!! $block->body !!}</div>
    @endif
</section>
