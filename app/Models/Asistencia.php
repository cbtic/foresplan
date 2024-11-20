<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Asistencia extends Model
{
    protected $fillable = ['id_persona','fech_marc_rel','hora_entr_rel','hora_sali_rel','refr_sali_rel','refr_entr_rel','doc_iden_per','nro_doc_rel','fech_regi_eas','tipo_erro_eas','tipo_dias_eas','tipo_marc_eas','hora_marc_eas','minu_tard_eas','minu_apor_eas','minu_tole_eas','minu_dife_eas','flag_marc_eas','nume_bole_eas','flag_bole_eas','id_corr_rel','fech_regi_mar'];

    use HasFactory;
	/*
	public function persona()
    {
	  return $this->belongsTo(PersonalTurno::class,'id_persona');
    }
	*/
	public function persona()
    {
	  return $this->belongsTo(Asistencia::class,'id');
    }
	
	public function listar_asistencia_ajax($p){
		return $this->readFunctionPostgres('sp_listar_asistencia_paginado_nuevo',$p);
    }
	public function listar_asistencia_resumen_ajax($p){
		return $this->readFunctionPostgres('sp_listar_asistencia_resumen_paginado',$p);
    }

    public function get_zkteco_log($fecha,$numero_documento){
	
		$cad = "Select id,persona,numero_documento,dia,hora,tarjeta 
				From dblink ('dbname=".config('values.dblink_dbname')." port=".config('values.dblink_port')." host=".config('values.dblink_host')." user=".config('values.dblink_user')." password=".config('values.dblink_password')."',
				'select t1.id,apellido_paterno||'' ''||apellido_materno||'' ''||nombres persona,t2.numero_documento,to_char(t1.time_second::timestamp,''dd-mm-yyyy'') dia,to_char(t1.time_second::timestamp,''HH24:MI:SS'') hora,cardno tarjeta 
				from zkteco_logs t1 
				inner join personas t2 on t1.pin::int=t2.id
				where t1.eventtype=''0''
				And to_char(t1.time_second::timestamp,''dd-mm-yyyy'')=''".$fecha."''
				And t2.numero_documento=''".$numero_documento."''
				order by t1.id asc')ret (id varchar,persona varchar,numero_documento varchar,dia varchar,hora varchar,tarjeta varchar)";
		//echo $cad;
		$data = DB::select($cad);
        return $data;
		
	}
			
	function recalcular_asistencia($id_asistencia){
  
          $cad = "UPDATE asistencias set 
				minu_dife_eas=case when (fech_sali_rel||' '||hora_sali_rel)::timestamp>(fech_marc_rel||' '||hora_entr_rel)::timestamp
						then (fech_sali_rel||' '||hora_sali_rel)::timestamp-(fech_marc_rel||' '||hora_entr_rel)::timestamp else '0' end,
				minu_tard_eas=case when (fech_marc_rel||' '||hora_entr_rel)::timestamp>(fech_marc_rel||' '||hora_entrada)::timestamp 
						then (fech_marc_rel||' '||hora_entr_rel)::timestamp-(fech_marc_rel||' '||hora_entrada)::timestamp else '0' end,
				minu_apor_eas=case when (fech_marc_rel||' '||hora_entrada)::timestamp>(fech_marc_rel||' '||hora_entr_rel)::timestamp
						then (fech_marc_rel||' '||hora_entrada)::timestamp-(fech_marc_rel||' '||hora_entr_rel)::timestamp else '0' end
				Where id=".$id_asistencia;
         // echo $cad;
          $data = DB::select($cad);
          return $data;
      }
    
    function recalcular_asistenciaP($id_asistencia){
  
        $cad = "UPDATE asistencias set 
              minu_dife_pap=case when (fech_regi_mar||' '||hora_marc_sal)::timestamp>(fech_regi_mar||' '||hora_marc_eas)::timestamp
                      then (fech_regi_mar||' '||hora_marc_sal)::timestamp-(fech_regi_mar||' '||hora_marc_eas)::timestamp else '0' end
              Where id=".$id_asistencia;
        //echo $cad;
        $data = DB::select($cad);
        return $data;
    }

    function recupera_hora_turno_persona($id_persona, $fecha){
        $cad = "SELECT coalesce(to_char(t3.hora_entr_dtu::timestamp,'HH24:MI:SS'),'')hora_entrada,coalesce(to_char(t3.hora_sali_dtu::timestamp,'HH24:MI:SS'),'')hora_salida
        From personas t1
        inner join personal_turnos t2 on t1.id=t2.id_persona
        inner join detalle_turnos t3 on t2.id_turno=t3.id_turno 
        And t3.nume_ndia_dtu::int=case when extract(dow from  '".$fecha."'::date)::int=0 then 7 else extract(dow from '".$fecha."'::date)::int end 
        Where t1.estado='A' and t1.id =".$id_persona;
		$data = DB::select($cad);
        $data = DB::select($cad);
        if(isset($data[0]))return $data[0];

    }

    public function registrar_asistencia_automatico($datos) {
        
        $cad = "Select sp_crud_automatico_asistencia_nuevo(?,'".config('values.dblink_dbname')."','".config('values.dblink_port')."','".config('values.dblink_host')."','".config('values.dblink_user')."','".config('values.dblink_password')."')";
		//echo $datos[0]; exit();
        $data = DB::select($cad, array($datos[0]));
        return $data[0]->sp_crud_automatico_asistencia_nuevo;
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
