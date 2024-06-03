@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 text-base md:text-sm w-full text-gray-100 bg-green-600 rounded'
            : 'flex items-center px-4 py-3 text-base md:text-sm w-full transition duration-300 ease-in-out hover:bg-green-600 hover:text-gray-100 text-gray-700 rounded';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $icon }}
    <span>{{ $slot }}</span>
</a>
