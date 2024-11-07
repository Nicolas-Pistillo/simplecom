<div>
    
    @if ($tenants->isEmpty())
        <div class="text-center mt-8">

            <x-icon code="add_business" class="text-gray-400" style="font-size: 48px" />

            <h3 class="text-sm font-semibold text-gray-900 mb-5">Aún no hay comercios en simplecom</h3>

            <x-button href="{{ route('superadmin.tenants.create') }}">
                Crear uno ahora
            </x-button>
        </div>
    @else
        <div class="px-4 sm:px-6 lg:px-8">

            @if (Session::has('tenant_created'))
                <x-alert class="mb-6 animate__bounceInLeft" type="success" dismissible>
                    Comercio creado exitosamente
                </x-alert>
            @endif

            @if (Session::has('tenant_updated'))
                <x-alert class="mb-6 animate__bounceInLeft" type="success" dismissible>
                    Tenant actualizado exitosamente
                </x-alert>
            @endif

            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Listado de comercios</h1>
                </div>

                <x-button href="{{ route('superadmin.tenants.create') }}"
                    class="inline-block mt-4 sm:ml-16 sm:mt-0 sm:flex-none" type="primary">Nuevo comercio</x-button>
            </div>

            <div class="my-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto md:overflow-x-visible sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">

                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                        Nombre</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Estado</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Plan</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                        Rubro</th>
                                    <th scope="col" class="px-3 py-3.5 text-sm font-semibold text-center text-gray-900">
                                        Acciones</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200 bg-white">
                                @foreach ($tenants as $tenant)
                                    <tr wire:key='{{ $tenant->id }}' x-data="{openDeleteDialog: false}">
                                        <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0">

                                                    <img class="{{ $tenant->logo_url ? 'h-11 w-28 object-contain' : 'h-11 w-11 rounded-full' }}"
                                                    src="{{ $tenant->logo_url ? Storage::url($tenant->logo_url) : "https://ui-avatars.com/api/?color=fff&background=2563eb&name=$tenant->ecommerce_name" }}"
                                                    alt="Logo del comercio">

                                                </div>
                                                <div class="ml-4">
                                                    <h4 class="font-medium text-gray-900"> {{ $tenant->ecommerce_name }}</h4>
                                                    <div class="mt-1 text-gray-500 flex items-center">
                                                        <a href="http://{{ $tenant->domain() }}"
                                                            title="Ir a su ecommerce" target="_blank"
                                                            class="text-blue-600 hover:underline flex items-center">
                                                            {{ $tenant->domain() }}
                                                        </a>
                                                        <x-icon code="open_in_new" class="ml-1 text-blue-600 text-sm" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                            @if ($tenant->active)
                                                <x-badge color="green">Activo</x-badge>
                                            @else
                                                <x-badge color="red">Inactivo</x-badge>
                                            @endif
                                        </td>

                                        <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                            <p class="text-gray-900"> {{ $tenant->plan->name }} </p>
                                        </td>

                                        <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                            <p class="text-gray-900"> {{ $tenant->sector->name }} </p>
                                        </td>

                                        {{-- Tenant actions --}}
                                        <td class="py-5 pr-4 font-medium text-center sm:pr-0">
                                            <div class="inline-block">

                                                {{-- Tenant actions dropdown --}}
                                                <x-dropdown position="right">

                                                    <x-slot name="trigger">
                                                        <x-icon code="more_vert"
                                                        class="text-gray-500 cursor-pointer transition duration-300
                                                        rounded-full p-1 hover:bg-gray-100 hover:shadow-md" />
                                                    </x-slot>

                                                    @if ($tenant->active)
                                                        <x-dropdown-item wire:click='toggleActive({{ $tenant }})'
                                                        @click="open = false"
                                                        label="Desactivar sitio" icon="public_off" />
                                                    @else
                                                        <x-dropdown-item wire:click='toggleActive({{ $tenant }})'
                                                        @click="open = false"
                                                        label="Activar sitio" icon="public" />
                                                    @endif

                                                    <x-dropdown-item :href="route('superadmin.tenants.edit', $tenant)" 
                                                    label="Editar" icon="edit" />

                                                    <x-dropdown-item @click="openDeleteDialog = true"
                                                    label="Eliminar" icon="delete" iconClass="text-red-500" />
                                                </x-dropdown>

                                                {{-- Confirm delete dialog --}}
                                                <x-modal ref="openDeleteDialog" type="danger" icon="warning">

                                                    <x-slot name="title">
                                                        Eliminar comercio <span class="text-blue-600">{{ $tenant->ecommerce_name }}</span>         
                                                    </x-slot>
                                                
                                                    <x-slot name="body">
                                                        Se eliminara toda la información asociada y su almacenamiento de archivos en la nube.
                                                    </x-slot>
                                                
                                                    <x-slot name="actions">
                                                
                                                        <x-spinner wire:loading wire:target='deleteTenant' />
                                                
                                                        <x-button type="secondary" wire:loading.remove wire:target='deleteTenant' 
                                                        @click="openDeleteDialog = false">Cancelar</x-button>
                                                
                                                        <x-button wire:click='deleteTenant({{ $tenant }})' 
                                                        wire:loading.remove wire:target='deleteTenant' 
                                                        class="bg-red-600 hover:bg-red-500 mx-3">Eliminar</x-button>
                                                        
                                                    </x-slot>
                                                
                                                </x-modal>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
