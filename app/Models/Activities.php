<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "location",
        "departure_place",
        "departure_time",
        "return_place",
        "return_time",
        "essentials",
        "price",
        "participants",
        "max_participants",
        "description",
        "image",
        "visible"
    ];

    public function questions()
    {
        return $this->hasMany(Questions::class);
    }
}
