<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Ubigeo extends Model
{
    function getDepartamento($pais){
        $cad = "select distinct substr(u.id_reniec, 1, 2) id, u.departamento nombre
        from ubigeos u
        where u.id_pais = '".$pais."'
        order by u.departamento ";

		$data = DB::select($cad);
        return $data;
    }
	
    function getProvincia($departamento){
        $cad = "select distinct substr(u.id_reniec, 1, 4) id, u.provincia nombre
        from ubigeos u
        where substr(u.id_reniec, 1, 2) = '".$departamento."'
        order by u.provincia ";

        $data = DB::select($cad);
        return $data;
    }    

    function getDistrito($provincia){
        $cad = "select distinct substr(u.id_reniec, 1, 6) id, u.distrito nombre
        from ubigeos u
        where substr(u.id_reniec, 1, 4) = '".$provincia."'
        order by u.distrito ";

        
		$data = DB::select($cad);
        return $data;
    }   
}
