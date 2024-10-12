<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class EntradaProducto extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_ingreso',
        'id_tipo_documento',
        'unidad_origen',
        'id_proveedor',
        'numero_comprobante',
        'fecha_comprobante',
        'id_moneda',
        'tipo_cambio_dolar',
        'sub_total_compra',
        'igv_compra',
        'total_compra',
        'cerrado',
        'observacion',
        'estado'
    ];

    public function listar_entrada_productos_ajax($p){

        return $this->readFuntionPostgres('sp_listar_entrada_producto_paginado',$p);

    }

    public function readFuntionPostgres($function, $parameters = null){

        $_parameters = '';
        if (count($parameters) > 0) {
            $_parameters = implode("','", $parameters);
            $_parameters = "'" . $_parameters . "',";
        }
        $data = DB::select("BEGIN;");
        $cad = "select " . $function . "(" . $_parameters . "'ref_cursor');";
        $data = DB::select($cad);
        $cad = "FETCH ALL IN ref_cursor;";
        $data = DB::select($cad);
        return $data;

    }

    function getEntradaById($id){

        $cad = "select ep.id, 'INGRESO' tipo, ep.fecha_ingreso fecha_movimiento, tm.denominacion tipo_documento, tm2.denominacion unidad_origen, e.razon_social empresa_vende, e2.razon_social empresa_compra, ep.numero_comprobante, ep.fecha_comprobante, ep.estado, ep.created_at, tm3.denominacion moneda, ep.observacion, tm4.denominacion igv_compra, a.denominacion almacen, ep.codigo 
        from entrada_productos ep 
        inner join tabla_maestras tm on ep.id_tipo_documento = tm.codigo ::int and tm.tipo = '48'
        inner join tabla_maestras tm2 on ep.unidad_origen::int = tm2.codigo::int and tm2.tipo = '50'
        inner join tabla_maestras tm3 on ep.id_moneda ::int = tm3.codigo::int and tm3.tipo = '1'
        inner join empresas e on ep.id_proveedor = e.id
        inner join empresas e2 on ep.id_empresa_compra = e2.id
        inner join tabla_maestras tm4 on ep.igv_compra ::int = tm4.codigo::int and tm4.tipo = '51'
        inner join almacenes a on ep.id_almacen_destino = a.id
        where ep.id='".$id."'
        and ep.estado='1'";

		$data = DB::select($cad);
        return $data;
    }

    function getEntradaByIdOrdenCompra($id){

        $cad = "select ep.id, 'ENTRADA' tipo, ep.fecha_ingreso fecha_movimiento, tm.denominacion tipo_documento, tm2.denominacion unidad_origen, e.razon_social, ep.codigo, ep.fecha_comprobante, ep.estado, ep.created_at, tm3.denominacion moneda, ep.observacion, tm4.denominacion igv_compra, a.denominacion almacen
        from entrada_productos ep 
        inner join tabla_maestras tm on ep.id_tipo_documento = tm.codigo ::int and tm.tipo = '48'
        inner join tabla_maestras tm2 on ep.unidad_origen::int = tm2.codigo::int and tm2.tipo = '50'
        inner join tabla_maestras tm3 on ep.id_moneda ::int = tm3.codigo::int and tm3.tipo = '1'
        inner join empresas e on ep.id_proveedor = e.id
        inner join tabla_maestras tm4 on ep.igv_compra ::int = tm4.codigo::int and tm4.tipo = '51'
        inner join almacenes a on ep.id_almacen_destino = a.id
        inner join orden_compras oc on ep.id_orden_compra = oc.id
        where oc.id = '".$id."'
        and ep.estado='1'";

		$data = DB::select($cad);
        return $data;
    }

    function getCodigoEntradaProducto($tipo_documento){

        $cad = "select lpad(coalesce(max(ep.codigo::int) + 1, 1)::varchar, 6, '0') codigo 
        from entrada_productos ep
        where id_tipo_documento =  '".$tipo_documento."'";

		$data = DB::select($cad);
        return $data;
    }

}
