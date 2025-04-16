@if ($collections->isNotEmpty())
    <div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">
        <div class="flex items-center justify-between gap-x-4 mb-8">
            <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-gray-900">
                Colecciones
            </h2>

            <div class="flex justify-center items-center">

                <x-icon id="collections-prev-btn" code="navigate_before" 
                class="no-select p-2 rounded-full border-2 hover:bg-gray-200/60 
                transition-colors duration-300"
                />

                <x-icon id="collections-next-btn" code="navigate_next" 
                class="no-select ml-2 p-2 rounded-full border-2 hover:bg-gray-200/60 
                transition-colors duration-300"
                />
            </div>
        </div>
        <div class="w-full relative">
            <div id="collections-slider" class="swiper swiper-container relative">
                <div class="swiper-wrapper flex relative w-full h-max no-select">
                    @foreach ($collections as $collection)
                        <a href="#" class="swiper-slide rounded-2xl relative group overflow-hidden w-96 h-96">
                            <img src="{{ Storage::URL($collection->image_url) }}" alt="{{ $collection->name }}"
                            class="relative block w-full h-96 transition-all duration-1000 
                            group-hover:scale-110 group-hover:rotate-3 rounded-2xl object-cover">
                            <div class="absolute top-0 left-0 p-8 w-full h-full flex items-end" 
                            style="backdrop-filter: brightness(0.5)">
                                <div class="block">
                                    <h4 class="font-medium text-3xl sm:text-4xl leading-snug text-white mb-1.5">
                                    {{ $collection->name }}
                                    </h4>
                                    <p class="sm:text-lg font-normal text-white">
                                        {{ $collection->description }}
                                    </p>
                                </div>
                            </div>
                        </a>
                        {{-- <a href="#" class="swiper-slide rounded-2xl relative group overflow-hidden w-96 h-96">
                            <img src="https://cdn.denimandcloth.com.au/content/uploads/2014/11/18121834/adidas-banner.jpg" alt="men with t-shirt"
                                class="relative block w-full h-96 transition-all duration-1000 
                                group-hover:scale-110 group-hover:rotate-3 rounded-2xl object-cover">
                            <div class="absolute top-0 left-0 p-8 w-full h-full flex items-end" 
                            style="backdrop-filter: brightness(0.5)">
                                <div class="block">
                                    <h4 class="font-medium text-3xl sm:text-4xl leading-snug text-white mb-1.5">
                                        Men Collection
                                    </h4>
                                    <p class="sm:text-lg font-normal text-white">
                                        Elevate your look with our stylish men's shirts, perfect for any occasion
                                    </p>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="swiper-slide rounded-2xl relative group overflow-hidden w-96 h-96">
                            <img src="https://latranqueramuebles.com.ar/webfiles/latranquera/paginas/36/1_1000x1000.jpg?v=1648291235" alt="men with t-shirt"
                                class="relative block w-full h-96 transition-all duration-1000 
                                group-hover:scale-110 group-hover:rotate-3 rounded-2xl object-cover">
                            <div class="absolute top-0 left-0 p-8 w-full h-full flex items-end" 
                            style="backdrop-filter: brightness(0.5)">
                                <div class="block">
                                    <h4 class="font-medium text-3xl sm:text-4xl leading-snug text-white mb-1.5">
                                        Una colección de ensueño
                                    </h4>
                                    <p class="sm:text-lg font-normal text-white">
                                        Las mejores ofertas (testing) que podes encontrar ahora y siempre
                                    </p>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="swiper-slide rounded-2xl relative group overflow-hidden w-96 h-96">
                            <img src="https://mijormi.vteximg.com.br/arquivos/ids/184514/Landmark_Home%20Banner_Financiacion%20la%20nacion_480x520%20px.jpg?v=638796346556930000" alt="men with t-shirt"
                                class="relative block w-full h-96 transition-all duration-1000 
                                group-hover:scale-110 group-hover:rotate-3 rounded-2xl object-cover">
                            <div class="absolute top-0 left-0 p-8 w-full h-full flex items-end" 
                            style="backdrop-filter: brightness(0.5)">
                                <div class="block">
                                    <h4 class="font-medium text-3xl sm:text-4xl leading-snug text-white mb-1.5">
                                        ¡Descuentos imperdibles!
                                    </h4>
                                    <p class="sm:text-lg font-normal text-white">
                                        Las mejores ofertas (testing) que podes encontrar ahora y siempre
                                    </p>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="swiper-slide rounded-2xl relative group overflow-hidden w-96 h-96">
                            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEi9uJFBw0j1Mbkvc7jgXx7wv0PJGwD2xiFU0nxehfD7RjVbLbvDZsaxWvkG0tIPxsdwq6WEywVuFKdvukof14NtENcW2paDuSTqzFmu6s5I2eRqm1eIarLcNsPRDJC0WT46vans4Z1WLw695JBUdrAjXEMG9t9eOcp_2joCCiListHu9onbSE59EmtJ/w1200-h630-p-k-no-nu/Moda%20primavera%20verano%202023.jpg" alt="men with t-shirt"
                                class="relative block w-full h-96 transition-all duration-1000 
                                group-hover:scale-110 group-hover:rotate-3 rounded-2xl object-cover">
                            <div class="absolute top-0 left-0 p-8 w-full h-full flex items-end" 
                            style="backdrop-filter: brightness(0.5)">
                                <div class="block">
                                    <h4 class="font-medium text-3xl sm:text-4xl leading-snug text-white mb-1.5">
                                        Primavera 2025
                                    </h4>
                                    <p class="sm:text-lg font-normal text-white">
                                        Encontra tu outfit de verano ideal hoy mismo
                                    </p>
                                </div>
                            </div>
                        </a> --}}
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        new Swiper("#collections-slider", 
        {
            loop: true,
            navigation: {
                nextEl: "#collections-next-btn",
                prevEl: "#collections-prev-btn",
            },
            autoplay: {
                delay: 4000,
                pauseOnMouseEnter: true
            },
            slidesPerView: 1,
            spaceBetween: 40,
            breakpoints: {
            430: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 2
            },
            1200: {
                slidesPerView: 3
            }
        }
        });
    </script>
@endif

{{-- <div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">

        <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-8">
            Novedades
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-md mx-auto md:max-w-3xl lg:max-w-full">
            <div class="flex flex-col gap-8">
                <div class="rounded-2xl p-8 bg-emerald-100 ">
                    <h6 class="text-xl font-semibold leading-8 text-gray-900 mb-2.5">
                        Elevate your holiday joy with a festive 20% discount using code xzTnm
                    </h6>
                    <button type="button"
                        class="ml-auto flex w-max py-2 border border-gray-500 px-6 text-sm max-h-max bg-emerald-100 text-gray-900 rounded-full cursor-pointer font-medium text-center shadow-xs transition-all duration-500 hover:bg-black hover:text-white">
                        Special Offer
                    </button>
                </div>
                <a href="javascript:;" class="rounded-2xl relative group overflow-hidden cursor-pointer">
                    <img src="https://pagedone.io/asset/uploads/1710392347.png" alt="men with t-shirt"
                        class="relative w-full h-full transition-all duration-1000 group-hover:scale-110 group-hover:rotate-3 rounded-2xl object-cover">
                    <div class="absolute top-0 left-0 p-8 w-full h-full flex items-end">
                        <div class="block">
                            <h4 class="font-medium text-4xl leading-snug text-white mb-1.5">
                                Man’s Shirt
                            </h4>
                            <p class="text-lg font-normal text-white">
                                Elevate your look with our stylish men's shirts, perfect for any occasion
                            </p>
                        </div>
                    </div>
                </a>
            </div>
            <div
                class="grid grid-cols-1 md:col-span-2 lg:col-span-1 md:grid-cols-2 lg:grid-cols-1 gap-8 md:order-last lg:order-none">
                <a href="javascript:;" class="rounded-2xl relative group overflow-hidden">
                    <img src="https://pagedone.io/asset/uploads/1710392359.png" alt="men with t-shirt"
                        class="relative w-full h-full transition-all duration-1000 group-hover:scale-110 group-hover:rotate-3  rounded-2xl object-cover">
                    <div class="absolute top-0 left-0 p-8 w-full h-full flex items-end">
                        <div class="block">
                            <h4 class="font-medium text-4xl leading-snug text-white ">
                                Men <br>
                                Collection
                            </h4>

                        </div>
                    </div>
                </a>
                <a href="javascript:;" class="rounded-2xl relative group overflow-hidden">
                    <img src="https://pagedone.io/asset/uploads/1710392370.png" alt="men with t-shirt"
                        class="relative w-full h-full transition-all duration-1000 group-hover:scale-110 group-hover:rotate-3 rounded-2xl object-cover">
                    <div class="absolute top-0 left-0 p-8 w-full h-full flex items-end">
                        <div class="block">
                            <h4 class="font-manrope font-medium text-4xl leading-snug text-white ">
                                Women <br>
                                Collection
                            </h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="rounded-2xl relative overflow-hidden group">
                <img src="https://pagedone.io/asset/uploads/1710392382.png" alt="men with t-shirt"
                    class="relative w-full h-full transition-all duration-1000 group-hover:scale-110 group-hover:rotate-3 rounded-2xl object-cover">
                <div class="absolute top-0 left-0 p-8 w-full h-full flex items-end">
                    <div class="block">
                        <h4 class="font-manrope font-medium text-4xl leading-snug text-white mb-2">
                            Girl’s Top
                        </h4>
                        <p class="text-lg font-normal text-white leading-relaxed mb-2">
                            Everyday allure, wrapped in mystery
                        </p>
                        <button type="button"
                            class="w-max py-2 bg-white hover:bg-gray-100 px-5 text-black text-sm leading-6 font-medium max-h-max rounded-full cursor-pointer text-center shadow-xs transition-all duration-500">
                            Shop Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
</div> --}}