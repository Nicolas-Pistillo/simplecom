<div>
    @if ($orders->isEmpty())
        <div class="text-center h-[80vh] flex flex-col justify-center">

            <img src="{{ URL::to('img/illustrations/web_shopping.svg') }}" class="h-64 mx-auto mb-4" alt="no-data-img">

            <div class="mb-4">
                <h3 class="mt-2 text-sm font-semibold text-gray-900">Aún no recibiste pedidos</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Verás todos tus pedidos en esta sección una vez que comiencen a llegar
                </p>
            </div>
        </div>
    @else
        <section class="pb-3">
            <div class="mx-auto max-w-screen-2xl">
                <div class="relative shadow-md rounded-lg">

                    <div
                        class="flex items-end justify-between flex-wrap gap-4 px-4 py-3 
                        bg-white rounded-t-lg border border-gray-100">

                        <div class="relative w-full order-2 sm:order-1 sm:w-72">

                            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <x-icon code="search" class="text-gray-500" />
                            </div>

                            <input type="search"
                            class="block w-full pt-2 ps-10 text-sm text-gray-900 
                            border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 
                            focus:border-blue-500"
                            placeholder="Buscar pedido...">
                        </div>

                        <div class="flex items-center order-1 sm:order-2 gap-3">

                            <div x-data="{open: false}" class="relative">

                                <x-icon code="tune" x-tooltip.raw.placement.top="Filtrar"
                                @click="open = !open"
                                class="transition colors cursor-pointer bg-gray-100 text-gray-500 
                                p-1.5 rounded-full hover:bg-gray-200 no-select focus:outline-none 
                                focus:ring duration-300" />

                                <div x-show="open" x-cloak
                                    @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="transform opacity-0 scale-90"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-100"
                                    x-transition:leave-start="transform opacity-100 scale-200"
                                    x-transition:leave-end="transform opacity-0 scale-90"
                                    class="absolute top-12 right-0 w-[30.25rem] rounded-md bg-white 
                                    p-4 ring-1 shadow-xl shadow-black/5 ring-slate-700/10">
                                    <h6 class="font-semibold text-sm text-slate-900">Filtros</h6>
                                    {{-- <p class="mt-2 text-[0.8125rem]/5 text-slate-500">
                                        Manage how information is
                                        displayed on your account.
                                    </p> --}}
                                    <div class="mt-4 text-[0.8125rem]/6 text-slate-900">
                                        <div class="flex items-center border-t border-slate-400/20 py-3">
                                            <span class="w-2/5 flex-none">Language</span><span
                                                class="">English</span>
                                            <span
                                                class="pointer-events-auto ml-auto font-medium text-indigo-600 
                                                hover:text-indigo-500">Update</span>
                                        </div>
                                        <div class="flex items-center border-t border-slate-400/20 py-3">
                                            <span class="w-2/5 flex-none">Date format</span>
                                            <span class="">DD-MM-YYYY</span>
                                            <span class="ml-auto flex items-center font-medium text-indigo-600">
                                                <span class="pointer-events-auto hover:text-indigo-500">Update</span>
                                                <span class="mx-3 h-6 w-px bg-slate-400/20"></span>
                                                <span class="pointer-events-auto hover:text-indigo-500">Remove</span>
                                            </span>
                                        </div>
                                        <div class="flex items-center border-t border-slate-400/20 py-3">
                                            <span>Automatic timezone</span>
                                            <span class="ml-auto flex items-center">
                                                <x-switch />
                                            </span>
                                        </div>
                                        <div class="flex items-center border-t border-slate-400/20 pt-3">
                                            <span>Auto-update applicant data</span>
                                            <span class="ml-auto flex items-center">
                                                <x-switch />
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div x-data="{open: false}" class="relative">

                                <x-icon code="download" x-tooltip.raw.placement.top="Descargar"
                                @click="open = !open"
                                class="transition colors 
                                cursor-pointer bg-gray-100 text-gray-500 p-1.5 rounded-full 
                                hover:bg-gray-200 no-select focus:outline-none focus:ring duration-300" />

                                <div x-show="open" x-cloak
                                    @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="transform opacity-0 scale-90"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-100"
                                    x-transition:leave-start="transform opacity-100 scale-200"
                                    x-transition:leave-end="transform opacity-0 scale-90"
                                    class="absolute top-12 right-0 w-max bg-white 
                                    ring-1 shadow-xl shadow-black/5 ring-slate-700/10 
                                    rounded-md overflow-hidden">

                                    <div class="text-[0.8125rem]/6 text-slate-900">

                                        <ul class="flex flex-col border-slate-400/20 rounded-md">

                                            <li class="flex justify-between items-center px-3 py-1 text-sm leading-6 text-gray-900 
                                            transition hover:bg-gray-50 cursor-pointer">
                                                Descargar en PDF
                                                <x-icon code="description" class="text-red-700" />
                                            </li>

                                            <li class="flex justify-between gap-x-2 items-center px-3 py-1 text-sm leading-6 text-gray-900 
                                            transition hover:bg-gray-50 cursor-pointer">
                                                Descargar en Excel
                                                <x-icon code="description" class="text-green-700" />
                                            </li>

                                            <li class="flex justify-between items-center px-3 py-1 text-sm leading-6 text-gray-900 
                                            transition hover:bg-gray-50 cursor-pointer">
                                                Descargar en CSV
                                                <x-icon code="description" class="text-blue-700" />
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="flex flex-wrap gap-3 px-4 py-3">

                        <h5 class="mr-4 font-semibold text-gray-800 text-sm">Entrega</h5>

                        <div class="flex items-center me-4">
                            <input id="inline-radio" type="radio" value="" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-radio" class="ms-2 text-sm font-medium text-gray-900">Retíro en local</label>
                        </div>

                        <div class="flex items-center me-4">
                            <input id="inline-2-radio" type="radio" value="" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-2-radio" class="ms-2 text-sm font-medium text-gray-900">Envío</label>
                        </div>

                        <div class="flex items-center me-4">
                            <input checked id="inline-checked-radio" type="radio" value="" name="inline-radio-group" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="inline-checked-radio" class="ms-2 text-sm font-medium text-gray-900">Ambas</label>
                        </div>
                    </div> --}}

                    {{-- Last 5 orders
                        <div class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex items-center justify-between mb-4">
                                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Pedidos Recientes</h5>
                                <a href="#" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                                    Ver todos
                                </a>
                            </div>
                            <div class="flow-root">
                                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center">
                                            <div class="shrink-0">
                                                <img class="w-8 h-8 rounded-full" src="https://picsum.photos/200/300"
                                                    alt="Neil image">
                                            </div>
                                            <div class="flex-1 min-w-0 ms-4">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    Neil Sims
                                                </p>
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                    email@windster.com
                                                </p>
                                            </div>
                                            <div
                                                class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                $320
                                            </div>
                                        </div>
                                    </li>
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center ">
                                            <div class="shrink-0">
                                                <img class="w-8 h-8 rounded-full" src="https://picsum.photos/200/300"
                                                    alt="Bonnie image">
                                            </div>
                                            <div class="flex-1 min-w-0 ms-4">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    Bonnie Green
                                                </p>
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                    email@windster.com
                                                </p>
                                            </div>
                                            <div
                                                class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                $3467
                                            </div>
                                        </div>
                                    </li>
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center">
                                            <div class="shrink-0">
                                                <img class="w-8 h-8 rounded-full" src="https://picsum.photos/200/300"
                                                    alt="Michael image">
                                            </div>
                                            <div class="flex-1 min-w-0 ms-4">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    Michael Gough
                                                </p>
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                    email@windster.com
                                                </p>
                                            </div>
                                            <div
                                                class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                $67
                                            </div>
                                        </div>
                                    </li>
                                    <li class="py-3 sm:py-4">
                                        <div class="flex items-center ">
                                            <div class="shrink-0">
                                                <img class="w-8 h-8 rounded-full" src="https://picsum.photos/200/300"
                                                    alt="Lana image">
                                            </div>
                                            <div class="flex-1 min-w-0 ms-4">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    Lana Byrd
                                                </p>
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                    email@windster.com
                                                </p>
                                            </div>
                                            <div
                                                class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                $367
                                            </div>
                                        </div>
                                    </li>
                                    <li class="pt-3 pb-0 sm:pt-4">
                                        <div class="flex items-center ">
                                            <div class="shrink-0">
                                                <img class="w-8 h-8 rounded-full" src="https://picsum.photos/200/300"
                                                    alt="Thomas image">
                                            </div>
                                            <div class="flex-1 min-w-0 ms-4">
                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                    Thomes Lean
                                                </p>
                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                    email@windster.com
                                                </p>
                                            </div>
                                            <div
                                                class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                $2367
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>  
                    --}}

                    <div class="overflow-x-auto no-select" scrollbar-thin>
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr class="text-center whitespace-nowrap">
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-all" type="checkbox"
                                                class="w-4 h-4 bg-gray-100 border-gray-300 rounded focus:ring-2">
                                            <label for="checkbox-all" class="sr-only">checkbox</label>
                                        </div>
                                    </th>
                                    <th scope="col" class="px-4 py-3">ID</th>
                                    <th scope="col" class="px-4 py-3">Código</th>
                                    <th scope="col" class="px-4 py-3">Estado</th>
                                    <th scope="col" class="px-4 py-3">Cliente</th>
                                    <th scope="col" class="px-4 py-3">Entrega</th>
                                    <th scope="col" class="px-4 py-3">Total</th>
                                    <th scope="col" class="px-4 py-3">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr wire:key='{{ $order->id }}'
                                    class="border-b text-center transition cursor-pointer 
                                    duration-200 hover:bg-gray-50 text-xs"
                                    @click="location.href='{{ $order->detailPage() }}'">

                                        <td class="w-4 px-4 py-3" onclick="event.stopPropagation()">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox"
                                                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded focus:ring-2">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>

                                        <td class="font-semibold text-gray-900">
                                            {{ $order->id }}
                                        </td>

                                        <td class="font-semibold text-gray-900">
                                            {{ $order->code }}
                                        </td>

                                        <td class="px-4 py-2 whitespace-nowrap">
                                            <x-badge :color="$order->status->display_color"
                                                x-tooltip.raw.placement.top="{{ $order->status->helper }}">
                                                {{ $order->status->name }}
                                            </x-badge>
                                        </td>

                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $order->user->full_name }}
                                        </td>

                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                            @if ($order->delivery_type === DeliveryType::Shipping)
                                                @if (!$order->shipping)
                                                    <x-badge color="yellow">Envío sin calcular</x-badge>
                                                @else
                                                    @if (
                                                        $order->shipping->logistic_type === LogisticType::OriginToDoor ||
                                                            $order->shipping->logistic_type === LogisticType::DropoffToDoor)
                                                        Envío a domicilio
                                                    @else
                                                        Envío a sucursal
                                                    @endif
                                                @endif
                                            @endif

                                            @if ($order->delivery_type === DeliveryType::Picking)
                                                Retíro en local
                                            @endif
                                        </td>

                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                            <div class="flex items-center justify-center gap-x-2">

                                                ${{ priceFormat($order->total) }}

                                                <img src="{{ Storage::url("providers/{$order->paymentMethod->code}.png") }}"
                                                    x-tooltip.raw.placement.top="{{ $order->paymentMethod->display_name }}"
                                                    class="h-8 w-8 object-cover rounded-full"
                                                    alt="{{ $order->paymentMethod->display_name }}">
                                            </div>
                                        </td>

                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">
                                            {{ $order->created_at->format('d/m/Y H:i') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if ($orders->total() > 10)
                        <nav class="p-4 space-y-3 md:flex-row md:items-center md:space-y-0"
                            aria-label="Table navigation">
                            {{ $orders->onEachSide(0)->links() }}
                        </nav>
                    @endif
                </div>
            </div>
        </section>
    @endif
</div>
