<section class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
    <div>
        <h2 class="text-base font-semibold leading-7 text-gray-900">Variantes</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">
            Si el producto cuenta con diferentes características seleccionables como color, talle,
            modelo etc. podes agregar sus variantes en esta sección.
        </p>
    </div>

    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

        <div class="sm:col-span-6 border rounded-md">

            <div class="text-sm font-semibold leading-7 flex items-center justify-between bg-gray-50">
                <h5 class="p-2 text-gray-900">Variante 1</h5>
                <div class="p-2">
                    <x-icon code="delete" class="text-red-500 cursor-pointer" 
                    x-tooltip.raw.placement.top="Eliminar variante" />
                </div>
            </div>

            <ul role="list" class="p-2">
                <li class="relative gap-x-6 py-3">
                    <div class="flex min-w-0 gap-x-4 mb-2">
                        <div class="min-w-0 flex-auto w-full">
                            <div>
                                <label for="location" class="block text-sm font-medium leading-6 
                                text-gray-900">Atributo</label>
                                <select id="location" name="location"
                                class="mt-0.5 block w-full rounded-md border-0 py-1.5 pl-3 
                                pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 
                                focus:ring-blue-600 sm:text-sm sm:leading-6">
                                    <option>Seleccionar</option>
                                    <option>United States</option>
                                    <option>Canada</option>
                                    <option>Mexico</option>
                                </select>
                            </div>
                        </div>
                        <div class="min-w-0 flex-auto w-full">
                            <div>
                                <label for="location"
                                    class="block text-sm font-medium leading-6 
                                text-gray-900">Valor</label>
                                <select id="location" name="location"
                                    class="mt-0.5 block w-full rounded-md border-0 py-1.5 pl-3 
                                pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 
                                focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option>United States</option>
                                    <option selected>Canada</option>
                                    <option>Mexico</option>
                                </select>
                            </div>
                        </div>
                        <div class="min-w-0 flex-auto w-full">
                            <div>
                                <label for="location" class="text-sm font-medium leading-6 
                                text-gray-900">Stock</label>
                                <input id="location" name="location"
                                class="mt-0.5 block w-full rounded-md border-0 py-1.5 pl-3 
                                pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 
                                focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                            </div>
                        </div>
                    </div>
                </li>
                <div class="inline-flex items-center text-blue-500 text-xs cursor-pointer 
                    transition duration-300">
                    <x-icon code="add" class="mr-1" />
                    <span class="hover:underline">Agregar atributo</span>
                </div>
            </ul>
        </div>

        <div class="sm:col-span-6 flex items-end">
            <div class="flex items-center text-blue-500 text-sm cursor-pointer transition duration-300
            hover:shadow py-1 px-2 rounded-full border">
                <x-icon code="add_circle" class="mr-1" />
                Agregar variante
            </div>
        </div>
    </div>
</section>
