<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Tbanco;
use Illuminate\Http\Request;

class TbancoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.manten.tbanco');
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
     * @param  \App\Models\Tbanco  $tbanco
     * @return \Illuminate\Http\Response
     */
    public function show(Tbanco $tbanco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tbanco  $tbanco
     * @return \Illuminate\Http\Response
     */
    public function edit(Tbanco $tbanco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tbanco  $tbanco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tbanco $tbanco)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tbanco  $tbanco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tbanco $tbanco)
    {
        //
    }
}
