<x-dashboard-layout>
    <div class="py-12 space-y-4">
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div
                class="p-6 space-x-2 space-y-2 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800 sm:flex sm:justify-between sm:space-y-0 sm:items-center">
                <h2 class="text-2xl font-semibold text-gray-600 dark:text-white">Nieuwe vraag</h2>
            </div>
        </div>
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800">
                <form method="POST" action="{{ route('dashboard.questions.store') }}" class="space-y-3 ">
                    @csrf
                    {{-- Question --}}
                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Vraag</span></p>
                        <input type="text" name="question" id="question"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Begin met het typen van je vraag">
                        <x-input-error :messages="$errors->get('question')" class="mt-2" />
                    </div>
                    {{-- Type --}}
                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Type vraag</span></p>
                        <select name="type" id="type"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300">
                            <option value="text">text</option>
                            <option value="email">email</option>
                            <option value="dropdown">dropdown</option>
                            <option value="datetime-local">datetime-local</option>
                            <option value="date">date</option>
                            <option value="month">month</option>
                            <option value="number">number</option>
                            <option value="tel">tel</option>
                            <option value="time">time</option>
                            <option value="url">url</option>
                            <option value="week">week</option>
                        </select>
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>
                    {{-- activity_id --}}
                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Activiteit</span> <small class="text-xs">De activiteit waarvoor
                                deze vraag bedoeld is</small></p>
                        <select name="activity_id" id="activity_id"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300">
                            @foreach ($activities as $activity)
                                <option value="{{ $activity->id }}"> {{ $activity->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('activity_id')" class="mt-2" />
                    </div>
                    {{-- Options --}}
                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Opties</span> <small class="text-xs">Alleen nodig bij een
                                dropdown</small></p>
                        <textarea name="options" id="options" cols="30" rows="10"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Start met het typen van je opties gescheiden met een komma (,)"></textarea>
                        <x-input-error :messages="$errors->get('options')" class="mt-2" />
                    </div>
                    <x-primary-button>{{ __('Aanmaken') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
