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
            <img class="h-full object-contain" 
            src="{{ URL::to('img/illustrations/asset_selection.svg') }}">
        </div>
        <div class="flex flex-1 flex-col w-full md:w-[60%] justify-center px-8 py-12 lg:flex-none">
            <div class="mx-auto w-full">

                <img src="{{ URL::to('img/simplecom/png/logo-color-transparent.png') }}" alt="Simplecom logo"
                class="h-36 w-36 mb-14 mx-auto select-none">

                <ul class="select-none relative max-w-2xl mx-auto flex flex-col md:flex-row gap-2">

                    <li class="flex flex-col md:flex-row md:items-center gap-x-2 shrink basis-0 flex-1 group">
                        <div class="min-w-7 min-h-7 inline-flex items-center text-xs align-middle grow md:grow-0">
                            <span class="p-2 w-8 h-8 flex justify-center items-center shrink-0 font-semibold rounded-full shadow
                            bg-blue-500 text-white">
                                1
                            </span>
                            <div class="ms-2 block grow md:grow-0 text-sm font-medium whitespace-nowrap text-gray-800">
                                <span class="cursor-pointer" wire:click="setStep(1)">
                                    Identidad
                                </span>
                            </div>
                        </div>
                        <div class="mt-2 w-px h-4 md:mt-0 ms-3.5 md:ms-0 md:w-full md:h-px md:flex-1 group-last:hidden
                         bg-gray-200">
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

                <form class="grid sm:grid-cols-6 gap-4 mt-14">

                    <x-form-input label="Email" class="sm:col-span-3" />

                    <x-form-input label="Email" class="sm:col-span-3" />

                    <x-form-input label="Email" class="sm:col-span-3" />

                    <x-form-input label="Email" class="sm:col-span-3" />

                    <x-form-input label="Email" class="sm:col-span-3" />

                    <x-form-input label="Email" class="sm:col-span-3" />

                    <x-form-input label="Email" class="sm:col-span-3" />

                    <x-form-input label="Email" class="sm:col-span-3" />

                    <div class="col-span-full flex items-center justify-between mt-8">
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

    {{-- <div class="fixed bottom-3 left-5 z-20">
        <form method="POST" action="{{ route('admin.logout') }}" 
        class="text-sm font-semibold shadow-lg p-2 rounded-full transition-colors 
        duration-300 leading-7 bg-gray-50 text-black flex items-center hover:bg-gray-200">
            @csrf
            <button type="submit" class="flex items-center">
                Cerrar sesión
                <x-icon code="logout" class="ml-2" />
            </button>
        </form>
    </div> --}}

    {{-- <a href="{{ route('simplecom.landing') }}" target="_blank" 
        class="fixed bottom-3 right-5 z-20">
        <img src="{{ URL::to('img/simplecom/png/logo-color.png') }}" alt="Simplecom logo"
        class="h-20 rounded-full shadow-lg">
    </a> --}}
@endsection
