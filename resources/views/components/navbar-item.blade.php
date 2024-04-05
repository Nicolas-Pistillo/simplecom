<li class="{{ $itemClasses ?? '' }}">
    <a href="{{ route($route) }}"
    class="flex gap-x-3 rounded-md transition-colors duration-200 p-2 
    text-sm leading-6 font-semibold hover:bg-gray-50 {{ $linkClasses ?? '' }}
    {{ Route::is($route) || (isset($active) && $active == true) ? "bg-gray-50 text-blue-600 shadow" : "text-gray-600 hover:text-blue-600" }}">
        <x-icon code="{{ $icon }}" /> {{ $title }}
    </a>
</li>