<div x-cloak x-show="openEditAddressDetails">

    <div class="w-full max-w-7xl mx-auto px-4 lg:px-8 xl:px-14 relative z-40">

        <div class="w-full relative flex justify-center">

            <div x-cloak x-show="openEditAddressDetails" 
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="pd-overlay w-full h-full fixed top-0 left-0 z-[30] overflow-x-hidden overflow-y-auto">
                <div @click.away="openEditAddressDetails = false" 
                class="opacity-1 ease-out sm:max-w-md sm:w-full m-3 relative top-1/2 shadow-xl
                -translate-y-1/2 sm:mx-auto modal-open:opacity-100 transition-all modal-open:duration-500">
                    @if (isset($target_address))
                        <div class="flex items-start bg-white p-6 rounded-lg">
                            <div class="block w-full">

                                <div class="flex items-center justify-between mb-3">

                                    <h6 class="text-lg font-bold truncate leading-8 text-gray-900">
                                        Editar detalles
                                    </h6>

                                    <x-icon code="close" @click="openEditAddressDetails = false"
                                        class="transition colors duration-300 text-[18px]
                                    cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                                    hover:bg-gray-200 focus:outline-none focus:ring" />
                                </div>

                                <div class="flex items-center mb-3">
                                    <x-icon code="location_on" class="text-gray-700 mr-1" />
                                    <p class="text-sm truncate font-medium text-gray-900">
                                        {{ $target_address->summary }}
                                    </p>
                                </div>

                                <div class="grid grid-cols-12 gap-3 text-gray-700">

                                    <div class="col-span-full">
                                        <div class="relative mt-1">

                                            <span
                                                class="absolute text-xs text-gray-500 inset-y-0 start-0 
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

                                            <span
                                                class="absolute text-xs text-gray-500 inset-y-0 start-0 
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

                                            <span
                                                class="absolute text-xs text-gray-500 inset-y-0 start-0 
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

                                            <span
                                                class="absolute text-xs text-gray-500 inset-y-0 start-0 
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

                                            <span
                                                class="absolute text-xs text-gray-500 inset-y-0 start-0 
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

                                <div class="flex items-center justify-center pt-8 gap-4">

                                    <div wire:loading wire:target='updateAddressDetails'>
                                        <div class="flex items-center gap-x-2">
                                            <span class="text-xs text-gray-700 font-semibold">
                                                Actualizando
                                            </span>
                                            <x-spinner />
                                        </div>
                                    </div>

                                    <x-button @click="openEditAddressDetails = false" size="large"
                                        type="secondary" wire:loading.remove wire:target='updateAddressDetails'
                                        class="w-full flex items-center justify-center">
                                        Cancelar
                                    </x-button>

                                    <x-button wire:click='updateAddressDetails' wire:loading.remove
                                    wire:target='updateAddressDetails' size="large"
                                    class="w-full">Guardar</x-button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div x-cloak x-show="openEditAddressDetails" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed top-0 left-0 w-full h-full bg-black/50 z-[20]">
            </div>
        </div>
    </div>
</div>