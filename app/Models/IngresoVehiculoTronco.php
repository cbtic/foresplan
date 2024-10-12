<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class IngresoVehiculoTronco extends Model
{

	function getEmpresaConductorVehiculos($placa){

        $cad = "select ecv.id,ecv.id_empresas,ecv.id_vehiculos,ecv.id_conductores,e.razon_social,e.ruc,v.placa,v.ejes,v.peso_tracto,v.peso_carreta,v.peso_seco,c.licencia,to_char(c.fecha_licencia,'dd-mm-yyyy')fecha_licencia,p.id_tipo_documento,p.numero_documento,p.apellido_paterno||' '||p.apellido_materno||' '||p.nombres conductor 
from empresas_conductores_vehiculos ecv
inner join empresas e on ecv.id_empresas=e.id
inner join vehiculos v on ecv.id_vehiculos=v.id and v.estado='1' 
inner join conductores c on ecv.id_conductores=c.id and c.estado='ACTIVO'
inner join personas p on c.id_personas=p.id
where ecv.estado='1'
and v.placa='".$placa."'
order by ecv.id desc";

		$data = DB::select($cad);
        if(isset($data[0]))return $data[0];
    }

	function getIngresoVehiculoTroncoCubicajeById($id){

        $cad = "select * from ingreso_vehiculo_tronco_cubicajes ivtc 
where id_ingreso_vehiculo_tronco_tipo_maderas=".$id;

		$data = DB::select($cad);
        return $data;
    }
	
	function getIngresoVehiculoTroncoCubicajeReporteById($id){

        $cad = "select count(*) cantidad,diametro_dm,longitud,volumen_m3,volumen_pies,sum(volumen_total_m3)volumen_total_m3,
sum(volumen_total_pies)volumen_total_pies,precio_unitario,sum(precio_total)precio_total  
from ingreso_vehiculo_tronco_cubicajes ivtc 
where id_ingreso_vehiculo_tronco_tipo_maderas=".$id."
group by diametro_dm,longitud,volumen_m3,volumen_pies,precio_unitario";

		$data = DB::select($cad);
        return $data;
    }
	
	public function listar_ingreso_vehiculo_tronco_ajax($p){

        return $this->readFuntionPostgres('sp_listar_ingreso_vehiculo_tronco_paginado',$p);

    }

	public function readFuntionPostgres($function, $parameters = null){

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
