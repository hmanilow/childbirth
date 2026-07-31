@props([
    'title',
    'subtitle' => null,
])

<section class="bg-gradient-hero pt-44 pb-14">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <span class="section-eyebrow">Документы</span>
        <h1 class="mt-3 max-w-4xl font-heading text-4xl font-bold leading-tight text-text-heading sm:text-5xl lg:text-6xl">
            {{ $title }}
        </h1>
        @if($subtitle)
            <p class="mt-4 max-w-3xl text-lg leading-relaxed text-text-muted">{{ $subtitle }}</p>
        @endif
    </div>
</section>

<section class="py-12 sm:py-16">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <article class="legal-document">
            {{ $slot }}
        </article>
    </div>
</section>
