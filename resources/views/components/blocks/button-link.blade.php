@props([
    'color' => 'danger',
    'icon' => null,
    'iconPosition' => 'right',
])

@php
$iconPosition = match ($iconPosition ?? null) {
    'right', 'r' => 'right',
    'left', 'l' => 'left',
    default => 'right',
};

$rightIcon = ($icon ?? null) && $iconPosition === 'right' ? $icon : null;
$leftIcon = ($icon ?? null) && $iconPosition === 'left' ? $icon : null;

$classes = match ($color ?? 'danger') {
    'red', 'danger' => 'bg-red-600 hover:bg-red-500 active:bg-red-700 focus:ring-red-500',
    'green', 'success' => 'bg-green-600 hover:bg-green-500 active:bg-green-700 focus:ring-green-500',
    'yellow', 'warning' => 'bg-yellow-600 hover:bg-yellow-500 active:bg-yellow-700 focus:ring-yellow-500',
    'orange' => 'bg-orange-600 hover:bg-orange-500 active:bg-orange-700 focus:ring-orange-500',
    'sky', 'blue', 'info' => 'bg-sky-600 hover:bg-sky-500 active:bg-sky-700 focus:ring-sky-500',
    'gray' => 'bg-gray-600 hover:bg-gray-500 active:bg-gray-700 focus:ring-gray-500',
    default => '',
};

$classes .= 'text-center inline-flex items-center me-2 border border-transparent rounded-md font-semibold text-xs text-white tracking-widest   focus:outline-none ring-0 transition ease-in-out duration-150';
@endphp

<a
    {{ $attributes->merge([
        'href' => '#!',
        'class' => $classes,
]) }}>
    @if ($leftIcon)
        @svg($leftIcon, 'w-3.5 h-3.5 ml-1')
    @endif
    {{ $slot }}
    @if ($rightIcon)
        @svg($rightIcon, 'w-3.5 h-3.5 ml-1')
    @endif
</a>
