<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Vacacione;
use Illuminate\Http\Request;

class VacacioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.manten.vacacione');
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
     * @param  \App\Models\Vacacione  $vacacione
     * @return \Illuminate\Http\Response
     */
    public function show(Vacacione $vacacione)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacacione  $vacacione
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacacione $vacacione)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vacacione  $vacacione
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacacione $vacacione)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacacione  $vacacione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacacione $vacacione)
    {
        //
    }
}
