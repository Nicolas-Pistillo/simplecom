@extends('layouts.ecommerce')

@section('content')
    
    <section class="relative py-16">

        <div class="w-full absolute bg-{{ $order->payment->status->display_color }}-600 top-0 left-0 h-[410px] object-cover"></div>

        <div class="w-full max-w-7xl mx-auto px-6 md:px-8">

            <div class="animate__animated animate__fadeInDown flex items-center justify-center relative mb-6 w-max mx-auto">

                <div class="h-16 w-16 p-3 flex items-center justify-center 
                rounded-full bg-white text-{{ $order->payment->status->display_color }}-600">
                    <x-icon code="{{ $order->payment->status_code->icon() }}" />
                </div>

            </div>

            <div class="w-full relative bg-white py-8 px-6 sm:py-12 sm:px-8 max-w-6xl mx-auto shadow-lg rounded-lg">

                <div class="flex items-center flex-col gap-2 pb-6 lg:pb-10">

                    {{-- <span class="font-semibold text-gray-600">Pedido {{ $order->code }}</span> --}}

                    <h3 class="text-center font-bold text-2xl sm:text-3xl text-gray-900">
                        {{ $order->status->customer_name }}
                    </h3>

                    <p class="font-normal text-base leading-7 text-{{ $order->payment->status->display_color }}-600">
                        {{ $order->payment->status->customer_helper }}
                    </p>
                </div> 

                <div class="flex items-center justify-center sm:justify-between flex-wrap gap-3">
                    <h2 class="text-lg sm:text-xl font-semibold text-gray-700">Pedido {{ $order->code }}</h2>
                    <div class="flex items-center flex-wrap gap-3">
                        <x-button type="secondary" class="w-full sm:w-auto">
                            Ver en mis pedidos
                        </x-button>
                        <x-button type="secondary" :href="route('ecommerce.products')" class="w-full sm:w-auto">
                            Seguir comprando
                        </x-button>
                    </div>
                </div>

                <ul role="list" class="mt-6 divide-y divide-gray-200
                text-sm font-medium text-gray-500 border-t border-gray-200">
                    @foreach ($order->items as $item)
                        <li class="no-select flex space-x-6 py-6 items-center">
            
                            <img src="{{ $item->product->first_image }}" alt="Imagen producto"
                            class="hidden sm:block h-10 w-10 flex-none rounded-md bg-gray-100 object-cover">
            
                            <div class="flex-auto space-y-1">
            
                                <h3 class="text-gray-900 line-clamp-2">
                                    {{ $item->product->name }}
                                </h3>
            
                                <p class="text-xs text-gray-500">
                                    Cantidad: {{ $item->quantity }}
                                </p>
            
                                @if ($item->variant && isset($item->variant->options))
                                    @foreach ($item->variant->options as $variantOption)
                                        <p class="text-xs text-gray-500">
                                            {{ $variantOption->attribute->name }}:
                                            {{ $variantOption->attributeValue->name }}
                                        </p>
                                    @endforeach
                                @endif
                            </div>
            
                            <p class="text-right font-medium text-gray-900">
                                ${{ priceFormat($item->total) }} <br>
                            </p>
            
                            {{-- <section x-show="detailItemOpen" x-cloak class="relative py-8 sm:p-8 cursor-default">
                                <div class="w-full max-w-7xl mx-auto px-4 lg:px-8 xl:px-14 relative">
                                    <div class="w-full relative flex justify-center">
                                        <div class="w-full h-full fixed top-0 left-0 z-[60] overflow-x-hidden overflow-y-auto">
                                            <div class="opacity-1 ease-out sm:max-w-sm sm:w-full m-5 relative top-1/2 -translate-y-1/2 sm:mx-auto modal-open:opacity-100 transition-all modal-open:duration-500">
                                                <div class="flex items-start bg-white p-6 rounded-lg">
                                                    <div class="block w-full">
                        
                                                        <div class="flex items-center justify-between mb-1">
                                                            <h6 class="text-lg font-bold leading-8 text-gray-900">
                                                                <div class="flex items-center">
                                                                    <img class="h-8 w-8 mr-2 object-cover rounded-full" 
                                                                    src="{{ $item->product->first_image }}">
                                                                    <span class="line-clamp-1">{{ $item->name }}</span>
                                                                </div>
                                                            </h6>
                        
                                                            <x-icon code="close" @click="detailItemOpen = false"
                                                            class="transition colors duration-300 text-[18px] ml-1
                                                            cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                                                        hover:bg-gray-200 focus:outline-none focus:ring" />
                                                        </div>
                        
                                                        <p class="text-xs font-normal text-gray-500 mb-5">
                                                            Note: Some payment providers issue a temporary authorization charge
                                                        </p>
                        
                                                        <div class="flex flex-col gap-4 mb-5">
                                                            <div class="relative">
                                                                <label class="flex  items-center mb-2 text-gray-600 text-xs font-medium">Card
                                                                    Number
                                                                </label>
                                                                <input type="text" id="default-search"
                                                                    class="block w-full  px-4 py-2 text-sm font-normal shadow-xs text-gray-900 bg-transparent border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none leading-relaxed"
                                                                    placeholder="1234 5678 9123 4567" required="">
                                                            </div>
                        
                                                            <div class="flex items-center gap-4">
                                                                <div class="relative">
                                                                    <label
                                                                        class="flex  items-center mb-2 text-gray-600 text-xs font-medium">Expiration
                                                                    </label>
                                                                    <input type="text" id="default-search"
                                                                        class="block w-full  px-4 py-2 text-sm font-normal shadow-xs text-gray-900 bg-transparent border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none leading-relaxed"
                                                                        placeholder="01/23" required="">
                                                                </div>
                                                                <div class="relative">
                                                                    <label class="flex  items-center mb-2 text-gray-600 text-xs font-medium">CVC
                                                                    </label>
                                                                    <input type="text" id="default-search"
                                                                        class="block w-full  px-4 py-2 text-sm font-normal shadow-xs text-gray-900 bg-transparent border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none leading-relaxed"
                                                                        placeholder="201" required="">
                                                                </div>
                                                            </div>
                        
                                                            <div class="relative">
                                                                <label class="flex  items-center mb-2 text-gray-600 text-xs font-medium">Name on
                                                                    Card
                                                                </label>
                                                                <input type="text" id="default-search"
                                                                    class="block w-full  px-4 py-2 text-sm font-normal shadow-xs text-gray-900 bg-transparent border border-gray-200 rounded-lg placeholder-gray-400 focus:outline-none leading-relaxed"
                                                                    placeholder="John smith" required="">
                                                            </div>
                                                        </div>
                        
                                                        <div class="flex items-center gap-4">
                                                            <button
                                                                class="py-2.5 px-3.5 w-full text-center rounded-lg border border-blue-600 hover:bg-blue-50 text-sm font-medium text-blue-600 transition-all duration-500 close-modal-button"
                                                                data-pd-overlay="#modalBox-21" data-modal-target="modalBox-21">Cancel</button>
                                                            <button
                                                                class="py-2.5 px-3.5 w-full text-center rounded-lg bg-blue-600 transition-all duration-500 hover:bg-blue-700 text-sm font-medium text-white close-modal-button"
                                                                data-pd-overlay="#modalBox-21" data-modal-target="modalBox-21">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="backdrop" class="fixed top-0 left-0 w-full h-full bg-black/50 z-[50]">
                                        </div>
                                    </div>
                                </div>
                            </section> --}}
                        </li>
                    @endforeach
                </ul>

                <dl class="space-y-4 border-t border-gray-200 pt-4 text-sm font-medium text-gray-600">
                    <div class="flex justify-between">
                        <dt>Subtotal</dt>
                        <dd class="text-gray-900">
                            ${{ priceFormat($order->subtotal) }}
                        </dd>
                    </div>
            
                    @if ($order->shipping_cost > 0)
                        <div class="flex justify-between">
                            <dt class="flex flex-col">
            
                                Envío
            
                                @if ($order->shipping)
                                    <small class="text-gray-500 font-semibold">
                                        {{ $order->shipping->provider_label }}
                                    </small>
                                @endif
                            </dt>
                            <dd class="text-gray-900">
                                ${{ priceFormat($order->shipping_cost) }}
                            </dd>
                        </div>
                    @endif
            
                    <div class="flex items-center justify-between border-t 
                    border-gray-200 pt-6 text-gray-900 font-semibold">
                        <dt class="text-base">Total</dt>
                        <dd class="text-base">
                            ${{ priceFormat($order->total) }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </section>
@endsection
