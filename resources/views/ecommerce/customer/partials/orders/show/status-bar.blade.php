@if ($order->delivery_type === DeliveryType::Shipping)
    <nav class="w-full">
        <ol role="list" class="space-y-4 md:flex md:space-x-8 md:space-y-0">
            {{-- <li class="md:flex-1">
                                        <!-- Completed Step -->
                                        <div class="group flex flex-col border-l-4 border-indigo-600 py-2 pl-4 md:border-l-0 md:border-t-4 md:pb-0 md:pl-0 md:pt-4">
                                            <span class="text-sm font-medium text-indigo-600">
                                            Pedido confirmado
                                            </span>
                                            <span class="text-sm font-medium">Se confirma el pago del pedido</span>
                                        </div>
                                    </li> --}}
            <li class="md:flex-1">
                <!-- Current Step -->
                <div class="flex flex-col border-l-4 border-blue-600 py-2 pl-4 md:border-l-0 md:border-t-4 md:pb-0 md:pl-0 md:pt-4"
                    aria-current="step">
                    <span class="text-sm font-medium text-blue-600">En preparación</span>
                </div>
            </li>
            <li class="md:flex-1">
                <!-- Upcoming Step -->
                <div
                    class="group flex flex-col border-l-4 border-gray-200 py-2 pl-4 md:border-l-0 md:border-t-4 md:pb-0 md:pl-0 md:pt-4">
                    <span class="text-sm font-medium text-gray-500">Despachado</span>
                    {{-- <span class="text-sm font-medium">Despachamos tu pedido</span> --}}
                </div>
            </li>
            <li class="md:flex-1">
                <!-- Upcoming Step -->
                <div
                    class="group flex flex-col border-l-4 border-gray-200 py-2 pl-4 md:border-l-0 md:border-t-4 md:pb-0 md:pl-0 md:pt-4">
                    <span class="text-sm font-medium text-gray-500">En camino</span>
                </div>
            </li>
            <li class="md:flex-1">
                <!-- Upcoming Step -->
                <div
                    class="group flex flex-col border-l-4 border-gray-200 py-2 pl-4 md:border-l-0 md:border-t-4 md:pb-0 md:pl-0 md:pt-4">
                    <span class="text-sm font-medium text-gray-500">Entregado</span>
                </div>
            </li>
        </ol>
    </nav>
@endif

@if ($order->delivery_type === DeliveryType::Picking)
    <nav class="w-full">
        <ol role="list" class="space-y-4 md:flex md:space-x-8 md:space-y-0">
            <li class="md:flex-1">
                <!-- Current Step -->
                <div
                    class="flex flex-col border-l-4 border-blue-600 py-2 pl-4 md:border-l-0 
                                        md:border-t-4 md:pb-0 md:pl-0 md:pt-4">
                    <span class="text-sm font-medium text-blue-600">En preparación</span>
                </div>
            </li>
            <li class="md:flex-1">
                <!-- Upcoming Step -->
                <div
                    class="group flex flex-col border-l-4 py-2 pl-4 
                                        md:border-l-0 md:border-t-4 md:pb-0 md:pl-0 md:pt-4
                                        border-gray-200 text-gray-400">
                    <span class="text-sm font-medium">Listo para retirar</span>
                </div>
            </li>
            <li class="md:flex-1">
                <!-- Upcoming Step -->
                <div
                    class="group flex flex-col border-l-4 border-gray-200 py-2 pl-4 md:border-l-0 md:border-t-4 md:pb-0 md:pl-0 md:pt-4">
                    <span class="text-sm font-medium text-gray-400">Entregado</span>
                </div>
            </li>
        </ol>
    </nav>
@endif
