<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Producto extends Model
{
    use HasFactory;
    protected $fillable = [
        'numero_serie',
        'codigo',
        'denominacion',
        'id_unidad_medida',
        'stock_actual',
        'costo_unitario',
        'id_moneda',
        'id_tipo_producto',
        'fecha_vencimiento',
        'id_estado_bien',
        'stock_minimo',
        'observacion',
        'estado'
    ];

    public function entrada_producto_detalles()
    {
        return $this->belongsTo('EntradaProductoDetalle', 'id_producto');
    }

    public function listar_producto_ajax($p){

        return $this->readFuntionPostgres('sp_listar_productos_paginado',$p);

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

    function getProductoAll(){

        $cad = "select * from productos p";

		$data = DB::select($cad);
        return $data;
    }

    function getProductoById($id_producto){

        $cad = "select * from productos p 
        where p.id='".$id_producto."'";

		$data = DB::select($cad);
        return $data;
    }

    function getCorrelativo(){

        $cad = "select (max(p.numero_corrrelativo::int)+1) numero_correlativo from productos p ";

		$data = DB::select($cad);
        return $data;
    }
}
