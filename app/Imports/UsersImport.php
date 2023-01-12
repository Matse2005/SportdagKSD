<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([
            'firstname'  => $row['voornaam'] ?? $row['firstname'],
            'lastname' => $row['achternaam'] ?? $row['lastname'],
            'email' => $row['email'] ?? $row['email'],
            'password' => Hash::make(Str::random(10)),
            'class' => $row['klas'] ?? $row['klas']
        ]);
    }

    /**
     * @return string|array
     */
    public function uniqueBy()
    {
        return 'email';
    }
}
