<div>
    <div class="my-4">
        <dl class="grid sm:grid-cols-2 md:grid-cols-3 gap-5">
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow-md sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Clientes</dt>
                <dd
                    class="mt-1 text-3xl flex items-end gap-x-3 justify-between 
                font-semibold tracking-tight text-gray-900">

                    {{ data_get($totalCustomers, 'total') }}

                    <x-badge color="blue">
                        {{ data_get($totalCustomers, 'totalRegistered') }} registrados
                    </x-badge>
                </dd>
            </div>
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow-md sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Productos</dt>
                <dd
                    class="mt-1 text-3xl flex items-end gap-x-3 justify-between 
                font-semibold tracking-tight text-gray-900">
                    {{ data_get($totalProducts, 'total') }}

                    <x-badge color="blue">
                        {{ data_get($totalProducts, 'totalPublished') }} publicados
                    </x-badge>
                </dd>
            </div>
            <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow-md sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">Facturas Emitidas</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">
                    {{ $totalInvoices }}
                </dd>
            </div>
        </dl>
    </div>
</div>
