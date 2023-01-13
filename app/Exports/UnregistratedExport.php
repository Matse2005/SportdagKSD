<?php

namespace App\Exports;

use App\Models\Activities;
use App\Models\Registrations;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithProperties;

class UnregistratedExport implements FromView, WithProperties
{
    public function view(): View
    {
        $users = User::all();
        $not_registrated = [];
        foreach ($users as $user) {
            if (Registrations::where('user_id', '=', $user->id)->exists()) continue;
            $not_registrated[] = $user;
        }
        return view('exports.unregistrated', [
            'not_registrated' => $not_registrated
        ]);
    }

    public function properties(): array
    {
        return [
            'title'          => 'Niet ingeschreven',
        ];
    }
}
