<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Almacen_usuario extends Model
{
    use HasFactory;

    function getUsuariosByAlmacen($id){

        $cad = "select * from almacen_usuarios au 
        where au.id_almacen ='".$id."'
        and au.estado='1'";

		$data = DB::select($cad);
        return $data;
    }

    function getAlmacenByUser($id){

        $cad = "select * from almacen_usuarios au 
        where au.id_user ='".$id."'
        and au.estado='1'";

		$data = DB::select($cad);
        return $data;
    }

}
