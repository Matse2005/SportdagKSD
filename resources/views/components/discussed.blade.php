@props(['discussed', 'dismissable'])

<div x-data="{ modelOpen: {{ $discussed }} }">
    <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
            <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
                aria-hidden="true"></div>

            <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="transition ease-in duration-200 transform"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block w-full max-w-lg text-center p-8 my-20 overflow-hidden transition-all transform dark:bg-gray-800 dark:text-white bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                <div class="mt-5">
                    <div>
                        <p>Ik ga er mee akkoord dat ik de prijzen van activiteiten heb overlegd en ga overleggen met
                            mijn ouders.</p>
                    </div>

                    <div class="flex justify-end items-center mt-6 space-x-2">
                        @if ($dismissable == 'true')
                            <button @click="modelOpen = false"
                                class="underline text-sm text-gray-500 hover:text-gray-600">
                                Vraag het later opnieuw
                            </button>
                        @else
                            <a href="{{ route('activities.index') }}"
                                class="underline text-sm text-gray-500 hover:text-gray-600">
                                Terug naar activiteiten
                            </a>
                        @endif
                        <form method="POST" action="{{ route('discussed.store') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <x-primary-button>{{ __('Akkoord') }}</x-primary-button>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
