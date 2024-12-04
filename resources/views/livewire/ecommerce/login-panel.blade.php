<div>
    <div x-data="{ open: false }" class="relative z-20" aria-labelledby="modal-title" role="dialog" aria-modal="true"
        x-on:open-login-panel.window="open = true" 
        x-on:close-login-panel.window="open = false">

        <div x-cloak x-show="open" class="fixed inset-0 bg-gray-800/80 transition-opacity" aria-hidden="true"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <div x-cloak x-show="open" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full justify-center p-4 text-center items-center sm:p-0">

                <div x-data="{ tab: $wire.entangle('tab').live }"
                    class="relative transform overflow-x-hidden overflow-y-auto rounded-lg bg-white px-4 
                    pb-4 pt-5 text-left shadow-xl transition-all my-8 w-full sm:max-w-lg sm:p-6"
                    style="max-height: 80vh; scrollbar-width: thin">

                    {{-- Panel Tabs --}}
                    <div class="mb-6 no-select">
                        <div>
                            <div class="border-b border-gray-200">
                                <ul class="-mb-px flex" aria-label="Tabs">

                                    <li @click="tab = 'login'"
                                        class="w-1/2 border-b-2 rounded-t-md px-1 py-3 text-center text-sm font-medium cursor-pointer"
                                        :class="tab == 'login' ?
                                            'text-{{ tenant('color') }}-600 border-{{ tenant('color') }}-600 hover:text-{{ tenant('color') }}-700 bg-{{ tenant('color') }}-50' :
                                            'text-gray-500 hover:border-gray-300 hover:text-gray-700'">
                                        Ingresar
                                    </li>

                                    <li @click="tab = 'register'"
                                        class="w-1/2 border-b-2 rounded-t-md px-1 py-3 text-center text-sm font-medium cursor-pointer"
                                        :class="tab == 'register' ?
                                            'text-{{ tenant('color') }}-600 border-{{ tenant('color') }}-600 hover:text-{{ tenant('color') }}-700 bg-{{ tenant('color') }}-50' :
                                            'text-gray-500 hover:border-gray-300 hover:text-gray-700'">
                                        Registrarme
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div x-show="tab == 'login'" x-cloak 
                    x-transition:enter="animate__animated animate__fadeIn animate__fast">

                        <div>

                            {{-- Social Login - See later
                            <div class="flex items-center justify-center gap-4 flex-wrap">

                                <button x-tooltip.raw="Iniciar sesión con Google" type="button" 
                                class="flex text-sm items-center justify-center py-2.5 px-4 
                                shadow rounded-lg text-gray-600 bg-white hover:shadow-md
                                transition-colors duration-300 hover:bg-gray-50 
                                hover:text-gray-800 focus:outline-none">
                                    <svg aria-hidden="true" class="native svg-icon iconGoogle" width="18" height="18" viewBox="0 0 18 18">
                                        <path fill="#4285F4" d="M16.51 8H8.98v3h4.3c-.18 1-.74 1.48-1.6 2.04v2.01h2.6a7.8 7.8 0 0 0 2.38-5.88c0-.57-.05-.66-.15-1.18">
                                        </path>
                                        <path fill="#34A853" d="M8.98 17c2.16 0 3.97-.72 5.3-1.94l-2.6-2a4.8 4.8 0 0 1-7.18-2.54H1.83v2.07A8 8 0 0 0 8.98 17"></path><path fill="#FBBC05" d="M4.5 10.52a4.8 4.8 0 0 1 0-3.04V5.41H1.83a8 8 0 0 0 0 7.18z"></path><path fill="#EA4335" d="M8.98 4.18c1.17 0 2.23.4 3.06 1.2l2.3-2.3A8 8 0 0 0 1.83 5.4L4.5 7.49a4.8 4.8 0 0 1 4.48-3.3">
                                        </path>
                                    </svg>
                                </button>
    
                                <button x-tooltip.raw="Iniciar sesión con Facebook" type="button" 
                                class="flex text-sm items-center justify-center py-2.5 px-4 
                                shadow rounded-lg text-gray-600 bg-white hover:shadow-md
                                transition-colors duration-300 hover:bg-gray-50 
                                hover:text-gray-800 focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" fill="#007bff"
                                        viewBox="0 0 167.657 167.657">
                                        <path
                                            d="M83.829.349C37.532.349 0 37.881 0 84.178c0 41.523 30.222 75.911 69.848 82.57v-65.081H49.626v-23.42h20.222V60.978c0-20.037 12.238-30.956 30.115-30.956 8.562 0 15.92.638 18.056.919v20.944l-12.399.006c-9.72 0-11.594 4.618-11.594 11.397v14.947h23.193l-3.025 23.42H94.026v65.653c41.476-5.048 73.631-40.312 73.631-83.154 0-46.273-37.532-83.805-83.828-83.805z"
                                            data-original="#010002"></path>
                                    </svg>
                                    
                                </button>
                            </div> --}}
    
                            <div class="mt-4">
                                <div class="col-span-full sm:col-span-8">
                                    <label for="login_email" class="block text-sm font-medium text-gray-700">
                                        Email
                                    </label>
                                    <div class="mt-1">
                                        <input type="email" id="login_email"
                                            class="block w-full rounded-md border-gray-300 shadow-sm 
                                        focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm">
                                    </div>
                                </div>
                            </div>
    
                            <div class="mt-4">
                                <div class="col-span-full sm:col-span-8">
                                    <label for="login_password" class="block text-sm font-medium text-gray-700">
                                        Contraseña
                                    </label>
                                    <div class="mt-1">
                                        <input type="password" id="login_password"
                                            class="block w-full rounded-md border-gray-300 shadow-sm 
                                        focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm">
                                    </div>
                                </div>
                            </div>
    
                            <div class="mt-4 flex justify-between items-end gap-4 flex-wrap">
                                <div class="flex items-start">

                                    <div class="flex items-center h-5">
                                        <input id="remember" aria-describedby="remember" type="checkbox" 
                                        class="bg-gray-50 border border-gray-300 focus:ring-3 focus:ring-blue-300 
                                        h-4 w-4 rounded dark:bg-gray-600">
                                    </div>

                                    <div class="text-sm ml-2">
                                        <label for="remember" class="font-medium text-gray-900 text-xs">
                                            Recordarme
                                        </label>
                                    </div>
                                </div>
                                <a href="https://google.com" target="_blank" class="text-xs text-blue-700 hover:underline">
                                    Olvidé mi contraseña
                                </a>
                            </div>
    
                            <div class="mt-8 grid grid-flow-row-dense grid-cols-2 gap-3">
                                <x-button @click="open = false" size="large" type="secondary">Cancelar</x-button>
                                <x-button size="large">Ingresar</x-button>
                            </div>
                        </div>

                    </div>

                    <div x-show="tab == 'register'" x-cloak 
                    x-transition:enter="animate__animated animate__fadeIn animate__fast">

                        <div class="grid grid-cols-12 gap-x-4 gap-y-6">

                            <div class="col-span-6">

                                <label for="register_name" class="block text-xs sm:text-sm 
                                font-medium text-gray-700">
                                    Nombre
                                </label>

                                <div class="mt-1">
                                    <input type="text" id="register_name"
                                    wire:model.blur='form.register_name'
                                    class="block w-full rounded-md border-gray-300 shadow-sm 
                                    focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm">
                                </div>

                                @error('form.register_name')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-span-6">

                                <label for="register_lastname" class="block text-xs sm:text-sm 
                                font-medium text-gray-700">
                                    Apellido
                                </label>

                                <div class="mt-1">
                                    <input type="text" id="register_lastname"
                                    wire:model.blur='form.register_lastname'
                                    class="block w-full rounded-md border-gray-300 shadow-sm 
                                    focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm">
                                </div>

                                @error('form.register_lastname')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-span-full">

                                <label for="register_email" class="block text-xs sm:text-sm 
                                font-medium text-gray-700">
                                    Email
                                </label>

                                <div class="mt-1">
                                    <input type="email" id="register_email"
                                    wire:model.blur='form.register_email'
                                    class="block w-full rounded-md border-gray-300 shadow-sm 
                                    focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm">
                                </div>

                                @error('form.register_email')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror

                            </div>

                            <div class="col-span-full sm:col-span-6">

                                <label for="register_password" class="block text-xs sm:text-sm 
                                font-medium text-gray-700">
                                    Contraseña
                                </label>

                                <div class="mt-1">
                                    <input type="password" id="register_password"
                                    wire:model.blur='form.register_password'
                                    class="block w-full rounded-md border-gray-300 shadow-sm 
                                    focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm">
                                </div>

                                @if (!$errors->first('form.register_password') && empty($form->register_password))
                                    <small class="text-gray-500 text-xs">
                                        Debe contener 8 caracteres como mínimo y una letra mayúscula
                                    </small>    
                                @endif

                                @error('form.register_password')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror

                            </div>

                            <div class="col-span-full sm:col-span-6">

                                <label for="register_repeat_password" class="block text-xs sm:text-sm 
                                font-medium text-gray-700">
                                    Repetir Contraseña
                                </label>

                                <div class="mt-1">
                                    <input type="password" id="register_repeat_password"
                                    wire:model.blur='form.register_password_repeat'
                                    class="block w-full rounded-md border-gray-300 shadow-sm 
                                    focus:border-blue-500 focus:ring-blue-500 text-xs sm:text-sm">
                                </div>

                                @error('form.register_password_repeat')
                                    <small class="text-red-500 text-xs">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-span-full flex gap-4 justify-between flex-wrap">

                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="newsletter_check" wire:model.blur='form.register_newsletter_check'
                                        aria-describedby="remember" type="checkbox" 
                                        class="bg-gray-50 border border-gray-300 focus:ring-3 focus:ring-blue-300 
                                        h-4 w-4 rounded dark:bg-gray-600">

                                        <label for="newsletter_check" class="font-medium text-gray-900 
                                        text-xs ml-2">
                                            Deseo recibir novedades y promociones
                                        </label>
                                    </div>
                                </div>

                                <button @click="tab = 'login'" type="button" class="text-xs text-blue-700 hover:underline">
                                    Ya tengo una cuenta
                                </button>
                            </div>
                        </div>

                        <div class="mt-8 grid grid-flow-row-dense grid-cols-2 gap-3">
                            <x-button @click="open = false" size="large" type="secondary">Cancelar</x-button>
                            <x-button wire:click='register' size="large">Registrarme</x-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
