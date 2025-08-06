@extends('layouts.dashboards.admin')

@section('title', 'Contenidos')

@section('content')

    <div class="bg-white py-10">
        <div class="mx-auto max-w-7xl lg:px-8">
            <div class="mx-auto max-w-2xl lg:max-w-none">
                <div class="text-center">
                    <h2 class="text-4xl font-semibold tracking-tight text-balance text-gray-900 sm:text-5xl">
                        Personaliza tu tienda
                    </h2>
                    <p class="mt-4 text-lg/8 text-gray-600">
                        Dale tu toque personal a tu tienda editando tus propios contenidos
                    </p>
                </div>
                <dl class="mt-16 grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-4">

                    <a href="{{ route('admin.contents.banners') }}" class="flex flex-col bg-gray-400/5 p-8 cursor-pointer 
                    transition-colors duration-300 hover:bg-blue-600 hover:text-white">
                        <dt class="text-sm/6 font-semibold">
                            Banners
                        </dt>
                        <dd class="order-first font-semibold tracking-tight">
                            <x-icon code="burst_mode" class="text-5xl" />
                        </dd>
                    </a>

                    <div class="flex flex-col bg-gray-400/5 p-8 cursor-pointer 
                        transition-colors duration-300 hover:bg-blue-600 hover:text-white">
                        <dt class="text-sm/6 font-semibold">
                            Mensaje Promocional
                        </dt>
                        <dd class="order-first font-semibold tracking-tight">
                            <x-icon code="subheader" class="text-5xl" />
                        </dd>
                    </div>

                    <div class="flex flex-col bg-gray-400/5 p-8 cursor-pointer 
                        transition-colors duration-300 hover:bg-blue-600 hover:text-white">
                        <dt class="text-sm/6 font-semibold">
                            Preguntas Frecuentes
                        </dt>
                        <dd class="order-first font-semibold tracking-tight">
                            <x-icon code="help" class="text-5xl" />
                        </dd>
                    </div>

                    <div class="flex flex-col bg-gray-400/5 p-8 cursor-pointer 
                        transition-colors duration-300 hover:bg-blue-600 hover:text-white">
                        <dt class="text-sm/6 font-semibold">
                            Newsletter
                        </dt>
                        <dd class="order-first font-semibold tracking-tight">
                            <x-icon code="campaign" class="text-5xl" />
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

@endsection
