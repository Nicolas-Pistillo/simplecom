<header x-data="{ mobileMenuOpen: false }" class="sticky top-0 left-0 bg-white z-20 py-2 shadow">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <nav class="relative z-50 flex justify-between">
            <div class="flex items-center md:gap-x-12">

                <a href="#">
                    <img class="h-12 sm:h-16 w-auto" 
                    src="{{ asset('img/simplecom/png/logo-color-transparent.png') }}"
                    alt="Simplecom logo">
                </a>

                <div class="hidden md:flex md:gap-x-6">
                    <a href="#features"
                        class="inline-block rounded-lg px-2 py-1 text-sm 
                        text-slate-700 hover:bg-slate-100 hover:text-slate-900">
                        Características
                    </a>

                    <a href="#benefits"
                        class="inline-block rounded-lg px-2 py-1 text-sm 
                    text-slate-700 hover:bg-slate-100 hover:text-slate-900">
                        Beneficios
                    </a>

                    <a href="#pricing"
                        class="inline-block rounded-lg px-2 py-1 text-sm 
                    text-slate-700 hover:bg-slate-100 hover:text-slate-900">
                        Precio
                    </a>
                </div>
            </div>
            <div class="flex items-center gap-x-5 md:gap-x-8">

                <x-button href="#form" rounded class="!py-2 !px-4">Abrir tienda</x-button>

                <div class="-mr-1 md:hidden flex items-center">
                    <x-icon @click="mobileMenuOpen = true" code="menu" class="cursor-pointer" />
                </div>
            </div>
        </nav>
    </div>

    {{-- MobileMenu --}}
    <x-drawer ref="mobileMenuOpen" panelClass="!w-[250px]">

        <h2 class="text-lg mb-4 font-semibold text-gray-900">Menú</h2>

        <div class="flex flex-col gap-y-2">

            <a href="#features" class="inline-block rounded-lg py-1 text-sm 
            text-blue-700 hover:underline"
            @click="mobileMenuOpen = false">
                Características
            </a>

            <a href="#benefits" class="inline-block rounded-lg py-1 text-sm 
            text-blue-700 hover:underline"
            @click="mobileMenuOpen = false">
                Beneficios
            </a>

            <a href="#pricing" class="inline-block rounded-lg py-1 text-sm 
            text-blue-700 hover:underline"
            @click="mobileMenuOpen = false">
                Precio
            </a>

            <x-button href="#form" rounded @click="mobileMenuOpen = false" 
            class="mt-3 !py-2 !px-4 text-center">Abrir tienda</x-button>
        </div>
    </x-drawer>
</header>
