CREATE OR REPLACE FUNCTION public.sp_cerrar_periodo(p_id_periodo character varying)
 RETURNS character varying
 LANGUAGE plpgsql
AS $function$
declare
	cursor_personas record;
	cursor_conceptos record;
	idp integer;
	v_id_asistencia integer;
	v_cant integer;
	_fecha varchar;

	v_cant_conc_res decimal;
	v_cant_conc_res_ decimal;
	v_capital_amortizado decimal;
	v_capital_vivo decimal;

	v_id_planilla integer;
	v_id_subplanilla integer;
	v_id_ubicacion integer;
	v_fech_inic_tpe varchar;
	v_fech_fina_tpe varchar;
	
begin

	select id_planilla,id_subplanilla,id_ubicacion,fech_inic_tpe,fech_fina_tpe
	into v_id_planilla,v_id_subplanilla,v_id_ubicacion,v_fech_inic_tpe,v_fech_fina_tpe
	from tperiodos
	where id=p_id_periodo::int;

	delete from resumenes 
	where id_periodo=p_id_periodo::int;
	
	For cursor_personas In
	select id_persona
	from meta_personas
	where id_periodo=p_id_periodo::int
	and coalesce(estado,'1')='1'
	
	Loop
		
		for cursor_conceptos In
		select id_concepto, mont_fijo_cmf 
		from concepto_personas
		where id_periodo=p_id_periodo::int
		and id_persona=cursor_personas.id_persona
		and coalesce(estado,'1')='1'
		
		loop 

			--_fecha:=cursor_personas.id_persona||'#'||cursor_conceptos.id_concepto;
			v_cant_conc_res:=0;
			
			if cursor_conceptos.id_concepto=8 then --MINUTOS DE TARDANZA
				select coalesce(sum(extract(hour from minu_tard_eas::TIME)*60 + extract(minute from minu_tard_eas::TIME)),0) into v_cant_conc_res
				from asistencias 
				where id_persona=cursor_personas.id_persona 
				and fech_marc_rel::date between v_fech_inic_tpe::date and v_fech_fina_tpe::date 
				and fech_marc_rel!=''
				and minu_tard_eas!='0';

				select coalesce(sum(extract(hour from minu_dife_pap::TIME)*60 + extract(minute from minu_dife_pap::TIME)),0) into v_cant_conc_res_
				from asistencias 
				where id_persona=cursor_personas.id_persona 
				and fech_marc_rel::date between v_fech_inic_tpe::date and v_fech_fina_tpe::date 
				and fech_marc_rel!=''
				and minu_dife_pap!='0';

				v_cant_conc_res:=v_cant_conc_res-v_cant_conc_res_;
				
			end if;
		
			if cursor_conceptos.id_concepto=7 then --DIAS INASISTENCIA
				
				DROP TABLE IF EXISTS tmp_fechas;
				create temp table tmp_fechas as
				select cursor_personas.id_persona id_persona,fecha_dias::date 
				from generate_series(v_fech_inic_tpe::date, v_fech_fina_tpe::date, '1 day'::interval) fecha_dias;

				select 
				(select count(*) 
				from tmp_fechas t0
				left join personal_turnos t1 on t0.id_persona = t1.id_persona
				left join detalle_turnos t2 on t2.id_turno=t1.id_turno And t2.nume_ndia_dtu::int=case when extract(dow from fecha_dias::date)::int=0 then 7 else extract(dow from fecha_dias::date)::int end
				where t1.id_persona=cursor_personas.id_persona
				and t2.flag_labo_dtu='S')
				-
				(select count(*) 
				from asistencias 
				where id_persona=cursor_personas.id_persona
				and fech_marc_rel::date between v_fech_inic_tpe::date and v_fech_fina_tpe::date
				and fech_marc_rel!='') 
				-
				(select count(*) 
				from asistencias 
				where id_persona=cursor_personas.id_persona
				and fech_regi_mar::date between v_fech_inic_tpe::date and v_fech_fina_tpe::date
				and coalesce(id_deta_operacion)>0)
				into v_cant_conc_res;
				
			end if;

			if cursor_conceptos.id_concepto=40 then --DIAS TRABAJADOS
				select 
				(select count(*)
				from asistencias 
				where id_persona=cursor_personas.id_persona 
				and fech_marc_rel::date between v_fech_inic_tpe::date and v_fech_fina_tpe::date
				and fech_marc_rel!='')
				+
				(select count(*) 
				from asistencias 
				where id_persona=cursor_personas.id_persona
				and fech_regi_mar::date between v_fech_inic_tpe::date and v_fech_fina_tpe::date
				and coalesce(id_deta_operacion)>0)
				into v_cant_conc_res;
				--_fecha:=cursor_personas.id_persona||'#'||cursor_conceptos.id_concepto||'#'||v_cant_conc_res;
			end if;

			if cursor_conceptos.id_concepto=81 then --HORA DIURNO TRAB.
				--06 am - 10 pm -- diurno
				select 
				floor(
				sum(
				--fn_get_diurno_nocturno(fech_marc_rel,hora_entr_rel,fech_sali_rel,hora_sali_rel,'D')::int
				fn_get_diurno_nocturno(fech_marc_rel,hora_entr_rel,fech_sali_rel,((hora_sali_rel::interval + coalesce(minu_dife_pap,'00:00:00')::interval)::varchar),'D')::int
				/*(
				extract(hour from 
				(fech_sali_rel||' 06:00:00')::timestamp-
				case when (fech_marc_rel||' '||hora_entr_rel)::timestamp>(fech_marc_rel||' 06:00:00')::timestamp then (fech_marc_rel||' 06:00:00')::timestamp else (fech_marc_rel||' '||hora_entr_rel)::timestamp end 
				)*60
				+
				extract(minute from 
				(fech_sali_rel||' 06:00:00')::timestamp-
				case when (fech_marc_rel||' '||hora_entr_rel)::timestamp>(fech_marc_rel||' 06:00:00')::timestamp then (fech_marc_rel||' 06:00:00')::timestamp else (fech_marc_rel||' '||hora_entr_rel)::timestamp end 
				)
				)*/
				/60
				)
				)
				into v_cant_conc_res
				from asistencias 
				where id_persona=cursor_personas.id_persona 
				and fech_marc_rel::date between v_fech_inic_tpe::date and v_fech_fina_tpe::date
				and fech_marc_rel!=''
				and hora_entr_rel!=''
				and fech_sali_rel!=''
				and hora_sali_rel!='';

			end if;

			if cursor_conceptos.id_concepto=82 then --HORA NOCTURNO TRAB.
				--10:01 pm - 05:59 am -- nocturno
				select 
				floor(
				sum(
				fn_get_diurno_nocturno(fech_marc_rel,hora_entr_rel,fech_sali_rel,hora_sali_rel,'N')::int
				/*(
				extract(hour from 
				case when (fech_sali_rel||' '||hora_sali_rel)::timestamp>(fech_sali_rel||' 22:00:00')::timestamp then (fech_sali_rel||' 22:00:00')::timestamp else (fech_sali_rel||' '||hora_sali_rel)::timestamp end -
				(fech_sali_rel||' 06:00:00')::timestamp
				)*60
				+
				extract(minute from 
				case when (fech_sali_rel||' '||hora_sali_rel)::timestamp>(fech_sali_rel||' 22:00:00')::timestamp then (fech_sali_rel||' 22:00:00')::timestamp else (fech_sali_rel||' '||hora_sali_rel)::timestamp end -
				(fech_sali_rel||' 06:00:00')::timestamp
				)
				)*/
				/60
				)
				)
				into v_cant_conc_res
				from asistencias 
				where id_persona=cursor_personas.id_persona 
				and fech_marc_rel::date between v_fech_inic_tpe::date and v_fech_fina_tpe::date
				and fech_marc_rel!=''
				and hora_entr_rel!=''
				and fech_sali_rel!=''
				and hora_sali_rel!='';
				
			end if;
		
			--if v_cant_conc_res>0 then
				--_fecha:=cursor_personas.id_persona||'#'||cursor_conceptos.id_concepto||'#'||v_cant_conc_res;
				insert into resumenes(id_persona,id_planilla,id_subplanilla,ano_peri_tpe,nume_peri_tpe,id_ubicacion,id_concepto,cant_conc_res,cant_conc_rem,created_at,updated_at,id_periodo)
				values (cursor_personas.id_persona,v_id_planilla,v_id_subplanilla,to_char(v_fech_inic_tpe::date,'YYYY'),to_char(v_fech_inic_tpe::date,'MM'),v_id_ubicacion,cursor_conceptos.id_concepto,v_cant_conc_res,cursor_conceptos.mont_fijo_cmf,now(),now(),p_id_periodo::int);
			--end if;
		
			
		End Loop;

	End Loop;
	
	return _fecha;	
	--return idp;
	/*EXCEPTION
	WHEN OTHERS THEN
        idp:=-1;
	return idp;*/
--truncate resumenes
--select sp_cerrar_periodo('2021', '11')
end;
$function$
;
