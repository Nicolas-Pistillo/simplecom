<div>
    @foreach ($variants as $variant)

        {{-- Color presentation format --}}
        @if ($variant['attribute_name'] == 'Color')
            <div wire:key='{{ $variant['attribute_id'] }}' class="my-8">
                <p class="text-sm font-medium text-gray-900 mb-2">Seleccione un color</p>
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
                                        <x-icon code="check" class="w-4 h-4 text-xs 
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
                                        <x-icon code="check" class="w-4 h-4 text-xs 
                                        bg-green-500 rounded-full text-white" />
                                    @endif
                                </div>
                            </button>
                        @endif
                    @endforeach
                </div>
                @error("selectedVariants.{$variant['attribute_id']}")
                    <small class="inline-block text-red-500 mt-2">
                        Por favor seleccione una opción de {{ $variant['attribute_name'] }}
                    </small>
                @enderror
            </div>
        @endif

        {{-- Footwear/Size format --}}
        @if (in_array($variant['attribute_name'], ['Calzado', 'Talle']))
            <div wire:key='{{ $variant['attribute_id'] }}' class="my-8">
                <div class="flex items-center justify-between">
                    <h2 class="text-sm font-medium text-gray-900">
                        Seleccione un {{ strtolower($variant['attribute_name']) }}
                    </h2>
                    <a href="#"
                        class="text-sm font-medium text-indigo-600 hover:text-indigo-500">See
                        sizing
                        chart</a>
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
                                {{ $isSelected ? 'bg-blue-600 text-white' : 'opacity-40' }}">
                                    <span> {{ $size['name'] }} </span>
                                </label>
                            @else
                                <label wire:key='{{ $size['id'] . $size['name'] }}'
                                wire:click='selectVariantAttribute({{ $variant['attribute_id'] }}, {{ $size['id'] }})'
                                class="flex items-center justify-center transition duration-200 
                                rounded-md border py-3 px-3 min-w-[80px]
                                text-sm font-medium uppercase cursor-pointer focus:outline-none
                                {{ $isSelected ? 'bg-blue-600 text-white' : 'hover:bg-gray-100' }}">
                                    <span> {{ $size['name'] }} </span>
                                </label>
                                
                            @endif
                        @endforeach
                    </div>
                    @error("selectedVariants.{$variant['attribute_id']}")
                        <small class="inline-block text-red-500 mt-2">
                            Por favor seleccione una opción de {{ $variant['attribute_name'] }}
                        </small>
                    @enderror
                </fieldset>
            </div>
        @endif

        {{-- Custom/Others variant format --}}
        @if (!in_array($variant['attribute_name'], ['Calzado', 'Talle', 'Color']))
            <div wire:key='{{ $variant['attribute_id'] }}' class="my-8">

            </div>
        @endif

    @endforeach
</div>