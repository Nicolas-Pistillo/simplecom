@extends('layouts.ecommerce')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endsection

@section('content')

    {{-- Banner Slider --}}
    @include('ecommerce.partials.banner-slider')

    {{-- Promotional Message --}}
    @include('ecommerce.partials.promotional-message')

    {{-- Principal Categories --}}
    @include('ecommerce.partials.principal-categories-section')

    {{-- Featured Products --}}
    @include('ecommerce.partials.featured-products-section')

    {{-- Collections --}}
    @include('ecommerce.partials.collections-section')

    {{-- Incentives --}}
    @include('ecommerce.partials.incentives-section')

@endsection
