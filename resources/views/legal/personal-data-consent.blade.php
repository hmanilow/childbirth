@extends('layouts.app')

@section('title', 'Согласие на обработку персональных данных — «Рожаем вместе»')
@section('description', 'Согласие на обработку персональных данных Самозанятой Тимофеевой Еленой Олеговной.')
@section('og_title', 'Согласие на обработку персональных данных')
@section('og_description', 'Условия и цели обработки персональных данных посетителей и клиентов школы материнства «Рожаем вместе».')
@section('canonical', route('personal-data-consent'))

@section('content')
    <x-legal-document title="СОГЛАСИЕ НА ОБРАБОТКУ ПЕРСОНАЛЬНЫХ ДАННЫХ">
        @include('legal.content.personal-data-consent')
    </x-legal-document>
@endsection
