@extends('layouts.ecommerce')

@section('content')
    
<section class="bg-white py-16 antialiased md:py-16">

    <div class="mx-auto max-w-2xl px-4 2xl:px-0">

        <div class="mb-6 animate__animated animate__rubberBand">
            <div class="text-center mb-3">
                <x-icon code="check" class="p-3 rounded-full bg-green-600 text-white shadow" />
            </div>
    
            <h2 class="text-xl font-semibold text-gray-900 sm:text-2xl text-center">
                ¡Gracias por tu compra!
            </h2>
        </div>

        <p class="text-gray-500 text-center mb-6 md:mb-8">
            Your order <span class="font-medium text-gray-900 hover:underline">#7564804</span> 
            will be processed within 24 hours during working days. We will notify you by email once your order has been shipped.
        </p>

        <div class="space-y-4 sm:space-y-2 rounded-xl border border-gray-100 
        bg-gray-50 p-6 mb-6 md:mb-8 shadow-lg">
            @for ($i = 0; $i < 6; $i++)
                <dl class="sm:flex items-center justify-between gap-4">
                    <dt class="font-normal mb-1 sm:mb-0 text-gray-500">Referencia</dt>
                    <dd class="font-medium text-gray-900 sm:text-end">#ZFH-485</dd>
                </dl>
            @endfor
        </div>

        <div class="flex items-center space-x-4">
            <x-button size="large" type="secondary">Ver en mis pedidos</x-button>
            <x-button :href="route('ecommerce.products')" size="large" type="secondary">Seguir comprando </x-button>
        </div>
    </div>
  </section>

@endsection