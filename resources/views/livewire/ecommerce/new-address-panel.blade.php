{{-- <div>
    <section x-data="{ open: false }" class="relative"
        x-on:open-new-address-panel.window="open = true; $nextTick(() => {document.getElementById('new-address-search').focus()})"
        x-on:close-new-address-panel.window="open = false">
        <div class="w-full max-w-7xl mx-auto px-4 lg:px-8 xl:px-14 relative z-40">

            <div x-cloak x-show="open" class="w-full relative flex justify-center">

                <div x-cloak x-show="open" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="pd-overlay w-full h-full fixed top-0 left-0 z-[30] overflow-x-hidden overflow-y-auto">
                    <div class="opacity-1 ease-out sm:max-w-md sm:w-full m-3 relative top-1/2 shadow-xl
                    -translate-y-1/2 sm:mx-auto modal-open:opacity-100 transition-all modal-open:duration-500">
                        <div class="flex items-start bg-white p-6 rounded-lg">
                            <div class="block w-full">

                                <div class="flex items-center justify-between mb-3">

                                    <h6 class="text-lg font-bold leading-8 text-gray-900">
                                        {{ empty($selected_address) ? 'Nueva' : 'Confirmar' }} dirección
                                    </h6>

                                    <x-icon code="close" @click="open = false"
                                    class="transition colors duration-300 text-[18px]
                                    cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                                  hover:bg-gray-200 focus:outline-none focus:ring" />
                                </div>

                                @if (!empty($selected_address))
                                    
                                    <div class="flex items-center mb-3">
                                        <x-icon code="location_on" class="text-gray-700 mr-1" />
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $selected_address['summary'] }}
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-12 gap-3 text-gray-700">

                                        <div class="col-span-full">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Etiqueta:</span>

                                                <input type="text" wire:model.blur='tag'
                                                placeholder="Nombre propio para identificar esta dirección..."
                                                class="block w-full rounded-md border-gray-300 shadow-sm placeholder:text-xs
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm pl-[4.5rem]">
                                
                                                @error('tag')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-span-full">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Indicaciones:</span>

                                                <input type="text" wire:model.blur='details'
                                                placeholder="Datos adicionales para el repartidor..."
                                                class="block w-full rounded-md border-gray-300 shadow-sm placeholder:text-xs
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm pl-[6.3rem]">
                                
                                                @error('details')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                
                                        <div class="col-span-6 sm:col-span-4">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Piso:</span>

                                                <input type="text" wire:model.blur='floor'
                                                class="block w-full rounded-md border-gray-300 shadow-sm 
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm text-right">
                                
                                                @error('floor')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-span-6 sm:col-span-4">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Depto:</span>

                                                <input type="text" wire:model.blur='apartment'
                                                class="block w-full rounded-md border-gray-300 shadow-sm 
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm text-right">
                                
                                                @error('apartment')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                
                                        <div class="col-span-6 sm:col-span-4">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Oficina:</span>

                                                <input type="text" wire:model.blur='office'
                                                class="block w-full rounded-md border-gray-300 shadow-sm 
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm text-right">
                                
                                                @error('office')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <gmp-map wire:ignore center="{{ $selected_address['lat_lng'] }}" 
                                    zoom="18" map-id="selected_address_map" class="mt-4 h-[130px] md:h-[250px] rounded-lg shadow-md">
                                        <gmp-advanced-marker position="{{ $selected_address['lat_lng'] }}"></gmp-advanced-marker>
                                    </gmp-map>

                                    <div class="flex items-center justify-center pt-8 gap-4">

                                        <div wire:loading wire:target='save'>
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs text-gray-700 font-semibold">
                                                    Guardando dirección
                                                </span>
                                                <x-spinner />
                                            </div>
                                        </div>

                                        <x-button wire:click='removeSelectedAddress' 
                                        wire:loading.remove wire:target='save'
                                        size="large" type="soft" class="w-full flex items-center justify-center">
                                            <x-icon code="arrow_back" class="mr-2" />
                                            Volver
                                        </x-button>

                                        <x-button wire:click='save' 
                                        wire:loading.remove wire:target='save'
                                        size="large" class="w-full">Confirmar</x-button>
                                    </div>
                                @else
                                    <div class="w-full relative">

                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <x-icon code="search" class="text-gray-500" />
                                        </div>

                                        <input type="search" wire:model.live.debounce.300='search' id="new-address-search"
                                            class="bg-white borderborder-gray-300 text-gray-900 text-sm 
                                            rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                            autocomplete="no" placeholder="Buscá y seleccioná tu dirección" />
                                    </div>

                                    @if (isset($addresses) && $addresses->isNotEmpty())
                                        <div wire:loading.remove wire:target='selectedAddress' class="flex flex-col gap-3 pr-2 my-5 max-h-[250px] overflow-y-auto pb-2" scrollbar-thin>
                                            @foreach ($addresses as $address)
                                                <label wire:key='{{ $address['place_id'] }}'
                                                    for="location-{{ $address['place_id'] }}"
                                                    wire:click="selectedAddress('{{ $address['place_id'] }}')"
                                                    class="flex items-center gap-x-3 py-2 px-3 hover:shadow cursor-pointer
                                                    transition duration-300 rounded-md hover:bg-gray-50">

                                                    <x-icon code="location_on" class="text-gray-700" />

                                                    <div class="flex items-center w-full gap-x-3">

                                                        <div class="block w-full">
                                                            <p class="text-xs sm:text-sm font-medium text-gray-900">
                                                                {{ $address['description'] }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                        <div wire:loading wire:target='selectedAddress' class="w-full">
                                            <div class="mt-8 flex justify-center items-center gap-x-2">
                                                <span class="text-xs text-gray-700 font-semibold">
                                                    Cargando información
                                                </span>
                                                <x-spinner />
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div x-cloak x-show="open" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="fixed top-0 left-0 w-full h-full bg-black/50 z-[20]">
                </div>
            </div>
        </div>
    </section>
</div> --}}

<div>
    <section x-data="{ open: false }" class="relative"
    x-on:open-new-address-panel.window="open = true"
    x-on:close-new-address-panel.window="open = false">
        <div x-cloak x-show="open" class="w-full max-w-7xl mx-auto px-4 lg:px-8 xl:px-14 relative">
            <div class="w-full relative flex justify-center">
                <div x-cloak x-show="open" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                    class="w-full h-full fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
                    <div class="opacity-1 ease-out sm:max-w-lg sm:w-full m-5 relative top-1/2 -translate-y-1/2 sm:mx-auto modal-open:opacity-100 transition-all modal-open:duration-500">
                        <div class="flex items-start bg-white p-6 rounded-lg">

                            <div class="block w-full">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-50">
                                            <x-icon code="location_on" class="text-blue-600" />
                                        </div>
                                        <h6 class="text-lg font-bold leading-8 text-gray-900">
                                            Nueva dirección
                                        </h6>
                                    </div>
                                    <x-icon code="close" @click="open = false"
                                    class="transition colors duration-300 text-[18px]
                                    cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                                  hover:bg-gray-200 focus:outline-none focus:ring" />
                                </div>

                                <div class="grid sm:grid-cols-12 gap-3 text-gray-700">

                                    <x-form-input model="form.tag" class="col-span-full" label="Etiqueta (opcional)"
                                    placeholder="Ej: Casa" />

                                    <div class="sm:col-span-6">
                                        <label for="province" class="inline-block text-sm 
                                        font-medium leading-6 text-gray-900 mb-2">
                                            Provincia <sup class="text-red-500">*</sup>
                                        </label>
                                        <div>
                                            <select wire:model.live='form.province_id' id="province" class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                                            shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 
                                            focus:ring-inset focus:ring-blue-600 text-sm leading-6">
                                                <option value="0">Seleccionar provincia</option>
                                                @foreach ($provinces as $province)
                                                    <option {{ $province->id == $form->province_id ? 'selected' : null }} 
                                                    value="{{ $province->id }}">
                                                        {{ $province->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-6">
                                        <label for="locality" class="inline-block text-sm 
                                        font-medium leading-6 text-gray-900 mb-2">
                                            Localidad <sup class="text-red-500">*</sup>
                                        </label>
                                        <div>
                                            <select wire:model.live='form.locality_id' id="locality" class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                                            shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 
                                            focus:ring-inset focus:ring-blue-600 text-sm leading-6">
                                                <option value="0">Seleccionar localidad</option>
                                                @foreach ($localities as $locality)
                                                    <option value="{{ $locality->id }}">
                                                        {{ $locality->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <x-form-input model="form.street" withAsterisk 
                                    class="sm:col-span-6" label="Calle" placeholder="Av. Rivadavia" />

                                    <x-form-input model="form.number" withAsterisk 
                                    class="sm:col-span-6" label="Altura" placeholder="578" />

                                    <x-form-input model="form.zipcode" withAsterisk 
                                    class="sm:col-span-6" label="Código postal" placeholder="1739" />

                                    <x-form-input model="form.floor" class="sm:col-span-6" label="Piso (opcional)" />

                                    <x-form-input model="form.apartment" class="sm:col-span-6" label="Departamento (opcional)" />

                                    <x-form-input model="form.office" class="sm:col-span-6" label="Oficina (opcional)" />

                                    <div class="col-span-full">
                                        <label for="address_details" class="block mb-2 text-sm 
                                        font-medium text-gray-900">
                                            Detalles de entrega (opcional)
                                        </label>
                                        <div class="w-full border border-gray-300 rounded-lg bg-gray-50 
                                        shadow-sm ring-1 ring-inset ring-gray-300">
                                            <div class="p-3 bg-white rounded-lg">
                                                <textarea wire:model.blur='form.details' id="address_details" rows="4" 
                                                scrollbar-thin class="block w-full p-0 text-sm text-gray-800
                                                bg-white border-0 focus:ring-0 placeholder:text-gray-400" 
                                                placeholder="Ej. Portón azul en una esquina"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @dump($form->all())

                                <div class="flex items-center gap-3 justify-between mt-6">

                                    <x-button @click="open = false" class="w-full" 
                                    type="secondary">Cancelar</x-button>

                                    <x-button class="w-full">Guardar</x-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div x-cloak x-show="open" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="fixed top-0 left-0 w-full h-full bg-black/50 z-40">
                </div>
            </div>
        </div>
    </section>
</div>
