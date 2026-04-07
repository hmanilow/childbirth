@extends('layouts.app')

@section('content')
    <section class="mx-auto max-w-6xl px-4 py-10">
        <h1 class="text-4xl font-semibold">Новости и статьи</h1>
        <div class="mt-8 grid gap-4 md:grid-cols-3">
            @foreach($posts as $post)
                <a class="rounded-lg border border-slate-200 bg-white p-5" href="{{ route('news.show', $post->slug) }}">
                    <h2 class="text-xl font-semibold">{{ $post->title }}</h2>
                    <p class="mt-3 text-slate-600">{{ $post->excerpt }}</p>
                </a>
            @endforeach
        </div>
        <div class="mt-8">{{ $posts->links() }}</div>
    </section>
@endsection
