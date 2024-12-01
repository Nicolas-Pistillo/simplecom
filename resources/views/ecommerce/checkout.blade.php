@extends('layouts.ecommerce')

@section('title', 'Proceso de compra - ' . tenant('ecommerce_name'))

@section('head')
    <script src="https://ecommerce-modal.preprod.modo.com.ar/bundle.js"></script>
@endsection

@section('content')

    @livewire('ecommerce.checkout')

@endsection
