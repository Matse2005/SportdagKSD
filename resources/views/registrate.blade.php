<x-app-layout>
    <div class="py-12">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
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

            @if ($current_datetime >= $local_start_datetime && $current_datetime <= $local_end_datetime)
                <div class="grid h-full grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @foreach ($activities as $activity)
                        <div
                            class="w-full bg-white dark:bg-gray-800 ease-in-out delay-150 duration-300  dark:text-white rounded-lg shadow-md h-full 
                      {{-- border-2 {{ $activity->participants < $activity->max_participants ? 'border-green-500' : 'border-red-500' }} --}}
                      ">
                            <div class="object-fill h-2/3">
                                <img class="object-cover w-full h-full rounded-t-md"
                                    src="data:image/jpg;base64,{{ chunk_split(base64_encode($activity->image)) }}"
                                    alt="Activiteit afbeelding" />
                            </div>
                            <div class="px-2.5 sm:px-4 py-3 flex items-center h-1/3">
                                <div class="">
                                    <h5 class="mb-2 text-sm font-bold tracking-tight sm:text-md">
                                        {{ $activity->name }}
                                    </h5>
                                    <div class="flex items-center gap-4">
                                        @if ($registrated)
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ __('Je bent al ingeschreven') }}</p>
                                        @elseif ($activity->participants >= $activity->max_participants)
                                            <x-disabled-button>{{ __('Volzet') }}</x-disabled-button>
                                        @else
                                            <form method="POST" action="{{ route('registrate.store') }}">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                                                <x-primary-button>{{ __('Inschrijven') }}</x-primary-button>
                                                </a>
                                            </form>
                                        @endif

                                        @if (!$registrated && $activity->participants >= $activity->max_participants)
                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Volzet') }}</p>
                                        @elseif(!$registrated)
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ ($free = $activity->max_participants - $activity->participants) == 1 ? $free . ' plek vrij' : $free . ' plekken vrij' }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div
                    class="grid p-3 space-y-2 text-gray-900 duration-300 ease-in-out delay-150 rounded-md shadow-lg sm:py-6 dark:text-white dark:bg-gray-800 sm:p-10 place-items-center">
                    <div class="max-w-md text-center">
                        <h3 class="text-xl font-bold">Inschrijvingen gesloten</h3>
                        <p>De inschrijvingen zijn op deze moment gesloten, kom later nog eens terug of contacteer
                            een beheerder als je denkt dat dit een fout is.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
