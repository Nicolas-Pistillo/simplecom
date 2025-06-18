<div>
    <div x-data="{ panelOpen: false }"
        class="hidden sm:block relative pt-2 text-gray-400 cursor-pointer transition hover:text-gray-500">

        <x-icon x-tooltip.raw.placement.bottom="Punto de orígen" @click="panelOpen = !panelOpen" code="warehouse" />

        <div x-cloak x-show="panelOpen" @click.away="panelOpen = false"
            x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95"
            class="absolute top-[3.2rem] mx-auto sm:-right-48 w-full sm:w-[400px]">
            <div class="z-20 w-full bg-white divide-y divide-gray-100 
            rounded-none sm:rounded-lg shadow-lg">
                <div class="block px-4 py-2 font-semibold text-center text-white 
                rounded-t-none sm:rounded-t-lg bg-blue-600">
                    Punto de orígen
                </div>
                <div wire:poll class="divide-y divide-gray-100 max-h-[350px] overflow-y-auto">

                    @forelse ($originPoints as $originPoint)
                        <div wire:key='{{ $originPoint->id }}' 
                        class="flex justify-between py-4 px-2 gap-2 cursor-default">
                            <div class="flex gap-2">
                                <x-icon code="location_on" class="text-blue-600" />
                                <span class="text-gray-700 text-sm 
                                {{ $originPoint->in_use ? 'font-semibold' : '' }}">

                                    <a href="{{ $originPoint->map_url }}" target="_blank"
                                    class="hover:underline hover:text-blue-600 transition">
                                        {{ $originPoint->name }} 
                                    </a>

                                    @if ($originPoint->in_use)
                                        <br> <small class="text-gray-500">
                                            Tus proveedores recolectarán tus pedidos aquí
                                        </small>
                                    @endif
                                </span>
                            </div>
                            <div class="whitespace-nowrap">
                                @if ($originPoint->in_use)
                                    <x-badge color="blue">En uso</x-badge>
                                @else
                                    <x-button wire:click='setActive({{ $originPoint->id }})' 
                                    size="small" type="secondary">Usar</x-button>
                                @endif
                            </div>
                        </div>

                        @if ($loop->last)
                            <div class="py-2 px-2">
                                <x-button :href="route('admin.delivery-methods.index', ['tab' => 'Proveedores','providers-tab' => 'Puntos de origen'])" 
                                type="secondary" size="small" class="inline-flex items-center gap-1">
                                    Ir a puntos de orígen
                                    <x-icon code="arrow_forward" />
                                </x-button>
                            </div>
                        @endif
                    @empty
                        <div class="text-center pt-8 pb-4 px-2 cursor-default">

                            <img src="{{ URL::to('img/illustrations/logistics.svg') }}"
                            class="h-24 mx-auto mb-4 animate__animated animate__bounceIn" alt="no-data-img">

                            <div class="mb-4">
                                <h3 class="mt-2 mb-4 text-sm font-semibold text-gray-900">
                                    Todavía no cargaste un punto de orígen para tus envíos
                                </h3>
                                <x-button :href="route('admin.delivery-methods.index', ['tab' => 'Proveedores','providers-tab' => 'Puntos de origen'])" 
                                type="soft" class="inline-flex items-center gap-1">
                                    Ir a puntos de orígen
                                    <x-icon code="arrow_forward" />
                                </x-button>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
