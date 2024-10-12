<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Tperiodo extends Model
{
    public function getPeriodos(){
        $cad = "select t.id, e.razon_social || '->' || sp.desc_subt_stp || '->' || t.id_mes || '-' || t.ano_peri_tpe || ' (' || t.fech_inic_tpe || '-' || t.fech_fina_tpe || ')' || '->' || (case when esta_plan_cer = '2' then 'CERRADO' else 'ABIERTO' end) denominacion
        from tperiodos t 
        inner join ubicacion_trabajos ut on t.id_ubicacion = ut.id 
        inner join empresas e on e.id = ut.id_empresa
        inner join subtplanillas sp on sp.id = t.id_subplanilla and sp.id_planilla = t.id_planilla
        where t.esta_plan_tpe = '2'
        order by e.razon_social";
		$data = DB::select($cad);
        return $data;
    }
}
