<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Question\Question;

class AdminQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Questions::all();
        foreach ($questions as $question)
            $question->activity = Activities::find($question->activity_id);

        return view('dashboard.questions', ['questions' => $questions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $activities = DB::table('activities')->get();
        return view('dashboard.create.questions', ['activities' => $activities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->type !== "dropdown") $options = null;
        if ($request->options !== "" && $request->options !== " " && $request->options !== null)
            $options = json_encode(preg_split("/\,/", str_replace(", ", ",", $request->options)));

        $request->validate([
            'question' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'activity_id' => 'required|numeric',
            'options' => 'nullable',
        ]);

        Questions::create([
            "question" => $request->question,
            "type" => $request->type,
            "activity_id" => $request->activity_id,
            "options" => $options
        ]);

        return redirect(route("dashboard.questions.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function show(Questions $questions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function edit(Questions $questions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questions $questions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Questions::find($id);
        $question->delete();

        connectify('success', 'Vraag verwijderd', 'Vraag is met succes verwijderd uit de database');
        return redirect(route('dashboard.questions.index'));
    }
}
