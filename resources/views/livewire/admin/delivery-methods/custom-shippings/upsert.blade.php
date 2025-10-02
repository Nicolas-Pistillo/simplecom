<div>
    <x-button :href="route('admin.delivery-methods.custom-shippings.index')" type="secondary" class="inline-flex w-max h-max items-center mb-4">
        <x-icon code="arrow_back" class="mr-1" />
        Volver al listado
    </x-button>

    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:tracking-tight">
        {{ $method ? "Editando {$method->name}" : "Nueva forma de envío" }}
    </h2>

    <div x-data="{confirmOpen: false, targetProvinceOpen: false}" 
    x-on:open-confirm.window="confirmOpen = true"
    x-on:close-confirm.window="confirmOpen = false" 
    x-on:open-target-province.window="targetProvinceOpen = true"
    x-on:close-target-province.window="targetProvinceOpen = false" 
    class="my-8 space-y-8">

        {{-- Information section --}}
        <fieldset class="col-span-full p-4 border rounded-lg shadow-sm">

            <legend class="px-2 font-semibold text-gray-900">Información básica</legend>

            <div class="grid sm:grid-cols-12 mt-3 gap-4">

                <div class="col-span-full">
                    <span class="block text-sm mb-1 font-medium text-gray-900">Logo</span>
                    <div class="flex items-center gap-x-3 mt-2">

                        <img src="{{ $form->logo_preview ?? URL::to('img/no-image.jpg') }}" alt="custom shipping logo"
                        class="w-20 h-20 object-cover rounded-full">

                        <x-button wire:loading.remove wire:target='form.logo' 
                        file wireModel="form.logo" name="custom_shipping_logo" 
                        type="secondary">Elegir imagen</x-button>

                        <div wire:loading wire:target='form.logo'>
                            <span class="flex items-center gap-1.5 text-sm font-semibold">
                                Cargando...
                                <x-spinner />
                            </span>
                        </div>

                    </div>

                    @error('form.logo')
                        <small class="text-red-500 inline-block mt-2">{{ $message }}</small>
                    @enderror
                </div>

                <x-form-input model="form.name" class="sm:col-span-6" 
                label="Nombre" placeholder="Motomensajeria en CABA" />

                <x-form-input model="form.estimated_delivery" class="sm:col-span-6" label="Tiempo de entrega estimado" 
                placeholder="De 2 a 4 días hábiles" />

                <x-form-input model="form.price" class="sm:col-span-6" label="Precio" 
                helper="Si va a ser gratis, dejá este campo con valor 0" icon="attach_money" />

                <div class="sm:col-span-6">
                    <label class="inline-flex items-center gap-1 text-sm font-medium l
                    eading-6 text-gray-900 mb-2">
                        Marcar como activada
                        <x-icon code="info" class="text-blue-500 text-[18px]" 
                        x-tooltip.raw="Si la forma de envío no esta activada, no aparecerá para tus clientes" />
                    </label>
                    <div>
                        <x-switch wireModel="form.active" />
                    </div>
                </div>
            </div>
        </fieldset>

        {{-- Shipping zones section --}}
        <fieldset class="col-span-full p-4 border rounded-lg shadow-sm">

            <legend class="px-2 font-semibold text-gray-900">Zonas de envío</legend>

            <p class="text-sm text-gray-600 font-semibold">
                Hasta dónde llega la cobertura de esta opción de envío
            </p>

            <div class="mt-3 flex items-center flex-wrap gap-4">
                @foreach (ShippingZoneType::cases() as $zoneType)
                    <div class="flex items-center">

                        <input wire:model.live='form.shipping_zone_type' 
                        type="radio" value="{{ $zoneType->value }}"
                        id="{{ $zoneType->value }}" name="shipping_zone_type"
                        class="border-gray-300 text-blue-600 focus:ring-blue-600">

                        <label for="{{ $zoneType->value }}" class="ml-3 block text-sm/6 
                        font-medium text-gray-900">
                            {{ $zoneType->name() }}
                        </label>
                    </div>
                @endforeach
            </div>

            @if ($form->shipping_zone_type === ShippingZoneType::ByLocalities->value)
                @include('admin.delivery-methods.custom-shippings.partials.shipping-zones-by-locality')
            @endif

            @if ($form->shipping_zone_type === ShippingZoneType::ByZipcodes->value)
                @include('admin.delivery-methods.custom-shippings.partials.shipping-zones-by-zipcodes')
            @endif

            @if ($form->shipping_zone_type === ShippingZoneType::ByDistanceKm->value)
                <div class="flex items-center flex-wrap gap-2 text-sm mt-5">
                    <p class="w-full sm:w-auto">
                        El alcance de esta opción será hasta los
                    </p>
                    <x-form-input withoutErrors type="number" model="form.distance_km" class="w-24" />
                    kilómetros desde tu punto de origen
                </div>

                @error('form.distance_km')
                    <small class="text-red-500 inline-block mt-2">{{ $message }}</small>
                @enderror
            @endif
        </fieldset>

        {{-- Conditions section --}}
        <fieldset class="col-span-full p-4 border rounded-lg shadow-sm">

            <legend class="px-2 font-semibold text-gray-900">Condiciones (opcional)</legend>

            <p class="text-sm/6 text-gray-600 font-semibold">
                A partir de qué parámetro se mostrará esta opción
            </p>

            <div class="flex items-center flex-wrap gap-2 text-sm mt-3">
                <p class="w-full sm:w-auto">Cuando el precio del carrito sea mayor o igual a</p>
                <x-form-input type="number" model="form.conditions.cart_price_gte" 
                icon="attach_money" class="w-[150px]" />
            </div>

            <div class="flex items-center flex-wrap gap-2 text-sm mt-3">
                <p class="w-full sm:w-auto">Cuando el precio del carrito sea menor a</p>
                <x-form-input type="number" model="form.conditions.cart_price_lt" 
                icon="attach_money" class="w-[150px]" />
            </div>

            <div class="flex items-center flex-wrap gap-2 text-sm mt-3">
                <p class="w-full sm:w-auto">Cuando el peso total del carrito sea mayor o igual a</p>
                <x-form-input type="number" model="form.conditions.cart_weight_gte" 
                icon="weight" class="w-[150px]" />
                <p>KG</p>
            </div>

            <div class="flex items-center flex-wrap gap-2 text-sm mt-3">
                <p class="w-full sm:w-auto">Cuando el peso total del carrito sea menor a</p>
                <x-form-input type="number" model="form.conditions.cart_weight_lt" 
                icon="weight" class="w-[150px]" />
                <p>KG</p>
            </div>
        </fieldset>

        {{-- Confirm modal --}}
        @include('admin.delivery-methods.custom-shippings.partials.confirm-information')

        {{-- Validate and show confirm information --}}
        <div class="mt-6 flex items-center justify-between flex-wrap gap-x-6">

            <span class="text-red-500 text-xs flex items-center my-1">
                @if ($errors->any())
                    <x-icon code="error" class="mr-1" /> Por favor revisa los errores del formulario
                @endif
            </span>

            <x-button wire:click='validateForm' wire:loading.remove wire:target='validateForm' 
            size="large" class="flex items-center">
                Revisar y guardar
            </x-button>

            <div wire:loading wire:target='validateForm' class="my-1">
                <div class="flex items-center font-semibold">
                    <x-spinner class="mr-2" />
                    Espere...
                </div>
            </div>

        </div>

        {{-- Target province - search localities --}}
        @include('admin.delivery-methods.custom-shippings.partials.target-province-search')
    </div>
</div>
