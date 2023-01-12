<x-dashboard-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8 space-x-4 space-y-4">
            <div class="overflow-hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <article class="flex items-end justify-between rounded-md shadow-lg p-6 bg-white dark:bg-gray-800">
                    <div class="flex items-center gap-4">
                        <span
                            class="hidden rounded-full bg-gray-100 w-10 h-10 sm:grid place-items-center text-gray-600 dark:bg-gray-900 dark:text-gray-300">
                            <i class="fa-solid fa-users"></i>
                        </span>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Accounts</p>

                            <p class="text-2xl font-medium dark:text-white">{{ $accounts }}</p>
                        </div>
                    </div>
                </article>
                <article class="flex items-end justify-between rounded-md shadow-lg p-6 bg-white dark:bg-gray-800">
                    <div class="flex items-center gap-4">
                        <span
                            class="hidden rounded-full bg-gray-100 w-10 h-10 sm:grid place-items-center text-gray-600 dark:bg-gray-900 dark:text-gray-300">
                            <i class="fa-solid fa-basketball"></i>
                        </span>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Activiteiten</p>

                            <p class="text-2xl font-medium dark:text-white">{{ $activities }}</p>
                        </div>
                    </div>
                </article>
                <article class="flex items-end justify-between rounded-md shadow-lg p-6 bg-white dark:bg-gray-800">
                    <div class="flex items-center gap-4">
                        <span
                            class="hidden rounded-full bg-gray-100 w-10 h-10 sm:grid place-items-center text-gray-600 dark:bg-gray-900 dark:text-gray-300">
                            <i class="fa-solid fa-calendar-lines-pen"></i>
                        </span>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Inschrijvingen</p>

                            <p class="text-2xl font-medium dark:text-white">{{ $registrations }}</p>
                        </div>
                    </div>
                </article>
                <article class="flex items-end justify-between rounded-md shadow-lg p-6 bg-white dark:bg-gray-800">
                    <div class="flex items-center gap-4">
                        <span
                            class="hidden rounded-full bg-gray-100 w-10 h-10 sm:grid place-items-center text-gray-600 dark:bg-gray-900 dark:text-gray-300">
                            <i class="fa-solid fa-person-circle-question"></i>
                        </span>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Vragen</p>

                            <p class="text-2xl font-medium dark:text-white">{{ $questions }}</p>
                        </div>
                    </div>
                </article>
                <article class="flex items-end justify-between rounded-md shadow-lg p-6 bg-white dark:bg-gray-800">
                    <div class="flex items-center gap-4">
                        <span
                            class="hidden rounded-full bg-gray-100 w-10 h-10 sm:grid place-items-center text-gray-600 dark:bg-gray-900 dark:text-gray-300">
                            <i class="fa-solid fa-square-poll-horizontal"></i>
                        </span>

                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Antwoorden</p>

                            <p class="text-2xl font-medium dark:text-white">{{ $answers }}</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</x-dashboard-layout>
