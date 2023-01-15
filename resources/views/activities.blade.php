<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div
                class="h-full grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($activities as $activity)
                    <a a href="{{ route('activities.show', $activity->id) }}"
                        class="w-full hover:scale-110 hover:bg-white dark:hover:bg-gray-800 ease-in-out duration-150 dark:text-white rounded-lg hover:shadow-md h-full group
                        ">
                        <div class="object-fill
                        h-2/3 ease-in-out duration-150">
                            <img class="rounded-md group-hover:rounded-b-none object-cover h-full w-full ease-in-out duration-150"
                                src="data:image/jpg;base64,{{ chunk_split(base64_encode($activity->image)) }}"
                                alt="Activiteit afbeelding" />
                        </div>
                        <div class=" group-hover:scale-[0.95] group-hover:px-1 ease-in-out duration-150">
                            <div class="py-3 flex items-center h-1/3 ease-in-out duration-150">
                                <div class="">
                                    <h5 class="mb-2 text-sm sm:text-md font-bold tracking-tight">
                                        {{ $activity->name }}
                                    </h5>
                                    <div class="flex items-center {{-- gap-4 --}}">
                                        {{-- <a href="/activiteit/{{ $activity->id }}">
                                        <x-primary-button>{{ __('Meer info') }}</x-primary-button>
                                    </a> --}}

                                        @if ($activity->participants >= $activity->max_participants)
                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ __('Volzet') }}</p>
                                        @else
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ ($free = $activity->max_participants - $activity->participants) == 1 ? $free . ' plek vrij' : $free . ' plekken vrij' }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
