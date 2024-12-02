<div x-data x-init="window.scrollTo({ top: 0, behavior: 'smooth' })" class="animate__animated animate__bounceInLeft">

    <div class="grid grid-cols-12 gap-x-4 gap-y-6">

        <div class="col-span-full flex items-center justify-center gap-4 flex-wrap">

            <button type="button" class="flex text-sm items-center w-full justify-center sm:w-auto py-2.5 px-4 shadow rounded-lg text-gray-600 bg-white hover:shadow-md
                transition-colors duration-300 hover:bg-gray-50 hover:text-gray-800 focus:outline-none">
                <svg class="mr-2" width="18" height="18" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_924_23028)">
                        <path d="M20.7816 11.2282C20.7824 10.5466 20.7234 9.8662 20.6053 9.19446H10.957V13.0466H16.4832C16.3701 13.6619 16.1307 14.2484 15.7796 14.7708C15.4284 15.2931 14.9726 15.7406 14.4398 16.0861V18.5866H17.7379C19.669 16.846 20.7816 14.2719 20.7816 11.2282Z" fill="#4285F4"></path>
                        <path d="M10.9574 21.0024C13.7184 21.0024 16.0431 20.1161 17.7383 18.5881L14.4402 16.0875C13.5223 16.696 12.3401 17.0433 10.9574 17.0433C8.28889 17.0433 6.02388 15.2846 5.21393 12.9147H1.81641V15.4916C2.66795 17.1481 3.97368 18.5407 5.58784 19.5138C7.202 20.487 9.06106 21.0023 10.9574 21.0024Z" fill="#34A853"></path>
                        <path d="M5.21545 12.9146C4.78726 11.6728 4.78726 10.3279 5.21545 9.08607V6.50916H1.81792C1.10159 7.90271 0.728516 9.44072 0.728516 11.0003C0.728516 12.56 1.10159 14.098 1.81792 15.4915L5.21545 12.9146Z" fill="#FBBC04"></path>
                        <path d="M10.9574 4.95748C12.4165 4.93417 13.8263 5.4731 14.8821 6.45778L17.8022 3.60303C15.9506 1.90279 13.4976 0.969332 10.9574 0.998337C9.06106 0.998421 7.202 1.5138 5.58784 2.48692C3.97368 3.46005 2.66795 4.85262 1.81641 6.50918L5.21393 9.08609C6.02388 6.71617 8.28889 4.95748 10.9574 4.95748Z" fill="#EA4335"></path>
                    </g>
                    <defs>
                        <clipPath id="clip0_924_23028">
                            <rect width="21.0569" height="22" fill="white" transform="translate(0.226562)"></rect>
                        </clipPath>
                    </defs>
                </svg>
                Ingresar con Google
            </button>

            <button type="button" class=" flex text-sm items-center w-full justify-center sm:w-auto py-2.5 px-4 shadow rounded-lg text-gray-600 bg-white hover:shadow-md
                transition-colors duration-300 hover:bg-gray-50 hover:text-gray-800 focus:outline-none">
                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="20px" fill="#007bff" viewBox="0 0 167.657 167.657">
                    <path
                        d="M83.829.349C37.532.349 0 37.881 0 84.178c0 41.523 30.222 75.911 69.848 82.57v-65.081H49.626v-23.42h20.222V60.978c0-20.037 12.238-30.956 30.115-30.956 8.562 0 15.92.638 18.056.919v20.944l-12.399.006c-9.72 0-11.594 4.618-11.594 11.397v14.947h23.193l-3.025 23.42H94.026v65.653c41.476-5.048 73.631-40.312 73.631-83.154 0-46.273-37.532-83.805-83.828-83.805z"
                        data-original="#010002"></path>
                </svg>
                Ingresar con Facebook
            </button>
        </div>

        <div class="col-span-full relative my-2">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full mx-auto border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="px-4 text-xs sm:text-sm font-medium text-gray-500 bg-gray-50">
                    Ingresar o registrarse con email
                </span>
            </div>
        </div>

        <div class="col-span-full sm:col-span-6">
            <label for="customer_name" class="block text-sm font-medium text-gray-700">
                Nombre
            </label>
            <div class="mt-1">
                <input type="text" wire:model.blur='form.customer_name' id="customer_name"
                    class="block w-full rounded-md border-gray-300 shadow-sm 
                focus:border-blue-500 focus:ring-blue-500 sm:text-sm">

                @error('form.customer_name')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-span-full sm:col-span-6">
            <label for="customer_lastname" class="block text-sm font-medium text-gray-700">
                Apellido
            </label>
            <div class="mt-1">
                <input type="text" wire:model.blur='form.customer_lastname' id="customer_lastname"
                    class="block w-full rounded-md border-gray-300 shadow-sm 
                focus:border-blue-500 focus:ring-blue-500 sm:text-sm">

                @error('form.customer_lastname')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-span-full sm:col-span-6">
            <label for="customer_email" class="block text-sm font-medium text-gray-700">
                Email
            </label>
            <div class="mt-1">
                <input type="email" wire:model.blur='form.customer_email' id="customer_email"
                    class="block w-full rounded-md border-gray-300 shadow-sm 
                focus:border-blue-500 focus:ring-blue-500 sm:text-sm">

                @error('form.customer_email')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-span-full sm:col-span-6">
            <label for="customer_document" class="block text-sm font-medium text-gray-700">
                DNI
            </label>
            <div class="mt-1">
                <input type="text" id="customer_document" wire:model.blur='form.customer_document'
                    class="block w-full rounded-md border-gray-300 shadow-sm 
                focus:border-blue-500 focus:ring-blue-500 sm:text-sm">

                @error('form.customer_document')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-span-full sm:col-span-2">
            <label for="customer_phone" class="block text-sm font-medium text-gray-700">
                Cod. Area
            </label>
            <div class="mt-1">
                <input type="number" wire:model.blur='form.customer_phone_area' id="customer_phone"
                    class="block w-full rounded-md border-gray-300 shadow-sm
                focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                    placeholder="011">

                @error('form.customer_phone_area')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="col-span-full sm:col-span-5">
            <label for="customer_phone" class="block text-sm font-medium text-gray-700">
                Teléfono
            </label>
            <div class="mt-1">
                <input type="number" wire:model.blur='form.customer_phone' id="customer_phone"
                    class="block w-full rounded-md border-gray-300 shadow-sm
                focus:border-blue-500 focus:ring-blue-500 sm:text-sm">

                @error('form.customer_phone')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </div>
        </div>

    </div>

    <x-button wire:click="setStep(2)" disabled size="big" class="mt-12">
        Continuar
    </x-button>

</div>