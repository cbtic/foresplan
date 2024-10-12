<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Lote extends Model
{
    use HasFactory;

    protected $table = 'lote_productos';

    protected $fillable = [
        'id_producto',
        'id_marca',
        'numero_lote',
        'numero_serie',
        'id_unidad_medida',
        'cantidad',
        'costo',
        'id_moneda',
        'fecha_fabricacion',
        'fecha_vencimiento',
        'id_almacen',
        'id_seccion',
        'id_anaquel',
        'estado'
    ];

    public function listar_lote_ajax($p){

        return $this->readFuntionPostgres('sp_listar_lotes_paginado',$p);

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
}
