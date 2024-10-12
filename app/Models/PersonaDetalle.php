<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class PersonaDetalle extends Model
{
    protected $fillable = ['id_persona','direccion','ubigeo','telefono','email','foto','fecha_ingreso','id_condicion_laboral','id_tipo_planilla','id_profesion','id_banco_sueldo','num_cuenta_sueldo','cci_sueldo','id_regimen_pensionario','id_afp','fecha_afiliacion_afp','id_tipo_comision_afp','cuspp','fecha_cese','fecha_termino_contrato','num_contrato','id_cargo','id_nivel','id_banco_cts','num_cuenta_cts','id_moneda_cts','estado','id_ubicacion'];

    //use HasFactory;
	function getPersonaBuscar($term){

        $cad ="select distinct p.apellido_paterno||' '||p.apellido_materno||' '||p.nombres persona, pd.id_persona, pd.id_ubicacion, e.razon_social 
        from personas p
        inner join persona_detalles pd on pd.id_persona = p.id
        inner join ubicacion_trabajos ut on ut.id = pd.id_ubicacion 
        inner join empresas e on e.id = ut.id_empresa
        where pd.eliminado = 'N' and pd.estado = 'A'
        and p.apellido_paterno||' '||p.apellido_materno||' '||p.nombres ilike '%".$term."%' ";
    
		$data = DB::select($cad);
        return $data;
    }
}
