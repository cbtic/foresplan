<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class OrdenCompra extends Model
{
    use HasFactory;

    public function listar_orden_compra_ajax($p){

        return $this->readFuntionPostgres('sp_listar_orden_compra_paginado',$p);

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

    function getDetalleOrdenCompraId($id){

        $cad = "select ocd.id,  ROW_NUMBER() OVER (PARTITION BY ocd.id_orden_compra ) AS row_num, p.numero_serie item, ocd.id_producto, p.codigo, ocd.id_marca, ocd.id_unidad_medida, ocd.fecha_fabricacion, ocd.fecha_vencimiento, 
        ocd.id_estado_producto , ocd.cantidad_requerida, 
        coalesce((select sum(cantidad)
from entrada_productos ep 
inner join entrada_producto_detalles epd on ep.id=epd.id_entrada_productos 
where id_orden_compra =ocd.id_orden_compra 
and epd.id_producto=ocd.id_producto),0)cantidad_ingresada,
        ocd.precio, ocd.sub_total, ocd.igv, ocd.total, ocd.id_descuento 
        from orden_compra_detalles ocd 
        inner join productos p on ocd.id_producto = p.id
        where id_orden_compra ='".$id."'
        and ocd.estado='1'";

		$data = DB::select($cad);
        return $data;
    }

    function getOrdenCompraById($id){

        $cad = "select oc.id, e.razon_social empresa_compra, e2.razon_social empresa_vende, to_char(oc.fecha_orden_compra,'dd-mm-yyyy') fecha_orden_compra , oc.numero_orden_compra, tm.denominacion tipo_documento, oc.estado, tm2.denominacion igv
        from orden_compras oc 
        inner join empresas e on oc.id_empresa_compra = e.id 
        inner join empresas e2 on oc.id_empresa_vende = e2.id 
        inner join tabla_maestras tm on oc.id_tipo_documento = tm.codigo ::int and tm.tipo = '54'
        inner join tabla_maestras tm2 on oc.igv_compra = tm2.codigo ::int and tm2.tipo = '51'
        where oc.id='".$id."'
        and oc.estado='1'";

		$data = DB::select($cad);
        return $data;
    }

    function getCodigoOrdenCompra($tipo_documento){

        $cad = "select lpad(coalesce(max(oc.numero_orden_compra::int) + 1, 1)::varchar, 6, '0') codigo
        from orden_compras oc
        where id_tipo_documento = '".$tipo_documento."'";

		$data = DB::select($cad);
        return $data;
    }

}
