{{-- Select or create shipping address --}}
<fieldset wire:loading.remove wire:target='selectAddress' 
class="col-span-full animate__animated animate__fadeIn">
    <legend class="text-sm/6 font-semibold text-gray-900">Seleccionar dirección</legend>
    <p class="mt-1 text-sm/6 text-gray-600">Elige o agrega una dirección para calcular el envío</p>

    <div class="mt-3 flex items-end gap-3 flex-wrap">
        @forelse ($form->addresses as $address)

            <label wire:key='{{ $address->id }}' wire:click='selectAddress({{ $address->id }})'
                @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="no-select w-full sm:w-max relative flex cursor-pointer rounded-lg border 
                bg-white hover:bg-gray-50 transition-colors duration-300 
                p-4 shadow focus:outline-hidden border-transparent">
                    <div class="flex flex-1">
                        <div class="flex flex-col">
                            <span class="flex items-center text-sm font-medium text-gray-900">
                                <x-icon code="location_pin" class="mr-1" /> 
                                {{ !empty($address->tag) ? $address->tag : 'Sin etiqueta' }}
                            </span>
                            <span class="mt-1 flex items-center text-xs text-gray-500">
                                {{ $address->summary }}
                            </span>
                        </div>
                    </div>
            </label>  
        @empty
        @endforelse

        <label @click="$dispatch('open-new-address-panel')" 
        class="no-select w-max relative flex items-center justify-center cursor-pointer 
        rounded-lg border-2 border-dashed bg-white hover:bg-gray-50 transition-colors duration-300 
        p-4 focus:outline-hidden">
            <div class="text-center text-blue-500 text-xs">
                <x-icon code="add_circle" />
                <h4>Agregar dirección</h4>
            </div>
        </label>
    </div>
</fieldset>