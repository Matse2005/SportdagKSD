<x-dashboard-layout>
    <div class="py-12 space-y-4">
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div
                class="p-6 space-x-2 space-y-2 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800 sm:flex sm:justify-between sm:space-y-0 sm:items-center">
                <h2 class="text-2xl font-semibold text-gray-600 dark:text-white">Importeer accounts</h2>
            </div>
        </div>
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800">
                <form method="POST" action="{{ route('dashboard.accounts.import.store') }}" enctype="multipart/form-data"
                    class="space-y-3 ">
                    @csrf
                    {{-- File --}}
                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Bestand</span></p>
                        <input
                            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                            type="file" name="file" id="file"
                            class="w-full px-4 py-2 bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Een bestand met alle accounts">
                        <small>Toegestane types: xslx, xls, csv</small>
                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                    </div>
                    <x-primary-button>{{ __('Importeren') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
