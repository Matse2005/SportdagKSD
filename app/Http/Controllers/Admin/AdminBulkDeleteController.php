<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
        return view('dashboard.export');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Answers  $answers
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }
}
