<div x-data="{ showNewInvoice: false }"
x-on:close-order-invoice-form.window="showNewInvoice = false"
class="rounded-lg bg-gray-50 shadow-sm ring-1 ring-gray-900/5 p-4">
    <div>
        @if (!$order->invoice)
            <div class="flex justify-between items-center text-sm/6 
            font-semibold text-gray-900 mb-1.5">

                <span class="mt-1 text-base font-semibold text-gray-900">
                    Factura
                </span>

                <x-badge>No creada</x-badge>
            </div>

            <small class="inline-block pb-2">Todavía no emitiste la factura</small>

            <div class="border-t pt-2">
                <x-button @click="showNewInvoice = true" type="secondary">Emitir factura</x-button>
            </div>
            
            <x-drawer ref="showNewInvoice" withoutClose panelClass="w-[50rem]" containerClasses="!p-0">
                @livewire('admin.orders.new-invoice', compact('order'))
            </x-drawer>
            
        @else
            <div class="flex justify-between items-center text-sm/6 
            font-semibold text-gray-900 mb-1.5">

                <span class="mt-1 text-base font-semibold text-gray-900">
                    Factura
                </span>

                <x-badge :color="$order->invoice->status->color()">
                    {{ $order->invoice->status->name() }}
                </x-badge>
            </div>

            <small class="inline-block pb-2">{{ $order->invoice->status->helper() }}</small>

            <div class="w-full pt-2 border-t ">

                <div class="flex flex-wrap gap-6 mb-3">
                    <div class="flex flex-col">
                        <dt class="text-xs text-gray-500">
                            Tipo
                        </dt>
                        <dd class="text-sm font-medium text-gray-700">
                            {{ $order->invoice->type->name() }}
                        </dd>
                    </div>

                    <div class="flex flex-col">
                        <dt class="text-xs text-gray-500">
                            Punto de venta
                        </dt>
                        <dd class="text-sm font-medium text-gray-700">
                            {{ $order->invoice->sell_point }}
                        </dd>
                    </div>
                </div>

                <div class="flex flex-wrap gap-6 mb-3">
                    <div class="flex flex-col">
                        <dt class="text-xs text-gray-500">
                            Nro de comprobante
                        </dt>
                        <dd class="text-sm font-medium text-gray-700">
                            {{ $order->invoice->receipt_number }}
                        </dd>
                    </div>

                    <div class="flex flex-col">
                        <dt class="text-xs text-gray-500">
                            Nro interno
                        </dt>
                        <dd class="text-sm font-medium text-gray-700">
                            {{ $order->invoice->number }}
                        </dd>
                    </div>
                </div>

                {{-- <div class="mb-3">
                    <dt class="text-xs text-gray-500">
                        Fecha de creación
                    </dt>
                    <dd class="text-sm/6 font-medium text-gray-700">
                        12/02/2025 16:30
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
                </div>  --}}

            </div>

            @if (!empty($order->invoice->pdf_url))
                <div class="mt-3 pt-3 border-t border-gray-900/5">
                    <x-button wire:click='downloadOrderInvoice' type="secondary">Descargar</x-button>
                </div>
            @endif
        @endif
    </div>
</div>
