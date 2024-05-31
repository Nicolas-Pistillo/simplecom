<div class="mx-auto max-w-7xl px-4 py-8 lg:px-8">

    <h2 class="text-2xl font-bold tracking-tight text-gray-900 mb-8">
        Productos destacados
    </h2>

    <div class="w-full relative">
        <div class="swiper featured-products-slider swiper-container relative mb-6">
            <div class="swiper-wrapper relative w-full h-max">
                @foreach ($featuredProducts as $product)
                    <div class="swiper-slide">
                        <div class="w-full flex justify-center items-start">
                            <x-ecommerce.product-card :product="$product" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flex justify-center items-center">

            <x-icon id="featured-prev-btn" code="navigate_before" 
            class="no-select p-2 rounded-full border-2 hover:bg-gray-200/60 
            transition-colors duration-300"
            />

            <x-icon id="featured-next-btn" code="navigate_next" 
            class="no-select ml-2 p-2 rounded-full border-2 hover:bg-gray-200/60 
            transition-colors duration-300"
            />
        </div>
    </div>
</div>

<script>
    new Swiper(".featured-products-slider", {
        loop: true,
        speed: 200,
        slidesPerView: 1,
        spaceBetween: 20,
        navigation: {
            nextEl: "#featured-next-btn",
            prevEl: "#featured-prev-btn",
        },
        breakpoints: {
            700: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            1000: {
                slidesPerView: 3,
                spaceBetween: 40
            },
            1280: {
                slidesPerView: 4,
                spaceBetween: 40,
            }
        }
    });
</script>
