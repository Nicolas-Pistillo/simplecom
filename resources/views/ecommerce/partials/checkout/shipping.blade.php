<div x-data x-init="window.scrollTo({ top: 0, behavior: 'smooth' })" class="animate__animated animate__bounceInLeft">

    <div class="grid grid-cols-12 gap-x-4 gap-y-3 items-end">

        <fieldset class="col-span-full mb-3 no-select">
            <legend class="text-sm/6 font-semibold text-gray-900">Forma de entrega</legend>
            <p class="mt-1 text-sm/6 text-gray-600">Elige como quieres recibir tu compra</p>

            <div class="mt-3 flex items-center space-x-10 space-y-0">

                <div class="flex items-center">
                    <input wire:model.live='form.delivery_type' value="{{ DeliveryType::Shipping }}"
                        id="shipping_delivery" name="delivery_type" type="radio"
                        class="size-4 border-gray-300 text-blue-600 focus:ring-blue-600">
                    <label for="shipping_delivery" class="ml-3 block text-sm/6 font-medium text-gray-900">
                        Envío
                    </label>
                </div>

                <div class="flex items-center">
                    <input wire:model.live='form.delivery_type' value="{{ DeliveryType::Picking }}"
                        id="picking_delivery" name="delivery_type" type="radio"
                        class="size-4 border-gray-300 text-blue-600 focus:ring-blue-600">
                    <label for="picking_delivery" class="ml-3 no-select block text-sm/6 font-medium text-gray-900">
                        Retiro
                    </label>
                </div>
            </div>
        </fieldset>

        @if ($form->delivery_type === DeliveryType::Picking)

            <div class="col-span-full animate__animated animate__fadeIn">
                <h4 class="text-sm/6 font-semibold text-gray-900">Elija un punto de retiro</h4>
            </div>

            <fieldset class="col-span-full rounded-lg overflow-hidden 
            border shadow-sm animate__animated animate__fadeIn" aria-label="Shipping Rates">
                <div class="-space-y-px bg-white transition-colors duration-300 hover:bg-gray-50">
                    <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">
                        <input type="radio" name="shipping_method"
                            class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
                        text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
                        active:ring-offset-2">
                        <div class="ml-3 flex items-center justify-between w-full">
                            <div class="flex items-center text-sm">
                                <div
                                    class="w-10 h-10 flex items-center justify-center shadow bg-gray-100 rounded-xl mr-2">
                                    <x-icon code="location_on" class="text-gray-600" />
                                </div>
                                <div>
                                    <h5 class="font-medium mb-0.5 text-xs sm:text-sm">Av. Ramos Mejía 14450 esquina
                                        Plaza Constitución</h5>
                                </div>
                            </div>
                            <div>
                                <span class="text-sm font-medium ml-4">${{ priceFormat(2500.99) }}</span>
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
                                <div
                                    class="w-10 h-10 flex items-center justify-center shadow bg-gray-100 rounded-xl mr-2">
                                    <x-icon code="location_on" class="text-gray-600" />
                                </div>
                                <div>
                                    <h5 class="font-medium mb-0.5 text-xs sm:text-sm">Coronel Lynch 2003 - Barrio Nuevo
                                        CABA</h5>
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
                                <div
                                    class="w-10 h-10 flex items-center justify-center shadow bg-gray-100 rounded-xl mr-2">
                                    <x-icon code="location_on" class="text-gray-600" />
                                </div>
                                <div>
                                    <h5 class="font-medium mb-0.5 text-xs sm:text-sm">Calle 156 2600 - Berazategui Oeste
                                        Esq. Piñeiro</h5>
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

        @if ($form->delivery_type === DeliveryType::Shipping)

            @if ($form->selected_address)
                {{-- Shipping To: --}}
                <div class="col-span-full animate__animated animate__fadeIn">

                    <h4 class="text-sm/6 font-semibold text-gray-900">Enviar a</h4>

                    <div class="flex items-center gap-2 flex-wrap sm:flex-nowrap">

                        <label class="mt-1 no-select w-full sm:w-max relative flex rounded-lg 
                        bg-white p-4 shadow focus:outline-hidden border border-gray-300">
                            <div class="flex flex-1">
                                <div class="flex flex-col">
                                    <span class="flex items-center text-sm font-medium text-gray-900">
                                        <x-icon code="location_pin" class="mr-1" /> 
                                        {{ $form->selected_address->street }} {{ $form->selected_address->number }} - CP {{ $form->selected_address->zipcode }}
                                    </span>
                                </div>
                            </div>
                        </label>

                        <button wire:click='changeAddress' class="mt-2 py-2 px-4 w-max border bg-white rounded-full 
                        text-xs text-gray-700 flex items-center cursor-pointer
                        transition duration-300 hover:shadow-md hover:text-gray-900">
                            <span>Modificar</span>
                        </button>
                    </div>
                </div>     
            @else
                {{-- Select or create shipping address --}}
                <fieldset class="col-span-full animate__animated animate__fadeIn">
                    <legend class="text-sm/6 font-semibold text-gray-900">Seleccionar dirección</legend>
                    <p class="mt-1 text-sm/6 text-gray-600">Elige o agrega una dirección para calcular el envío</p>

                    <div class="mt-3 flex items-end gap-3 flex-wrap">
                        @forelse ($form->addresses as $address)

                            <label wire:key='{{ $address->id }}' wire:click='selectAddress({{ $address->id }})'
                                @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                                class="no-select w-full sm:w-max relative flex cursor-pointer rounded-lg border 
                                bg-white hover:bg-gray-50 transition-colors duration-300 
                                p-4 shadow focus:outline-hidden border-transparent">
                                    <div class="flex flex-1">
                                        <div class="flex flex-col">
                                            <span class="flex items-center text-sm font-medium text-gray-900">
                                                <x-icon code="location_pin" class="mr-1" /> {{ $address->name ?? 'Sin etiqueta' }}
                                            </span>
                                            <span class="mt-1 flex items-center text-xs text-gray-500">
                                                {{ $address->street }} {{ $address->number }} - {{ $address->locality }}
                                            </span>
                                        </div>
                                    </div>
                            </label>  
                        @empty
                        @endforelse

                        <label @click="$dispatch('open-new-address-panel')" 
                        class="no-select w-max relative flex items-center justify-center cursor-pointer 
                        rounded-lg border-2 border-dashed bg-white hover:bg-gray-50 transition-colors duration-300 
                        p-4 focus:outline-hidden">
                            <div class="text-center text-blue-500 text-xs">
                                <x-icon code="add_circle" />
                                <h4>Agregar dirección</h4>
                            </div>
                        </label>
                    </div>
                </fieldset>
            @endif

            <div wire:loading wire:target='getShippingRates' class="col-span-full">
                <div class="flex items-center gap-3 mt-4 text-sm text-gray-800">
                    <x-spinner spinnerclass="!w-4 !h-4" /> Buscando opciones de envío...
                </div>
            </div>

            @if (isset($form->shipping_rates) && $form->shipping_rates->isNotEmpty())

                <fieldset wire:loading.remove wire:target='getShippingRates' aria-label="Shipping Rates"
                    class="col-span-full mt-4 rounded-lg overflow-hidden border shadow-sm">
                    @foreach ($form->shipping_rates as $rate)
                        <div wire:key='{{ $rate['service_id'] }}'
                            class="-space-y-px bg-white transition-colors duration-300 hover:bg-gray-50">
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
                                            <h5 class="font-medium mb-0.5 text-xs sm:text-sm">
                                                {{ $rate['service_name'] }}</h5>
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

            @endif

            <div>
                <x-button wire:click='summaryStep' :disabled="true" size="big" class="mt-8">
                    Continuar
                </x-button>
            </div>
        @endif
    </div>
</div>
