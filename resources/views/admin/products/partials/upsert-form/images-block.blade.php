<section class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
    <div>
        <h2 class="text-base font-semibold leading-7 text-gray-900">Imágenes</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">
            Podes cambiar el orden de visualización que se verá en la pantalla del producto moviendo las
            images que subas.
        </p>
    </div>

    <div class="max-w-2xl space-y-10 md:col-span-2">

        <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

            <div class="sm:col-span-6">

                <x-dropzone model="images" />

                <div id="previewImages" class="flex items-center flex-wrap">
                    @if (!empty($images))
                        @foreach ($images as $key => $image)
                            @if (isset($image->id))
                                <div wire:key='{{ $image->id }}' data-id="{{ $image->id }}"
                                    x-data="{ deleteDialogOpen: false }"
                                    class="sortable-item text-center rounded-md m-2"
                                    :class="deleteDialogOpen ? 'cursor-default' : 'cursor-move'">

                                    <div x-data="{ showDelete: false }" @mouseenter="showDelete = true"
                                        @mouseleave="showDelete = false" class="relative mb-2">

                                        <x-badge color="blue"
                                            class="absolute -top-2 -left-2 !rounded-full">
                                            {{ $loop->index + 1 }}
                                        </x-badge>

                                        <img src="{{ Storage::url($image->url) }}"
                                            alt="preview-product-image"
                                            class="w-24 h-20 border rounded-lg shadow object-cover">

                                        <x-icon x-show="showDelete" code="delete"
                                            @click="deleteDialogOpen = true"
                                            x-tooltip.raw.placement.bottom="Eliminar"
                                            style="font-size: 20px"
                                            class="cursor-pointer 
                                            absolute -bottom-2 -right-2 p-1 bg-gray-50 
                                            hover:bg-white text-red-500 shadow rounded-full" />
                                    </div>

                                    <p class="text-xs text-gray-700">
                                        Subida el {{ $image->created_at->format('d/m') }}
                                    </p>

                                    <x-modal ref="deleteDialogOpen" type="danger" icon="warning"
                                        title="Eliminar imagen">

                                        <x-slot name="body">
                                            ¿Estás seguro que deseas eliminar esta imagen?

                                            <img class="w-32 h-24 mt-3 rounded mx-auto shadow object-contain"
                                                src="{{ $image->url() }}" alt="product-image">
                                        </x-slot>

                                        <x-slot name="actions">

                                            <x-spinner wire:loading wire:target='deleteImage' />

                                            <x-button type="secondary" wire:loading.remove
                                                wire:target='deleteImage'
                                                @click="deleteDialogOpen = false">Cancelar</x-button>

                                            <x-button wire:click='deleteImage({{ $key }})'
                                                wire:loading.remove wire:target='deleteImage'
                                                class="bg-red-600 hover:bg-red-500 mx-3">Eliminar</x-button>

                                        </x-slot>

                                    </x-modal>
                                </div>
                            @else
                                <div wire:key='{{ $image->path() }}' data-id="{{ $image->path() }}"
                                    class="sortable-item cursor-move text-center rounded-md m-2">

                                    <div x-data="{ showDelete: false }" @mouseenter="showDelete = true"
                                        @mouseleave="showDelete = false" class="relative mb-2">

                                        <x-badge color="blue"
                                            class="absolute -top-2 -left-2 !rounded-full">
                                            {{ $loop->index + 1 }}
                                        </x-badge>

                                        <img src="{{ $image->temporaryUrl() }}"
                                            alt="preview-product-image"
                                            class="w-24 h-20 border rounded-lg shadow object-cover">

                                        <x-icon x-show="showDelete" code="delete"
                                            wire:click='deleteImage({{ $key }})'
                                            x-tooltip.raw.placement.bottom="Eliminar"
                                            style="font-size: 20px"
                                            class="cursor-pointer 
                                            absolute -bottom-2 -right-2 p-1 bg-gray-50 
                                            hover:bg-white text-red-500 shadow rounded-full" />
                                    </div>

                                    <p class="text-xs text-gray-700">
                                        {{ formatBytes($image->getSize()) }}
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>

            </div>
        </div>
    </div>
</section>


{{-- Sortable product images preview --}}
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    new Sortable(previewImages, {
        handle: '.sortable-item',
        animation: 250,
        ghostClass: 'bg-gray-100',
        store: {
            set: (sortable) => Livewire.dispatch('change-images-order', {
                newOrder: sortable.toArray()
            })
        }
    });
</script>