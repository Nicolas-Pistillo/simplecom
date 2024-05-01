<div>
    <div x-data="{ showNotification: false, newBrandPanelOpen: false }" class="px-4 sm:px-6 lg:px-8" x-on:open-notification.window="showNotification = true">

        {{-- Success notification toast --}}
        <x-toast ref="showNotification" type="success" title="{{ $notificationMessage }}" />

        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Marcas</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Podes buscar y agregar las marcas registradas con las que vas a comercializar, luego podrás asignar
                    la correspondiente a cada producto que crees.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button @click="newBrandPanelOpen = true" class="flex items-center">
                    <x-icon code="add" class="mr-1" />
                    Nueva marca
                </x-button>
            </div>
        </div>

        <div class="my-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                    Nombre
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Productos asociados
                                </th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Publicada
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($brands as $brand)
                                <tr wire:key='{{ $brand->id }}' class="hover:bg-gray-50">
                                    <td class="whitespace-nowrap py-4 pl-2 text-sm font-medium text-gray-900">
                                        <div class="flex items-center">
                                            <img src="{{ !empty($brand->image_url) ? $brand->image_url : URL::to('img/no-image-alt.png') }}"
                                                class="w-9 h-9 rounded-full mr-2 shadow" alt="brand-logo">
                                            {{ $brand->name }}
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $brand->products()->count() }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <x-switch :checked="$brand->published"
                                            wireChange="togglePublished({{ $brand->id }}, $el.checked)" />
                                    </td>
                                </tr>
                            @endforeach

                            <!-- More people... -->
                        </tbody>
                    </table>
                </div>
            </div>

            <x-backdrop-panel ref="newBrandPanelOpen">

                <div class="relative flex items-center">

                    <svg class="pointer-events-none absolute left-4 top-3.5 h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z"
                            clip-rule="evenodd" />
                    </svg>

                    <input type="text" wire:model.live.debounce.800ms='brandSearch'
                        class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm"
                        placeholder="Buscar marca por nombre..." role="combobox" aria-expanded="false"
                        aria-controls="options">

                    <x-spinner wire:loading wire:target='brandSearch' class="mr-2" />

                </div>

                @if (!empty($brandSearch))
                    <ul class="max-h-72 scroll-py-2 overflow-y-auto py-2 text-sm text-gray-800">

                        @forelse ($brandSearchResults as $result)
                            <li wire:key='{{ $result['brandId'] }}' wire:click='addBrand({{ json_encode($result) }})'
                            @click="newBrandPanelOpen = false"
                            class="select-none cursor-pointer px-4 py-2 flex items-center transition hover:bg-gray-50">
                                <img src="{{ $result['icon'] }}" class="w-6 h-6 rounded-full mr-2" alt="brand-logo">
                                {{ $result['name'] }}
                            </li>
                        @empty
                            <p class="p-3 text-sm text-center text-gray-500">No se encontraron marcas.</p>
                        @endforelse
                    </ul>
                @endif

            </x-backdrop-panel>

        </div>
    </div>
</div>
