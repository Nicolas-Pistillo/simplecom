<div>
    <div x-data="{operatorsDrawerOpen: false, showNotification: false}" 
    x-on:close-drawer.window="operatorsDrawerOpen = false"
    x-on:open-drawer.window="operatorsDrawerOpen = true"
    class="px-4 sm:px-6 lg:px-8">

        <div class="sm:flex sm:items-center mb-8">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Operadores</h1>
                <p class="mt-2 text-sm text-gray-700">
                    Los operadores son usuarios que representan al equipo de tu comercio.
                    Cada uno tendrá acceso solo a las funciones que les corresponda según el rol que les asignes.
                </p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <x-button wire:click='openNewOperator' class="flex items-center">
                    <x-icon code="add" class="mr-1" />
                    Nuevo operador
                </x-button>
            </div>
        </div>

        @if ($operators->isEmpty())
            
            <div class="text-center pt-8">

                <img src="{{ URL::to('img/illustrations/forms.svg') }}" class="h-64 mx-auto mb-4"
                    alt="no-data-img">

                <div class="mb-4">
                    <h3 class="mt-2 text-sm font-semibold text-gray-900">Sin operadores</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Podés crear nuevos operadores cuando lo necesites
                    </p>
                </div>
            </div>

        @else
            <ul role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 2xl:grid-cols-3 py-6">
                
                @foreach ($operators as $operator)
                    <li wire:key='{{ $operator->id }}' 
                        class="col-span-1 transition duration-300 divide-y divide-gray-200 rounded-lg 
                        bg-white shadow hover:shadow-lg">
                        <div class="flex w-full items-center justify-between space-x-6 p-6">
                            <div class="flex-1 truncate">
                                <div class="flex items-start space-x-3 mb-1">
                                    <h3 class="truncate text-sm font-medium text-gray-900">
                                        {{ $operator->name }}
                                    </h3>
                                    <x-badge color="green"> {{ $operator->role ?? 'Sin rol' }} </x-badge>
                                </div>
                                <p class="mt-1 truncate text-sm text-gray-500">
                                    {{ $operator->area ?? $operator->email }}
                                </p>
                            </div>
                            <img class="h-10 w-10 flex-shrink-0 rounded-full" 
                            src="https://ui-avatars.com/api/?name={{ $operator->name }}&background=2563eb&color=fff" alt="avatar operador">
                        </div>
                        <div>
                            <div class="-mt-px flex divide-x">
                                <div class="flex w-0 rounded-bl-lg flex-1 border-t transition-colors duration-200 hover:bg-gray-50">
                                    <button wire:click='openEditOperator({{ $operator }})'
                                    class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                        <x-icon code="edit" class="text-gray-400" style="font-size: 20px" />
                                        Editar
                                    </button>
                                </div>
                                <div class="-ml-px border-t rounded-br-lg flex w-0 flex-1 transition-colors duration-200 hover:bg-gray-50">
                                    <a href="tel:+1-202-555-0170" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                        <x-icon code="call" class="text-gray-400" style="font-size: 22px" />
                                        Call
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>            
        @endif
          
        {{-- Create/Edit operator drawer --}}
        @include('admin.operators.upsert-form')

        {{-- Success notification toast --}}
        <x-toast ref="showNotification" type="success" title="{{ $notificationMessage }}" />

    </div>
</div>
