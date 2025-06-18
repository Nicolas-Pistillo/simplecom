<section class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
    <div>
        <h2 class="text-base font-semibold leading-7 text-gray-900">Dimensiones y stock</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">
            Las dimensiones físicas del producto son datos necesarios para gestionar el envío del pedido.
        </p>
    </div>

    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

        {{-- Stock field --}}
        @if ($calculatedStock)
            <div class="sm:col-span-2 sm:col-start-1">
                <div class="flex items-center">
                    <label for="stock" class="block text-sm font-medium leading-6 text-gray-900">Stock</label>
                    <x-icon code="help" class="ml-1 text-blue-500 cursor-default" 
                    x-tooltip.raw.placement.top="El stock total del producto esta siendo calculado
                    por la sumatoria de stock de cada variante."
                    />
                </div>
                <div class="mt-2">
                    <input wire:model.blur='form.stock' type="number" id="stock" autocomplete="off"
                    disabled class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                    ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                    focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6
                    bg-gray-100 cursor-not-allowed">

                    @error('form.stock')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        @else
            <div class="sm:col-span-2 sm:col-start-1">
                <label for="stock" class="block text-sm font-medium leading-6 text-gray-900">Stock</label>
                <div class="mt-2">
                    <input wire:model.blur='form.stock' type="number" id="stock" autocomplete="off"
                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                    ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                    focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                    @error('form.stock')
                        <small class="text-red-500 text-xs">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        @endif

        {{-- Weight field --}}
        <div class="sm:col-span-2">
            <label for="weight" class="block text-sm font-medium leading-6 text-gray-900">
                Peso <sup class="text-red-500 -ml-1">*</sup>
                <x-badge x-tooltip.raw.placement.top="Gramos" color="blue">GR</x-badge>
            </label>
            <div class="mt-2">
                <input wire:model.blur='form.weight' type="number" id="weight" required
                    autocomplete="off"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                @error('form.weight')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- Width field --}}
        <div class="sm:col-span-2 sm:col-start-1">
            <label for="width" class="block text-sm font-medium leading-6 text-gray-900">
                Ancho <sup class="text-red-500 -ml-1">*</sup>
                <x-badge x-tooltip.raw.placement.top="Centímetros" color="blue">CM</x-badge>
            </label>
            <div class="mt-2">
                <input wire:model.blur='form.width' type="number" required id="width"
                    autocomplete="off"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                @error('form.width')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- Height field --}}
        <div class="sm:col-span-2">
            <label for="height" class="block text-sm font-medium leading-6 text-gray-900">
                Alto <sup class="text-red-500 -ml-1">*</sup>
                <x-badge x-tooltip.raw.placement.top="Centímetros" color="blue">CM</x-badge>
            </label>
            <div class="mt-2">
                <input wire:model.blur='form.height' type="number" required id="height"
                    autocomplete="off"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                @error('form.height')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- Length field --}}
        <div class="sm:col-span-2">
            <label for="length" class="block text-sm font-medium leading-6 text-gray-900">
                Largo <sup class="text-red-500 -ml-1">*</sup>
                <x-badge x-tooltip.raw.placement.top="Centímetros" color="blue">CM</x-badge>
            </label>
            <div class="mt-2">
                <input wire:model.blur='form.length' type="number" required id="length"
                    autocomplete="off"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                @error('form.length')
                    <small class="text-red-500 text-xs">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</section>