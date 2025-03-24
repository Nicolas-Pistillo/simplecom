@extends('layouts.ecommerce')

@section('content')
    <div x-data="{ tab: 'information' }" class="bg-white mx-auto max-w-7xl 
    lg:flex lg:gap-x-16 lg:px-8 py-10">

        <aside scrollbar-thin class="flex overflow-x-auto border-b border-gray-900/5 
        lg:block lg:w-64 lg:flex-none lg:border-b-0 mb-8 lg:mb-0 border-r">
            <nav class="flex-none px-4 sm:px-6 lg:px-0">
                <ul role="list" class="flex gap-x-3 gap-y-1 whitespace-nowrap lg:flex-col">

                    <li @click="tab = 'information'" class="cursor-pointer">
                        <span
                            class="group flex items-center gap-x-3 transition duration-200
                        py-2 pl-2 pr-3 text-sm/6 font-semibold text-gray-700
                        rounded-l-none rounded-t-lg lg:rounded-tr-none lg:rounded-l-lg"
                            :class="tab === 'information'
                                ?
                                '!text-blue-600 bg-gray-50' :
                                'hover:bg-gray-50'">
                            <x-icon code="account_circle" class="text-3xl" />
                            Datos personales
                        </span>
                    </li>

                    <li @click="tab = 'addresses'" class="cursor-pointer">
                        <span
                            class="group flex items-center gap-x-3 transition duration-200
                        py-2 pl-2 pr-3 text-sm/6 font-semibold text-gray-700
                        rounded-l-none rounded-t-lg lg:rounded-tr-none lg:rounded-l-lg"
                            :class="tab === 'addresses'
                                ?
                                '!text-blue-600 bg-gray-50' :
                                'hover:bg-gray-50'">
                            <x-icon code="location_on" class="text-3xl" />
                            Direcciones
                        </span>
                    </li>

                    <li @click="tab = 'invoicing'" class="cursor-pointer">
                        <span
                            class="group flex items-center gap-x-3 transition duration-200
                        py-2 pl-2 pr-3 text-sm/6 font-semibold text-gray-700
                        rounded-l-none rounded-t-lg lg:rounded-tr-none lg:rounded-l-lg"
                            :class="tab === 'invoicing'
                                ?
                                '!text-blue-600 bg-gray-50' :
                                'hover:bg-gray-50'">
                            <x-icon code="credit_card" class="text-3xl" />
                            Facturación
                        </span>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="px-4 sm:px-6 lg:flex-auto lg:px-0 min-h-[60vh]">
            <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">

                <div x-cloak x-show="tab === 'information'" x-data="{ open: false }">
                    @livewire('ecommerce.customer.settings.personal-data')
                </div>

                <div x-cloak x-show="tab === 'addresses'">
                    @livewire('ecommerce.customer.settings.addresses')
                </div>

                <div x-cloak x-show="tab === 'invoicing'" x-data="{ open: false }">
                    @livewire('ecommerce.customer.settings.invoicing')
                </div>
            </div>
        </div>
    </div>
@endsection
