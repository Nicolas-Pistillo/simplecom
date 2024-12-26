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
                    <h1>Confirmar direccion aca</h1>

                    @dump($form->show_confirmation, $form->selected_rate, $form->selected_branch)
                </div>

            @else

                @if (!$form->selected_address)
                    @include('ecommerce.partials.checkout.address_selection')
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

                        {{-- Select carrier dropoff points --}}
                        @if ($form->show_dropoff_selection)
                            @livewire('ecommerce.dropoff-point-selector', compact('form'))
                        @endif
                    </div>     
                @endif
            @endif
        @endif
    </div>
</div>
