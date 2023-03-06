<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Activities;
use App\Models\Answers;
use App\Models\Questions;
use App\Models\Registrations;
use App\Models\User;
use Illuminate\Http\Request;

class AdminBulkDeleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.bulk_delete');
    }

    public function accounts()
    {
        $accounts = User::all();
        foreach ($accounts as $account) {
            if ($account->hasPermissionTo("view dashboard")) continue;

            foreach (Registrations::where("user_id", $account->id) as $signup) {
                $activity = Activities::find($signup->activity_id);
                if ($activity->participants > 0) $activity->decrement('participants');;
                $signup->delete;
            }
            foreach (Questions::where("user_id", $account->id) as $question)
                $question->delete;
            foreach (Answers::where("user_id", $account->id) as $answer)
                $answer->delete;
            $account->delete();
        }
        return redirect(route("dashboard.bulk_delete.index"));
    }

    public function activities()
    {
        $activities = Activities::all();
        foreach ($activities as $activity) {
            foreach (Registrations::where("activity_id", $activity->id) as $signup)
                $signup->delete;
            foreach (Questions::where("activity_id", $activity->id) as $question) {
                foreach (Answers::where("question_id", $question->id) as $answer)
                    $answer->delete;
                $question->delete;
            }
            $activity->delete();
        }
        return redirect(route("dashboard.bulk_delete.index"));
    }

    public function signups()
    {
        $signups = Registrations::all();
        foreach ($signups as $signup) {
            foreach (Answers::where("user_id", $signup->user_id) as $answer)
                $answer->delete;
            $signup->delete();
        }
        foreach (Activities::all() as $activity)
            $activity->update([
                "participants" => 0
            ]);
        return redirect(route("dashboard.bulk_delete.index"));
    }

    public function questions()
    {
        $questions = Questions::all();
        foreach ($questions as $question) {
            foreach (Answers::where("question_id", $question->id) as $answer)
                $answer->delete;
            $question->delete();
        }
        return redirect(route("dashboard.bulk_delete.index"));
    }

    public function answers()
    {
        foreach (Answers::all() as $answer)
            $answer->delete;
        return redirect(route("dashboard.bulk_delete.index"));
    }
}
