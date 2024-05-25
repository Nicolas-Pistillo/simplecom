<div>

    <div class="px-4 sm:px-6 lg:px-8">

        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Atributos</h1>
                <p class="w-full lg:w-4/5 mt-2 text-sm text-gray-700">
                    Los atributos sirven para crear las variantes de tus productos.
                    Son <strong>características</strong> especiales con distintos valores
                    que tus clientes seleccionarán al momento de comprar un producto variable.
                </p>
            </div>
        </div>

        <div class="mb-4">
            <label for="new_attribute" class="inline-block text-sm font-medium leading-6 text-gray-900">
                Nuevo atributo
            </label>
            <div class="mt-1 flex items-center flex-wrap">
                <input id="new_attribute" wire:model='newAttributeName' @keyup.enter="$wire.addNewAttribute"
                    autocomplete="off"
                    class="block rounded-md border-0 
                    py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 text-sm
                 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:leading-6"
                    placeholder="Nombre del atributo..." aria-describedby="email-description">

                <x-button wire:click='addNewAttribute' wire:loading.remove wire:target='addNewAttribute'
                    class="ml-2 w-content">Agregar</x-button>

                <x-spinner wire:loading wire:target='addNewAttribute' class="ml-2" />
            </div>
            @error('newAttributeName')
                <small class="mt-1 text-xs text-red-500">
                    {{ $message }}
                </small>
            @else
                <small class="mt-1 text-xs text-gray-500">
                    Por ejemplo: Material, sabor, tela etc.
                </small>
            @enderror
        </div>

        <div x-data="{selected: null}">
            <div class="divide-y bg-gr mb-8 divide-gray-100 overflow-hidden 
            shadow ring-1 ring-gray-900/5 rounded-xl">
                <ul class="w-full" x-cloak role="list">
                    @foreach ($attributes as $attribute)
                        <div wire:key='{{ $attribute->id }}' 
                        x-data="{ mouseOnAttribute: false, confirmDeleteAttribute: false, creatingNewValue: false }"
                        x-on:close-newvalue-panel.window="creatingNewValue = false">

                            <li @mouseover="mouseOnAttribute = true" @mouseover.away="mouseOnAttribute = false"
                                class="relative flex justify-between  gap-x-6 p-3 sm:px-6 cursor-pointer transition duration-200"
                                :class="selected == {{ $attribute->id }} ? 'bg-gray-50 shadow-md' : 'hover:bg-gray-50'">

                                <div @click="selected !== {{ $attribute->id }}  ? selected = {{ $attribute->id }} : selected = null"
                                    class="flex w-full gap-x-4">

                                    <x-icon code="category"
                                        class="text-2xl text-gray-600 w-10 h-10 p-1 
                                        rounded-full bg-gray-50 text-center shadow" />

                                    <p class="text-sm flex items-center font-semibold leading-6 text-gray-900">
                                        {{ $attribute->name }}
                                    </p>
                                </div>

                                <div class="flex shrink-0 items-center gap-x-4">

                                    @if (!$attribute->isDefault())
                                        {{-- Edit attribute --}}
                                        <div x-tooltip.raw.placement.left="Editar atributo">
                                            <x-icon x-show="mouseOnAttribute" code="edit"
                                                class="text-2xl text-gray-600 w-8 h-8 p-1 flex items-center
                                            rounded-full bg-gray-50 transition hover:bg-white 
                                            text-center shadow cursor-pointer" />
                                        </div>

                                        {{-- Delete attribute --}}
                                        <div x-tooltip.raw.placement.left="Elminar atributo">
                                            <x-icon x-show="mouseOnAttribute" code="delete"
                                                @click="selected = null; confirmDeleteAttribute = true"
                                                class="text-2xl text-red-400 w-8 h-8 p-1 rounded-full 
                                            flex items-center bg-gray-50 transition hover:bg-white 
                                            text-center shadow cursor-pointer" />
                                        </div>

                                        {{-- Confirm delete attribute --}}
                                        @include('admin.attributes.partials.delete-attribute-dialog')
                                    @endif

                                    {{-- Show values --}}
                                    @if ($attribute->hasValues())
                                        <div
                                            x-tooltip.placement.left="selected == {{ $attribute->id }} ? 'Contraer' : 'Ver valores'">
                                            <i @click="selected !== {{ $attribute->id }} ? selected = {{ $attribute->id }} : selected = null"
                                                class="material-symbols-outlined text-gray-600 shadow p-1 rounded-full 
                                                bg-gray-50 transition hover:bg-white cursor-pointer"
                                                x-text="selected == {{ $attribute->id }} ? 'expand_less' : 'expand_more'"></i>
                                        </div>
                                    @endif
                                </div>
                            </li>

                            <div x-show="selected == {{ $attribute->id }}" x-collapse.duration.500>

                                @if ($attribute->hasValues())
                                    <div class="ml-8 sm:ml-11"
                                        :class="selected == {{ $attribute->id }} && 'border-l border-gray-200'">
                                        <div class="pl-5">

                                            <div class="flex items-center mt-3 mb-5">
                                                <h4 class="text-sm font-semibold text-gray-700">
                                                    Valores de {{ $attribute->name }}
                                                </h4>
    
                                                <x-button type="secondary" size="small"
                                                @click="creatingNewValue = true" 
                                                class="ml-2 flex items-center">
                                                    <x-icon code="add" style="font-size: 20px" />
                                                    Agregar
                                                </x-button>
                                            </div>
  
                                            @include('admin.attributes.partials.new-value-panel')

                                            <div class="flex items-center flex-wrap gap-3 mb-2 pr-3">

                                                @foreach ($attribute->values as $value)

                                                    <div wire:key='{{ $value->id . $value->name }}' x-data="{confirmDeleteValue: false}"
                                                    x-on:close-deletevalue-panel.window="confirmDeleteValue = false">
                                                        
                                                        <x-badge wire:key='{{ $value->id }}'
                                                        class="cursor-default no-select 
                                                        flex items-center hover:bg-gray-100">
        
                                                            @if ($attribute->name === 'Color')
                                                                <div class="w-3 h-3 rounded-full mr-1 shadow"
                                                                style="background-color: {{ $value->meta['hexa_value'] }}">
                                                                </div>
                                                            @endif
        
                                                            {{ $value->name }}

                                                            <x-icon x-tooltip.raw.placement.bottom="Eliminar valor" code="delete" 
                                                            @click="confirmDeleteValue = true" style="font-size: 18px"
                                                            class="ml-1.5 cursor-pointer hover:text-red-500" />

                                                            {{-- Confirm delete value --}}
                                                            @include('admin.attributes.partials.delete-value-dialog')
        
                                                        </x-badge>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="border-l ml-8 sm:ml-11 pl-10 py-3.5">
                                        <div x-show="!creatingNewValue" class="flex items-center">

                                            <h4 class="text-sm font-semibold text-gray-400">Sin valores</h4>

                                            <x-button type="secondary" size="small"
                                            @click="creatingNewValue = true" 
                                            class="ml-2 flex items-center">
                                                <x-icon code="add" style="font-size: 20px" />
                                                Agregar
                                            </x-button>
                                            
                                        </div>
                                        @include('admin.attributes.partials.new-value-panel')
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
