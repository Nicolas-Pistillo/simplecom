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
                    transition-all sm:my-8 w-full p-6 
                    {{  
                        $currentStep != 'welcome'
                        ? 'sm:max-w-2xl lg:max-w-4xl'
                        : 'sm:max-w-lg'
                    }}
                    ">

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
                        <h4>PASO 1</h4>
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
    
                            <form>
                                <div class="space-y-12">
                                    <div class="border-b border-gray-900/10 pb-12">
                                        <h2 class="text-base font-semibold leading-7 text-gray-900">Profile</h2>
                                        <p class="mt-1 text-sm leading-6 text-gray-600">This information will be displayed
                                            publicly so be careful what you share.</p>
    
                                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                            <div class="sm:col-span-4">
                                                <label for="username"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Username</label>
                                                <div class="mt-2">
                                                    <div
                                                        class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                                        <span
                                                            class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">workcation.com/</span>
                                                        <input type="text" name="username" id="username"
                                                            autocomplete="username"
                                                            class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                            placeholder="janesmith">
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="col-span-full">
                                                <label for="about"
                                                    class="block text-sm font-medium leading-6 text-gray-900">About</label>
                                                <div class="mt-2">
                                                    <textarea id="about" name="about" rows="3"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                                </div>
                                                <p class="mt-3 text-sm leading-6 text-gray-600">Write a few sentences about
                                                    yourself.</p>
                                            </div>
    
                                            <div class="col-span-full">
                                                <label for="photo"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Photo</label>
                                                <div class="mt-2 flex items-center gap-x-3">
                                                    <svg class="h-12 w-12 text-gray-300" viewBox="0 0 24 24"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd"
                                                            d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <button type="button"
                                                        class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Change</button>
                                                </div>
                                            </div>
    
                                            <div class="col-span-full">
                                                <label for="cover-photo"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Cover
                                                    photo</label>
                                                <div
                                                    class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                                    <div class="text-center">
                                                        <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24"
                                                            fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                                            <label for="file-upload"
                                                                class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                                <span>Upload a file</span>
                                                                <input id="file-upload" name="file-upload" type="file"
                                                                    class="sr-only">
                                                            </label>
                                                            <p class="pl-1">or drag and drop</p>
                                                        </div>
                                                        <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="border-b border-gray-900/10 pb-12">
                                        <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information
                                        </h2>
                                        <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address where you
                                            can receive mail.</p>
    
                                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                            <div class="sm:col-span-3">
                                                <label for="first-name"
                                                    class="block text-sm font-medium leading-6 text-gray-900">First
                                                    name</label>
                                                <div class="mt-2">
                                                    <input type="text" name="first-name" id="first-name"
                                                        autocomplete="given-name"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                            </div>
    
                                            <div class="sm:col-span-3">
                                                <label for="last-name"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Last
                                                    name</label>
                                                <div class="mt-2">
                                                    <input type="text" name="last-name" id="last-name"
                                                        autocomplete="family-name"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                            </div>
    
                                            <div class="sm:col-span-4">
                                                <label for="email"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Email
                                                    address</label>
                                                <div class="mt-2">
                                                    <input id="email" name="email" type="email"
                                                        autocomplete="email"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                            </div>
    
                                            <div class="sm:col-span-3">
                                                <label for="country"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Country</label>
                                                <div class="mt-2">
                                                    <select id="country" name="country" autocomplete="country-name"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                                        <option>United States</option>
                                                        <option>Canada</option>
                                                        <option>Mexico</option>
                                                    </select>
                                                </div>
                                            </div>
    
                                            <div class="col-span-full">
                                                <label for="street-address"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Street
                                                    address</label>
                                                <div class="mt-2">
                                                    <input type="text" name="street-address" id="street-address"
                                                        autocomplete="street-address"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                            </div>
    
                                            <div class="sm:col-span-2 sm:col-start-1">
                                                <label for="city"
                                                    class="block text-sm font-medium leading-6 text-gray-900">City</label>
                                                <div class="mt-2">
                                                    <input type="text" name="city" id="city"
                                                        autocomplete="address-level2"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                            </div>
    
                                            <div class="sm:col-span-2">
                                                <label for="region"
                                                    class="block text-sm font-medium leading-6 text-gray-900">State /
                                                    Province</label>
                                                <div class="mt-2">
                                                    <input type="text" name="region" id="region"
                                                        autocomplete="address-level1"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                            </div>
    
                                            <div class="sm:col-span-2">
                                                <label for="postal-code"
                                                    class="block text-sm font-medium leading-6 text-gray-900">ZIP / Postal
                                                    code</label>
                                                <div class="mt-2">
                                                    <input type="text" name="postal-code" id="postal-code"
                                                        autocomplete="postal-code"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="border-b border-gray-900/10 pb-12">
                                        <h2 class="text-base font-semibold leading-7 text-gray-900">Notifications</h2>
                                        <p class="mt-1 text-sm leading-6 text-gray-600">We'll always let you know about
                                            important changes, but you pick what else you want to hear about.</p>
    
                                        <div class="mt-10 space-y-10">
                                            <fieldset>
                                                <legend class="text-sm font-semibold leading-6 text-gray-900">By Email
                                                </legend>
                                                <div class="mt-6 space-y-6">
                                                    <div class="relative flex gap-x-3">
                                                        <div class="flex h-6 items-center">
                                                            <input id="comments" name="comments" type="checkbox"
                                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                        </div>
                                                        <div class="text-sm leading-6">
                                                            <label for="comments"
                                                                class="font-medium text-gray-900">Comments</label>
                                                            <p class="text-gray-500">Get notified when someones posts a
                                                                comment on a posting.</p>
                                                        </div>
                                                    </div>
                                                    <div class="relative flex gap-x-3">
                                                        <div class="flex h-6 items-center">
                                                            <input id="candidates" name="candidates" type="checkbox"
                                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                        </div>
                                                        <div class="text-sm leading-6">
                                                            <label for="candidates"
                                                                class="font-medium text-gray-900">Candidates</label>
                                                            <p class="text-gray-500">Get notified when a candidate applies
                                                                for a job.</p>
                                                        </div>
                                                    </div>
                                                    <div class="relative flex gap-x-3">
                                                        <div class="flex h-6 items-center">
                                                            <input id="offers" name="offers" type="checkbox"
                                                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                        </div>
                                                        <div class="text-sm leading-6">
                                                            <label for="offers"
                                                                class="font-medium text-gray-900">Offers</label>
                                                            <p class="text-gray-500">Get notified when a candidate accepts
                                                                or rejects an offer.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <legend class="text-sm font-semibold leading-6 text-gray-900">Push
                                                    Notifications</legend>
                                                <p class="mt-1 text-sm leading-6 text-gray-600">These are delivered via SMS
                                                    to your mobile phone.</p>
                                                <div class="mt-6 space-y-6">
                                                    <div class="flex items-center gap-x-3">
                                                        <input id="push-everything" name="push-notifications"
                                                            type="radio"
                                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                        <label for="push-everything"
                                                            class="block text-sm font-medium leading-6 text-gray-900">Everything</label>
                                                    </div>
                                                    <div class="flex items-center gap-x-3">
                                                        <input id="push-email" name="push-notifications" type="radio"
                                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                        <label for="push-email"
                                                            class="block text-sm font-medium leading-6 text-gray-900">Same
                                                            as email</label>
                                                    </div>
                                                    <div class="flex items-center gap-x-3">
                                                        <input id="push-nothing" name="push-notifications" type="radio"
                                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                                        <label for="push-nothing"
                                                            class="block text-sm font-medium leading-6 text-gray-900">No
                                                            push notifications</label>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <button type="button"
                                        class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                                    <button type="submit"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                                </div>
                            </form>
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
