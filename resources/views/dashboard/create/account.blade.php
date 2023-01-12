<x-dashboard-layout>
    <div class="py-12 space-y-4">
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div
                class="p-6 space-x-2 space-y-2 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800 sm:flex sm:justify-between sm:space-y-0 sm:items-center">
                <h2 class="text-2xl font-semibold text-gray-600 dark:text-white">Nieuw account</h2>
            </div>
        </div>
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800">
                <form method="POST" action="{{ route('dashboard.accounts.store') }}" class="space-y-3 ">
                    @csrf
                    {{-- Firstname --}}
                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Voornaam</span></p>
                        <input type="text" name="firstname" id="firstname"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Voornaam voor het account?">
                        <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                    </div>
                    {{-- Lastname --}}
                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Achternaam</span></p>
                        <input type="text" name="lastname" id="lastname"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Achternaam voor account?">
                        <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                    </div>
                    {{-- Email --}}
                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">E-mail</span></p>
                        <input type="email" name="email" id="email"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Welke e-mail moet er voor de login gebruikt worden?">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    {{-- Class --}}
                    <div class="flex-1 space-y-1">
                        <p><span class="font-semibold">Klas</span></p>
                        <input type="text" name="class" id="class"
                            class="w-full bg-gray-100 border-none rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                            placeholder="De klas mag leeg zijn?">
                        <x-input-error :messages="$errors->get('class')" class="mt-2" />
                    </div>
                    <x-primary-button>{{ __('Aanmaken') }}
                    </x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
