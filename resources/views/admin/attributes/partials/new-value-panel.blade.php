<div x-show="creatingNewValue" x-cloak class="mb-6">

    <label for="new_value" class="inline-block text-sm font-medium leading-6 text-gray-900">
        Nuevo valor
    </label>

    <div class="mt-1 flex items-center flex-wrap">

        <div class="relative">
            <input id="new_value" wire:model='newValueName' @keyup.enter="$wire.addNewValue({{ $attribute->id }})"
                autocomplete="off"
                class="block rounded-md border-0 
            py-1.5 text-gray-900 shadow-sm ring-1 ring-inset 
            ring-gray-300 text-sm placeholder:text-gray-400 
            focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:leading-6 pr-10"
                placeholder="Nombre del valor...">

            @if ($attribute->name === 'Color')
                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                    <input x-tooltip.raw.placement.top="Seleccionar color" type="color" wire:model='color'
                        class="w-6 bg-transparent cursor-pointer">
                </div>
            @endif
        </div>

        <x-icon code="check" wire:click='addNewValue({{ $attribute->id }})' x-tooltip.raw.placement.top="Agregar"
            class="ml-2 p-1 border transition duration-200 
            hover:border-green-400 rounded-full bg-green-50 
            text-green-400 cursor-pointer" />

        <x-icon code="close" x-tooltip.raw.placement.top="Cancelar"
            @click="creatingNewValue = false; $wire.resetNewValue()"
            class="ml-2 p-1 border transition duration-200 
        hover:border-red-400 rounded-full bg-red-50 
        text-red-400 cursor-pointer" />

        <x-spinner wire:loading wire:target='addNewValue' class="ml-2" />
    </div>

    @error('newValueName')
        <small class="mt-1 text-xs text-red-500">
            {{ $message }}
        </small>
    @enderror
    
    @error('color')
        <small class="mt-1 text-xs text-red-500">
            {{ $message }}
        </small>
    @enderror
</div>
