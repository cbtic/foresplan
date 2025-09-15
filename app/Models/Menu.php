<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Menu extends Model
{
    use HasFactory;

    public function listar_menu_ajax($p){
		return $this->readFunctionPostgres('sp_listar_menu_paginado',$p);
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

     function getMenuByFecha($fecha){

        $cad = "select * from menus
        where fecha ='".$fecha."'";
		//echo $cad;
		$data = DB::select($cad);
        return $data;
    }
}
