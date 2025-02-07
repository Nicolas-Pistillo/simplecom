@php
    $color = $color ?? 'blue';
@endphp

<div x-data="{open: true}" x-show="open"
    {{ $attributes->merge([
        'class' => "animate__animated max-w-max border-l-4 rounded-md 
        border-$color-400 bg-$color-50 p-2.5 shadow"
    ])}}>
    <div class="flex items-center">

        <div class="flex-shrink-0">
            <x-icon code="{{ $icon ?? 'info' }}" 
            class="text-{{ $color }}-500 bg-{{ $color }}-200 p-1 rounded-lg" />
        </div>

        <div class="ml-3">
            @if (isset($title))
                <h3 class="text-xs sm:text-sm font-semibold text-{{ $color }}-800">{{ $title }}</h3>
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

{{-- @php
    $type = $type ?? 'info';
@endphp

@switch($type)
    @case('info')
        <div x-data="{alertOpen: true}" x-show="alertOpen"
        {{ $attributes->merge(['class' => 'animate__animated border-l-4 border-blue-400 rounded-md bg-blue-50 p-2.5 shadow']) }}>
            <div class="flex items-center">

                <x-icon code="info" class="text-blue-500 p-1 bg-blue-200 rounded-lg" />

                <div class="ml-3 flex-1 flex justify-between">
                    <p class="text-sm text-blue-700"> 
                        {{ $slot }} 
                    </p>

                    @isset($dismissible)
                        <div class="pl-3">
                            <div class="-mx-1.5 -my-1.5">
                                <button @click="alertOpen = false" type="button" class="inline-flex transition-colors duration-300 rounded-md bg-blue-50 p-1.5 text-blue-500 hover:bg-blue-100">
                                <span class="sr-only">Dismiss</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                </svg>
                                </button>
                            </div>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
        @break
    @case('success')
        <div x-data="{alertOpen: true}" x-show="alertOpen"
        {{ $attributes->merge(['class' => 'animate__animated border-l-4 border-green-400 rounded-md bg-green-50 p-2.5 shadow']) }}>
            <div class="flex items-center">

                <x-icon code="check" class="text-green-500 p-1 bg-green-200 rounded-lg" />

                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        {{ $slot }}
                    </p>
                </div>

                @isset($dismissible)
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button @click="alertOpen = false" type="button" class="inline-flex transition-colors duration-300 rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100">
                                <span class="sr-only">Dismiss</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
        @break
    @case('warning')
        <div x-data="{alertOpen: true}" x-show="alertOpen"
        {{ $attributes->merge(['class' => 'animate__animated border-l-4 rounded-md border-yellow-400 bg-yellow-50 p-2.5 shadow']) }}>
            <div class="flex items-center">

                <div class="flex-shrink-0">
                    <x-icon code="warning" class="text-yellow-500 bg-yellow-200 p-1 rounded-lg" />
                </div>

                <div class="ml-3">
                    @if (isset($alertTitle))
                        <h3 class="text-sm font-medium text-yellow-600">{{ $alertTitle }}</h3>
                    @endif
                    <p class="font-medium text-sm text-yellow-800">
                        {{ $slot }}
                    </p>
                </div>

                @isset($dismissible)
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button @click="alertOpen = false" type="button" class="inline-flex rounded-md bg-yellow-50 p-1.5 text-yellow-500 hover:bg-yellow-100">
                            <span class="sr-only">Dismiss</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                            </svg>
                            </button>
                        </div>
                    </div>
                @endisset
            </div>
        </div>  
        @break
    @case('error')
        <div x-data="{alertOpen: true}" x-show="alertOpen"
        {{ $attributes->merge(['class' => 'animate__animated border-l-4 border-red-400 rounded-md bg-red-50 p-2.5 shadow']) }}>
            <div class="flex items-center">

                <div class="flex-shrink-0">
                    <x-icon code="error" class="text-red-500 bg-red-200 p-1 rounded-lg" />
                </div>

                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">
                        {{ $slot }}
                    </h3>
                </div>

                @isset($dismissible)
                    <div class="ml-auto pl-3">
                        <div class="-mx-1.5 -my-1.5">
                            <button @click="alertOpen = false" type="button" class="inline-flex transition-colors duration-300 rounded-md bg-red-50 p-1.5 text-red-500 hover:bg-red-100">
                            <span class="sr-only">Dismiss</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                            </svg>
                            </button>
                        </div>
                    </div>
                @endisset
            </div>
        </div>   
        @break
    @default
@endswitch --}}
