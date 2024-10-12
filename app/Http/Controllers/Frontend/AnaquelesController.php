<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\AnaqueleRequest;
use App\Models\Anaquele;
use App\Models\Almacene;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class AnaquelesController extends Controller
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
		
		return view('frontend.anaqueles.create');

	}

    public function modal_anaquel($id){
		
		//$ubigeo_model = new Ubigeo;
		$anaquel_model = new Anaquele;
		$almacen_model = new Almacene;
		$id_user = Auth::user()->id;
		//$user_model = new User;
		//$departamento = $ubigeo_model->getDepartamento();
		//$codigo = $almacen_model->getCodigo();
		//$user = $user_model->getUserAll();
		$almacen = $almacen_model->getAlmacenByUser($id_user);
		if($id>0){
			$anaquel = Anaquele::find($id);
			//dd($almacen);exit();
		}else{
			$anaquel = new Anaquele;
		}

		//var_dump($codigo[0]->codigo);exit();

		return view('frontend.anaqueles.modal_anaqueles_nuevoAnaquel',compact('id','anaquel','almacen'));

    }

    public function listar_anaqueles_ajax(Request $request){

		$anaquel_model = new Anaquele();
		$p[]=$request->denominacion;
        $p[]=$request->codigo;
        $p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $anaquel_model->listar_anaqueles_ajax($p);
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

    public function send_anaquel(Request $request){
		
		$id_user = Auth::user()->id;
		$usuario = $request->usuario;

		if($request->id == 0){
			$anaquel = new Anaquele;
		}else{
			$anaquel = Anaquele::find($request->id);
		}
		
		$anaquel->fila = $request->fila;
		$anaquel->sigla = $request->sigla;
		$anaquel->codigo = $request->codigo;
		$anaquel->denominacion = $request->denominacion;
		$anaquel->estado = 1;
		$anaquel->id_almacen = $request->almacen;
		$anaquel->save();

    }

    public function eliminar_anaquel($id,$estado)
    {
		$anaquel = Anaquele::find($id);

		$anaquel->estado = $estado;
		$anaquel->save();

		echo $anaquel->id;
    }

	public function obtener_anaquel($id_almacen){
		
		$anaquel_model = new Anaquele;
		$anaquel = $anaquel_model->getAnaquelByAlmacen($id_almacen);
		
		echo json_encode($anaquel);
	}

    /*public function index()
    {
        $anaqueles = Anaquele::latest()->paginate(10);
        return view('frontend.anaqueles.index', compact('anaqueles'));
    }

    public function create()
    {
        return view('frontend.anaqueles.create');
    }

    public function store(AnaqueleRequest $request)
    {
        $anaqueles = Anaquele::create($request->all());

        $anaqueles->secciones()->sync($request->id_secciones);

        return redirect()->route('frontend.anaqueles.index');
    }

    public function edit(Anaquele $anaqueles)
    {

        return view('frontend.anaqueles.edit', compact('anaqueles'));
    }

    public function update(AnaqueleRequest $request, Anaquele $anaqueles)
    {
        $anaqueles->update($request->all());

        $anaqueles->secciones()->sync($request->id_secciones);

        // return redirect()->route('frontend.anaqueles.show', $anaqueles->id);
        return redirect()->route('frontend.anaqueles.index');
    }

    public function show(Anaquele $anaqueles)
    {
        return view('frontend.anaqueles.show', compact('anaqueles'));
    }

    public function destroy(Anaquele $anaqueles)
    {
        if ($anaqueles->delete()) {
            Alert::success('Proceso completo', 'Se ha eliminado el anaquel '.$anaqueles['codigo']);
        }
        return redirect()->route('frontend.anaqueles.index');
    }*/
}
