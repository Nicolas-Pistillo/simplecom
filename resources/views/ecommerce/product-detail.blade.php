@extends('layouts.ecommerce')

@section('title', $product->name)

@section('head')
<link
rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endsection

@section('content')
    @livewire('ecommerce.product-detail', compact('product'))
@endsection
