@extends('layouts.app')

@section('title', 'Политика обработки персональных данных — «Рожаем вместе»')
@section('description', 'Политика в отношении обработки персональных данных школы материнства «Рожаем вместе».')
@section('og_title', 'Политика обработки персональных данных — «Рожаем вместе»')
@section('og_description', 'Правила обработки и защиты персональных данных, использования cookie и веб-аналитики.')
@section('canonical', route('privacy'))

@section('content')
    <x-legal-document
        title="ПОЛИТИКА"
        subtitle="в отношении обработки персональных данных"
    >
        @include('legal.content.privacy')
    </x-legal-document>
@endsection
