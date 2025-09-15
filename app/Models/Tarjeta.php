<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Tarjeta extends Model
{
    use HasFactory;

    public function listar_tarjeta_ajax($p){ 
		return $this->readFunctionPostgres('sp_listar_tarjeta_paginado',$p);
    }

    public function readFunctionPostgres($function, $parameters = null){
	
        $_parameters = '';
        if (count($parameters) > 0) {
            $_parameters = implode("','", $parameters);
            $_parameters = "'" . $_parameters . "',";
        }
        DB::select("BEGIN;");
        $cad = "select " . $function . "(" . $_parameters . "'ref_cursor');";
        DB::select($cad);
        $cad = "FETCH ALL IN ref_cursor;";
        $data = DB::select($cad);
        DB::select("END;");
        return $data;
     }
}
