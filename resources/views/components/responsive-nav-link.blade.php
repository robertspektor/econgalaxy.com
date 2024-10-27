@props(['active'])

@php
$classes = ($active ?? false)
            ? 'hs-tooltip-toggle flex justify-center items-center gap-x-3 size-10 text-sm text-gray-800 rounded-lg bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700'
            : 'hs-tooltip-toggle flex justify-center items-center gap-x-3 size-10 text-sm text-gray-800 rounded-lg hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-100 dark:hover:bg-neutral-700 dark:text-neutral-300 dark:focus:bg-neutral-700';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
