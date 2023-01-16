<?php

namespace App\Http\Controllers;

use App\Models\Registrations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ActivitiesController;
use App\Models\Activities;
use App\Models\Questions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;


class RegistrateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registrated = $this->registrated(Auth()->user()->id);
        $activities = DB::table('activities')->get()->where("visible", "=", "1");
        return view('registrate', ['activities' => $activities, 'registrated' => $registrated]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $request->validate([
            'user_id' => 'required',
            'activity_id' => 'required',
        ]);
        if ($this->registrated($request->user_id)) {
            connectify('error', 'Inschrijving', 'Je bent al ingeschreven voor een activiteit');
            return redirect(route('registrate.index'));
        } else if (!ActivitiesController::availabilty($request->activity_id)) {
            connectify('error', 'Inschrijving', 'Deze activiteit is al volzet, kies zo snel mogelijk een andere.');
            return redirect(route('registrate.index'));
        } else {
            Registrations::create([
                "user_id" => $request->user_id,
                "activity_id" => $request->activity_id
            ]);
            ActivitiesController::update($request->activity_id);
            connectify('success', 'Inschrijving', 'Je inschrijving is gelukt en voltooid.');
            if ((Questions::where('activity_id', $request->activity_id)->first()) !== null) return redirect(route('questions.index'));
            else return redirect(route('activities.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registrations  $registrations
     * @return \Illuminate\Http\Response
     */
    public function show($id, $type)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registrations  $registrations
     * @return \Illuminate\Http\Response
     */
    public function edit(Registrations $registrations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registrations  $registrations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registrations $registrations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registrations  $registrations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registrations $registrations)
    {
        //
    }

    /**
     * Check if a specified resource already exists.
     *
     * @param  \App\Models\User::$id
     * @return \Illuminate\Http\Response
     */
    public static function registrated($id)
    {
        if (Registrations::where('user_id', $id)->first() !== null) return true;
        return false;
    }
}
