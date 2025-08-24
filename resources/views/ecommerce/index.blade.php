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
    <section class="py-8 relative">
        <div class="w-full max-w-7xl mx-auto px-4 md:px-8">
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="flex max-sm:flex-col max-sm:items-center group gap-x-6 gap-y-2">
                    <span class="w-16 h-14 rounded-full p-4 flex items-center justify-center 
                    shadow-sm shadow-transparent transition-all duration-500 bg-gray-100">
                        <x-icon code="shopping_cart" />
                    </span>
                    <div class="flex flex-col">
                        <h6 class="font-semibold text-lg text-black mb-1 max-sm:text-center">
                            Carrito infalible
                        </h6>
                        <p class="font-normal text-sm text-gray-500 mb-4 max-sm:text-center">
                            Los mejores productos seleccionados para ti, sin complicaciones.
                        </p>
                    </div>
                </div>

                <div class="flex max-sm:flex-col max-sm:items-center group gap-x-6 gap-y-2">
                    <span class="w-16 h-14 rounded-full p-4 flex items-center justify-center 
                    shadow-sm shadow-transparent transition-all duration-500 bg-gray-100">
                        <x-icon code="credit_card" />
                    </span>
                    <div class="data flex flex-col">
                        <h6 class="font-semibold text-lg text-black mb-1 max-sm:text-center">
                            Todos los medios de pago
                        </h6>
                        <p class="font-normal text-sm text-gray-500 mb-4 max-sm:text-center">
                            Paga con lo que quieras, simplecom te ofrece todos los medios de pago a tu disposición.
                        </p>
                    </div>
                </div>

                <div class="flex max-sm:flex-col max-sm:items-center group gap-x-6 gap-y-2">
                    <span class="w-16 h-14 rounded-full p-4 flex items-center justify-center 
                    shadow-sm shadow-transparent transition-all duration-500 bg-gray-100">
                        <x-icon code="verified_user" />
                    </span>
                    <div class="data flex flex-col">
                        <h6 class="font-semibold text-lg text-black mb-1 max-sm:text-center">
                            Sitio seguro
                        </h6>
                        <p class="font-normal text-sm text-gray-500 mb-4 max-sm:text-center">
                            Tus datos están protegidos y son 100% condifenciales en este sitio.
                        </p>
                    </div>
                </div>

                <div class="flex max-sm:flex-col max-sm:items-center group gap-x-6 gap-y-2">
                    <span class="w-16 h-14 rounded-full p-4 flex items-center justify-center 
                    shadow-sm shadow-transparent transition-all duration-500 bg-gray-100">
                        <x-icon code="delivery_truck_speed" />
                    </span>
                    <div class="data flex flex-col">
                        <h6 class="font-semibold text-lg text-black mb-1 max-sm:text-center">
                            Envíos a todo el país
                        </h6>
                        <p class="font-normal text-sm text-gray-500 mb-4 max-sm:text-center">
                            Podes elegir entre retirar tu pedido o recibirlo en la puerta de tu casa.
                        </p>
                    </div>
                </div>

                <div class="flex max-sm:flex-col max-sm:items-center group gap-x-6 gap-y-2">
                    <span class="w-16 h-14 rounded-full p-4 flex items-center justify-center 
                    shadow-sm shadow-transparent transition-all duration-500 bg-gray-100">
                        <x-icon code="verified" />
                    </span>
                    <div class="data flex flex-col">
                        <h6 class="font-semibold text-lg text-black mb-1 max-sm:text-center">
                            Garantía de fabrica
                        </h6>
                        <p class="font-normal text-sm text-gray-500 mb-4 max-sm:text-center">
                            Contamos con garantía oficial de fábrica para todos nuestros productos.
                        </p>
                    </div>
                </div>

                <div class="flex max-sm:flex-col max-sm:items-center group gap-x-6 gap-y-2">
                    <span class="w-16 h-14 rounded-full p-4 flex items-center justify-center 
                    shadow-sm shadow-transparent transition-all duration-500 bg-gray-100">
                        <x-icon code="headset_mic" />
                    </span>
                    <div class="data flex flex-col">
                        <h6 class="font-semibold text-lg text-black mb-1 max-sm:text-center">
                            Estamos para ayudarte
                        </h6>
                        <p class="font-normal text-sm text-gray-500 mb-4 max-sm:text-center">
                            Nuestro equipo de soporte está disponible para asistirte en lo que necesites.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
