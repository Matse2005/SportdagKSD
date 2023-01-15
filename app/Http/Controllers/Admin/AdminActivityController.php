<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\Answers;
use App\Models\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activities::all();
        return view('dashboard.activities', ['activities' => $activities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.create.activity');
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
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'departure_place' => 'required|string|max:255',
            'departure_time' => 'required|date_format:H:i|max:255',
            'return_place' => 'required|string|max:255',
            'return_time' => 'required|date_format:H:i|max:255',
            'essentials' => 'nullable',
            'price' => 'required|numeric',
            'max_participants' => 'required|numeric',
            'description' => 'required',
        ]);

        $essentials = json_encode(preg_split("/\,/", $request->essentials));
        $description = str_replace('\n', "<br>", $request->description);
        $image = file_get_contents($request->file('image'));

        Activities::create([
            'name' => $request->name,
            'location' => $request->location,
            'departure_place' => $request->departure_place,
            'departure_time' => $request->departure_time,
            'return_place' => $request->return_place,
            'return_time' => $request->return_time,
            'essentials' => $essentials,
            'price' => $request->price,
            'max_participants' => $request->max_participants,
            'description' => $description,
            'image' => $image,
            'visible' => 1
        ]);

        return redirect(route("dashboard.activities.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Activities $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activities  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activities $activity)
    {
        return view('dashboard.edit.activity', ['activity' => $activity]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activities  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'departure_place' => 'required|string|max:255',
            'departure_time' => 'required|date_format:H:i|max:255',
            'return_place' => 'required|string|max:255',
            'return_time' => 'required|date_format:H:i|max:255',
            'essentials' => 'nullable',
            'price' => 'required|numeric',
            'max_participants' => 'required|numeric',
            'description' => 'required',
        ]);

        $essentials = json_encode(preg_split("/\,/", $request->essentials));
        $description = str_replace('\n', "<br>", $request->description);
        if ($request->file('image') !== null)
            $image = file_get_contents($request->file('image'));

        Activities::find($id)->update([
            'name' => $request->name,
            'location' => $request->location,
            'departure_place' => $request->departure_place,
            'departure_time' => $request->departure_time,
            'return_place' => $request->return_place,
            'return_time' => $request->return_time,
            'essentials' => $essentials,
            'price' => $request->price,
            'max_participants' => $request->max_participants,
            'description' => $description,
            'image' => $image,
            'visible' => 1
        ]);


        if ($request->file('image') !== null) {
            $image = file_get_contents($request->file('image'));
            Activities::find($id)->update([
                'image' => $image,
            ]);
        }

        return redirect(route("dashboard.activities.index"));
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  \App\Models\Activities  $Activities
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $activity = Activities::find($id);
        $activity->delete();

        $questions = Questions::where("activity_id", "=", $id);
        foreach ($questions as $question) {
            $answers = Answers::where("question_id", "=", $question->id);
            foreach ($answers as $answer)
                $answer->delete();
            $question->delete();
        }

        connectify('success', 'Activiteit verwijderd', 'Activiteit is met succes verwijderd uit de database');
        return redirect(route('dashboard.activities.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activities  $Activities
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $activity = Activities::find($id);
        $activity->delete();

        connectify('success', 'Activiteit verwijderd', 'Activiteit is met succes verwijderd uit de database');
        return redirect(route('dashboard.activities.index'));
    }
}
