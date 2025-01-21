<div class="ring-1 ring-gray-900/5 shadow-sm rounded-lg py-6 px-4">

    <div class="flex items-center justify-between">
        <h4 class="text-sm/6 font-semibold text-gray-900">Detalle de envío</h4>
        <img src="{{ Storage::URL("providers/{$order->shippingProvider->code}.png") }}"
            class="h-12 w-32 object-cover rounded-md"
            alt="Logo {{ $order->shippingProvider->display_name }}">
    </div>

    <h5 class="mb-3 text-sm text-gray-700">
        {{ $order->shipping->status->helper }}
    </h5>

    {{-- Principal Info --}}
    <div class="flex flex-wrap gap-3">

        <div class="flex flex-col gap-1 p-2">
            <small class="text-xs text-gray-500 font-semibold">
                Estado
            </small>
            <span class="text-sm/6 text-gray-500">
                <x-badge :color="$order->shipping->status->display_color">
                    {{ $order->shipping->status->name }}
                </x-badge>
            </span>
        </div>

        @if (!empty($order->shipping->provider_service))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Servicio
                </small>
                <span class="text-sm/6 text-gray-500">
                    {{ $order->shipping->provider_service }}
                </span>
            </div>   
        @endif

        @if (!empty($order->shipping->logistic_type))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Tipo de logística
                </small>
                <span class="text-sm/6 text-gray-500">
                    {{ $order->shipping->logistic_type->name() }}
                </span>
            </div>   
        @endif

        @if (!empty($order->shipping->selected_branch))
            <div class="flex flex-col p-2">
                <small class="text-xs flex items-center text-gray-500 font-semibold">
                    Sucursal destino
                    <a target="_blank" href="http://maps.google.com/?q={{ data_get($order->shipping, 'selected_branch.address.coordinates.lat') }},{{ data_get($order->shipping, 'selected_branch.address.coordinates.lng') }}">
                        <x-icon code="moved_location"
                        x-tooltip.raw.placement.top="Ver en el mapa"
                        class="ml-1.5 p-1 border rounded-full cursor-pointer 
                        hover:bg-gray-50 hover:text-black" 
                        style="font-size: 16px"
                        />
                    </a>
                </small>
                <span class="text-sm/6 text-gray-500">
                    {{ data_get($order->shipping, 'selected_branch.name') }}
                </span>
            </div>  
        @endif

        @if (!empty($order->shipping->provider_carrier))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Correo encargado
                </small>
                <span class="text-sm text-gray-500">
                    {{ $order->shipping->provider_carrier }}
                </span>
            </div>
        @endif

        @if (!empty($order->shipping->price))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Precio tarifado
                </small>
                <span class="text-sm/6 text-gray-500">
                    ${{ $order->shipping->price }}
                </span>
            </div>   
        @endif

        @if (!empty($order->shipping->delivery_estimate))
            <div class="flex flex-col p-2">
                <small class="text-xs text-gray-500 font-semibold">
                    Tiempo estimado
                </small>
                <span class="text-sm/6 text-gray-500">
                    {{ $order->shipping->delivery_estimate }}
                </span>
            </div>   
        @endif

    </div>

    <div class="mt-4 flex flex-wrap gap-3">
        <x-button>Imprimir etiqueta</x-button>
        <x-button type="secondary">Ver seguimiento</x-button>
    </div>
</div>