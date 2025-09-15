<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class RegimenPensionario extends Model
{
    use HasFactory;

    function getRegimen($area){
        $cad = "select rp.id id, rp.nomb_regimen denominacion
        from regimen_pensionarios rp 
        inner join tabla_ubicaciones tu on tu.id_registro = rp.id 
        where rp.codi_regimen::int = (select tu1.id_registro from tabla_ubicaciones tu1 where tu1.id = ".$area.") and tu.tabla = 'regimen_pensionarios'";


        $data = DB::select($cad);
        return $data;
    } 
}
