@extends('layouts.dashboards.admin')

@section('title', 'Productos - Nuevo')

@section('content')

    <div class="grid grid-cols-1 gap-x-8 gap-y-10 pb-12 md:grid-cols-3">

        <div>
            <x-button href="{{ route('admin.products.index') }}" type="secondary" class="inline-flex items-center">
                <x-icon code="arrow_back" class="mr-1" />
                Volver al listado
            </x-button>
        </div>

        <h2
            class="text-2xl col-span-2 text-center md:text-left font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
            Nuevo producto
        </h2>
    </div>

    <form>
        <div class="space-y-12">

            {{-- Identification info block --}}
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">

                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Identificación</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        Datos que representan las referencias y relaciones básicas de tu producto.
                    </p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                    {{-- Name field --}}
                    <div class="sm:col-span-3">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">
                            Nombre <sup class="text-red-500 -ml-1">*</sup>
                        </label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                                <input autocomplete="no" type="text" name="name" id="name" required
                                    value="{{ old('name') }}"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>

                    {{-- Code field --}}
                    <div class="sm:col-span-3">
                        <label for="code" class="block text-sm font-medium leading-6 text-gray-900">
                            Código/SKU
                        </label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                                <input autocomplete="no" type="text" name="code" id="code"
                                    value="{{ old('code') }}"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>

                    {{-- Category field --}}
                    <div class="sm:col-span-5">
                        <label for="category_id" class="block text-sm font-medium leading-6 text-gray-900">
                            Categoría <sup class="text-red-500 -ml-1">*</sup>
                        </label>
                        <div class="mt-2">
                            <select id="category_id" name="category_id" required
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                                shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 
                                focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">

                                <option>Seleccionar una categoría...</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>

                                    @if ($category->hasChilds())
                                        @foreach ($category->childs as $categoryChild)
                                            <option value="{{ $categoryChild->id }}">
                                                {{ $category->name }} > {{ $categoryChild->name }}
                                            </option>

                                            @if ($categoryChild->hasChilds())
                                                @foreach ($categoryChild->childs as $categoryGrandchild)
                                                    <option value="{{ $categoryGrandchild->id }}">
                                                        {{ $category->name }} > {{ $categoryChild->name }} >
                                                        {{ $categoryGrandchild->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Short description field --}}
                    <div class="col-span-full">
                        <label for="short_description" class="block text-sm font-medium leading-6 text-gray-900">Descripción
                            breve</label>
                        <div class="mt-2">
                            <textarea id="short_description" name="short_description" rows="2"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                            focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                {{ old('short_description') }}
                            </textarea>
                        </div>
                        <p class="mt-1 text-xs leading-6 text-gray-500">Debe contener 100 caracteres como máximo</p>
                    </div>

                    {{-- Description field --}}
                    <div class="col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Descripción
                            detallada</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="5"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                            shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                            focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                                {{ old('description') }}
                            </textarea>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Pricing block --}}
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Precio</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        También podes cargar el descuento y configurar las unidades de venta.
                    </p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                    {{-- Price field --}}
                    <div class="sm:col-span-3">
                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">
                            Precio <sup class="text-red-500 -ml-1">*</sup>
                        </label>
                        <div class="mt-2">
                            <div
                                class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                                <input autocomplete="no" type="number" name="price" id="price" required
                                    value="{{ old('price') }}"
                                    class="block flex-1 border-0 bg-transparent py-1.5 px-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>

                    {{-- Discount % field --}}
                    <div class="sm:col-span-3">
                        <label for="discount_percent" class="block text-sm font-medium leading-6 text-gray-900">
                            Porcentaje de descuento
                        </label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-blue-600 sm:max-w-md">
                                <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">%</span>
                                <input type="number" name="discount_percent" max="100" id="discount_percent" 
                                autocomplete="no" value="{{ old('discount_percent') }}"
                                class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>

                    {{-- Min selling field --}}
                    <div class="sm:col-span-3 sm:col-start-1">
                        <label for="min_selling" class="block text-sm font-medium leading-6 text-gray-900">
                            Compra mínima
                        </label>
                        <div class="mt-2">
                            <input type="number" name="min_selling" id="min_selling" autocomplete="no" 
                            value="{{ old('min_selling') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 
                            shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 
                            focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    {{-- Max selling field --}}
                    <div class="sm:col-span-3">
                        <label for="max_selling" class="block text-sm font-medium leading-6 text-gray-900">
                            Compra máxima
                        </label>
                        <div class="mt-2">
                            <input type="number" name="max_selling" id="max_selling" autocomplete="no" 
                            value="{{ old('max_selling') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 
                            placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Measures block --}}
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Dimensiones y stock</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        Las dimensiones físicas del producto son datos necesarios para gestionar el envío del pedido.
                    </p>
                </div>

                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                    {{-- Stock field --}}
                    <div class="sm:col-span-2 sm:col-start-1">
                        <label for="stock" class="block text-sm font-medium leading-6 text-gray-900">Stock</label>
                        <div class="mt-2">
                            <input type="text" name="stock" id="stock" autocomplete="no" 
                            value="{{ old('stock') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                            focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    {{-- Weight field --}}
                    <div class="sm:col-span-2">
                        <label for="weight" class="block text-sm font-medium leading-6 text-gray-900">
                            Peso <x-badge>KG</x-badge>
                        </label>
                        <div class="mt-2">
                            <input type="text" name="weight" id="weight" autocomplete="no"
                            value="{{ old('weight') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                            focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    {{-- Width field --}}
                    <div class="sm:col-span-2 sm:col-start-1">
                        <label for="width" class="block text-sm font-medium leading-6 text-gray-900">
                            Ancho <x-badge>CM</x-badge>
                        </label>
                        <div class="mt-2">
                            <input type="text" name="width" id="width" autocomplete="no"
                            value="{{ old('width') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                            focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    {{-- Height field --}}
                    <div class="sm:col-span-2">
                        <label for="height" class="block text-sm font-medium leading-6 text-gray-900">
                            Alto <x-badge>CM</x-badge>
                        </label>
                        <div class="mt-2">
                            <input type="text" name="height" id="height" autocomplete="no"
                            value="{{ old('height') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                            focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    {{-- Length field --}}
                    <div class="sm:col-span-2">
                        <label for="length" class="block text-sm font-medium leading-6 text-gray-900">
                            Largo <x-badge>CM</x-badge>
                        </label>
                        <div class="mt-2">
                            <input type="text" name="length" id="length" autocomplete="no"
                            value="{{ old('length') }}"
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm 
                            ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 
                            focus:ring-inset focus:ring-blue-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Images block --}}
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 pb-12 md:grid-cols-3">
                <div>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Imagenes</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">We'll always let you know about important changes, but
                        you pick what else you want to hear about.</p>
                </div>

                <div class="max-w-2xl space-y-10 md:col-span-2">

                    <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

                        <div class="sm:col-span-6">

                            

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <x-button submit size="large" class="flex items-center">
                <x-icon code="add_circle" class="mr-1" />
                Crear producto
            </x-button>
        </div>
    </form>

@endsection
