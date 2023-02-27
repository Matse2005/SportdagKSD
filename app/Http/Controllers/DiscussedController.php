<?php

namespace App\Http\Controllers;

use App\Models\Discussed;
use Illuminate\Http\Request;

class DiscussedController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
        ]);
        Discussed::create([
            "user_id" => $request->user_id,
        ]);
        return redirect(route('registrate.index'));
    }
}
