<div x-data x-init="window.scrollTo({ top: 0, behavior: 'smooth' })"
class="animate__animated animate__bounceInLeft">

    <div class="grid grid-cols-12 gap-x-4 gap-y-3 items-end">

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

        <div class="col-span-full sm:col-span-6">
            <x-button type="secondary" wire:click="getShippingRates" size="large">Calcular</x-button>
        </div>

        @error('form.customer_postal_code')
            <small class="text-red-500 col-span-full sm:col-span-8">
                {{ $message }}
            </small>
        @enderror

    </div>

    <div wire:loading wire:target='getShippingRates'>
        <div class="flex w-full items-center gap-3 mt-8 text-sm text-gray-800">
            <x-spinner spinnerclass="!w-4 !h-4" /> Cargando opciones de envío...
        </div>
    </div>

    @if (isset($shipping_rates) && $shipping_rates->isNotEmpty())

        <fieldset class="col-span-full mt-8" aria-label="Shipping Rates">
            @foreach ($shipping_rates as $rate)
                <div class="-space-y-px rounded-md bg-white">                        
                    <label class="relative flex cursor-pointer rounded-tl-md rounded-tr-md border p-4 focus:outline-none">
                        <input type="radio" class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 
                        text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 
                        active:ring-offset-2">
                        <span class="ml-3 flex flex-col">
                            <div class="flex items-center text-sm font-medium">
                                <img src="{{ $rate['carrier_logo'] }}" class="w-8 h-8" alt="Carrier Logo">
                                {{ $rate['carrier_name'] }}
                            </div>
                            <span class="block text-sm">{{ $rate['service_name'] }}</span>
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

</div>
