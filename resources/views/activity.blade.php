<x-app-layout>
    @php
        //  SHow if registrations are open
        date_default_timezone_set('Europe/Brussels');
        $utc_start_datetime = strtotime(date('Y-m-d H:i', strtotime($settings['start_datetime']->value)));
        $utc_end_datetime = strtotime(date('Y-m-d H:i', strtotime($settings['end_datetime']->value)));
        
        $offset = date('Z');
        
        $local_start_datetime_timestamp = date('Y-m-d H:i', $utc_start_datetime + $offset);
        $local_end_datetime_timestamp = date('Y-m-d H:i', $utc_end_datetime + $offset);
        
        $local_start_datetime = strtotime($local_start_datetime_timestamp);
        $local_end_datetime = strtotime($local_end_datetime_timestamp);
        
        $current_datetime = strtotime(date('Y-m-d H:i'));
    @endphp
    <div class="py-12">
        <div class="px-6 mx-auto space-y-4 max-w-7xl lg:px-8">
            <div
                class="w-full h-56 duration-300 ease-in-out delay-150 rounded-md shadow-lg sm:h-96 dark:text-white dark:bg-gray-800">
                <img class="object-cover w-full h-full rounded-md" src="/storage/{{ $activity->image }}"
                    alt="Activiteit afbeelding" />
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div
                    class="p-3 space-y-2 text-gray-900 duration-300 ease-in-out delay-150 rounded-md shadow-lg dark:text-white dark:bg-gray-800 sm:p-5">
                    <div class="">
                        <h1 class="mb-2 text-xl font-bold uppercase text-ksdGreen sm:text-3xl">{{ $activity->name }}</h1>
                        <h2 class="text-sm font-bold uppercase sm:text-lg">{{ $activity->location }}</h2>
                        <p>
                            <span class="font-bold">{{ date('H.i', strtotime($activity->departure_time)) }}</span> tot
                            en
                            met
                            <span class="font-bold">{{ date('H.i', strtotime($activity->return_time)) }}</span> uur
                        </p>
                        <p>Vertrekplaats: {{ $activity->departure_place }}</p>
                        {{-- <p>: {{ $activity->return_place }}</p> --}}
                    </div>
                    <div class="">
                        <div class="flex text-sm text-gray-600 dark:text-gray-400">
                            <h1 class="text-xl font-bold uppercase text-ksdGreen sm:text-3xl">€ {{ $activity->price }}
                            </h1>
                            <x-tooltip>Deze prijs is een richtprijs, vervoer is hier nog niet altijd bij inbegrepen.</x-tooltip>
                        </div>
                        @if ($activity->participants >= $activity->max_participants)
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Volzet') }}</p>
                        @else
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ ($free = $activity->max_participants - $activity->participants) == 1 ? $free . ' plek vrij' : $free . ' plekken vrij' }}
                            </p>
                        @endif
                        <div class="my-3">
                            @if ($current_datetime >= $local_start_datetime && $current_datetime <= $local_end_datetime)
                                @if (!$registrated && $activity->participants < $activity->max_participants)
                                    <form method="POST" action="{{ route('registrate.store') }}">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                                        <x-primary-button>{{ __('Inschrijven') }}</x-primary-button>
                                        </a>
                                    </form>
                                @endif
                            @endif
                        </div>
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
            </div>
        </div>
    </div>
</x-app-layout>
