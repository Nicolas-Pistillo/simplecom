<div class="ring-1 ring-gray-900/5 shadow-sm rounded-lg py-6 px-4">

    <div class="flex items-center justify-between mb-2">

        <h4 class="text-sm/6 font-semibold text-gray-900">Retiro en tienda</h4>

        <x-icon code="storefront" class="object-cover rounded-md text-3xl text-gray-600"
        alt="Logo {{ $order->paymentMethod->display_name }}" />
    </div>

    <h5 class="mb-3 text-sm text-gray-700">
        El comprador va a retirar este pedido en <b>{{ $order->storePickup->name }}</b>
    </h5>

    <div class="mt-4 flex flex-wrap gap-3">
        <x-button>Marcar como listo para retirar</x-button>
    </div>
</div>