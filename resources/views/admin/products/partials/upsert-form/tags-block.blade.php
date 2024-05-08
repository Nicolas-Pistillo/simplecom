<section class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
    <div>
        <h2 class="text-base font-semibold leading-7 text-gray-900">Etiquetas</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">
            Las etiquetas ayudan a que tus clientes y el navegador encuentren productos de este tipo con
            mayor facilidad.
        </p>
    </div>

    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

        {{-- Tags field --}}
        <div x-data="{ tagsPanelOpen: false }" class="sm:col-span-4">
            <label for="tags" class="flex items-center text-sm font-medium leading-6 text-gray-900">
                Elegir etiqueta
                <x-icon
                    x-tooltip.raw.placement.top="Podés crear nuevas etiquetas escribiendo 
                    su nombre en este campo y luego presionando ENTER para guardarlas y asociarlas al producto."
                    code="help" class="ml-1 text-blue-500" />
            </label>

            <div class="mt-2 flex items-center">
                <div @click.away="tagsPanelOpen = false"
                    class="flex items-center w-full rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                    <input type="search" wire:model.live='tagSearch' autocomplete="off" id="tags"
                        @focus="tagsPanelOpen = true" @keydown="tagsPanelOpen = true"
                        @keydown.enter.prevent="$wire.createTag($el.value); $el.value = ''; tagsPanelOpen = false"
                        class="relative block w-full placeholder:text-sm flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 text-sm sm:leading-6"
                        placeholder="Buscar o agregar etiqueta...">

                    <x-spinner wire:loading wire:target='createTag, addTag' class="mr-2" />
                </div>
            </div>

            <div x-show="tagsPanelOpen" x-cloak x-transition
                class="absolute z-10 mt-2 bg-white min-w-[14rem] rounded shadow-md overflow-y-auto max-h-44">
                <ul>
                    @forelse ($tags as $tag)
                        <li wire:key='{{ $tag->id }}' @click="tagsPanelOpen = false"
                            wire:click='addTag({{ $tag->id }})'
                            class="text-sm my-2 p-2 transition duration-300 flex items-center 
                            hover:bg-gray-50 cursor-pointer">
                            <x-icon code="loyalty" class="mr-1" />
                            {{ $tag->name }}
                        </li>
                    @empty
                    @endforelse
                </ul>
            </div>

            @if ($selectedTagsModels->isNotEmpty())
                <div class="mt-3 flex items-center flex-wrap gap-2">
                    @foreach ($selectedTagsModels as $selectedTag)
                        <x-badge color="blue" icon="sell">

                            {{ $selectedTag->name }}

                            <x-icon code="close" x-tooltip.raw.placement.bottom="Remover etiqueta"
                                wire:click='removeTag({{ $selectedTag->id }})'
                                class="text-sm ml-1 hover:text-red-500 cursor-pointer" />
                        </x-badge>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>