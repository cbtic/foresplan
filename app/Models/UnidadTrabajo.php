<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class UnidadTrabajo extends Model
{
    function getUnidad($area){
        $cad = "select tu.id id, u.denominacion denominacion
        from unidad_trabajos u
        inner join tabla_ubicaciones tu on tu.id_registro = u.id 
        where id_area_trabajo = (select tu1.id_registro from tabla_ubicaciones tu1 where tu1.id = ".$area.") and tu.tabla = 'unidad_trabajos'
        and u.estado = '1' ";

        $data = DB::select($cad);
        return $data;
    }
}
