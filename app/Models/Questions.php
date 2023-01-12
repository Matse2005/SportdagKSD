<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $fillable = [
        "question",
        "type",
        "options",
        "activity_id"
    ];

    public function answers()
    {
        return $this->hasMany(Answers::class);
    }
}
