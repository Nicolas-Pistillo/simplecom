<div>
    <div class="px-4 sm:px-6 lg:px-8 mb-8">

        @session('method-saved')
            <x-toast type="success" icon="local_shipping" 
            :title="session('method-saved')" position="bottom-right" />
        @endsession

        <div class="sm:flex sm:items-center mb-8">

            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    Envíos personalizados
                </h1>
                <p class="mt-2 text-sm text-gray-700">
                    Desde acá podrás configurar tus propias formas y condiciones de envío
                    ya sea con un servicio de cadetería o logistica que no este integrado
                    con simplecom o si vas a encargarte vos mismo de la entrega de tus pedidos.
                </p>
            </div>

            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button :href="route('admin.delivery-methods.custom-shippings.create')" class="flex items-center">
                    <x-icon code="add" class="mr-1" />
                    Nueva forma de envío
                </x-button>
            </div>
        </div>

        <div class="w-full">

            @if (!$origin_point)
                <x-alert class="mb-3" color="yellow" icon="warning" title="Sin puntos de origen activos">
                    Necesitas crear o asignar un
                    <span @click="current = 'Puntos de origen'" class="text-blue-600 hover:underline cursor-pointer">
                        punto de origen
                    </span>
                    para indicarle al proveedor desde donde cotizar y retirar tus pedidos
                </x-alert>
            @else
                <x-alert class="mb-3" color="blue" icon="where_to_vote">
                    <x-slot name="title">
                        Las cotizaciones y despachos se están realizando
                        desde <b>{{ $origin_point->name }}</b>
                    </x-slot>
                </x-alert>
            @endif
        </div>

        @if ($methods->isEmpty())
            <div class="text-center mx-auto mt-16">

                <img src="{{ URL::to('img/illustrations/delivery_truck.svg') }}" class="h-36 mx-auto"
                    alt="Sin envios propios">

                <div class="my-4">
                    <h3 class="text-sm font-semibold text-gray-900">
                        Todavía no añadiste envíos propios
                    </h3>
                    <p class="mt-1 mb-4 text-sm text-gray-500">
                        Agregá tus propias formas de envío cuando quieras
                    </p>
                </div>
            </div>
        @else
            <ul role="list" class="divide-y divide-gray-100">
                @foreach ($methods as $method)
                    <li x-data="{openConfirmDelete: false}"
                    x-on:close-confirm-delete.window="openConfirmDelete = false" 
                    wire:key='method-{{ $method->id }}' 
                    class="relative flex justify-between gap-x-6 py-5">

                        <div class="flex min-w-0 gap-x-4">
                            @if ($method->logo_url)
                                <img src="{{ Storage::url($method->logo_url) }}" alt="{{ $method->name }}"
                                    class="w-10 h-10 flex-none rounded-full object-cover bg-gray-50" />
                            @else
                                <x-icon code="local_shipping"
                                    class="w-10 h-10 flex items-center justify-center 
                                rounded-full bg-gray-50" />
                            @endif

                            <div class="min-w-0 flex-auto">
                                <p class="text-sm font-semibold text-gray-900">
                                    {{ $method->name }}
                                </p>
                                <div class="mt-1 flex items-center gap-2 text-xs text-gray-500">
                                    <div class="flex items-center">
                                        <x-icon code="location_on" class="text-sm" />
                                        {{ $method->shipping_zone_type->name() }}
                                    </div>
                                    <div class="flex items-center font-semibold">
                                        @if ($method->isFree())
                                            <span class="text-green-600">Gratis</span>
                                        @else
                                            <span class="text-green-600">
                                                ${{ priceFormat($method->price) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <x-modal ref="openConfirmDelete">
                            <x-slot name="title">Eliminar forma de envío</x-slot>
                            <p class="text-sm text-gray-600">
                                ¿Estás seguro que deseas eliminar la forma de envío <b>{{ $method->name }}</b>?
                                Esta acción no se puede deshacer.
                            </p>
                            <x-slot name="actions">
                                <div class="flex justify-end gap-3">

                                    <x-button type="secondary" @click="openConfirmDelete = false"
                                    wire:loading.remove wire:target='delete({{ $method->id }})'>
                                        Cancelar
                                    </x-button>

                                    <x-button wire:click='delete({{ $method->id }})' 
                                    wire:loading.remove wire:target='delete({{ $method->id }})'>
                                        Eliminar
                                    </x-button>

                                    <div wire:loading wire:target='delete({{ $method->id }})'>
                                        <div class="flex items-center gap-1.5 font-semibold">
                                            <x-spinner />
                                            Eliminando...
                                        </div>
                                    </div>
                                </div>
                            </x-slot>

                        </x-modal>

                        <div class="flex shrink-0 items-center gap-x-4">
                            <div class="hidden sm:flex sm:flex-col sm:items-end">
                                <x-switch wireChange="toggleActiveMethod({{ $method->id }})" 
                                :checked="$method->active" tooltipPosition="top"
                                :tooltip="$method->active ? 'Desactivar' : 'Activar'" />
                            </div>
                            <x-dropdown position="right-0" containerClass="w-48">

                                <x-slot name="trigger">
                                    <x-icon code="more_vert" x-tooltip.raw="Acciones" style="font-size: 18px"
                                    class="no-select transition colors cursor-pointer 
                                    bg-gray-100 text-gray-600 p-1.5 rounded-full 
                                    focus:outline-none focus:ring duration-300 border 
                                    border-gray-300 hover:border-gray-400" />
                                </x-slot>

                                <x-dropdown-item closeOnClick icon="edit" wire:click='openEdit({{ $method->id }})'
                                    label="Editar" />

                                <x-dropdown-item icon="delete" label="Eliminar"
                                @click="openConfirmDelete = true; open = false" iconClass="text-red-500" />
                            </x-dropdown>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>