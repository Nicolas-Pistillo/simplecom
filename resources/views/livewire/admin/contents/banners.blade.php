<div>
    <div x-data="{ drawerOpen: false, showNotification: false }" class="px-4 sm:px-6 lg:px-8"
    x-on:open-drawer.window="drawerOpen = true"
    x-on:close-drawer.window="drawerOpen = false"
    x-on:open-notification.window="showNotification = true">

        {{-- Success notification toast --}}
        <x-toast ref="showNotification" type="success" title="{{ $notificationMessage }}" />

        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Banners</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Los banners son la primer herramienta visual de tu comercio, sirve para mostrar promociones, ofertas especiales,
                    productos destacados o cualquier otra información
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

        <x-tabs tabs="['Mis Banners', 'Vista previa']" current="Mis Banners">

            <div x-show="current == 'Mis Banners'" x-transition:enter.scale.50.origin.top>

                <div class="text-center pt-8">

                    <img src="{{ URL::to('img/illustrations/asset_selection.svg') }}" class="h-52 mx-auto mb-4"
                        alt="no-data-img">

                    <div class="mb-4">
                        <h3 class="mt-2 text-sm font-semibold text-gray-900">Sin banners</h3>
                        <p class="mt-1 mb-4 text-sm text-gray-500">
                            Podés empezar a crear tus banners cuando quieras
                        </p>
                    </div>
                </div>

            </div>

            <div x-show="current == 'Vista previa'" x-transition:enter.scale.50.origin.right>
                <h2>ACA VA MIS VISTAS PREVIAS</h2>
            </div>

        </x-tabs>

        <x-drawer ref="drawerOpen">
            <div class="h-full">
                <form wire:submit='save' class="h-full flex flex-col justify-between">

                    <div class="mb-3">

                        <h3 class="text-lg text-gray-700 font-semibold mb-3">{{ $drawerTitle }}</h3>

                        <hr class="mb-6">

                        <h4 class="text-sm text-gray-500 font-semibold mb-3">Imagen</h4>

                        {{-- Image preview --}}
                        <div class="mb-4">

                            <img src="{{ $imagePreview ?: 'http://via.placeholder.com/1920x800' }}"
                            alt="avatar-category" class="w-full h-28 rounded-lg object-cover shadow">

                            <p class="mt-1.5 text-xs font-medium text-gray-500"
                            wire:loading.remove wire:target='image, deleteImage'>
                                Medidas óptimas: 1920px x 800px
                            </p>
                        </div>

                        {{-- Upload image --}}
                        <div class="w-full mb-6">

                            <div class="flex items-center mb-1">

                                <x-button type="secondary" file onlyImages 
                                class="flex justify-center items-center w-full text-center"
                                wire:loading.remove wire:target='image, deleteImage'
                                wireModel="image" name="image">
                                    Subir imagen
                                    <x-icon code="upload" class="ml-1" />
                                </x-button>

                                @if ($imagePreview)
                                    <x-button wire:click='deleteImage' wire:loading.remove
                                        wire:target='image, deleteImage' size="small"
                                        x-tooltip.raw.placement.bottom="Eliminar"
                                        class="flex items-center ml-1 text-white bg-red-600 hover:bg-red-500">
                                        <span class="material-symbols-outlined">delete</span>
                                    </x-button>
                                @endif

                                <x-spinner class="mx-auto" wire:loading wire:target='image, deleteImage' />
                            </div>

                            @error('image')
                                <small class="text-red-500"> {{ $message }} </small>
                            @enderror
                        </div>

                        {{-- Banner name --}}
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-semibold leading-6 text-gray-500">
                                Nombre del banner <sup class="text-red-500" style="font-size: 10px">*</sup>
                            </label>
                            <div class="mt-2">
                              <input id="name" type="text" wire:model='name' autocomplete="off" class="block w-full 
                              rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                              placeholder:text-gray-400 focus:ring-2 focus:ring-inset transition duration-300 focus:ring-blue-600 
                              sm:text-sm sm:leading-6 placeholder:text-sm" placeholder="Ejemplo: Ofertas de verano 2024...">
                            </div>
                            @error('name')
                                <small class="text-red-500"> {{ $message }} </small>
                            @enderror
                        </div>

                        <div class="mb-6">

                            <fieldset>
                                <div class="space-y-3">

                                    <div class="relative flex items-center">
                                        <div class="flex h-6 items-center">
                                            <input id="published" type="checkbox" wire:model='published'
                                                class="h-4 w-4 rounded border-gray-300 text-blue-600">
                                        </div>
                                        <div class="ml-3 text-sm leading-5 flex items-center">
                                            <label for="published" class="block font-medium text-gray-900">
                                                Marcar como publicado
                                            </label>
                                            <span x-tooltip.raw.placement.bottom="No se mostrara en el slider hasta que lo publiques, sin embargo mantendrá el orden de visualización."
                                            class="material-symbols-outlined ml-2 text-blue-600">help</span>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                    </div>

                    <div class="flex items-center pt-6 pb-3">

                        <x-button submit wire:loading.remove wire:target='save' size="large"
                        class="w-full mr-4">Guardar</x-button>

                        <x-spinner wire:loading wire:target='save' class="w-full" />

                        <x-button @click="drawerOpen = false" wire:loading.remove wire:target='save' size="large"
                            class="w-full" type="secondary">
                            Cancelar
                        </x-button>
                    </div>

                </form>
            </div>
        </x-drawer>

    </div>
</div>
