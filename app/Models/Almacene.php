<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Almacene extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'denominacion',
        'id_ubigeo',
        'direccion',
        'telefono',
        'encargado',
        'estado'
    ];

    public function ubigeos()
    {
        return $this->belongsTo(Ubigeo::class,"id_ubigeo","id_ubigeo");
    }

    public function secciones()
    {
        return $this->belongsToMany(Seccione::class, "almacenes_secciones", "id_almacenes", "id_secciones");
    }

    public function listar_almacenes_ajax($p){

        return $this->readFuntionPostgres('sp_listar_almacenes_paginado',$p);

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

        $cad = "select lpad((max(a.codigo::int)+1)::varchar, 4,'0') codigo from almacenes a ";

		$data = DB::select($cad);
        return $data;
    }

    function getUsuarioAlmacen($id){

        $cad = "select u.id, u.name, u.email from almacenes a
        inner join almacen_usuarios au on au.id_almacen = a.id
        left join users u on au.id_user = u.id
        where a.id = '".$id."'";

		$data = DB::select($cad);
        return $data;
    }

    function getProvinciaDistritoById($id){

        $cad = "select u.id_provincia provincia, u.id_ubigeo distrito from almacenes a2 
        inner join ubigeos u on a2.id_ubigeo = u.id_ubigeo 
        where a2.id='".$id."'";

		$data = DB::select($cad);
        return $data;
    }

    function getAlmacenByUser($id){

        $cad = "select a.* from almacenes a 
        inner join almacen_usuarios au on au.id_almacen = a.id 
        inner join users u on au.id_user = u.id 
        where u.id = '".$id."'
        and au.estado='1'";

		$data = DB::select($cad);
        return $data;
    }

    function getAlmacenAll(){

        $cad = "select * from almacenes a";

		$data = DB::select($cad);
        return $data;
    }

    function getAlmacenById($id){

        $cad = "select * from almacenes a
        where a.id='".$id."'
        and a.estado='1'";

		$data = DB::select($cad);
        return $data;
    }
}
