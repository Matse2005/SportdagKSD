<?php

namespace App\Exports;

use App\Models\Activities;
use App\Models\Answers;
use App\Models\Questions;
use App\Models\Registrations;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithProperties;

class AnswersExport implements FromView, WithProperties
{
    public function view(): View
    {
        $answers = Answers::all();
        foreach ($answers as $answer) {
            $answer->question = Questions::find($answer->question_id);
            $answer->user = User::find($answer->user_id);
        }
        return view('exports.answers', [
            'answers' => $answers
        ]);
    }

    public function properties(): array
    {
        return [
            'title'          => 'Vragen',
        ];
    }
}
