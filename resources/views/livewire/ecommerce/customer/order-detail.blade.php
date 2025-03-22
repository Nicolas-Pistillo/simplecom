<div>
    <section class="py-10 px-6 sm:px-16 relative bg-gray-100">
        <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
            <div class="w-full flex-col justify-start items-start gap-8 inline-flex">
                <div class="w-full justify-between items-center flex sm:flex-row flex-col gap-3">
                    <div class="w-full flex-col justify-center sm:items-start items-center gap-1 inline-flex">
                        <h2 class="text-gray-900 text-2xl font-semibold font-manrope leading-9">
                            <span class="mr-1.5">Pedido {{ $order->id }}</span>
                            <x-badge :color="$order->status->color()" class="whitespace-nowrap">
                                {{ $order->status->customerName() }}
                            </x-badge>
                        </h2>
                        <span class="text-gray-500 text-base font-medium leading-relaxed">
                            {{ getElapsedTime($order->created_at, true) }}
                        </span>
                    </div>

                    <x-button type="secondary" class="whitespace-nowrap">Volver atrás</x-button>
                </div>
                <h3 class="font-semibold">
                    {{ $order->status->customerHelper() }}
                </h3>
                <div class="w-full justify-end items-start gap-8 inline-flex">
                    <div class="w-full flex-col justify-start items-start gap-8 inline-flex">

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

                        <div class="w-full flex flex-wrap justify-between 
                        mx-auto max-w-2xl lg:mx-0 lg:max-w-none">

                            <div class="w-full lg:w-[65%] mb-6 lg:mb-0 flex flex-col gap-y-6">
                                <!-- Order Items -->
                                <div class="bg-white px-4 py-6 shadow-sm ring-1 ring-gray-900/5 rounded-lg">
                                    @include('admin.orders.partials.show.items')
                                </div>
                            </div>

                            <div class="w-full lg:w-[32%] flex flex-col gap-y-6">

                                <div class="rounded-lg bg-gray-50 shadow-sm ring-1 ring-gray-900/5 p-4">
                                    <div class="pb-3 border-b">
                                        <dt
                                            class="flex justify-between items-center text-sm/6 
                                  font-semibold text-gray-900 mb-1.5">

                                            <span>Cliente</span>

                                            <!--[if BLOCK]><![endif]--> <span
                                                class="inline-flex cursor-default items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset bg-gray-50 text-gray-600 ring-gray-500/10 bg-white">
                                                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                                                Invitado
                                            </span> <!--[if ENDBLOCK]><![endif]-->
                                        </dt>
                                        <dd class="mt-1 text-base font-semibold text-gray-900">
                                            Nicolas Pistillo
                                        </dd>
                                    </div>

                                    <div class="w-full pt-3">
                                        <div class="mb-3">
                                            <dt class="text-xs text-gray-500">
                                                Email
                                            </dt>
                                            <dd class="text-sm/6 font-medium text-gray-700">
                                                pistillonicolas@gmail.com
                                            </dd>
                                        </div>

                                        <div class="flex flex-wrap gap-6">
                                            <div class="flex flex-col">
                                                <dt class="text-xs text-gray-500">
                                                    Teléfono
                                                </dt>
                                                <dd class="text-sm font-medium text-gray-700">
                                                    1162776973
                                                </dd>
                                            </div>

                                            <div class="flex flex-col">
                                                <dt class="text-xs text-gray-500">
                                                    DNI
                                                </dt>
                                                <dd class="text-sm font-medium text-gray-700">
                                                    43150669
                                                </dd>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="rounded-lg bg-gray-50 shadow-sm ring-1 ring-gray-900/5 p-4">
                                    <div class="pb-3 border-b">
                                        <dt
                                            class="flex justify-between items-center text-sm/6 
                                      font-semibold text-gray-900 mb-1.5">

                                            <span>Cliente</span>

                                            <!--[if BLOCK]><![endif]--> <span
                                                class="inline-flex cursor-default items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset bg-gray-50 text-gray-600 ring-gray-500/10 bg-white">
                                                <!--[if BLOCK]><![endif]--><!--[if ENDBLOCK]><![endif]-->
                                                Invitado
                                            </span> <!--[if ENDBLOCK]><![endif]-->
                                        </dt>
                                        <dd class="mt-1 text-base font-semibold text-gray-900">
                                            Nicolas Pistillo
                                        </dd>
                                    </div>

                                    <div class="w-full pt-3">
                                        <div class="mb-3">
                                            <dt class="text-xs text-gray-500">
                                                Email
                                            </dt>
                                            <dd class="text-sm/6 font-medium text-gray-700">
                                                pistillonicolas@gmail.com
                                            </dd>
                                        </div>

                                        <div class="flex flex-wrap gap-6">
                                            <div class="flex flex-col">
                                                <dt class="text-xs text-gray-500">
                                                    Teléfono
                                                </dt>
                                                <dd class="text-sm font-medium text-gray-700">
                                                    1162776973
                                                </dd>
                                            </div>

                                            <div class="flex flex-col">
                                                <dt class="text-xs text-gray-500">
                                                    DNI
                                                </dt>
                                                <dd class="text-sm font-medium text-gray-700">
                                                    43150669
                                                </dd>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                            <h6 class="text-right text-gray-900 text-base font-medium leading-relaxed">Order Note:</h6>
                            <p class="text-gray-500 text-sm font-normal leading-normal">Make sure to ship all the
                                ordered items together by Friday. I've emailed you the details, so please check it an
                                review it. Thank You!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
