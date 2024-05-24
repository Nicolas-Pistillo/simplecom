<x-modal ref="confirmDeleteAttribute" type="danger" icon="warning">

    <x-slot name="title">
        Eliminar el atributo <span
            class="text-blue-600">{{ $attribute->name }}</span>
    </x-slot>

    <x-slot name="body">
        ¿Estás seguro de que deseas eliminar este atributo?, se eliminaran
        todos sus valores y se removerá de cada variante que esté asociado.
    </x-slot>

    <x-slot name="actions">

        <x-spinner wire:loading wire:target='deleteAttribute' />

        <x-button type="secondary" wire:loading.remove
        wire:target='deleteAttribute'
        @click="confirmDeleteAttribute = false">Cancelar</x-button>

        <x-button wire:click='deleteAttribute({{ $attribute->id }})'
        wire:loading.remove wire:target='deleteAttribute'
        class="bg-red-600 hover:bg-red-500 mx-3">Eliminar</x-button>

    </x-slot>

</x-modal>