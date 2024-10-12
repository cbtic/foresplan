<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class SalidaProductoDetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_salida_productos',
        'id_producto',
        'item',
        'cantidad',
        'numero_lote',
        'fecha_vencimiento',
        'aplica_precio',
        'id_um',
        'id_estado_productos',
        'id_marca',
        'estado'
    ];

    function getDetalleProductoId($id){

        $cad = "select spd.id,  ROW_NUMBER() OVER (PARTITION BY spd.id_salida_productos ) AS row_num, spd.numero_serie, spd.id_producto, p.codigo, spd.id_marca, p.id_unidad_medida, spd.fecha_vencimiento, spd.id_um, spd.id_estado_productos id_estado_bien, spd.cantidad, spd.cantidad, spd.cantidad, '12' stock_actual, spd.costo, spd.sub_total , spd.igv, spd.total 
        from salida_producto_detalles spd 
        inner join productos p on spd.id_producto = p.id
        where id_salida_productos ='".$id."'
        and spd.estado='1'";

		$data = DB::select($cad);
        return $data;
    }

    function getDetalleProductoPdf($id){

        $cad = "select spd.id,  ROW_NUMBER() OVER (PARTITION BY spd.id_salida_productos ) AS row_num, spd.numero_serie , p.denominacion producto, p.codigo, m.denominiacion marca, tm2.denominacion unidad_medida, '' fecha_fabricacion, spd.fecha_vencimiento, tm.denominacion estado_bien, spd.cantidad, spd.cantidad, spd.cantidad, '12' stock_actual, spd.costo, spd.sub_total, spd.igv, spd.total, spd.id_producto  
        from salida_producto_detalles spd 
        inner join productos p on spd.id_producto = p.id
        inner join marcas m on spd.id_marca = m.id
        inner join tabla_maestras tm on spd.id_estado_productos ::int = tm.codigo::int and tm.tipo = '4'
        inner join tabla_maestras tm2 on spd.id_um ::int = tm2.codigo::int and tm2.tipo = '43'
        where id_salida_productos ='".$id."'
        and spd.estado='1'";

		$data = DB::select($cad);
        return $data;
    }

    function getCantidadSalidaProductoByOrdenProducto($id_orden_compra,$id_producto){

        $cad = "select sum(cantidad) cantidad_ingresada
        from salida_productos sp 
        inner join salida_producto_detalles spd on sp.id=spd.id_salida_productos 
        where id_orden_compra ='".$id_orden_compra."'
        and spd.id_producto='".$id_producto."'";

		$data = DB::select($cad);
        //return $data;
        if(isset($data[0]))return $data[0]->cantidad_ingresada;
    }
}
