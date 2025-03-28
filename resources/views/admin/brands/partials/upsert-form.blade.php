<x-drawer ref="brandPanelOpen">
    <div class="h-full">

        <form wire:submit='save' class="h-full flex flex-col justify-between">

            <div class="mb-3">

                <h3 class="text-lg text-gray-700 font-semibold mb-3">
                    {{ $brand ? 'Editando ' . $brand->name : 'Nueva marca' }}
                </h3>

                <hr class="mb-6">

                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold leading-6 text-gray-500">
                        Nombre <sup class="text-red-500">*</sup>
                    </label>
                    <div class="mt-2">
                        <input type="text" id="brand_name" wire:model.blur='form.name' autocomplete="off"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                        shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                        focus:ring-2 focus:ring-inset transition duration-300 focus:ring-blue-600 
                        sm:text-sm sm:leading-6">
                    </div>
                    @error('form.name')
                        <small class="text-red-500"> {{ $message }} </small>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold leading-6 text-gray-500">
                        Descripción (opcional)
                    </label>
                    <div class="mt-2">
                        <textarea wire:model='form.description' name="description" rows="3" autocomplete="off"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                            focus:ring-inset transition duration-300 focus:ring-blue-600 sm:text-sm 
                            sm:leading-6"></textarea>
                    </div>
                    @error('form.description')
                        <small class="text-red-500"> {{ $message }} </small>
                    @enderror
                </div>

                <div class="mb-6">

                    <fieldset>
                        <div class="space-y-3">

                            <div class="relative flex items-center">
                                <div class="flex h-6 items-center">
                                    <input id="published" type="checkbox" wire:model.live='form.published'
                                    class="h-4 w-4 rounded border-gray-300 text-blue-600">
                                </div>
                                <div class="ml-3 text-sm leading-5 flex items-center">
                                    <label for="published" class="block font-medium text-gray-900">
                                        Marcar como publicada
                                    </label>
                                    <span x-tooltip.raw.placement.bottom="Si no se marca como publicada, no se publicará el acceso 
                                    a esta marca ni se mostrarán sus productos asociados."
                                    class="material-symbols-outlined ml-2 text-blue-600">help</span>
                                </div>
                            </div>

                            <div class="relative flex items-center">
                                <div class="flex h-6 items-center">
                                    <input id="featured" type="checkbox" wire:model.live='form.featured'
                                    class="h-4 w-4 rounded border-gray-300 text-blue-600">
                                </div>
                                <div class="ml-3 text-sm leading-5 flex items-center">
                                    <label for="featured" class="block font-medium text-gray-900">
                                        Marcar como destacada
                                    </label>
                                    <span x-tooltip.raw.placement.bottom="Destacar la marca hara que tenga mayor visibilidad con 
                                    respecto a las demás."
                                    class="material-symbols-outlined ml-2 text-blue-600">help</span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div class="mb-3">

                    <img src="{{ $imagePreview ?? 'http://placehold.co/500x500' }}"
                    alt="brand-logo" class="w-24 h-24 rounded-full object-contain">

                    <div class="mt-3 flex items-start justify-between">

                        <div>
                            <h2 class="text-base font-semibold leading-6 text-gray-900">Logo de marca</h2>
                            <p class="text-xs font-medium text-gray-500">
                                Recomendado: 500 x 500px
                            </p>
                        </div>

                        <x-button wire:loading.remove wire:target='form.image, deleteImage' file onlyImages
                        wireModel="form.image" name="image" type="secondary"
                        class="w-20 ml-auto text-center">
                            Subir
                        </x-button>

                        @if ($imagePreview)
                            <x-button wire:click='deleteImage' wire:loading.remove
                                wire:target='deleteImage, form.image' size="small"
                                x-tooltip.raw.placement.bottom="Eliminar imagen"
                                class="flex items-center ml-1 text-white bg-red-600 hover:bg-red-500">
                                <span class="material-symbols-outlined">delete</span>
                            </x-button>
                        @endif

                        <x-spinner wire:loading wire:target='form.image, deleteImage' />

                    </div>

                    @error('form.image')
                        <small class="text-red-500"> {{ $message }} </small>
                    @enderror

                </div>
            </div>

            <div class="flex items-center py-6">

                <x-button submit wire:loading.remove wire:target='save' size="large"
                    class="w-full mr-4">Guardar</x-button>

                <x-spinner wire:loading wire:target='save' class="w-full" />

                <x-button wire:loading.remove wire:target='save' 
                @click="brandPanelOpen = false"
                size="large" class="w-full" type="secondary">
                    Cancelar
                </x-button>
            </div>

        </form>

    </div>
</x-drawer>