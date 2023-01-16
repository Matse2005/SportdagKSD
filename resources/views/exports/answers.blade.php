<table>
    <thead>
        <tr>
            <th style="font-weight: bold">Gebruiker</th>
            <th style="font-weight: bold">Vraag</th>
            <th style="font-weight: bold">Klas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($answers as $answer)
            <tr>
                <td>{{ $answer->user->email }}</td>
                <td>{{ $answer->question->question }}</td>
                <td>{{ $answer->answer }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
