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
                <form method="POST" action="{{ route('dashboard.activities.update') }}" enctype="multipart/form-data"
                    class="space-y-3 ">
                    @csrf
                    <input type="hidden" name="id" value="{{ $activity->id }}">
                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Activitieit</span></p>
                        <input type="text" name="name" id="name"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Hoe noemt de activiteit?" value="{{ old('name', $activity->name) }}">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Locatie</span></p>
                        <input type="text" name="location" id="location"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Waar gaat de activiteit door?"
                            value="{{ old('location', $activity->location) }}">
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Opstapplaats</span></p>
                        <input type="text" name="departure_place" id="departure_place"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Waar vertrekt de activiteit?"
                            value="{{ old('departure_place', $activity->departure_place) }}">
                        <x-input-error :messages="$errors->get('departure_place')" class="mt-2" />
                    </div>

                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Opstap uur</span></p>
                        <input type="time" name="departure_time" id="departure_time"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Wanneer vertrekt de activiteit?"
                            value="{{ old('departure_time', date('H:i', strtotime($activity->departure_time))) }}">
                        <x-input-error :messages="$errors->get('departure_time')" class="mt-2" />
                    </div>

                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Afstapplaats</span></p>
                        <input type="text" name="return_place" id="return_place"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Waar vertrekt de activiteit?"
                            value="{{ old('return_place', $activity->return_place) }}">
                        <x-input-error :messages="$errors->get('return_place')" class="mt-2" />
                    </div>

                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Afstap uur</span></p>
                        <input type="time" name="return_time" id="return_time"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Wanneer vertrekt de activiteit?"
                            value="{{ old('return_time', date('H:i', strtotime($activity->return_time))) }}">
                        <x-input-error :messages="$errors->get('return_time')" class="mt-2" />
                    </div>

                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Benodigdheden</span></p>
                        <textarea name="essentials" id="essentials" cols="30" rows="10"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Wat moet er allemaal meegenomen worden? gescheiden met een komma (,)">
@foreach (json_decode($activity->essentials) as $essential)
{{ $essential }},
@endforeach
</textarea>
                        {{-- {{$activity->essentials}} --}}
                        <x-input-error :messages="$errors->get('essentials')" class="mt-2" />
                    </div>

                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Prijs</span></p>
                        <input type="number" name="price" id="price"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Hoeveel kost deze activiteit?" step='0.01'
                            value="{{ old('price', $activity->price) }}">
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Toegelaten deelnemers</span></p>
                        <input type="number" name="max_participants" id="max_participants"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Hoeveel deelnemers mogen er mee?"
                            value="{{ old('max_participants', $activity->max_participants) }}">
                        <x-input-error :messages="$errors->get('max_participants')" class="mt-2" />
                    </div>

                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Beschrijving</span></p>
                        <textarea name="description" id="description" cols="30" rows="10"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Een kleine beschrijving bij deze activiteit, type een \n voor een enter">{{ old('description', $activity->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Afbeelding</span></p>
                        <input accept="image/*" type="file" name="image" id="image"
                            class="w-full px-4 py-2 bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Een afbeelding die bij de activiteit hoort">
                        <small>Als je de afbeelding niet wilt bewerken moet je hier geen afbeelding selecteren</small>
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>
                    <x-primary-button>{{ __('Bewerken') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
