<div>
  <div x-data="{openProviderConfig: false}"
    x-on:close-provider-config.window="openProviderConfig = false"
    x-on:open-provider-config.window="openProviderConfig = true">

    <x-tabs tabs="['Proveedores', 'Envios propios', 'Puntos de retiro']" 
    current="{{ request('tab') ?? 'Proveedores' }}">

        <div x-cloak x-show="current === 'Proveedores'" 
        class="animate__animated animate__fadeIn">
            <section class="py-4 relative">
                <div class="w-full max-w-7xl sm:px-4 mx-auto">
                    <div class="w-full flex-col justify-start items-start gap-8 inline-flex">
                        <div class="w-full flex-col justify-start items-start gap-2.5 flex">
                            <h2 class="w-full text-center text-gray-900 text-lg sm:text-3xl font-bold 
                            font-manrope leading-normal">
                                Proveedores Integrados
                            </h2>
                            <p class="w-full max-w-4xl mx-auto text-center text-gray-500 
                            text-xs sm:text-sm font-normal">
                                Simplecom cuenta con soporte para múltiples proveedores logísticos según tus
                                necesidades. Al elegir uno, deberás registrarte como cliente en su plataforma
                                correspondiente
                                y cargar tus credenciales API obtenidas para comenzar a operar con el servicio,
                                para ello preparamos un instructivo de integración por cada proveedor en particular para
                                guiarte en cada paso.
                            </p>
                        </div>

                        <div class="w-full flex justify-center gap-4 flex-wrap">
                            @foreach ($shipping_providers as $provider)
                                <div wire:key='{{ $provider->id }}' x-data="{ expanded: false }"
                                class="relative max-w-2xs border border-solid border-gray-200 
                                rounded-2xl transition-all duration-500 h-max">
                                    <div class="block overflow-hidden border-b">
                                        <img src="{{ URL::to("img/providers/$provider->code.png") }}"
                                            class="w-full h-32 object-cover rounded-t-2xl" />
                                    </div>
                                    <div class="p-4">

                                        <a href="{{ $provider->page_url }}" target="_blank"
                                            class="text-base font-semibold text-gray-900 inline-block cursor-pointer
                                        transition mb-1 hover:underline hover:text-blue-700"
                                            x-tooltip.raw="Visitar página">
                                            {{ $provider->name }}
                                        </a>

                                        <p class="text-xs font-normal text-gray-600 transition-all duration-500 leading-5 mb-2"
                                            :class="expanded ? 'line-clamp-none' : 'line-clamp-3'" x-transition>
                                            {{ $provider->description }}
                                        </p>

                                        <small class="no-select block hover:underline text-blue-500 cursor-pointer mb-4"
                                        x-text="expanded ? 'Ver menos' : 'Ver mas'"
                                        @click="expanded = !expanded"></small>

                                        <x-button wire:click='configProvider({{ $provider->id }})'
                                        class="!rounded-full w-full">Configurar</x-button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div x-cloak x-show="current === 'Envios propios'" class="animate__animated animate__fadeIn">
            <h4>Tab de envios propios</h4>
        </div>

        <div x-cloak x-show="current === 'Puntos de retiro'" class="animate__animated animate__fadeIn">
            <h4>Puntos de retiro</h4>
        </div>

    </x-tabs>

    <div x-show="openProviderConfig" x-cloak class="relative z-50">
        <!-- Background backdrop, show/hide based on slide-over state. -->
        <div x-show="openProviderConfig" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-700 bg-opacity-60"></div>

        <div class="fixed inset-0 overflow-hidden">
          <div class="absolute inset-0 overflow-hidden">
            <div class="fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
              <div x-show="openProviderConfig" 
              x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
              x-transition:enter-start="translate-x-full"
              x-transition:enter-end="translate-x-0"
              x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
              x-transition:leave-start="translate-x-0"
              x-transition:leave-end="translate-x-full"
              @click.away="openProviderConfig = false" class="w-screen max-w-2xl">

                @if ($configuring_provider)
                  <form wire:submit='saveProviderConfig' class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                    <div class="flex-1">

                      <!-- Header -->
                      <div class="bg-white px-4 py-6 sm:px-6 border-b">
                        <div class="flex items-center justify-between space-x-3">
                          
                          <h2 class="text-base font-semibold text-gray-900">
                            Configurar {{ $configuring_provider->name }}
                          </h2>

                          <div class="flex h-7 items-center gap-x-3">

                            <img class="hidden sm:block h-12 w-28 sm:w-36 bg-white object-cover rounded-md" 
                            src="{{ URL::to("img/providers/$configuring_provider->code.png") }}" 
                            alt="provider img">

                            <x-icon code="close" style="font-size: 18px"
                            @click="openProviderConfig = false"
                            x-tooltip.raw.placement.left="Cerrar panel"
                            class="text-gray-500 bg-white hover:text-red-500 
                            p-2 rounded-full border cursor-pointer hover:border-gray-300 
                            transition duration-200" />
                          </div>
                        </div>
                      </div>
        
                      <!-- Content -->
                      <div class="space-y-6 py-6 sm:space-y-0 sm:divide-y sm:divide-gray-200 sm:py-0">

                        @foreach ($configuring_provider_keys as $key => $field)

                          @if ($field['input_type'] === 'text')

                            <div wire:key='{{ $field['id'] }}' class="space-y-2 px-4 sm:grid 
                            sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">

                              <div>
                                <label for="{{ $field['key'] }}" class="block text-sm/6 font-medium text-gray-900">
                                  {{ $field['display_name'] }} 
                                  @if ($field['required']) <sup class="text-red-500">*</sup> @endif
                                </label>

                                @error($field['key'])
                                  <small class="text-red-500">{{ $message }}</small>
                                @else
                                  <small class="text-gray-500">{{ $field['description'] }}</small>
                                @enderror
                              </div>

                              <div class="sm:col-span-2">
                                <input type="text" id="{{ $field['key'] }}"
                                value="{{ $field['value'] }}" 
                                wire:model.blur="configuring_provider_keys.{{ $key }}.value" 
                                autocomplete="off" class="block w-full rounded-md bg-white px-3 py-1.5 
                                text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 
                                placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 
                                focus:outline-blue-600 text-sm/6">

                                <small class="text-gray-500">{{ $field['helper'] }}</small>
                              </div>
                            </div>    
                          @endif

                          @if ($field['input_type'] === 'textarea')

                            <div wire:key='{{ $field['id'] }}' class="space-y-2 px-4 sm:grid 
                            sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">

                              <div>
                                <label for="{{ $field['key'] }}" class="block text-sm/6 font-medium text-gray-900">
                                  {{ $field['display_name'] }} 
                                  @if ($field['required'])
                                    <sup class="text-red-500">*</sup> 
                                  @endif
                                </label>

                                @error($field['key'])
                                  <small class="text-red-500">{{ $message }}</small>
                                @else
                                  <small class="text-gray-500">{{ $field['description'] }}</small>
                                @enderror

                              </div>

                              <div class="sm:col-span-2">
                                <textarea rows="3" id="{{ $field['key'] }}" class="block w-full rounded-md 
                                bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 
                                -outline-offset-1 outline-gray-300 placeholder:text-gray-400 
                                focus:outline focus:outline-2 focus:-outline-offset-2 
                                focus:outline-indigo-600 sm:text-sm/6">{{ $field['value'] }}</textarea>

                                <small class="text-gray-500">{{ $field['helper'] }}</small>
                              </div>
                            </div>
                          @endif

                        @endforeach

                        <!-- Project name -->
                        
        
                        <!-- Project description -->
                        {{-- <div class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                          <div>
                            <label for="project-description" class="block text-sm/6 font-medium text-gray-900 sm:mt-1.5">Description</label>
                          </div>
                          <div class="sm:col-span-2">
                            <textarea rows="3" name="project-description" id="project-description" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                          </div>
                        </div> --}}
        
                        <!-- Team members -->
                        {{-- <div class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:items-center sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                          <div>
                            <h3 class="text-sm/6 font-medium text-gray-900">Team Members</h3>
                          </div>
                          <div class="sm:col-span-2">
                            <div class="flex space-x-2">
                              <a href="#" class="shrink-0 rounded-full hover:opacity-75">
                                <img class="inline-block w-8 h-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Tom Cook">
                              </a>
                              <a href="#" class="shrink-0 rounded-full hover:opacity-75">
                                <img class="inline-block w-8 h-8 rounded-full" src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Whitney Francis">
                              </a>
                              <a href="#" class="shrink-0 rounded-full hover:opacity-75">
                                <img class="inline-block w-8 h-8 rounded-full" src="https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Leonard Krasner">
                              </a>
                              <a href="#" class="shrink-0 rounded-full hover:opacity-75">
                                <img class="inline-block w-8 h-8 rounded-full" src="https://images.unsplash.com/photo-1463453091185-61582044d556?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Floyd Miles">
                              </a>
                              <a href="#" class="shrink-0 rounded-full hover:opacity-75">
                                <img class="inline-block w-8 h-8 rounded-full" src="https://images.unsplash.com/photo-1502685104226-ee32379fefbe?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Emily Selman">
                              </a>
                            </div>
                          </div>
                        </div> --}}
        
                        <!-- Privacy -->
                        {{-- <fieldset class="space-y-2 px-4 sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:space-y-0 sm:px-6 sm:py-5">
                          <legend class="sr-only">Privacy</legend>
                          <div class="text-sm/6 font-medium text-gray-900" aria-hidden="true">Privacy</div>
                          <div class="space-y-5 sm:col-span-2">
                            <div class="space-y-5 sm:mt-0">
                              <div class="relative flex items-start">
                                <div class="absolute flex h-6 items-center">
                                  <input id="privacy-public" name="privacy" value="public" aria-describedby="privacy-public-description" type="radio" checked class="relative size-4 appearance-none rounded-full border border-gray-300 before:absolute before:inset-1 before:rounded-full before:bg-white checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden [&:not(:checked)]:before:hidden">
                                </div>
                                <div class="pl-7 text-sm/6">
                                  <label for="privacy-public" class="font-medium text-gray-900">Public access</label>
                                  <p id="privacy-public-description" class="text-gray-500">Everyone with the link will see this project.</p>
                                </div>
                              </div>
                              <div class="relative flex items-start">
                                <div class="absolute flex h-6 items-center">
                                  <input id="privacy-private-to-project" name="privacy" value="private-to-project" aria-describedby="privacy-private-to-project-description" type="radio" class="relative size-4 appearance-none rounded-full border border-gray-300 before:absolute before:inset-1 before:rounded-full before:bg-white checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden [&:not(:checked)]:before:hidden">
                                </div>
                                <div class="pl-7 text-sm/6">
                                  <label for="privacy-private-to-project" class="font-medium text-gray-900">Private to project members</label>
                                  <p id="privacy-private-to-project-description" class="text-gray-500">Only members of this project would be able to access.</p>
                                </div>
                              </div>
                              <div class="relative flex items-start">
                                <div class="absolute flex h-6 items-center">
                                  <input id="privacy-private" name="privacy" value="private" aria-describedby="privacy-private-to-project-description" type="radio" class="relative size-4 appearance-none rounded-full border border-gray-300 before:absolute before:inset-1 before:rounded-full before:bg-white checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 forced-colors:appearance-auto forced-colors:before:hidden [&:not(:checked)]:before:hidden">
                                </div>
                                <div class="pl-7 text-sm/6">
                                  <label for="privacy-private" class="font-medium text-gray-900">Private to you</label>
                                  <p id="privacy-private-description" class="text-gray-500">You are the only one able to access this project.</p>
                                </div>
                              </div>
                            </div>
                            <hr class="border-gray-200">
                            <div class="flex flex-col items-start space-y-4 sm:flex-row sm:items-center sm:justify-between sm:space-y-0">
                              <div>
                                <a href="#" class="group flex items-center space-x-2.5 text-sm font-medium text-indigo-600 hover:text-indigo-900">
                                  <svg class="w-8 h-8 text-indigo-500 group-hover:text-indigo-900" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path d="M12.232 4.232a2.5 2.5 0 0 1 3.536 3.536l-1.225 1.224a.75.75 0 0 0 1.061 1.06l1.224-1.224a4 4 0 0 0-5.656-5.656l-3 3a4 4 0 0 0 .225 5.865.75.75 0 0 0 .977-1.138 2.5 2.5 0 0 1-.142-3.667l3-3Z" />
                                    <path d="M11.603 7.963a.75.75 0 0 0-.977 1.138 2.5 2.5 0 0 1 .142 3.667l-3 3a2.5 2.5 0 0 1-3.536-3.536l1.225-1.224a.75.75 0 0 0-1.061-1.06l-1.224 1.224a4 4 0 1 0 5.656 5.656l3-3a4 4 0 0 0-.225-5.865Z" />
                                  </svg>
                                  <span>Copy link</span>
                                </a>
                              </div>
                              <div>
                                <a href="#" class="group flex items-center space-x-2.5 text-sm text-gray-500 hover:text-gray-900">
                                  <svg class="w-8 h-8 text-gray-400 group-hover:text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM8.94 6.94a.75.75 0 1 1-1.061-1.061 3 3 0 1 1 2.871 5.026v.345a.75.75 0 0 1-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 1 0 8.94 6.94ZM10 15a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                                  </svg>
                                  <span>Learn more about sharing</span>
                                </a>
                              </div>
                            </div>
                          </div>
                        </fieldset> --}}
                      </div>
                    </div>
        
                    <!-- Action buttons -->
                    <div class="shrink-0 border-t border-gray-200 px-4 py-5 sm:px-6">
                      <div class="flex justify-end space-x-3">
                          <x-button @click="openProviderConfig = false" size="large" type="secondary">Cancelar</x-button>
                          <x-button submit size="large">Guardar</x-button>
                      </div>
                    </div>
                  </form>
                @endif
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
