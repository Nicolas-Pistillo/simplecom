{{-- Upsert form --}}
<x-drawer ref="categoriesDrawerOpen">

    <div class="h-full">

        <div class="h-full">
    
            <form wire:submit='save' class="h-full flex flex-col justify-between">
    
                <div class="mb-3">
    
                    <h3 class="text-lg text-gray-700 font-semibold mb-3">{{ $drawerTitle }}</h3>
            
                    <hr class="mb-6">
            
                    <div class="mb-6">
                        <label class="block text-sm font-semibold leading-6 text-gray-500">
                            Nombre <sup class="text-red-500">*</sup>
                        </label>
                        <div class="mt-2">
                          <input type="text" wire:model='name' name="name" autocomplete="off" class="block w-full 
                          rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                          placeholder:text-gray-400 focus:ring-2 focus:ring-inset transition duration-300 focus:ring-blue-600 
                          sm:text-sm sm:leading-6">
                        </div>
                        @error('name')
                            <small class="text-red-500"> {{ $message }} </small>
                        @enderror
                    </div>
            
                    <div class="mb-6">
                        <label class="block text-sm font-semibold leading-6 text-gray-500">
                            Descripción (opcional)
                        </label>
                        <div class="mt-2">
                            <textarea wire:model='description' name="description" rows="3" autocomplete="off"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                            focus:ring-inset transition duration-300 focus:ring-blue-600 sm:text-sm 
                            sm:leading-6"></textarea>
                        </div>
                        @error('description')
                            <small class="text-red-500"> {{ $message }} </small>
                        @enderror
                    </div>

                    <div class="mb-6">

                        <fieldset>
                            <div class="space-y-3">

                                <div class="relative flex items-center">
                                    <div class="flex h-6 items-center">
                                        <input id="published" type="checkbox" wire:model='published'
                                        class="h-4 w-4 rounded border-gray-300 text-blue-600">
                                    </div>
                                    <div class="ml-3 text-sm leading-5 flex items-center">
                                        <label for="published" class="block font-medium text-gray-900">
                                            Marcar como publicada 
                                        </label>
                                        <span
                                        x-tooltip.raw.placement.bottom="Si no se marca como publicada, no se publicará el acceso a esta categoría ni se mostrarán los productos que estén asociados a esta categoría."
                                        class="material-symbols-outlined ml-2 text-blue-600">help</span>
                                    </div>
                                </div>

                                <div class="relative flex items-center">
                                    <div class="flex h-6 items-center">
                                        <input id="featured" type="checkbox" wire:model='featured'
                                        class="h-4 w-4 rounded border-gray-300 text-blue-600">
                                    </div>
                                    <div class="ml-3 text-sm leading-5 flex items-center">
                                        <label for="featured" class="block font-medium text-gray-900">
                                            Marcar como destacada 
                                        </label>
                                        <span x-tooltip.raw.placement.bottom="Destacar la categoría hara que tenga mayor visibilidad con respecto al resto de categorías en tu tienda."
                                        class="material-symbols-outlined ml-2 text-blue-600">help</span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
  
                    </div>
            
                    <h4 class="text-sm text-gray-500 font-semibold mb-3">Presentación (opcional)</h4>
        
                    <div class="mb-6">
        
                        <img src="{{ $coverImagePreview ?: 'http://via.placeholder.com/1200x630' }}" 
                        alt="avatar-category" class="w-full h-28 rounded-lg object-cover shadow">
            
                        <div class="mt-4 flex items-start justify-between">
                            <div>
                                <h2 class="text-base font-semibold leading-6 text-gray-900">
                                    <span class="sr-only">Details for
                                    </span>Imagen de portada
                                </h2>
                                <p class="text-xs font-medium text-gray-500">
                                    Recomendado: 1200 x 630px
                                </p>
                            </div>
            
                            <x-button wire:loading.remove wire:target='coverImage, deleteCoverImage' file onlyImages 
                            name="coverImage" wireModel="coverImage" type="secondary" class="w-20 ml-auto text-center">
                                Subir
                            </x-button>

                            @if ($coverImagePreview)
                                <x-button wire:click='deleteCoverImage' wire:loading.remove wire:target='deleteCoverImage, coverImage' 
                                size="small" x-tooltip.raw.placement.bottom="Eliminar imagen"
                                class="flex items-center ml-1 text-white bg-red-600 hover:bg-red-500"> 
                                    <span class="material-symbols-outlined">delete</span> 
                                </x-button>
                            @endif
    
                            <x-spinner wire:loading wire:target='coverImage, deleteCoverImage' />
                        </div>
                        
                        @error('coverImage')
                            <small class="text-red-500"> {{ $message }} </small>
                        @enderror
                    </div>
            
                    <div class="mb-3">
        
                        <img src="{{ $imagePreview ?: 'http://via.placeholder.com/200x200' }}" 
                        alt="avatar-category" class="w-24 h-24 rounded-full object-cover">
        
                        <div class="mt-3 flex items-start justify-between">
            
                            <div>
                                <h2 class="text-base font-semibold leading-6 text-gray-900">
                                    <span class="sr-only">Details for
                                    </span>Imagen miniatura
                                </h2>
                                <p class="text-xs font-medium text-gray-500">
                                    Recomendado: 200 x 200px
                                </p>
                            </div>
            
                            <x-button wire:loading.remove wire:target='image, deleteImage' file onlyImages 
                            wireModel="image" name="image" type="secondary" class="w-20 ml-auto text-center">
                                Subir
                            </x-button>

                            @if ($imagePreview)
                                <x-button wire:click='deleteImage' wire:loading.remove wire:target='deleteImage, image' 
                                size="small" x-tooltip.raw.placement.bottom="Eliminar imagen"
                                class="flex items-center ml-1 text-white bg-red-600 hover:bg-red-500"> 
                                    <span class="material-symbols-outlined">delete</span> 
                                </x-button>
                            @endif
    
                            <x-spinner wire:loading wire:target='image, deleteImage' />
    
                        </div>
                        @error('image')
                            <small class="text-red-500"> {{ $message }} </small>
                        @enderror
        
                    </div>
                </div>
    
                <div class="flex items-center py-6">
    
                    <x-button submit wire:loading.remove wire:target='save' size="large" class="w-full mr-4">Guardar</x-button>
                    
                    <x-spinner wire:loading wire:target='save' class="w-full" />
    
                    <x-button wire:loading.remove wire:target='save' wire:click='cancelForm' 
                    size="large" class="w-full" type="secondary">
                        Cancelar
                    </x-button>
                </div>
    
            </form>
    
        </div>
    </div>

</x-drawer>