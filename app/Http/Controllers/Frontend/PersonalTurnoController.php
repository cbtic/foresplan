<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PersonalTurno;
use Illuminate\Http\Request;
use App\Models\Persona;

class PersonalTurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	 
    public function index()
    {
		//$id_area_trabajo=0;
        return view('frontend.manten.personal-turno');
        //
    }
	
	public function list_persona($term)
    {
		$persona_model = new Persona;
		$persona = $persona_model->getPersonaBuscar($term);
		return response()->json($persona);
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
     * @param  \App\Models\PersonalTurno  $personalTurno
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalTurno $personalTurno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonalTurno  $personalTurno
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalTurno $personalTurno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersonalTurno  $personalTurno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonalTurno $personalTurno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonalTurno  $personalTurno
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalTurno $personalTurno)
    {
        //
    }
}
