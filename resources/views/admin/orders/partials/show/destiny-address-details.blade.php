<x-drawer ref="showDestinyAddressDetails">
    <div class="space-y-6 pb-16">
        <div>
            @php
                $branch = $order->shipping->selected_branch;
            @endphp

            <h4 class="text-base font-semibold text-gray-900">Domicilio Destino</h4>

            <gmp-map wire:ignore 
            center="{{ $order->shipping->userAddress->lat }},{{ $order->shipping->userAddress->lng }}" 
            zoom="15" map-id="shipping_branch_map" 
            class="mt-4 h-[130px] md:h-[250px] rounded-lg shadow-md overflow-hidden">
                <gmp-advanced-marker position="{{ $order->shipping->userAddress->lat }}, {{ $order->shipping->userAddress->lng }}"></gmp-advanced-marker>
            </gmp-map>
        </div>
        <div>
            <h3 class="font-semibold text-gray-900">Información</h3>
            <dl class="mt-2 divide-y divide-gray-200 border-t border-b border-gray-200">
                <div class="flex justify-between py-3 text-sm font-medium">
                    <dt class="text-gray-500">Calle</dt>
                    <dd class="text-gray-900 max-w-[180px]">
                        {{ $order->shipping->userAddress->street }}
                    </dd>
                </div>
                <div class="flex justify-between py-3 text-sm font-medium">
                    <dt class="text-gray-500">Altura</dt>
                    <dd class="text-gray-900 max-w-[180px]">
                        {{ $order->shipping->userAddress->number }}
                    </dd>
                </div>
                <div class="flex justify-between py-3 text-sm font-medium">
                    <dt class="text-gray-500">Código Postal</dt>
                    <dd class="text-gray-900 max-w-[180px]">
                        {{ $order->shipping->userAddress->zipcode }}
                    </dd>
                </div>
                <div class="flex justify-between py-3 text-sm font-medium">
                    <dt class="text-gray-500">Localidad</dt>
                    <dd class="text-gray-900 max-w-[180px]">
                        {{ $order->shipping->userAddress->locality }}
                    </dd>
                </div>
                <div class="flex justify-between py-3 text-sm font-medium">
                    <dt class="text-gray-500">Provincia</dt>
                    <dd class="text-gray-900 max-w-[180px]">
                        {{ $order->shipping->userAddress->state }}
                    </dd>
                </div>
                @if (!empty($order->shipping->userAddress->floor))
                    <div class="flex justify-between py-3 text-sm font-medium">
                        <dt class="text-gray-500">Piso</dt>
                        <dd class="text-gray-900 max-w-[180px]">
                            {{ $order->shipping->userAddress->floor }}
                        </dd>
                    </div>
                @endif
                @if (!empty($order->shipping->userAddress->apartment))
                    <div class="flex justify-between py-3 text-sm font-medium">
                        <dt class="text-gray-500">Departamento</dt>
                        <dd class="text-gray-900 max-w-[180px]">
                            {{ $order->shipping->userAddress->apartment }}
                        </dd>
                    </div>
                @endif
                @if (!empty($order->shipping->userAddress->office))
                    <div class="flex justify-between py-3 text-sm font-medium">
                        <dt class="text-gray-500">Oficina</dt>
                        <dd class="text-gray-900 max-w-[180px]">
                            {{ $order->shipping->userAddress->office }}
                        </dd>
                    </div>
                @endif
                @if (!empty($order->shipping->userAddress->details))
                    <div class="flex justify-between py-3 text-sm font-medium">
                        <dt class="text-gray-500">Observaciones</dt>
                        <dd class="text-gray-900 max-w-[180px]">
                            {{ $order->shipping->userAddress->details }}
                        </dd>
                    </div>
                @endif
            </dl>
        </div>
    </div>
</x-drawer>