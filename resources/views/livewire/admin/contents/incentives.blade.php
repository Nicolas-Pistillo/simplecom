<div>
    <div x-data="{ drawerOpen: false }" class="px-4 sm:px-6 lg:px-8" 
        x-on:open-drawer.window="drawerOpen = true"
        x-on:close-drawer.window="drawerOpen = false">

        <nav class="flex mb-4 no-select">
            <ol role="list"
                class="flex space-x-4 rounded-md bg-white px-6 py-0 sm:py-1 
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
                        <svg viewBox="0 0 24 44" fill="currentColor" class="h-full w-4 shrink-0 text-gray-300">
                            <path d="M.293 0l22 22-22 22h1.414l22-22-22-22H.293z" />
                        </svg>
                        <span class="ml-4 font-medium whitespace-nowrap">
                            Incentivos
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="sm:flex sm:items-center mb-16">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">
                    Incentivos
                </h1>
                <p class="mt-2 text-sm text-gray-700">
                    Los incentivos son mensajes breves que comunican de forma rápida y clara los principales
                    beneficios, garantías y políticas de tu tienda online. Su objetivo principal es generar
                    confianza desde el primer momento en que un usuario aterriza en la página.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button wire:loading.remove wire:target='openNew' wire:click='openNew' class="flex items-center">
                    <x-icon code="add" class="mr-1" />
                    Agregar incentivo
                </x-button>

                <div wire:loading wire:target='openNew'>
                    <x-button disabled class="flex items-center">
                        <x-spinner class="mr-3" spinnerclass="!w-4" />
                        Cargando
                    </x-button>
                </div>
            </div>
        </div>

        @if ($incentives->isEmpty())
            <div class="text-center">
                <img src="{{ URL::to('img/illustrations/steps_form.svg') }}" class="h-52 mx-auto mb-4"
                    alt="no-data-img">

                <div class="mb-4">
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">
                        Todavía no tenés incentivos creados
                    </h3>
                    <p class="mt-1 mb-4 text-sm text-gray-500">
                        Podés empezar a crearlos cuando quieras
                    </p>
                </div>
            </div>
        @else
            <div class="grid lg:grid-cols-2 gap-6">

                @foreach ($incentives as $incentive)
                    <div wire:key='{{ $incentive->id }}' x-data="{deleteDialogOpen: false}"
                    x-on:close-delete-dialog.window="deleteDialogOpen = false" 
                    class="p-4 border h-max border-gray-200 rounded-lg">

                        <div class="flex max-sm:flex-col max-sm:items-center group gap-x-6 gap-y-2 mb-4">

                            <span
                                class="w-16 h-14 rounded-full p-4 flex items-center justify-center 
                            shadow-sm shadow-transparent transition-all duration-500 bg-gray-100">
                                <x-icon :code="$incentive->type->icon()" />
                            </span>

                            <div class="flex flex-col">

                                <x-badge color="blue" class="mb-2 w-max">
                                    {{ $incentive->type->name() }}
                                </x-badge>

                                <h6 class="font-semibold text-lg text-black mb-1 max-sm:text-center">
                                    {{ $incentive->title }}
                                </h6>

                                <p class="font-normal text-sm text-gray-500 max-sm:text-center">
                                    {{ $incentive->description }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center justify-start gap-4">
                            <x-switch wireChange="toggleActive({{ $incentive->id }})" :checked="$incentive->published"
                                label="Publicar" />

                            <x-icon wire:click='openEdit({{ $incentive->id }})' code="edit" x-tooltip.raw="Editar"
                            class="transition colors cursor-pointer bg-gray-100 text-gray-600 
                            p-1.5 rounded-full hover:bg-gray-200 focus:outline-none focus:ring duration-300" />

                            <x-icon @click="deleteDialogOpen = true" code="delete" x-tooltip.raw="Eliminar"
                            class="transition colors cursor-pointer bg-gray-100 text-red-500 
                            p-1.5 rounded-full hover:bg-gray-200 focus:outline-none focus:ring duration-300" />
                        </div>

                        <x-modal ref="deleteDialogOpen" type="danger" icon="warning">

                            <x-slot name="title">
                                Eliminar incentivo
                            </x-slot>

                            <x-slot name="body">
                                ¿Estás seguro que deseas eliminar el incentivo {{ $incentive->title }}?
                            </x-slot>

                            <x-slot name="actions">

                                <x-spinner wire:loading wire:target='delete' />

                                <x-button type="secondary" wire:loading.remove wire:target='delete'
                                @click="deleteDialogOpen = false">Cancelar</x-button>

                                <x-button wire:click='delete({{ $incentive->id }})' 
                                wire:loading.remove wire:target='delete'
                                class="bg-red-600 hover:bg-red-500">Eliminar</x-button>

                            </x-slot>

                        </x-modal>
                    </div>
                @endforeach
            </div>
        @endif

        @include('admin.contents.partials.incentives-drawer')
    </div>
</div>
