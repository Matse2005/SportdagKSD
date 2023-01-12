<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ActivitiesController;
use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\Registrations;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRegistrationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registrations = Registrations::all();
        foreach ($registrations as $registration) {
            $registration->activity = Activities::find($registration->activity_id);
            $registration->user = User::find($registration->user_id);
        }
        $users = DB::table('users')->get();
        $not_registrated = array(
            array(
                "sqdqd",
                "dsfqqsdf",
                "sdfsqdfqs",
                "sdfsqdfsq"
            )
        );
        foreach ($users as $user) {
            if (Registrations::where('user_id', '=', $user->id)->exists()) continue;
            $not_registrated[] = $user;
        }

        return view('dashboard.registrations', ['registrations' => $registrations, 'not_registrated' => $not_registrated]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        $user = User::find($user_id);
        $activities = DB::table('activities')->get();
        return view('dashboard.create.registration', ['user' => $user, 'activities' => $activities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'activity_id' => 'required|numeric',
        ]);

        Registrations::create([
            'user_id' => $request->user_id,
            'activity_id' => $request->activity_id,
        ]);
        ActivitiesController::update($request->activity_id);

        return redirect(route("dashboard.registrations.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registrations  $registrations
     * @return \Illuminate\Http\Response
     */
    public function show(Registrations $registrations)
    {
        //
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
    public function destroy($id)
    {
        $registration = Registrations::find($id);
        ActivitiesController::update($registration->activity_id, 0);
        $registration->delete();

        connectify('success', 'Inschrijving verwijderd', 'Inschrijving is met succes verwijderd uit de database');
        return redirect(route('dashboard.registrations.index'));
    }
}
