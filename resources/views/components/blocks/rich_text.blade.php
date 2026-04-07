<section class="prose my-8 max-w-none">
    @if($block->title)
        <h2>{{ $block->title }}</h2>
    @endif
    {!! $block->body !!}
</section>
