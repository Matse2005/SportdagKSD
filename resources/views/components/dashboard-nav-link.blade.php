@props(['active', 'icon', 'url', 'page'])

@php
    $classes = $active ?? false ? 'flex w-full justify-between text-ksdGreen font-bold cursor-pointer items-center mb-6' : 'flex w-full justify-between text-gray-500 hover:text-gray-600 dark:text-gray-400 dark:hover:text-gray-300 cursor-pointer items-center mb-6';
@endphp

<li {{ $attributes->merge(['class' => $classes]) }}>
    <a href="{{ $url }}" class="flex items-center focus:outline-none focus:text-ksdGreen focus:font-bold">
        <i class="fa-regular fa-{{ $icon }}"></i>
        <span class="ml-2 text-sm"> {{ $page }}</span>
    </a>
</li>
