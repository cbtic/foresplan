<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class TablaUbicacione extends Model
{
    public function getTablaUbicacion($IdUbicacion, $Tabla, $Campo){
        $cad = "select t1.id as id, t2.".$Campo." as denominacion
        from tabla_ubicaciones t1
        inner join ".$Tabla." t2 on t2.id = t1.id_registro
        Where t1.id_cliente = '".$IdUbicacion."' and t1.tabla = '".$Tabla."' and t1.estado='A' ";
		$data = DB::select($cad);
        return $data;
    }
    
    public function getTablaUbicacionAll($Tabla, $Cliente){
        $cad = "select * from tabla_ubicaciones where tabla = '".$Tabla."' limit 1";
        $tablaUbic_model = new TablaUbicacione;
        $tablaUbic = $tablaUbic_model->where('tabla', '=', $Tabla)->where('id_cliente', '=', $Cliente)->where('estado', '=', 'A')->offset(0)->limit(1)->first();
        $columna_den = $tablaUbic->columna_den;
        $cad = "select t1.id as id, t2.".$columna_den." as denominacion
        from tabla_ubicaciones t1
        inner join ".$Tabla." t2 on t2.id = t1.id_registro
        Where t1.id_cliente = '".$Cliente."' and t1.tabla = '".$Tabla."' and t1.estado='A' ";
		$data = DB::select($cad);
        return $data;
    }
	
	public function listar_ubicacion_maestro_ajax($p){
		return $this->readFunctionPostgres('sp_listar_tabla_ubicaciones_paginado',$p);
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
