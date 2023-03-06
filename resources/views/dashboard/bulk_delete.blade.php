<x-dashboard-layout>
    <div class="py-12 space-y-4">
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div
                class="p-6 space-x-2 space-y-2 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800 sm:flex sm:justify-between sm:space-y-0 sm:items-center">
                <h2 class="text-2xl font-semibold text-gray-600 dark:text-white">Accounts</h2>
                <div class="">
                    <form method="POST" action="{{ route('dashboard.bulk_delete.delete.accounts') }}">
                        @csrf
                        <x-primary-button>{{ __('Verwijderen') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div
                class="p-6 space-x-2 space-y-2 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800 sm:flex sm:justify-between sm:space-y-0 sm:items-center">
                <h2 class="text-2xl font-semibold text-gray-600 dark:text-white">Activiteiten</h2>
                <div class="">
                    <form method="POST" action="{{ route('dashboard.bulk_delete.delete.activities') }}">
                        @csrf
                        <x-primary-button>{{ __('Verwijderen') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div
                class="p-6 space-x-2 space-y-2 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800 sm:flex sm:justify-between sm:space-y-0 sm:items-center">
                <h2 class="text-2xl font-semibold text-gray-600 dark:text-white">Inschrijvingen</h2>
                <div class="">
                    <form method="POST" action="{{ route('dashboard.bulk_delete.delete.signups') }}">
                        @csrf
                        <x-primary-button>{{ __('Verwijderen') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div
                class="p-6 space-x-2 space-y-2 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800 sm:flex sm:justify-between sm:space-y-0 sm:items-center">
                <h2 class="text-2xl font-semibold text-gray-600 dark:text-white">Vragen</h2>
                <div class="">
                    <form method="POST" action="{{ route('dashboard.bulk_delete.delete.questions') }}">
                        @csrf
                        <x-primary-button>{{ __('Verwijderen') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div
                class="p-6 space-x-2 space-y-2 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800 sm:flex sm:justify-between sm:space-y-0 sm:items-center">
                <h2 class="text-2xl font-semibold text-gray-600 dark:text-white">Antwoorden</h2>
                <div class="">
                    <form method="POST" action="{{ route('dashboard.bulk_delete.delete.answers') }}">
                        @csrf
                        <x-primary-button>{{ __('Verwijderen') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
