<div>
    @foreach ($variants as $variant)

        {{-- Color presentation format --}}
        @if ($variant['attribute_name'] == 'Color')
            <div wire:key='{{ $variant['attribute_id'] }}' class="my-8">
                <p class="text-sm font-medium text-gray-900 mb-2">Seleccionar color</p>
                <div class="flex items-center flex-wrap justify-start gap-4 relative">
                    @foreach ($variant['values'] as $color)
                        @php
                            $isSelected = $selectedVariants[$variant['attribute_id']] === $color['id'];
                        @endphp

                        @if (isset($color['available']) && !$color['available'])
                            <button wire:key='{{ $color['id'] . $color['name'] }}'
                                wire:click='selectVariantAttribute({{ $variant['attribute_id'] }}, {{ $color['id'] }})'
                                x-tooltip.raw.placement.top="{{ $color['name'] }} - Dispnible en otras opciónes"
                                class="p-2 border-2 rounded-full transition-all
                            {{ $isSelected ? 'border-transparent shadow-md' : 'border-gray-200 hover:border-gray-300 opacity-40' }}"
                                style="{{ $isSelected ? "background-color: {$color['meta']['hexa_value']}" : '' }}">
                                <div class="w-5 h-5 rounded-full flex justify-center items-center"
                                    style="background-color: {{ $color['meta']['hexa_value'] }}">
                                    @if ($isSelected)
                                        <x-icon code="check"
                                            class="w-4 h-4 text-xs 
                                        bg-green-500 rounded-full text-white" />
                                    @endif
                                </div>
                            </button>
                        @else
                            <button wire:key='{{ $color['id'] . $color['name'] }}'
                                wire:click='selectVariantAttribute({{ $variant['attribute_id'] }}, {{ $color['id'] }})'
                                x-tooltip.raw.placement.top="{{ $color['name'] }}"
                                class="p-2 border-2 rounded-full transition-all 
                            {{ $isSelected ? 'border-transparent shadow-md' : 'border-gray-200 hover:border-gray-300' }}"
                                style="{{ $isSelected ? "background-color: {$color['meta']['hexa_value']}" : '' }}">
                                <div class="w-5 h-5 rounded-full flex justify-center items-center"
                                    style="background-color: {{ $color['meta']['hexa_value'] }}">
                                    @if ($isSelected)
                                        <x-icon code="check"
                                            class="w-4 h-4 text-xs 
                                        bg-green-500 rounded-full text-white" />
                                    @endif
                                </div>
                            </button>
                        @endif
                    @endforeach
                </div>
                @error("selectedVariants.{$variant['attribute_id']}")
                    <small class="inline-block text-red-500 mt-2">
                        Por favor seleccione una opción de {{ strtolower($variant['attribute_name']) }}
                    </small>
                @enderror
            </div>
        @endif

        {{-- Footwear/Size format --}}
        @if (in_array($variant['attribute_name'], ['Calzado', 'Talle']))
            <div wire:key='{{ $variant['attribute_id'] }}' class="my-8">
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-medium text-gray-900">
                        Seleccionar {{ strtolower($variant['attribute_name']) }}
                    </h2>
                </div>

                <fieldset class="mt-2">
                    <div class="flex items-center flex-wrap gap-3">
                        @foreach ($variant['values'] as $size)
                            @php
                                $isSelected = $selectedVariants[$variant['attribute_id']] === $size['id'];
                            @endphp

                            @if (isset($size['available']) && !$size['available'])
                                {{-- Not available size --}}
                                <label wire:key='{{ $size['id'] . $size['name'] }}'
                                wire:click='selectVariantAttribute({{ $variant['attribute_id'] }}, {{ $size['id'] }})'
                                class="flex items-center justify-center transition duration-200 
                                rounded-md border py-3 px-3 min-w-[80px]
                                text-sm font-medium uppercase cursor-pointer focus:outline-none
                                {{ $isSelected ? 'bg-blue-600 border-blue-500 text-white' : 'opacity-40' }}">
                                    <span> {{ $size['name'] }} </span>
                                </label>
                            @else
                                <label wire:key='{{ $size['id'] . $size['name'] }}'
                                wire:click='selectVariantAttribute({{ $variant['attribute_id'] }}, {{ $size['id'] }})'
                                class="flex items-center justify-center transition duration-200 
                                rounded-md border py-3 px-3 min-w-[80px]
                                text-sm font-medium uppercase cursor-pointer focus:outline-none
                                {{ $isSelected ? 'bg-blue-600 border-blue-500 text-white' : 'hover:bg-gray-100' }}">
                                    <span> {{ $size['name'] }} </span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                    @error("selectedVariants.{$variant['attribute_id']}")
                        <small class="inline-block text-red-500 mt-2">
                            Por favor seleccione una opción de {{ strtolower($variant['attribute_name']) }}
                        </small>
                    @enderror
                </fieldset>
            </div>
        @endif

        {{-- Custom/Others variant format --}}
        @if (!in_array($variant['attribute_name'], ['Calzado', 'Talle', 'Color']))
            @php
                $valueId = $selectedVariants[$variant['attribute_id']];
                $selectedValueName = $valueId ? App\Models\AttributeValue::find($valueId)->name : 'Seleccioná una opcion';
            @endphp

            <div wire:key='{{ $variant['attribute_id'] }}' class="my-8">

                <div x-data="{open: false}">

                    <label class="block text-sm font-medium text-gray-900 mb-2">
                        Seleccionar {{ strtolower($variant['attribute_name']) }}
                    </label>

                    <div class="relative mt-2">
                        <button @click="open = !open" type="button" class="relative w-full 
                        rounded-md bg-white py-1.5 pl-3 pr-10 text-gray-900 shadow-sm 
                        ring-inset ring-gray-300 focus:outline-none focus:ring-2 ring-1
                        focus:ring-blue-600 text-sm sm:leading-6 text-left cursor-default"
                            aria-haspopup="listbox" aria-expanded="true">
                            <span class="block truncate">
                                {{ $selectedValueName }}
                            </span>
                            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                                <x-icon code="unfold_more" class="text-gray-400" style="font-size: 21px" />
                            </span>
                        </button>

                        <ul x-show="open" x-cloak @click.away="open = false" 
                            x-transition:enter="transition ease-in duration-50"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute z-10 mt-1 
                            max-h-60 w-full overflow-y-auto rounded-md bg-white py-1 text-base 
                            shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                            tabindex="-1" role="listbox">
                            
                            @foreach ($variant['values'] as $value)
                                @php
                                    $isSelected = $selectedVariants[$variant['attribute_id']] === $value['id'];
                                @endphp

                                @if (isset($size['available']) && !$size['available'])  

                                    <li wire:click='selectVariantAttribute({{ $variant['attribute_id'] }}, {{ $value['id'] }})'
                                    class="relative cursor-pointer select-none py-2 pl-3 pr-9 border-l-2
                                    {{ $isSelected 
                                        ? 'text-gray-900 border-blue-500' 
                                        : 'border-transparent text-gray-500 hover:bg-gray-50' 
                                    }}" 
                                    role="option">
                                        
                                        <span class="block truncate {{ $isSelected ? 'font-semibold' : 'font-normal' }}">
                                            {{ $value['name'] }}
                                        </span>

                                        @if ($isSelected)
                                            <span class="text-blue-600 absolute inset-y-0 right-0 
                                            flex items-center pr-4">
                                                <x-icon code="check" />
                                            </span>
                                        @else
                                            <span class="text-gray-500 absolute inset-y-0 right-0 
                                            flex items-center pr-4 text-xs">
                                                Disponible en otras opciones
                                            </span>
                                        @endif
                                    </li>

                                @else
                                    <li wire:click='selectVariantAttribute({{ $variant['attribute_id'] }}, {{ $value['id'] }})'
                                    class="text-gray-900 relative cursor-pointer select-none
                                    py-2 pl-3 pr-9 border-l-2
                                    {{ $isSelected ? 'border-blue-500' : 'border-transparent hover:bg-gray-50' }}" 
                                    role="option">
                                        
                                        <span class="block truncate {{ $isSelected ? 'font-semibold' : 'font-normal' }}">
                                            {{ $value['name'] }}
                                        </span>

                                        @if ($isSelected)
                                            <span class="text-blue-600 absolute inset-y-0 right-0 
                                            flex items-center pr-4">
                                                <x-icon code="check" />
                                            </span>
                                        @endif
                                    </li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
                @error("selectedVariants.{$variant['attribute_id']}")
                    <small class="inline-block text-red-500 mt-2">
                        Por favor seleccione una opción de {{ strtolower($variant['attribute_name']) }}
                    </small>
                @enderror
            </div>
        @endif

    @endforeach
</div>
