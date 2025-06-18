<section class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
    <div>
        <h2 class="text-base font-semibold leading-7 text-gray-900">Variantes</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">
            Si el producto cuenta con diferentes características seleccionables como color, talle,
            modelo etc. podes agregar sus variantes en esta sección.
        </p>
    </div>

    <div class="grid max-w-2xl grid-cols-1 gap-6 sm:grid-cols-6 md:col-span-2">

        <div class="sm:col-span-6">

            <h4 class="text-sm text-gray-500 mb-2 flex items-center">
                1 - Seleccionar atributos
                <x-icon code="help" class="text-blue-500 ml-1 cursor-default" 
                x-tooltip.raw.placement.top="Selecciona los atributos con los cuales tu producto
                va a variar, podes combinar hasta 3 atributos diferentes para crear tus variantes."
                />
            </h4>

            <div x-data="{attributesPanelOpen: false}" class="relative mb-3">

                <div class="flex items-center">
                    <x-button @click="attributesPanelOpen = !attributesPanelOpen" 
                    type="secondary" class="inline-flex items-center">
                        Seleccionar atributo <x-icon code="expand_more" class="ml-1" />
                    </x-button>

                    @if (!empty($selectedAttributes))
                    <div class="flex items-center flex-wrap gap-3 mx-3">
                        @foreach ($selectedAttributes as $attribute)
                            <x-badge color="blue">{{ $attribute->name }}</x-badge>
                        @endforeach
                    </div>
                @endif
                </div>
    
                <!-- Dropdown menu -->
                <div x-show="attributesPanelOpen" x-transition x-cloak
                @click.away="attributesPanelOpen = false"
                class="z-10 bg-white rounded-lg shadow-md absolute overflow-hidden
                overflow-y-auto top-10 left-0 max-h-44" style="min-width: 12rem">
                    <ul class="overflow-y-auto text-sm text-gray-700">
                        @forelse ($attributes as $attribute)
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-50 transition">
                                    <input id="checkbox-{{ $attribute->name }}" 
                                    {{ (array_search($attribute->id, array_column($selectedAttributes, 'id')) === 0) ||
                                       (array_search($attribute->id, array_column($selectedAttributes, 'id')) > 0) 
                                        ? 'checked' : ''
                                    }}
                                    wire:change='toggleVariantAttribute({{ $attribute->id }}, $el.checked)'
                                    type="checkbox" class="w-4 h-4 text-blue-600 
                                    bg-gray-100 cursor-pointer border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                                    <label for="checkbox-{{ $attribute->name }}" class="w-full ms-2 text-sm font-medium 
                                    text-gray-900 rounded">{{ $attribute->name }}</label>
                                </div>
                            </li>
                        @empty
                            <li>
                                <div class="flex items-center p-2 rounded hover:bg-gray-50 transition">
                                    <p class="w-full text-sm font-medium 
                                    text-gray-500 rounded no-select">No se encontraron atributos</p>
                                </div>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>

        </div>

        @if (!empty($selectedAttributes))
            <div class="sm:col-span-6">

                <h4 class="text-sm text-gray-500 mb-2 flex items-center">
                    2 - Crear variantes 
                    <x-icon code="help" class="ml-1 text-blue-500 cursor-default" 
                    x-tooltip.raw.placement.top="Debes definir cada variante que tu producto tenga en base a los atributos que elegiste.
                    Recordá que el stock final del producto se calculará en base a la sumatoria de stock de cada variante."
                    />
                </h4>

                @forelse ($variants as $key => $variant)
                    <div wire:key='{{ $key }}' class="sm:col-span-6 border rounded-md my-3">

                        <div class="text-sm font-semibold leading-7 flex items-center justify-between bg-gray-50">
                            <h5 class="p-2 text-gray-900">Variante {{ $loop->index + 1 }}</h5>
                            <div class="p-2">
                                <x-icon code="delete" class="text-red-500 cursor-pointer" 
                                wire:click='removeVariant({{ $key }})'
                                x-tooltip.raw.placement.top="Eliminar variante" />
                            </div>
                        </div>
            
                        <ul role="list" class="p-2">
                            @foreach ($selectedAttributes as $attribute)
                                <li wire:key='{{ $attribute->id }}' class="relative gap-x-6 py-3">
                                    <div class="flex min-w-0 gap-x-4">
                                        <div class="min-w-0 flex-auto w-full">
                                            <div>
                                                <label for="location" class="block text-sm font-medium leading-6 
                                                text-gray-900">Atributo</label>
                                                <select id="location" name="location" disabled
                                                class="mt-0.5 block w-full rounded-md border-0 py-1.5 pl-3 
                                                pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 
                                                focus:ring-blue-600 sm:text-sm sm:leading-6 cursor-not-allowed">
                                                    <option>{{ $attribute->name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="min-w-0 flex-auto w-full">
                                            <div>
                                                <label class="block text-sm font-medium leading-6 
                                                text-gray-900">Valor</label>
                                                <select wire:model.blur='variants.{{ $key }}.attributes.{{ $attribute->id }}'
                                                class="mt-0.5 block w-full rounded-md border-0 py-1.5 pl-3 
                                                pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 
                                                focus:ring-blue-600 sm:text-sm sm:leading-6">
                                                    <option>Seleccionar valor</option>
                                                    @foreach ($attribute->values as $attributeValue)
                                                        <option value="{{ $attributeValue->id }}">{{ $attributeValue->name }}</option>    
                                                    @endforeach
                                                </select>
                                                @error("variants.$key.attributes.$attribute->id")
                                                    <small class="text-xs text-red-500">
                                                        Seleccione un valor de {{ $attribute->name }} válido
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            <li class="w-auto pb-3">
                                <div class="inline-block">
                                    <label class="block text-sm font-medium leading-6 text-gray-900">Stock</label>
                                    <div class="mt-0.5">
                                        <input wire:model.blur='variants.{{ $key }}.stock'
                                        type="number" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                                        ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                                        focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                                        @error("variants.$key.stock")
                                            <small class="text-xs text-red-500">El campo stock es inválido</small>
                                        @enderror
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                @empty
                @endforelse

                <div class="flex items-end mt-3">
                    <div wire:click='addVariant' class="flex items-center text-blue-500 text-sm 
                    cursor-pointer transition duration-300 hover:shadow py-1 px-2 rounded-full border">
                        <x-icon code="add_circle" class="mr-1" />
                        Agregar variante
                    </div>
                </div>

            </div>
        @endif
    </div>
</section>
