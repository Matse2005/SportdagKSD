<x-app-layout>
    <div class="py-12">
        <div class="px-6 mx-auto max-w-7xl lg:px-8">
            <div
                class="grid h-full grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($activities as $activity)
                    <a a href="{{ route('activities.show', $activity->id) }}"
                        class="w-full h-full duration-150 ease-in-out rounded-lg hover:scale-110 hover:bg-white dark:hover:bg-gray-800 dark:text-white hover:shadow-md group ">
                        <div class="object-fill duration-150 ease-in-out h-2/3">
                            <img class="object-cover w-full h-full duration-150 ease-in-out rounded-md group-hover:rounded-b-none"
                                src="/storage/{{ $activity->image }}" alt="Activiteit afbeelding" />
                        </div>
                        <div class=" group-hover:scale-[0.95] group-hover:px-1 ease-in-out duration-150">
                            <div class="flex items-center py-3 duration-150 ease-in-out h-1/3">
                                <div class="">
                                    <h5 class="mb-2 text-sm font-bold tracking-tight sm:text-md">
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
