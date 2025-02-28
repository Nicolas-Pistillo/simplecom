<div>
    <div x-data="{menuOpen: false}">
        <!-- Notifications Button -->
        <button @click="menuOpen = !menuOpen" type="button"
        x-tooltip.raw="Notificaciones"
        class="relative pt-2 pr-2 text-gray-400 transition hover:text-gray-500">

            <x-icon code="notifications" />

            @if (Auth::user()->unreadNotifications->isNotEmpty())
                <span class="animate__animated animate__heartBeat animate__repeat-3 
                absolute top-1.5 right-2 block h-2 w-2 rounded-full bg-green-400 
                ring-2 ring-white"></span>
            @endif
        </button>

        <!-- Notifications Dropdown -->
        <div x-cloak x-show="menuOpen" @click.away="menuOpen = false"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95" 
        class="absolute top-16 right-0 sm:right-8 mx-auto w-full sm:w-[400px]">
            <div class="z-20 w-full bg-white divide-y divide-gray-100 
            rounded-none sm:rounded-lg shadow-lg">
                <div class="block px-4 py-2 font-semibold text-center text-white 
                rounded-t-none sm:rounded-t-lg bg-blue-600">
                    Notificaciones
                </div>
                <div class="divide-y divide-gray-100 max-h-[350px] overflow-y-auto">

                    @forelse (Auth::user()->notifications as $notification)

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
                                        'name'       => data_get($notification->data, 'initials_name'),
                                        'background' => '#2563eb',
                                        'color'      => '#fff',
                                        'bold'       => false,
                                    ]) }}" class="relative h-11 w-11 flex-none rounded-full 
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
                                    <span>{{ $notification->created_at->format('d/m/Y H:i') }}</span>
                                    <span wire:click="deleteNotification('{{ $notification->id }}')"
                                    onclick="event.preventDefault()" class="text-red-600 hover:underline">
                                        Eliminar
                                    </span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="text-center pt-8 pb-4">

                            <img src="{{ URL::to('img/illustrations/mail_open.svg') }}" 
                            class="h-24 mx-auto mb-4 animate__animated animate__bounceIn" alt="no-data-img">
            
                            <div class="mb-4">
                                <h3 class="mt-2 text-sm font-semibold text-gray-900">Sin notificaciones</h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Aqui veras todas tus notificaciones
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>

                @if (Auth::user()->notifications->isNotEmpty())
                    <a href="#" class="block py-2 text-sm font-medium text-center 
                    text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100">
                        <div class="inline-flex items-center gap-1">
                            <x-icon code="visibility" class="text-[18px]" />
                            Ver todas
                        </div>
                    </a> 
                @endif
               
            </div>
        </div>
    </div>
</div>
