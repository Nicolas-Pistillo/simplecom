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
                <div class="divide-y divide-gray-100 max-h-[350px] overflow-y-auto">

                    @forelse ($originPoints as $originPoint)
                        <a wire:key='{{ $notification->id }}' href="{{ data_get($notification->data, 'url', '#') }}"
                            {{ !data_get($notification->data, 'url') ? 'onclick=event.preventDefault()' : '' }}
                            class="flex px-4 py-3 hover:bg-gray-100">
                            <div class="flex-shrink-0">

                                @if (data_get($notification->data, 'presentation') === NotificationPresentation::Icon->value)
                                    <x-icon code="{{ data_get($notification->data, 'icon_code', 'info') }}"
                                        class="text-{{ data_get($notification->data, 'icon_color', 'blue') }}-600" />
                                @endif

                                @if (data_get($notification->data, 'presentation') === NotificationPresentation::InitialsImage->value)
                                    <img src="{{ initialsAvatar([
                                        'name' => data_get($notification->data, 'initials_name'),
                                        'background' => '#2563eb',
                                        'color' => '#fff',
                                        'bold' => false,
                                    ]) }}"
                                        class="relative h-11 w-11 flex-none rounded-full 
                                                                bg-gray-50 -left-[3.5px] self-start">
                                @endif

                                @if (data_get($notification->data, 'presentation') === NotificationPresentation::Image->value)
                                    <img src="{{ data_get($notification->data, 'img_src', URL::to('img/no-image.png')) }}"
                                        class="rounded-full w-11 h-11">
                                @endif
                            </div>
                            <div class="w-full ps-3">
                                <p class="text-gray-700 text-sm mb-1.5">
                                    {{ data_get($notification->data, 'body') }}
                                </p>
                                <div class="mt-3 text-xs text-gray-600 flex justify-between items-center">
                                    <span>{{ getElapsedTime($notification->created_at, true) }}</span>
                                    <span wire:click="deleteNotification('{{ $notification->id }}')"
                                        onclick="event.preventDefault()" class="text-red-600 hover:underline">
                                        Eliminar
                                    </span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="text-center pt-8 pb-4 px-2 cursor-default">

                            <img src="{{ URL::to('img/illustrations/logistics.svg') }}"
                            class="h-24 mx-auto mb-4 animate__animated animate__bounceIn" alt="no-data-img">

                            <div class="mb-4">
                                <h3 class="mt-2 mb-4 text-sm font-semibold text-gray-900">
                                    Todavía no cargaste un punto de orígen para tus envíos
                                </h3>
                                <x-button :href="route('admin.delivery-methods.index', ['tab' => 'Proveedores','providers-tab' => 'Puntos de origen'])" 
                                type="soft" class="inline-flex items-center gap-2">
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
