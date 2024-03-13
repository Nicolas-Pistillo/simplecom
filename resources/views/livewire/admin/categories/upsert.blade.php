<div class="h-full">

    <div class="h-full flex flex-col justify-between">

        <div>

            <h3 class="text-lg text-gray-700 font-semibold mb-3">
                Nueva categoría
            </h3>
    
            <hr class="mb-6">
    
            <div class="mb-6">
                <label class="block text-sm font-semibold leading-6 text-gray-500">
                    Nombre
                </label>
                <div class="mt-2">
                  <input type="text" name="name" autocomplete="off" class="block w-full 
                  rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                  placeholder:text-gray-400 focus:ring-2 focus:ring-inset transition duration-300 focus:ring-blue-600 
                  sm:text-sm sm:leading-6">
                </div>
            </div>
    
            <div class="mb-6">
                <label class="block text-sm font-semibold leading-6 text-gray-500">
                    Descripción (opcional)
                </label>
                <div class="mt-2">
                    <textarea name="description" rows="4" autocomplete="off"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                    ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                    focus:ring-inset transition duration-300 focus:ring-blue-600 sm:text-sm 
                    sm:leading-6"></textarea>
                </div>
            </div>
    
            <div class="mb-6">


                <img src="http://via.placeholder.com/1200x630" 
                alt="avatar-category" class="w-full h-28 rounded-lg object-cover">
    
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
    
                    <x-button type="secondary" class="w-20">Subir</x-button>
                </div>
            </div>
    
            <div class="mb-3">

                <img src="http://via.placeholder.com/200x200" 
                alt="avatar-category" class="w-24 h-24 rounded-full">

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
    
                    <x-button type="secondary" class="w-20">Subir</x-button>
                </div>
            </div>
        </div>

        <div class="flex items-center py-4">

            <x-button size="large" class="w-full mr-4">Guardar</x-button>

            <x-button @click="{{ $drawerRef }} = false" size="large" class="w-full" 
            type="secondary">Cancelar</x-button>
        </div>

    </div>

</div>
