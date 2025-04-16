<div>
    @if ($collections->isEmpty())
        <img src="{{ URL::to('img/illustrations/files.svg') }}" class="h-48 mx-auto mb-4" alt="no-data-img">

        <div class="mb-4">
            <h3 class="mt-2 text-sm font-semibold text-gray-900">Sin colecciones</h3>
            <p class="mt-1 mb-4 text-sm text-gray-500">
                Todavía no creaste colecciones. Podes crearlas cuando quieras
            </p>
        </div>
    @else
        <div class="flex items-center justify-center flex-wrap gap-6 mb-8">
            @foreach ($collections as $collection)
                <div wire:key='{{ $collection->id }}' x-data="{deleteDialogOpen: false}"
                x-on:close-delete-dialog.window="deleteDialogOpen = false"
                    class="w-80 rounded-lg overflow-hidden transition 
                    duration-300 shadow hover:shadow-lg">

                    <img class="w-full object-cover border-b h-36" 
                    src="{{ Storage::url($collection->image_url) }}"
                    alt="{{ $collection->name }}-img">

                    <div class="p-4 text-left">
                        <p class="font-semibold mb-2">{{ $collection->name }}</p>
                        <p class="text-sm mb-6">{{ $collection->description }}</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-sm">
                                <x-icon code="deployed_code" class="mr-1 text-[21px] text-gray-700" />
                                {{ $collection->products()->count() }} productos
                            </div>

                            <x-switch :checked="$collection->active" label="Publicar" />
                        </div>
                    </div>

                    <div class="-mt-px flex divide-x">
                        <div class="flex w-0 rounded-bl-lg flex-1 border-t transition-colors duration-200 hover:bg-gray-50">
                            <button wire:click="openEditBanner({{ $collection->id }})"
                                class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                <i class="material-symbols-outlined text-gray-400" style="font-size: 20px;"
                                    code="edit">edit</i>
                                Editar
                            </button>
                        </div>
                        <div class="-ml-px border-t rounded-br-lg flex w-0 flex-1 transition-colors duration-200 hover:bg-gray-50">
                            <button @click="deleteDialogOpen = true"
                                class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                <i class="material-symbols-outlined text-red-400" style="font-size: 20px;"
                                    code="delete">delete</i>
                                Eliminar
                            </button>
                        </div>
                    </div>

                    <x-modal ref="deleteDialogOpen" closeOnClickAway type="danger" icon="warning">

                        <x-slot name="title">
                            Eliminar coleccion <span class="text-blue-600">{{ $collection->name }}</span>
                        </x-slot>

                        <x-slot name="body">
                            ¿Estás seguro que deseas eliminar esta coleccion?
                        </x-slot>

                        <x-slot name="actions">

                            <x-spinner wire:loading wire:target='delete' />

                            <x-button type="secondary" wire:loading.remove wire:target='delete'
                            @click="deleteDialogOpen = false">Cancelar</x-button>

                            <x-button wire:click='delete({{ $collection->id }})' wire:loading.remove
                            wire:target='delete' class="bg-red-600 hover:bg-red-500">Eliminar</x-button>

                        </x-slot>

                    </x-modal>
                </div>
            @endforeach
        </div>
    @endif
</div>
