<x-modal ref="deleteDialogOpen" type="danger" icon="warning">

    <x-slot name="title">
        Eliminar operador <span class="text-blue-600">{{ $this->operator?->name }}</span>         
    </x-slot>

    <x-slot name="body">
        ¿Estás seguro que deseas eliminar este operador?   
    </x-slot>

    <x-slot name="actions">

        <x-spinner wire:loading wire:target='deleteOperator' />

        <x-button type="secondary" wire:loading.remove wire:target='deleteOperator' 
        @click="deleteDialogOpen = false">Cancelar</x-button>

        <x-button wire:click='deleteOperator' wire:loading.remove wire:target='deleteOperator' 
        class="bg-red-600 hover:bg-red-500">Eliminar</x-button>
        
    </x-slot>

</x-modal>