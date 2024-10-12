<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PersonaDetalle;
use App\Models\Persona;
use Illuminate\Http\Request;

//use App\Models\CondicionLaborale;

class PersonaDetalleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//$lista_condicion_laborales = CondicionLaborale::all();
		//$lista_condicion_laboral="";
        //return view('frontend.manten.persona-detalle',compact('lista_condicion_laborales','lista_condicion_laboral'));
		
		return view('frontend.manten.persona-detalle');
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
     * @param  \App\Models\PersonaDetalle  $personaDetalle
     * @return \Illuminate\Http\Response
     */
    public function show(PersonaDetalle $personaDetalle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersonaDetalle  $personaDetalle
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonaDetalle $personaDetalle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersonaDetalle  $personaDetalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonaDetalle $personaDetalle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersonaDetalle  $personaDetalle
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonaDetalle $personaDetalle)
    {
        //
    }

    public function send_personad(Request $request){
		
        //print($request);
        //exit();

		if($request->id == 0){
			$personad = new PersonaDetalle;
            $personad->id_persona = $request->id_persona;
            $personad->direccion = $request->direccion;
            $personad->ubigeo = $request->ubigeo;
            $personad->telefono = $request->telefono;
            $personad->email = $request->email;
            $personad->fecha_ingreso = $request->fecha_ingreso;
            $personad->id_condicion_laboral = $request->id_condicion_laboral;
            $personad->id_tipo_planilla = $request->id_tipo_planilla;
            $personad->id_profesion = $request->id_profesion;
            $personad->id_banco_sueldo = $request->id_banco_sueldo;
            $personad->num_cuenta_sueldo = $request->num_cuenta_sueldo;
            $personad->cci_sueldo = $request->cci_sueldo;
            $personad->id_regimen_pensionario = $request->id_regimen_pensionario;
            $personad->id_afp = $request->id_afp;
            $personad->fecha_afiliacion_afp = $request->fecha_afiliacion_afp;
            $personad->id_tipo_comision_afp = $request->id_tipo_comision_afp;
            $personad->cuspp = $request->cuspp;
            $personad->fecha_cese = $request->fecha_cese;
            $personad->fecha_termino_contrato = $request->fecha_termino_contrato;
            $personad->num_contrato = $request->num_contrato;
            $personad->id_cargo = $request->id_cargo;
            $personad->id_nivel = $request->id_nivel;
            $personad->id_banco_cts = $request->id_banco_cts;
            $personad->num_cuenta_cts = $request->num_cuenta_cts;
            $personad->id_moneda_cts = $request->id_moneda_cts;
            $personad->estado = $request->estado;
            $personad->id_ubicacion = $request->id_ubicacion;
            $personad->id_area_trabajo = $request->id_area_trabajo;
            $personad->id_unidad_trabajo = $request->id_unidad_trabajo;
            $personad->eliminado = 'N';
      		      
            $personad->save();
		}else{
			$personad = PersonaDetalle::find($request->id);
            $personad->id = $request->id;
            $personad->id_persona = $request->id_persona;
            $personad->direccion = $request->direccion;
            $personad->ubigeo = $request->ubigeo;
            $personad->telefono = $request->telefono;
            $personad->email = $request->email;
            $personad->fecha_ingreso = $request->fecha_ingreso;
            $personad->id_condicion_laboral = $request->id_condicion_laboral;
            $personad->id_tipo_planilla = $request->id_tipo_planilla;
            $personad->id_profesion = $request->id_profesion;
            $personad->id_banco_sueldo = $request->id_banco_sueldo;
            $personad->num_cuenta_sueldo = $request->num_cuenta_sueldo;
            $personad->cci_sueldo = $request->cci_sueldo;
            $personad->id_regimen_pensionario = $request->id_regimen_pensionario;
            $personad->id_afp = $request->id_afp;
            $personad->fecha_afiliacion_afp = $request->fecha_afiliacion_afp;
            $personad->id_tipo_comision_afp = $request->id_tipo_comision_afp;
            $personad->cuspp = $request->cuspp;
            $personad->fecha_cese = $request->fecha_cese;
            $personad->fecha_termino_contrato = $request->fecha_termino_contrato;
            $personad->num_contrato = $request->num_contrato;
            $personad->id_cargo = $request->id_cargo;
            $personad->id_nivel = $request->id_nivel;
            $personad->id_banco_cts = $request->id_banco_cts;
            $personad->num_cuenta_cts = $request->num_cuenta_cts;
            $personad->id_moneda_cts = $request->id_moneda_cts;
            $personad->estado = $request->estado;
            $personad->id_ubicacion = $request->id_ubicacion;
            $personad->id_area_trabajo = $request->id_area_trabajo;
            $personad->id_unidad_trabajo = $request->id_unidad_trabajo;            

			$personad->save();
		}

        $persona = Persona::find($request->id_persona);
        $persona->fecha_nacimiento = $request->fecha_nacimiento;
        $persona->sexo = $request->sexo;
        $persona->save();

    }

    public function eliminar_personad($id,$estado)
    {
		$personad = PersonaDetalle::find($id);
		$personad->eliminado = $estado;
		$personad->save();

		echo $personad->id;

    }

    public function send_personad_idper($id){
		$persona_detalle = PersonaDetalle::where('id_persona',$id)->where('estado','A')->first();
        $array["persona_detalle"] = $persona_detalle;
        echo json_encode($array);
    }

}
