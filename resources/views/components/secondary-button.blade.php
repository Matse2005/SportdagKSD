<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white bg-gray-100 dark:bg-gray-900 text-gray-600 rounded-md font-bold text-xs dark:text-white uppercase tracking-widest border border-transparent shadow-sm hover:bg-ksdGreen hover:text-white dark:hover:bg-ksdGreen/75 focus:outline-none focus:ring-2 focus:ring-ksdGreen focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
