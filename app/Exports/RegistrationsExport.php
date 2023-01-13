<?php

namespace App\Exports;

use App\Models\Activities;
use App\Models\Registrations;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RegistrationsExport implements FromView
{
    public function view(): View
    {
        $registrations = Registrations::all();
        foreach ($registrations as $registration) {
            $registration->user = User::find($registration->user_id);
            $registration->activity = Activities::find($registration->activity_id);
        }
        // $registrations = json_decode(json_encode($registrations), FALSE);
        return view('exports.registrations', [
            'registrations' => $registrations
        ]);
    }
}
