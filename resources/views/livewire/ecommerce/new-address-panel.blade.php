<div>
    <section x-data="{open: false}" class="relative py-8 sm:p-8" 
    x-on:open-new-address-panel.window="open = true" x-on:close-new-address-panel.window="open = false">
        <div class="w-full max-w-7xl mx-auto px-4 lg:px-8 xl:px-14 relative">

            <div x-cloak x-show="open" class="w-full relative flex justify-center">

                <div x-cloak x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="pd-overlay w-full h-full fixed top-0 left-0 z-[30] overflow-x-hidden overflow-y-auto">
                    <div class="opacity-1 ease-out sm:max-w-md sm:w-full m-3 relative top-1/2 shadow-xl
                    -translate-y-1/2 sm:mx-auto modal-open:opacity-100 transition-all modal-open:duration-500">
                        <div class="flex items-start bg-white p-6 rounded-lg">
                            <div class="block w-full">

                                <div class="flex items-center justify-between mb-5">

                                    <h6 class="text-lg font-bold leading-8 text-gray-900 ">
                                        Nueva dirección
                                    </h6>

                                    <x-icon code="close" @click="open = false" class="transition colors duration-300 text-[18px]
                                    cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                                  hover:bg-gray-200 focus:outline-none focus:ring" />
                                </div>

                                <div class="w-full relative">

                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <x-icon code="search" class="text-gray-500" />
                                    </div>

                                    <input type="text" class="bg-white border
                                    border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 
                                    focus:border-blue-500 block w-full ps-10 p-2.5"
                                    autocomplete="no" placeholder="Buscá tu dirección y seleccionala..." />
                                </div>

                                <div class="flex flex-col gap-3 pr-2 my-5 max-h-[250px] overflow-y-auto" scrollbar-thin>

                                    @for ($i = 0; $i < 7; $i++)
                                        <label for="location-{{ $i }}" class="flex items-center gap-x-3 px-3  
                                        transition duration-300 rounded-md hover:bg-gray-50 hover:shadow">
                                            <x-icon code="location_on" />
                                            <div class="flex items-center w-full">
                                                <div class="block w-full">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        Jessie Mayert
                                                    </p>
                                                    <span class="text-xs font-normal text-gray-500">
                                                        Until Jan 20, 2024 at 10:20 AM
                                                    </span>
                                                </div>
                                                <div class="flex items-center gap-3.5">
                                                    <input type="radio" name="location_option" id="location-{{ $i }}">
                                                </div>
                                            </div>
                                        </label>                                                
                                    @endfor

                                </div>

                                {{-- <div class="flex items-center gap-4">
                                    <x-button type="soft" size="large" class="w-full">Guardar</x-button>
                                    <x-button size="large" class="w-full">Continuar</x-button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div x-cloak x-show="open" x-transition:enter="ease-out duration-300" 
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" 
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" 
                x-transition:leave-end="opacity-0"
                class="fixed top-0 left-0 w-full h-full bg-black/50 z-[20]">
                </div>
            </div>
        </div>
    </section>
</div>
