<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\LoteRequest;
use App\Models\Lote;
use App\Models\Producto;
use App\Models\Almacene;
use App\Models\TablaMaestra;
use App\Models\AlmacenesSeccione;
use App\Models\AnaquelesSeccione;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class LoteController extends Controller
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
		$estado_bien = $tablaMaestra_model->getMaestroByTipo(4);*/
		
		return view('frontend.lotes.create');

	}

    public function listar_lote_ajax(Request $request){

		$lote_model = new Lote;
		$p[]=$request->denominacion;
		$p[]=$request->marca;
        $p[]=$request->anaquel;
        $p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $lote_model->listar_lote_ajax($p);
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

    public function modal_lote($id){
		
        $tablaMaestra_model = new TablaMaestra;
        $producto_model = new Producto;
        $almacen_model = new Almacene;

        $id_user = Auth::user()->id;
		
		if($id>0){
			$lote = Lote::find($id);
            $almacen = $almacen_model->getAlmacenAll();
		}else{
			$lote = new Lote;
            $almacen = $almacen_model->getAlmacenByUser($id_user);
		}

        $unidad_medida = $tablaMaestra_model->getMaestroByTipo(43);
        $moneda = $tablaMaestra_model->getMaestroByTipo(1);
        $marca = $tablaMaestra_model->getMaestroByTipo(47);

        $producto = $producto_model->getProductoAll();
        

		return view('frontend.lotes.modal_lotes_nuevoLote',compact('id','lote','producto','marca','unidad_medida','moneda','almacen'));

    }

    public function send_lote(Request $request){

		if($request->id == 0){
			$lote = new Lote;
		}else{
			$lote = Lote::find($request->id);
		}
		
		$lote->id_producto = $request->producto;
		$lote->numero_lote = $request->numero_lote;
        $lote->numero_serie = $request->numero_serie;
        $lote->id_unidad_medida = $request->unidad;
        $lote->cantidad = $request->cantidad;
        $lote->costo = $request->costo;
        $lote->id_moneda = $request->moneda;
        $lote->fecha_fabricacion = $request->fecha_fabricacion;
        $lote->fecha_vencimiento = $request->fecha_vencimiento;
        $lote->id_anaquel = $request->anaquel;
        $lote->id_almacen = $request->almacen;
        $lote->id_seccion = $request->seccion;
        $lote->id_marca = $request->marca;
		$lote->estado = 1;
		$lote->save();

    }

    public function eliminar_lote($id,$estado)
    {
		$lote = Lote::find($id);

		$lote->estado = $estado;
		$lote->save();

		echo $lote->id;
    }

    public function obtener_seccion_almacen($id){
		
		$almacen_seccion_model = new AlmacenesSeccione;
		$almacen_seccion = $almacen_seccion_model->getSeccionByAlmacen($id);
		echo json_encode($almacen_seccion);
	}

    public function obtener_anaquel_seccion($id){
		
		$anaquel_seccion_model = new AnaquelesSeccione;
		$anaquel_seccion = $anaquel_seccion_model->getAnaquelBySeccion($id);
		echo json_encode($anaquel_seccion);
	}

    /*public function index()
    {
        $lotes = Lote::latest()->paginate(10);
        return view('frontend.lotes.index', compact('lotes'));
    }

    public function create()
    {
        return view('frontend.lotes.create');
    }

    public function modal_create($modal = 'modal')
    {
        return view('frontend.lotes.modal_create', compact('modal'));
    }

    public function store(LoteRequest $request)
    {
        $lote = Lote::create($request->all());

        if($lote->save()) {
            return response()->json( [ 'success' => 'Lote guardado!', 'id' => $lote->id, 'numero_serie' => $lote->numero_serie ] );
        } else {
            return response()->json( [ 'errors' => 'Errores!' ] );
        }
    }

    public function edit(Lote $lotes)
    {

        return view('frontend.lotes.edit', compact('lotes'));
    }

    public function update(LoteRequest $request, Lote $lotes)
    {
        $lotes->update($request->all());

        return redirect()->route('frontend.lotes.index');
    }

    public function show(Lote $lotes)
    {
        return view('frontend.lotes.show', compact('lotes'));
    }

    public function destroy(Lote $lotes)
    {
        if ($lotes->delete()) {
            Alert::success('Proceso completo', 'Se ha eliminado el lote #'.$lotes['numero_lote']);
        };
        return redirect()->route('frontend.lotes.index');
    }*/
}
