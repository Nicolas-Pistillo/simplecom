<x-multi-select label="Provincias" withAsterisk title="Seleccionar provincias" class="w-max mt-3">
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
                    <x-icon code="add" wire:loading.remove wire:target='toggleProvince({{ $province->id }})'
                        class="text-gray-600" />
                @endif

                <x-spinner wire:loading wire:target='toggleProvince({{ $province->id }})' />

            </div>
        </div>
    @endforeach
</x-multi-select>

@if (!empty($form->selected_provinces))
    <fieldset class="col-span-full no-select mt-4">

        <legend class="text-sm/6 font-semibold text-gray-900">
            Provincias seleccionadas
        </legend>

        <p class="mt-1 text-sm/6 text-gray-600">
            Podes desmarcar las localidades de cada provincia que no van a estar dentro de esta opción de envío
        </p>

        <div class="flex items-center flex-wrap gap-4 mt-3">
            @foreach ($selectedProvinces as $province)
                <div wire:key='selected-province-{{ $province->id }}' class="w-max">
                    <x-multi-select :label="$province->name" title="Ver localidades">

                        <x-slot name="stickyContainer">
                            <x-form-input type="search" containerClass="shadow-none"
                            liveModel="localitySearch.{{ $province->id }}"
                            placeholder="Buscar localidad..." />
                        </x-slot>

                        @if ($province->localities->isEmpty())
                            <div class="cursor-pointer py-2 px-4 w-full text-sm text-gray-800 
                            hover:bg-gray-100 rounded-lg focus:outline-hidden focus:bg-gray-100">
                                No se encontrarón resultados
                            </div>
                        @endif

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
                                        <x-icon code="add" class="text-gray-600" />
                                    @endif

                                    <x-spinner wire:loading wire:target='toggleLocality({{ $locality->id }})' />

                                </div>
                            </div>
                        @endforeach
                    </x-multi-select>
                </div>
            @endforeach
        </div>

        @if ($excludedLocalities->isNotEmpty())

            <legend class="text-sm/6 font-semibold text-gray-900 my-4">
                Localidades excluidas
            </legend>

            <div class="flex items-center gap-3 flex-wrap">
                @foreach ($excludedLocalities as $excludedLocality)
                    <div wire:key='excluded-locality-{{ $excludedLocality->id }}'>
                        <x-badge class="flex items-center gap-1.5">

                            {{ $excludedLocality->name }}

                            <x-icon code="close" x-tooltip.raw="Volver a incluir"
                            wire:click='toggleLocality({{ $excludedLocality->id }})'
                            wire:loading.remove wire:target='toggleLocality({{ $excludedLocality->id }})'
                            class="hover:text-red-500 text-[16px] cursor-pointer" />

                            <x-spinner spinnerclass="!w-4 !h-4" 
                            wire:loading wire:target='toggleLocality({{ $excludedLocality->id }})' />
                        </x-badge>
                    </div>
                @endforeach
            </div>
        @endif
    </fieldset>
@endif
