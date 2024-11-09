@extends('layouts.ecommerce')

@section('title', 'Proceso de compra - ' . tenant('ecommerce_name'))

@section('content')

    @livewire('ecommerce.checkout')

@endsection
