<x-dashboard-layout>
    <div class="py-12 space-y-4">
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div
                class="p-6 space-x-2 space-y-2 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800 sm:flex sm:justify-between sm:space-y-0 sm:items-center">
                <h2 class="text-2xl font-semibold text-gray-600 dark:text-white">Accounts</h2>
                <div class="">
                    <a tabindex="-1" href="{{ route('dashboard.accounts.import') }}">
                        <x-secondary-button>{{ __('Importeer accounts') }}
                        </x-secondary-button>
                    </a>
                    <a tabindex="-1" href="/dashboard/accounts/create">
                        <x-primary-button>{{ __('Nieuw account') }}
                        </x-primary-button>
                    </a>
                </div>
            </div>
        </div>
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Voornaam</th>
                            <th>Achternaam</th>
                            <th>E-mail</th>
                            <th>Klas</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->firstname }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->class }}</td>
                                <td>
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                                <div><i class="fa-solid fa-ellipsis"></i></div>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            @if ($user->roles)
                                                @php
                                                    $roleSet = false;
                                                @endphp
                                                @foreach ($user->roles as $role)
                                                    @if ($role->name == 'admin')
                                                        <form method="POST"
                                                            action="{{ route('dashboard.accounts.destroy', $user->id) }}">
                                                            @csrf
                                                            @method('delete')

                                                            <x-dropdown-link :href="route('dashboard.accounts.index')"
                                                                onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                                                {{ __('Verwijder beheerder') }}
                                                            </x-dropdown-link>
                                                        </form>
                                                        @php
                                                            $roleSet = true;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                @if (!$roleSet)
                                                    <form method="POST" action="{{ route('dashboard.admin.store') }}">
                                                        @csrf
                                                        <input type="hidden" value="{{ $user->id }}"
                                                            name="id">
                                                        <x-dropdown-link :href="route('dashboard.accounts.index')"
                                                            onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                                            {{ __('Maak beheerder') }}
                                                        </x-dropdown-link>
                                                    </form>
                                                @endif
                                            @endif
                                            <x-dropdown-link :href="route('dashboard.accounts.edit', $user)">
                                                {{ __('Bewerken') }}
                                            </x-dropdown-link>

                                            <!-- Authentication -->
                                            <form method="POST"
                                                action="{{ route('dashboard.accounts.destroy', $user->id) }}">
                                                @csrf
                                                @method('delete')

                                                <x-dropdown-link :href="route('dashboard.accounts.index')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();">
                                                    {{ __('Verwijderen') }}
                                                </x-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-dropdown>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        let table = new DataTable('#table_id', {
            "language": {
                "lengthMenu": '<select>' +
                    '<option value="10">10 rijen</option>' +
                    '<option value="20">20 rijen</option>' +
                    '<option value="30">30 rijen</option>' +
                    '<option value="40">40 rijen</option>' +
                    '<option value="50">50 rijen</option>' +
                    '<option value="100">100 rijen</option>' +
                    '<option value="150">150 rijen</option>' +
                    '<option value="200">200 rijen</option>' +
                    '<option value="-1">Alle rijen</option>' +
                    '</select> '
            },
            "columnDefs": [{
                "targets": [0],
                "visible": false,
                "searchable": false
            }],
        });
    </script>
</x-dashboard-layout>
