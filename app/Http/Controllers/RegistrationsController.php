<?php

namespace App\Http\Controllers;

use App\Models\Registrations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ActivitiesController;
use App\Models\Activities;
use App\Models\Answers;
use App\Models\Questions;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;


class RegistrationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registrated = $this->registrated(Auth()->user()->id);
        if ($registrated) {
            $activity = Activities::find($registrated);
            $questions_db = Questions::where('activity_id', $activity->id)->get();
            $questions = [];
            foreach ($questions_db as $question) {
                $answer = Answers::where('user_id', Auth()->user()->id)->where('question_id', $question->id)->first();
                $questions[] = (object) array(
                    "question" => $question,
                    "answer" => $answer,
                );
            }
            return view('registration', ['activity' => $activity, 'questions' => $questions]);
        } else {
            return redirect(route("registrate.index"));
        }
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
        //
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
        $request = (object) $request;
        $registrated = $this->registrated(Auth()->user()->id);
        if ($registrated) {
            $activity = Activities::find($registrated);
            $questions = Questions::where('activity_id', $activity->id)->get();
            foreach ($questions as $question) {
                $answer = Answers::where('user_id', Auth()->user()->id)->where('question_id', $question->id)->get();
                if ($answer !== null)
                    $answer->delete();

                Answers::create([
                    "user_id" => Auth()->user()->id,
                    "question_id" => $question->id,
                    "answer" => $request[$question->id]
                ]);
            }
            return redirect(route("registration.index"));
        } else {
            return redirect(route("registrate.index"));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registrations  $registrations
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registration = Registrations::where('user_id', $id)->first();
        $answers = Answers::where("user_id", $id)->delete();
        ActivitiesController::update($registration->activity_id, 0);
        $registration->delete();

        connectify('success', 'Uitschrijving', 'We hebben je met succes uitgeschreven');
        return redirect(route('activities.index'));
    }

    /**
     * Check if a specified resource already exists.
     *
     * @param  \App\Models\User::$id
     * @return \Illuminate\Http\Response
     */
    public static function registrated($id)
    {
        if (($registration = Registrations::where('user_id', $id)->first()) !== null) return $registration->activity_id;
        return false;
    }
}
