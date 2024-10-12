<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Seccione extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'denominacion',
        'estado'
    ];

    public function almacenes()
    {
        return $this->belongsToMany(Almacene::class, "almacenes_secciones", "id_secciones", "id_almacenes");
    }

    public function anaqueles()
    {
        return $this->belongsToMany(Anaquele::class, "anaqueles_secciones", "id_secciones", "id_anaqueles");
    }

    public function listar_seccion_ajax($p){

        return $this->readFuntionPostgres('sp_listar_seccion_paginado',$p);

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

    function getCodigo(){

        $cad = "select lpad((max(s.codigo::int)+1)::varchar, 4,'0') codigo from secciones s";

		$data = DB::select($cad);
        return $data;
    }

}
