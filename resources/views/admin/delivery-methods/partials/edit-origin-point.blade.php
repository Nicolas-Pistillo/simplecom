<div>
    <section x-data="{ open: false }" class="relative"
        x-on:open-edit-origin-point.window="open = true"
        x-on:close-edit-origin-point.window="open = false">
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
                        @if (isset($origin_point))
                            <div class="flex items-start bg-white p-6 rounded-lg">
                                <div class="block w-full">

                                    <div class="flex items-center justify-between mb-3">

                                        <h6 class="text-lg font-bold truncate leading-8 text-gray-900">
                                            {{ $origin_point->name }}
                                        </h6>

                                        <x-icon code="close" @click="open = false"
                                        class="transition colors duration-300 text-[18px]
                                        cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                                      hover:bg-gray-200 focus:outline-none focus:ring" />
                                    </div>

                                    <div class="flex items-center mb-3">
                                        <x-icon code="location_on" class="text-gray-700 mr-1" />
                                        <p class="text-sm truncate font-medium text-gray-900">
                                            {{ $origin_point->address }}
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-12 gap-3 text-gray-700">

                                        <div class="col-span-full">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Nombre:</span>

                                                <input type="text" wire:model.blur='form.name'
                                                placeholder="Ej: Depósito pricipal..."
                                                class="block w-full rounded-md border-gray-300 shadow-sm placeholder:text-xs
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm pl-[4.5rem]">
                                
                                            </div>

                                            @error('form.name')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                
                                        <div class="col-span-6 sm:col-span-4">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Piso:</span>

                                                <input type="text" wire:model.blur='form.floor'
                                                class="block w-full rounded-md border-gray-300 shadow-sm 
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm text-right">
                                
                                            </div>
                                        </div>
                                
                                        <div class="col-span-6 sm:col-span-4">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Local:</span>

                                                <input type="text" wire:model.blur='form.local'
                                                class="block w-full rounded-md border-gray-300 shadow-sm 
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm text-right">

                                            </div>
                                        </div>

                                        <div class="col-span-full">
                                            <div class="relative mt-1">

                                                <textarea rows="2" placeholder="Aclaraciones/Detalles de la dirección"
                                                wire:model.blur='form.observations'
                                                class="block w-full rounded-md border-gray-300 shadow-sm placeholder:text-xs
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm"></textarea>
                                
                                            </div>
                                        </div>

                                        <div class="col-span-full mt-1 flex items-center">

                                            <h5 class="text-xs text-gray-800">
                                                Datos del encargado
                                            </h5>

                                            <x-icon code="help" 
                                            class="ml-1 text-blue-600 cursor-help" 
                                            x-tooltip.raw="Será el responsable de establecer la comunicación con el proveedor
                                            logístico y atender la operatoria de las colectas y despachos"
                                            style="font-size: 20px"
                                            />
                                        </div>

                                        <div class="col-span-full">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Nombre:</span>

                                                <input type="text" wire:model.blur='form.staff_name'
                                                class="block w-full rounded-md border-gray-300 shadow-sm placeholder:text-xs
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm pl-[4.3rem]">
                                
                                            </div>

                                            @error('form.staff_name')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-span-full">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Email:</span>

                                                <input type="text" wire:model.blur='form.staff_email'
                                                class="block w-full rounded-md border-gray-300 shadow-sm placeholder:text-xs
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm pl-[3.2rem]">
                                
                                            </div>

                                            @error('form.staff_email')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-span-6">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">Teléfono:</span>

                                                <input type="number" wire:model.blur='form.staff_phone'
                                                class="block w-full rounded-md border-gray-300 shadow-sm placeholder:text-xs
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm pl-[4.3rem]">
                                
                                            </div>

                                            @error('form.staff_phone')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-span-6">
                                            <div class="relative mt-1">

                                                <span class="absolute text-xs text-gray-500 inset-y-0 start-0 
                                                flex items-center ps-3 pointer-events-none">DNI:</span>

                                                <input type="number" wire:model.blur='form.staff_document'
                                                class="block w-full rounded-md border-gray-300 shadow-sm placeholder:text-xs
                                                focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm pl-[2.4rem]">
                                
                                            </div>

                                            @error('form.staff_document')
                                                <small class="text-red-500">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-center pt-8 gap-4">

                                        <div wire:loading wire:target='updateOriginPoint'>
                                            <div class="flex items-center gap-x-2">
                                                <span class="text-xs text-gray-700 font-semibold">
                                                    Actualizando
                                                </span>
                                                <x-spinner />
                                            </div>
                                        </div>

                                        <x-button @click="open = false" size="large" type="secondary" 
                                        wire:loading.remove wire:target='updateOriginPoint'
                                        class="w-full flex items-center justify-center">
                                            Cancelar
                                        </x-button>

                                        <x-button wire:click='updateOriginPoint' 
                                        wire:loading.remove wire:target='updateOriginPoint'
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
