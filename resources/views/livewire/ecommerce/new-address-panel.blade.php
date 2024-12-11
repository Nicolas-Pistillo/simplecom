<div>
    <section x-data="{ open: false }" class="relative"
        x-on:open-new-address-panel.window="open = true; $nextTick(() => {document.getElementById('new-address-search').focus()})"
        x-on:close-new-address-panel.window="open = false">
        <div class="w-full max-w-7xl mx-auto px-4 lg:px-8 xl:px-14 relative">

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
                                    
                                    {{-- @dump($selected_address) --}}
                                    
                                    <div class="flex items-center mb-3">
                                        <x-icon code="location_on" class="text-gray-700 mr-1" />
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $selected_address['name'] }} - {{ $selected_address['locality'] ?? $selected_address['locality_lvl_2'] }}
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-12 gap-3 text-gray-700">

                                        <div class="col-span-full">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Etiqueta:</span>

                                                <input type="text" wire:model.blur='name'
                                                placeholder="Ej: Casa, trabajo, local etc..."
                                                class="block w-full rounded-md border-gray-300 shadow-sm 
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm pl-[4.5rem]">
                                
                                                @error('name')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-span-full">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Indicaciones:</span>

                                                <input type="text" wire:model.blur='details'
                                                placeholder="Ej: Puerta azul, rejas grises, esquina etc..."
                                                class="block w-full rounded-md border-gray-300 shadow-sm 
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

                                                        <div class="flex items-center gap-3.5">
                                                            <input type="radio" name="location_option"
                                                                id="location-{{ $address['place_id'] }}">
                                                        </div>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                        <div wire:loading wire:target='selectedAddress' class="w-full">
                                            <div class="mt-8 flex justify-center items-center">
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
</div>
