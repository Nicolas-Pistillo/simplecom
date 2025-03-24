@if ($order->delivery_type === DeliveryType::Shipping)
    <nav class="w-full">
        <ol role="list" class="space-y-4 md:flex md:space-x-8 md:space-y-0">

            <li class="md:flex-1">
                <div class="flex flex-col border-l-4 py-2 pl-4 md:border-l-0 md:border-t-4 md:pb-0 md:pl-0 md:pt-4
                {{ $order->is_confirmed() ? 'border-blue-600 text-blue-600' : 'border-gray-200 text-gray-400' }}">
                    <span class="text-sm font-medium">En preparación</span>
                </div>
            </li>

            <li class="md:flex-1">
                <div class="flex flex-col border-l-4 py-2 pl-4 md:border-l-0 md:border-t-4 md:pb-0 md:pl-0 md:pt-4
                {{ $order->was_dispatched() ? 'border-blue-600 text-blue-600' : 'border-gray-200 text-gray-400' }}">
                    <span class="text-sm font-medium">Despachado</span>
                </div>
            </li>

            <li class="md:flex-1">
                <div class="flex flex-col border-l-4 py-2 pl-4 md:border-l-0 md:border-t-4 md:pb-0 md:pl-0 md:pt-4
                {{ $order->was_instransit() ? 'border-blue-600 text-blue-600' : 'border-gray-200 text-gray-400' }}">
                    <span class="text-sm font-medium">En camino</span>
                </div>
            </li>

            <li class="md:flex-1">
                <div class="flex flex-col border-l-4 py-2 pl-4 md:border-l-0 md:border-t-4 md:pb-0 md:pl-0 md:pt-4
                {{ $order->is_delivered() ? 'border-blue-600 text-blue-600' : 'border-gray-200 text-gray-400' }}">
                    <span class="text-sm font-medium">Entregado</span>
                </div>
            </li>
        </ol>
    </nav>
@endif

@if ($order->delivery_type === DeliveryType::Picking)
    <nav class="w-full">
        <ol role="list" class="space-y-4 md:flex md:space-x-8 md:space-y-0">
            <li class="md:flex-1">
                <div class="flex flex-col border-l-4 py-2 pl-4 md:border-l-0 md:border-t-4 md:pb-0 md:pl-0 md:pt-4
                {{ $order->is_confirmed() ? 'border-blue-600 text-blue-600' : 'border-gray-200 text-gray-400' }}">
                    <span class="text-sm font-medium">En preparación</span>
                </div>
            </li>
            <li class="md:flex-1">
                <div class="flex flex-col border-l-4 py-2 pl-4 md:border-l-0 md:border-t-4 md:pb-0 md:pl-0 md:pt-4
                {{ in_array($order->status, [OrderStatus::PickupReady, OrderStatus::Delivered]) 
                    ? 'border-blue-600 text-blue-600' 
                    : 'border-gray-200 text-gray-400' 
                }}">
                    <span class="text-sm font-medium">Listo para retirar</span>
                </div>
            </li>
            <li class="md:flex-1">
                <div class="flex flex-col border-l-4 py-2 pl-4 md:border-l-0 md:border-t-4 md:pb-0 md:pl-0 md:pt-4
                {{ $order->status === OrderStatus::Delivered ? 'border-blue-600 text-blue-600' : 'border-gray-200 text-gray-400' }}">
                    <span class="text-sm font-medium">Entregado</span>
                </div>
            </li>
        </ol>
    </nav>
@endif
