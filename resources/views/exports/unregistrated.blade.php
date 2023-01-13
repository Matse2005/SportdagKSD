<table>
    <thead>
        <tr>
            <th style="font-weight: bold">Naam</th>
            <th style="font-weight: bold">Email</th>
            <th style="font-weight: bold">Klas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($not_registrated as $user)
            <tr>
                <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->class }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
