<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\Models\TablaUbicacione;

class TablaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id_user = Auth::user()->id;
        return view('frontend.manten.create', compact('id_user'));
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
	
	public function create_ubicacion_maestro(){
	
		return view('frontend.ubicacion.create_ubicacion_maestro_cliente'/*, compact('id_user')*/);
		
	}
	
	public function listar_ubicacion_maestro_ajax(Request $request){
		
		$tabla_ubicacion_model = new TablaUbicacione;
		$p[]=1;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $tabla_ubicacion_model->listar_ubicacion_maestro_ajax($p);
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
	
	public function obtener_ubicacion_maestro_cliente($id_cliente,$tabla,$columna){
		
		//$prestamo = Prestamo::where('id_solicitud',$idSolicitud)->first();
		/*
		$cronogramaDetalle="";
		$cronograma = Cronograma::where('id_solicitud',$idSolicitud)->first();
		$solicitud = Solicitude::find($idSolicitud);
		if($cronograma)$cronogramaDetalle = CronogramaDetalle::where('id_cronograma',$cronograma->id)->get();
		
		$moneda = TablaMaestra::find($solicitud->id_moneda);
		*/
		$tabla_ubicacion_model = new TablaUbicacione;
		$ubicacion = $tabla_ubicacion_model->getTablaUbicacion($id_cliente,$tabla,$columna);
		//print_r($cronogramaDetalle);exit();
        return view('frontend.ubicacion.ubicacion_maestro_cliente_ajax',compact('ubicacion'));

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
