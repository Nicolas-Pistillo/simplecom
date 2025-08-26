@config('promotional_message')
    <div class="w-full bg-black text-white overflow-hidden">
        <div class="text-center py-1 sm:py-2">
            <div
                class="w-full animate-infinite-scroll inline-flex flex-nowrap 
                items-center justify-center gap-x-6">
                @for ($i = 0; $i < 15; $i++)
                    <h4 class="whitespace-nowrap text-xs sm:text-base">{{ $value }}</h4>
                @endfor
            </div>
        </div>
    </div>
@endconfig
