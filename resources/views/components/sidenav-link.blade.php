@props(['active'])

@php
$classes = ($active ?? false)
            ? 'bg-gray-200 border-orange-300 border-l-4 flex items-center justify-start gap-4 px-5 py-3 transition duration-150 ease-in-out'
            : 'flex items-center justify-start gap-4 px-5 py-3 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
