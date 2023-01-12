@props(['active'])

@php
    $classes = $active ?? false ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-ksdGreen dark:border-ksdGreen text-left text-base font-medium text-gray-600 dark:text-white bg-ksdGreen/50 dark:bg-ksdGreen/50 focus:outline-none focus:text-indigo-800 dark:focus:text-ksdGreen focus:bg-ksdGreen dark:focus:bg-ksdGreen focus:border-ksdGreen dark:focus:border-ksdGreen transition duration-150 ease-in-out' : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 focus:bg-gray-50 dark:focus:bg-gray-700 focus:border-gray-300 dark:focus:border-gray-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
