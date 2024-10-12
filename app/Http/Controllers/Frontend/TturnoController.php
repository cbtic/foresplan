<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tturno;
use Illuminate\Http\Request;

class TturnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.manten.tturno');
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
     * @param  \App\Models\Tturno  $tturno
     * @return \Illuminate\Http\Response
     */
    public function show(Tturno $tturno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tturno  $tturno
     * @return \Illuminate\Http\Response
     */
    public function edit(Tturno $tturno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tturno  $tturno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tturno $tturno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tturno  $tturno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tturno $tturno)
    {
        //
    }
}
