@extends('layouts.basic')

@section('content')

    @include('landing.header')

    <main>
        @include('landing.hero')

        @include('landing.features')

        @include('landing.benefits')

        @include('landing.get-started')

        {{-- @include('landing.testimonials') --}}

        @include('landing.pricing')

        @livewire('landing.form')

        @include('landing.faqs')
    </main>

    @include('landing.footer')

    <a class="fixed bottom-4 right-4" target="_blank"
    href="https://api.whatsapp.com/send?phone=5491169755391&text=¡Hola!, quisiera saber mas acerca de su plataforma de e-commerce">
        <img class="w-12 h-12" src="{{ URL::to('img/whatsapp-icon.svg') }}" alt="Whatsapp logo">
    </a>
@endsection
