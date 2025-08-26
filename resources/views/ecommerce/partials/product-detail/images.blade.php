<div x-data="{ currentImage: '{{ $product->first_image }}' }" 
class="mx-auto lg:mx-0 max-w-2xl lg:col-span-4 lg:row-end-1 lg:mt-0 lg:max-w-none">

    {{-- Current showing image --}}
    <img x-bind:src="currentImage" alt="{{ $product->name }}"
    class="w-full sm:w-[600px] h-[350px] sm:h-[450px] 
    rounded-md object-contain mb-4" />

    {{-- All product images list --}}
    <div class="flex items-center gap-3 flex-wrap mx-auto">
        @if ($product->images->count() > 1)

            @foreach ($product->images as $image)

                <div class="shadow rounded-xl border-2 border-transparent
                cursor-pointer overflow-hidden"
                    :class="currentImage == '{{ Storage::url($image->url) }}' ?
                        '!border-blue-600' :
                        'hover:border-blue-600'">
                    <img src="{{ Storage::url($image->url) }}" class="w-16 h-16 object-cover rounded-lg"
                    alt="product-image" @mouseenter.prevent="currentImage = '{{ Storage::url($image->url) }}'">
                </div>
            @endforeach
        @endif
    </div>
</div>
