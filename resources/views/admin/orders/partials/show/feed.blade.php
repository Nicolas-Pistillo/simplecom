<div>
    <h2 class="text-sm/6 font-semibold text-gray-900">Historial de pedido</h2>
    <ul role="list" class="mt-6 space-y-6">
        @forelse ($order->feed as $feedItem)
            <li wire:key='{{ $feedItem->id }}'>
                <div class="relative flex items-center
                {{ in_array($feedItem->presentation, [OrderFeedPresentation::Image, OrderFeedPresentation::InitialsImage]) 
                 ? 'gap-x-2'
                 : 'gap-x-4'
                 }}">
                    @if (!$loop->last)
                        <div class="absolute -bottom-6 left-0 top-0 flex w-6 justify-center">
                            <div class="w-px bg-gray-200"></div>
                        </div>
                    @endif

                    @if ($feedItem->presentation === OrderFeedPresentation::Icon)
                        @php
                            $iconColor = data_get($feedItem, 'meta.icon_color', 'blue');
                        @endphp

                        <div class="flex items-center justify-center rounded-full h-6 w-6 flex-none self-start">
                            <x-icon :code="data_get($feedItem, 'meta.icon_code', 'update')"
                                class="relative border rounded-full p-0.5
                            bg-{{ $iconColor }}-100 text-{{ $iconColor }}-600 border-{{ $iconColor }}-600" />
                        </div>
                    @endif

                    @if ($feedItem->presentation === OrderFeedPresentation::Image)
                        <img src="{{ data_get($feedItem, 'meta.img_src') }}"
                        class="relative h-8 w-8 flex-none shadow-md rounded-full -left-[3.5px] self-start">
                    @endif

                    @if ($feedItem->presentation === OrderFeedPResentation::InitialsImage)
                        <img src="{{ initialsAvatar([
                            'name' => $feedItem->initializator,
                            'background' => '#2563eb',
                            'color' => '#fff',
                            'bold' => false,
                        ]) }}" class="relative h-8 w-8 shadow-md flex-none rounded-full bg-gray-50 -left-[3.5px] self-start">
                    @endif

                    @if (!empty($feedItem->comments))
                        <div class="flex-auto">
                            <div class="flex justify-between gap-x-4">
                                <div class="text-xs/5 text-gray-500">

                                    <span class="font-medium text-gray-900">
                                        {{ $feedItem->initializator }}
                                    </span>

                                    <span>
                                        {{ $feedItem->action }}
                                    </span>
                                </div>
                                <time class="flex-none text-xs text-gray-500 ml-auto">
                                    3d ago
                                </time>
                            </div>
                            <p class="text-xs rounded-md mt-1 p-3 ring-1 ring-inset ring-gray-200 text-gray-500">
                                {{ $feedItem->comments }}
                            </p>
                        </div>
                    @else
                        <p class="text-xs/4 text-gray-500">
                            <span class="font-medium text-gray-900">
                                {{ $feedItem->initializator }}
                            </span>

                            <span>
                                {{ $feedItem->action }}
                            </span>
                        </p>
                        <time class="flex-none text-xs text-gray-500 ml-auto">2d</time>
                    @endif
                </div>
            </li>
        @empty
            <li class="text-sm text-gray-500">No hay registros</li>
        @endforelse
    </ul>
</div>