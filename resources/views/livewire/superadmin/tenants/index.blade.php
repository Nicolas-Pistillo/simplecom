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

            @session('tenant_saved')
                <x-toast type="success" title="Cambios aplicados con éxito" />
            @endsession

            {{-- @if (Session::has('tenant_created'))
                <x-alert class="mb-6 animate__bounceInLeft" type="success" dismissible>
                    Comercio creado exitosamente
                </x-alert>
            @endif

            @if (Session::has('tenant_updated'))
                <x-alert class="mb-6 animate__bounceInLeft" type="success" dismissible>
                    Comercio actualizado exitosamente
                </x-alert>
            @endif --}}

            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Listado de comercios</h1>
                </div>

                <x-button href="{{ route('superadmin.tenants.create') }}"
                    class="inline-block mt-4 sm:ml-16 sm:mt-0 sm:flex-none" type="primary">Nuevo comercio</x-button>
            </div>

            <ul role="list" class="flex flex-wrap gap-6 py-10">

                @foreach ($tenants as $tenant)
                    <li wire:key='{{ $tenant->id }}' x-data="{ open: false }" 
                    class="w-full sm:w-auto overflow-hidden rounded-xl border border-gray-200">
                        <div class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6">

                            @if ($tenant->logo_url)
                                <img src="{{ Storage::url($tenant->logo_url) }}" 
                                alt="Logo comercio" class="h-12 w-24 flex-none bg-white 
                                object-contain rounded-md ring-1 ring-gray-900/10 p-1.5">
                            @else
                                <img src="{{initialsAvatar(['name' => $tenant->ecommerce_name, 'background' => '#2563eb', 'color' => 'fff']) }}" 
                                alt="Logo comercio" class="h-12 w-12 flex-none rounded-md
                                object-contain ring-1 ring-gray-900/10">
                            @endif

                            <div class="text-xs sm:text-sm font-medium text-gray-900 truncate">

                                <span>{{ $tenant->ecommerce_name }}</span>

                                <div class="mt-1 text-gray-500 flex items-center">
                                    <a href="http://{{ $tenant->domain() }}" target="_blank"
                                    class="text-blue-600 hover:underline flex items-center">
                                        Visitar
                                    </a>
                                </div>
                            </div>

                            <div x-data="{openDeleteDialog: false}" class="relative ml-auto">
            
                                <x-dropdown position="right-0">

                                    <x-slot name="trigger">
                                        <x-icon code="more_horiz" x-tooltip.raw="Acciones" 
                                        class="p-1 bg-white rounded-full border transition 
                                        duration-300 cursor-pointer no-select text-gray-500" />
                                    </x-slot>

                                    <x-dropdown-item wire:click='toggleActive({{ $tenant }})'
                                    @click="open = false"
                                    :label="$tenant->active ? 'Desactivar comercio' : 'Activar comercio'" 
                                    :icon="$tenant->active ? 'public_off' : 'public'" />

                                    <x-dropdown-item :href="route('superadmin.tenants.edit', $tenant)" 
                                    label="Editar" icon="edit" />

                                    <x-dropdown-item @click="openDeleteDialog = true"
                                    label="Eliminar" icon="delete" iconClass="text-red-500" />
                                </x-dropdown>

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
                                        class="bg-red-600 hover:bg-red-500">Eliminar</x-button>
                                        
                                    </x-slot>
                                
                                </x-modal>
                            </div>
                        </div>
                        <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm leading-6">
                            <div class="flex justify-between gap-x-4 py-3">
                                <dt class="text-gray-500">Estado</dt>
                                <dd class="text-gray-700 text-right">

                                    @if (!$tenant->active)
                                        <x-badge color="red">Inactivo</x-badge>
                                    @endif

                                    @if ($tenant->active && !$tenant->setup_completed)
                                        <x-badge color="indigo">Setup Pendiente</x-badge>
                                    @endif

                                    @if ($tenant->active && $tenant->setup_completed)
                                        <x-badge color="green">Operativo</x-badge>
                                    @endif
                                </dd>
                            </div>
                            <div class="flex justify-between gap-x-4 py-3">
                                <dt class="text-gray-500">Volúmen</dt>
                                <dd class="text-gray-700 text-right">
                                    ${{ priceFormat(rand(100000, 999999)) }}
                                </dd>
                            </div>
                            <div class="flex justify-between gap-x-4 py-3">
                                <dt class="text-gray-500">Rubro</dt>
                                <dd class="text-gray-700 text-right">
                                    {{ $tenant->sector->name }}
                                </dd>
                            </div>
                            <div class="flex justify-between gap-x-4 py-3">
                                <dt class="text-gray-500">Fecha Alta</dt>
                                <dd class="text-gray-700 text-right">
                                    {{ $tenant->created_at->format('d/m/Y H:i') }}
                                </dd>
                            </div>
                        </dl>
                    </li>
                @endforeach

            </ul>
        </div>
    @endif

</div>
