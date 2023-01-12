<x-dashboard-layout>
    <div class="py-12 space-y-4">
        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div
                class="p-6 space-x-2 space-y-2 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800 sm:flex sm:justify-between sm:space-y-0 sm:items-center">
                <h2 class="text-2xl font-semibold text-gray-600 dark:text-white">Inschrijvingen</h2>
            </div>
        </div>

        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800">
                <h3 class="mb-2 text-lg font-semibold">Ingeschreven</h3>
                <table id="table_registrated" class="display">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Voornaam</th>
                            <th>Achternaam</th>
                            <th>E-mail</th>
                            <th>Klas</th>
                            <th>Activiteit</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($registrations as $registration)
                            <tr>
                                <td>{{ $registration->id }}</td>
                                <td>{{ $registration->user->firstname }}</td>
                                <td>{{ $registration->user->lastname }}</td>
                                <td>{{ $registration->user->email }}</td>
                                <td>{{ $registration->user->class }}</td>
                                <td>{{ $registration->activity->name }}</td>
                                <td>
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button
                                                class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                                <div><i class="fa-solid fa-ellipsis"></i></div>
                                            </button>
                                        </x-slot>

                                        <x-slot name="content">
                                            <!-- Authentication -->
                                            <form method="POST"
                                                action="{{ route('dashboard.registrations.destroy', $registration->id) }}">
                                                @csrf
                                                @method('delete')

                                                <x-dropdown-link :href="route('dashboard.registrations.index')"
                                                    onclick="event.preventDefault();
                                                          this.closest('form').submit();">
                                                    {{ __('Uitschrijven') }}
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

        <div class="mx-auto space-x-4 space-y-4 sm:px-6 lg:px-8">
            <div class="p-6 overflow-hidden bg-white rounded-md shadow-lg dark:bg-gray-800">
                <h3 class="mb-2 text-lg font-semibold">Niet ingeschreven</h3>
                <table id="table_not_registrated" class="display">
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
                        @foreach (array_slice($not_registrated, 1) as $account)
                            <tr>
                                <td>{{ $account->id }}</td>
                                <td>{{ $account->firstname }}</td>
                                <td>{{ $account->lastname }}</td>
                                <td>{{ $account->email }}</td>
                                <td>{{ $account->class }}</td>
                                <td>
                                    <a tabindex="-1" href="/dashboard/inschrijven/{{ $account->id }}">
                                        <x-primary-button>{{ __('Inschrijven') }}
                                        </x-primary-button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        let table = new DataTable('#table_registrated', {
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
        let table2 = new DataTable('#table_not_registrated', {
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
