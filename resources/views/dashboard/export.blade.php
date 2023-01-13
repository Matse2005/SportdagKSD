<x-dashboard-layout>
    <div class="py-12 space-y-4">
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div
                class="p-6 space-x-2 space-y-2 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800 sm:flex sm:justify-between sm:space-y-0 sm:items-center">
                <h2 class="text-2xl font-semibold text-gray-600 dark:text-white">Exporteren</h2>
                <div class="">
                    <a tabindex="-1" target="_blank" href="/dashboard/exporteren/export">
                        <x-primary-button>{{ __('Start') }}
                        </x-primary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
