<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\SeccioneRequest;
use App\Models\Seccione;
use App\Models\Almacene;
use App\Models\Anaquele;
use App\Models\AnaquelesSeccione;
use App\Models\AlmacenesSeccione;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class SeccionesController extends Controller
{
    public function __construct(){

		$this->middleware(function ($request, $next) {
			if(!Auth::check()) {
                return redirect('login');
            }
			return $next($request);
    	});
	}

    public function create(){

		/*$tablaMaestra_model = new TablaMaestra;
		$tipo_madera = $tablaMaestra_model->getMaestroByTipo(42);
		$tipo_documento = $tablaMaestra_model->getMaestroByTipo(9);*/
		
		
		return view('frontend.secciones.create');

	}

    public function modal_seccion($id){
		
		//$ubigeo_model = new Ubigeo;
		$seccion_model = new Seccione;
		$almacen_model = new Almacene;
		$anaquel_model = new Anaquele;
		$id_user = Auth::user()->id;
		//$user_model = new User;
		//$departamento = $ubigeo_model->getDepartamento();
		$codigo = $seccion_model->getCodigo();
		//$almacen = $almacen_model->getAlmacenByUser($id_user);
		$anaquel = $anaquel_model->getAnaquel();

		if($id>0){
			$seccion = Seccione::find($id);
			$almacen_seccion = AlmacenesSeccione::where('id_secciones',$seccion->id)->first();
			$almacen = $almacen_model->getAlmacenAll();
		}else{
			$seccion = new Seccione;
			$almacen_seccion = null;
			$almacen = $almacen_model->getAlmacenByUser($id_user);
		}

		//var_dump($id);exit();

		return view('frontend.secciones.modal_secciones_nuevoSeccion',compact('id','codigo','seccion','almacen','anaquel','almacen_seccion'));

    }

    public function listar_seccion_ajax(Request $request){

		$seccion_model = new Seccione();
		$p[]=$request->almacen;
		$p[]=$request->denominacion;
        $p[]=$request->codigo;
        $p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $seccion_model->listar_seccion_ajax($p);
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

    public function send_seccion(Request $request){
		
		/*$id_user = Auth::user()->id;
		$usuario = $request->usuario;*/
		$anaquel = $request->anaquel;
		//dd($anaquel);exit();
		if($request->id == 0){
			$seccion = new Seccione;
			$almacenes_secciones = new AlmacenesSeccione;
		}else{
			$seccion = Seccione::find($request->id);
			$almacenes_secciones = AlmacenesSeccione::where('id_secciones',$seccion->id)->first();
		}
		
		$seccion->codigo = $request->codigo;
		$seccion->denominacion = $request->denominacion;
		$seccion->estado = 1;
		$seccion->save();

		if (isset($anaquel[0])){
			foreach($anaquel as $seccion_id){
				$anaquel_seccion = new AnaquelesSeccione;
				$anaquel_seccion->id_anaqueles = $seccion_id;
				$anaquel_seccion->id_secciones = $seccion->id;
				$anaquel_seccion->estado = 1;
				$anaquel_seccion->save();

			}
		}

		$almacenes_secciones->id_almacenes = $request->almacen;
		$almacenes_secciones->id_secciones = $seccion->id;
		$almacenes_secciones->save();

    }

    public function eliminar_seccion($id,$estado)
    {
		$seccion = Seccione::find($id);

		$seccion->estado = $estado;
		$seccion->save();

		echo $seccion->id;
    }

	public function modal_ver_anaqueles($id){
		 
		$anaquel_model = new Anaquele;
        $anaquel = $anaquel_model->getAnaquelBySeccion($id);
		
        return view('frontend.secciones.modal_ver_anaqueles',compact('anaquel'));
		
    }

	public function send_editar_anaquel_activo(Request $request)
	{
		$estados = $request->input('estado', []);
		
		foreach ($estados as $id => $estado) {
			$anaquel_seccion = AnaquelesSeccione::find($id);
			if ($anaquel_seccion) {
				$anaquel_seccion->estado = $estado;
				$anaquel_seccion->save();
			}
		}
		
		return response()->json(['success' => true]);
	}

	public function cargar_anaqueles($id)
    {

		$anaqueles_secciones_model = new AnaquelesSeccione;

		$anaqueles_secciones = $anaqueles_secciones_model->getAnaquelBySeccionEdit($id);

		return response()->json($anaqueles_secciones);
    }

    /*public function index()
    {
        $secciones = Seccione::latest()->paginate(10);
        return view('frontend.secciones.index', compact('secciones'));
    }

    public function create()
    {
        return view('frontend.secciones.create');
    }

    public function store(SeccioneRequest $request)
    {
        $secciones = Seccione::create($request->all());

        $secciones->almacenes()->sync($request->id_almacenes);
        $secciones->anaqueles()->sync($request->id_anaqueles);

        return redirect()->route('frontend.secciones.index');
    }

    public function edit(Seccione $secciones)
    {

        return view('frontend.secciones.edit', compact('secciones'));
    }

    public function update(SeccioneRequest $request, Seccione $secciones)
    {
        $secciones->update($request->all());

        $secciones->almacenes()->sync([$request->id_almacenes]);
        $secciones->anaqueles()->sync($request->id_anaqueles);

        // return redirect()->route('frontend.secciones.show', $secciones->id);
        return redirect()->route('frontend.secciones.index');
    }

    public function show(Seccione $secciones)
    {
        return view('frontend.secciones.show', compact('secciones'));
    }

    public function destroy(Seccione $secciones)
    {
        if ($secciones->delete()) {
            Alert::success('Proceso completo', 'Se ha eliminado la sección '.$secciones['codigo']);
        };

        return redirect()->route('frontend.secciones.index');
    }*/
}
