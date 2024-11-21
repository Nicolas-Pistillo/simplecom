<div x-data x-init="window.scrollTo({ top: 0, behavior: 'smooth' })" class="animate__animated animate__bounceInLeft">

    <div class="grid grid-cols-12 gap-x-4 gap-y-3 items-end">

        <fieldset class="col-span-full mb-6 no-select">
            <legend class="text-sm/6 font-semibold text-gray-900">Forma de entrega</legend>
            <p class="mt-1 text-sm/6 text-gray-600">Elige como quieres recibir tu compra</p>

            <div class="mt-3 flex items-center space-x-10 space-y-0">

                <div class="flex items-center">
                    <input wire:model.live='delivery_type' value="{{ DeliveryType::Shipping }}" 
                    id="shipping_delivery" name="delivery_type" type="radio"
                    class="size-4 border-gray-300 text-blue-600 focus:ring-blue-600">
                    <label for="shipping_delivery" class="ml-3 block text-sm/6 font-medium text-gray-900">
                        Envío
                    </label>
                </div>

                <div class="flex items-center">
                    <input wire:model.live='delivery_type' value="{{ DeliveryType::Withdraw }}" 
                    id="withdraw_delivery" name="delivery_type" type="radio"
                    class="size-4 border-gray-300 text-blue-600 focus:ring-blue-600">
                    <label for="withdraw_delivery" class="ml-3 no-select block text-sm/6 font-medium text-gray-900">
                        Retiro personalmente
                    </label>
                </div>
            </div>
        </fieldset>

        @if ($delivery_type === DeliveryType::Withdraw)

            <div class="col-span-full">
                <h4 class="text-sm/6 font-semibold text-gray-900">Elija un punto de retiro</h4>
            </div>

            @php
                $rate = [
                    'carrier_id' => 127,
                    'carrier_code' => 'correoArgentino',
                    'carrier_name' => 'Correo Argentino',
                    'carrier_logo' =>
                        'https://s3.us-east-2.amazonaws.com/enviapaqueteria/uploads/logos/carriers/correoArgentino.svg',
                    'service_id' => 346,
                    'service_code' => 'priority_dom',
                    'service_name' => 'Correo Argentino Prioritario a Domicilio',
                    'rate_dropoff' => 0,
                    'rate_branches' => [],
                    'delivery_estimate' => '1-3 días',
                    'price' => 9466,
                    'total_tax' => null,
                ];
            @endphp
    
            <fieldset class="col-span-full rounded-lg overflow-hidden border shadow-sm" aria-label="Shipping Rates">
                <div class="-space-y-px bg-white transition-colors duration-300 hover:bg-gray-50">
                    <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">
                        <input type="radio" name="shipping_method"
                        class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
                        text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
                        active:ring-offset-2">
                        <div class="ml-3 flex items-center justify-between w-full">
                            <div class="flex items-center text-sm">
                                <div class="w-10 h-10 flex items-center justify-center shadow bg-gray-100 rounded-xl mr-2">
                                    <x-icon code="location_on" class="text-gray-600" />
                                </div>
                                <div>
                                    <h5 class="font-medium mb-0.5 text-xs sm:text-sm">Av. Ramos Mejía 14450 esquina Plaza Constitución</h5>
                                </div>
                            </div>
                            <div>
                                <span class="text-sm font-medium ml-4">${{ priceFormat($rate['price']) }}</span>
                            </div>
                        </div>
                    </label>
                </div>
                <div class="-space-y-px bg-white transition-colors duration-300 hover:bg-gray-50">
                    <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">
                        <input type="radio" name="shipping_method"
                        class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
                        text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
                        active:ring-offset-2">
                        <div class="ml-3 flex items-center justify-between w-full">
                            <div class="flex items-center text-sm">
                                <div class="w-10 h-10 flex items-center justify-center shadow bg-gray-100 rounded-xl mr-2">
                                    <x-icon code="location_on" class="text-gray-600" />
                                </div>
                                <div>
                                    <h5 class="font-medium mb-0.5 text-xs sm:text-sm">Coronel Lynch 2003 - Barrio Nuevo CABA</h5>
                                </div>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-green-700 ml-4">Gratis</span>
                            </div>
                        </div>
                    </label>
                </div>
                <div class="-space-y-px bg-white transition-colors duration-300 hover:bg-gray-50">
                    <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">
                        <input type="radio" name="shipping_method"
                        class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
                        text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
                        active:ring-offset-2">
                        <div class="ml-3 flex items-center justify-between w-full">
                            <div class="flex items-center text-sm">
                                <div class="w-10 h-10 flex items-center justify-center shadow bg-gray-100 rounded-xl mr-2">
                                    <x-icon code="location_on" class="text-gray-600" />
                                </div>
                                <div>
                                    <h5 class="font-medium mb-0.5 text-xs sm:text-sm">Calle 156 2600 - Berazategui Oeste Esq. Piñeiro</h5>
                                </div>
                            </div>
                            <div>
                                <x-button type="soft" href="https://maps.app.goo.gl/PgTffHG1nW5wjJXr6" blank 
                                class="ml-4 text-xs flex items-center">
                                    <x-icon code="moved_location" class="mr-1" /> Ver
                                </x-button>
                            </div>
                        </div>
                    </label>
                </div>
            </fieldset>

            <div class="flex items-center gap-3">

                <x-button wire:click='setStep(1)' type="soft" :disabled="false" size="big" class="mt-8 !shadow">
                    Volver
                </x-button>

                <x-button wire:click='setStep(3)' :disabled="false" size="big" class="mt-8">
                    Continuar
                </x-button>
            </div>
        @endif

        @if ($delivery_type === DeliveryType::Shipping)

            <div class="col-span-full sm:col-span-6">
                <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700">
                    Código postal
                </label>
                <div class="mt-1">
                    <input type="text" wire:model.live='form.customer_postal_code' id="shipping_postal_code"
                    name="shipping_postal_code"
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 
                    focus:ring-blue-500 sm:text-sm">
                </div>
            </div>

            <div wire:loading.remove wire:target='getShippingRates' class="col-span-full sm:col-span-6">
                <x-button type="secondary" wire:click="getShippingRates" size="large">Calcular</x-button>
            </div>

            @error('form.customer_postal_code')
                <small class="text-red-500 col-span-full">
                    {{ $message }}
                </small>
            @enderror

            <div wire:loading wire:target='getShippingRates' class="col-span-full">
                <div class="flex items-center gap-3 mt-4 text-sm text-gray-800">
                    <x-spinner spinnerclass="!w-4 !h-4" /> Buscando opciones de envío...
                </div>
            </div>
            
            @if (isset($shipping_rates) && $shipping_rates->isNotEmpty())
            
                <fieldset wire:loading.remove wire:target='getShippingRates' aria-label="Shipping Rates"
                    class="col-span-full mt-4 rounded-lg overflow-hidden border shadow-sm">
                    @foreach ($shipping_rates as $rate)
                        <div wire:key='{{ $rate['service_id'] }}'
                            class="-space-y-px bg-white
                            transition-colors duration-300 hover:bg-gray-50">
                            <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">
                                <input type="radio" name="shipping_method"
                                    class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
                                    text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
                                    active:ring-offset-2">
                                <span class="ml-3 flex items-center justify-between w-full">
                                    <div class="flex items-center text-sm">
                                        <img src="{{ $rate['carrier_logo'] }}" class="w-10 h-10 shadow rounded-xl mr-2"
                                            alt="Carrier Logo">
                                        <div>
                                            <h5 class="font-medium mb-0.5 text-xs sm:text-sm">{{ $rate['service_name'] }}</h5>
                                            <span class="block text-xs text-gray-700">
                                                Estimado: {{ $rate['delivery_estimate'] }}
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium ml-4">${{ priceFormat($rate['price']) }}</span>
                                    </div>
                                </span>
                            </label>
                        </div>
                    @endforeach
                </fieldset>
            
                {{-- array:12 [ // resources/views/ecommerce/partials/checkout/shipping.blade.php
                        "carrier_id" => 127
                        "carrier_code" => "correoArgentino"
                        "carrier_name" => "Correo Argentino"
                        "carrier_logo" => "https://s3.us-east-2.amazonaws.com/enviapaqueteria/uploads/logos/carriers/correoArgentino.svg"
                        "service_id" => 346
                        "service_code" => "priority_dom"
                        "service_name" => "Correo Argentino Prioritario a Domicilio"
                        "rate_dropoff" => 0
                        "rate_branches" => []
                        "delivery_estimate" => "1-3 días"
                        "price" => 9466
                        "total_tax" => null
                    ] --}}
            @endif

            <div>
                <x-button wire:click='setStep(3)' :disabled="true" size="big" class="mt-8">
                    Continuar
                </x-button>
            </div>
        @endif

    </div>

</div>
