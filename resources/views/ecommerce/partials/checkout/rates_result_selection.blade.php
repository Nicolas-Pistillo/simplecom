<div x-init="window.scrollTo({ top: 0, behavior: 'smooth' })">
    <h4 class="text-sm/6 font-semibold text-gray-900">Enviar a</h4>

    <div class="flex items-center gap-2 flex-wrap sm:flex-nowrap">

        <label class="mt-1 no-select w-full sm:w-max relative flex rounded-lg 
        bg-white p-4 focus:outline-hidden border border-gray-300">
            <div class="flex flex-1">
                <div class="flex flex-col">
                    <span class="flex items-center text-sm font-medium text-gray-900">
                        <x-icon code="location_pin" class="mr-1" />
                        {{ $form->selected_address->summary }}
                    </span>
                </div>
            </div>
        </label>

        <button wire:click='changeAddress'
            class="mt-2 py-2 px-4 w-max border bg-white rounded-full 
            text-xs text-gray-700 flex items-center cursor-pointer
            transition duration-300 hover:shadow-md hover:text-gray-900">
            <span>Modificar</span>
        </button>
    </div>

    <div class="max-w-xl col-span-full mt-4">
        @if (!empty(session('rates_results')))
            <div>
                <h4 class="text-sm/6 font-semibold text-gray-900">
                    Seleccionar opción de envío
                </h4>

                <fieldset wire:loading.remove wire:target='getShippingRates'
                    class="mt-1 rounded-lg overflow-hidden border shadow-sm">

                    @if (!empty(session('rates_results.dropoff_rates')))
                        <div wire:click='showDropoffSelection'
                        class="-space-y-px bg-white transition-colors duration-300 hover:bg-gray-50">
                            <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">

                                <input type="radio" name="shipping_method"
                                class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
                                text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
                                active:ring-offset-2">

                                <span class="ml-3 flex items-center justify-between w-full">
                                    <div class="flex items-center text-sm">

                                        <div class="w-10 h-10 flex items-center justify-center 
                                        shadow bg-white rounded-xl mr-2">
                                            <x-icon code="store" class="text-gray-700" />
                                        </div>

                                        <div>
                                            <h5 class="font-medium mb-0.5 text-xs sm:text-sm">
                                                Envío a sucursal
                                            </h5>
                                            <span class="block text-xs text-gray-700">
                                                Retiro en sucursal de transporte
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="flex items-center justify-center font-medium ml-4">
                                            <x-icon code="chevron_forward" class="text-gray-500" />
                                        </span>
                                    </div>
                                </span>
                            </label>
                        </div>
                    @endif

                    @foreach (session('rates_results.shipping_rates') as $rate)
                        <div wire:key='{{ $rate->key }}'
                            class="-space-y-px bg-white transition-colors duration-300 hover:bg-gray-50">
                            <label class="relative flex items-center cursor-pointer border-b p-4 focus:outline-none">

                                <input type="radio" name="shipping_method"
                                class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
                                text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
                                active:ring-offset-2">

                                <span class="ml-3 flex items-center justify-between w-full">
                                    <div class="flex items-center text-sm">
                                        @if ($rate->carrier_logo)
                                            <img src="{{ $rate->carrier_logo }}"
                                            class="w-10 h-10 object-contain shadow 
                                            rounded-xl mr-2 bg-white"
                                            alt="Carrier Logo">
                                        @else
                                            <div
                                                class="w-10 h-10 flex items-center justify-center shadow 
                                            bg-white rounded-xl mr-2">
                                                <x-icon code="delivery_truck_speed" class="text-gray-700" />
                                            </div>
                                        @endif

                                        <div>
                                            <h5 class="font-medium mb-0.5 text-xs sm:text-sm">
                                                {{ $rate->label }}
                                            </h5>
                                            <span class="block text-xs text-gray-700">
                                                Estimado: {{ $rate->estimate }}
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium ml-4">${{ priceFormat($rate->price) }}</span>
                                    </div>
                                </span>
                            </label>
                        </div>
                    @endforeach
                </fieldset>
            </div>
        @endif
    </div>

    {{-- <div wire:loading.remove wire:target='selectAddress' class="flex items-center gap-3 mt-8">

        <x-button wire:click='setStep(1)' type="soft" :disabled="false" size="big" class="!shadow">
            Volver
        </x-button>

        <x-button wire:click='summaryStep' :disabled="true" size="big">
            Continuar
        </x-button>
    </div> --}}
</div>