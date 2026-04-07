@extends('layouts.app')

@section('content')
    <article class="mx-auto max-w-3xl px-4 py-10">
        <h1 class="text-4xl font-semibold">{{ $post->seoMeta->h1 ?? $post->title }}</h1>
        <div class="prose mt-8 max-w-none">{!! $post->content !!}</div>
    </article>
@endsection
