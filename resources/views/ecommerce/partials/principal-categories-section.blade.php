@if ($principal_categories->isNotEmpty())
    <div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">

        <div class="flex items-center justify-between gap-x-4 mb-8">
            <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-gray-900">
                Nuestras categorías
            </h2>

            <div class="flex justify-center items-center">

                <x-icon id="princial-categories-prev-btn" code="navigate_before" 
                class="no-select p-2 rounded-full border-2 hover:bg-gray-200/60 
                transition-colors duration-300"
                />

                <x-icon id="princial-categories-next-btn" code="navigate_next" 
                class="no-select ml-2 p-2 rounded-full border-2 hover:bg-gray-200/60 
                transition-colors duration-300"
                />
            </div>
        </div>

        <div class="w-full relative">
            <div id="principal-categories-slider" class="swiper swiper-container relative">
                <div class="swiper-wrapper flex relative w-full h-max">
                    @foreach ($principal_categories as $category)
                        <div class="swiper-slide cursor-pointer text-center">
        
                            <img class="rounded-full mb-1.5 object-cover mx-auto 
                            w-20 h-20 sm:w-28 sm:h-28 shadow" 
                            src="{{ $category->image }}" alt="">
        
                            <h6 class="line-clamp-2 text-sm text-gray-800 font-semibold">
                                {{ $category->name }}
                            </h6>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <script>
            new Swiper("#principal-categories-slider", 
            {
                loop: true,
                navigation: {
                    nextEl: "#princial-categories-next-btn",
                    prevEl: "#princial-categories-prev-btn",
                },
                autoplay: {
                    delay: 2000,
                    pauseOnMouseEnter: true
                },
                slidesPerView: 3,
                breakpoints: {
                550: {
                    slidesPerView: 4
                },
                950: {
                    slidesPerView: 7
                },
                1200: {
                    slidesPerView: 8
                }
            }
            });
        </script>
    </div>
@endif