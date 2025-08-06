<div class="{{ $class ?? '' }}">
    @isset($label)
        <label for="{{ $id ?? $label ?? '' }}" class="inline-block text-sm font-medium leading-6 text-gray-900 mb-2">
            {{ $label }}
        </label>

        @isset($withAsterisk)
            <sup class="text-red-500" style="font-size: 12px">*</sup>
        @endisset
    @endisset
    <div>
        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 
        focus-within:ring-inset {{ !isset($readonly) || !$readonly ? 'focus-within:ring-blue-600' : '' }}">
            
            @isset($icon)
                <span class="flex select-none items-center pl-2 -mr-1 text-gray-500 sm:text-sm">
                    <x-icon :code="$icon" class="text-[18px]" />
                </span>
            @endisset

            <input id="{{ $id ?? $label ?? '' }}" type="{{ $type ?? 'text' }}" 
            {{ isset($model) ? "wire:model.blur=$model" : '' }}
            {{ isset($readonly) && $readonly ? 'readonly' : '' }}
            placeholder="{{ $placeholder ?? '' }}"
            class="block w-full flex-1 border-0 bg-transparent py-1.5 px-2.5 text-gray-900 
            placeholder:text-gray-400 focus:ring-0 text-sm leading-6
            {{ isset($readonly) && $readonly ? '!bg-gray-100 !rounded-md !text-gray-600' : '' }}">

        </div>
        @error($model ?? $error ?? '')
            <small class="text-red-500">{{ $message }}</small>
        @else 
            @isset($helper)
                <small class="mt-1 text-xs text-gray-500">
                    {{ $helper }}
                </small>
            @endisset
        @enderror
    </div>
</div>