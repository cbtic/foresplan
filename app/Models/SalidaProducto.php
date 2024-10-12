<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class SalidaProducto extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_salida',
        'id_tipo_documento',
        'unidad_destino',
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

    function getSalidaById($id){

        $cad = "select sp.id, 'SALIDA' tipo, sp.fecha_salida fecha_movimiento, tm.denominacion tipo_documento, tm2.denominacion unidad_origen, e.razon_social empresa_vende, e2.razon_social empresa_compra, sp.numero_comprobante, sp.fecha_comprobante, sp.estado, sp.created_at, tm3.denominacion moneda, sp.observacion, a.denominacion almacen, tm4.denominacion igv_compra, sp.codigo  
        from salida_productos sp 
        inner join tabla_maestras tm on sp.id_tipo_documento = tm.codigo ::int and tm.tipo = '49'
        inner join tabla_maestras tm2 on sp.unidad_destino ::int = tm2.codigo::int and tm2.tipo = '50'
        inner join tabla_maestras tm3 on sp.id_moneda ::int = tm3.codigo::int and tm3.tipo = '1'
        inner join tabla_maestras tm4 on sp.igv_compra ::int = tm4.codigo::int and tm4.tipo = '51'
        inner join almacenes a on sp.id_almacen_salida = a.id
        inner join empresas e on sp.id_proveedor = e.id
        inner join empresas e2 on sp.id_empresa_compra = e2.id
        where sp.id='".$id."'
        and sp.estado='1'";

		$data = DB::select($cad);
        return $data;
    }

    function getSalidaByIdOrdenCompra($id){

        $cad = "select sp.id, 'SALIDA' tipo, sp.fecha_salida fecha_movimiento, tm.denominacion tipo_documento, tm2.denominacion unidad_origen, '' razon_social, sp.codigo, sp.fecha_comprobante, sp.estado, sp.created_at, tm3.denominacion moneda, sp.observacion, a.denominacion almacen, tm4.denominacion igv_compra 
        from salida_productos sp 
        inner join tabla_maestras tm on sp.id_tipo_documento = tm.codigo ::int and tm.tipo = '49'
        inner join tabla_maestras tm2 on sp.unidad_destino ::int = tm2.codigo::int and tm2.tipo = '50'
        inner join tabla_maestras tm3 on sp.id_moneda ::int = tm3.codigo::int and tm3.tipo = '1'
        inner join tabla_maestras tm4 on sp.igv_compra ::int = tm4.codigo::int and tm4.tipo = '51'
        inner join almacenes a on sp.id_almacen_salida = a.id
        inner join orden_compras oc on sp.id_orden_compra = oc.id
        where oc.id = '".$id."'
        and sp.estado='1'";

		$data = DB::select($cad);
        return $data;
    }

    function getCodigoSalidaProducto($tipo_documento){

        $cad = "select lpad(coalesce(max(sp.codigo::int) + 1, 1)::varchar, 6, '0') codigo 
        from salida_productos sp
        where id_tipo_documento =  '".$tipo_documento."'";

		$data = DB::select($cad);
        return $data;
    }

}
