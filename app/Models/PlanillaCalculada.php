<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class PlanillaCalculada extends Model
{
    protected $fillable = ['id_planilla', 'id_subplanilla', 'ano_peri_tpe', 'nume_peri_tpe', 'id_persona', 'id_concepto', 'valo_calc_pca', 'id_ubicacion'];
    
    public function listar_planilla_ajax($p){
        return $this->readFunctionPostgres('sp_listar_planilla_calculada_paginado',$p);
    }
	
	public function listar_planilla_resumen_ajax($p){
        return $this->readFunctionPostgres('sp_listar_planilla_resumen_paginado',$p);
    }
    
    function getConceptoPlanillaByIdPeri($id_periodo, $id_persona, $tipo){

        $cad = "SELECT p.id, c.codi_conc_tco codigo,  c.desc_cort_tco concepto, p.valo_calc_pca valor, p.id_subplanilla 
        FROM planilla_calculadas p
        inner join conceptos c on c.id = p.id_concepto 
        WHERE p.id_periodo = ".$id_periodo." and p.id_persona =".$id_persona." and c.tipo_conc_tco = '".$tipo."' ";
		$data = DB::select($cad);
        //dd($data); 
        if($data)return $data;
    }

	function getConceptoPlanillaResumenByIdPeri($id_periodo, $id_persona, $tipo){

        $cad = "select r.id, c.codi_conc_tco codigo,  c.desc_cort_tco concepto, r.cant_conc_res, r.cant_conc_rem, r.id_subplanilla 
        from resumenes r
        inner join conceptos c on c.id = r.id_concepto 
        left join formulas f on f.id_planilla = r.id_planilla and f.id_subplanilla = r.id_subplanilla and f.id_concepto = r.id_concepto 
        where r.id_periodo=".$id_periodo." and r.id_persona =".$id_persona." and c.tipo_conc_tco = '".$tipo."' 
        and formula_for is null";
		$data = DB::select($cad);
        //dd($data); 
        if($data)return $data;
    }

    public function readFunctionPostgres($function, $parameters = null){
      
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
}

