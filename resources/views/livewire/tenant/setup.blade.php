<div>
    <div x-data="{ showSetupModal: false }" x-init="setTimeout(() => showSetupModal = true, 150)" class="relative z-20" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">

        <div x-cloak x-show="showSetupModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 brightness-50 transition-opacity bg-cover bg-bottom"
            style="background-image: url({{ URL::to('img/office-3.jpg') }})"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div x-cloak x-show="showSetupModal" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-lg bg-white px-4 text-left shadow-xl 
                    transition-all sm:my-8 w-full p-6 mx-3
                    {{  $currentStep != 'welcome' ? 'sm:max-w-4xl' : 'sm:max-w-lg' }}">

                    {{-- @dump($currentStep) --}}

                    @if ($currentStep === 'welcome')
                        <div>
                            <div class="mx-auto flex items-center justify-center">
                                <img src="{{ URL::to('img/illustrations/happy_feeling.svg') }}" class="h-24 sm:h-36"
                                    alt="Welcome Illustration">
                            </div>

                            <div class="text-center">
                                <h4 class="my-4 text-2xl sm:text-3xl font-bold tracking-tight text-gray-900">
                                    ¡Bienvenido a Simplecom!
                                </h4>

                                <p class="my-6 text-sm sm:text-base leading-7 text-gray-600">
                                    Gracias por confiar en nosotros, <span
                                        class="text-gray-700 font-semibold">{{ tenant()->ecommerce_name }}</span>. <br>
                                    Es hora de poner en marcha tu gestor de comercio. Para ello es necesario realizar
                                    las configuraciones iniciales para que tu tienda y tu gestor comiencen a operar.
                                </p>

                            </div>
                        </div>

                        <x-button wire:click='beginSetup' type="primary"
                            class="flex items-center justify-center w-full">
                            Comenzar ahora
                            <x-icon code="arrow_forward" class="ml-4" />
                        </x-button>
                    @endif

                    @if ($currentStep === 1)

                        <div class="flex justify-between items-center">
                            <div class="px-4 py-12 sm:px-6 lg:px-8 animate__animated animate__backInUp">
                                <nav class="flex justify-center" aria-label="Progress">
                                    <ol role="list" class="space-y-6">
                                        <li>
                                            <!-- Complete Step -->
                                            <a href="#" class="group">
                                                <span class="flex items-start">
                                                    <span
                                                        class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center">
                                                        <svg class="h-full w-full text-indigo-600 group-hover:text-indigo-800"
                                                            viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                    <span
                                                        class="ml-3 text-sm font-medium text-gray-500 group-hover:text-gray-900">Create
                                                        account</span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <!-- Current Step -->
                                            <a href="#" class="flex items-start" aria-current="step">
                                                <span
                                                    class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center"
                                                    aria-hidden="true">
                                                    <span class="absolute h-4 w-4 rounded-full bg-indigo-200"></span>
                                                    <span class="relative block h-2 w-2 rounded-full bg-indigo-600"></span>
                                                </span>
                                                <span class="ml-3 text-sm font-medium text-indigo-600">Profile
                                                    information</span>
                                            </a>
                                        </li>
                                        <li>
                                            <!-- Upcoming Step -->
                                            <a href="#" class="group">
                                                <div class="flex items-start">
                                                    <div class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center"
                                                        aria-hidden="true">
                                                        <div
                                                            class="h-2 w-2 rounded-full bg-gray-300 group-hover:bg-gray-400">
                                                        </div>
                                                    </div>
                                                    <p
                                                        class="ml-3 text-sm font-medium text-gray-500 group-hover:text-gray-900">
                                                        Theme</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <!-- Upcoming Step -->
                                            <a href="#" class="group">
                                                <div class="flex items-start">
                                                    <div class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center"
                                                        aria-hidden="true">
                                                        <div
                                                            class="h-2 w-2 rounded-full bg-gray-300 group-hover:bg-gray-400">
                                                        </div>
                                                    </div>
                                                    <p
                                                        class="ml-3 text-sm font-medium text-gray-500 group-hover:text-gray-900">
                                                        Preview</p>
                                                </div>
                                            </a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
    
                            <div class="px-4 py-6 sm:p-8">
                                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    
                                    <x-input class="sm:col-span-3" placeholder="Sólo minusculas y sin espacios" 
                                    error="{{ $errors->first('name') }}" name="name" label="Subdominio" 
                                    value="{{ old('name') }}" />
            
                                    <x-input class="sm:col-span-3" placeholder="Por ejemplo: Distribuidora Martinez" 
                                    label="Nombre del comercio" name="ecommerce_name" error="{{ $errors->first('ecommerce_name') }}" 
                                    value="{!! old('ecommerce_name') !!}" />
            
                                    <hr class="w-full sm:col-span-6">
            
                                    <h4 class="sm:col-span-6 flex items-center text-sm text-gray-700">
                                        Cuenta del administrador principal
                                        <x-icon data-tooltip-target="admin-account-help" 
                                        code="help" class="ml-1 text-blue-600" style="font-size: 20px" />
                                        <x-tooltip id="admin-account-help">
                                            Será el encargado de iniciar sesión por primera vez como administrador del comercio, <br> 
                                            también controlara los roles e información de los demás tipos de administradores
                                        </x-tooltip>
                                    </h4>
            
                                    <x-input type="email" class="sm:col-span-3 border-none p-0"
                                    error="{{ $errors->first('admin_email') }}" name="admin_email" label="Email administrador" 
                                    value="{{ old('admin_email') }}" />
            
                                    <x-input type="password" class="sm:col-span-3 border-none p-0" placeholder="Luego se le pedira cambiarla por seguridad"
                                    label="Contraseña administrador" name="admin_password" error="{{ $errors->first('admin_password') }}"
                                    value="{{ old('admin_password') }}" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end border-t border-gray-200 pt-4">
                            <x-button wire:click="submitFirstStep" type="primary"
                                class="flex items-center justify-center w-1/2">
                                Siguiente
                                <x-icon code="arrow_forward" class="ml-4" />
                            </x-button>
                        </div>
                    @endif

                    @if ($currentStep === 2)
                        <h4>PASO 2</h4>
                        <div class="px-4 py-12 sm:px-6 lg:px-8">
                            <nav class="flex justify-center" aria-label="Progress">
                                <ol role="list" class="space-y-6">
                                    <li>
                                        <!-- Complete Step -->
                                        <a href="#" class="group">
                                            <span class="flex items-start">
                                                <span
                                                    class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center">
                                                    <svg class="h-full w-full text-indigo-600 group-hover:text-indigo-800"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span
                                                    class="ml-3 text-sm font-medium text-gray-500 group-hover:text-gray-900">Create
                                                    account</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <!-- Current Step -->
                                        <a href="#" class="flex items-start" aria-current="step">
                                            <span
                                                class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center"
                                                aria-hidden="true">
                                                <span class="absolute h-4 w-4 rounded-full bg-indigo-200"></span>
                                                <span class="relative block h-2 w-2 rounded-full bg-indigo-600"></span>
                                            </span>
                                            <span class="ml-3 text-sm font-medium text-indigo-600">Profile
                                                information</span>
                                        </a>
                                    </li>
                                    <li>
                                        <!-- Upcoming Step -->
                                        <a href="#" class="group">
                                            <div class="flex items-start">
                                                <div class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center"
                                                    aria-hidden="true">
                                                    <div
                                                        class="h-2 w-2 rounded-full bg-gray-300 group-hover:bg-gray-400">
                                                    </div>
                                                </div>
                                                <p
                                                    class="ml-3 text-sm font-medium text-gray-500 group-hover:text-gray-900">
                                                    Theme</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <!-- Upcoming Step -->
                                        <a href="#" class="group">
                                            <div class="flex items-start">
                                                <div class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center"
                                                    aria-hidden="true">
                                                    <div
                                                        class="h-2 w-2 rounded-full bg-gray-300 group-hover:bg-gray-400">
                                                    </div>
                                                </div>
                                                <p
                                                    class="ml-3 text-sm font-medium text-gray-500 group-hover:text-gray-900">
                                                    Preview</p>
                                            </div>
                                        </a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="mt-6 grid grid-flow-row-dense grid-cols-2 gap-3 border-t border-gray-200 pt-4">
                            <x-button wire:click='previousStep' type="secondary"
                                class="flex items-center justify-center">
                                <x-icon code="arrow_back" class="mr-4" />
                                Anterior
                            </x-button>

                            <x-button wire:click="submitSecondStep" type="primary"
                                class="flex items-center justify-center">
                                Siguiente
                                <x-icon code="arrow_forward" class="ml-4" />
                            </x-button>
                        </div>
                    @endif

                    @if ($currentStep === 3)
                        <h4>PASO 3</h4>
                        <div class="px-4 py-12 sm:px-6 lg:px-8">
                            <nav class="flex justify-center" aria-label="Progress">
                                <ol role="list" class="space-y-6">
                                    <li>
                                        <!-- Complete Step -->
                                        <a href="#" class="group">
                                            <span class="flex items-start">
                                                <span
                                                    class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center">
                                                    <svg class="h-full w-full text-indigo-600 group-hover:text-indigo-800"
                                                        viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span
                                                    class="ml-3 text-sm font-medium text-gray-500 group-hover:text-gray-900">Create
                                                    account</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <!-- Current Step -->
                                        <a href="#" class="flex items-start" aria-current="step">
                                            <span
                                                class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center"
                                                aria-hidden="true">
                                                <span class="absolute h-4 w-4 rounded-full bg-indigo-200"></span>
                                                <span class="relative block h-2 w-2 rounded-full bg-indigo-600"></span>
                                            </span>
                                            <span class="ml-3 text-sm font-medium text-indigo-600">Profile
                                                information</span>
                                        </a>
                                    </li>
                                    <li>
                                        <!-- Upcoming Step -->
                                        <a href="#" class="group">
                                            <div class="flex items-start">
                                                <div class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center"
                                                    aria-hidden="true">
                                                    <div
                                                        class="h-2 w-2 rounded-full bg-gray-300 group-hover:bg-gray-400">
                                                    </div>
                                                </div>
                                                <p
                                                    class="ml-3 text-sm font-medium text-gray-500 group-hover:text-gray-900">
                                                    Theme</p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <!-- Upcoming Step -->
                                        <a href="#" class="group">
                                            <div class="flex items-start">
                                                <div class="relative flex h-5 w-5 flex-shrink-0 items-center justify-center"
                                                    aria-hidden="true">
                                                    <div
                                                        class="h-2 w-2 rounded-full bg-gray-300 group-hover:bg-gray-400">
                                                    </div>
                                                </div>
                                                <p
                                                    class="ml-3 text-sm font-medium text-gray-500 group-hover:text-gray-900">
                                                    Preview</p>
                                            </div>
                                        </a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="mt-6 grid grid-flow-row-dense grid-cols-2 gap-3 border-t border-gray-200 pt-4">
                            <x-button wire:click='previousStep' type="secondary"
                                class="flex items-center justify-center">
                                <x-icon code="arrow_back" class="mr-4" />
                                Anterior
                            </x-button>

                            <x-button wire:click="submitThirdStep" type="primary"
                                class="flex items-center justify-center">
                                Finalizar
                                <x-icon code="done" class="ml-4" />
                            </x-button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
