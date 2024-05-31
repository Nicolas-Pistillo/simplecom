<div class="w-full relative shadow-md">
    <div class="swiper banner-slider swiper-container">
        <div class="swiper-wrapper">
            @foreach ($banners as $banner)
                <div class="swiper-slide">
                    <img src="{{ Storage::url($banner->image_url) }}" alt="{{ $banner->name }}"
                    class="w-full h-[420px] object-cover">
                </div>
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
            clickable: true,
        },
        navigation: {
            nextEl: ".next-btn",
            prevEl: ".prev-btn",
        },
    });
</script>
