<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Kardex extends Model
{
    use HasFactory;

    protected $table = 'kardex';


    protected $fillable = [
        'id_producto',
        'entradas_cantidad',
        'costo_entradas_cantidad',
        'total_entradas_cantidad',
        'salidas_cantidad',
        'costo_salidas_cantidad',
        'total_salidas_cantidad',
        'saldos_cantidad',
        'costo_saldos_cantidad',
        'total_saldos_cantidad'
    ];

    public function listar_kardex_ajax($p){

        return $this->readFuntionPostgres('sp_listar_kardex_paginado',$p);

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

    function getExistenciaProductoById($id){

        $cad = "select * from kardex k where k.id_producto = '".$id."'
        order by 1 desc
        limit 1";

		$data = DB::select($cad);
        return $data;
    }

}
