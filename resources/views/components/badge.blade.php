@php
    $baseClasses = 'inline-flex cursor-pointer items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset';

    $colors = [
        'green'   => 'bg-green-50 text-green-700 ring-green-600/20',
        'yellow'  => 'bg-yellow-50 text-yellow-800 ring-yellow-600/20',
        'red'     => 'bg-red-50 text-red-700 ring-red-600/10',
        'gray'    => 'bg-gray-50 text-gray-600 ring-gray-500/10',
        'blue'    => 'bg-blue-50 text-blue-700 ring-blue-700/10',
        'indigo'  => 'bg-indigo-50 text-indigo-700 ring-indigo-700/10',
        'purple'  => 'bg-purple-50 text-purple-700 ring-purple-700/10',
        'violet'  => 'bg-violet-50 text-violet-700 ring-violet-700/10',
        'emerald' => 'bg-emerald-50 text-emerald-700 ring-emerald-700/10',
        'lime'    => 'bg-lime-50 text-lime-700 ring-lime-700/10',
        'cyan'    => 'bg-cyan-50 text-cyan-700 ring-cyan-700/10',
        'amber'   => 'bg-amber-50 text-amber-700 ring-amber-700/10',
        'orange'  => 'bg-orange-50 text-orange-700 ring-orange-700/10',
        'pink'    => 'bg-pink-50 text-pink-700 ring-pink-700/10'
    ];

    $color = isset($color) ? $colors[$color] : $colors['gray'];

    $badgeClass = "$baseClasses $color";
@endphp

<span {{ $attributes->merge(['class' => $badgeClass]) }}>
    @isset($icon)
        <x-icon :code="$icon" class="text-sm mr-1" />
    @endisset
    {{ $slot }}
</span>