<x-drawer ref="drawerOpen">
    <div class="h-full">
        <form wire:submit='save' class="h-full flex flex-col justify-between">

            <div class="mb-3">

                <h3 class="text-lg text-gray-700 font-semibold mb-3">
                    {{ $form->incentive ? 'Editar incentivo' : 'Nuevo incentivo' }}
                </h3>

                <hr class="mb-6">

                {{-- Type --}}
                <div class="mb-6">

                    <label for="incentive_type" class="block mb-2 text-sm 
                    font-medium text-gray-900">
                        Tipo de incentivo
                    </label>

                    <select id="incentive_type" wire:model.live="form.type" class="block w-full 
                    rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset 
                    ring-gray-300 sm:max-w-xs sm:text-sm sm:leading-6">
                        <option>Seleccionar tipo</option>
                        @foreach (IncentiveType::cases() as $incentiveType)
                            <option value="{{ $incentiveType->value }}">
                                {{ $incentiveType->name() }}
                            </option>
                        @endforeach
                    </select>

                    @error('form.type')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Title --}}
                <div class="mb-6">
                    <x-form-input model="form.title" label="Título" 
                    placeholder="" />
                </div>

                {{-- Description --}}
                <div class="mb-6">

                    <label for="incentive_description" class="block mb-2 text-sm 
                    font-medium text-gray-900">
                        Descripción
                    </label>

                    <div class="w-full border border-gray-300 rounded-lg bg-gray-50 
                    shadow-sm ring-1 ring-inset ring-gray-300">

                        <div class="p-3 bg-white rounded-lg">
                            <textarea id="incentive_description" rows="4" scrollbar-thin 
                            wire:model.blur="form.description" class="block w-full
                            text-gray-800 bg-white border-0 focus:ring-0 p-0 text-sm 
                            placeholder:text-gray-400" placeholder=""></textarea>
                        </div>
                    </div>

                    @error('form.description')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Published / Hidden --}}
                <div class="mb-6">

                    <fieldset>
                        <div class="space-y-3">

                            <div class="relative flex items-center">
                                <div class="flex h-6 items-center">
                                    <input id="published" type="checkbox" wire:model='form.published'
                                        class="h-4 w-4 rounded border-gray-300 text-blue-600">
                                </div>
                                <div class="ml-3 text-sm leading-5 flex items-center">
                                    <label for="published" class="block font-medium text-gray-900">
                                        Marcar como publicado
                                    </label>
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
