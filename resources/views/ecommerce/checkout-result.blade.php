@extends('layouts.ecommerce')

@section('content')
    
    <section class="relative py-10 md:py-16">

        <div class="w-full absolute bg-{{ $order->payment->status->color() }}-600 top-0 left-0 h-[410px] object-cover"></div>

        <div class="w-full max-w-7xl mx-auto px-6 md:px-8">

            <div class="animate__animated animate__fadeInDown flex items-center justify-center relative mb-6 w-max mx-auto">

                <div class="h-16 w-16 p-3 flex items-center justify-center 
                rounded-full bg-white text-{{ $order->payment->status->color() }}-600">
                    <x-icon code="{{ $order->payment->status->icon() }}" />
                </div>

            </div>

            <div class="w-full relative bg-white py-8 px-6 sm:py-12 sm:px-8 max-w-6xl mx-auto shadow-lg rounded-lg">

                <div class="flex items-center flex-col text-center gap-2 pb-6 lg:pb-10">

                    {{-- <span class="font-semibold text-gray-600">Pedido {{ $order->id }}</span> --}}

                    <h3 class="text-center font-bold text-2xl sm:text-3xl text-gray-900">
                        {{ $order->status->customerName() }}
                    </h3>

                    <p class="font-normal text-base leading-7 text-{{ $order->payment->status->color() }}-600">
                        {{ $order->payment->status->customerHelper() }}
                    </p>
                </div> 

                <div class="flex items-center justify-center sm:justify-between flex-wrap gap-3">

                    <h2 class="text-lg sm:text-xl font-semibold text-gray-900 w-full sm:w-auto 
                    text-center sm:text-left">Pedido {{ $order->id }}</h2>

                    <div class="flex items-center flex-wrap gap-3">
                        <x-button :href="route('customer.orders.index')" type="secondary" class="w-full sm:w-auto text-center">
                            Ver en mis pedidos
                        </x-button>
                        <x-button type="secondary" :href="route('ecommerce.products')" class="w-full sm:w-auto text-center">
                            Seguir comprando
                        </x-button>
                    </div>
                </div>

                @if ($order->paymentMethod->code === 'transfer')
                    <div class="mt-6 p-5 rounded-xl border border-gray-200
                    flex-col justify-start items-start gap-5 flex w-full sm:w-4/5">
                        <h3 class="text-gray-900 text-base sm:text-xl font-semibold leading-loose">
                            Datos para transferir
                        </h3>
                        <div class="w-full flex-col justify-start items-start gap-3.5 flex">
                            <div class="w-full flex-col justify-start items-start gap-3.5 flex">

                                @if (!empty($bankName = tenant()->configValue('transfer_bank')))
                                    <div class="w-full justify-between items-center flex gap-6 text-sm sm:text-base">
                                        <h6 class="text-gray-600 font-normal">Banco</h6>
                                        <h6 class="text-right text-gray-900 font-semibold">
                                            {{ $bankName }}
                                        </h6>
                                    </div>
                                @endif

                                @if (!empty($bankAccountOwner = tenant()->configValue('transfer_account_owner')))
                                    <div class="w-full justify-between items-center flex gap-6 text-sm sm:text-base">
                                        <h6 class="text-gray-600 font-normal">Titular</h6>
                                        <h6 class="text-right text-gray-900 font-semibold">
                                            {{ $bankAccountOwner }}
                                        </h6>
                                    </div>
                                @endif

                                @if (!empty($bankAlias = tenant()->configValue('transfer_alias')))
                                    <div class="w-full justify-between items-center gap-6 flex text-sm sm:text-base">
                                        <h6 class="text-gray-600 font-normal">Alias</h6>
                                        <h6 class="text-right text-gray-900 font-semibold">
                                            {{ $bankAlias }}
                                        </h6>
                                    </div>
                                @endif

                                @if (!empty($bankCBU = tenant()->configValue('transfer_cbu')))
                                    <div class="w-full justify-between items-center gap-6 flex text-sm sm:text-base">
                                        <h6 class="text-gray-600 font-normal">CBU</h6>
                                        <h6 class="text-right text-gray-900 font-semibold">
                                            {{ $bankCBU }}
                                        </h6>
                                    </div>
                                @endif

                                <div class="w-full justify-between items-center inline-flex text-sm sm:text-base">
                                    <h6 class="text-gray-600 font-normal gap-6">Monto</h6>
                                    <h6 class="text-right text-gray-900 font-semibold">
                                        ${{ priceFormat($order->total) }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <ul role="list" class="mt-6 divide-y divide-gray-200
                text-sm font-medium text-gray-500 border-t border-gray-200">
                    @foreach ($order->items as $item)
                        <li class="no-select flex space-x-6 py-6 items-center">
            
                            <img src="{{ $item->product->first_image }}" alt="Imagen producto"
                            class="hidden sm:block h-10 w-10 flex-none rounded-md 
                            bg-gray-100 object-contain">
            
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
