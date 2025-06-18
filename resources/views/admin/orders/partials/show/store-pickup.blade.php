<div x-data="{confirmReadyForPickup: false}"
x-on:close-confirm-pickup-ready.window="confirmReadyForPickup = false"
class="ring-1 ring-gray-900/5 shadow-sm rounded-lg py-6 px-4">

    <div class="flex items-center justify-between mb-2">

        <h4 class="text-sm/6 font-semibold text-gray-900">Retiro en tienda</h4>

        <x-icon code="storefront" class="object-cover rounded-md text-3xl text-gray-500"
        alt="Logo {{ $order->paymentMethod->display_name }}" />
    </div>

    <h5 class="mb-3 text-sm text-gray-700">
        El comprador eligió retirar este pedido en <b>{{ $order->storePickup->name }}</b>
    </h5>

    @if ($order->status != OrderStatus::PickupReady)

        <div class="mt-4 flex flex-wrap gap-3">

            @if (!$order->is_confirmed())
                <div x-tooltip.raw="Se requiere confirmación de pago del pedido para avanzar con su entrega.
                Si ya recibiste el pago y el pedido no se actualizó, podes aprobar el pago manualmente.">
                    <x-button disabled>Marcar como listo para retirar</x-button>    
                </div>
            @else
                <x-button @click="confirmReadyForPickup = true">
                    Marcar como listo para retirar
                </x-button>

                <x-modal ref="confirmReadyForPickup" closeOnClickAway type="info" icon="box">

                    <x-slot name="title">
                        Confirmar pedido listo para retirar
                    </x-slot>
                
                    <x-slot name="body">
                        Se notificará a {{ $order->user->full_name }} que su pedido está listo 
                        para retirar en {{ $order->storePickup->name }}.
        
                        {{-- <div class="mt-2">
                            <x-switch label="No volver a preguntar" />
                        </div> --}}
                    </x-slot>
                
                    <x-slot name="actions">
                
                        <x-spinner wire:loading wire:target='setReadyForPickup' />
                
                        <x-button type="secondary" wire:loading.remove wire:target='setReadyForPickup' 
                        @click="confirmReadyForPickup = false">Cancelar</x-button>
                
                        <x-button wire:click='setReadyForPickup' wire:loading.remove 
                        wire:target='setReadyForPickup'>
                            Confirmar
                        </x-button>
                        
                    </x-slot>
                
                </x-modal>
            @endif
        </div>
    @endif
</div>