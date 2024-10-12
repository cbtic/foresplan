<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class IngresoVehiculoTroncoImagene extends Model
{
    use HasFactory;
	
	function getIngresoVehiculoTroncoImagenById($id){

        $cad = "select * from ingreso_vehiculo_tronco_imagenes ivti 
where id_ingreso_vehiculo_troncos=".$id;

		$data = DB::select($cad);
        return $data;
    }
	
}
