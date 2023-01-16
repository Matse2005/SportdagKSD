<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", "question_id", "answer"
    ];

    public function question()
    {
        return $this->belongsTo(Questions::class);
    }
}
