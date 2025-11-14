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

    function getPersonaDetalle($id){

        $cad ="select * from persona_detalles pd
        where pd.id_persona = '".$id."' 
        and pd.eliminado = 'N' ";
    
		$data = DB::select($cad);
        return $data;
    }

    function getDatosPersonaContrato($id){

        $cad ="select c.id, p.sexo, p.apellido_paterno ||' '|| p.apellido_materno ||' '|| p.nombres persona, p.numero_documento, pd.direccion, (select sp_crud_obtiene_tabla_deno(c.id_cargo)) cargo,
        c.func_cont_cnt funciones, c.mont_cont_ctr sueldo, c.nume_cont_con numero_contrato, to_char(c.fech_inic_cnt,'dd-mm-yyyy') fecha_inicio, to_char(c.fech_cese_cnt,'dd-mm-yyyy') fecha_cese
        from contratos c 
        inner join personas p on c.id_persona = p.id and p.estado = 'A'
        inner join persona_detalles pd on pd.id_persona = p.id and pd.estado ='A' and pd.eliminado = 'N'
        where c.id_persona ='".$id."'";
    
		$data = DB::select($cad);
        return $data;
    }
}
