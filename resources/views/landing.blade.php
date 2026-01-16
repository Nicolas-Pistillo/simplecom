@extends('layouts.basic')

@section('title', 'Simplecom | Plataforma de e-commerce para vender online fácil y rápido')

@section('head')
    <meta name="description" content="Crea tu tienda online con Simplecom. Plataforma de e-commerce simple, rápida y sin complicaciones para vender en línea.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://simplecom.shop/">
    <meta property="og:title" content="Simplecom | Plataforma de e-commerce" />
    <meta property="og:description" content="Crea tu tienda online y empezá a vender con Simplecom." />
    <meta property="og:url" content="https://simplecom.shop/" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://simplecom.shop/og/landing-preview.jpg" />
    <meta property="og:site_name" content="Simplecom" />
    <meta property="og:locale" content="es_AR" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Simplecom | Plataforma de e-commerce fácil" />
    <meta name="twitter:description" content="Crea tu tienda online y empezá a vender con Simplecom." />
    <meta name="twitter:image" content="https://simplecom.shop/og/landing-preview.jpg" />
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "SoftwareApplication",
            "name": "Simplecom",
            "applicationCategory": "ECommerceApplication",
            "operatingSystem": "Web",
            "url": "https://simplecom.shop/",
            "description": "Plataforma de ecommerce simple para crear y gestionar tiendas online.",
            "offers": {
                "@type": "Offer",
                "price": "0",
                "priceCurrency": "ARS"
            }
        }
    </script>
@endsection

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
