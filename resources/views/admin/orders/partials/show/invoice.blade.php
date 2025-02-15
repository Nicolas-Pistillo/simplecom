<div x-data="{ showConfirmInvoice: false }" class="rounded-lg bg-gray-50 shadow-sm ring-1 ring-gray-900/5 py-6 px-4">
    <div class="pb-3 border-b">

        <div class="flex justify-between items-center text-sm/6 
        font-semibold text-gray-900 mb-1.5">

            <span class="mt-1 text-base font-semibold text-gray-900">
                Factura
            </span>

            @if (!$order->invoice)
                <x-badge>No creada</x-badge>
            @else
            @endif
        </div>

        <small>Todavía no emitiste la factura</small>
    </div>

    {{-- <div class="w-full pt-3">

        <div class="mb-3">
            <dt class="text-xs text-gray-500">
                Nro de comprobante
            </dt>
            <dd class="text-sm/6 font-medium text-gray-700">
                004566985
            </dd>
        </div>

        <div class="mb-3">
            <dt class="text-xs text-gray-500">
                Fecha de creación
            </dt>
            <dd class="text-sm/6 font-medium text-gray-700">
                12/02/2025 16:30
            </dd>
        </div>

        <div class="mb-3">
            <dt class="text-xs text-gray-500">
                Fecha de emisión
            </dt>
            <dd class="text-sm/6 font-medium text-gray-700">
                14/02/2025 08:00
            </dd>
        </div>

        <div class="flex flex-wrap gap-6">
            <div class="flex flex-col">
                <dt class="text-xs text-gray-500">
                    Teléfono
                </dt>
                <dd class="text-sm font-medium text-gray-700">
                    {{ $order->user->phone }}
                </dd>
            </div>

            <div class="flex flex-col">
                <dt class="text-xs text-gray-500">
                    DNI
                </dt>
                <dd class="text-sm font-medium text-gray-700">
                    {{ $order->user->document }}
                </dd>
            </div>
        </div> 

    </div> --}}

    <div class="pt-3">
        <x-button @click="showConfirmInvoice = true" type="secondary">Emitir factura</x-button>
    </div>
    
    @include('admin.orders.partials.show.invoice-form')

</div>
