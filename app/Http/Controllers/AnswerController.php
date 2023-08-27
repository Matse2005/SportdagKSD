<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use App\Models\Answers;
use App\Models\Questions;
use App\Models\Registrations;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Answers  $answers
     * @return \Illuminate\Http\Response
     */
    public function show(Answers $answers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Answers  $answers
     * @return \Illuminate\Http\Response
     */
    public function edit(Answers $answers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Answers  $answers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answers $answers)
    {
        // $request = (object) $request;
        $registrated = $this->registrated(Auth()->user()->id);
        if ($registrated) {
            $activity = Activities::find($registrated);
            $questions = Questions::where('activity_id', $activity->id)->get();
            foreach ($questions as $question) {
                $answer = Answers::where('user_id', Auth()->user()->id)->where('question_id', $question->id);
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
     * @param  \App\Models\Answers  $answers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answers $answers)
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
        if (($registration = Registrations::where('user_id', $id)->first()) !== null) return $registration->activity_id;
        return false;
    }
}
