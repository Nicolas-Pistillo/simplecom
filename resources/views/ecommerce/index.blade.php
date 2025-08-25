@extends('layouts.ecommerce')

@section('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endsection

@section('content')
    {{-- Main Slider --}}
    @if ($banners->isNotEmpty())
        @include('ecommerce.partials.banner-slider')
    @endif

    {{-- Promotional Message --}}
    @config('promotional_message')
        <div class="w-full bg-black text-white overflow-hidden">
            <div class="text-center py-1 sm:py-2">
                <div
                    class="w-full animate-infinite-scroll inline-flex flex-nowrap 
                items-center justify-center gap-x-6">
                    @for ($i = 0; $i < 15; $i++)
                        <h4 class="whitespace-nowrap text-xs sm:text-base">{{ $value }}</h4>
                    @endfor
                </div>
            </div>
        </div>
    @endconfig

    {{-- Principal Categories --}}
    @include('ecommerce.partials.principal-categories-section')

    {{-- New arrivals presentation --}}
    @include('ecommerce.partials.collections-section')

    {{-- Featured products section --}}
    @if ($featuredProducts->isNotEmpty())
        @include('ecommerce.partials.featured-products-section')
    @endif

    {{-- Incentives --}}
    @include('ecommerce.partials.incentives-section')

@endsection
