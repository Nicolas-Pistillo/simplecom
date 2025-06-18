<div class="col-span-full" x-init="window.scrollTo({ top: 0, behavior: 'smooth' })">

    <h4 class="text-sm/6 font-semibold text-gray-900">Punto de retiro seleccionado</h4>

    <div class="flex items-center gap-x-3 flex-wrap">

        <button wire:click='changeDropoffPoint'
            class="mt-2 py-2 px-4 w-max border bg-white rounded-full 
            text-xs text-gray-700 flex items-center cursor-pointer
            transition duration-300 hover:shadow-md hover:text-gray-900">
            <span>Cambiar punto</span>
        </button>

        <button wire:click='changeShippingRate'
            class="mt-2 py-2 px-4 w-max border bg-white rounded-full 
            text-xs text-gray-700 flex items-center cursor-pointer
            transition duration-300 hover:shadow-md hover:text-gray-900">
            <span>Cambiar forma de envío</span>
        </button>
    </div>

    {{-- Selected dropoff point --}}
    <div class="w-full md:w-3/4 mt-3 relative border border-solid border-gray-200 
    rounded-2xl p-4 transition-all duration-500 xl:p-7 bg-white">

        <div class="flex items-center justify-between mb-2">

            <div class="flex items-center text-blue-600">
                <x-icon code="location_pin" class="mr-1" />
                <h4 class="text-sm font-semibold">Punto de retiro</h4>
            </div>

            <a href="https://maps.google.com/?q={{ data_get($form->selected_branch, 'address.coordinates.lat') }},{{ data_get($form->selected_branch, 'address.coordinates.lng') }}" target="_blank">
                <x-icon code="moved_location" x-tooltip.raw.placement.top="Ver en mapa"
                class="p-2 border rounded-full transition duration-300 
                hover:bg-gray-50 text-gray-700" style="font-size: 20px" />
            </a>
        </div>

        <h4 class="text-sm sm:text-base text-gray-900 transition-all duration-500 mb-3">
            <span class="font-semibold">
                {{ $form->selected_branch['name'] }}
            </span>
        </h4>

        <p class="flex justify-between font-normal text-gray-500 transition-all 
        duration-500 leading-5 text-xs mb-1 gap-x-3">
            <span class="font-semibold">Servicio</span>
            <span class="text-right">{{ $form->selected_rate['service_name'] }}</span>
        </p>

        <p class="flex justify-between font-normal text-gray-500 transition-all 
        duration-500 leading-5 text-xs mb-1 gap-x-3">
            <span class="font-semibold">Precio</span>
            <span class="text-right">${{ priceFormat($form->selected_rate['price']) }}</span>
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

        @if (!empty($form->selected_branch['phone']))
            <p class="flex justify-between font-normal text-gray-500 transition-all 
            duration-500 leading-5 text-xs mb-1 gap-x-3">
                <span class="font-semibold">Telefono</span>
                <span class="text-right">{{ $form->selected_branch['phone'] }}</span>
            </p>
        @endif

        @if (!empty($form->selected_branch['schedule']))
            <p class="flex justify-between font-normal text-gray-500 transition-all 
            duration-500 leading-5 text-xs mb-1 gap-x-3">
                <span class="font-semibold">Horarios</span>
                <span class="text-right">{{ $form->selected_branch['schedule'] }}</span>
            </p>
        @endif
    </div>

    <div wire:loading.remove wire:target='selectAddress' class="flex items-center gap-3 mt-8">

        <x-button wire:click='changeShippingRate' type="soft" size="big" class="!shadow">
            Volver
        </x-button>

        <x-button wire:click='setStep(3)' :disabled="!isset($form->selected_branch)" size="big">
            Continuar
        </x-button>
    </div>
</div>