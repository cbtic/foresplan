<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrdenCompra;
use App\Models\TablaMaestra;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\Marca;
use App\Models\OrdenCompraDetalle;
use App\Models\Kardex;
use App\Models\Almacen_usuario;
use App\Models\Almacene;
use Barryvdh\DomPDF\Facade\Pdf;
use Auth;
use Carbon\Carbon;


class OrdenCompraController extends Controller
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

        $id_user = Auth::user()->id;
		$tablaMaestra_model = new TablaMaestra;
        $almacen_user_model = new Almacen_usuario;
		$tipo_documento = $tablaMaestra_model->getMaestroByTipo(54);
        $cerrado_orden_compra = $tablaMaestra_model->getMaestroByTipo(52);
        $proveedor = Empresa::all();
        $almacen = Almacene::all();
        $almacen_usuario = $almacen_user_model->getAlmacenByUser($id_user);
        //dd($almacen_usuario);exit();
		
		return view('frontend.orden_compra.create',compact('tipo_documento','cerrado_orden_compra','proveedor','almacen','almacen_usuario'));

	}

    public function listar_orden_compra_ajax(Request $request){

		$orden_compra_model = new OrdenCompra;
		$p[]=$request->tipo_documento;
        $p[]=$request->empresa_compra;
        $p[]=$request->empresa_vende;
        $p[]=$request->fecha;
        $p[]=$request->numero_orden_compra;
        $p[]=$request->situacion;
        $p[]=$request->almacen_origen;
        $p[]=$request->almacen_destino;
        $p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $orden_compra_model->listar_orden_compra_ajax($p);
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

    public function modal_orden_compra($id){
		
        $tablaMaestra_model = new TablaMaestra;
        $producto_model = new Producto;
        $marca_model = new Marca;
        $almacen_model = new Almacene;
		
		if($id>0){

            $orden_compra = OrdenCompra::find($id);
            $proveedor = Empresa::all();
			
		}else{
			$orden_compra = new OrdenCompra;
            $proveedor = Empresa::all();
		}

        //$orden_compra_model = new OrdenCompra;
        $tipo_documento = $tablaMaestra_model->getMaestroByTipo(54);
        //$moneda = $tablaMaestra_model->getMaestroByTipo(1);
        //$unidad_origen = $tablaMaestra_model->getMaestroByTipo(50);
        //$cerrado_entrada = $tablaMaestra_model->getMaestroByTipo(52);
        //$igv_compra = $tablaMaestra_model->getMaestroByTipo(51);
        //$descuento = $tablaMaestra_model->getMaestroByTipo(55);
        $producto = $producto_model->getProductoAll();
        $marca = $marca_model->getMarcaAll();
        $estado_bien = $tablaMaestra_model->getMaestroByTipo(4);
        $unidad = $tablaMaestra_model->getMaestroByTipo(43);
        $igv_compra = $tablaMaestra_model->getMaestroByTipo(51);
        $descuento = $tablaMaestra_model->getMaestroByTipo(55);
        $almacen = $almacen_model->getAlmacenAll();
        $unidad_origen = $tablaMaestra_model->getMaestroByTipo(50);
        //$codigo_orden_compra = $orden_compra_model->getCodigoOrdenCompra();
        
        //dd($proveedor);exit();

		return view('frontend.orden_compra.modal_orden_compra_nuevoOrdenCompra',compact('id','orden_compra','tipo_documento','proveedor','producto','marca','estado_bien','unidad','igv_compra','descuento','almacen','unidad_origen'));

    }

    public function send_orden_compra(Request $request){

        $id_user = Auth::user()->id;

        if($request->id == 0){
            $orden_compra = new OrdenCompra;
        }else{
            $orden_compra = OrdenCompra::find($request->id);
        }

        $item = $request->input('item');
        $descripcion = $request->input('descripcion');
        $cod_interno = $request->input('cod_interno');
        $marca = $request->input('marca');
        $fecha_fabricacion = $request->input('fecha_fabricacion');
        $fecha_vencimiento = $request->input('fecha_vencimiento');
        $estado_bien = $request->input('estado_bien');
        $unidad = $request->input('unidad');
        $cantidad_ingreso = $request->input('cantidad_ingreso');
        $precio_unitario = $request->input('precio_unitario');
        $descuento = $request->input('descuento');
        $sub_total = $request->input('sub_total');
        $igv = $request->input('igv');
        $total = $request->input('total');
        $id_orden_compra_detalle =$request->id_orden_compra_detalle;
        
        $orden_compra->id_empresa_compra = $request->empresa_compra;
        $orden_compra->id_empresa_vende = $request->empresa_vende;
        $orden_compra->fecha_orden_compra = $request->fecha_orden_compra;
        $orden_compra->numero_orden_compra = $request->numero_orden_compra;
        $orden_compra->id_tipo_documento = $request->tipo_documento;
        $orden_compra->igv_compra = $request->igv_compra;
        $orden_compra->id_unidad_origen = $request->unidad_origen;
        $orden_compra->id_almacen_destino = $request->almacen;
        $orden_compra->id_almacen_salida = $request->almacen_salida;
        $orden_compra->cerrado = 1;
        $orden_compra->id_usuario_inserta = $id_user;
        $orden_compra->estado = 1;
        $orden_compra->save();

        foreach($item as $index => $value) {
            
            if($id_orden_compra_detalle[$index] == 0){
                $orden_compra_detalle = new OrdenCompraDetalle;
            }else{
                $orden_compra_detalle = OrdenCompraDetalle::find($id_orden_compra_detalle[$index]);
            }
            
            $orden_compra_detalle->id_orden_compra = $orden_compra->id;
            $orden_compra_detalle->id_producto = $descripcion[$index];
            $orden_compra_detalle->cantidad_requerida = $cantidad_ingreso[$index];
            $orden_compra_detalle->precio = $precio_unitario[$index];
            $orden_compra_detalle->id_descuento = $descuento[$index];
            $orden_compra_detalle->sub_total = $sub_total[$index];
            $orden_compra_detalle->igv = $igv[$index];
            $orden_compra_detalle->total = $total[$index];
            $orden_compra_detalle->fecha_fabricacion = $fecha_fabricacion[$index];
            $orden_compra_detalle->fecha_vencimiento = $fecha_vencimiento[$index];
            $orden_compra_detalle->id_estado_producto = $estado_bien[$index];
            $orden_compra_detalle->id_unidad_medida = $unidad[$index];
            $orden_compra_detalle->id_marca = $marca[$index];
            $orden_compra_detalle->estado = 1;
            $orden_compra_detalle->cerrado = 1;
            $orden_compra_detalle->id_usuario_inserta = $id_user;

            $orden_compra_detalle->save();
        }

        return response()->json(['id' => $orden_compra->id]);    
        
    }

    public function eliminar_orden_compra($id,$estado)
    {
		$orden_compra = OrdenCompra::find($id);

		$orden_compra->estado = $estado;
		$orden_compra->save();

		echo $orden_compra->id;
    }

    public function cargar_detalle($id)
    {

        $orden_compra_model = new OrdenCompra;
        $marca_model = new Marca;
        $producto_model = new Producto;
        $tablaMaestra_model = new TablaMaestra;
        $kardex_model = new Kardex;

        $orden_compra = $orden_compra_model->getDetalleOrdenCompraId($id);
        $marca = $marca_model->getMarcaAll();
        $producto = $producto_model->getProductoAll();
        $estado_bien = $tablaMaestra_model->getMaestroByTipo(4);
        $unidad_medida = $tablaMaestra_model->getMaestroByTipo(43);
        $descuento = $tablaMaestra_model->getMaestroByTipo(55);

        $producto_stock = [];

        foreach($orden_compra as $detalle){
            $stock = $kardex_model->getExistenciaProductoById($detalle->id_producto);
            if(count($stock)>0){
                $producto_stock[$detalle->id_producto] = $stock[0];
            }else {
                $producto_stock[$detalle->id_producto] = ['saldos_cantidad'=>0];
            }
            
            //var_dump($producto_stock);
        }
        
        //exit();

        return response()->json([
            'orden_compra' => $orden_compra,
            'marca' => $marca,
            'producto' => $producto,
            'estado_bien' => $estado_bien,
            'unidad_medida' => $unidad_medida,
            'descuento' => $descuento,
            'producto_stock' =>$producto_stock
        ]);
    }

    public function movimiento_pdf($id){

        $orden_compra_model = new OrdenCompra;
        $orden_compra_detalle_model = new OrdenCompraDetalle;

        $datos=$orden_compra_model->getOrdenCompraById($id);
        $datos_detalle=$orden_compra_detalle_model->getDetalleOrdenCompraPdf($id);

        $tipo_documento=$datos[0]->tipo_documento;
        $empresa_compra=$datos[0]->empresa_compra;
        $empresa_vende=$datos[0]->empresa_vende;
        $fecha_orden_compra = $datos[0]->fecha_orden_compra;
        $numero_orden_compra = $datos[0]->numero_orden_compra;
        $igv=$datos[0]->igv;
        
		$year = Carbon::now()->year;

		Carbon::setLocale('es');

		// Crear una instancia de Carbon a partir de la fecha

		 $carbonDate =Carbon::now()->format('d-m-Y');

		 $currentHour = Carbon::now()->format('H:i:s');

		$pdf = Pdf::loadView('frontend.orden_compra.movimiento_orden_compra_pdf',compact('tipo_documento','empresa_compra','empresa_vende','fecha_orden_compra','numero_orden_compra','igv','datos_detalle'));
		


		$pdf->setPaper('A4'); // Tamaño de papel (puedes cambiarlo según tus necesidades)

		$pdf->setPaper('A4', 'landscape');
    	$pdf->setOption('margin-top', 20); // Márgen superior en milímetros
   		$pdf->setOption('margin-right', 50); // Márgen derecho en milímetros
    	$pdf->setOption('margin-bottom', 20); // Márgen inferior en milímetros
    	$pdf->setOption('margin-left', 100); // Márgen izquierdo en milímetros

		return $pdf->stream();
    	//return $pdf->download('invoice.pdf');
		//return view('frontend.certificado.certificado_pdf');

	}

    public function obtener_codigo_orden_compra($tipo_documento){
		
		$orden_compra_model = new OrdenCompra;
		$codigo_orden_compra = $orden_compra_model->getCodigoOrdenCompra($tipo_documento);
		
		return response()->json($codigo_orden_compra);
	}

}
