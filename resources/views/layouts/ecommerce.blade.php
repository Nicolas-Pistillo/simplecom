@php
    $tenantColor = tenant('color');
@endphp

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script async src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_API_KEY') }}&loading=async&libraries=marker&v=beta" defer></script>
    {{-- <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/@ryangjchandler/alpine-tooltip@1.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://unpkg.com/tippy.js@6/dist/tippy.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="shortcut icon" href="{{ URL::to('favicon-store-default.png') }}" type="image/x-icon">
    <title>@yield('title', tenant()->ecommerce_name ?? tenant()->name)</title>
    {{-- <script type="text/javascript">
        (function() {
            var ldk = document.createElement('script');
            ldk.type = 'text/javascript';
            ldk.async = true;
            ldk.src =
                'https://s.cliengo.com/weboptimizer/6744b7d57529db60fe57b09e/6744b7d57529db60fe57b0a1.js?platform=view_installation_code';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ldk, s);
        })();
    </script> --}}
    @yield('head')
</head>

<body>

    @yield('begin-body')

    {{-- Global notification --}}
    @livewire('notification')

    {{-- User Login/Registration panel --}}
    @livewire('ecommerce.login-panel')

    {{-- Welcome message | Login --}}
    @session('login_message')
        <x-toast type="success" position="bottom-center" title="¡Bienvenid@ {{ auth()->user()->name }}!" />
    @endsession

    {{-- Goodbye message | Logout --}}
    @session('logout_message')
        <x-toast icon="waving_hand" position="bottom-center" title="¡Hasta la próxima!" />
    @endsession

    {{-- Login required --}}
    @session('login_required')
        <x-toast icon="lock" position="bottom-center" title="Inicia sesión o registrate para continuar" />
    @endsession

    {{-- New Address Panel --}}
    @livewire('ecommerce.new-address-panel')

    {{-- Navbar --}}
    <div class="bg-white fixed w-full shadow-md z-10" x-data="{ mobileMenuOpen: false, cartMenuOpen: false }"
        x-on:open-cart-panel.window="cartMenuOpen = true">

        {{-- Mobile Menu --}}
        @include('ecommerce.partials.mobile-menu')

        {{-- Navbar --}}
        @include('ecommerce.partials.navbar')

        {{-- Breakig News Banner --}}
        <!--
        Make sure you add some bottom padding to pages that include a sticky banner like this to prevent
        your content from being obscured when the user scrolls to the bottom of the page.
        -->
        {{-- <div class="fixed inset-x-0 bottom-0 sm:px-6 sm:pb-5 lg:px-8 animate__animated animate__fadeInUp">
            <div
                class="pointer-events-auto flex items-center justify-between gap-x-6 bg-gray-900 px-6 py-2.5 sm:rounded-xl sm:py-3 sm:pl-4 sm:pr-3.5">
                <p class="text-sm/6 text-white">
                    <a href="#">
                        <strong class="font-semibold">GeneriCon 2023</strong>Join us in Denver from June 7 – 9 to see
                        what’s coming next&nbsp;<span aria-hidden="true">&rarr;</span>
                    </a>
                </p>
                <x-icon code="close" class="text-white text-[16px] cursor-pointer" />
            </div>
        </div> --}}

        {{-- <div class="pointer-events-none animate__animated animate__fadeInUp fixed inset-x-0 bottom-0 sm:px-6 sm:pb-5 lg:px-8">
            <div class="relative isolate overflow-hidden sm:rounded-lg bg-white px-6 py-2.5 sm:px-3.5 shadow-lg">
                <div class="absolute left-[max(-7rem,calc(50%-52rem))] top-1/2 -translate-y-1/2 transform-gpu blur-2xl" aria-hidden="true">
                    <div class="aspect-[577/310] w-[36.0625rem] bg-gradient-to-r from-[#ff80b5] to-[#9089fc] opacity-30" style="clip-path: polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%)"></div>
                </div>
                <div class="absolute left-[max(45rem,calc(50%+8rem))] top-1/2 -translate-y-1/2 transform-gpu blur-2xl" aria-hidden="true">
                    <div class="aspect-[577/310] w-[36.0625rem] bg-gradient-to-r from-[#ff80b5] to-[#9089fc] opacity-30" style="clip-path: polygon(74.8% 41.9%, 97.2% 73.2%, 100% 34.9%, 92.5% 0.4%, 87.5% 0%, 75% 28.6%, 58.5% 54.6%, 50.1% 56.8%, 46.9% 44%, 48.3% 17.4%, 24.7% 53.9%, 0% 27.9%, 11.9% 74.2%, 24.9% 54.1%, 68.6% 100%, 74.8% 41.9%)"></div>
                </div>
                <div class="flex items-center gap-x-6 justify-between">
                    <p class="text-sm/6">
                        <a href="#">
                            <strong class="font-semibold">GeneriCon 2023</strong>Join us in Denver from June 7 – 9 to see what’s coming next&nbsp;<span aria-hidden="true">&rarr;</span>
                        </a>
                    </p>
                    <x-icon code="close" class="text-[16px]" />
                </div>
            </div>
        </div> --}}

        <!-- Cart Drawer -->
        @livewire('ecommerce.cart-panel')

    </div>

    <div style="padding-top: 6.5rem" class="bg-gray-50"></div>

    {{-- Page main content --}}
    <main class="bg-gray-50">
        @yield('content')
    </main>

    {{-- Cookies advicement --}}
    {{-- <div x-data="{open: true}" x-show="open"
    class="animate__animated animate__bounceInLeft pointer-events-none fixed z-10 inset-x-0 bottom-0 px-6 pb-6">
        <div class="pointer-events-auto max-w-xl rounded-xl bg-white p-6 shadow-lg ring-1 ring-gray-900/10">
          <p class="text-sm leading-6 text-gray-900">This website uses cookies to supplement a balanced diet and provide a much deserved reward to the senses after consuming bland but nutritious meals. Accepting our cookies is optional but recommended, as they are delicious. See our <a href="#" class="font-semibold text-indigo-600">cookie policy</a>.</p>
          <div class="mt-4 flex items-center gap-x-3">
            <x-button @click="open = false" type="primary">Aceptar</x-button>
            <x-button @click="open = false" type="secondary">Rechazar</x-button>
          </div>
        </div>
    </div> --}}

    {{-- Newsletter --}}
    <div class="bg-{{ tenant('color') }}-600 py-16">
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-6 px-6 lg:grid-cols-12 lg:gap-8 lg:px-8">
            <div class="max-w-xl text-2xl font-bold tracking-tight text-white sm:text-4xl lg:col-span-7">
                <h2 class="inline mb-2 sm:block lg:inline xl:block">No te pierdas ninguna novedad.</h2>
                <p class="inline sm:block lg:inline xl:block">Suscribite a nuestro newsletter</p>
            </div>
            <form class="w-full max-w-md lg:col-span-5 lg:pt-2">
                <div class="flex gap-x-4 mb-2">
                    <label for="email-address" class="sr-only">Email address</label>
                    <input id="email-address" name="newsletter_email" type="email" required
                        class="min-w-0 flex-auto rounded-md border-0 px-3.5 py-2 shadow-sm ring-1 ring-inset text-sm sm:leading-6"
                        placeholder="Ingresa tu correo aquí">
                    <button type="submit"
                        class="flex-none rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Suscribirme</button>
                </div>
                <p class="text-xs text-gray-200">
                    Tus datos se mantienen confidenciales con nosotros. Puedes revisar nuestro
                    <a href="#" class="font-semibold text-white hover:underline">acuerdo de privacidad</a>.
                </p>
            </form>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-white border-t border-gray-900/10" aria-labelledby="footer-heading">
        <h2 id="footer-heading" class="sr-only">Footer</h2>
        <div class="mx-auto max-w-7xl px-6 pb-8 pt-16 lg:px-8">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                <div class="space-y-4">
                    <img class="h-20 w-64 object-contain object-left" src="{{ Storage::url(tenant('logo_url')) }}"
                        alt="{{ tenant('name') }} logo">
                    {{-- <p class="text-sm leading-6 text-gray-600">Making the world a better place through constructing
                        elegant hierarchies.</p> --}}
                    <div class="flex space-x-6">

                        @config('ecommerce_facebook')
                            <a href="{{ $value }}" target="_blank" title="Facebook"
                                class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477
                                        2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506
                                        1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63
                                        1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endconfig

                        @config('ecommerce_instagram')
                            <a href="{{ $value }}" target="_blank" title="Instagram"
                                class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218
                                            2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153
                                            1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06
                                            4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218
                                            1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902
                                            0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643
                                            0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153
                                            4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902
                                            4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013
                                            9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748
                                            1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058
                                            3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3
                                            1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207
                                            1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097
                                            3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12
                                            6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333
                                            3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endconfig

                        @config('ecommerce_tiktok')
                            <a href="{{ $value }}" target="_blank" title="TikTok"
                                class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7
                                        1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02
                                        8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91
                                        3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72
                                        2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36
                                        1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66
                                        2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
                                </svg>
                            </a>
                        @endconfig

                        @config('ecommerce_youtube')
                            <a href="{{ $value }}" target="_blank" title="Youtube"
                                class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.746 22 12 22 12s0
                                            3.255-.418 4.814a2.504 2.504 0 0 1-1.768 1.768c-1.56.419-7.814.419-7.814.419s-6.255
                                            0-7.814-.419a2.505 2.505 0 0 1-1.768-1.768C2 15.255 2 12 2 12s0-3.255.417-4.814a2.507
                                            2.507 0 0 1 1.768-1.768C5.744 5 11.998 5 11.998 5s6.255 0 7.814.418ZM15.194 12 10 15V9l5.194 3Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endconfig
                    </div>
                </div>
                <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold leading-6 text-gray-900">Solutions</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Marketing</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Analytics</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Commerce</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Insights</a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-10 md:mt-0">
                            <h3 class="text-sm font-semibold leading-6 text-gray-900">Support</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Pricing</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Documentation</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Guides</a>
                                </li>
                                <li>
                                    <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">API
                                        Status</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold leading-6 text-gray-900">Company</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">About</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Blog</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Jobs</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Press</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Partners</a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-10 md:mt-0">
                            <h3 class="text-sm font-semibold leading-6 text-gray-900">Legal</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Claim</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Privacy</a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-16 text-center border-t border-gray-900/10 pt-8 sm:mt-20 lg:mt-24">
                <p class="text-xs leading-5 text-gray-500">
                    Desarrollado por
                    <a href="{{ route('simplecom.landing') }}" target="_blank"
                        class="text-blue-700 hover:underline">
                        Simplecom&copy;
                    </a>.
                    Todos los derechos reservados
                </p>
            </div>
        </div>
    </footer>

    @config('whatsapp_button')
        @config('contact_whatsapp')
            <a x-data href="https://api.whatsapp.com/send?phone=54{{ $value }}" target="_blank"
            x-tooltip.raw="Contactanos por Whatsapp" class="fixed bottom-4 right-4">
                <img src="{{ URL::to('img/whatsapp-icon.svg') }}" alt="whatsapp logo" class="w-12 h-12">
            </a>
        @endconfig
    @endconfig

    @yield('end-body')
</body>

</html>
