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

    <x-button @click="$dispatch('open-new-store-pickup-panel')"
    class="flex items-center">
        <x-icon code="add" />
        Agregar punto de retiro
    </x-button>

    <div class="w-full grid grid-cols-1 gap-4 md:grid-cols-2">

        @foreach ($store_pickups as $pickupPoint)

            <div class="relative flex items-center space-x-3 rounded-lg border border-gray-300 
            bg-white px-4 py-5 shadow-sm hover:shadow-lg transition duration-300">

                <a target="_blank" href="{{ $pickupPoint->mapUrl() }}" class="shrink-0"
                x-tooltip.raw.plcement.top="Ver en el mapa">
                    <x-icon code="location_on" class="bg-gray-50 p-2 text-gray-700 border
                    transition-colors duration-300 rounded-full hover:text-blue-600 
                    hover:bg-blue-50 hover:border-blue-600" />
                </a>

                <div class="min-w-0 flex-1">

                    <a href="#" class="focus:outline-none">
                        <p class="truncate text-xs sm:text-sm font-medium text-gray-900">{{ $pickupPoint->name }}</p>
                        <p class="truncate text-xs sm:text-sm text-gray-500">
                            {{ $pickupPoint->summary }}
                        </p>
                    </a>
                </div>
            </div>
        @endforeach

    </div>
@endif
