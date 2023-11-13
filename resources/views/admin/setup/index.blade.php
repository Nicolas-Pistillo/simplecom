@extends('layouts.basic')

@section('head')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.2/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style> [x-cloak] { display: none !important; } [data-carousel-item] { z-index: 5; } </style>
@endsection

@section('content')
    
    @livewire('tenant.setup')

    <a href="{{ route('simplecom.landing') }}" target="_blank" 
        class="fixed bottom-3 right-5 z-20">
        <img src="{{ URL::to('img/simplecom/png/logo-color.png') }}" alt="Simplecom logo"
        class="h-20 md:h-24 rounded-full shadow-lg">
    </a>
@endsection
