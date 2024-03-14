<div class="h-full">

    <div x-on:close-drawer.window="{{ $drawerRef }} = false" class="h-full">

        <form wire:submit='save' class="h-full flex flex-col justify-between">

            <div>

                <h3 class="text-lg text-gray-700 font-semibold mb-3">{{ $title }}</h3>
        
                <hr class="mb-6">
        
                <div class="mb-6">
                    <label class="block text-sm font-semibold leading-6 text-gray-500">
                        Nombre
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
        
                <div class="mb-10">
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
        
                        <x-button wire:loading.remove wire:target='coverImage' file onlyImages 
                        name="coverImage" wireModel="coverImage" type="secondary" class="w-20 text-center">
                            Subir
                        </x-button>

                        <div wire:loading wire:target='coverImage'>
                            <svg aria-hidden="true" class="w-6 h-6 mx-auto text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                        </div>
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
        
                        <x-button wire:loading.remove wire:target='image' file onlyImages 
                        wireModel="image" name="image" type="secondary" class="w-20 text-center">
                            Subir
                        </x-button>

                        <div wire:loading wire:target='image'>
                            <svg aria-hidden="true" class="w-6 h-6 mx-auto text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                            </svg>
                        </div>

                    </div>
                    @error('image')
                        <small class="text-red-500"> {{ $message }} </small>
                    @enderror
    
                </div>
            </div>

            <div class="flex items-center py-4">

                <x-button submit wire:loading.remove wire:target='save' size="large" class="w-full mr-4">Guardar</x-button>
                
                <div wire:loading wire:target='save' class="w-full">
                    <svg aria-hidden="true" class="w-6 h-6 mx-auto text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                </div>

                <x-button @click="{{ $drawerRef }} = false" size="large" class="w-full" 
                type="secondary">
                    Cancelar
                </x-button>
            </div>

        </form>

    </div>

</div>
