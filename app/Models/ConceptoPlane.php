<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ConceptoPlane extends Model
{
    use HasFactory;
	
	public function getConceptoPlan($id_planilla,$id_subplanilla){
        $cad = "select t2.id,t2.desc_conc_tco denominacion
        from concepto_planes t1
        inner join conceptos t2 on t1.id_concepto=t2.id
        where t1.id_planilla=".$id_planilla."
        and t1.id_subplanilla=".$id_subplanilla;
		//echo $cad;
		$data = DB::select($cad);
        return $data;
    }

    public function listar_concepto_plan_ajax($p){
		return $this->readFunctionPostgres('sp_listar_concepto_plan_paginado',$p);
    }

    public function readFunctionPostgres($function, $parameters = null){
	
        $_parameters = '';
        if (count($parameters) > 0) {
            $_parameters = implode("','", $parameters);
            $_parameters = "'" . $_parameters . "',";
        }
        $data = DB::select("BEGIN;");
        $cad = "select " . $function . "(" . $_parameters . "'ref_cursor');";
        //echo $cad; exit();
        $data = DB::select($cad);
        $cad = "FETCH ALL IN ref_cursor;";
        $data = DB::select($cad);
        return $data;
     }
	
}
