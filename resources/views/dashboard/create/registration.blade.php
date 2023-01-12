<x-dashboard-layout>
    <div class="py-12 space-y-4">
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div
                class="p-6 space-x-2 space-y-2 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800 sm:flex sm:justify-between sm:space-y-0 sm:items-center">
                <h2 class="text-2xl font-semibold text-gray-600 dark:text-white">Inschrijven > {{ $user->firstname }}
                    {{ $user->lastname }}</h2>
            </div>
        </div>
        <div class="mx-auto space-y-4 sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800">
                <p><span
                        class="px-3 py-2 mb-2 mr-1 font-bold bg-gray-100 rounded-md lg:mb-0 dark:bg-gray-900">Opgepast!</span>
                    Iemand
                    als beheerder kan over het maximaal aantal deelnemers gaan.</p>
            </div>
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800">
                <form method="POST" action="{{ route('dashboard.registrations.store') }}" class="space-y-3 ">
                    @csrf
                    {{-- user_id --}}
                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Account</span></p>
                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                        <p
                            class="w-full px-3 py-2 bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300">
                            {{ $user->firstname }} {{ $user->lastname }} &lt;{{ $user->email }}&gt;
                        </p>
                    </div>
                    {{-- activity_id --}}
                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Type vraag</span></p>
                        <select name="activity_id" id="activity_id"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300">
                            @foreach ($activities as $activity)
                                <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('activity_id')" class="mt-2" />
                    </div>
                    <x-primary-button>{{ __('Inschrijven') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.user_id').select2();
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</x-dashboard-layout>
