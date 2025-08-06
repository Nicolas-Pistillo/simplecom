<x-drawer ref="drawerOpen">
    <div class="h-full">
        <form wire:submit='save' class="h-full flex flex-col justify-between">

            <div class="mb-3">

                <h3 class="text-lg text-gray-700 font-semibold mb-3">
                    {{ $form->banner ? $this->form->banner->name : 'Nuevo Banner' }}
                </h3>

                <hr class="mb-6">

                <h4 class="text-sm text-gray-500 font-semibold mb-3">Imagen</h4>

                {{-- Image preview --}}
                <div class="mb-4">

                    <img src="{{ $form->imagePreview ?: 'http://placehold.co/1920x800' }}" alt="banner-img"
                        class="w-full h-28 rounded-lg object-cover shadow">

                    <p class="mt-1.5 text-xs font-medium text-gray-500" wire:loading.remove
                        wire:target='image, deleteImage'>
                        Medidas óptimas: 1920px x 800px
                    </p>
                </div>

                {{-- Upload image --}}
                <div class="w-full mb-6">

                    <div class="flex items-center mb-1">

                        <x-button type="secondary" file onlyImages
                            class="flex justify-center items-center w-full text-center" wire:loading.remove
                            wire:target='form.image, form.deleteImage' wireModel="form.image" name="image">
                            Subir imagen
                            <x-icon code="upload" class="ml-1" />
                        </x-button>

                        @if ($form->imagePreview)
                            <x-button wire:click='deleteImage' wire:loading.remove wire:target='form.image, form.deleteImage'
                                size="small" x-tooltip.raw.placement.bottom="Eliminar"
                                class="flex items-center ml-1 text-white bg-red-600 hover:bg-red-500">
                                <span class="material-symbols-outlined">delete</span>
                            </x-button>
                        @endif

                        <x-spinner class="mx-auto" wire:loading wire:target='form.image, form.deleteImage' />
                    </div>

                    @error('form.image')
                        <small class="text-red-500"> {{ $message }} </small>
                    @enderror
                </div>

                {{-- Banner name --}}
                <div class="mb-6">
                    <div class="mt-2">
                        <x-form-input withAsterisk model="form.name" label="Nombre del Banner" 
                        placeholder="Ejemplo: Ofertas de verano 2024..." />
                    </div>
                </div>

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
                                    <span
                                        x-tooltip.raw.placement.bottom="No se mostrará en el slider principal hasta que lo publiques."
                                        class="material-symbols-outlined ml-2 text-blue-600">help</span>
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
