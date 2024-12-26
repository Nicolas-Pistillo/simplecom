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
                        Retiro en local
                    </label>
                </div>
            </div>
        </fieldset>

        @if ($form->delivery_type === DeliveryType::Picking)
            @include('ecommerce.partials.checkout.ecommerce_pickup')
        @endif

        @if ($form->delivery_type === DeliveryType::Shipping)

            @if ($form->show_confirmation)
                
                <div class="col-span-full">

                    <h4 class="text-sm/6 font-semibold text-gray-900">Forma de envío seleccionada</h4>

                    @if ($form->selected_branch)
                        {{-- Confirm selected dropoff point --}}

                        <div class="w-full md:w-3/4 mt-3 relative border border-solid border-gray-200 
                        rounded-2xl p-4 transition-all duration-500 xl:p-7 bg-white">

                            <div class="flex items-center text-blue-600 mb-3">
                                <x-icon code="location_pin" class="mr-1" />
                                <h4 class="text-sm font-semibold">Punto de retiro</h4>
                            </div>

                            <div class="flex items-center justify-between gap-y-2 gap-x-4 flex-wrap mb-3">
                                <h4 class="text-sm sm:text-base text-gray-900 transition-all duration-500">
                                    <span class="font-semibold">
                                        Retiras en: {{ $form->selected_branch['name'] }}
                                    </span>
                                </h4>

                                <x-button wire:click='changeDropoffPoint' size="small" type="secondary" 
                                class="flex items-center">
                                    <x-icon code="edit_location_alt" style="font-size: 18px" />
                                    Cambiar punto
                                </x-button>
                            </div>

                            <p class="flex justify-between font-normal text-gray-500 transition-all 
                            duration-500 leading-5 text-xs mb-1 gap-x-3">
                                <span class="font-semibold">Servicio</span>
                                <span class="text-right">{{ $form->selected_rate['service_name'] }}</span>
                            </p>

                            <p class="flex justify-between font-normal text-gray-500 transition-all 
                            duration-500 leading-5 text-xs mb-1 gap-x-3">
                                <span class="font-semibold">Dirección</span>
                                <span class="text-right">
                                    {{ data_get($form->selected_branch, 'address.street') }}
                                    {{ data_get($form->selected_branch, 'address.number') }} -
                                    {{ data_get($form->selected_branch, 'address.locality') }}
                                </span>
                            </p>

                            <p class="flex justify-between font-normal text-gray-500 transition-all 
                            duration-500 leading-5 text-xs mb-1 gap-x-3">
                                <span class="font-semibold">Estimado</span>
                                <span class="text-right">{{ $form->selected_rate['estimate'] }}</span>
                            </p>

                            <p class="flex justify-between font-normal text-gray-500 transition-all 
                            duration-500 leading-5 text-xs mb-1 gap-x-3">
                                <span class="font-semibold">Telefono</span>
                                <span class="text-right">(011) 42150-618455-3</span>
                            </p>

                            <p class="flex justify-between font-normal text-gray-500 transition-all 
                            duration-500 leading-5 text-xs mb-1 gap-x-3">
                                <span class="font-semibold">Horarios</span>
                                <span class="text-right">Lunes a viernes de 17:00 a 18:00 - Fines de semana CERRADO</span>
                            </p>
                        </div>
                        
                    @else
                        {{-- Confirm shipping rate service --}}
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
                    @endif
                </div>

            @else

                @if (!$form->selected_address)
                    {{-- Select or create shipping address --}}
                    <fieldset wire:loading.remove wire:target='selectAddress' 
                    class="col-span-full animate__animated animate__fadeIn">
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
                                                    <x-icon code="location_pin" class="mr-1" /> 
                                                    {{ !empty($address->tag) ? $address->tag : 'Sin etiqueta' }}
                                                </span>
                                                <span class="mt-1 flex items-center text-xs text-gray-500">
                                                    {{ $address->summary }}
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

                <div wire:loading wire:target='selectAddress' class="col-span-full">
                    <div class="flex items-center gap-3 mt-4 text-sm text-gray-800">
                        <x-spinner spinnerclass="!w-4 !h-4" /> Buscando opciones de envío...
                    </div>
                </div>

                @if ($form->selected_address)
                    <div class="col-span-full animate__animated animate__fadeIn">

                        {{-- Select shipping rate --}}
                        @if ($form->show_rates_results)
                            @include('ecommerce.partials.checkout.rates_result_selection')
                        @endif

                        {{-- Select dropoff point --}}
                        @if ($form->show_dropoff_selection)
                            @livewire('ecommerce.dropoff-point-selector', compact('form'))
                        @endif
                    </div>     
                @endif
            @endif
        @endif
    </div>
</div>
