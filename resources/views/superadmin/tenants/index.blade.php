@extends('layouts.dashboards.superadmin')

@section('title', 'Tenants')

@section('content')

    @if ($tenants->isEmpty())
        <div class="text-center mt-8">
          
            <x-icon code="add_business" class="text-gray-400" style="font-size: 48px" />
            
            <h3 class="text-sm font-semibold text-gray-900 mb-5">Aún no hay tenants en simplecom</h3>

            <x-button href="{{ route('superadmin.tenants.create') }}">
                Crear uno ahora
            </x-button>
        </div>
    @else
      <div class="px-4 sm:px-6 lg:px-8">

        @if (Session::has('tenant_created'))
          <x-alert class="mb-6 animate__bounceInLeft" type="success" dismissible>
            Tenant creado exitosamente
          </x-alert>
        @endif

        <div class="sm:flex sm:items-center">
          <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Listado de tenants</h1>
            <p class="mt-2 text-sm text-gray-700">
              Cada tenant o "inquilino" representa un comercio dentro de simplecom
            </p>
          </div>
          
          <x-button href="{{ route('superadmin.tenants.create') }}" 
          class="inline-block mt-4 sm:ml-16 sm:mt-0 sm:flex-none" type="primary">Nuevo tenant</x-button>
        </div>

        <div class="mt-8 flow-root">
          <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
              <table class="min-w-full divide-y divide-gray-300">

                <thead>
                  <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Nombre</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Title</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                      <span class="sr-only">Edit</span>
                    </th>
                  </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 bg-white">
                  @foreach ($tenants as $tenant)
                    <tr>
                      <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                        <div class="flex items-center">
                          <div class="h-11 w-11 flex-shrink-0">
                            <img class="h-11 w-11 rounded-full" src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                          </div>
                          <div class="ml-4">
                            <div class="font-medium text-gray-900"> {{ $tenant->ecommerce_name }} </div>
                            <div class="mt-1 text-gray-500 flex items-center"> 
                              <a href="http://{{ $tenant->domains->first()->domain }}" target="_blank" class="text-blue-600 hover:underline flex items-center">
                                {{ $tenant->domains->first()->domain }}
                              </a> 
                              <x-icon code="open_in_new" class="ml-1 text-blue-600 text-sm" />
                            </div>
                          </div>
                        </div>
                      </td>

                      <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                        <div class="text-gray-900">Front-end Developer</div>
                        <div class="mt-1 text-gray-500">Optimization</div>
                      </td>

                      <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                        @if ($tenant->active)
                          <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Activo</span>
                        @else
                          <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Inactivo</span>
                        @endif
                      </td>

                      <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">Member</td>

                      <td class="relative whitespace-nowrap py-5 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Lindsay Walton</span></a> 
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

    {{-- CONFIRM MODAL (esta buenisimo)
    <div x-data="{open: false}">

        <x-button @click="open = !open" @click.away="open = false" type="soft">Abrir modal</x-button>

        <div x-show="open" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <!--
              Background backdrop, show/hide based on modal state.
          
              Entering: "ease-out duration-300"
                From: "opacity-0"
                To: "opacity-100"
              Leaving: "ease-in duration-200"
                From: "opacity-100"
                To: "opacity-0"
            -->
            <div x-show="open" 
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-600 bg-opacity-80 transition-opacity"></div>
          
            <div x-show="open" 
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-10 w-screen overflow-y-auto">
              <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!--
                  Modal panel, show/hide based on modal state.
          
                  Entering: "ease-out duration-300"
                    From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    To: "opacity-100 translate-y-0 sm:scale-100"
                  Leaving: "ease-in duration-200"
                    From: "opacity-100 translate-y-0 sm:scale-100"
                    To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                -->
                <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
                  <div>
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-green-100">
                      <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                      </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-5">
                      <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Payment successful</h3>
                      <div class="mt-2">
                        <p class="text-sm text-gray-500">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eius aliquam laudantium explicabo pariatur iste dolorem animi vitae error totam. At sapiente aliquam accusamus facere veritatis.</p>
                      </div>
                    </div>
                  </div>
                  <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                    <button type="button" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:col-start-2">Deactivate</button>
                    <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:col-start-1 sm:mt-0">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div> 
    --}}
      

@endsection