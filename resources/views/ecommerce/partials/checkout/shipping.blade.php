<div x-data x-init="window.scrollTo({ top: 0, behavior: 'smooth' })"
    class="animate__animated animate__bounceInLeft grid grid-cols-12 
gap-x-4 gap-y-3 items-end">

    <div class="col-span-full sm:col-span-6">
        <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700">
            Código postal
        </label>
        <div class="mt-1">
            <input type="text" wire:model.live='form.customer_postal_code' id="shipping_postal_code"
                name="shipping_postal_code"
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

    {{-- <fieldset class="col-span-full" aria-label="Privacy setting">
        <div class="-space-y-px rounded-md bg-white">
            <!-- Checked: "z-10 border-indigo-200 bg-indigo-50", Not Checked: "border-gray-200" -->
            <label aria-label="Public access"
                aria-description="This project would be available to anyone who has the link"
                class="relative flex cursor-pointer rounded-tl-md rounded-tr-md border p-4 focus:outline-none">
                <input type="radio" name="privacy-setting" value="Public access"
                    class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 text-blue-600 focus:ring-blue-600 active:ring-2 active:ring-blue-600 active:ring-offset-2">
                <span class="ml-3 flex flex-col">
                    <!-- Checked: "text-indigo-900", Not Checked: "text-gray-900" -->
                    <span class="block text-sm font-medium">Public access</span>
                    <!-- Checked: "text-indigo-700", Not Checked: "text-gray-500" -->
                    <span class="block text-sm">This project would be available to anyone who has the link</span>
                </span>
            </label>
            <!-- Checked: "z-10 border-indigo-200 bg-indigo-50", Not Checked: "border-gray-200" -->
            <label aria-label="Private to Project Members"
                aria-description="Only members of this project would be able to access"
                class="relative flex cursor-pointer border p-4 focus:outline-none">
                <input type="radio" name="privacy-setting" value="Private to Project Members"
                    class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 text-indigo-600 focus:ring-indigo-600 active:ring-2 active:ring-indigo-600 active:ring-offset-2">
                <span class="ml-3 flex flex-col">
                    <!-- Checked: "text-indigo-900", Not Checked: "text-gray-900" -->
                    <span class="block text-sm font-medium">Private to Project Members</span>
                    <!-- Checked: "text-indigo-700", Not Checked: "text-gray-500" -->
                    <span class="block text-sm">Only members of this project would be able to access</span>
                </span>
            </label>
            <!-- Checked: "z-10 border-indigo-200 bg-indigo-50", Not Checked: "border-gray-200" -->
            <label aria-label="Private to you" aria-description="You are the only one able to access this project"
                class="relative flex cursor-pointer rounded-bl-md rounded-br-md border p-4 focus:outline-none">
                <input type="radio" name="privacy-setting" value="Private to you"
                    class="mt-0.5 size-4 shrink-0 cursor-pointer border-gray-300 text-indigo-600 focus:ring-indigo-600 active:ring-2 active:ring-indigo-600 active:ring-offset-2">
                <span class="ml-3 flex flex-col">
                    <!-- Checked: "text-indigo-900", Not Checked: "text-gray-900" -->
                    <span class="block text-sm font-medium">Private to you</span>
                    <!-- Checked: "text-indigo-700", Not Checked: "text-gray-500" -->
                    <span class="block text-sm">You are the only one able to access this project</span>
                </span>
            </label>
        </div>
    </fieldset> --}}

</div>
