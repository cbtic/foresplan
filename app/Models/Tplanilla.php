<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Tplanilla extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'tipo_plan_tpl', 'desc_tipo_tpl', 'tarj_inic_tpl', 'tarj_fina_tpl', 'cant_peri_tpl', 'codi_oper_ope', 'tipo_clas_tpl', 'codi_cond_lab', 'codi_anex_anx', 'codi_peri_tpe', 'tipo_docu_tpd', 'cate_pers_tpl', 'nume_dia_vac'
    ];
    use HasFactory;
	
	public function getPlanilla____($IdUbicacion, $Tabla, $Campo){
        $cad = "select t1.id as id, t2.".$Campo." as denominacion
        from tabla_ubicaciones t1
        inner join ".$Tabla." t2 on t2.id = t1.id_registro
        Where t1.id_cliente = '".$IdUbicacion."' and t1.tabla = '".$Tabla."' and t1.estado='A' ";
		$data = DB::select($cad);
        return $data;
    }
	
	public function getPlanilla($id_cliente){
        $cad = "select t2.id, t2.desc_tipo_tpl as denominacion
from tabla_ubicaciones t1
inner join tplanillas t2 on t2.id = t1.id_registro
Where t1.id_cliente = ".$id_cliente." and t1.tabla = 'tplanillas' and t1.estado='A' ";
		$data = DB::select($cad);
        return $data;
    }
	
	public function getSubPlanilla($id_planilla){
        $cad = "select id,desc_subt_stp denominacion
from subtplanillas
where id_planilla=".$id_planilla;
		$data = DB::select($cad);
        return $data;
    }
	
	public function getConceptoPersona($id_periodo,$id_persona){
        $cad = "select t1.id,t2.desc_conc_tco denominacion,t1.mont_fijo_cmf 
from concepto_personas t1
inner join conceptos t2 on t1.id_concepto=t2.id
where t1.id_periodo=".$id_periodo."
and id_persona=".$id_persona."
and coalesce(t1.estado,'1')='1'
order by t2.desc_conc_tco asc";
		//echo $cad;
		$data = DB::select($cad);
        return $data;
    }
	
	public function getConceptoPersonaResumen($id_planilla,$id_subplanilla,$id_persona){
        $cad = "select t1.id,t2.desc_conc_tco denominacion,t1.cant_conc_res,cant_conc_rem  
from resumenes t1
inner join conceptos t2 on t1.id_concepto=t2.id
where t1.id_planilla=".$id_planilla."
and t1.id_subplanilla=".$id_subplanilla."
and id_persona=".$id_persona."
--and coalesce(t1.estado,'1')='1'
order by t2.desc_conc_tco asc";
		//echo $cad;
		$data = DB::select($cad);
        return $data;
    }
	
	public function getPeriodoById($id){
        $cad = "select t2.desc_tipo_tpl planilla,t3.desc_subt_stp subplanilla,t1.ano_peri_tpe anio,t4.nombre_mes mes,t1.fech_inic_tpe,t1.fech_fina_tpe,t1.desc_peri_tpe,t1.esta_plan_tpe,t6.razon_social empresa,t1.id_ubicacion,t1.id_planilla,t1.id_subplanilla,t1.id_mes, t.tab_larg_des tipo_planilla
from Tperiodos t1
inner join tplanillas t2 on t2.id = t1.id_planilla
inner join subtplanillas t3 on t3.id = t1.id_subplanilla and t3.id_planilla = t1.id_planilla
inner join meses t4 on t1.id_mes=t4.id
inner join ubicacion_trabajos t5 on t5.id = t1.id_ubicacion 
inner join empresas t6 on t6.id = t5.id_empresa
left join tablas t on t.tab_ite1_cod =  '004' and t.tab_ite2_cod::int = t1.id_tipo_planilla 
Where t1.id=".$id;
		//echo $cad;
		$data = DB::select($cad);
		return $data[0];
    }
	
	public function getMetasPersona($id_periodo){
        $cad = "select t1.id,t3.id_persona,t1.id_planilla,t1.id_subplanilla,t3.id_ubicacion,t4.abre_docu_did tipo_documento,t2.numero_documento,t2.apellido_paterno||' '||t2.apellido_materno||' '||t2.nombres persona, 
(select sp_crud_obtiene_tabla_deno (t3.id_condicion_laboral)) condicion_laboral, 
(select sp_crud_obtiene_tabla_deno (t3.id_regimen_pensionario)) regimen,
(select sp_crud_obtiene_tabla_deno (t3.id_area_trabajo)) area_trabajo,
(select sp_crud_obtiene_tabla_deno (t3.id_unidad_trabajo)) unidad_trabajo,
t6.razon_social 
from meta_personas t1
inner join personas t2 on t1.id_persona=t2.id
inner join persona_detalles t3 on t3.id_persona = t2.id 
inner join documento_identidades t4 on t4.id = t2.tipo_documento 
inner join ubicacion_trabajos t5  on t5.id = t1.id_ubicacion 
inner join empresas t6 on t6.id = t5.id_empresa 
Where t3.eliminado = 'N' 
and t3.estado = 'A'
And coalesce(t1.estado,'1')='1' 
And t1.id_periodo = ".$id_periodo;

		//echo $cad; exit();
		$data = DB::select($cad);
		return $data;
    }
	
	public function listar_metas_persona_ajax($p){
		return $this->readFunctionPostgres('sp_listar_metas_persona_paginado',$p);
    }
	
	public function listar_planilla_persona_ajax($p){
		return $this->readFunctionPostgres('sp_listar_periodos_paginado',$p);
    }
	
	public function cerrar_periodo($id_periodo) {
		
        $cad = "Select sp_cerrar_periodo(?)";
        $data = DB::select($cad, array($id_periodo));
        return $data[0]->sp_cerrar_periodo;
    }

    public function generar_planilla_calculada($id_periodo) {
		
        $cad = "Select sp_procesar_planilla(?)";
        $data = DB::select($cad, array($id_periodo));
        return $data[0]->sp_procesar_planilla;
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
