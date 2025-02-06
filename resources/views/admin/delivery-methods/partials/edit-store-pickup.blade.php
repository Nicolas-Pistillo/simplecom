<div>
    <section x-data="{ open: false }" class="relative"
        x-on:open-edit-store-pickup.window="open = true"
        x-on:close-edit-store-pickup.window="open = false">
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
                        @if (isset($store_pickup))
                            <div class="flex items-start bg-white p-6 rounded-lg">
                                <div class="block w-full">

                                    <div class="flex items-center justify-between mb-3">

                                        <h6 class="text-lg font-bold truncate leading-8 text-gray-900">
                                            {{ $store_pickup->name }}
                                        </h6>

                                        <x-icon code="close" @click="open = false"
                                        class="transition colors duration-300 text-[18px]
                                        cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                                      hover:bg-gray-200 focus:outline-none focus:ring" />
                                    </div>

                                    <div class="flex items-center mb-3">
                                        <x-icon code="location_on" class="text-gray-700 mr-1" />
                                        <p class="text-sm truncate font-medium text-gray-900">
                                            {{ $store_pickup->address }}
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-12 gap-3 text-gray-700">

                                        <div class="col-span-full">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Nombre:</span>

                                                <input type="text" wire:model.blur='pickup_name'
                                                placeholder="Ej: Sucursal Avellaneda..."
                                                class="block w-full rounded-md border-gray-300 shadow-sm placeholder:text-xs
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm pl-[4.5rem]">
                                
                                            </div>

                                            @error('pickup_name')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-span-full">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Horarios:</span>

                                                <input type="text" wire:model.blur='pickup_schedule'
                                                placeholder="Ej: Lunes a viernes de 08:00 a 18:00..."
                                                class="block w-full rounded-md border-gray-300 shadow-sm placeholder:text-xs
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm pl-[4.6rem]">
                                
                                            </div>

                                            @error('pickup_schedule')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                
                                        <div class="col-span-6 sm:col-span-4">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Piso:</span>

                                                <input type="text" wire:model.blur='pickup_floor'
                                                class="block w-full rounded-md border-gray-300 shadow-sm 
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm text-right">
                                
                                            </div>
                                        </div>
                                
                                        <div class="col-span-6 sm:col-span-4">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Local:</span>

                                                <input type="text" wire:model.blur='pickup_local'
                                                class="block w-full rounded-md border-gray-300 shadow-sm 
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm text-right">

                                            </div>
                                        </div>

                                        <div class="col-span-full">
                                            <div class="relative mt-1">

                                                <textarea rows="2" placeholder="Aclaraciones (presentar DNI, otra documentación etc.)"
                                                wire:model.blur='pickup_observations'
                                                class="block w-full rounded-md border-gray-300 shadow-sm placeholder:text-xs
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm"></textarea>
                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-center pt-8 gap-4">

                                        <div wire:loading wire:target='updateStorePickup'>
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs text-gray-700 font-semibold">
                                                    Actualizando
                                                </span>
                                                <x-spinner />
                                            </div>
                                        </div>

                                        <x-button @click="open = false" size="large" type="secondary" 
                                        wire:loading.remove wire:target='updateStorePickup'
                                        class="w-full flex items-center justify-center">
                                            Cancelar
                                        </x-button>

                                        <x-button wire:click='updateStorePickup' 
                                        wire:loading.remove wire:target='updateStorePickup'
                                        size="large" class="w-full">Guardar</x-button>
                                    </div>
                                </div>
                            </div>
                        @endif
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
