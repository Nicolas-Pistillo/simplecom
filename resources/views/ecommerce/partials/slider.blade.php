@if ($banners->isNotEmpty())
    <div class="mb-16 shadow-md" style="height: 420px"
        data-flickity='{ "wrapAround": true, "prevNextButtons": false, "autoPlay": 5000 }'>
        @foreach ($banners as $banner)
            <div class="w-full h-full">
                <img class="w-full h-full object-cover" src="{{ Storage::url($banner->image_url) }}">
            </div>
        @endforeach
    </div>
@endif
