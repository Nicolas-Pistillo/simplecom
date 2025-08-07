<div>
    <div x-data="{ drawerOpen: false }" class="px-4 sm:px-6 lg:px-8" 
        x-on:open-drawer.window="drawerOpen = true"
        x-on:close-drawer.window="drawerOpen = false">

        <nav class="flex mb-4 no-select">
            <ol role="list" class="flex space-x-4 rounded-md bg-white px-6 py-0 sm:py-1 
            shadow text-xs sm:text-sm">
                <li class="flex">
                    <div class="flex items-center">
                        <a href="{{ route('admin.contents.index') }}" 
                        class="font-medium text-gray-500 hover:text-blue-700">
                            Contenidos
                        </a>
                    </div>
                </li>
                <li class="flex">
                    <div class="flex items-center">
                        <svg viewBox="0 0 24 44" fill="currentColor"
                            class="h-full w-4 shrink-0 text-gray-300">
                            <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                        </svg>
                        <span class="ml-4 font-medium">
                            Banners
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Banners</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Los banners son la primer herramienta visual de tu comercio, sirve para mostrar gráficamente
                    promociones, ofertas especiales, productos destacados o cualquier otra información
                    que quieras exponer en el inicio de tu tienda.
                    <span class="inline-flex items-center text-blue-500">
                        <a target="_blank" href="https://recursos.tiendanube.com/banners"
                            class="text-blue-500 hover:underline inline-flex items-center">
                            Ver recursos de apoyo
                        </a>
                        <x-icon code="open_in_new" class="ml-1" style="font-size: 18px" />
                    </span>.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button wire:click='openNewBanner' class="flex items-center">
                    <x-icon code="add" class="mr-1" />
                    Nuevo banner
                </x-button>
            </div>
        </div>

        <div class="text-center pt-8">

            @if ($banners->isEmpty())
                <img src="{{ URL::to('img/illustrations/asset_selection.svg') }}" class="h-52 mx-auto mb-4"
                    alt="no-data-img">

                <div class="mb-4">
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">Sin banners</h3>
                    <p class="mt-1 mb-4 text-sm text-gray-500">
                        Podés empezar a subir tus banners cuando quieras
                    </p>
                </div>
            @else
                <div class="flex items-center justify-center flex-wrap gap-6 mb-8">
                    @foreach ($banners as $banner)
                        <div wire:key='{{ $banner->id }}' x-data="{ deleteDialogOpen: false }"
                            class="w-80 rounded-lg overflow-hidden transition 
                        duration-300 shadow hover:shadow-lg">

                            <img class="w-full object-cover border-b" src="{{ Storage::url($banner->image_url) }}"
                                alt="{{ $banner->name }}-img">

                            <div class="p-4">
                                <div class="flex items-center justify-between font-bold text">
                                    <span class="text-left">{{ $banner->name }}</span>
                                    <x-switch wireChange='togglePublishedBanner({{ $banner->id }})' :checked="$banner->published"
                                        label="Publicar"></x-switch>
                                </div>

                                @if (!empty($banner->link))
                                    <a href="{{ $banner->link }}" target="_blank"
                                    class="flex max-w-max items-center gap-1 text-sm mt-2 text-gray-700 hover:text-blue-700">
                                        <x-icon code="link" style="font-size: 16px" />
                                        Enlace adjunto
                                    </a>
                                @endif
                            </div>

                            <div class="-mt-px flex divide-x">
                                <div class="flex w-0 rounded-bl-lg flex-1 border-t transition-colors duration-200 hover:bg-gray-50">

                                    <button wire:loading.remove wire:target='openEditBanner({{ $banner->id }})' 
                                    wire:click="openEditBanner({{ $banner->id }})"
                                        class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                        <i class="material-symbols-outlined text-gray-400" style="font-size: 20px;"
                                            code="edit">edit</i>
                                        Editar
                                    </button>

                                    <div wire:loading wire:target='openEditBanner({{ $banner->id }})' 
                                    class="flex-1 py-4">
                                        <x-spinner />
                                    </div>
                                </div>
                                <div
                                    class="-ml-px border-t rounded-br-lg flex w-0 flex-1 transition-colors duration-200 hover:bg-gray-50">
                                    <button @click="deleteDialogOpen = true"
                                        class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                        <i class="material-symbols-outlined text-red-400" style="font-size: 20px;"
                                            code="delete">delete</i>
                                        Eliminar
                                    </button>
                                </div>
                            </div>

                            <x-modal ref="deleteDialogOpen" closeOnClickAway type="danger" icon="warning">

                                <x-slot name="title">
                                    Eliminar banner <span class="text-blue-600">{{ $banner->name }}</span>
                                </x-slot>

                                <x-slot name="body">
                                    ¿Estás seguro que deseas eliminar este banner?
                                </x-slot>

                                <x-slot name="actions">

                                    <x-spinner wire:loading wire:target='deleteBanner' />

                                    <x-button type="secondary" wire:loading.remove wire:target='deleteBanner'
                                        @click="deleteDialogOpen = false">Cancelar</x-button>

                                    <x-button wire:click='deleteBanner({{ $banner->id }})' wire:loading.remove
                                        wire:target='deleteBanner'
                                        class="bg-red-600 hover:bg-red-500">Eliminar</x-button>

                                </x-slot>

                            </x-modal>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        @include('admin.contents.partials.banners-drawer')

    </div>
</div>
