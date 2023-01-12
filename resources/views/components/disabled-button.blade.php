<button
    {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-ksdGreen/75 dark:bg-ksdGreen/50 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150 cursor-not-allowed']) }}>
    {{ $slot }}
</button>
