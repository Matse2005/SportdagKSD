<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RegistrationsController;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = DB::table('activities')->get()->where("visible", "=", "1");
        return view('activities', ['activities' => $activities]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activities = DB::table('activities')->get()->where("id", "=", $id)->take(1);
        foreach ($activities as $activity) return view('activity', ['activity' => $activity, 'registrated' => RegistrationsController::registrated(Auth()->user()->id)]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registrations  $registrations
     * @return \Illuminate\Http\Response
     */
    public static function update($activity_id, $type = 1)
    {
        $activity = Activities::find($activity_id);
        if ($type == 1) return $activity->increment('participants');
        return $activity->decrement('participants');
    }

    public static function availabilty($activity_id)
    {
        $activity = Activities::find($activity_id);
        if ($activity->participants >= $activity->max_participants) return false;
        return true;
    }
}
