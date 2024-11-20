<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use App\Models\TablaUbicacione;
use App\Models\Persona;
use Auth;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.manten.asistencia');
        //
    }
	
	public function listar_asistencia()
    {
		$tabla_model = new TablaUbicacione;
		$area_trabajo = $tabla_model->getTablaUbicacionAll("area_trabajos","1");
		
		$meses[1]="ENERO";
		$meses[2]="FEBRERO";
		$meses[3]="MARZO";
		$meses[4]="ABRIL";
		$meses[5]="MAYO";
		$meses[6]="JUNIO";
		$meses[7]="JULIO";
		$meses[8]="AGOSTO";
		$meses[9]="SETIEMBRE";
		$meses[10]="OCTUBRE";
		$meses[11]="NOVIEMBRE";
		$meses[12]="DICIEMBRE";
	
        return view('frontend.asistencia.listar_asistencia',compact('meses','area_trabajo'));
        //
    }
	
    public function listar_resumen()
    {
		//$tabla_model = new TablaUbicacione;
		//$area_trabajo = $tabla_model->getTablaUbicacionAll("area_trabajos","1");
		
		$meses[1]="ENERO";
		$meses[2]="FEBRERO";
		$meses[3]="MARZO";
		$meses[4]="ABRIL";
		$meses[5]="MAYO";
		$meses[6]="JUNIO";
		$meses[7]="JULIO";
		$meses[8]="AGOSTO";
		$meses[9]="SETIEMBRE";
		$meses[10]="OCTUBRE";
		$meses[11]="NOVIEMBRE";
		$meses[12]="DICIEMBRE";
	
        //return view('frontend.asistencia.listar_asistencia',compact('meses','area_trabajo'));
        return view('frontend.asistencia.listar_asistencia',compact('meses'));
    }

	public function listar_asistencia_ajax(Request $request){
		
		$asistencia_model = new Asistencia;
		$p[]=$request->id_area_trabajo;
		$p[]=$request->id_unidad_trabajo;
		$p[]=$request->id_persona;
		$p[]=$request->anio;
		$p[]=$request->mes;
		$p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $asistencia_model->listar_asistencia_ajax($p);
		$iTotalDisplayRecords = isset($data[0]->totalrows)?$data[0]->totalrows:0;
		
		$result["PageStart"] = $request->NumeroPagina;
		$result["pageSize"] = $request->NumeroRegistros;
		$result["SearchText"] = "";
		$result["ShowChildren"] = true;
		$result["iTotalRecords"] = $iTotalDisplayRecords;
		$result["iTotalDisplayRecords"] = $iTotalDisplayRecords;
		$result["aaData"] = $data;
		
		echo json_encode($result);
		
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
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function show(Asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asistencia $asistencia)
    {
        //
    }
	
	public function modal_asistencia($id){
		$id_user = Auth::user()->id;
        $asistencia = Asistencia::find($id);
		
		$persona = new Persona;
		$persona = Persona::find($asistencia->id_persona);
		
		return view('frontend.asistencia.modal_asistencia',compact('id','asistencia','persona'));
	}
	
	public function modal_zkteco_log($fecha,$numero_documento){
		
		$asistencia_model = new Asistencia;
		$asistencia = $asistencia_model->get_zkteco_log($fecha,$numero_documento);
		
		return view('frontend.asistencia.modal_zkteco_log',compact('asistencia'));
	}
	
	public function send_asistencia(Request $request){
		$asistencia = Asistencia::find($request->id);
		$asistencia->fech_marc_rel= $request->fech_marc_rel;
		$asistencia->hora_entr_rel = $request->hora_entr_rel;
		$asistencia->fech_sali_rel = $request->fech_sali_rel;
		$asistencia->hora_sali_rel = $request->hora_sali_rel;

        $asistencia->hora_entrada = $request->hora_entrada;
        $asistencia->hora_salida = $request->hora_salida;

        $asistencia->save();		
		$asistencia_model = new Asistencia;
		$asistencia_model->recalcular_asistencia($asistencia->id);
	
	}
    
    public function asistencia_automatico($fecha){

        $asistencia_model = new Asistencia;
        //$datos[] = str_replace("-","/",$fecha);
        $datos[] = $fecha;
        $id_asistencia = $asistencia_model->registrar_asistencia_automatico($datos);
        echo $id_asistencia;

    }

}
