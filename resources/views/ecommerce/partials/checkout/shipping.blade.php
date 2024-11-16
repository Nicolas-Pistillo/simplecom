<div x-data x-init="window.scrollTo({top: 0, behavior: 'smooth'})" 
class="animate__animated animate__bounceInLeft grid grid-cols-12 
gap-x-4 gap-y-3 items-end">

    <div class="col-span-full sm:col-span-6">
        <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700">
            Código postal
        </label>
        <div class="mt-1">
            <input type="text" wire:model.live='form.customer_postal_code' id="shipping_postal_code" name="shipping_postal_code"
            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 
            focus:ring-blue-500 sm:text-sm">
        </div>

    </div>

    <div class="col-span-full sm:col-span-6">
        <x-button type="secondary" wire:click="checkAddress" size="large">Calcular</x-button>
    </div>

    @error('form.customer_postal_code')
        <small class="text-red-500 col-span-full sm:col-span-8">
            {{ $message }}
        </small>                                    
    @enderror
</div>