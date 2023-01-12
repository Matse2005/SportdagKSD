<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Bedankt voor het aanmelden! Zou je, voordat je aan de slag gaat, je e-mailadres kunnen verifiëren door op de link te klikken die we je zojuist per e-mail hebben gestuurd? Als je de e-mail niet hebt ontvangen, sturen we je graag een nieuwe toe.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ __('Er is een nieuwe verificatielink verzonden naar het e-mailadres dat u tijdens de registratie hebt opgegeven.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-primary-button>
                        {{ __('Verificatie e-mail opnieuw verzenden') }}
                    </x-primary-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    {{ __('Afmelden') }}
                </button>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
