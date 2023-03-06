<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RegistrationsController;
use App\Models\Discussed;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activities::where("visible", 1)->get();
        $discussed = Discussed::where('user_id', Auth()->user()->id)->exists() == true ? false : true;
        return view('activities', ['activities' => $activities, 'discussed' => $discussed]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $activity = DB::table('activities')->get()->where("id", "=", $id)->first();
        return view('activity', ['activity' => $activity, 'registrated' => RegistrationsController::registrated(Auth()->user()->id)]);
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
        if ($activity->participants > 0) $activity->decrement('participants');
        return;
    }

    public static function availabilty($activity_id)
    {
        $activity = Activities::find($activity_id);
        if ($activity->participants >= $activity->max_participants) return false;
        return true;
    }
}
