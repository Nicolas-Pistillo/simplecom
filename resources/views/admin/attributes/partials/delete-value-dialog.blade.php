<x-modal ref="confirmDeleteValue" type="danger" icon="warning">

    <x-slot name="title">
        Eliminar el valor <span class="text-blue-600">{{ $value->name }}</span>  
        del atributo <span class="text-blue-600">{{ $attribute->name }}</span>
    </x-slot>

    <x-slot name="body">
        ¿Estás seguro de que deseas eliminar este valor de atributo?, se eliminara
        de todas las variantes en las que esté asociado actualmente.
    </x-slot>

    <x-slot name="actions">

        <x-spinner wire:loading wire:target='deleteValue' />

        <x-button type="secondary" 
        wire:loading.remove wire:target='deleteValue'
        @click="confirmDeleteValue = false">Cancelar</x-button>

        <x-button wire:click='deleteValue({{ $attribute->id }} ,{{ $value->id }})'
        wire:loading.remove wire:target='deleteValue'
        class="bg-red-600 hover:bg-red-500 mx-3">Eliminar</x-button>

    </x-slot>

</x-modal>