@extends('layouts.basic')

@section('content')
    <header class="sticky top-0 left-0 bg-white z-20 py-2 shadow">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <nav class="relative z-50 flex justify-between">
                <div class="flex items-center md:gap-x-12">
                    <a aria-label="Home" href="#">
                        <img class="h-12 sm:h-16 w-auto" src="{{ asset('img/simplecom/png/logo-color-transparent.png') }}"
                            alt="">
                        <div class="hidden md:flex md:gap-x-6"><a
                                class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900"
                                href="#features">Features</a><a
                                class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900"
                                href="#testimonials">Testimonials</a><a
                                class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900"
                                href="#pricing">Pricing</a></div>
                </div>
                <div class="flex items-center gap-x-5 md:gap-x-8">
                    <div class="hidden md:block"><a
                            class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900"
                            href="/login">Sign in</a></div><a
                        class="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-blue-600 text-white hover:text-slate-100 hover:bg-blue-500 active:bg-blue-800 active:text-blue-100 focus-visible:outline-blue-600"
                        href="/register"><span>Get started <span class="hidden lg:inline">today</span></span></a>
                    <div class="-mr-1 md:hidden">
                        <div data-headlessui-state=""><button
                                class="relative z-10 flex h-8 w-8 items-center justify-center ui-not-focus-visible:outline-none"
                                aria-label="Toggle Navigation" type="button" aria-expanded="false" data-headlessui-state=""
                                id="headlessui-popover-button-:Rbplla:"><svg aria-hidden="true"
                                    class="h-3.5 w-3.5 overflow-visible stroke-slate-700" fill="none" stroke-width="2"
                                    stroke-linecap="round">
                                    <path d="M0 1H14M0 7H14M0 13H14" class="origin-center transition"></path>
                                    <path d="M2 2L12 12M12 2L2 12" class="origin-center transition scale-90 opacity-0">
                                    </path>
                                </svg></button></div>
                        <div
                            style="position:fixed;top:1px;left:1px;width:1px;height:0;padding:0;margin:-1px;overflow:hidden;clip:rect(0, 0, 0, 0);white-space:nowrap;border-width:0;display:none">
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <section id="hero" class="bg-white">
            <div class="grid max-w-screen-xl px-4 sm:px-10 pt-16 mx-auto lg:gap-8 xl:gap-0 lg:grid-cols-12">
                <div class="text-center lg:text-left place-self-center lg:col-span-7">
                    <h1 class="mx-auto max-w-4xl font-display text-4xl font-medium 
                    tracking-tight text-slate-900 md:text-5xl lg:text-6xl">
                        La nueva solución
                        <span class="relative whitespace-nowrap text-blue-600"><svg aria-hidden="true" viewBox="0 0 418 42"
                                class="absolute left-0 top-2/3 h-[0.58em] w-full fill-blue-300/70"
                                preserveAspectRatio="none">
                                <path
                                    d="M203.371.916c-26.013-2.078-76.686 1.963-124.73 9.946L67.3 12.749C35.421 18.062 18.2 21.766 6.004 25.934 1.244 27.561.828 27.778.874 28.61c.07 1.214.828 1.121 9.595-1.176 9.072-2.377 17.15-3.92 39.246-7.496C123.565 7.986 157.869 4.492 195.942 5.046c7.461.108 19.25 1.696 19.17 2.582-.107 1.183-7.874 4.31-25.75 10.366-21.992 7.45-35.43 12.534-36.701 13.884-2.173 2.308-.202 4.407 4.442 4.734 2.654.187 3.263.157 15.593-.78 35.401-2.686 57.944-3.488 88.365-3.143 46.327.526 75.721 2.23 130.788 7.584 19.787 1.924 20.814 1.98 24.557 1.332l.066-.011c1.201-.203 1.53-1.825.399-2.335-2.911-1.31-4.893-1.604-22.048-3.261-57.509-5.556-87.871-7.36-132.059-7.842-23.239-.254-33.617-.116-50.627.674-11.629.54-42.371 2.494-46.696 2.967-2.359.259 8.133-3.625 26.504-9.81 23.239-7.825 27.934-10.149 28.304-14.005.417-4.348-3.529-6-16.878-7.066Z">
                                </path>
                            </svg><span class="relative">simple</span></span> e ideal para vender online
                    </h1>
                    <p class="mx-auto my-6 max-w-4xl text-lg tracking-tight text-slate-700">
                        Con Simplecom podes crear tu tienda online y empezar a vender en minutos, 
                        sin vueltas ni comisiones
                    </p>
                    <x-button type="secondary" size="big">Speak to Sales</x-button>
                    <x-button size="big">Get started</x-button>
                </div>
                <div class="lg:mt-0 mx-auto lg:col-span-5 lg:flex">
                    <img src="{{ URL::to('img/landing/hero-mockup.png') }}" class="h-full object-cover" alt="mockup">
                </div>
            </div>

            <div x-data="{}" x-init="$nextTick(() => {
                let ul = $refs.logos;
                ul.insertAdjacentHTML('afterend', ul.outerHTML);
                ul.nextSibling.setAttribute('aria-hidden', 'true');
            })"
                class="w-full mt-8 inline-flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)]">
                <ul x-ref="logos"
                    class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll">
                    <li>
                        <img class="w-28 h-28 object-contain" src="https://zipnova.com/opengraph-image.png?b030af71241cd50d"
                            alt="Disney" />
                    </li>
                    <li>
                        <img class="w-28 h-28 object-contain"
                            src="https://www.cedol.org.ar/logistica/wp-content/uploads/2017/12/Logo-rojo.png"
                            alt="Airbnb" />
                    </li>
                    <li>
                        <img class="w-28 h-28 object-contain"
                            src="https://images.seeklogo.com/logo-png/19/1/mercadopago-logo-png_seeklogo-199533.png"
                            alt="Apple" />
                    </li>
                    <li>
                        <img class="w-28 h-28 object-contain"
                            src="https://images.archbee.com/wYlzYU9oe8HZjh9BkqeFY/jF_muslOv7Tnt8AW8CVa__mobbexoriginal.png?format=webp"
                            alt="Apple" />
                    </li>
                    <li>
                        <img class="w-28 h-28 object-contain" src="https://logosenvector.com/logo/img/modo-37330.png"
                            alt="Apple" />
                    </li>
                    <li>
                        <img class="w-28 h-10 object-contain"
                            src="https://cdn.tusfacturas.app/web/images/logo-tf/2024/tusfacturasapp-isologo.png"
                            alt="">
                    </li>
                    <li>
                        <img class="w-28 h-10 object-contain"
                            src="https://s3.us-east-005.backblazeb2.com/gocuotas-assets/assets/tile-wide-5f6cc166915fc60b7c330d6f538ad90881e7abe268dfac1f1155bbade9ba7cae.png"
                            alt="">
                    </li>
                    <li>
                        <img class="w-28 h-10 object-contain"
                            src="https://www.ualabis.com.ar/_next/static/media/LogoOpenGraph.d24202af.png" alt="">
                    </li>
                    <li>
                        <img class="w-28 h-10 object-contain"
                            src="https://nextiendas.com/wellcome/ayuda/data/knowledge/Env%C3%ADopack-Logo-1-negro.png"
                            alt="">
                    </li>
                </ul>
            </div>
        </section>

        <section class="py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mb-14 text-center">
                    <h2
                        class="text-4xl text-center font-bold text-gray-900 leading-[3.25rem] mb-6 max-w-max lg:max-w-3xl lg:mx-auto">
                        Developed from scratch for seamless online functionality</h2>
                    <p class="text-base font-normal text-gray-500 lg:max-w-2xl lg:mx-auto mb-8">Using technology to make
                        finance simpler, smarter and more rewarding. </p>
                    <div
                        class="flex flex-col justify-center md:flex-row gap-5 max-w-lg mx-auto md:max-w-2xl lg:max-w-full">
                        <a href="javascript:;"
                            class="cursor-pointer bg-indigo-600 py-3 px-6 rounded-full flex items-center justify-center text-sm font-semibold text-white transition-all duration-500 focus:outline-none hover:bg-indigo-700">
                            Get started
                        </a>
                        <a href="javascript:;"
                            class="cursor-pointer bg-indigo-50 py-3 px-6 rounded-full flex items-center justify-center  text-sm font-semibold text-indigo-600 transition-all duration-500 focus:outline-none hover:bg-indigo-100">
                            Learn more
                        </a>
                    </div>
                </div>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-lg mx-auto md:max-w-2xl lg:max-w-full">
                    <div class="relative w-full h-auto md:col-span-2">
                        <div class="bg-gray-800 rounded-2xl flex  justify-between flex-row flex-wrap">
                            <div class="p-5  xl:p-8 w-full md:w-1/2 ">
                                <div class="block">
                                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15 12.5V18.75M18.75 2.5L11.25 2.5M15 28.75C8.7868 28.75 3.75 23.7132 3.75 17.5C3.75 11.2868 8.7868 6.25 15 6.25C21.2132 6.25 26.25 11.2868 26.25 17.5C26.25 23.7132 21.2132 28.75 15 28.75Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold xl:text-xl text-white py-5 w-full xl:w-64">
                                    Accomplish tasks swiftly with online tools.
                                </h3>
                                <p class="text-xs font-normal text-gray-300 w-full mb-8 xl:w-64">Get quoted and covered in
                                    under 10 minutes online. no paperwork or waiting any more </p>
                                <button
                                    class="py-2 px-5 border border-solid border-gray-300 rounded-full gap-2 text-xs text-white font-semibold flex items-center justify-between transition-all duration-500 hover:bg-white/5">
                                    View More
                                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1 9L3.58579 6.41421C4.25245 5.74755 4.58579 5.41421 4.58579 5C4.58579 4.58579 4.25245 4.25245 3.58579 3.58579L1 1"
                                            stroke="white" stroke-width="1.6" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>

                                </button>
                            </div>
                            <div class="relative hidden h-auto md:w-1/2 md:block">
                                <img src="https://pagedone.io/asset/uploads/1695028873.png" alt="Header tailwind Section"
                                    class="h-full ml-auto object-cover">
                            </div>
                        </div>
                    </div>
                    <div class="relative w-full h-auto">
                        <div class="bg-indigo-500 rounded-2xl p-5  xl:p-8 h-full">
                            <div class="block">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M24.6429 11.4286C24.6429 14.3872 20.2457 16.7857 14.8214 16.7857C9.3972 16.7857 5 14.3872 5 11.4286M24.6429 16.7857C24.6429 19.7444 20.2457 22.1429 14.8214 22.1429C9.3972 22.1429 5 19.7444 5 16.7857M24.6429 22.1429C24.6429 25.1015 20.2457 27.5 14.8214 27.5C9.3972 27.5 5 25.1015 5 22.1429M24.6429 6.96429C24.6429 9.42984 20.2457 11.4286 14.8214 11.4286C9.3972 11.4286 5 9.42984 5 6.96429C5 4.49873 9.3972 2.5 14.8214 2.5C20.2457 2.5 24.6429 4.49873 24.6429 6.96429Z"
                                        stroke="white" stroke-width="2" stroke-linecap="round"></path>
                                </svg>
                            </div>
                            <h3 class="py-5 text-white text-lg font-bold xl:text-xl">Improved technology yields greater
                                value</h3>
                            <p class="text-xs font-normal text-white mb-8">We’ve eliminated old analogue process with
                                state-of-the art tech </p>
                            <button
                                class="py-2 px-5 border border-solid border-gray-300 rounded-full gap-2 text-xs text-white font-semibold flex items-center justify-between transition-all duration-500 hover:bg-white/5">
                                View More
                                <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1 9L3.58579 6.41421C4.25245 5.74755 4.58579 5.41421 4.58579 5C4.58579 4.58579 4.25245 4.25245 3.58579 3.58579L1 1"
                                        stroke="white" stroke-width="1.6" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>

                            </button>
                        </div>
                    </div>
                    <div class="relative w-full h-auto">
                        <div class="bg-violet-500 rounded-2xl p-5 xl:p-8 h-full">
                            <div class="block">
                                <svg width="30" height="30" viewBox="0 0 30 30" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M26.7301 15.661C26.7301 22.1995 21.306 27.5 14.6151 27.5C7.9241 27.5 2.5 22.1995 2.5 15.661C2.5 9.1225 7.9241 3.822 14.6151 3.822M18.1313 10.1507L18.1313 4.85383C18.1313 3.22503 19.6455 2.00299 21.1519 2.70013C23.7608 3.90751 26.6177 6.25557 27.456 10.2563C27.7542 11.6798 26.4931 12.8563 25.0064 12.8368L20.7873 12.7814C19.3147 12.762 18.1313 11.5899 18.1313 10.1507Z"
                                        stroke="white" stroke-width="2" stroke-linecap="round"></path>
                                </svg>

                            </div>
                            <h3 class="py-5 text-white text-lg font-bold xl:text-xl">Build wealth with insurance planning
                            </h3>
                            <p class="text-xs font-normal text-white mb-8">Every life plan policy has a built-in wealth
                                bonus, and we contribute too </p>
                            <button
                                class="py-2 px-5 border border-solid border-gray-300 rounded-full gap-2 text-xs text-white font-semibold flex items-center justify-between transition-all duration-500 hover:bg-white/5">
                                View More
                                <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M1 9L3.58579 6.41421C4.25245 5.74755 4.58579 5.41421 4.58579 5C4.58579 4.58579 4.25245 4.25245 3.58579 3.58579L1 1"
                                        stroke="white" stroke-width="1.6" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>

                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-1 gap-12 lg:grid-cols-2 md:grid-cols-2 lg:gap-24 max-w-md mx-auto md:max-w-3xl lg:max-w-full">
                    <div class=" relative w-full transition-all duration-500 lg:max-w-md">
                        <div class="relative mb-4">
                            <svg width="75" height="75" viewBox="0 0 75 75" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M30.0435 65.6251C18.6286 65.6251 9.375 56.3715 9.375 44.9566C9.375 33.5417 18.6286 24.2881 30.0435 24.2881C41.4584 24.2881 50.712 33.5417 50.712 44.9566C50.712 56.3715 41.4584 65.6251 30.0435 65.6251Z"
                                    fill="#4F46E5"></path>
                                <path
                                    d="M44.9537 50.712C33.5388 50.712 24.2852 41.4584 24.2852 30.0435C24.2852 18.6286 33.5388 9.375 44.9537 9.375C56.3686 9.375 65.6222 18.6286 65.6222 30.0435C65.6222 41.4584 56.3686 50.712 44.9537 50.712Z"
                                    fill="#4F46E5"></path>
                            </svg>
                        </div>
                        <h4
                            class="text-lg font-semibold text-gray-900 leading-7 mb-2 capitalize transition-all duration-500 ">
                            Privacy Center</h4>
                        <p class="text-sm font-normal text-gray-500 transition-all duration-500 leading-[1.3rem] mb-4">
                            We have the most up-to-date security to support all our customers in carrying out all
                            transactions.
                        </p>
                        <a href="#"
                            class="group flex items-center gap-2 text-sm font-semibold text-indigo-600 transition-all duration-500 ">Read
                            more <svg class="transition-all duration-500  group-hover:translate-x-1" width="18"
                                height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.25 9L14.25 9M10.5 13.5L14.4697 9.53033C14.7197 9.28033 14.8447 9.15533 14.8447 9C14.8447 8.84467 14.7197 8.71967 14.4697 8.46967L10.5 4.5"
                                    stroke="#4F46E5" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <div class=" relative w-full transition-all duration-500 lg:max-w-md">
                        <div class="relative mb-4">
                            <svg width="75" height="75" viewBox="0 0 75 75" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M29.7866 22.6602C31.6531 21.6133 33.9719 21.6133 35.8384 22.6602L50.2029 30.7175C52.0139 31.7333 53.125 33.5815 53.125 35.5783V51.9217C53.125 53.9185 52.0139 55.7667 50.2029 56.7825L35.8384 64.8398C33.9719 65.8867 31.6531 65.8867 29.7866 64.8398L15.4221 56.7826C13.6111 55.7667 12.5 53.9185 12.5 51.9217V35.5783C12.5 33.5815 13.6111 31.7333 15.4221 30.7175L29.7866 22.6602Z"
                                    fill="#4F46E5"></path>
                                <path
                                    d="M39.8773 9.53229C41.6424 8.48924 43.8353 8.48924 45.6005 9.53229L59.185 17.5595C60.8977 18.5715 61.9484 20.4129 61.9484 22.4022V38.6849C61.9484 40.6742 60.8977 42.5155 59.185 43.5276L45.6005 51.5548C43.8353 52.5979 41.6424 52.5979 39.8773 51.5548L26.2927 43.5276C24.58 42.5155 23.5293 40.6742 23.5293 38.6849V22.4022C23.5293 20.4129 24.58 18.5716 26.2927 17.5595L39.8773 9.53229Z"
                                    fill="#4F46E5"></path>
                            </svg>

                        </div>
                        <h4
                            class="text-lg font-semibold text-gray-900 leading-7 mb-2 capitalize transition-all duration-500 ">
                            Quick &amp; Easy Transaction</h4>
                        <p class="text-sm font-normal text-gray-500 transition-all duration-500 leading-[1.3rem] mb-4">
                            We provide faster transaction speeds than competitors, so money arrives and is received faster.
                        </p>
                        <a href="#"
                            class="group flex items-center gap-2 text-sm font-semibold text-indigo-600 transition-all duration-500 ">Read
                            more <svg class="transition-all duration-500  group-hover:translate-x-1" width="18"
                                height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.25 9L14.25 9M10.5 13.5L14.4697 9.53033C14.7197 9.28033 14.8447 9.15533 14.8447 9C14.8447 8.84467 14.7197 8.71967 14.4697 8.46967L10.5 4.5"
                                    stroke="#4F46E5" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <div class=" relative w-full transition-all duration-500 lg:max-w-md">
                        <div class="relative mb-4">
                            <svg width="75" height="75" viewBox="0 0 75 75" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M12.5 17.1875C12.5 14.5987 14.5987 12.5 17.1875 12.5H42.1875C44.7763 12.5 46.875 14.5987 46.875 17.1875V42.1875C46.875 44.7763 44.7763 46.875 42.1875 46.875H17.1875C14.5987 46.875 12.5 44.7763 12.5 42.1875V17.1875Z"
                                    fill="#4F46E5"></path>
                                <path
                                    d="M28.125 32.8125C28.125 30.2237 30.2237 28.125 32.8125 28.125H57.8125C60.4013 28.125 62.5 30.2237 62.5 32.8125V57.8125C62.5 60.4013 60.4013 62.5 57.8125 62.5H32.8125C30.2237 62.5 28.125 60.4013 28.125 57.8125V32.8125Z"
                                    fill="#4F46E5"></path>
                            </svg>

                        </div>
                        <h4
                            class="text-lg font-semibold text-gray-900 leading-7 mb-2 capitalize transition-all duration-500 ">
                            Customer Service</h4>
                        <p class="text-sm font-normal text-gray-500 transition-all duration-500 leading-[1.3rem] mb-4">
                            Our commitment to exceptional support ensures that you receive the assistance you need, whenever
                            you need it
                        </p>
                        <a href="#"
                            class="group flex items-center gap-2 text-sm font-semibold text-indigo-600 transition-all duration-500 ">Read
                            more <svg class="transition-all duration-500  group-hover:translate-x-1" width="18"
                                height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.25 9L14.25 9M10.5 13.5L14.4697 9.53033C14.7197 9.28033 14.8447 9.15533 14.8447 9C14.8447 8.84467 14.7197 8.71967 14.4697 8.46967L10.5 4.5"
                                    stroke="#4F46E5" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                        </a>
                    </div>
                    <div class=" relative w-full transition-all duration-500 lg:max-w-md">
                        <div class="relative mb-4">
                            <svg width="75" height="75" viewBox="0 0 75 75" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M50 13.5104C50 11.1113 48.0497 9.14249 45.6641 9.39724C41.7899 9.81097 37.9871 10.7779 34.3737 12.2747C29.4195 14.3267 24.918 17.3345 21.1263 21.1263C17.3345 24.918 14.3267 29.4195 12.2747 34.3737C10.7779 37.9871 9.81097 41.7899 9.39724 45.6641C9.14249 48.0497 11.1113 50 13.5104 50H45.656C48.0551 50 50 48.0551 50 45.656L50 13.5104Z"
                                    fill="#4F46E5"></path>
                                <path
                                    d="M62.5 26.0104C62.5 23.6113 60.5497 21.6425 58.1641 21.8972C54.2899 22.311 50.4871 23.2779 46.8737 24.7747C41.9195 26.8267 37.418 29.8345 33.6263 33.6263C29.8345 37.418 26.8267 41.9195 24.7747 46.8737C23.2779 50.4871 22.311 54.2899 21.8972 58.1641C21.6425 60.5497 23.6113 62.5 26.0104 62.5H58.156C60.5551 62.5 62.5 60.5551 62.5 58.156V26.0104Z"
                                    fill="#4F46E5"></path>
                            </svg>

                        </div>
                        <h4
                            class="text-lg font-semibold text-gray-900 leading-7 mb-2 capitalize transition-all duration-500 ">
                            Accurate Result</h4>
                        <p class="text-sm font-normal text-gray-500 transition-all duration-500 leading-[1.3rem] mb-4">
                            Accurate results are our top priority, ensuring you always have reliable information at your
                            fingertips.
                        </p>
                        <a href="#"
                            class="group flex items-center gap-2 text-sm font-semibold text-indigo-600 transition-all duration-500 ">Read
                            more <svg class="transition-all duration-500  group-hover:translate-x-1" width="18"
                                height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.25 9L14.25 9M10.5 13.5L14.4697 9.53033C14.7197 9.28033 14.8447 9.15533 14.8447 9C14.8447 8.84467 14.7197 8.71967 14.4697 8.46967L10.5 4.5"
                                    stroke="#4F46E5" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="py-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div
                    class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-5">
                    <div class="col-span-2">
                        <h2 class="text-base/7 font-semibold text-blue-600">Everything you need</h2>
                        <p class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900">
                            All-in-one platform</p>
                        <p class="mt-6 text-base/7 text-gray-700">Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Maiores impedit perferendis suscipit eaque, iste dolor cupiditate blanditiis ratione.</p>
                    </div>
                    <dl
                        class="col-span-3 grid grid-cols-1 gap-x-8 gap-y-10 text-base/7 text-gray-600 sm:grid-cols-2 lg:gap-y-16">
                        <div class="relative lg:pl-9">
                            <dt class="font-semibold text-gray-900 flex items-center gap-1">
                                <x-icon code="check" class="text-blue-600" />
                                Invite team members
                            </dt>
                            <dd class="mt-2">Rerum repellat labore necessitatibus reprehenderit molestiae praesentium.
                            </dd>
                        </div>
                        <div class="relative lg:pl-9">
                            <dt class="font-semibold text-gray-900 flex items-center gap-1">
                                <x-icon code="check" class="text-blue-600" />
                                List view
                            </dt>
                            <dd class="mt-2">Corporis asperiores ea nulla temporibus asperiores non tempore assumenda
                                aut.</dd>
                        </div>
                        <div class="relative lg:pl-9">
                            <dt class="font-semibold text-gray-900 flex items-center gap-1">
                                <x-icon code="check" class="text-blue-600" />
                                Keyboard shortcusts
                            </dt>
                            <dd class="mt-2">In sit qui aliquid deleniti et. Ad nobis sunt omnis. Quo sapiente dicta
                                laboriosam.</dd>
                        </div>
                        <div class="relative lg:pl-9">
                            <dt class="font-semibold text-gray-900 flex items-center gap-1">
                                <x-icon code="check" class="text-blue-600" />
                                Calendars
                            </dt>
                            <dd class="mt-2">Sed rerum sunt dignissimos ullam. Iusto iure occaecati voluptate eligendi.
                            </dd>
                        </div>
                        <div class="relative lg:pl-9">
                            <dt class="font-semibold text-gray-900 flex items-center gap-1">
                                <x-icon code="check" class="text-blue-600" />
                                Notificaciones
                            </dt>
                            <dd class="mt-2">Quos inventore harum enim nesciunt. Aut repellat rerum omnis adipisci.</dd>
                        </div>
                        <div class="relative lg:pl-9">
                            <dt class="font-semibold text-gray-900 flex items-center gap-1">
                                <x-icon code="check" class="text-blue-600" />
                                Boards
                            </dt>
                            <dd class="mt-2">Quae sit sunt excepturi fugit veniam voluptatem ipsum commodi.</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </section>

        <section class="relative pt-32 overflow-hidden">
            <div class="w-full max-w-7xl mx-auto px-4 lg:px-8 mb-14">
                <div class="mx-auto max-w-2xl md:text-center mb-20">
                    <h2 class="font-display text-3xl tracking-tight text-slate-900 sm:text-4xl">Simplify everyday
                        business tasks.</h2>
                    <p class="mt-4 text-lg tracking-tight text-slate-700">Because you’d probably be a little confused
                        if we suggested you complicate your everyday business tasks instead.</p>
                </div>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-md mx-auto md:max-w-3xl lg:max-w-full">
                    <div class="flex flex-col gap-8">
                        <div class="rounded-2xl p-8 bg-emerald-200 ">
                            <h6 class="text-xl font-semibold leading-8 text-gray-900 mb-2.5">
                                Elevate your holiday joy with a festive 20% discount using code xzTnm
                            </h6>
                            <button type="button"
                                class="ml-auto flex w-max py-2 border border-gray-500 px-6 text-sm max-h-max bg-transparent-100 text-gray-900 rounded-full cursor-pointer font-medium text-center shadow-xs transition-all duration-500 hover:bg-black hover:text-white">
                                Special Offer
                            </button>
                        </div>
                        <div class="rounded-2xl p-8 bg-blue-200 ">
                            <h6 class="text-xl font-semibold leading-8 text-gray-900 mb-2.5">
                                Elevate your holiday joy with a festive 20% discount using code xzTnm
                            </h6>
                            <button type="button"
                                class="ml-auto flex w-max py-2 border border-gray-500 px-6 text-sm max-h-max bg-transparent-100 text-gray-900 rounded-full cursor-pointer font-medium text-center shadow-xs transition-all duration-500 hover:bg-black hover:text-white">
                                Special Offer
                            </button>
                        </div>
                    </div>
                    <div
                        class="grid grid-cols-1 md:col-span-2 lg:col-span-1 md:grid-cols-2 lg:grid-cols-1 gap-8 md:order-last lg:order-none">
                        <div class="rounded-2xl p-8 bg-indigo-200 ">
                            <h6 class="text-xl font-semibold leading-8 text-gray-900 mb-2.5">
                                Elevate your holiday joy with a festive 20% discount using code xzTnm
                            </h6>
                            <button type="button"
                                class="ml-auto flex w-max py-2 border border-gray-500 px-6 text-sm max-h-max bg-transparent text-gray-900 rounded-full cursor-pointer font-medium text-center shadow-xs transition-all duration-500 hover:bg-black hover:text-white">
                                Special Offer
                            </button>
                        </div>
                        <div class="rounded-2xl p-8 bg-pink-200 ">
                            <h6 class="text-xl font-semibold leading-8 text-gray-900 mb-2.5">
                                Elevate your holiday joy with a festive 20% discount using code xzTnm
                            </h6>
                            <button type="button"
                                class="ml-auto flex w-max py-2 border border-gray-500 px-6 text-sm max-h-max bg-transparent text-gray-900 rounded-full cursor-pointer font-medium text-center shadow-xs transition-all duration-500 hover:bg-black hover:text-white">
                                Special Offer
                            </button>
                        </div>
                    </div>
                    <div class="rounded-2xl p-8 bg-orange-200 ">
                        <h6 class="text-xl font-semibold leading-8 text-gray-900 mb-2.5">
                            Elevate your holiday joy with a festive 20% discount using code xzTnm
                        </h6>
                        <button type="button"
                            class="ml-auto flex w-max py-2 border border-gray-500 px-6 text-sm max-h-max bg-transparent text-gray-900 rounded-full cursor-pointer font-medium text-center shadow-xs transition-all duration-500 hover:bg-black hover:text-white">
                            Special Offer
                        </button>
                    </div>
                </div>
        </section>

        <section id="secondary-features" aria-label="Features for simplifying everyday business tasks"
            class="pb-14 pt-20 sm:pb-20 sm:pt-32 lg:pb-32">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl md:text-center">
                    <h2 class="font-display text-3xl tracking-tight text-slate-900 sm:text-4xl">Simplify everyday
                        business tasks.</h2>
                    <p class="mt-4 text-lg tracking-tight text-slate-700">Because you’d probably be a little confused
                        if we suggested you complicate your everyday business tasks instead.</p>
                </div>
                <div class="-mx-4 mt-20 flex flex-col gap-y-10 overflow-hidden px-4 sm:-mx-6 sm:px-6 lg:hidden">
                    <div>
                        <div class="mx-auto max-w-2xl">
                            <div class="w-9 rounded-lg bg-blue-600"><svg aria-hidden="true" class="h-9 w-9"
                                    fill="none">
                                    <defs>
                                        <linearGradient id=":R2mella:" x1="11.5" y1="18" x2="36"
                                            y2="15.5" gradientUnits="userSpaceOnUse">
                                            <stop offset=".194" stop-color="#fff"></stop>
                                            <stop offset="1" stop-color="#6692F1"></stop>
                                        </linearGradient>
                                    </defs>
                                    <path d="m30 15-4 5-4-11-4 18-4-11-4 7-4-5" stroke="url(#:R2mella:)" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg></div>
                            <h3 class="mt-6 text-sm font-medium text-blue-600">Reporting</h3>
                            <p class="mt-2 font-display text-xl text-slate-900">Stay on top of things with always
                                up-to-date reporting features.</p>
                            <p class="mt-4 text-sm text-slate-600">We talked about reporting in the section above but
                                we needed three items here, so mentioning it one more time for posterity.</p>
                        </div>
                        <div class="relative mt-10 pb-10">
                            <div class="absolute -inset-x-4 bottom-0 top-8 bg-slate-200 sm:-inset-x-6"></div>
                            <div
                                class="relative mx-auto w-[52.75rem] overflow-hidden rounded-xl bg-white shadow-lg shadow-slate-900/5 ring-1 ring-slate-500/10">
                                <img alt="" loading="lazy" width="1688" height="856" decoding="async"
                                    data-nimg="1" class="w-full" style="color:transparent" sizes="52.75rem"
                                    srcset="/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=16&amp;q=75 16w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=32&amp;q=75 32w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=48&amp;q=75 48w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=64&amp;q=75 64w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=96&amp;q=75 96w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=128&amp;q=75 128w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=256&amp;q=75 256w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=384&amp;q=75 384w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=640&amp;q=75 640w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=750&amp;q=75 750w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=828&amp;q=75 828w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=1080&amp;q=75 1080w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=1200&amp;q=75 1200w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=1920&amp;q=75 1920w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=2048&amp;q=75 2048w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=3840&amp;q=75 3840w"
                                    src="/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=3840&amp;q=75">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mx-auto max-w-2xl">
                            <div class="w-9 rounded-lg bg-blue-600"><svg aria-hidden="true" class="h-9 w-9"
                                    fill="none">
                                    <path opacity=".5"
                                        d="M8 17a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-2Z"
                                        fill="#fff"></path>
                                    <path opacity=".3"
                                        d="M8 24a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-2Z"
                                        fill="#fff"></path>
                                    <path d="M8 10a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-2Z"
                                        fill="#fff"></path>
                                </svg></div>
                            <h3 class="mt-6 text-sm font-medium text-blue-600">Inventory</h3>
                            <p class="mt-2 font-display text-xl text-slate-900">Never lose track of what’s in stock
                                with accurate inventory tracking.</p>
                            <p class="mt-4 text-sm text-slate-600">We don’t offer this as part of our software but that
                                statement is inarguably true. Accurate inventory tracking would help you for sure.</p>
                        </div>
                        <div class="relative mt-10 pb-10">
                            <div class="absolute -inset-x-4 bottom-0 top-8 bg-slate-200 sm:-inset-x-6"></div>
                            <div
                                class="relative mx-auto w-[52.75rem] overflow-hidden rounded-xl bg-white shadow-lg shadow-slate-900/5 ring-1 ring-slate-500/10">
                                <img alt="" loading="lazy" width="1688" height="856" decoding="async"
                                    data-nimg="1" class="w-full" style="color:transparent" sizes="52.75rem"
                                    srcset="/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=16&amp;q=75 16w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=32&amp;q=75 32w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=48&amp;q=75 48w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=64&amp;q=75 64w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=96&amp;q=75 96w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=128&amp;q=75 128w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=256&amp;q=75 256w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=384&amp;q=75 384w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=640&amp;q=75 640w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=750&amp;q=75 750w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=828&amp;q=75 828w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=1080&amp;q=75 1080w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=1200&amp;q=75 1200w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=1920&amp;q=75 1920w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=2048&amp;q=75 2048w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=3840&amp;q=75 3840w"
                                    src="/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=3840&amp;q=75">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mx-auto max-w-2xl">
                            <div class="w-9 rounded-lg bg-blue-600"><svg aria-hidden="true" class="h-9 w-9"
                                    fill="none">
                                    <path opacity=".5"
                                        d="M25.778 25.778c.39.39 1.027.393 1.384-.028A11.952 11.952 0 0 0 30 18c0-6.627-5.373-12-12-12S6 11.373 6 18c0 2.954 1.067 5.659 2.838 7.75.357.421.993.419 1.384.028.39-.39.386-1.02.036-1.448A9.959 9.959 0 0 1 8 18c0-5.523 4.477-10 10-10s10 4.477 10 10a9.959 9.959 0 0 1-2.258 6.33c-.35.427-.354 1.058.036 1.448Z"
                                        fill="#fff"></path>
                                    <path
                                        d="M12 28.395V28a6 6 0 0 1 12 0v.395A11.945 11.945 0 0 1 18 30c-2.186 0-4.235-.584-6-1.605ZM21 16.5c0-1.933-.5-3.5-3-3.5s-3 1.567-3 3.5 1.343 3.5 3 3.5 3-1.567 3-3.5Z"
                                        fill="#fff"></path>
                                </svg></div>
                            <h3 class="mt-6 text-sm font-medium text-blue-600">Contacts</h3>
                            <p class="mt-2 font-display text-xl text-slate-900">Organize all of your contacts, service
                                providers, and invoices in one place.</p>
                            <p class="mt-4 text-sm text-slate-600">This also isn’t actually a feature, it’s just some
                                friendly advice. We definitely recommend that you do this, you’ll feel really organized
                                and professional.</p>
                        </div>
                        <div class="relative mt-10 pb-10">
                            <div class="absolute -inset-x-4 bottom-0 top-8 bg-slate-200 sm:-inset-x-6"></div>
                            <div
                                class="relative mx-auto w-[52.75rem] overflow-hidden rounded-xl bg-white shadow-lg shadow-slate-900/5 ring-1 ring-slate-500/10">
                                <img alt="" loading="lazy" width="1688" height="856" decoding="async"
                                    data-nimg="1" class="w-full" style="color:transparent" sizes="52.75rem"
                                    srcset="/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=16&amp;q=75 16w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=32&amp;q=75 32w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=48&amp;q=75 48w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=64&amp;q=75 64w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=96&amp;q=75 96w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=128&amp;q=75 128w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=256&amp;q=75 256w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=384&amp;q=75 384w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=640&amp;q=75 640w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=750&amp;q=75 750w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=828&amp;q=75 828w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=1080&amp;q=75 1080w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=1200&amp;q=75 1200w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=1920&amp;q=75 1920w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=2048&amp;q=75 2048w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=3840&amp;q=75 3840w"
                                    src="/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=3840&amp;q=75">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:mt-20 lg:block">
                    <div class="grid grid-cols-3 gap-x-8" role="tablist" aria-orientation="horizontal">
                        <div class="relative">
                            <div class="w-9 rounded-lg bg-blue-600"><svg aria-hidden="true" class="h-9 w-9"
                                    fill="none">
                                    <defs>
                                        <linearGradient id=":Rarella:" x1="11.5" y1="18" x2="36"
                                            y2="15.5" gradientUnits="userSpaceOnUse">
                                            <stop offset=".194" stop-color="#fff"></stop>
                                            <stop offset="1" stop-color="#6692F1"></stop>
                                        </linearGradient>
                                    </defs>
                                    <path d="m30 15-4 5-4-11-4 18-4-11-4 7-4-5" stroke="url(#:Rarella:)" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg></div>
                            <h3 class="mt-6 text-sm font-medium text-blue-600"><button
                                    class="ui-not-focus-visible:outline-none" id="headlessui-tabs-tab-:Rirella:"
                                    role="tab" type="button" aria-selected="true" tabindex="0"
                                    data-headlessui-state="selected" aria-controls="headlessui-tabs-panel-:Rbbella:"><span
                                        class="absolute inset-0"></span>Reporting</button></h3>
                            <p class="mt-2 font-display text-xl text-slate-900">Stay on top of things with always
                                up-to-date reporting features.</p>
                            <p class="mt-4 text-sm text-slate-600">We talked about reporting in the section above but
                                we needed three items here, so mentioning it one more time for posterity.</p>
                        </div>
                        <div class="relative opacity-75 hover:opacity-100">
                            <div class="w-9 rounded-lg bg-slate-500"><svg aria-hidden="true" class="h-9 w-9"
                                    fill="none">
                                    <path opacity=".5"
                                        d="M8 17a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-2Z"
                                        fill="#fff"></path>
                                    <path opacity=".3"
                                        d="M8 24a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-2Z"
                                        fill="#fff"></path>
                                    <path d="M8 10a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H9a1 1 0 0 1-1-1v-2Z"
                                        fill="#fff"></path>
                                </svg></div>
                            <h3 class="mt-6 text-sm font-medium text-slate-600"><button
                                    class="ui-not-focus-visible:outline-none" id="headlessui-tabs-tab-:Rkrella:"
                                    role="tab" type="button" aria-selected="false" tabindex="-1"
                                    data-headlessui-state="" aria-controls="headlessui-tabs-panel-:Rjbella:"><span
                                        class="absolute inset-0"></span>Inventory</button></h3>
                            <p class="mt-2 font-display text-xl text-slate-900">Never lose track of what’s in stock
                                with accurate inventory tracking.</p>
                            <p class="mt-4 text-sm text-slate-600">We don’t offer this as part of our software but that
                                statement is inarguably true. Accurate inventory tracking would help you for sure.</p>
                        </div>
                        <div class="relative opacity-75 hover:opacity-100">
                            <div class="w-9 rounded-lg bg-slate-500"><svg aria-hidden="true" class="h-9 w-9"
                                    fill="none">
                                    <path opacity=".5"
                                        d="M25.778 25.778c.39.39 1.027.393 1.384-.028A11.952 11.952 0 0 0 30 18c0-6.627-5.373-12-12-12S6 11.373 6 18c0 2.954 1.067 5.659 2.838 7.75.357.421.993.419 1.384.028.39-.39.386-1.02.036-1.448A9.959 9.959 0 0 1 8 18c0-5.523 4.477-10 10-10s10 4.477 10 10a9.959 9.959 0 0 1-2.258 6.33c-.35.427-.354 1.058.036 1.448Z"
                                        fill="#fff"></path>
                                    <path
                                        d="M12 28.395V28a6 6 0 0 1 12 0v.395A11.945 11.945 0 0 1 18 30c-2.186 0-4.235-.584-6-1.605ZM21 16.5c0-1.933-.5-3.5-3-3.5s-3 1.567-3 3.5 1.343 3.5 3 3.5 3-1.567 3-3.5Z"
                                        fill="#fff"></path>
                                </svg></div>
                            <h3 class="mt-6 text-sm font-medium text-slate-600"><button
                                    class="ui-not-focus-visible:outline-none" id="headlessui-tabs-tab-:Rmrella:"
                                    role="tab" type="button" aria-selected="false" tabindex="-1"
                                    data-headlessui-state="" aria-controls="headlessui-tabs-panel-:Rrbella:"><span
                                        class="absolute inset-0"></span>Contacts</button></h3>
                            <p class="mt-2 font-display text-xl text-slate-900">Organize all of your contacts, service
                                providers, and invoices in one place.</p>
                            <p class="mt-4 text-sm text-slate-600">This also isn’t actually a feature, it’s just some
                                friendly advice. We definitely recommend that you do this, you’ll feel really organized
                                and professional.</p>
                        </div>
                    </div>
                    <div class="relative mt-20 overflow-hidden rounded-4xl bg-slate-200 px-14 py-16 xl:px-16">
                        <div class="-mx-5 flex">
                            <div class="px-5 transition duration-500 ease-in-out ui-not-focus-visible:outline-none"
                                style="transform:translateX(-0%)" aria-hidden="false"
                                id="headlessui-tabs-panel-:Rbbella:" role="tabpanel" tabindex="0"
                                data-headlessui-state="selected" aria-labelledby="headlessui-tabs-tab-:Rirella:">
                                <div
                                    class="w-[52.75rem] overflow-hidden rounded-xl bg-white shadow-lg shadow-slate-900/5 ring-1 ring-slate-500/10">
                                    <img alt="" loading="lazy" width="1688" height="856" decoding="async"
                                        data-nimg="1" class="w-full" style="color:transparent" sizes="52.75rem"
                                        srcset="/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=16&amp;q=75 16w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=32&amp;q=75 32w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=48&amp;q=75 48w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=64&amp;q=75 64w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=96&amp;q=75 96w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=128&amp;q=75 128w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=256&amp;q=75 256w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=384&amp;q=75 384w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=640&amp;q=75 640w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=750&amp;q=75 750w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=828&amp;q=75 828w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=1080&amp;q=75 1080w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=1200&amp;q=75 1200w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=1920&amp;q=75 1920w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=2048&amp;q=75 2048w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=3840&amp;q=75 3840w"
                                        src="/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fprofit-loss.2a2f85d5.png&amp;w=3840&amp;q=75">
                                </div>
                            </div>
                            <div class="px-5 transition duration-500 ease-in-out ui-not-focus-visible:outline-none opacity-60"
                                style="transform:translateX(-0%)" aria-hidden="true" id="headlessui-tabs-panel-:Rjbella:"
                                role="tabpanel" tabindex="-1" data-headlessui-state=""
                                aria-labelledby="headlessui-tabs-tab-:Rkrella:">
                                <div
                                    class="w-[52.75rem] overflow-hidden rounded-xl bg-white shadow-lg shadow-slate-900/5 ring-1 ring-slate-500/10">
                                    <img alt="" loading="lazy" width="1688" height="856" decoding="async"
                                        data-nimg="1" class="w-full" style="color:transparent" sizes="52.75rem"
                                        srcset="/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=16&amp;q=75 16w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=32&amp;q=75 32w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=48&amp;q=75 48w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=64&amp;q=75 64w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=96&amp;q=75 96w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=128&amp;q=75 128w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=256&amp;q=75 256w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=384&amp;q=75 384w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=640&amp;q=75 640w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=750&amp;q=75 750w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=828&amp;q=75 828w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=1080&amp;q=75 1080w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=1200&amp;q=75 1200w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=1920&amp;q=75 1920w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=2048&amp;q=75 2048w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=3840&amp;q=75 3840w"
                                        src="/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Finventory.14ec7758.png&amp;w=3840&amp;q=75">
                                </div>
                            </div>
                            <div class="px-5 transition duration-500 ease-in-out ui-not-focus-visible:outline-none opacity-60"
                                style="transform:translateX(-0%)" aria-hidden="true" id="headlessui-tabs-panel-:Rrbella:"
                                role="tabpanel" tabindex="-1" data-headlessui-state=""
                                aria-labelledby="headlessui-tabs-tab-:Rmrella:">
                                <div
                                    class="w-[52.75rem] overflow-hidden rounded-xl bg-white shadow-lg shadow-slate-900/5 ring-1 ring-slate-500/10">
                                    <img alt="" loading="lazy" width="1688" height="856" decoding="async"
                                        data-nimg="1" class="w-full" style="color:transparent" sizes="52.75rem"
                                        srcset="/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=16&amp;q=75 16w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=32&amp;q=75 32w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=48&amp;q=75 48w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=64&amp;q=75 64w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=96&amp;q=75 96w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=128&amp;q=75 128w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=256&amp;q=75 256w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=384&amp;q=75 384w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=640&amp;q=75 640w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=750&amp;q=75 750w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=828&amp;q=75 828w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=1080&amp;q=75 1080w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=1200&amp;q=75 1200w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=1920&amp;q=75 1920w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=2048&amp;q=75 2048w, /_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=3840&amp;q=75 3840w"
                                        src="/_next/image?url=%2F_next%2Fstatic%2Fmedia%2Fcontacts.a61dce95.png&amp;w=3840&amp;q=75">
                                </div>
                            </div>
                        </div>
                        <div class="pointer-events-none absolute inset-0 rounded-4xl ring-1 ring-inset ring-slate-900/10">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="get-started-today" class="relative overflow-hidden bg-blue-600 py-32"><img alt=""
                loading="lazy" width="2347" height="1244" decoding="async" data-nimg="1"
                class="absolute left-1/2 top-1/2 max-w-none -translate-x-1/2 -translate-y-1/2" style="color:transparent"
                src="/_next/static/media/background-call-to-action.6a5a5672.jpg">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative">
                <div class="mx-auto max-w-lg text-center">
                    <h2 class="font-display text-3xl tracking-tight text-white sm:text-4xl">Get started today</h2>
                    <p class="mt-4 text-lg tracking-tight text-white">It’s time to take control of your books. Buy our
                        software so you can feel like you’re doing something productive.</p><a
                        class="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-white text-slate-900 hover:bg-blue-50 active:bg-blue-200 active:text-slate-600 focus-visible:outline-white mt-10"
                        href="/register">Get 6 months free</a>
                </div>
            </div>
        </section>

        <section id="testimonials" aria-label="What our customers are saying" class="bg-slate-50 py-20 sm:py-32">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl md:text-center">
                    <h2 class="font-display text-3xl tracking-tight text-slate-900 sm:text-4xl">Loved by businesses
                        worldwide.</h2>
                    <p class="mt-4 text-lg tracking-tight text-slate-700">Our software is so simple that people can’t
                        help but fall in love with it. Simplicity is easy when you just skip tons of mission-critical
                        features.</p>
                </div>
                <ul role="list"
                    class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-6 sm:gap-8 lg:mt-20 lg:max-w-none lg:grid-cols-3">
                    <li>
                        <ul role="list" class="flex flex-col gap-y-6 sm:gap-y-8">
                            <li>
                                <figure
                                    class="relative rounded-2xl bg-white transition-shadow duration-300 shadow-md hover:shadow-xl p-6 shadow-slate-900/10">
                                    <svg aria-hidden="true" width="105" height="78"
                                        class="absolute left-6 top-6 fill-slate-100">
                                        <path
                                            d="M25.086 77.292c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622C1.054 58.534 0 53.411 0 47.686c0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C28.325 3.917 33.599 1.507 39.324 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Zm54.24 0c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622-2.11-4.52-3.164-9.643-3.164-15.368 0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C82.565 3.917 87.839 1.507 93.564 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Z">
                                        </path>
                                    </svg>
                                    <blockquote class="relative">
                                        <p class="text-lg tracking-tight text-slate-900">TaxPal is so easy to use I
                                            can’t help but wonder if it’s really doing the things the government expects
                                            me to do.</p>
                                    </blockquote>
                                    <figcaption
                                        class="relative mt-6 flex items-center justify-between border-t border-slate-100 pt-6">
                                        <div>
                                            <div class="font-display text-base text-slate-900">Sheryl Berge</div>
                                            <div class="mt-1 text-sm text-slate-500">CEO at Lynch LLC</div>
                                        </div>
                                        <div class="overflow-hidden rounded-full bg-slate-50"><img alt=""
                                                loading="lazy" width="56" height="56" decoding="async"
                                                data-nimg="1" class="h-14 w-14 object-cover" style="color:transparent"
                                                src="https://picsum.photos/200">
                                        </div>
                                    </figcaption>
                                </figure>
                            </li>
                            <li>
                                <figure
                                    class="relative rounded-2xl bg-white transition-shadow duration-300 shadow-md hover:shadow-xl p-6 shadow-slate-900/10">
                                    <svg aria-hidden="true" width="105" height="78"
                                        class="absolute left-6 top-6 fill-slate-100">
                                        <path
                                            d="M25.086 77.292c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622C1.054 58.534 0 53.411 0 47.686c0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C28.325 3.917 33.599 1.507 39.324 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Zm54.24 0c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622-2.11-4.52-3.164-9.643-3.164-15.368 0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C82.565 3.917 87.839 1.507 93.564 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Z">
                                        </path>
                                    </svg>
                                    <blockquote class="relative">
                                        <p class="text-lg tracking-tight text-slate-900">I’m trying to get a hold of
                                            someone in support, I’m in a lot of trouble right now and they are saying it
                                            has something to do with my books. Please get back to me right away.</p>
                                    </blockquote>
                                    <figcaption
                                        class="relative mt-6 flex items-center justify-between border-t border-slate-100 pt-6">
                                        <div>
                                            <div class="font-display text-base text-slate-900">Amy Hahn</div>
                                            <div class="mt-1 text-sm text-slate-500">Director at Velocity Industries
                                            </div>
                                        </div>
                                        <div class="overflow-hidden rounded-full bg-slate-50"><img alt=""
                                                loading="lazy" width="56" height="56" decoding="async"
                                                data-nimg="1" class="h-14 w-14 object-cover" style="color:transparent"
                                                src="https://picsum.photos/200">
                                        </div>
                                    </figcaption>
                                </figure>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <ul role="list" class="flex flex-col gap-y-6 sm:gap-y-8">
                            <li>
                                <figure
                                    class="relative rounded-2xl bg-white transition-shadow duration-300 shadow-md hover:shadow-xl p-6 shadow-slate-900/10">
                                    <svg aria-hidden="true" width="105" height="78"
                                        class="absolute left-6 top-6 fill-slate-100">
                                        <path
                                            d="M25.086 77.292c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622C1.054 58.534 0 53.411 0 47.686c0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C28.325 3.917 33.599 1.507 39.324 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Zm54.24 0c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622-2.11-4.52-3.164-9.643-3.164-15.368 0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C82.565 3.917 87.839 1.507 93.564 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Z">
                                        </path>
                                    </svg>
                                    <blockquote class="relative">
                                        <p class="text-lg tracking-tight text-slate-900">The best part about TaxPal is
                                            every time I pay my employees, my bank balance doesn’t go down like it used
                                            to. Looking forward to spending this extra cash when I figure out why my
                                            card is being declined.</p>
                                    </blockquote>
                                    <figcaption
                                        class="relative mt-6 flex items-center justify-between border-t border-slate-100 pt-6">
                                        <div>
                                            <div class="font-display text-base text-slate-900">Leland Kiehn</div>
                                            <div class="mt-1 text-sm text-slate-500">Founder of Kiehn and Sons</div>
                                        </div>
                                        <div class="overflow-hidden rounded-full bg-slate-50"><img alt=""
                                                loading="lazy" width="56" height="56" decoding="async"
                                                data-nimg="1" class="h-14 w-14 object-cover" style="color:transparent"
                                                src="https://picsum.photos/200">
                                        </div>
                                    </figcaption>
                                </figure>
                            </li>
                            <li>
                                <figure
                                    class="relative rounded-2xl bg-white transition-shadow duration-300 shadow-md hover:shadow-xl p-6 shadow-slate-900/10">
                                    <svg aria-hidden="true" width="105" height="78"
                                        class="absolute left-6 top-6 fill-slate-100">
                                        <path
                                            d="M25.086 77.292c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622C1.054 58.534 0 53.411 0 47.686c0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C28.325 3.917 33.599 1.507 39.324 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Zm54.24 0c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622-2.11-4.52-3.164-9.643-3.164-15.368 0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C82.565 3.917 87.839 1.507 93.564 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Z">
                                        </path>
                                    </svg>
                                    <blockquote class="relative">
                                        <p class="text-lg tracking-tight text-slate-900">There are so many things I had
                                            to do with my old software that I just don’t do at all with TaxPal.
                                            Suspicious but I can’t say I don’t love it.</p>
                                    </blockquote>
                                    <figcaption
                                        class="relative mt-6 flex items-center justify-between border-t border-slate-100 pt-6">
                                        <div>
                                            <div class="font-display text-base text-slate-900">Erin Powlowski</div>
                                            <div class="mt-1 text-sm text-slate-500">COO at Armstrong Inc</div>
                                        </div>
                                        <div class="overflow-hidden rounded-full bg-slate-50"><img alt=""
                                                loading="lazy" width="56" height="56" decoding="async"
                                                data-nimg="1" class="h-14 w-14 object-cover" style="color:transparent"
                                                src="https://picsum.photos/200">
                                        </div>
                                    </figcaption>
                                </figure>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <ul role="list" class="flex flex-col gap-y-6 sm:gap-y-8">
                            <li>
                                <figure
                                    class="relative rounded-2xl bg-white transition-shadow duration-300 shadow-md hover:shadow-xl p-6 shadow-slate-900/10">
                                    <svg aria-hidden="true" width="105" height="78"
                                        class="absolute left-6 top-6 fill-slate-100">
                                        <path
                                            d="M25.086 77.292c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622C1.054 58.534 0 53.411 0 47.686c0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C28.325 3.917 33.599 1.507 39.324 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Zm54.24 0c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622-2.11-4.52-3.164-9.643-3.164-15.368 0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C82.565 3.917 87.839 1.507 93.564 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Z">
                                        </path>
                                    </svg>
                                    <blockquote class="relative">
                                        <p class="text-lg tracking-tight text-slate-900">I used to have to remit tax to
                                            the EU and with TaxPal I somehow don’t have to do that anymore. Nervous to
                                            travel there now though.</p>
                                    </blockquote>
                                    <figcaption
                                        class="relative mt-6 flex items-center justify-between border-t border-slate-100 pt-6">
                                        <div>
                                            <div class="font-display text-base text-slate-900">Peter Renolds</div>
                                            <div class="mt-1 text-sm text-slate-500">Founder of West Inc</div>
                                        </div>
                                        <div class="overflow-hidden rounded-full bg-slate-50"><img alt=""
                                                loading="lazy" width="56" height="56" decoding="async"
                                                data-nimg="1" class="h-14 w-14 object-cover" style="color:transparent"
                                                src="https://picsum.photos/200">
                                        </div>
                                    </figcaption>
                                </figure>
                            </li>
                            <li>
                                <figure
                                    class="relative rounded-2xl bg-white transition-shadow duration-300 shadow-md hover:shadow-xl p-6 shadow-slate-900/10">
                                    <svg aria-hidden="true" width="105" height="78"
                                        class="absolute left-6 top-6 fill-slate-100">
                                        <path
                                            d="M25.086 77.292c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622C1.054 58.534 0 53.411 0 47.686c0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C28.325 3.917 33.599 1.507 39.324 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Zm54.24 0c-4.821 0-9.115-1.205-12.882-3.616-3.767-2.561-6.78-6.102-9.04-10.622-2.11-4.52-3.164-9.643-3.164-15.368 0-5.273.904-10.396 2.712-15.368 1.959-4.972 4.746-9.567 8.362-13.786a59.042 59.042 0 0 1 12.43-11.3C82.565 3.917 87.839 1.507 93.564 0l11.074 13.786c-6.479 2.561-11.677 5.951-15.594 10.17-3.767 4.219-5.65 7.835-5.65 10.848 0 1.356.377 2.863 1.13 4.52.904 1.507 2.637 3.089 5.198 4.746 3.767 2.41 6.328 4.972 7.684 7.684 1.507 2.561 2.26 5.5 2.26 8.814 0 5.123-1.959 9.19-5.876 12.204-3.767 3.013-8.588 4.52-14.464 4.52Z">
                                        </path>
                                    </svg>
                                    <blockquote class="relative">
                                        <p class="text-lg tracking-tight text-slate-900">This is the fourth email I’ve
                                            sent to your support team. I am literally being held in jail for tax fraud.
                                            Please answer your damn emails, this is important.</p>
                                    </blockquote>
                                    <figcaption
                                        class="relative mt-6 flex items-center justify-between border-t border-slate-100 pt-6">
                                        <div>
                                            <div class="font-display text-base text-slate-900">Amy Hahn</div>
                                            <div class="mt-1 text-sm text-slate-500">Director at Velocity Industries
                                            </div>
                                        </div>
                                        <div class="overflow-hidden rounded-full bg-slate-50"><img alt=""
                                                loading="lazy" width="56" height="56" decoding="async"
                                                data-nimg="1" class="h-14 w-14 object-cover" style="color:transparent"
                                                src="https://picsum.photos/200">
                                        </div>
                                    </figcaption>
                                </figure>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </section>

        <section id="pricing" aria-label="Pricing" class="bg-slate-900 py-20 sm:py-32">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="md:text-center">
                    <h2 class="font-display text-3xl tracking-tight text-white sm:text-4xl"><span
                            class="relative whitespace-nowrap"><svg aria-hidden="true" viewBox="0 0 281 40"
                                preserveAspectRatio="none" class="absolute left-0 top-1/2 h-[1em] w-full fill-blue-400">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M240.172 22.994c-8.007 1.246-15.477 2.23-31.26 4.114-18.506 2.21-26.323 2.977-34.487 3.386-2.971.149-3.727.324-6.566 1.523-15.124 6.388-43.775 9.404-69.425 7.31-26.207-2.14-50.986-7.103-78-15.624C10.912 20.7.988 16.143.734 14.657c-.066-.381.043-.344 1.324.456 10.423 6.506 49.649 16.322 77.8 19.468 23.708 2.65 38.249 2.95 55.821 1.156 9.407-.962 24.451-3.773 25.101-4.692.074-.104.053-.155-.058-.135-1.062.195-13.863-.271-18.848-.687-16.681-1.389-28.722-4.345-38.142-9.364-15.294-8.15-7.298-19.232 14.802-20.514 16.095-.934 32.793 1.517 47.423 6.96 13.524 5.033 17.942 12.326 11.463 18.922l-.859.874.697-.006c2.681-.026 15.304-1.302 29.208-2.953 25.845-3.07 35.659-4.519 54.027-7.978 9.863-1.858 11.021-2.048 13.055-2.145a61.901 61.901 0 0 0 4.506-.417c1.891-.259 2.151-.267 1.543-.047-.402.145-2.33.913-4.285 1.707-4.635 1.882-5.202 2.07-8.736 2.903-3.414.805-19.773 3.797-26.404 4.829Zm40.321-9.93c.1-.066.231-.085.29-.041.059.043-.024.096-.183.119-.177.024-.219-.007-.107-.079ZM172.299 26.22c9.364-6.058 5.161-12.039-12.304-17.51-11.656-3.653-23.145-5.47-35.243-5.576-22.552-.198-33.577 7.462-21.321 14.814 12.012 7.205 32.994 10.557 61.531 9.831 4.563-.116 5.372-.288 7.337-1.559Z">
                                </path>
                            </svg><span class="relative">Simple pricing,</span></span> <!-- -->for everyone.</h2>
                    <p class="mt-4 text-lg text-slate-400">It doesn’t matter what size your business is, our software
                        won’t work well for you.</p>
                </div>
                <div
                    class="-mx-4 mt-16 grid max-w-2xl grid-cols-1 gap-y-10 sm:mx-auto lg:-mx-8 lg:max-w-none lg:grid-cols-3 xl:mx-0 xl:gap-x-8">
                    <section class="flex flex-col rounded-3xl px-6 sm:px-8 lg:py-8">
                        <h3 class="mt-5 font-display text-lg text-white">Starter</h3>
                        <p class="mt-2 text-base text-slate-400">Good for anyone who is self-employed and just getting
                            started.</p>
                        <p class="order-first font-display text-5xl font-light tracking-tight text-white">$9</p>
                        <ul role="list" class="order-last mt-10 flex flex-col gap-y-3 text-sm text-slate-200">
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-slate-400">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Send 10 quotes and invoices</span></li>
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-slate-400">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Connect up to 2 bank accounts</span></li>
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-slate-400">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Track up to 15 expenses per month</span></li>
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-slate-400">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Manual payroll support</span></li>
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-slate-400">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Export up to 3 reports</span></li>
                        </ul><a
                            class="group inline-flex ring-1 items-center justify-center rounded-full py-2 px-4 text-sm focus:outline-none ring-slate-700 text-white hover:ring-slate-500 active:ring-slate-700 active:text-slate-400 focus-visible:outline-white mt-8"
                            aria-label="Get started with the Starter plan for $9" href="/register">Get started</a>
                    </section>
                    <section class="flex flex-col sm:rounded-3xl px-6 sm:px-8 order-first bg-blue-600 py-8 lg:order-none">
                        <h3 class="mt-5 font-display text-lg text-white">Small business</h3>
                        <p class="mt-2 text-base text-white">Perfect for small / medium sized businesses.</p>
                        <p class="order-first font-display text-5xl font-light tracking-tight text-white">$15</p>
                        <ul role="list" class="order-last mt-10 flex flex-col gap-y-3 text-sm text-white">
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-white">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Send 25 quotes and invoices</span></li>
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-white">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Connect up to 5 bank accounts</span></li>
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-white">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Track up to 50 expenses per month</span></li>
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-white">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Automated payroll support</span></li>
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-white">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Export up to 12 reports</span></li>
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-white">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Bulk reconcile transactions</span></li>
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-white">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Track in multiple currencies</span></li>
                        </ul><a
                            class="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-white text-slate-900 hover:bg-blue-50 active:bg-blue-200 active:text-slate-600 focus-visible:outline-white mt-8"
                            aria-label="Get started with the Small business plan for $15" href="/register">Get
                            started</a>
                    </section>
                    <section class="flex flex-col rounded-3xl px-6 sm:px-8 lg:py-8">
                        <h3 class="mt-5 font-display text-lg text-white">Enterprise</h3>
                        <p class="mt-2 text-base text-slate-400">For even the biggest enterprise companies.</p>
                        <p class="order-first font-display text-5xl font-light tracking-tight text-white">$39</p>
                        <ul role="list" class="order-last mt-10 flex flex-col gap-y-3 text-sm text-slate-200">
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-slate-400">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Send unlimited quotes and invoices</span></li>
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-slate-400">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Connect up to 15 bank accounts</span></li>
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-slate-400">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Track up to 200 expenses per month</span></li>
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-slate-400">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Automated payroll support</span></li>
                            <li class="flex"><svg aria-hidden="true"
                                    class="h-6 w-6 flex-none fill-current stroke-current text-slate-400">
                                    <path
                                        d="M9.307 12.248a.75.75 0 1 0-1.114 1.004l1.114-1.004ZM11 15.25l-.557.502a.75.75 0 0 0 1.15-.043L11 15.25Zm4.844-5.041a.75.75 0 0 0-1.188-.918l1.188.918Zm-7.651 3.043 2.25 2.5 1.114-1.004-2.25-2.5-1.114 1.004Zm3.4 2.457 4.25-5.5-1.187-.918-4.25 5.5 1.188.918Z"
                                        stroke-width="0"></path>
                                    <circle cx="12" cy="12" r="8.25" fill="none" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></circle>
                                </svg><span class="ml-4">Export up to 25 reports, including TPS</span></li>
                        </ul><a
                            class="group inline-flex ring-1 items-center justify-center rounded-full py-2 px-4 text-sm focus:outline-none ring-slate-700 text-white hover:ring-slate-500 active:ring-slate-700 active:text-slate-400 focus-visible:outline-white mt-8"
                            aria-label="Get started with the Enterprise plan for $39" href="/register">Get started</a>
                    </section>
                </div>
            </div>
        </section>

        <section id="faq" aria-labelledby="faq-title"
            class="relative overflow-hidden bg-slate-50 py-20 sm:py-32">
            <img alt="" loading="lazy" width="1558" height="946" decoding="async" data-nimg="1"
                class="absolute left-1/2 top-0 max-w-none -translate-y-1/4 translate-x-[-30%]" style="color:transparent"
                src="/_next/static/media/background-faqs.55d2e36a.jpg">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative">
                <div class="mx-auto max-w-2xl lg:mx-0">
                    <h2 id="faq-title" class="font-display text-3xl tracking-tight text-slate-900 sm:text-4xl">
                        Frequently asked questions</h2>
                    <p class="mt-4 text-lg tracking-tight text-slate-700">If you can’t find what you’re looking for,
                        email our support team and if you’re lucky someone will get back to you.</p>
                </div>
                <ul role="list" class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 lg:max-w-none lg:grid-cols-3">
                    <li>
                        <ul role="list" class="flex flex-col gap-y-8">
                            <li>
                                <h3 class="font-display text-lg leading-7 text-slate-900">Does TaxPal handle VAT?</h3>
                                <p class="mt-4 text-sm text-slate-700">Well no, but if you move your company offshore
                                    you can probably ignore it.</p>
                            </li>
                            <li>
                                <h3 class="font-display text-lg leading-7 text-slate-900">Can I pay for my subscription
                                    via purchase order?</h3>
                                <p class="mt-4 text-sm text-slate-700">Absolutely, we are happy to take your money in
                                    all forms.</p>
                            </li>
                            <li>
                                <h3 class="font-display text-lg leading-7 text-slate-900">How do I apply for a job at
                                    TaxPal?</h3>
                                <p class="mt-4 text-sm text-slate-700">We only hire our customers, so subscribe for a
                                    minimum of 6 months and then let’s talk.</p>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <ul role="list" class="flex flex-col gap-y-8">
                            <li>
                                <h3 class="font-display text-lg leading-7 text-slate-900">What was that testimonial
                                    about tax fraud all about?</h3>
                                <p class="mt-4 text-sm text-slate-700">TaxPal is just a software application,
                                    ultimately your books are your responsibility.</p>
                            </li>
                            <li>
                                <h3 class="font-display text-lg leading-7 text-slate-900">TaxPal sounds horrible but
                                    why do I still feel compelled to purchase?</h3>
                                <p class="mt-4 text-sm text-slate-700">This is the power of excellent visual design.
                                    You just can’t resist it, no matter how poorly it actually functions.</p>
                            </li>
                            <li>
                                <h3 class="font-display text-lg leading-7 text-slate-900">I found other companies
                                    called TaxPal, are you sure you can use this name?</h3>
                                <p class="mt-4 text-sm text-slate-700">Honestly not sure at all. We haven’t actually
                                    incorporated or anything, we just thought it sounded cool and made this website.</p>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <ul role="list" class="flex flex-col gap-y-8">
                            <li>
                                <h3 class="font-display text-lg leading-7 text-slate-900">How do you generate reports?
                                </h3>
                                <p class="mt-4 text-sm text-slate-700">You just tell us what data you need a report
                                    for, and we get our kids to create beautiful charts for you using only the finest
                                    crayons.</p>
                            </li>
                            <li>
                                <h3 class="font-display text-lg leading-7 text-slate-900">Can we expect more inventory
                                    features?</h3>
                                <p class="mt-4 text-sm text-slate-700">In life it’s really better to never expect
                                    anything at all.</p>
                            </li>
                            <li>
                                <h3 class="font-display text-lg leading-7 text-slate-900">I lost my password, how do I
                                    get into my account?</h3>
                                <p class="mt-4 text-sm text-slate-700">Send us an email and we will send you a copy of
                                    our latest password spreadsheet so you can find your information.</p>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </section>
    </main>

    <footer class="bg-slate-50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="py-16">
                <img src="{{ asset('img/simplecom/png/logo-color.png') }}" alt="Logo img"
                    class="mx-auto h-32 sm:h-36 rounded-full w-auto shadow-md" />

                <nav class="mt-10 text-sm" aria-label="quick links">
                    <div class="-my-1 flex justify-center gap-x-6"><a
                            class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900"
                            href="#features">Features</a><a
                            class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900"
                            href="#testimonials">Testimonials</a><a
                            class="inline-block rounded-lg px-2 py-1 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900"
                            href="#pricing">Pricing</a></div>
                </nav>
            </div>
            <div
                class="flex flex-col items-center border-t border-slate-400/10 py-10 sm:flex-row-reverse sm:justify-between">
                <div class="flex gap-x-6"><a class="group" aria-label="TaxPal on Twitter"
                        href="https://twitter.com"><svg aria-hidden="true"
                            class="h-6 w-6 fill-slate-500 group-hover:fill-slate-700">
                            <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0 0 22 5.92a8.19 8.19 0 0 1-2.357.646 4.118 4.118 0 0 0 1.804-2.27 8.224 8.224 0 0 1-2.605.996 4.107 4.107 0 0 0-6.993 3.743 11.65 11.65 0 0 1-8.457-4.287 4.106 4.106 0 0 0 1.27 5.477A4.073 4.073 0 0 1 2.8 9.713v.052a4.105 4.105 0 0 0 3.292 4.022 4.093 4.093 0 0 1-1.853.07 4.108 4.108 0 0 0 3.834 2.85A8.233 8.233 0 0 1 2 18.407a11.615 11.615 0 0 0 6.29 1.84">
                            </path>
                        </svg></a><a class="group" aria-label="TaxPal on GitHub" href="https://github.com"><svg
                            aria-hidden="true" class="h-6 w-6 fill-slate-500 group-hover:fill-slate-700">
                            <path
                                d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0 1 12 6.844a9.59 9.59 0 0 1 2.504.337c1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.02 10.02 0 0 0 22 12.017C22 6.484 17.522 2 12 2Z">
                            </path>
                        </svg></a></div>
                <p class="mt-6 text-sm text-slate-500 sm:mt-0">Copyright © <!-- -->2023<!-- --> TaxPal. All rights
                    reserved.</p>
            </div>
        </div>
    </footer>
@endsection
