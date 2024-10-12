<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class AnaquelesSeccione extends Model
{
    public $timestamps = false;
    use HasFactory;

    function getAnaquelBySeccion($id){

        $cad = "select as2.id, a.codigo codigo_anaquel, a.denominacion anaquel, s.codigo codigo_seccion, s.denominacion seccion from anaqueles_secciones as2 
        inner join anaqueles a on as2.id_anaqueles = a.id 
        inner join secciones s on as2.id_secciones = s.id 
        where s.id='".$id."' and a.estado ='1' and s.estado ='1'";

		$data = DB::select($cad);
        return $data;
    }

    function getAnaquelBySeccionEdit($id){

        $cad = "select as2.* from anaqueles_secciones as2 
        inner join anaqueles a on as2.id_anaqueles = a.id 
        inner join secciones s on as2.id_secciones = s.id 
        where s.id='".$id."' and a.estado ='1' and s.estado ='1' and as2.estado ='1'";

		$data = DB::select($cad);
        return $data;
    }
}
