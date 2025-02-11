<x-drawer ref="showBranchDetails">
    <div class="space-y-6 pb-16">
        <div>
            @php
                $branch = $order->shipping->selected_branch;
            @endphp

            <h4 class="text-base font-semibold text-gray-900">Sucursal Destino</h4>

            <gmp-map wire:ignore 
            center="{{ data_get($branch, 'address.coordinates.lat') }},{{ data_get($branch, 'address.coordinates.lng') }}" 
            zoom="15" map-id="shipping_branch_map" 
            class="mt-4 h-[130px] md:h-[250px] rounded-lg shadow-md overflow-hidden">
                <gmp-advanced-marker position="{{ data_get($branch, 'address.coordinates.lat') }},{{ data_get($branch, 'address.coordinates.lng') }}"></gmp-advanced-marker>
            </gmp-map>

            <div class="mt-4 flex flex-col">
                <h2 class="text-base font-semibold text-gray-900">
                    {{ data_get($branch, 'name') }}
                </h2>
                <small class="text-gray-600">
                    ID {{ data_get($branch, 'external_id') }}
                </small>
            </div>
        </div>
        <div>
            <h3 class="font-semibold text-gray-900">Información</h3>
            <dl class="mt-2 divide-y divide-gray-200 border-t border-b border-gray-200">
                <div class="flex justify-between py-3 text-sm font-medium">
                    <dt class="text-gray-500">Calle</dt>
                    <dd class="text-gray-900 max-w-[180px]">
                        {{ data_get($branch, 'address.street') }}
                    </dd>
                </div>
                <div class="flex justify-between py-3 text-sm font-medium">
                    <dt class="text-gray-500">Altura</dt>
                    <dd class="text-gray-900 max-w-[180px]">
                        {{ data_get($branch, 'address.number') }}
                    </dd>
                </div>
                <div class="flex justify-between py-3 text-sm font-medium">
                    <dt class="text-gray-500">Código Postal</dt>
                    <dd class="text-gray-900 max-w-[180px]">
                        {{ data_get($branch, 'address.zipcode') }}
                    </dd>
                </div>
                <div class="flex justify-between py-3 text-sm font-medium">
                    <dt class="text-gray-500">Localidad</dt>
                    <dd class="text-gray-900 max-w-[180px]">
                        {{ data_get($branch, 'address.locality') }}
                    </dd>
                </div>
                <div class="flex justify-between py-3 text-sm font-medium">
                    <dt class="text-gray-500">Provincia</dt>
                    <dd class="text-gray-900 max-w-[180px]">
                        {{ data_get($branch, 'address.state') }}
                    </dd>
                </div>
                <div class="flex justify-between py-3 text-sm font-medium">
                    <dt class="text-gray-500">Región</dt>
                    <dd class="text-gray-900 max-w-[180px]">
                        {{ data_get($branch, 'address.region', '-') }}
                    </dd>
                </div>
                <div class="flex justify-between py-3 text-sm font-medium">
                    <dt class="text-gray-500">Teléfono</dt>
                    <dd class="text-gray-900 max-w-[180px]">
                        {{ data_get($branch, 'phone', '-') }}
                    </dd>
                </div>
                <div class="flex justify-between py-3 text-sm font-medium">
                    <dt class="text-gray-500">Horarios</dt>
                    <dd class="text-gray-900 max-w-[180px]">
                        {{ data_get($branch, 'schedule', '-') }}
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</x-drawer>