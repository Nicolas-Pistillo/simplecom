<x-modal ref="deleteDialogOpen" type="danger" icon="warning">

    <x-slot name="title">
        Eliminar categoría <span class="text-blue-600">{{ $this->category?->name }}</span>         
    </x-slot>

    <x-slot name="body">
        ¿Estás seguro que deseas eliminar esta categoría? se eliminaran todas las subcategorías que esta posea.   
    </x-slot>

    <x-slot name="actions">

        <x-spinner wire:loading wire:target='deleteCategory' />

        <x-button type="secondary" wire:loading.remove wire:target='deleteCategory' 
        @click="deleteDialogOpen = false">Cancelar</x-button>

        <x-button wire:click='deleteCategory' wire:loading.remove wire:target='deleteCategory' 
        class="bg-red-600 hover:bg-red-500 mx-3">Eliminar</x-button>
        
    </x-slot>

</x-modal>