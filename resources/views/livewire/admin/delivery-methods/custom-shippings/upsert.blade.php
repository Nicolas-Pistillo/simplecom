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

                        <input wire:model.live='form.shipping_zone_type' type="radio" value="{{ $zoneType->value }}"
                            id="{{ $zoneType->value }}" name="shipping_zone_type"
                            class="border-gray-300 
                        text-blue-600 focus:ring-blue-600">

                        <label for="{{ $zoneType->value }}"
                            class="ml-3 block text-sm/6 
                        font-medium text-gray-900">
                            {{ $zoneType->name() }}
                        </label>
                    </div>
                @endforeach
            </div>

            @if ($form->shipping_zone_type === ShippingZoneType::ByProvinces->value)
                <x-multi-select label="Provincias" title="Seleccionar provincias" class="w-max mt-3">
                    @foreach ($provinces as $province)
                        <div wire:key='province-{{ $province->id }}' wire:click='toggleProvince({{ $province->id }})'
                            class="cursor-pointer py-2 px-4 w-full text-sm text-gray-800 
                            hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100">
                            <div class="flex justify-between items-center gap-x-4 w-full">

                                @if (in_array($province->id, $form->selected_provinces))
                                    <span class="font-semibold">
                                        {{ $province->name }}
                                    </span>
                                    <x-icon wire:loading.remove class="text-blue-600" code="check"
                                        wire:target='toggleProvince({{ $province->id }})' />
                                @else
                                    <span>{{ $province->name }}</span>
                                @endif

                                <x-spinner wire:loading wire:target='toggleProvince({{ $province->id }})' />

                            </div>
                        </div>
                    @endforeach
                </x-multi-select>
            @endif
        </fieldset>

        @if (!empty($form->selected_provinces))
            <fieldset class="col-span-full no-select">

                <legend class="text-sm/6 font-semibold text-gray-900">
                    Provincias seleccionadas
                </legend>

                <p class="mt-1 text-sm/6 text-gray-600">
                    Desmarcá las localidades que no van a estar dentro de esta opción de envío
                </p>

                <div class="flex items-center flex-wrap gap-4 mt-3">
                    @foreach ($provinces->whereIn('id', $form->selected_provinces) as $province)

                        <x-multi-select :label="$province->name" title="Ver localidades" class="w-max">

                            <x-slot name="stickyContainer">
                                <x-form-input containerClass="shadow-none" 
                                placeholder="Buscar localidad..." />
                            </x-slot>

                            @foreach ($province->localities as $locality)
                                <div wire:key='locality-{{ $locality->id }}'
                                wire:click='toggleLocality({{ $locality->id }})'
                                class="cursor-pointer py-2 px-4 w-full text-sm text-gray-800 
                                hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100">
                                    <div class="flex justify-between items-center gap-x-4 w-full">

                                        @if (!in_array($locality->id, $form->excluded_localities))
                                            <span class="font-semibold">
                                                {{ $locality->name }}
                                            </span>
                                            <x-icon wire:loading.remove class="text-blue-600" code="check"
                                            wire:target='toggleLocality({{ $locality->id }})' />
                                        @else
                                            <span>{{ $locality->name }}</span>
                                        @endif

                                        <x-spinner wire:loading wire:target='toggleLocality({{ $locality->id }})' />

                                    </div>
                                </div>
                            @endforeach
                        </x-multi-select>
                    @endforeach
                </div>

                @if (!empty($form->excluded_localities))
                    <legend class="text-sm/6 font-semibold text-gray-900 mt-3">
                        Localidades excluidas
                    </legend>

                    @php
                        $excludedLocalities = $provinces->pluck('localities')->flatten()->whereIn('id', $form->excluded_localities);
                    @endphp

                    <div class="mt-1">
                        @foreach ($excludedLocalities as $excludedLocality)
                            <x-badge> {{ $excludedLocality->name }} </x-badge>
                        @endforeach
                    </div>
                @endif
            </fieldset>
        @endif
    </div>
</div>
