<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

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

  protected function normalizarFechaSql(?string $fecha): ?string
  {
      if ($fecha === null) {
          return null;
      }

      $fecha = trim($fecha);
      if ($fecha === '') {
          return null;
      }

      // Formatos que puede recibir desde el frontend/BD
      $formatos = ['d/m/Y', 'Y-m-d', 'd-m-Y'];

      foreach ($formatos as $formato) {
          try {
              $dt = Carbon::createFromFormat($formato, $fecha);
              // Validar que no haya errores de parsing
              if ($dt !== false) {
                  return $dt->format('Y-m-d'); // siempre ISO para Postgres
              }
          } catch (\Exception $e) {
              // seguir probando otros formatos
          }
      }

      // Si nada funcionó, devolver null o lanzar una excepción
      return null;
  }


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

    public function get_zkteco_log____($fecha,$numero_documento){

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

    public function get_zkteco_log($fecha,$numero_documento){

		$cad = "Select t2.id,t2.apellido_paterno||' '||t2.apellido_materno||' '||t2.nombres persona,R.numero_documento,R.dia,R.hora,R.tarjeta
                from (
                select numero_documento,dia,hora,tarjeta
				From dblink ('dbname=".config('values.dblink_dbname')." port=".config('values.dblink_port')." host=".config('values.dblink_host')." user=".config('values.dblink_user')." password=".config('values.dblink_password')."',
				'select LPAD(t1.emp_code::text, 8, ''0'') numero_documento,to_char(t1.punch_time::timestamp,''dd-mm-yyyy'') dia,to_char(t1.punch_time::timestamp,''HH24:MI:SS'') hora,pe.card_no tarjeta
				from iclock_transaction t1
                inner join personnel_employee pe on t1.emp_code=pe.emp_code
				where 1=1
				And to_char(t1.punch_time::timestamp,''dd-mm-yyyy'')=''".$fecha."''
				And LPAD(t1.emp_code::text, 8, ''0'')=''".$numero_documento."''
				')ret (numero_documento varchar,dia varchar,hora varchar,tarjeta varchar)
                )R
                inner join personas t2 on t2.numero_documento=R.numero_documento
                ";
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

     public function obtenerDiasTrabajados($id_persona, $fecha_inicio, $fecha_fin){

        $fecha_inicio = $this->normalizarFechaSql($fecha_inicio);
        $fecha_fin    = $this->normalizarFechaSql($fecha_fin);

        if (! $fecha_inicio || ! $fecha_fin) {
            return collect([ (object)['dias_trabajados' => 0] ]);
        }

        $cad = "select
        (
          select count(*)
          from asistencias
          where id_persona = ".$id_persona."
            and fech_marc_rel is not null
            and fech_marc_rel <> ''
            and to_date(fech_marc_rel, 'DD-MM-YYYY')
                between '".$fecha_inicio."' and '".$fecha_fin."'
        )
          +
        (
          select count(*)
          from asistencias
          where id_persona = ".$id_persona."
            and fech_regi_mar is not null
            and fech_regi_mar <> ''
            and to_date(fech_regi_mar, 'DD-MM-YYYY')
                between '".$fecha_inicio."' and '".$fecha_fin."'
            and coalesce(id_deta_operacion, 0) > 0
        ) as dias_trabajados;";

        $data = DB::select($cad);
        return $data;
    }

    public function obtenerDiasNoTrabajados($id_persona, $fecha_inicio, $fecha_fin){

        $fecha_inicio = $this->normalizarFechaSql($fecha_inicio);
        $fecha_fin    = $this->normalizarFechaSql($fecha_fin);

        if (! $fecha_inicio || ! $fecha_fin) {
          return collect([ (object)['dias_inasistencia' => 0] ]);
        }

        $cad = "
        select
            coalesce(
                (
                    select count(*)
                    from generate_series('".$fecha_inicio."'::date, '".$fecha_fin."'::date, '1 day'::interval) fecha_dias
                    left join personal_turnos pt
                        on pt.id_persona = ".$id_persona."
                    left join detalle_turnos dt
                        on dt.id_turno = pt.id_turno
                       and dt.nume_ndia_dtu::int = case
                            when extract(dow from fecha_dias)::int = 0 then 7
                            else extract(dow from fecha_dias)::int
                        end
                    where dt.flag_labo_dtu = 'S'
                ), 0
            )
            - coalesce(
                (
                    select count(*)
                    from asistencias
                    where id_persona = ".$id_persona."
                      and fech_marc_rel is not null
                      and fech_marc_rel <> ''
                      and to_date(fech_marc_rel, 'DD-MM-YYYY')
                          between '".$fecha_inicio."' and '".$fecha_fin."'
                ), 0
            )
            - coalesce(
                (
                    select count(*)
                    from asistencias
                    where id_persona = ".$id_persona."
                      and fech_regi_mar is not null
                      and fech_regi_mar <> ''
                      and to_date(fech_regi_mar, 'DD-MM-YYYY')
                          between '".$fecha_inicio."' and '".$fecha_fin."'
                      and coalesce(id_deta_operacion, 0) > 0
                ), 0
            ) as dias_inasistencia;
    ";

        $data = DB::select($cad);
        return $data;
    }

    public function obtenerHorasDiurnasTrabajadas($id_persona, $fecha_inicio, $fecha_fin){

        $fecha_inicio = $this->normalizarFechaSql($fecha_inicio);
        $fecha_fin    = $this->normalizarFechaSql($fecha_fin);

        if (! $fecha_inicio || ! $fecha_fin) {
            return collect([ (object)['horas_diurnas_trabajadas' => 0] ]);
        }

        $cad = "
        select
            floor(
                sum(
                    fn_get_diurno_nocturno(
                        fech_marc_rel,
                        hora_entr_rel,
                        fech_sali_rel,
                        ((hora_sali_rel::interval + coalesce(minu_dife_pap, '00:00:00')::interval)::varchar),
                        'D'
                    )::int
                ) / 60
            ) as horas_diurnas_trabajadas
        from asistencias
        where id_persona = ".$id_persona."
          and fech_marc_rel is not null
          and fech_marc_rel <> ''
          and to_date(fech_marc_rel, 'DD-MM-YYYY')
              between '".$fecha_inicio."' and '".$fecha_fin."'
          and hora_entr_rel is not null
          and hora_entr_rel <> ''
          and fech_sali_rel is not null
          and fech_sali_rel <> ''
          and hora_sali_rel is not null
          and hora_sali_rel <> '';
        ";

        $data = DB::select($cad);
        return $data;
    }

    public function obtenerHorasNocturnasTrabajadas($id_persona, $fecha_inicio, $fecha_fin){

        $fecha_inicio = $this->normalizarFechaSql($fecha_inicio);
        $fecha_fin    = $this->normalizarFechaSql($fecha_fin);

        if (! $fecha_inicio || ! $fecha_fin) {
            return collect([ (object)['horas_nocturnas_trabajadas' => 0] ]);
        }

        $cad = "
        select
          floor(
              sum(
                  fn_get_diurno_nocturno(
                      fech_marc_rel,
                      hora_entr_rel,
                      fech_sali_rel,
                      hora_sali_rel,
                      'N'
                  )::int
              ) / 60
          ) as horas_nocturnas_trabajadas
        from asistencias
        where id_persona = ".$id_persona."
          and fech_marc_rel is not null
          and fech_marc_rel <> ''
          and to_date(fech_marc_rel, 'DD-MM-YYYY')
              between '".$fecha_inicio."' and '".$fecha_fin."'
          and hora_entr_rel is not null
          and hora_entr_rel <> ''
          and fech_sali_rel is not null
          and fech_sali_rel <> ''
          and hora_sali_rel is not null
          and hora_sali_rel <> '';
        ";

        $data = DB::select($cad);
        return $data;
    }

    public function obtenerHorasExtra($id_persona, $id_periodo){

        $cad = "select coalesce(sum(mont_fijo_cmf),0) cantidad from concepto_personas cp
        where id_persona ='".$id_persona."'
        and id_concepto in ('121','122')
        and id_periodo ='".$id_periodo."'
        and estado ='1'";

        $data = DB::select($cad);
        return $data;

    }

    public function obtenerDiasSubsidio($id_persona, $id_periodo){

        $cad = "select coalesce(sum(mont_fijo_cmf),0) cantidad from concepto_personas cp
        where id_persona ='".$id_persona."'
        and id_concepto ='123'
        and id_periodo ='".$id_periodo."'
        and estado ='1'";

        $data = DB::select($cad);
        return $data;

    }

}
