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
                    Comercio actualizado exitosamente
                </x-alert>
            @endif

            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Listado de comercios</h1>
                </div>

                <x-button href="{{ route('superadmin.tenants.create') }}"
                    class="inline-block mt-4 sm:ml-16 sm:mt-0 sm:flex-none" type="primary">Nuevo comercio</x-button>
            </div>

            {{-- <div class="my-8 flow-root">
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
                                                    src="{{ $tenant->logo_url ? Storage::url($tenant->logo_url) : "https://ui-avatars.com/api/?color=fff&background=2563eb&name=$tenant->ecommerce_name&bold=true" }}"
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
                                            <p class="text-gray-900"> {{ $tenant->sector->name }} </p>
                                        </td>

                                        <td class="py-5 pr-4 font-medium text-center sm:pr-0">
                                            <div class="inline-block">

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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}

            <ul role="list" class="flex flex-wrap gap-6 py-10">

                @foreach ($tenants as $tenant)
                    <li wire:key='{{ $tenant->id }}' x-data="{ open: false }" 
                    class="overflow-hidden rounded-xl border border-gray-200 w-full md:w-[48%]">
                        <div class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6">

                            @if ($tenant->logo_url)
                                <img src="{{ Storage::url($tenant->logo_url) }}" 
                                alt="Logo comercio" class="h-12 w-24 flex-none bg-white 
                                object-contain rounded-md ring-1 ring-gray-900/10">
                            @else
                                <img src="{{initialsAvatar(['name' => $tenant->ecommerce_name, 'background' => '#2563eb', 'color' => 'fff']) }}" 
                                alt="Logo comercio" class="h-12 w-12 flex-none rounded-md
                                object-contain ring-1 ring-gray-900/10">
                            @endif

                            <div class="text-xs sm:text-sm font-medium text-gray-900 truncate">

                                <span>{{ $tenant->ecommerce_name }}</span>

                                <div class="mt-1 text-gray-500 flex items-center">
                                    <a href="http://{{ $tenant->domain() }}"
                                    target="_blank"
                                    class="text-blue-600 hover:underline flex items-center">
                                        Visitar
                                    </a>
                                </div>
                            </div>

                            <div class="relative ml-auto">
                                <button @click="open = !open" @click.away="open = false" type="button" class="-m-2.5 block p-2.5 text-gray-400 hover:text-gray-500" id="options-menu-0-button" aria-expanded="false" aria-haspopup="true">
                                    <x-icon code="more_horiz" x-tooltip.raw="Acciones" 
                                    class="p-1 bg-white rounded-full shadow transition duration-300" />
                                </button>
            
                                <div x-cloak x-show="open" 
                                x-transition:enter="transition ease-out duration-100" 
                                x-transition:enter-start="opacity-0 scale-95" 
                                x-transition:enter-end="transform opacity-100 scale-100" 
                                x-transition:leave="transition ease-in duration-75" 
                                x-transition:leave-start="opacity-100 scale-100" 
                                x-transition:leave-end="opacity-0 scale-95" 
                                class="absolute right-0 z-10 mt-0.5 w-32 origin-top-right 
                                rounded-md bg-white py-2 shadow-lg ring-1 
                                ring-gray-900/5 focus:outline-none">

                                    <a href="#" class="block px-3 py-1 text-sm leading-6 
                                    text-gray-900 transition duration-300 hover:bg-gray-50" 
                                    >View<span class="sr-only">, Tuple</span>
                                    </a>

                                    <a href="#" class="block px-3 py-1 text-sm leading-6 
                                    text-gray-900">Edit<span class="sr-only">, Tuple</span></a>
                                </div>
                            </div>
                        </div>
                        <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm leading-6">
                            <div class="flex justify-between gap-x-4 py-3">
                                <dt class="text-gray-500">Last invoice</dt>
                                <dd class="text-gray-700"><time datetime="2022-12-13">December 13, 2022</time></dd>
                            </div>
                            <div class="flex justify-between gap-x-4 py-3">
                                <dt class="text-gray-500">Amount</dt>
                                <dd class="flex items-start gap-x-2">
                                    <div class="font-medium text-gray-900">$2,000.00</div>
                                    <div class="rounded-md py-1 px-2 text-xs font-medium ring-1 ring-inset text-red-700 bg-red-50 ring-red-600/10">
                                        Overdue</div>
                                </dd>
                            </div>
                        </dl>
                    </li>
                @endforeach

            </ul>
        </div>
    @endif

</div>
