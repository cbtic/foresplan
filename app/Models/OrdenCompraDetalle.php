<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class OrdenCompraDetalle extends Model
{
    use HasFactory;

    function getDetalleOrdenCompraPdf($id){

        $cad = "select ocd.id, ocd.id_orden_compra, ROW_NUMBER() OVER (PARTITION BY ocd.id_orden_compra ) AS row_num, p.denominacion producto, p.numero_serie, p.codigo, ocd.cantidad_requerida, ocd.precio, tm.denominacion descuento, ocd.sub_total, ocd.igv, ocd.total, ocd.fecha_fabricacion, ocd.fecha_vencimiento, tm2.denominacion estado_producto, tm3.denominacion unidad_medida, m.denominiacion marca,ocd.estado
        from orden_compra_detalles ocd 
        inner join productos p on ocd.id_producto = p.id 
        left join tabla_maestras tm on ocd.id_descuento = tm.codigo ::int and tm.tipo = '55'
        inner join tabla_maestras tm2 on ocd.id_estado_producto = tm2.codigo ::int and tm2.tipo = '56'
        inner join tabla_maestras tm3 on ocd.id_unidad_medida = tm3.codigo ::int and tm3.tipo = '43'
        left join marcas m on ocd.id_marca = m.id 
        where ocd.id_orden_compra ='".$id."'
        and ocd.estado='1'";

		$data = DB::select($cad);
        return $data;
    }
}
