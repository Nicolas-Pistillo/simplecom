<div class="mt-3 flex items-center flex-wrap gap-4 border-t pt-3">

    @foreach (ZipcodeSelectionType::cases() as $selectionType)
        <div class="flex items-center">

            <input type="radio" wire:model.live='form.zipcode_selection_type' value="{{ $selectionType->value }}" id="{{ $selectionType->value }}" name="zipcodes_type"
            class="border-gray-300 text-blue-600 focus:ring-blue-600">

            <label for="{{ $selectionType->value }}" 
            class="ml-3 block text-sm/6 font-medium text-gray-900">
                {{ $selectionType->name() }}
            </label>
        </div>
    @endforeach
</div>

@if ($form->zipcode_selection_type === ZipcodeSelectionType::ByRanges->value)
    @foreach ($form->zipcodes_range as $index => $range)
        <div wire:key='zipcode-range-{{ $index }}' class="flex items-center mt-4 gap-x-3">
            <x-form-input model="form.zipcodes_range.{{ $index }}.from" 
            icon="location_on" label="Rango {{ $index + 1 }} - Desde"
            placeholder="Código postal desde" />

            <x-icon class="mt-auto mb-2 text-gray-500" code="arrow_range" />

            <x-form-input model="form.zipcodes_range.{{ $index }}.to" 
            icon="location_on" label="Rango {{ $index + 1 }} - Hasta"
            placeholder="Código postal hasta" />

            <x-icon wire:click='deleteZipcodeRange({{ $index }})' code="delete" class="mt-auto text-red-500 p-1 rounded-full border
            hover:bg-gray-50 cursor-pointer" x-tooltip.raw="Eliminar rango" />
        </div>
    @endforeach

    <x-button wire:click='addZipcodeRange' type="secondary" 
    class="mt-3 flex items-center gap-1.5 rounded-full">
        <x-icon code="add" />
        Agregar rango
    </x-button>
@endif

@if ($form->zipcode_selection_type === ZipcodeSelectionType::FreeSelection->value)

    <p class="mt-4 text-sm/6">
        Escribi los códigos postales que vas a cubrir con esta opcion separados por coma
    </p>

    <div class="w-full mt-2 mb-4 border border-gray-200 rounded-lg bg-gray-50">
       <div class="px-4 py-2 bg-white rounded-lg">
           <textarea id="comment" rows="4" class="w-full px-0 text-sm text-gray-900 
           bg-white border-0 focus:ring-0 placeholder:text-gray-400" 
           placeholder="1451,1453,1745..." required ></textarea>
       </div>
   </div>
@endif
