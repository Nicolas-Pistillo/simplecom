<div class="rounded-lg bg-white shadow-sm ring-1 ring-gray-900/5 p-4">

    <div class="pb-3 border-b">
        <dt class="flex justify-between items-center text-sm/6 
        font-semibold text-gray-900 mb-1.5">
            <span>Retiro en local</span>
        </dt>
        <dd class="mt-1 text-base font-semibold text-gray-900">
            {{ $order->storePickup->name }}
        </dd>
    </div>

    <div class="w-full pt-3">

        <div class="mb-3">
            <dt class="text-xs text-gray-500">
                Dirección
            </dt>
            <dd class="text-sm/6 font-medium text-gray-700
            flex items-center gap-2">
                {{ $order->storePickup->address }}
                <a href="{{ $order->storePickup->map_url }}" target="_blank"
                x-tooltip.raw="Ver en el mapa">
                    <x-icon code="moved_location" class="transition colors 
                    duration-300 cursor-pointer text-gray-600 p-1.5 
                    bg-gray-100 rounded-full hover:bg-gray-200 
                    focus:outline-none focus:ring text-[16px]" />
                </a>
            </dd>
        </div>

        @if ($order->storePickup->schedule)
            <div class="mb-3">
                <dt class="text-xs text-gray-500">
                    Horarios
                </dt>
                <dd class="text-sm/6 font-medium text-gray-700">
                    {{ $order->storePickup->schedule }}
                </dd>
            </div>
        @endif

        @if ($order->storePickup->observations)
            <div class="mb-3">
                <dt class="text-xs text-gray-500">
                    Información
                </dt>
                <dd class="text-sm/6 font-medium text-gray-700">
                    {{ $order->storePickup->observations }}
                </dd>
            </div>
        @endif
    </div>

</div>