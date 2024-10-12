<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Requests\EntradaProductoRequest;
use App\Models\EntradaProducto;
use App\Models\TablaMaestra;
use App\Models\Empresa;
use App\Models\TipoCambio;
use App\Models\EntradaProductoDetalle;
use App\Models\Producto;
use App\Models\Almacene;
use App\Models\AlmacenesSeccione;
use App\Models\Anaquele;
use App\Models\SalidaProducto;
use App\Models\SalidaProductoDetalle;
use App\Models\Marca;
use App\Models\Kardex;
use App\Models\OrdenCompra;
use App\Models\OrdenCompraDetalle;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Luecano\NumeroALetras\NumeroALetras;

class EntradaProductosController extends Controller
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
        $almacen_model = new Almacene;
        $id_user = Auth::user()->id;

        $tipo_movimiento = $tablaMaestra_model->getMaestroByTipo(53);
        $tipo_documento_entrada = $tablaMaestra_model->getMaestroByTipo(48);
        $tipo_documento_salida = $tablaMaestra_model->getMaestroByTipo(49);
        $unidad_origen = $tablaMaestra_model->getMaestroByTipo(50);
        $cerrado_entrada = $tablaMaestra_model->getMaestroByTipo(52);
        $almacen = $almacen_model->getAlmacenByUser($id_user);
        $proveedor = Empresa::all();
		
		return view('frontend.entrada_productos.create',compact('cerrado_entrada','tipo_movimiento','tipo_documento_entrada','tipo_documento_salida','unidad_origen','almacen','proveedor'));

	}

    public function listar_entrada_productos_ajax(Request $request){

		$entrada_producto_model = new EntradaProducto;
		$p[]=$request->tipo_movimiento;
        $p[]=$request->tipo_documento;
        $p[]=$request->unidad_origen;
        $p[]=$request->almacen_destino;
        $p[]=$request->proveedor;
        $p[]=$request->numero_comprobante;
        $p[]=$request->situacion;
        $p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $entrada_producto_model->listar_entrada_productos_ajax($p);
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

    public function modal_entrada_producto($id){
		
        $tablaMaestra_model = new TablaMaestra;
        $tipo_cambio_model = new TipoCambio;
        $almacen_model = new Almacene;
        $id_user = Auth::user()->id;
		
		if($id>0){

            $entrada_producto = EntradaProducto::find($id);
            $proveedor = Empresa::find($entrada_producto->id_proveedor);
            $tipo_cambio = null;
            //$proveedor = $almacen_model->getAlmacenAll();
            $almacen = null;
			
		}else{
			$entrada_producto = new EntradaProducto;
            $proveedor = Empresa::all();
            $tipo_cambio = $tipo_cambio_model->getTipoCambioUltimo();
            $almacen = $almacen_model->getAlmacenByUser($id_user);
		}

        $tipo_documento = $tablaMaestra_model->getMaestroByTipo(48);
        $moneda = $tablaMaestra_model->getMaestroByTipo(1);
        $unidad_origen = $tablaMaestra_model->getMaestroByTipo(50);
        $cerrado_entrada = $tablaMaestra_model->getMaestroByTipo(52);
        $igv_compra = $tablaMaestra_model->getMaestroByTipo(51);

        //$producto = $producto_model->getProductoAll();
        
        //dd($proveedor);exit();

		return view('frontend.entrada_productos.modal_entradas_nuevoEntrada',compact('id','entrada_producto','tipo_documento','moneda','unidad_origen','proveedor','tipo_cambio','cerrado_entrada','igv_compra','almacen'));

    }

    public function send_entrada_producto(Request $request){

        $id_user = Auth::user()->id;

        if($request->tipo_movimiento==1){

            //if($request->id == 0){
                $entrada_producto = new EntradaProducto;
            //}else{
            //    $entrada_producto = EntradaProducto::find($request->id);
            //}

            $item = $request->input('item');
            //$cantidad = $request->input('cantidad');
            $descripcion = $request->input('descripcion');
            //$ubicacion_fisica_seccion = $request->input('ubicacion_fisica_seccion');
            //$ubicacion_fisica_anaquel = $request->input('ubicacion_fisica_anaquel');
            $cod_interno = $request->input('cod_interno');
            $marca = $request->input('marca');
            $fecha_fabricacion = $request->input('fecha_fabricacion');
            $fecha_vencimiento = $request->input('fecha_vencimiento');
            $estado_bien = $request->input('estado_bien');
            $unidad = $request->input('unidad');
            $cantidad_ingreso = $request->input('cantidad_ingreso');
            $cantidad_compra = $request->input('cantidad_compra');
            $cantidad_pendiente = $request->input('cantidad_pendiente');
            $stock_actual = $request->input('stock_actual');
            $precio_unitario = $request->input('precio_unitario');
            $sub_total = $request->input('sub_total');
            $igv = $request->input('igv');
            $total = $request->input('total');

            
            $entrada_producto->fecha_ingreso = $request->fecha_entrada;
            $entrada_producto->id_tipo_documento = $request->tipo_documento;
            $entrada_producto->unidad_origen = $request->unidad_origen;
            $entrada_producto->id_proveedor = $request->proveedor;
            //$entrada_producto->numero_comprobante = $request->numero_comprobante;
            $entrada_producto->fecha_comprobante = "18/08/2024";
            $entrada_producto->id_moneda = $request->moneda;
            $entrada_producto->tipo_cambio_dolar = $request->tipo_cambio_dolar;
            $entrada_producto->sub_total_compra = 100;
            $entrada_producto->igv_compra = $request->igv_compra;
            $entrada_producto->total_compra = 100;
            $entrada_producto->cerrado = $request->cerrado;
            $entrada_producto->observacion = $request->observacion;
            $entrada_producto->id_almacen_destino = $request->almacen;
            $entrada_producto->id_empresa_compra = $request->empresa_compra;
            $entrada_producto->codigo = $request->codigo;
            $entrada_producto->id_usuario_recibe = $id_user;
            $entrada_producto->estado = 1;
            $entrada_producto->id_orden_compra = $request->id_orden_compra;
            $entrada_producto->save();

            $valida_estado = true;

            foreach($item as $index => $value) {
                
                $entradaProducto_detalle = new EntradaProductoDetalle();
                $entradaProducto_detalle->id_entrada_productos = $entrada_producto->id;
                $entradaProducto_detalle->numero_serie = $item[$index];
                $entradaProducto_detalle->cantidad = $cantidad_ingreso[$index];

                //$entradaProducto_detalle->numero_lote = "";
                $entradaProducto_detalle->fecha_vencimiento = $fecha_vencimiento[$index];
                $entradaProducto_detalle->aplica_precio = "";
                $entradaProducto_detalle->id_um = $unidad[$index];
                $entradaProducto_detalle->id_marca = $marca[$index];
                $entradaProducto_detalle->estado = 1;
                $entradaProducto_detalle->id_producto = $descripcion[$index];
                $entradaProducto_detalle->costo = $precio_unitario[$index];
                $entradaProducto_detalle->fecha_fabricacion = $fecha_fabricacion[$index];
                $entradaProducto_detalle->id_estado_bien = $estado_bien[$index];

                /*$entradaProducto_detalle->descripcion = $descripcion[$index];
                $entradaProducto_detalle->cod_interno = $cod_interno[$index];
                $entradaProducto_detalle->cantidad_compra = $cantidad_compra[$index];
                $entradaProducto_detalle->cantidad_pendiente = $cantidad_pendiente[$index];
                $entradaProducto_detalle->stock_actual = $stock_actual[$index];
                $entradaProducto_detalle->precio_unitario = $precio_unitario[$index];*/
                $entradaProducto_detalle->sub_total = $sub_total[$index];
                $entradaProducto_detalle->igv = $igv[$index];
                $entradaProducto_detalle->cerrado = 1;
                $entradaProducto_detalle->total = $total[$index];

                if($cantidad_pendiente[$index]!=0){
                    $valida_estado = false;
                }

                $entradaProducto_detalle->save();

                $producto = Producto::find($descripcion[$index]);
                $kardex_buscar = Kardex::where("id_producto",$descripcion[$index])->orderBy('id', 'desc')->first();
                //var_dump($kardex_buscar);exit();
                $kardex = new Kardex;
                $kardex->id_producto = $descripcion[$index];
                $kardex->entradas_cantidad = $cantidad_ingreso[$index];
                $kardex->costo_entradas_cantidad = $precio_unitario[$index];
                $kardex->total_entradas_cantidad = $total[$index];
                if($kardex_buscar){
                    $cantidad_saldo = $kardex_buscar->saldos_cantidad + $cantidad_ingreso[$index];
                    $kardex->saldos_cantidad = $cantidad_saldo;
                    $kardex->costo_saldos_cantidad = $producto->costo_unitario;
                    $total_kardex = $cantidad_saldo * $producto->costo_unitario;
                    $kardex->total_saldos_cantidad = $total_kardex;
                }else{
                    $kardex->saldos_cantidad = $cantidad_ingreso[$index];
                    $kardex->costo_saldos_cantidad = $producto->costo_unitario;
                    $total_kardex = $cantidad_ingreso[$index] * $producto->costo_unitario;
                    $kardex->total_saldos_cantidad = $total_kardex;
                }

                $kardex->id_entrada_producto = $entrada_producto->id;
                $kardex->id_almacen_destino = $request->almacen;

                $kardex->save();

            }

            if($valida_estado==true){
                $entrada_producto = EntradaProducto::where('id_orden_compra',$request->id_orden_compra)->first();
                $entrada_producto_detalle = EntradaProductoDetalle::where('id_entrada_productos',$entrada_producto->id)->get();
                $orden_compra = OrdenCompra::find($entrada_producto->id_orden_compra);
                $orden_compra_detalle = OrdenCompraDetalle::where('id_orden_compra',$orden_compra->id)->get();
                $entrada_producto_detalle_model = new EntradaProductoDetalle;

                foreach($entrada_producto_detalle as $index => $detalle){

                    $detalle_orden = $orden_compra_detalle[$index];
                    
                    $cantidad_requerida = $detalle_orden->cantidad_requerida;
                    
                    $cantidad_ingresada = $entrada_producto_detalle_model->getCantidadEntradaProductoByOrdenProducto($orden_compra->id,$detalle->id_producto);

                    if($cantidad_requerida - $cantidad_ingresada==0){
                        $entradaProductoDetalleObj = EntradaProductoDetalle::find($detalle->id);
                        $entradaProductoDetalleObj->cerrado = 2;
                        $entradaProductoDetalleObj->save();

                        $ordenCompraDetalleObj = OrdenCompraDetalle::find($detalle_orden->id);
                        $ordenCompraDetalleObj->cerrado = 2;
                        $ordenCompraDetalleObj->save();
                    }
                    /*
                    if ($detalle->cantidad != $detalle_orden->cantidad_requerida) {
                        $valida_estado = false;
                        break;
                    }
                    */
                }
                /*
                if($valida_estado==true){
                    $entrada_producto->cerrado = 2;
                    $entrada_producto->save();
                }
               */

                $entrada_producto_detalle_valida = EntradaProductoDetalle::where('id_entrada_productos',$entrada_producto->id)->where('cerrado','2')->get();
                if($entrada_producto_detalle_valida->count()==$entrada_producto_detalle->count()){
                    $entrada_producto_all = EntradaProducto::where('id_orden_compra',$request->id_orden_compra)->get();
                    foreach ($entrada_producto_all as $entrada_producto_) {
                        $entrada_producto_->cerrado = 2;
                        $entrada_producto_->save();
                    }

                    $OrdenCompraObj = OrdenCompra::find($orden_compra->id);
                    $OrdenCompraObj->cerrado = 2;
                    $OrdenCompraObj->save();
                }

            }

        }else if($request->tipo_movimiento==2){

            if($request->id == 0){
                $salida_producto = new SalidaProducto;
            }else{
                $salida_producto = SalidaProducto::find($request->id);
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
            $cantidad_compra = $request->input('cantidad_compra');
            $cantidad_pendiente = $request->input('cantidad_pendiente');
            $stock_actual = $request->input('stock_actual');
            $precio_unitario = $request->input('precio_unitario');
            $sub_total = $request->input('sub_total');
            $igv = $request->input('igv');
            $total = $request->input('total');
            
            $salida_producto->fecha_salida = $request->fecha_entrada;
            $salida_producto->id_tipo_documento = $request->tipo_documento;
            $salida_producto->unidad_destino = $request->unidad_origen;
            $salida_producto->numero_comprobante = $request->numero_comprobante;
            $salida_producto->fecha_comprobante = "18/08/2024";
            $salida_producto->id_moneda = $request->moneda;
            $salida_producto->tipo_cambio_dolar = $request->tipo_cambio_dolar;
            $salida_producto->sub_total_compra = 100;
            $salida_producto->igv_compra = $request->igv_compra;
            $salida_producto->total_compra = 100;
            $salida_producto->cerrado = $request->cerrado;
            $salida_producto->observacion = $request->observacion;
            $salida_producto->id_almacen_salida = $request->almacen_salida;
            $salida_producto->estado = 1;
            $salida_producto->id_orden_compra = $request->id_orden_compra;
            $salida_producto->id_proveedor = $request->proveedor;
            $salida_producto->id_empresa_compra = $request->empresa_compra;
            $salida_producto->codigo = $request->codigo;
            $salida_producto->save();

            $valida_estado = true;

            foreach($item as $index => $value) {
                
                $salida_producto_detalle = new SalidaProductoDetalle();
                $salida_producto_detalle->id_salida_productos = $salida_producto->id;
                $salida_producto_detalle->numero_serie = $item[$index];
                $salida_producto_detalle->cantidad = $cantidad_ingreso[$index];

                //$salida_producto_detalle->numero_lote = "";
                $salida_producto_detalle->fecha_vencimiento = $fecha_vencimiento[$index];
                $salida_producto_detalle->aplica_precio = "";
                $salida_producto_detalle->id_um = $unidad[$index];
                $salida_producto_detalle->id_marca = $marca[$index];
                $salida_producto_detalle->estado = 1;
                $salida_producto_detalle->cerrado = 1;
                $salida_producto_detalle->id_producto = $descripcion[$index];
                $salida_producto_detalle->costo = $precio_unitario[$index];
                //$salida_producto_detalle->fecha_fabricacion = "2024-08-18";
                $salida_producto_detalle->id_estado_productos = $estado_bien[$index];

                /*$salida_producto_detalle->descripcion = $descripcion[$index];
                $salida_producto_detalle->cod_interno = $cod_interno[$index];
                $salida_producto_detalle->cantidad_ingreso = $cantidad_ingreso[$index];
                $salida_producto_detalle->cantidad_compra = $cantidad_compra[$index];
                $salida_producto_detalle->cantidad_pendiente = $cantidad_pendiente[$index];
                $salida_producto_detalle->stock_actual = $stock_actual[$index];*/
                $salida_producto_detalle->sub_total = floatval($sub_total[$index]);
                $salida_producto_detalle->igv = floatval($igv[$index]);
                $salida_producto_detalle->total = floatval($total[$index]);

                if($cantidad_pendiente[$index]!=0){
                    $valida_estado = false;
                }

                $salida_producto_detalle->save();

                $producto = Producto::find($descripcion[$index]);
                $kardex_buscar = Kardex::where("id_producto",$descripcion[$index])->orderBy('id', 'desc')->first();

                $kardex = new Kardex;
                $kardex->id_producto = $descripcion[$index];
                $kardex->salidas_cantidad = $cantidad_ingreso[$index];
                $kardex->costo_salidas_cantidad = $precio_unitario[$index];
                $kardex->total_salidas_cantidad = $total[$index];
                if($kardex_buscar){
                    $cantidad_saldo = $kardex_buscar->saldos_cantidad - $cantidad_ingreso[$index];
                    $kardex->saldos_cantidad = $cantidad_saldo;
                    $kardex->costo_saldos_cantidad = $producto->costo_unitario;
                    $total_kardex = $cantidad_saldo * $producto->costo_unitario;
                    $kardex->total_saldos_cantidad = $total_kardex;
                }else{
                    $kardex->saldos_cantidad = $cantidad_ingreso[$index];
                    $kardex->costo_saldos_cantidad = $producto->costo_unitario;
                    $total_kardex = $cantidad_ingreso[$index] * $producto->costo_unitario;
                    $kardex->total_saldos_cantidad = $total_kardex;
                }
                $kardex->id_salida_producto = $salida_producto->id;
                $kardex->id_almacen_salida = $request->almacen_salida;

                $kardex->save();
            }

            if($valida_estado==true){
                $salida_producto = SalidaProducto::where('id_orden_compra',$request->id_orden_compra)->first();
                $salida_producto_detalle = SalidaProductoDetalle::where('id_salida_productos',$salida_producto->id)->get();
                $orden_compra = OrdenCompra::find($salida_producto->id_orden_compra);
                $orden_compra_detalle = OrdenCompraDetalle::where('id_orden_compra',$orden_compra->id)->get();
                $salida_producto_detalle_model = new SalidaProductoDetalle;

                foreach($salida_producto_detalle as $index => $detalle){

                    $detalle_orden = $orden_compra_detalle[$index];
                    
                    $cantidad_requerida = $detalle_orden->cantidad_requerida;
                    
                    $cantidad_ingresada = $salida_producto_detalle_model->getCantidadSalidaProductoByOrdenProducto($orden_compra->id,$detalle->id_producto);

                    if($cantidad_requerida - $cantidad_ingresada==0){
                        $salidaProductoDetalleObj = SalidaProductoDetalle::find($detalle->id);
                        $salidaProductoDetalleObj->cerrado = 2;
                        $salidaProductoDetalleObj->save();

                        $ordenCompraDetalleObj = OrdenCompraDetalle::find($detalle_orden->id);
                        $ordenCompraDetalleObj->cerrado = 2;
                        $ordenCompraDetalleObj->save();
                    }
                }

                $salida_producto_detalle_valida = SalidaProductoDetalle::where('id_salida_productos',$salida_producto->id)->where('cerrado','2')->get();
                if($salida_producto_detalle_valida->count()==$salida_producto_detalle->count()){
                    $salida_producto_all = SalidaProducto::where('id_orden_compra',$request->id_orden_compra)->get();
                    foreach ($salida_producto_all as $salida_producto_) {
                        $salida_producto_->cerrado = 2;
                        $salida_producto_->save();
                    }

                    $OrdenCompraObj = OrdenCompra::find($orden_compra->id);
                    $OrdenCompraObj->cerrado = 2;
                    $OrdenCompraObj->save();
                }
            }

        }
        if($request->tipo_movimiento==1){
            return response()->json(['id' => $entrada_producto->id, 'tipo_movimiento' => $request->tipo_movimiento]);    
        }else{
            return response()->json(['id' => $salida_producto->id, 'tipo_movimiento' => $request->tipo_movimiento]);    
        }
        
    }

    public function eliminar_entrada_producto($id,$estado)
    {
		$entrada_producto = EntradaProducto::find($id);

		$entrada_producto->estado = $estado;
		$entrada_producto->save();

		echo $entrada_producto->id;
    }

    public function modal_detalle_producto($id,$tipo){
        
        $tablaMaestra_model = new TablaMaestra;
        $empresa_model = new Empresa;
        $producto_model = new Producto;
        $almacen_model = new Almacene;
        $marca_model = new Marca;
        $almacen_seccion_model = new AlmacenesSeccione;
        $anaquel_model = new Anaquele;
        $tipo_cambio_model = new TipoCambio;
        $id_user = Auth::user()->id;
       
        if($id>0){
            if($tipo==1){
                $entrada_producto_detalle = EntradaProductoDetalle::find($id);
                $entrada_producto = EntradaProducto::find($id);
                //$proveedor_ = Empresa::find($entrada_producto->id_proveedor);
                //$proveedor = $proveedor_->getEmpresa($entrada_producto->id_proveedor);
                $proveedor = Empresa::all();
            }else if($tipo==2){
                $entrada_producto_detalle = SalidaProductoDetalle::find($id);
                $entrada_producto = SalidaProducto::find($id);
                //$proveedor=[];
                $proveedor = Empresa::all();
            }
			
            $tipo_cambio = null;
            $almacen_ = null;
            $marca = $marca_model->getMarcaAll();
            //$almacen__ = Almacene::getAlmacenById($entrada_producto->id_almacen);
            
            $almacen = $almacen_model->getAlmacenByUser($id_user);
            //$tipo_movimiento_=1;
		}else{
			$entrada_producto_detalle = new EntradaProductoDetalle;
            $entrada_producto = new EntradaProducto;
            $proveedor = Empresa::all();
            //dd($proveedor);exit();
            $tipo_cambio = $tipo_cambio_model->getTipoCambioUltimo();
            $almacen = $almacen_model->getAlmacenByUser($id_user);
            $marca = $marca_model->getMarcaAll();
            $tipo_movimiento_='';
		}
        
        $producto = $producto_model->getProductoAll();
        $unidad = $tablaMaestra_model->getMaestroByTipo(43);

        $tipo_documento = $tablaMaestra_model->getMaestroByTipo(48);
        $moneda = $tablaMaestra_model->getMaestroByTipo(1);
        $unidad_origen = $tablaMaestra_model->getMaestroByTipo(50);
        $cerrado_entrada = $tablaMaestra_model->getMaestroByTipo(52);
        $igv_compra = $tablaMaestra_model->getMaestroByTipo(51);
        $tipo_movimiento = $tablaMaestra_model->getMaestroByTipo(53);
        $estado_bien = $tablaMaestra_model->getMaestroByTipo(4);

        //dd($almacen);exit();
        
		return view('frontend.entrada_productos.modal_entradas_detalleEntrada',compact('id','entrada_producto_detalle','tipo_documento','moneda','unidad_origen','cerrado_entrada','igv_compra','proveedor','producto','unidad','almacen'/*,'almacen_seccion'*/,'tipo_cambio','tipo_movimiento','entrada_producto','marca','estado_bien',/*'tipo_movimiento_',*/'tipo'));

    }

    public function obtener_documento_entrada(){
		
		$tabla_maestra_model = new TablaMaestra;
		$ubigeo_usuario = $tabla_maestra_model->getMaestroByTipo(48);
		
		echo json_encode($ubigeo_usuario);
	}

    public function obtener_documento_salida(){
		
		$tabla_maestra_model = new TablaMaestra;
		$ubigeo_usuario = $tabla_maestra_model->getMaestroByTipo(49);
		
		echo json_encode($ubigeo_usuario);
	}

    public function movimiento_pdf($id, $tipo_movimiento){

        if($tipo_movimiento==1){

            $entrada_producto_model = new EntradaProducto;
            $entrada_producto_detalle_model = new EntradaProductoDetalle;

            $datos=$entrada_producto_model->getEntradaById($id);
            $datos_detalle=$entrada_producto_detalle_model->getDetalleProductoPdf($id);

            $codigo=$datos[0]->codigo;
            $tipo_documento=$datos[0]->tipo_documento;
            $unidad_origen=$datos[0]->unidad_origen;
            $empresa_vende=$datos[0]->empresa_vende;
            $empresa_compra=$datos[0]->empresa_compra;
            $numero_comprobante = $datos[0]->numero_comprobante;
            $fecha_comprobante = $datos[0]->fecha_comprobante;
            $fecha_movimiento=$datos[0]->fecha_movimiento;
            $moneda=$datos[0]->moneda;
            $observacion=$datos[0]->observacion;
            $igv_compra=$datos[0]->igv_compra;
            $almacen=$datos[0]->almacen;
            //$tipo_empresa = 'Vende';

            $entrada_producto_detalle_model = new EntradaProductoDetalle;

            $kardex_model = new Kardex;

            $entrada_producto = $entrada_producto_detalle_model->getDetalleProductoId($id);

            $producto_stock = [];

            foreach($entrada_producto as $detalle){
                $stock = $kardex_model->getExistenciaProductoById($detalle->id_producto);
                if(count($stock)>0){
                    $producto_stock[$detalle->id_producto] = $stock[0];
                }else {
                    $producto_stock[$detalle->id_producto] = ['saldos_cantidad'=>0];
                }
                
                //var_dump($producto_stock);
            }

        }else if($tipo_movimiento==2){

            $salida_producto_model = new SalidaProducto;
            $salida_producto_detalle_model = new SalidaProductoDetalle;

            $datos=$salida_producto_model->getSalidaById($id);
            $datos_detalle=$salida_producto_detalle_model->getDetalleProductoPdf($id);

            //dd($datos_detalle);exit();

            $codigo=$datos[0]->codigo;
            $tipo_documento=$datos[0]->tipo_documento;
            $unidad_origen=$datos[0]->unidad_origen;
            $empresa_vende=$datos[0]->empresa_vende;
            $empresa_compra=$datos[0]->empresa_compra;
            $numero_comprobante = $datos[0]->numero_comprobante;
            $fecha_comprobante = $datos[0]->fecha_comprobante;
            $fecha_movimiento=$datos[0]->fecha_movimiento;
            $moneda=$datos[0]->moneda;
            $observacion=$datos[0]->observacion;
            $igv_compra=$datos[0]->igv_compra;
            $almacen=$datos[0]->almacen;
            //$tipo_empresa = 'Compra';

            //$salida_producto_detalle_model = new SalidaProductoDetalle;

            $kardex_model = new Kardex;

            $entrada_producto = $salida_producto_detalle_model->getDetalleProductoId($id);

            $producto_stock = [];

            foreach($entrada_producto as $detalle){
                $stock = $kardex_model->getExistenciaProductoById($detalle->id_producto);
                if(count($stock)>0){
                    $producto_stock[$detalle->id_producto] = $stock[0];
                }else {
                    $producto_stock[$detalle->id_producto] = ['saldos_cantidad'=>0];
                } 
                
                //var_dump($producto_stock);
            }

        }

        
		$year = Carbon::now()->year;

		Carbon::setLocale('es');

		// Crear una instancia de Carbon a partir de la fecha

		 $carbonDate =Carbon::now()->format('d-m-Y');

		 $currentHour = Carbon::now()->format('H:i:s');

		$pdf = Pdf::loadView('frontend.entrada_productos.movimiento_pdf',compact('tipo_documento','unidad_origen','numero_comprobante','fecha_comprobante','fecha_movimiento','datos_detalle','observacion','moneda','igv_compra','almacen','producto_stock','entrada_producto','codigo','empresa_vende','empresa_compra'));
		
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

    public function cargar_detalle($id, $tipo_movimiento)
    {
        if($tipo_movimiento==1){

            $entrada_producto_detalle_model = new EntradaProductoDetalle;
            $marca_model = new Marca;
            $producto_model = new Producto;
            $tablaMaestra_model = new TablaMaestra;
            $kardex_model = new Kardex;

            $entrada_producto = $entrada_producto_detalle_model->getDetalleProductoId($id);
            $marca = $marca_model->getMarcaAll();
            $producto = $producto_model->getProductoAll();
            $estado_bien = $tablaMaestra_model->getMaestroByTipo(56);
            $unidad_medida = $tablaMaestra_model->getMaestroByTipo(43);

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
                'entrada_producto' => $entrada_producto,
                'marca' => $marca,
                'producto' => $producto,
                'estado_bien' => $estado_bien,
                'unidad_medida' => $unidad_medida,
                'producto_stock' =>$producto_stock
            ]);

        }else if ($tipo_movimiento==2){

            $salida_producto_detalle_model = new SalidaProductoDetalle;
            $marca_model = new Marca;
            $producto_model = new Producto;
            $tablaMaestra_model = new TablaMaestra;
            $kardex_model = new Kardex;

            $entrada_producto = $salida_producto_detalle_model->getDetalleProductoId($id);
            $marca = $marca_model->getMarcaAll();
            $producto = $producto_model->getProductoAll();
            $estado_bien = $tablaMaestra_model->getMaestroByTipo(56);
            $unidad_medida = $tablaMaestra_model->getMaestroByTipo(43);

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
                'entrada_producto' => $entrada_producto,
                'marca' => $marca,
                'producto' => $producto,
                'estado_bien' => $estado_bien,
                'unidad_medida' => $unidad_medida,
                'producto_stock' =>$producto_stock
            ]);


        }

        //$id
       // $detalle = ssdsd->fgfffg($id);
        //return view('frontend.entrada_producto_detalles.show', compact('id','detalle'));
    }

    public function modal_detalle_producto_orden_compra($id,$tipo){
        
        $tablaMaestra_model = new TablaMaestra;
        $empresa_model = new Empresa;
        $producto_model = new Producto;
        $almacen_model = new Almacene;
        $marca_model = new Marca;
        $almacen_seccion_model = new AlmacenesSeccione;
        $anaquel_model = new Anaquele;
        $tipo_cambio_model = new TipoCambio;
        $id_user = Auth::user()->id;
       
        if($id>0){
            if($tipo==1){
                $orden_compra = OrdenCompra::find($id);
                $entrada_producto_detalle = new EntradaProductoDetalle;
                $entrada_producto = new EntradaProducto;
                $proveedor = Empresa::all();
                $id_orden_compra = $id;
                $id = '0';
            }else if($tipo==2){
                $orden_compra = OrdenCompra::find($id);
                $entrada_producto_detalle = new SalidaProductoDetalle;
                $entrada_producto = new SalidaProducto;
                $proveedor = Empresa::all();
                $id_orden_compra = $id;
                $id = '0';
            }
			
            $tipo_cambio = $tipo_cambio_model->getTipoCambioUltimo();
            $almacen_ = null;
            $marca = $marca_model->getMarcaAll();
            //$almacen__ = Almacene::getAlmacenById($entrada_producto->id_almacen);
            
            $almacen = $almacen_model->getAlmacenByUser($id_user);
            //$tipo_movimiento_=1;
		}else{
			$entrada_producto_detalle = new EntradaProductoDetalle;
            $entrada_producto = new EntradaProducto;
            $proveedor = Empresa::all();
            //dd($proveedor);exit();
            $tipo_cambio = $tipo_cambio_model->getTipoCambioUltimo();
            $almacen = $almacen_model->getAlmacenByUser($id_user);
            $marca = $marca_model->getMarcaAll();
            $tipo_movimiento_='';
		}
        
        $producto = $producto_model->getProductoAll();
        $unidad = $tablaMaestra_model->getMaestroByTipo(43);

        $tipo_documento = $tablaMaestra_model->getMaestroByTipo(48);
        $moneda = $tablaMaestra_model->getMaestroByTipo(1);
        $unidad_origen = $tablaMaestra_model->getMaestroByTipo(50);
        $cerrado_entrada = $tablaMaestra_model->getMaestroByTipo(52);
        $igv_compra = $tablaMaestra_model->getMaestroByTipo(51);
        $tipo_movimiento = $tablaMaestra_model->getMaestroByTipo(53);
        $estado_bien = $tablaMaestra_model->getMaestroByTipo(4);
        
		return view('frontend.entrada_productos.modal_entradas_detalleEntradaOrden',compact('id','orden_compra','entrada_producto_detalle','tipo_documento','moneda','unidad_origen','cerrado_entrada','igv_compra','proveedor','producto','unidad','almacen'/*,'almacen_seccion'*/,'tipo_cambio','tipo_movimiento','entrada_producto','marca','estado_bien',/*'tipo_movimiento_',*/'tipo','id_orden_compra'));

    }

    public function modal_historial_entrada_producto($id, $id_tipo_documento){

        if($id_tipo_documento==1){

            $entrada_producto_model = new EntradaProducto;
            $entrada_producto = $entrada_producto_model->getEntradaByIdOrdenCompra($id);

        }else if($id_tipo_documento==2){

            $salida_producto_model = new SalidaProducto;
            $entrada_producto = $salida_producto_model->getSalidaByIdOrdenCompra($id);
        }

        return view('frontend.entrada_productos.modal_historial_entradaProducto',compact('id','entrada_producto'));

    }

    public function obtener_codigo_entrada_producto($tipo_movimiento, $tipo_documento){
		
        if($tipo_movimiento==1){

            $entrada_producto_model = new EntradaProducto;
            $codigo = $entrada_producto_model->getCodigoEntradaProducto($tipo_documento);

        }else if($tipo_movimiento==2){

            $salida_producto_model = new SalidaProducto;
		    $codigo = $salida_producto_model->getCodigoSalidaProducto($tipo_documento);

        }
		
		return response()->json($codigo);
	}

    public function send_entrada_producto_directo(Request $request){

        $id_user = Auth::user()->id;

        if($request->tipo_movimiento==1){

            $entrada_producto = new EntradaProducto;

            $item = $request->input('item');
            $descripcion = $request->input('descripcion');
            $cod_interno = $request->input('cod_interno');
            $marca = $request->input('marca');
            $fecha_fabricacion = $request->input('fecha_fabricacion');
            $fecha_vencimiento = $request->input('fecha_vencimiento');
            $estado_bien = $request->input('estado_bien');
            $unidad = $request->input('unidad');
            $cantidad_ingreso = $request->input('cantidad_ingreso');
            $cantidad_compra = $request->input('cantidad_compra');
            $cantidad_pendiente = $request->input('cantidad_pendiente');
            $stock_actual = $request->input('stock_actual');
            $precio_unitario = $request->input('precio_unitario');
            $sub_total = $request->input('sub_total');
            $igv = $request->input('igv');
            $total = $request->input('total');
            
            $entrada_producto->fecha_ingreso = $request->fecha_entrada;
            $entrada_producto->id_tipo_documento = $request->tipo_documento;
            $entrada_producto->unidad_origen = $request->unidad_origen;
            $entrada_producto->id_proveedor = $request->proveedor;
            $entrada_producto->fecha_comprobante = "18/08/2024";
            $entrada_producto->id_moneda = $request->moneda;
            $entrada_producto->tipo_cambio_dolar = $request->tipo_cambio_dolar;
            $entrada_producto->sub_total_compra = 100;
            $entrada_producto->igv_compra = $request->igv_compra;
            $entrada_producto->total_compra = 100;
            $entrada_producto->cerrado = $request->cerrado;
            $entrada_producto->observacion = $request->observacion;
            $entrada_producto->id_almacen_destino = $request->almacen;
            $entrada_producto->id_empresa_compra = $request->empresa_compra;
            $entrada_producto->codigo = $request->codigo;
            $entrada_producto->estado = 1;
            //$entrada_producto->id_orden_compra = $request->id_orden_compra;
            $entrada_producto->save();

            foreach($item as $index => $value) {
                
                $entradaProducto_detalle = new EntradaProductoDetalle();
                $entradaProducto_detalle->id_entrada_productos = $entrada_producto->id;
                $entradaProducto_detalle->numero_serie = $item[$index];
                $entradaProducto_detalle->cantidad = $cantidad_ingreso[$index];

                $entradaProducto_detalle->fecha_vencimiento = $fecha_vencimiento[$index];
                $entradaProducto_detalle->aplica_precio = "";
                $entradaProducto_detalle->id_um = $unidad[$index];
                $entradaProducto_detalle->id_marca = $marca[$index];
                $entradaProducto_detalle->estado = 1;
                $entradaProducto_detalle->id_producto = $descripcion[$index];
                $entradaProducto_detalle->costo = $precio_unitario[$index];
                $entradaProducto_detalle->fecha_fabricacion = $fecha_fabricacion[$index];
                $entradaProducto_detalle->id_estado_bien = $estado_bien[$index];

                $entradaProducto_detalle->sub_total = $sub_total[$index];
                $entradaProducto_detalle->igv = $igv[$index];
                $entradaProducto_detalle->cerrado = 1;
                $entradaProducto_detalle->total = $total[$index];

                if($cantidad_pendiente[$index]!=0){
                    $valida_estado = false;
                }

                $entradaProducto_detalle->save();

                $producto = Producto::find($descripcion[$index]);
                $kardex_buscar = Kardex::where("id_producto",$descripcion[$index])->orderBy('id', 'desc')->first();
                $kardex = new Kardex;
                $kardex->id_producto = $descripcion[$index];
                $kardex->entradas_cantidad = $cantidad_ingreso[$index];
                $kardex->costo_entradas_cantidad = $precio_unitario[$index];
                $kardex->total_entradas_cantidad = $total[$index];
                if($kardex_buscar){
                    $cantidad_saldo = $kardex_buscar->saldos_cantidad + $cantidad_ingreso[$index];
                    $kardex->saldos_cantidad = $cantidad_saldo;
                    $kardex->costo_saldos_cantidad = $producto->costo_unitario;
                    $total_kardex = $cantidad_saldo * $producto->costo_unitario;
                    $kardex->total_saldos_cantidad = $total_kardex;
                }else{
                    $kardex->saldos_cantidad = $cantidad_ingreso[$index];
                    $kardex->costo_saldos_cantidad = $producto->costo_unitario;
                    $total_kardex = $cantidad_ingreso[$index] * $producto->costo_unitario;
                    $kardex->total_saldos_cantidad = $total_kardex;
                }

                $kardex->id_entrada_producto = $entrada_producto->id;
                $kardex->id_almacen_destino = $request->almacen;

                $kardex->save();
            }

            $orden_compra_model = new OrdenCompra;
            $codigo_orden_compra = $orden_compra_model->getCodigoOrdenCompra($request->tipo_movimiento);
            
            $orden_compra = new OrdenCompra;

            $orden_compra->id_empresa_compra = $request->empresa_compra;
            $orden_compra->id_empresa_vende = $request->proveedor;
            $orden_compra->fecha_orden_compra = $request->fecha_entrada;
            $orden_compra->numero_orden_compra = $codigo_orden_compra[0]->codigo;
            $orden_compra->id_tipo_documento = $request->tipo_documento;
            $orden_compra->igv_compra = $request->igv_compra;
            $orden_compra->id_unidad_origen = $request->unidad_origen;
            $orden_compra->id_almacen_destino = $request->almacen;
            $orden_compra->id_almacen_salida = $request->almacen_salida;
            $orden_compra->cerrado = 2;
            $orden_compra->id_usuario_inserta = $id_user;
            $orden_compra->estado = 1;
            $orden_compra->save();

            foreach($item as $index => $value) {
        
                //if($id_orden_compra_detalle[$index] == 0){
                    $orden_compra_detalle = new OrdenCompraDetalle;
                //}else{
                    //$orden_compra_detalle = OrdenCompraDetalle::find($id_orden_compra_detalle[$index]);
                //}
                
                $orden_compra_detalle->id_orden_compra = $orden_compra->id;
                $orden_compra_detalle->id_producto = $descripcion[$index];
                $orden_compra_detalle->cantidad_requerida = $cantidad_ingreso[$index];
                $orden_compra_detalle->precio = $precio_unitario[$index];
                //$orden_compra_detalle->id_descuento = $descuento[$index];
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

            $entrada_producto_ = EntradaProducto::find($entrada_producto->id);

            $entrada_producto_->id_orden_compra = $orden_compra->id;
            $entrada_producto_->save();

        }else if($request->tipo_movimiento==2){

            if($request->id == 0){
                $salida_producto = new SalidaProducto;
            }else{
                $salida_producto = SalidaProducto::find($request->id);
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
            $cantidad_compra = $request->input('cantidad_compra');
            $cantidad_pendiente = $request->input('cantidad_pendiente');
            $stock_actual = $request->input('stock_actual');
            $precio_unitario = $request->input('precio_unitario');
            $sub_total = $request->input('sub_total');
            $igv = $request->input('igv');
            $total = $request->input('total');
            
            $salida_producto->fecha_salida = $request->fecha_entrada;
            $salida_producto->id_tipo_documento = $request->tipo_documento;
            $salida_producto->unidad_destino = $request->unidad_origen;
            $salida_producto->numero_comprobante = $request->numero_comprobante;
            $salida_producto->fecha_comprobante = "18/08/2024";
            $salida_producto->id_moneda = $request->moneda;
            $salida_producto->tipo_cambio_dolar = $request->tipo_cambio_dolar;
            $salida_producto->sub_total_compra = 100;
            $salida_producto->igv_compra = $request->igv_compra;
            $salida_producto->total_compra = 100;
            $salida_producto->cerrado = $request->cerrado;
            $salida_producto->observacion = $request->observacion;
            $salida_producto->id_almacen_salida = $request->almacen_salida;
            $salida_producto->estado = 1;
            $salida_producto->id_orden_compra = $request->id_orden_compra;
            $salida_producto->id_proveedor = $request->proveedor;
            $salida_producto->id_empresa_compra = $request->empresa_compra;
            $salida_producto->codigo = $request->codigo;
            $salida_producto->save();

            //$valida_estado = true;

            foreach($item as $index => $value) {
                
                $salida_producto_detalle = new SalidaProductoDetalle();
                $salida_producto_detalle->id_salida_productos = $salida_producto->id;
                $salida_producto_detalle->numero_serie = $item[$index];
                $salida_producto_detalle->cantidad = $cantidad_ingreso[$index];

                $salida_producto_detalle->fecha_vencimiento = $fecha_vencimiento[$index];
                $salida_producto_detalle->aplica_precio = "";
                $salida_producto_detalle->id_um = $unidad[$index];
                $salida_producto_detalle->id_marca = $marca[$index];
                $salida_producto_detalle->estado = 1;
                $salida_producto_detalle->cerrado = 1;
                $salida_producto_detalle->id_producto = $descripcion[$index];
                $salida_producto_detalle->costo = $precio_unitario[$index];
                $salida_producto_detalle->id_estado_productos = $estado_bien[$index];

                $salida_producto_detalle->sub_total = floatval($sub_total[$index]);
                $salida_producto_detalle->igv = floatval($igv[$index]);
                $salida_producto_detalle->total = floatval($total[$index]);

                if($cantidad_pendiente[$index]!=0){
                    $valida_estado = false;
                }

                $salida_producto_detalle->save();

                $producto = Producto::find($descripcion[$index]);
                $kardex_buscar = Kardex::where("id_producto",$descripcion[$index])->orderBy('id', 'desc')->first();

                $kardex = new Kardex;
                $kardex->id_producto = $descripcion[$index];
                $kardex->salidas_cantidad = $cantidad_ingreso[$index];
                $kardex->costo_salidas_cantidad = $precio_unitario[$index];
                $kardex->total_salidas_cantidad = $total[$index];
                if($kardex_buscar){
                    $cantidad_saldo = $kardex_buscar->saldos_cantidad - $cantidad_ingreso[$index];
                    $kardex->saldos_cantidad = $cantidad_saldo;
                    $kardex->costo_saldos_cantidad = $producto->costo_unitario;
                    $total_kardex = $cantidad_saldo * $producto->costo_unitario;
                    $kardex->total_saldos_cantidad = $total_kardex;
                }else{
                    $kardex->saldos_cantidad = $cantidad_ingreso[$index];
                    $kardex->costo_saldos_cantidad = $producto->costo_unitario;
                    $total_kardex = $cantidad_ingreso[$index] * $producto->costo_unitario;
                    $kardex->total_saldos_cantidad = $total_kardex;
                }
                $kardex->id_salida_producto = $salida_producto->id;
                $kardex->id_almacen_salida = $request->almacen_salida;

                $kardex->save();
            }

            /*if($valida_estado==true){
                $salida_producto = SalidaProducto::where('id_orden_compra',$request->id_orden_compra)->first();
                $salida_producto_detalle = SalidaProductoDetalle::where('id_salida_productos',$salida_producto->id)->get();
                $orden_compra = OrdenCompra::find($salida_producto->id_orden_compra);
                $orden_compra_detalle = OrdenCompraDetalle::where('id_orden_compra',$orden_compra->id)->get();
                $salida_producto_detalle_model = new SalidaProductoDetalle;

                foreach($salida_producto_detalle as $index => $detalle){

                    $detalle_orden = $orden_compra_detalle[$index];
                    
                    $cantidad_requerida = $detalle_orden->cantidad_requerida;
                    
                    $cantidad_ingresada = $salida_producto_detalle_model->getCantidadSalidaProductoByOrdenProducto($orden_compra->id,$detalle->id_producto);

                    if($cantidad_requerida - $cantidad_ingresada==0){
                        $salidaProductoDetalleObj = SalidaProductoDetalle::find($detalle->id);
                        $salidaProductoDetalleObj->cerrado = 2;
                        $salidaProductoDetalleObj->save();

                        $ordenCompraDetalleObj = OrdenCompraDetalle::find($detalle_orden->id);
                        $ordenCompraDetalleObj->cerrado = 2;
                        $ordenCompraDetalleObj->save();
                    }   
                }

                $salida_producto_detalle_valida = SalidaProductoDetalle::where('id_salida_productos',$entrada_producto->id)->where('cerrado','2')->get();
                if($salida_producto_detalle_valida->count()==$salida_producto_detalle->count()){
                    $salida_producto->cerrado = 2;
                    $salida_producto->save();

                    $OrdenCompraObj = OrdenCompra::find($orden_compra->id);
                    $OrdenCompraObj->cerrado = 2;
                    $OrdenCompraObj->save();
                }
            }*/

        }
        if($request->tipo_movimiento==1){
            return response()->json(['id' => $entrada_producto->id, 'tipo_movimiento' => $request->tipo_movimiento]);    
        }else{
            return response()->json(['id' => $salida_producto->id, 'tipo_movimiento' => $request->tipo_movimiento]);    
        }
    }

    public function modal_detalle_producto_historial($id,$tipo){
        
        $tablaMaestra_model = new TablaMaestra;
        $empresa_model = new Empresa;
        $producto_model = new Producto;
        $almacen_model = new Almacene;
        $marca_model = new Marca;
        $almacen_seccion_model = new AlmacenesSeccione;
        $anaquel_model = new Anaquele;
        $tipo_cambio_model = new TipoCambio;
        $id_user = Auth::user()->id;
       
        if($id>0){
            if($tipo==1){
                $entrada_producto_detalle = EntradaProductoDetalle::find($id);
                $entrada_producto = EntradaProducto::find($id);
                //$proveedor_ = Empresa::find($entrada_producto->id_proveedor);
                //$proveedor = $proveedor_->getEmpresa($entrada_producto->id_proveedor);
                $proveedor = Empresa::all();
            }else if($tipo==2){
                $entrada_producto_detalle = SalidaProductoDetalle::find($id);
                $entrada_producto = SalidaProducto::find($id);
                //$proveedor=[];
                $proveedor = Empresa::all();
            }
			
            $tipo_cambio = null;
            $almacen_ = null;
            $marca = $marca_model->getMarcaAll();
            //$almacen__ = Almacene::getAlmacenById($entrada_producto->id_almacen);
            
            $almacen = $almacen_model->getAlmacenByUser($id_user);
            //$tipo_movimiento_=1;
		}else{
			$entrada_producto_detalle = new EntradaProductoDetalle;
            $entrada_producto = new EntradaProducto;
            $proveedor = Empresa::all();
            //dd($proveedor);exit();
            $tipo_cambio = $tipo_cambio_model->getTipoCambioUltimo();
            $almacen = $almacen_model->getAlmacenByUser($id_user);
            $marca = $marca_model->getMarcaAll();
            $tipo_movimiento_='';
		}
        
        $producto = $producto_model->getProductoAll();
        $unidad = $tablaMaestra_model->getMaestroByTipo(43);

        $tipo_documento = $tablaMaestra_model->getMaestroByTipo(48);
        $moneda = $tablaMaestra_model->getMaestroByTipo(1);
        $unidad_origen = $tablaMaestra_model->getMaestroByTipo(50);
        $cerrado_entrada = $tablaMaestra_model->getMaestroByTipo(52);
        $igv_compra = $tablaMaestra_model->getMaestroByTipo(51);
        $tipo_movimiento = $tablaMaestra_model->getMaestroByTipo(53);
        $estado_bien = $tablaMaestra_model->getMaestroByTipo(4);

        //dd($almacen);exit();
        
		return view('frontend.entrada_productos.modal_entradas_detalleEntradaHistorial',compact('id','entrada_producto_detalle','tipo_documento','moneda','unidad_origen','cerrado_entrada','igv_compra','proveedor','producto','unidad','almacen'/*,'almacen_seccion'*/,'tipo_cambio','tipo_movimiento','entrada_producto','marca','estado_bien',/*'tipo_movimiento_',*/'tipo'));

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {
        $entrada_productos = EntradaProducto::latest()->paginate(10);

        return view('frontend.entrada_productos.index', compact('entrada_productos'));
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        return view('frontend.entrada_productos.create');
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request)
    {
        $entrada_productos = EntradaProducto::create($request->all());

        return redirect()->route('frontend.entrada_productos.edit', compact('entrada_productos'));
    }*/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show(EntradaProducto $entrada_productos)
    {
        // dd($entrada_productos);exit;

        return view('frontend.entrada_productos.show', compact('entrada_productos'));
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function edit(EntradaProducto $entrada_productos)
    {
        return view('frontend.entrada_productos.edit', compact('entrada_productos'));
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function update(EntradaProductoRequest $request, EntradaProducto $entrada_productos)
    {
        $entrada_productos->update($request->all());

        return redirect()->route('frontend.entrada_productos.edit', compact('entrada_productos'));
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(EntradaProducto $entrada_productos)
    {
        if ($entrada_productos->delete()) {
            Alert::success('Proceso completo', 'Se ha eliminado la entrada '.$entrada_productos['id']);
        };
        return redirect()->route('frontend.entrada_productos.index');
    }*/
}
