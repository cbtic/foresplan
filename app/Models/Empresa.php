<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Empresa extends Model
{
    protected $fillable = ['ruc', 'razon_social', 'nombre_comercial', 'direccion', 'representante'];

	public function listar_empresa_ajax($p){
		return $this->readFunctionPostgres('sp_listar_empresa_paginado',$p);
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

   function getEmpresa($id){

        $cad = "select * from empresas e 
        where e.id='".$id."'";

        $data = DB::select($cad);
        return $data;
    }

   public function vehiculos()
   {
       return $this->belongsToMany(Vehiculo::class, 'empresas_vehiculos', 'id_empresas', 'id_vehiculos');
   }

   public function conductores()
   {
       return $this->belongsToMany(Conductores::class,'empresas_conductores', 'id_empresas', 'id_conductores');
   }

   public function getRucNombreComercialAttribute() : string {
    return $this->ruc . " - " . $this->nombre_comercial;
  }
//    public function conductores()
//    {
//        return $this->hasMany(Conductores::class);
//    }
}
