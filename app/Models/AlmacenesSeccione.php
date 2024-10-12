<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class AlmacenesSeccione extends Model
{
    public $timestamps = false;
    use HasFactory;

    function getSeccionByAlmacen($id){

        $cad = "select as2.id, a.codigo codigo_almacen, a.denominacion almacen, s.codigo codigo_seccion, s.denominacion seccion from almacenes_secciones as2 
        inner join almacenes a on as2.id_almacenes = a.id 
        inner join secciones s on as2.id_secciones = s.id 
        where a.id='".$id."' and a.estado ='1' and s.estado ='1'";

		$data = DB::select($cad);
        return $data;
    }
}
