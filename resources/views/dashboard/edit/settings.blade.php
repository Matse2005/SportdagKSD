@php
    function utc_to_local($datetime)
    {
        date_default_timezone_set('europe/brussels');
        //  SHow if registrations are open
        $utc = strtotime(date('Y-m-d H:i', strtotime($datetime)));
    
        $offset = date('Z');
    
        $local = date('Y-m-d H:i', strtotime(date('Y-m-d H:i', strtotime($datetime))) + date('Z'));
    
        return $local;
    }
@endphp

<x-dashboard-layout>
    <div class="py-12 space-y-4">
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div
                class="p-6 space-x-2 space-y-2 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800 sm:flex sm:justify-between sm:space-y-0 sm:items-center">
                <h2 class="text-2xl font-semibold text-gray-600 dark:text-white">Instellingen</h2>
            </div>
        </div>
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800 space-y-3">
                <form method="POST" action="{{ route('dashboard.settings.update') }}"class="space-y-3 ">
                    @csrf

                    {{-- Start DateTime --}}
                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Inschrijvingen openen op?</span></p>
                        <div class="md:flex md:space-x-2 space-y-2 md:space-y-0">
                            <input type="datetime-local" name="start_datetime" id="start_datetime"
                                class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                                placeholder="Inschrijvingen openen op?"
                                value="{{ utc_to_local($settings['start_datetime']->value) }}" required>
                        </div>
                    </div>
                    {{-- end DateTime --}}
                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Inschrijvingen sluiten op?</span></p>
                        <div class="md:flex md:space-x-2 space-y-2 md:space-y-0">
                            <input type="datetime-local" name="end_datetime" id="end_datetime"
                                class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                                placeholder="Inschrijvingen sluiten op?"
                                value="{{ old('end_datetime', utc_to_local($settings['end_datetime']->value)) }}"
                                required>

                        </div>
                    </div>
                    <x-primary-button>{{ __('Opslaan') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
