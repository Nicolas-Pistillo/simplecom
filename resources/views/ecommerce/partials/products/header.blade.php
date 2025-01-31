
{{-- <div class="pt-8">
    <img src="https://calzzapatodigital.s3.us-west-1.amazonaws.com/landings/calzzasport/fcc9d70f-6160-4e4d-9e81-69f02a0b63e6.webp" 
    class="w-full h-48 rounded-lg object-cover">
</div> --}}

<div class="flex items-end gap-6 flex-wrap justify-between border-b border-gray-200 pb-6 pt-8">

    <h1 class="text-4xl font-bold tracking-tight text-gray-900">Productos</h1>

    <div x-data class="no-select flex items-end gap-4">

        <div class="relative inline-block text-left">
            <div>
                <label for="country" class="block text-sm/6 font-medium text-gray-900">
                    Ordenar por
                </label>
                <div class="grid grid-cols-1">
                    <select id="country" name="country" autocomplete="country-name"
                    class="col-start-1 row-start-1 w-full appearance-none rounded-md 
                    bg-white py-1.5 pr-8 pl-3 text-gray-900 outline-1  border-gray-400
                    -outline-offset-1 outline-gray-300 focus:outline-2 
                    focus:-outline-offset-2 focus:outline-blue-600 text-sm/6">
                        <option>Mas relevantes</option>
                        <option>Mas nuevos</option>
                        <option>Menor precio</option>
                        <option>Mayor precio</option>
                    </select>
                </div>
            </div>
        </div>

        <x-icon code="tune" x-tooltip.raw.placement.top="Filtrar"
        class="block lg:hidden transition colors cursor-pointer bg-gray-100
        text-gray-500 p-2 rounded-full hover:bg-gray-200 
        focus:outline-none focus:ring duration-300" />
    </div>
</div>