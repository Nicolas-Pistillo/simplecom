<section class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
    <div>
        <h2 class="text-base font-semibold leading-7 text-gray-900">Venta</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">
            Configurá todo lo relacionado con el coste, precio y condiciónes de venta
        </p>
    </div>

    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

        {{-- Price field --}}
        <div class="sm:col-span-3">
            <label for="price" class="block text-sm font-medium leading-6 text-gray-900">
                Precio <sup class="text-red-500 -ml-1">*</sup>
            </label>
            <div class="mt-2">
                <div
                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                    <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">$</span>
                    <input wire:model.blur='form.price' autocomplete="off" step="0.01" type="number"
                        id="price" required
                        class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                </div>
                @error('form.price')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- Cost field --}}
        <div class="sm:col-span-3">
            <label for="unit_cost" class="flex items-center text-sm font-medium leading-6 text-gray-900">
                Costo unitario 
                <x-icon code="help" class="ml-1 text-blue-500 cursor-help" 
                x-tooltip.raw.placement.top="Es el gasto que corre por tu cuenta por conseguir este producto para venderlo,
                se podrán calcular las ganancias del producto con este dato"
                />
            </label>
            <div class="mt-2">
                <div
                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                    <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">$</span>
                    <input wire:model.blur='form.unit_cost' autocomplete="off" step="0.01" type="number" id="unit_cost"
                        class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                </div>
                @error('form.unit_cost')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- Discount % field --}}
        <div class="sm:col-span-3">
            <label for="discount_percent" class="block text-sm font-medium leading-6 text-gray-900">
                Porcentaje de descuento
            </label>
            <div class="mt-2">
                <div
                    class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                    <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">%</span>
                    <input wire:model.blur='form.discount_percent' type="number" max="100"
                        id="discount_percent" autocomplete="off"
                        class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                </div>

                @error('form.discount_percent')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- Min sale field --}}
        <div class="sm:col-span-3 sm:col-start-1">
            <label for="min_sale" class="block text-sm font-medium leading-6 text-gray-900">
                Compra mínima
            </label>
            <div class="mt-2">
                <input wire:model.blur='form.min_sale' type="number" id="min_sale" autocomplete="off"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                @error('form.min_sale')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror

                @if (!$errors->first('form.min_sale') && !$form->min_sale)
                    <span class="mt-1 text-xs leading-6 text-gray-500">
                        Por defecto el valor será de 1 unidad
                    </span>
                @endif
            </div>
        </div>

        {{-- Max sale field --}}
        <div class="sm:col-span-3">
            <label for="max_sale" class="block text-sm font-medium leading-6 text-gray-900">
                Compra máxima
            </label>
            <div class="mt-2">
                <input wire:model.blur='form.max_sale' type="number" id="max_sale" autocomplete="off"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                @error('form.max_sale')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror

                @if (!$errors->first('form.max_sale') && !$form->max_sale)
                    <span class="mt-1 text-xs leading-6 text-gray-500">
                        Por defecto el límite será el stock
                    </span>
                @endif
            </div>
        </div>
    </div>
</section>