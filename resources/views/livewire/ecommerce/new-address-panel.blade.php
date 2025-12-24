<div>
    <section x-data="{ open: false, deleteDialogOpen: false }" class="relative"
    x-on:open-new-address-panel.window="open = true; @this.initialize($event.detail)"
    x-on:close-new-address-panel.window="open = false"
    x-on:open-delete-address.window="deleteDialogOpen = true; @this.receiveDeleteAddress($event.detail)"
    x-on:close-delete-address.window="deleteDialogOpen = false">

        {{-- New / Edit Address Panel --}}
        <div x-cloak x-show="open" class="w-full max-w-7xl mx-auto px-4 lg:px-8 xl:px-14 relative">
            <div class="w-full relative flex justify-center">
                <div x-cloak x-show="open" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                    class="w-full h-full fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
                    <div class="opacity-1 ease-out sm:max-w-lg sm:w-full m-5 relative top-1/2 -translate-y-1/2 sm:mx-auto modal-open:opacity-100 transition-all modal-open:duration-500">
                        <div class="flex items-start bg-white p-6 rounded-lg">
                            <div class="block w-full">

                                @if ($form->show_map_confirm)
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-50">
                                                <x-icon code="where_to_vote" class="text-blue-600" />
                                            </div>
                                            <h6 class="text-lg font-bold leading-8 text-gray-900">
                                                Confirmar dirección
                                            </h6>
                                        </div>
                                        <x-icon code="close" @click="open = false"
                                        class="transition colors duration-300 text-[18px]
                                        cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                                        hover:bg-gray-200 focus:outline-none focus:ring" />
                                    </div>

                                    @php
                                        $coordinates = data_get($form->gmap_data, 'geometry.location.lat') . ',' . data_get($form->gmap_data, 'geometry.location.lng');
                                    @endphp

                                    <h4 class="text-sm font-semibold">
                                        {{ data_get($form->gmap_data, 'formatted_address') }}
                                    </h4>

                                    <gmp-map wire:ignore 
                                    center="{{ $coordinates }}" 
                                    zoom="18" map-id="user_address_confirm" 
                                    class="mt-4 h-[150px] md:h-[350px] rounded-lg shadow-md overflow-hidden">
                                        <gmp-advanced-marker position="{{ $coordinates }}"></gmp-advanced-marker>
                                    </gmp-map>

                                    <div class="flex items-center gap-3 justify-between mt-6">

                                        <x-button size="large" wire:loading.remove wire:target='save'
                                        wire:click='continueEditing' class="w-full" 
                                        type="secondary">Editar dirección</x-button>

                                        <x-button size="large" wire:loading.remove wire:target='save'
                                        wire:click='save' class="w-full">Guardar</x-button>

                                        <div wire:loading wire:target='save' class="ml-auto">
                                            <div class="flex items-center gap-1.5 font-semibold">
                                                <span>Espere...</span>
                                                <x-spinner />
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-50">
                                                <x-icon code="location_on" class="text-blue-600" />
                                            </div>
                                            <h6 class="text-lg font-bold leading-8 text-gray-900">
                                                Nueva dirección
                                            </h6>
                                        </div>
                                        <x-icon code="close" @click="open = false"
                                        class="transition colors duration-300 text-[18px]
                                        cursor-pointer text-gray-600 p-2 bg-gray-100 rounded-full 
                                    hover:bg-gray-200 focus:outline-none focus:ring" />
                                    </div>

                                    <div class="grid sm:grid-cols-12 gap-3 text-gray-700">

                                        <x-form-input model="form.tag" class="col-span-full" label="Etiqueta (opcional)"
                                        placeholder="Ej: Casa" />

                                        <div class="sm:col-span-6">
                                            <label for="province" class="inline-block text-sm 
                                            font-medium leading-6 text-gray-900 mb-2">
                                                Provincia <sup class="text-red-500">*</sup>
                                            </label>
                                            <div>
                                                <select wire:model.live='form.province_id' id="province" class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                                                shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 
                                                focus:ring-inset focus:ring-blue-600 text-sm leading-6">
                                                    <option value="0">Seleccionar provincia</option>
                                                    @foreach ($provinces as $province)
                                                        <option {{ $province->id == $form->province_id ? 'selected' : null }} 
                                                        value="{{ $province->id }}">
                                                            {{ $province->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('form.province_id')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="sm:col-span-6">

                                            <label for="locality" class="inline-block text-sm 
                                            font-medium leading-6 text-gray-900 mb-2">
                                                Localidad <sup class="text-red-500">*</sup>
                                            </label>
                                            <div>
                                                <select wire:model.live='form.locality_id' id="locality" class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                                                shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 
                                                focus:ring-inset focus:ring-blue-600 text-sm leading-6">
                                                    <option value="0">Seleccionar localidad</option>
                                                    @foreach ($localities as $locality)
                                                        <option {{ $locality->id == $form->locality_id ? 'selected' : null }} 
                                                        value="{{ $locality->id }}">
                                                            {{ $locality->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @error('form.locality_id')
                                                    <small class="text-red-500">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <x-form-input model="form.street" withAsterisk 
                                        class="sm:col-span-6" label="Calle" placeholder="Av. Rivadavia" />

                                        <x-form-input model="form.number" withAsterisk 
                                        class="sm:col-span-6" label="Altura" placeholder="578" />

                                        <x-form-input model="form.zipcode" withAsterisk 
                                        class="sm:col-span-6" label="Código postal" placeholder="1739" />

                                        <x-form-input model="form.floor" class="sm:col-span-6" label="Piso (opcional)" />

                                        <x-form-input model="form.apartment" class="sm:col-span-6" label="Departamento (opcional)" />

                                        <x-form-input model="form.office" class="sm:col-span-6" label="Oficina (opcional)" />

                                        <div class="col-span-full">
                                            <label for="address_details" class="block mb-2 text-sm 
                                            font-medium text-gray-900">
                                                Detalles de entrega (opcional)
                                            </label>
                                            <div class="w-full border border-gray-300 rounded-lg bg-gray-50 
                                            shadow-sm ring-1 ring-inset ring-gray-300">
                                                <div class="p-3 bg-white rounded-lg">
                                                    <textarea wire:model.blur='form.details' id="address_details" rows="4" 
                                                    scrollbar-thin class="block w-full p-0 text-sm text-gray-800
                                                    bg-white border-0 focus:ring-0 placeholder:text-gray-400" 
                                                    placeholder="Ej. Portón azul en una esquina"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-3 justify-between mt-6">

                                        <x-button size="large" wire:loading.remove wire:target='evaluateSave'
                                        @click="open = false" class="w-full" 
                                        type="secondary">Cancelar</x-button>

                                        <x-button size="large" wire:loading.remove wire:target='evaluateSave'
                                        wire:click='evaluateSave' class="w-full">Guardar</x-button>

                                        <div wire:loading wire:target='evaluateSave' class="ml-auto">
                                            <div class="flex items-center gap-1.5 font-semibold">
                                                <span>Espere...</span>
                                                <x-spinner />
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div x-cloak x-show="open" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" class="fixed top-0 left-0 w-full h-full bg-black/50 z-40">
                </div>
            </div>
        </div>

        {{-- Delete Address Confirm --}}
        <x-modal ref="deleteDialogOpen" type="danger" icon="wrong_location">

            @if ($form->target_delete_address)
                <x-slot name="title">
                    Eliminar dirección
                </x-slot>

                <x-slot name="body">
                    ¿Estás seguro que deseas eliminar la dirección 
                    <b>{{ $form->target_delete_address->summary }}</b>?
                </x-slot>

                <x-slot name="actions">

                    <x-spinner wire:loading wire:target='deleteAddress' />

                    <x-button type="secondary" wire:loading.remove wire:target='deleteAddress' 
                    @click="deleteDialogOpen = false">Cancelar</x-button>

                    <x-button wire:click='deleteAddress' wire:loading.remove wire:target='deleteAddress' 
                    class="bg-red-600 hover:bg-red-500">Eliminar</x-button>
                    
                </x-slot>
            @endif

        </x-modal>
    </section>
</div>
