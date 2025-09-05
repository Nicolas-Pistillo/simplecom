<div>
    <x-button :href="route('admin.delivery-methods.custom-shippings.index')" type="secondary" class="inline-flex w-max h-max items-center mb-4">
        <x-icon code="arrow_back" class="mr-1" />
        Volver al listado
    </x-button>

    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:tracking-tight">
        Nuevo envío personalizado
    </h2>

    <div class="grid sm:grid-cols-12 gap-x-4 gap-y-6 mt-8">

        <x-form-input class="sm:col-span-6" label="Nombre de la opción" placeholder="Motomensajeria en CABA" />

        <fieldset class="col-span-full no-select">

            <legend class="text-sm/6 font-semibold text-gray-900">Zonas de entrega</legend>

            <p class="mt-1 text-sm/6 text-gray-600">
                Hasta dónde llega la cobertura de esta opción de envío
            </p>

            <div class="mt-3 flex items-center flex-wrap gap-4">
                @foreach (ShippingZoneType::cases() as $zoneType)
                    <div class="flex items-center">

                        <input wire:model.live='form.shipping_zone_type' type="radio"
                        value="{{ $zoneType->value }}" id="{{ $zoneType->value }}" 
                        name="shipping_zone_type" class="border-gray-300 
                        text-blue-600 focus:ring-blue-600">

                        <label for="{{ $zoneType->value }}" class="ml-3 block text-sm/6 
                        font-medium text-gray-900">
                            {{ $zoneType->name() }}
                        </label>
                    </div>
                @endforeach
            </div>

            @if ($form->shipping_zone_type === ShippingZoneType::ByProvinces->value)
                <x-multi-select label="Provincias" title="Seleccionar provincias" class="w-max mt-3">
                    <x-slot name="stickyContainer">
                        <x-form-input containerClass="shadow-none" placeholder="Buscar..." />
                    </x-slot>

                    @foreach ($provinces as $index => $province)
                        <div wire:key='province-{{ data_get($province, 'id') }}'
                        wire:click='toggleProvince({{ json_encode($province) }})' 
                        class="cursor-pointer py-2 px-4 w-full text-sm text-gray-800 
                        hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100">
                            <div class="flex justify-between items-center gap-x-4 w-full">

                                @if (in_array($province, $form->selected_provinces))
                                    <span class="font-semibold">
                                        {{ data_get($province, 'iso_nombre') }}
                                    </span>
                                    <x-icon wire:loading.remove class="text-blue-600" code="check"
                                    wire:target='toggleProvince({{ json_encode($province) }})' />
                                @else
                                    <span>{{ data_get($province, 'iso_nombre') }}</span>
                                @endif

                                <x-spinner wire:loading wire:target='toggleProvince({{ json_encode($province) }})' />

                            </div>
                        </div>
                    @endforeach
                </x-multi-select>
            @endif
        </fieldset>

        <div class="sm:col-span-12">
            @dump($form->selected_provinces[0] ?? null)
        </div>
    </div>
</div>
