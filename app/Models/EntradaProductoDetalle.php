<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EntradaProductoDetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_entrada_productos',
        'id_producto',
        'item',
        'cantidad',
        'numero_lote',
        'fecha_vencimiento',
        'aplica_precio',
        'id_um',
        'id_estado_bien',
        'id_marca',
        'estado'
    ];

    public function productos()
    {
        return $this->hasOne('Producto');
    }

    function getDetalleProductoId($id){

        $cad = "select epd.id,  ROW_NUMBER() OVER (PARTITION BY epd.id_entrada_productos ) AS row_num, epd.numero_serie, epd.id_producto, p.codigo, epd.id_marca, p.id_unidad_medida, epd.fecha_fabricacion, epd.fecha_vencimiento, epd.id_um, epd.id_estado_bien , epd.cantidad, epd.cantidad, epd.cantidad, '12' stock_actual, epd.costo, epd.sub_total , epd.igv , epd.total 
        from entrada_producto_detalles epd 
        inner join productos p on epd.id_producto = p.id
        where id_entrada_productos ='".$id."'
        and epd.estado='1'";

		$data = DB::select($cad);
        return $data;
    }

    function getDetalleProductoPdf($id){

        $cad = "select epd.id,  ROW_NUMBER() OVER (PARTITION BY epd.id_entrada_productos ) AS row_num, epd.numero_serie , p.denominacion producto, p.codigo, m.denominiacion marca, tm2.denominacion unidad_medida, epd.fecha_fabricacion, epd.fecha_vencimiento, tm.denominacion estado_bien, epd.cantidad, epd.cantidad, epd.cantidad, '12' stock_actual, epd.costo, epd.sub_total , epd.igv, epd.total, epd.id_producto   
        from entrada_producto_detalles epd 
        inner join productos p on epd.id_producto = p.id
        left join marcas m on epd.id_marca = m.id
        inner join tabla_maestras tm on epd.id_estado_bien ::int = tm.codigo::int and tm.tipo = '4'
        inner join tabla_maestras tm2 on epd.id_um ::int = tm2.codigo::int and tm2.tipo = '43'
        where id_entrada_productos ='".$id."'
        and epd.estado='1'";

		$data = DB::select($cad);
        return $data;
    }

    function getCantidadEntradaProductoByOrdenProducto($id_orden_compra,$id_producto){

        $cad = "select sum(cantidad) cantidad_ingresada
        from entrada_productos ep 
        inner join entrada_producto_detalles epd on ep.id=epd.id_entrada_productos 
        where id_orden_compra =".$id_orden_compra."
        and epd.id_producto=".$id_producto;

		$data = DB::select($cad);
        //return $data;
        if(isset($data[0]))return $data[0]->cantidad_ingresada;
    }

}
