<section>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Mijn Profiel') }}
            </h2>
        </header>

        <div class="my-6 space-y-6">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="firstname" value="Voornaam" />
                <x-text-input id="firstname" name="firstname" type="text" class="mt-1 block w-full" readonly="true"
                    :value="old('firstname', $user->firstname)" required autofocus autocomplete="firstname" />
                <x-input-error class="mt-2" :messages="$errors->get('firstname')" />
            </div>

            <div>
                <x-input-label for="lastname" value="Achternaam" />
                <x-text-input id="lastname" name="lastname" type="text" class="mt-1 block w-full" readonly="true"
                    :value="old('lastname', $user->lastname)" required autofocus autocomplete="lastname" />
            </div>

            <div>
                <x-input-label for="class" value="Klas" />
                <x-text-input id="class" name="class" type="text" class="mt-1 block w-full" readonly="true"
                    :value="old('class', $user->class)" required autofocus autocomplete="firstname" />
            </div>

            <div>
                <x-input-label for="email" value="E-mailadres" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" readonly="true"
                    :value="old('email', $user->email)" required autocomplete="email" />
            </div>
        </div>
    </section>
