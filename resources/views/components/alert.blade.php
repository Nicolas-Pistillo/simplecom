@php
    $color = $color ?? 'blue';
@endphp

<div x-data="{open: true}" x-show="open"
    {{ $attributes->merge([
        'class' => "animate__animated max-w-max border-l-4 rounded-md 
        border-$color-400 bg-$color-50 p-2.5 shadow"
    ])}}>
    <div class="flex items-center">

        <div class="flex-shrink-0 self-start">
            <x-icon code="{{ $icon ?? 'info' }}" 
            class="text-{{ $color }}-500 bg-{{ $color }}-200 p-1 rounded-lg" />
        </div>

        <div class="ml-3">
            @if (isset($title))
                <h3 class="text-xs sm:text-sm font-semibold text-{{ $color }}-700">{{ $title }}</h3>
            @endif
            <p class="font-medium text-xs sm:text-sm text-{{ $color }}-600">
                {{ $slot }}
            </p>
        </div>

        @isset($dismissible)
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button @click="open = false" type="button"
                    class="inline-flex rounded-md bg-{{ $color }}-50 p-1.5 
                    text-{{ $color }}-500 hover:bg-{{ $color }}-100">
                        <x-icon code="close" style="font-size: 18px" />
                    </button>
                </div>
            </div>
        @endisset
    </div>
</div>
