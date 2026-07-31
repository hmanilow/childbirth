@extends('layouts.app')

@section('title', 'Договор-оферта — «Рожаем вместе»')
@section('description', 'Публичная оферта на оказание информационно-консультационных и образовательных услуг.')
@section('og_title', 'Договор-оферта школы материнства «Рожаем вместе»')
@section('og_description', 'Условия оказания, оплаты и получения информационно-консультационных и образовательных услуг.')
@section('canonical', route('offer'))

@section('content')
    <x-legal-document
        title="ДОГОВОР-ОФЕРТА"
        subtitle="на оказание информационно-консультационных и образовательных услуг"
    >
        @include('legal.content.offer')
    </x-legal-document>
@endsection
