@if ($banners->isNotEmpty())
    <div class="w-full relative shadow-md">
        <div class="swiper banner-slider swiper-container">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <a href="{{ !empty($banner->link) ? $banner->link : '#' }}"
                        class="swiper-slide {{ empty($banner->link) ? 'cursor-default' : '' }}">
                        <img src="{{ Storage::url($banner->image_url) }}" alt="{{ $banner->name }}"
                            class="w-full object-cover">
                    </a>
                @endforeach
            </div>

            <div class="swiper-pagination"></div>
        </div>
    </div>

    <script>
        new Swiper(".banner-slider", {
            loop: true,
            speed: 500,
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            autoplay: {
                delay: 5000,
                pauseOnMouseEnter: true
            },
        });
    </script>
@endif
