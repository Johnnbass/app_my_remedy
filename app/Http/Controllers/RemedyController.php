<?php

namespace App\Http\Controllers;

use App\Models\Remedy;
use Illuminate\Http\Request;

class RemedyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Remedy::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Remedy::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Remedy  $remedy
     * @return \Illuminate\Http\Response
     */
    public function show(Remedy $remedy)
    {
        return $remedy;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Remedy  $remedy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Remedy $remedy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Remedy  $remedy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Remedy $remedy)
    {
        //
    }
}
