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

@for ($i = 0; $i < 4; $i++)
    <div class="flex items-center mt-3 gap-x-3">
        <x-form-input icon="location_on" label="Desde" />
        <x-icon class="mt-auto mb-2 text-gray-500" code="arrow_range" />
        <x-form-input icon="location_on" label="Hasta" />
    </div>
@endfor

<x-button type="secondary" class="mt-3 flex items-center gap-1.5 rounded-full">
    <x-icon code="add" />
    Agregar rango
</x-button>
