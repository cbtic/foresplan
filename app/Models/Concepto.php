<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;


class Concepto extends Model
{
    protected $fillable = ['codi_conc_tco','codi_cicl_cic','desc_conc_tco','desc_cort_tco','estado'];

    public function listar_concepto_ajax($p){
        return $this->readFunctionPostgres('sp_listar_concepto_paginado',$p);
    }


    public function readFunctionPostgres($function, $parameters = null){

        $_parameters = '';
        if (count($parameters) > 0) {
            $_parameters = implode("','", $parameters);
            $_parameters = "'" . $_parameters . "',";
        }
        $data = DB::select("BEGIN;");
        $cad = "select " . $function . "(" . $_parameters . "'ref_cursor');";
        //echo $cad;
        $data = DB::select($cad);
        $cad = "FETCH ALL IN ref_cursor;";
        $data = DB::select($cad);
        return $data;
     }

     public function getConceptoAll(){
        $cad = "select id, codi_conc_tco, desc_conc_tco denominacion from conceptos c 
        where estado ='A'";
		$data = DB::select($cad);
        return $data;
    }
}
