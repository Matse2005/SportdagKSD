<table>
    <thead>
        <tr>
            <th style="font-weight: bold">Naam</th>
            <th style="font-weight: bold">Email</th>
            <th style="font-weight: bold">Klas</th>
            <th style="font-weight: bold">Activiteit naam</th>
            <th style="font-weight: bold">Activiteit Prijs</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($registrations as $registration)
            <tr>
                <td>{{ $registration->user->firstname }} {{ $registration->user->lastname }}</td>
                <td>{{ $registration->user->email }}</td>
                <td>{{ $registration->user->class }}</td>
                <td>{{ $registration->activity->name }}</td>
                <td>{{ $registration->activity->price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
