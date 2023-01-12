<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-ksdGreen dark:bg-ksdGreen/75 border border-transparent rounded-md font-bold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-ksdGreen/75 dark:hover:bg-ksdGreen/50 focus:bg-ksdGreen/75 dark:focus:bg-ksdGreen/50 active:bg-ksdGreen/75 dark:active:bg-ksdGreen/50 focus:outline-none focus:ring-2 focus:ring-ksdGreen focus:ring-offset-2 dark:focus:ring-offset-ksdGreen transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
