<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\ProductoRequest;
use App\Models\Producto;
use App\Models\TablaMaestra;
use App\Models\Marca;
use App\Models\EntradaProductoDetalle;
use App\Models\SalidaProductoDetalle;
use App\Models\Kardex;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class ProductosController extends Controller
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

		$tablaMaestra_model = new TablaMaestra;
		$estado_bien = $tablaMaestra_model->getMaestroByTipo(56);
		
		return view('frontend.productos.create',compact('estado_bien'));

	}

    public function listar_producto_ajax(Request $request){

		$producto_model = new Producto;
		$p[]=$request->serie;
		$p[]=$request->denominacion;
        $p[]=$request->codigo;
        $p[]=$request->estado_bien;
        $p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $producto_model->listar_producto_ajax($p);
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

    public function modal_producto($id){
		
        $tablaMaestra_model = new TablaMaestra;
        $marca_model = new Marca;
		
		if($id>0){
			$producto = Producto::find($id);
		}else{
			$producto = new Producto;
		}

        $unidad_producto = $tablaMaestra_model->getMaestroByTipo(43);
        $moneda = $tablaMaestra_model->getMaestroByTipo(1);
        $tipo_producto = $tablaMaestra_model->getMaestroByTipo(44);
        $estado_bien = $tablaMaestra_model->getMaestroByTipo(56);
        $unidad_medida = $tablaMaestra_model->getMaestroByTipo(57);
        $marca = $marca_model->getMarcaAll();
		//var_dump($id);exit();

		return view('frontend.productos.modal_productos_nuevoProducto',compact('id','producto','unidad_medida','moneda','estado_bien','tipo_producto','unidad_producto','marca'));

    }

    public function send_producto(Request $request){

        $existe_producto_codigo = Producto::where('codigo', $request->codigo)->first();

        $existe_producto_serie = Producto::where('numero_serie', $request->numero_serie)->first();

        if ($existe_producto_serie && $existe_producto_serie->id != $request->id) {
            return response()->json([
            'error' => 'El número de serie ya está registrado.'
            ]);
        }

        if ($existe_producto_codigo && $existe_producto_codigo->id != $request->id) {
            return response()->json([
            'error' => 'El código ya está registrado.'
            ]);
        }

		if($request->id == 0){
			$producto = new Producto;
            $producto_model = new Producto;
            $correlativo = $producto_model->getCorrelativo();
            $producto->numero_corrrelativo = $correlativo[0]->numero_correlativo;
		}else{
			$producto = Producto::find($request->id);
		}
		
		$producto->numero_serie = $request->numero_serie;
		$producto->codigo = $request->codigo;
        $producto->denominacion = $request->denominacion;
        $producto->id_unidad_medida = $request->unidad_medida;
        $producto->stock_actual = $request->stock_actual;
        $producto->id_moneda = $request->moneda;
        $producto->id_tipo_producto = $request->tipo_producto;
        $producto->fecha_vencimiento = $request->fecha_vencimiento;
        $producto->id_estado_bien = $request->estado_bien;
        $producto->stock_minimo = $request->stock_minimo;
        $producto->observacion = "";
        $producto->costo_unitario = $request->costo_unitario;
        $producto->contenido = $request->contenido;
        $producto->id_unidad_producto = $request->unidad_producto;
        $producto->id_marca = $request->marca;
        //$producto->numero_corrrelativo = $numero_correlativo;
		$producto->estado = 1;
		$producto->save();

        return response()->json(['success' => 'Producto guardado exitosamente.']);

    }

    public function eliminar_producto($id,$estado)
    {
		$producto = Producto::find($id);

		$producto->estado = $estado;
		$producto->save();

		echo $producto->id;
    }

    public function obtener_producto($id_producto){
        
		$producto_model = new Producto;
		$producto = $producto_model->getProductoById($id_producto);
		
		echo json_encode($producto);
	}

    public function obtener_producto_stock($id_producto, $tipo_movimiento){
        
        if($tipo_movimiento==1){

            /*$entrada_producto_detalle_model = new EntradaProductoDetalle;
            $kardex_model = new Kardex;

            $entrada_producto = $entrada_producto_detalle_model->getDetalleProductoId($id_producto);

            $producto_stock = [];

            foreach($entrada_producto as $detalle){
                $stock = $kardex_model->getExistenciaProductoById($detalle->id_producto);
                if(count($stock)>0){
                    $producto_stock[$detalle->id_producto] = $stock[0];
                }else {
                    $producto_stock[$detalle->id_producto] = ['saldos_cantidad'=>0];
                }
            }*/

            $kardex_model = new Kardex;

            $stock = $kardex_model->getExistenciaProductoById($id_producto);

            $producto_stock = [];

            if(count($stock)>0){
                $producto_stock[$stock[0]->id_producto] = $stock[0];
            }else {
                $producto_stock[$stock[0]->id_producto] = ['saldos_cantidad'=>0];
            }

            return response()->json([
                'producto_stock' =>$producto_stock
            ]);
        }else if ($tipo_movimiento==2){

            $salida_producto_detalle_model = new SalidaProductoDetalle;
            $kardex_model = new Kardex;

            $entrada_producto = $salida_producto_detalle_model->getDetalleProductoId($id_producto);

		    $producto_stock = [];

            foreach($entrada_producto as $detalle){
                $stock = $kardex_model->getExistenciaProductoById($detalle->id_producto);
                if(count($stock)>0){
                    $producto_stock[$detalle->id_producto] = $stock[0];
                }else {
                    $producto_stock[$detalle->id_producto] = ['saldos_cantidad'=>0];
                }
            }
            return response()->json([
                'producto_stock' =>$producto_stock
            ]);
        }
	}
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {
        $productos = Producto::latest()->paginate(10);

        return view('frontend.productos.index', compact('productos'));
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        return view('frontend.productos.create');
    }

    public function modal_create($modal = 'modal')
    {
        return view('frontend.productos.modal_create', compact('modal'));
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(ProductoRequest $request)
    {
        $producto = Producto::create($request->all());

        if($producto->save()) {
            return response()->json( [ 'success' => 'Producto guardado!', 'id' => $producto->id, 'denominacion' => $producto->denominacion ] );
        } else {
            return response()->json( [ 'errors' => 'Errores!' ] );
        }
        // return redirect()->route('frontend.productos.index');
    }*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show(Producto $productos)
    {
        return view('frontend.productos.show', compact('productos'));
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function edit(Producto $productos)
    {
        return view('frontend.productos.edit', compact('productos'));
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function update(ProductoRequest $request, Producto $productos)
    {
        $productos->update($request->all());

        return redirect()->route('frontend.productos.index');
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(Producto $productos)
    {
        if ($productos->delete()) {
            Alert::success('Proceso completo', 'Se ha eliminado el producto '.$productos['codigo']);
        };
        return redirect()->route('frontend.productos.index');
    }*/
}
