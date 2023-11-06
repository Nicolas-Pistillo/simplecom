<div {{ $attributes->merge(['class' => 'relative z-0']) }}">
    <input type="{{ $type ?? 'text' }}" id="floating_standard" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
    value="{{ $value ?? '' }}" name="{{ $name ?? '' }}" @isset($required) required @endisset
    placeholder=" " />
    <label for="floating_standard" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
        {{ $label }}
    </label>
    @if (isset($error) && $error != '')
        <small class="text-xs text-red-500">{{ $error }}</small>
    @else
        @isset($placeholder)
            <small class="text-gray-500 text-xs"> {{ $placeholder }} </small>
        @endisset
    @endif
</div>