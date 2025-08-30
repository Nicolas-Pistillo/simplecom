<x-modal ref="deleteDialogOpen" type="danger" icon="warning">

    <x-slot name="title">
        Eliminar categoría <span class="text-blue-600">{{ $this->category?->name }}</span>         
    </x-slot>

    <x-slot name="body">
        ¿Estás seguro que deseas eliminar esta categoría? se eliminaran todas las subcategorías que esta posea.   
    </x-slot>

    <x-slot name="actions">

        <x-spinner wire:loading wire:target='delete' />

        <x-button type="secondary" wire:loading.remove wire:target='delete' 
        @click="deleteDialogOpen = false">Cancelar</x-button>

        <x-button wire:click='delete' wire:loading.remove wire:target='delete' 
        class="bg-red-600 hover:bg-red-500">Eliminar</x-button>
        
    </x-slot>

</x-modal>