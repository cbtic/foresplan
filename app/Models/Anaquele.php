<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Anaquele extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'denominacion',
        'estado'
    ];

    public function secciones()
    {
        return $this->belongsToMany(Seccione::class, "anaqueles_secciones", "id_anaqueles", "id_secciones");
    }

    public function listar_anaqueles_ajax($p){

        return $this->readFuntionPostgres('sp_listar_anaqueles_paginado',$p);

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

    function getAnaquel(){

        $cad = "select a.id, a.codigo, a.denominacion, a.estado from anaqueles a ";

		$data = DB::select($cad);
        return $data;
    }

    function getAnaquelBySeccion($id){

        $cad = "select a.id, a.codigo, a.denominacion, ase.estado, ase.id id_anaquel  
        from anaqueles a 
        inner join anaqueles_secciones ase on ase.id_anaqueles = a.id 
        inner join secciones s on ase.id_secciones =s.id 
        where s.id=".$id."
        and ase.estado='1'";

		$data = DB::select($cad);
        return $data;
    }

    function getAnaquelByAlmacen($id_almacen){

        $cad = "select a.id, a.codigo, a.denominacion, a.estado from anaqueles a 
        where a.id_almacen=".$id_almacen;

		$data = DB::select($cad);
        return $data;
    }
}
