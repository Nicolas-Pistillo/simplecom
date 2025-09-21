<section x-show="targetProvinceOpen" x-cloak class="relative py-8 sm:p-8">
    <div class="w-full max-w-7xl mx-auto px-4 lg:px-8 xl:px-14 relative">
        <div class="w-full relative flex justify-center">
            <div class="pd-overlay w-full h-full fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
                <div class="opacity-1 ease-out sm:max-w-lg sm:w-full m-5 relative top-1/2 
                -translate-y-1/2 sm:mx-auto modal-open:opacity-100 transition-all modal-open:duration-500">
                    <div x-show="targetProvinceOpen" @click.away="targetProvinceOpen = false"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                    class="flex items-start bg-white p-6 rounded-lg shadow-lg">
                        <div class="block w-full">
                            @isset($target_province)
                                <div class="flex items-center justify-between gap-5 mb-1">
                                    <h6 class="text-lg font-bold text-gray-900 mb-1">
                                        {{ $target_province->name }}
                                    </h6>
                                    <x-icon @click="targetProvinceOpen = false" code="close"
                                        class="transition colors duration-300 text-[18px]
                                            cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                                            hover:bg-gray-200 focus:outline-none focus:ring" />
                                </div>

                                <p class="text-xs font-normal text-gray-500 mb-5">
                                    Podes desmarcar las localidades que no vas a cubrir en esta provincia.
                                </p>

                                <div class="relative mb-4  text-gray-500 focus-within:text-gray-900 ">
                                    <x-form-input liveModel="target_province_search" type="search" icon="search"
                                        placeholder="Buscar localidad..." />
                                </div>

                                <ul class="flex flex-col max-h-[350px] overflow-y-auto" scrollbar-thin>
                                    @forelse ($target_province_localities as $locality)
                                        <li wire:key='check-locality-{{ $locality->id }}'
                                            class="px-3 py-4 border-b border-gray-200 flex 
                                                items-center justify-between">
                                            <label for="check-locality-{{ $locality->id }}" class="flex items-center gap-3">
                                                <p class="text-sm font-medium text-gray-900">
                                                    {{ $locality->name }}
                                                </p>
                                            </label>
                                            <input wire:change='toggleLocality({{ $locality->id }})'
                                                {{ !in_array($locality->id, $form->excluded_localities) ? 'checked' : '' }}
                                                type="checkbox" class="w-5 h-5 rounded cursor-pointer"
                                                id="check-locality-{{ $locality->id }}">
                                        </li>
                                    @empty
                                        <li class="px-3 py-4 border-b border-gray-200 flex 
                                            items-center justify-center">
                                            <p class="text-sm font-medium text-gray-900">
                                                No se encontraron localidades para tu búsqueda
                                            </p>
                                        </li>
                                    @endforelse
                                </ul>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            <div id="backdrop" class="fixed top-0 left-0 w-full h-full bg-black/50 z-40"></div>
        </div>
    </div>
</section>
