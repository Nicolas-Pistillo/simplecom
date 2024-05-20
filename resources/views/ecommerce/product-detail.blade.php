@extends('layouts.ecommerce')

@section('title', $product->name)

@section('content')
    @livewire('ecommerce.product-detail', compact('product'))
@endsection
