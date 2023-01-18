<span x-data="{ tooltip: false }" x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false"
    class="w-5 h-5 ml-2 cursor-pointer">
    <i class="fa-regular fa-circle-info"></i>
    <div x-show="tooltip"
        class="absolute max-w-[15rem] text-xs text-white transform translate-x-8 -translate-y-8 bg-gray-900 rounded-lg">
        <div class="w-full h-full p-2 rounded-lg bg-ksdGreen/50">
            {{ $slot }}
        </div>
    </div>
</span>
