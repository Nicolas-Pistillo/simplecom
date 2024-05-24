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
            <label for="new_attribute" class="block text-sm font-medium leading-6 text-gray-900">Nuevo atributo</label>
            <div class="mt-1 flex items-center flex-wrap">
                <input id="new_attribute" wire:model='newAttributeName' @keyup.enter="$wire.addNewAttribute" 
                autocomplete="off" class="block rounded-md border-0 
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

        <div x-data="{ selected: null, selectedAttribute: null }">
            <div class="divide-y bg-gr mb-5 divide-gray-100 overflow-hidden 
            shadow ring-1 ring-gray-900/5 rounded-xl">
                <ul class="w-full" x-cloak role="list">
                    @foreach ($attributes as $attribute)
                        <div wire:key='{{ $attribute->id }}'>

                            <li x-data="{ mouseOnAttribute: false, confirmDeleteAttribute: false }" @click="selectedAttribute = null"
                                @mouseover="mouseOnAttribute = true" @mouseover.away="mouseOnAttribute = false"
                                class="relative flex justify-between  gap-x-6 p-3 sm:px-6 cursor-pointer transition duration-200"
                                :class="selected == {{ $attribute->id }} ? 'bg-gray-50 shadow-md' : 'hover:bg-gray-50'">

                                <div @click="selected !== {{ $attribute->id }} 
                                    ? selected = {{ $attribute->id }} 
                                    : selected = null"
                                    class="flex w-full gap-x-4">

                                    <x-icon code="category"
                                        class="text-2xl text-gray-600 w-10 h-10 p-1 
                                        rounded-full bg-gray-50 text-center shadow" />

                                    <p class="text-sm flex items-center font-semibold leading-6 text-gray-900">
                                        {{ $attribute->name }}
                                    </p>
                                </div>

                                <div class="flex shrink-0 items-center gap-x-4">

                                    {{-- Add value --}}
                                    <div x-tooltip.raw.placement.left="Agregar valor">
                                        <x-icon wire:click='openAddSubcategory({{ $attribute->id }})'
                                            x-show="mouseOnAttribute" code="library_add"
                                            @click="selected = {{ $attribute->id }};"
                                            class="text-2xl text-gray-600 w-8 h-8 p-1 flex items-center
                                            rounded-full bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
                                    </div>

                                    @if (!$attribute->isDefault())

                                        {{-- Edit attribute --}}
                                        <div x-tooltip.raw.placement.left="Editar atributo">
                                            <x-icon wire:click='openEditCategory({{ $attribute->id }})'
                                                x-show="mouseOnAttribute" code="edit"
                                                class="text-2xl text-gray-600 w-8 h-8 p-1 flex items-center
                                                    rounded-full bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
                                        </div>

                                        {{-- Delete attribute --}}
                                        <div x-tooltip.raw.placement.left="Elminar atributo">
                                            <x-icon x-show="mouseOnAttribute" code="delete" 
                                            @click="selected = null; confirmDeleteAttribute = true"
                                            class="text-2xl text-red-400 w-8 h-8 p-1 rounded-full flex items-center
                                            bg-gray-50 transition hover:bg-white text-center shadow cursor-pointer" />
                                        </div>

                                        <x-modal ref="confirmDeleteAttribute" type="danger" icon="warning">
        
                                            <x-slot name="title">
                                                Eliminar el atributo <span class="text-blue-600">{{ $attribute->name }}</span>
                                            </x-slot>
            
                                            <x-slot name="body">
                                                ¿Estás seguro de que deseas eliminar este atributo?, se eliminaran
                                                todos sus valores y se removerá de cada variante que esté asociado.
                                            </x-slot>
            
                                            <x-slot name="actions">
            
                                                <x-spinner wire:loading wire:target='deleteAttribute' />
            
                                                <x-button type="secondary" wire:loading.remove wire:target='deleteAttribute'
                                                @click="confirmDeleteAttribute = false">Cancelar</x-button>
            
                                                <x-button wire:click='deleteAttribute({{ $attribute->id }})'
                                                wire:loading.remove wire:target='deleteAttribute'
                                                class="bg-red-600 hover:bg-red-500 mx-3">Eliminar</x-button>
            
                                            </x-slot>
            
                                        </x-modal>
                                    @endif

                                    {{-- Show values --}}
                                    @if ($attribute->hasValues())
                                        <div x-tooltip.placement.left="selected == {{ $attribute->id }} ? 'Contraer' : 'Ver valores'">
                                            <i @click="selected !== {{ $attribute->id }} ? selected = {{ $attribute->id }} : selected = null"
                                                class="material-symbols-outlined text-gray-600 shadow p-1 rounded-full 
                                                bg-gray-50 transition hover:bg-white cursor-pointer"
                                                x-text="selected == {{ $attribute->id }} ? 'expand_less' : 'expand_more'"></i>
                                        </div>
                                    @endif
                                </div>
                            </li>

                            {{-- Attribute values --}}
                            @if ($attribute->hasValues())
                                <div x-show="selected == {{ $attribute->id }}" x-collapse.duration.500 class="ml-8 sm:ml-11"
                                    :class="selected == {{ $attribute->id }} && 'border-l border-gray-200'">

                                    <div class="pl-5">

                                        <h4 class="text-sm font-semibold text-gray-700 my-3">
                                            Valores de {{ $attribute->name }}
                                        </h4>

                                        <div class="flex items-center flex-wrap gap-3 mb-2">

                                            @foreach ($attribute->values as $value)
                                                <x-badge wire:key='{{ $value->id }}'
                                                    class="cursor-default flex items-center"
                                                    x-tooltip.raw.placement.top="{{ $value->name }}">

                                                    @if ($attribute->name === 'Color')
                                                        <div class="w-3 h-3 rounded-full mr-1 shadow"
                                                            style="background-color: {{ $value->meta['hexa_value'] }}">
                                                        </div>
                                                    @endif

                                                    {{ $value->name }}
                                                </x-badge>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            @else
                                <div x-show="selected == {{ $attribute->id }}" x-collapse.duration.300>
                                    <h4 class="border-l text-sm font-semibold ml-8 sm:ml-11 pl-10 text-gray-400 py-3.5">
                                        Sin valores
                                    </h4>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>

        
    </div>

</div>
