@extends('layouts.basic')

@section('head')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.2/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
@endsection

@section('content')

    {{-- <div class="flex min-h-screen">
        <div class="animate__animated animate__fadeInLeft relative hidden flex-1 shadow-xl lg:flex items-center">
            <img class="h-full border-r object-cover" 
            src="https://pagedone.io/asset/uploads/1700550217.png">
        </div>
        <div class="flex flex-1 flex-col w-full md:w-[60%] justify-center px-8 py-12 lg:flex-none">
            <div class="mx-auto w-full lg:max-w-lg">

                <img src="{{ URL::to('img/simplecom/png/logo-color-transparent.png') }}" alt="Simplecom logo"
                class="h-36 w-36 mb-14 mx-auto">

                <ul class="relative max-w-lg mx-auto flex flex-col md:flex-row gap-2">

                    <li class="flex flex-col md:flex-row md:items-center gap-x-2 shrink basis-0 flex-1 group">
                        <div class="min-w-7 min-h-7 inline-flex items-center text-xs align-middle grow md:grow-0">
                            <span class="p-2 w-8 h-8 flex justify-center items-center shrink-0 font-semibold rounded-full shadow
                             bg-gray-100 text-gray-800">
                                1
                            </span>
                            <div class="ms-2 block grow md:grow-0 text-sm font-medium whitespace-nowrap text-gray-800">
                                <span class="cursor-pointer" wire:click="setStep(1)">
                                    Identidad
                                </span>
                            </div>
                        </div>
                        <div class="mt-2 w-px h-4 md:mt-0 ms-3.5 md:ms-0 md:w-full md:h-px md:flex-1 group-last:hidden
                         bg-gray-200 ">
                        </div>
                    </li>

                    <li class="flex flex-col md:flex-row md:items-center gap-x-2 shrink basis-0 flex-1 group">
                        <div class="min-w-7 min-h-7 inline-flex items-center text-xs align-middle grow md:grow-0">
                            <span class="p-2 w-8 h-8 flex justify-center items-center shrink-0 font-semibold rounded-full shadow
                             bg-gray-100 text-gray-800">
                                2
                            </span>
                            <div class="ms-2 block grow md:grow-0 text-sm font-medium
                                 text-gray-800 whitespace-nowrap">
                                <span>
                                    Info comercial
                                </span>
                            </div>
                        </div>
                        <div
                            class="mt-2 w-px h-4 md:mt-0 ms-3.5 md:ms-0 md:w-full md:h-px md:flex-1 group-last:hidden
                         bg-gray-200 ">
                        </div>
                    </li>

                    <li class="flex flex-col md:flex-row md:items-center gap-x-2 group">
                        <div class="min-w-7 min-h-7 inline-flex items-center text-xs align-middle grow md:grow-0">
                            <span
                                class="p-2 w-8 h-8 flex justify-center items-center shrink-0 font-semibold rounded-full shadow
                             bg-gray-100 text-gray-800">
                                3
                            </span>
                            <span class="ms-2 block grow md:grow-0 text-sm font-medium text-gray-800">
                                Parámetros
                            </span>
                        </div>
                        <div
                            class="mt-2 w-px h-4 md:mt-0 ms-3.5 md:ms-0 md:w-full md:h-px md:flex-1 bg-gray-200 group-last:hidden">
                        </div>
                    </li>

                </ul>

                <form class="max-w-lg mx-auto mt-14">

                    <div class="relative z-0 w-full mb-5 group">
                        <input type="email" name="floating_email" id="floating_email"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " required />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
                            address</label>
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <input type="password" name="floating_password" id="floating_password"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " required />
                        <label for="floating_password"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <input type="password" name="repeat_password" id="floating_repeat_password"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " required />
                        <label for="floating_repeat_password"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm
                            password</label>
                    </div>

                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="floating_first_name" id="floating_first_name"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " required />
                            <label for="floating_first_name"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">First
                                name</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="floating_last_name" id="floating_last_name"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " required />
                            <label for="floating_last_name"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Last
                                name</label>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="floating_phone"
                                id="floating_phone" value="112233"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " required />
                            <label for="floating_phone"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone
                                number</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="floating_company" id="floating_company"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " required />
                            <label for="floating_company"
                                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Company
                                (Ex. Google)</label>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-8">
                        <x-button type="secondary" size="large" class="flex items-center">
                            <x-icon code="arrow_back" class="mr-1" style="font-size: 18px" />
                            Anterior
                        </x-button>
                        <x-button size="large">Continuar</x-button>
                    </div>
                </form>

            </div>
        </div>
    </div> --}}

    @livewire('admin.setup')

    <div class="fixed bottom-3 left-5 z-20">
        <form method="POST" action="{{ route('admin.logout') }}" 
        class="text-sm font-semibold shadow-lg p-2 rounded-full transition-colors 
        duration-300 leading-7 bg-gray-50 text-black flex items-center hover:bg-gray-200">
            @csrf
            <button type="submit" class="flex items-center">
                Cerrar sesión
                <x-icon code="logout" class="ml-2" />
            </button>
        </form>
    </div>

    {{-- <a href="{{ route('simplecom.landing') }}" target="_blank" 
        class="fixed bottom-3 right-5 z-20">
        <img src="{{ URL::to('img/simplecom/png/logo-color.png') }}" alt="Simplecom logo"
        class="h-20 rounded-full shadow-lg">
    </a> --}}
@endsection
