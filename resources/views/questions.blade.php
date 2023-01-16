<x-app-layout>
    <div class="py-12">
        <div class="px-6 mx-auto space-y-4 max-w-7xl lg:px-8">
            <div
                class="p-3 duration-300 ease-in-out delay-150 rounded-md shadow-lg sm:col-span-2 dark:text-white dark:bg-gray-800 sm:p-5">
                <h1 class="mb-2 text-lg font-bold uppercase text-ksdGreen sm:text-2xl">Bijhorende vragen</h1>
                <form method="POST" action="{{ route('answers.update') }}" class="space-y-3 ">
                    @csrf
                    @foreach ($questions as $question)
                        <div class="flex-1 space-y-1">
                            <p><span class="font-semibold">{{ $question->question }}</span></p>
                            <div class="space-y-2 md:flex md:space-x-2 md:space-y-0">
                                @if ($question->type == 'dropdown')
                                    <select name="{{ $question->id }}" id="{{ $question->id }}"
                                        class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300""
                                        required>
                                        @foreach (json_decode($question->options) as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input type="{{ $question->type }}" name="{{ $question->id }}"
                                        id="{{ $question->id }}"
                                        class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                                        placeholder="{{ $question->question }}" required>
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
</x-app-layout>
