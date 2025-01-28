@if ($store_pickups->isEmpty())
    <div class="text-center mx-auto">

        <img src="{{ URL::to('img/illustrations/quiet_street.svg') }}" class="h-48 mx-auto" alt="Sin puntos de retiro">

        <div class="my-4">
            <h3 class="text-sm font-semibold text-gray-900">
                Todavía no añadiste puntos de retiro
            </h3>
            <p class="mt-1 mb-4 text-sm text-gray-500">
                Agrega los puntos de retiro que necesites cuando quieras
            </p>
            <x-button @click="$dispatch('open-new-store-pickup-panel')" type="soft">Agregar punto de retiro</x-button>
        </div>
    </div>
@else
    <x-button @click="$dispatch('open-new-store-pickup-panel')" class="flex items-center">
        <x-icon code="add" />
        Agregar punto de retiro
    </x-button>

    <div class="w-full grid grid-cols-1 gap-4 md:grid-cols-2">

        @foreach ($store_pickups as $pickupPoint)

            <div wire:key='{{ $pickupPoint->id }}' class="w-full p-4 transition duration-300 hover:shadow-md bg-white 
            border border-gray-300 rounded-xl shadow-sm h-max">

                <h5 class="mb-2 text-sm sm:text-lg line-clamp-none md:line-clamp-1 font-semibold tracking-tight text-gray-900">
                    {{ $pickupPoint->name }}
                </h5>

                <p class="mb-1 text-xs sm:text-sm font-normal text-gray-500 flex gap-x-1">
                    <x-icon code="location_on" class="text-gray-500" style="font-size: 20px" />
                    {{ $pickupPoint->address }}
                </p>

                <p class="mb-3 text-xs sm:text-sm font-normal text-gray-500 flex gap-x-1">
                    <x-icon code="schedule" class="text-gray-500" style="font-size: 20px" />
                    {{ $pickupPoint->schedule }}
                </p>

                <div class="flex items-center gap-3">

                    <a href="{{ $pickupPoint->mapUrl() }}" target="_blank">
                        <x-icon code="moved_location" style="font-size: 21px"
                        class="p-1.5 rounded-full border 
                        text-gray-800 cursor-pointer transition duration-300 hover:shadow 
                        hover:border-gray-300 hover:text-blue-600"
                        x-tooltip.raw.placement.bottom="Ver en el mapa" />
                    </a>

                    <x-icon code="edit" style="font-size: 21px"
                    wire:click='editStorePickup({{ $pickupPoint->id }})'
                    class="p-1.5 rounded-full border 
                    text-gray-800 cursor-pointer transition duration-300 hover:shadow 
                    hover:border-gray-300 hover:text-blue-600"
                    x-tooltip.raw.placement.bottom="Editar" />

                    <x-icon code="delete" style="font-size: 21px"
                    class="p-1.5 rounded-full border 
                    text-gray-800 cursor-pointer transition duration-300 hover:shadow 
                    hover:border-gray-300 hover:text-red-500"
                    x-tooltip.raw.placement.bottom="Eliminar" />
                </div>
            </div>

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
            </div> --}}
        @endforeach

    </div>
@endif
