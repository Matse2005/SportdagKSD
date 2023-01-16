<x-app-layout>
    <div class="py-12">
        <div class="px-6 mx-auto space-y-4 max-w-7xl lg:px-8">
            <div
                class="p-6 space-x-2 space-y-2 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800 sm:flex sm:justify-between sm:space-y-0 sm:items-center">
                <h2 class="text-2xl font-semibold text-gray-600 dark:text-white">Mijn inschrijving</h2>
                <div class="">
                    <form method="POST" action="{{ route('registration.destroy', Auth::user()->id) }}">
                        @csrf
                        @method('delete')

                        <x-primary-button
                            onclick="event.preventDefault();
                        this.closest('form').submit();">
                            {{ __('uitschrijven') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
            <div
                class="w-full h-56 duration-300 ease-in-out delay-150 rounded-md shadow-lg sm:h-96 dark:text-white dark:bg-gray-800">
                <img class="object-cover w-full h-full rounded-md" src="/storage/{{ $activity->image }}"
                    alt="Activiteit afbeelding" />
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div
                    class="p-3 space-y-2 text-gray-900 duration-300 ease-in-out delay-150 rounded-md shadow-lg dark:text-white dark:bg-gray-800 sm:p-5">
                    <div class="">
                        <h1 class="mb-2 text-xl font-bold uppercase text-ksdGreen sm:text-3xl">{{ $activity->name }}
                        </h1>
                        <h2 class="text-sm font-bold uppercase sm:text-lg">{{ $activity->location }}</h2>
                        <p>
                            <span class="font-bold">{{ date('H.i', strtotime($activity->departure_time)) }}</span> tot
                            en
                            met
                            <span class="font-bold">{{ date('H.i', strtotime($activity->return_time)) }}</span> uur
                        </p>
                        <p>Opstapplaats: {{ $activity->departure_place }}</p>
                        <p>Afstapplaats: {{ $activity->return_place }}</p>
                    </div>
                    <div class="">
                        <h1 class="text-xl font-bold uppercase text-ksdGreen sm:text-3xl">€ {{ $activity->price }}
                        </h1>
                        <p class="">Deze prijs is een richtprijs</p>
                        @if ($activity->participants >= $activity->max_participants)
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Volzet') }}</p>
                        @else
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ ($free = $activity->max_participants - $activity->participants) == 1 ? $free . ' plek vrij' : $free . ' plekken vrij' }}
                            </p>
                        @endif
                    </div>
                </div>
                <div
                    class="p-3 text-gray-900 duration-300 ease-in-out delay-150 rounded-md shadow-lg dark:text-white dark:bg-gray-800 sm:p-5">
                    <h1 class="mb-2 text-lg font-bold uppercase text-ksdGreen sm:text-2xl">mee te brengen</h1>
                    <ul class="px-3 list-disc sm:px-5">
                        @foreach (json_decode($activity->essentials) as $essential)
                            <li>{{ $essential }}</li>
                        @endforeach
                    </ul>
                </div>
                <div
                    class="p-3 duration-300 ease-in-out delay-150 rounded-md shadow-lg sm:col-span-2 dark:text-white dark:bg-gray-800 sm:p-5">
                    <h1 class="mb-2 text-lg font-bold uppercase text-ksdGreen sm:text-2xl">troeven</h1>
                    {!! $activity->description !!}
                </div>
                <div
                    class="p-3 duration-300 ease-in-out delay-150 rounded-md shadow-lg sm:col-span-2 dark:text-white dark:bg-gray-800 sm:p-5">
                    <h1 class="mb-2 text-lg font-bold uppercase text-ksdGreen sm:text-2xl">Bijhorende vragen</h1>
                    <form method="POST" action="{{ route('answers.update') }}" class="space-y-3 ">
                        @csrf
                        @foreach ($questions as $question)
                            <div class="flex-1 space-y-1">
                                <p><span class="font-semibold">{{ $question->question->question }}</span></p>
                                <div class="space-y-2 md:flex md:space-x-2 md:space-y-0">
                                    @if ($question->question->type == 'dropdown')
                                        <select name="{{ $question->question->id }}"
                                            id="{{ $question->question->id }}"
                                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300""
                                            required>
                                            @if ($question->answer !== null)
                                                <option selected disabled value="{{ $question->answer->answer }}">
                                                    {{ $question->answer->answer }}
                                                </option>
                                            @endif
                                            @foreach (json_decode($question->question->options) as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <input type="{{ $question->question->type }}"
                                            name="{{ $question->question->id }}" id="{{ $question->question->id }}"
                                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                                            placeholder="{{ $question->question->question }}"
                                            @if ($question->answer !== null) value="{{ $question->answer->answer }}" @endif
                                            required>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                        <x-primary-button>{{ __('Opslaan') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
