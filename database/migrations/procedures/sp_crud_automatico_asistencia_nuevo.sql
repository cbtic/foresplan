
CREATE OR REPLACE FUNCTION public.sp_crud_automatico_asistencia_nuevo(p_fecha character varying, p_dbname character varying, p_port character varying, p_host character varying, p_user character varying, p_password character varying)
 RETURNS character varying
 LANGUAGE plpgsql
AS $function$
declare
	entradas record;
	idp integer;
	v_id_asistencia integer;
	_fecha varchar;
	v_dia_marcacion varchar;
	
begin

	delete from asistencias a where to_char(fech_regi_mar::date,'dd-mm-yyyy')=p_fecha;
	
	INSERT INTO asistencias(id_persona,minu_tard_eas,minu_tole_eas,nume_bole_eas,fech_regi_mar,flag_labo_dtu,hora_entrada,hora_salida,fech_marc_rel,created_at)
	select t1.id id_persona,'0' minu_tard_eas,'0' minu_tole_eas,'-' nume_bole_eas,p_fecha fech_regi_mar,flag_labo_dtu,
	coalesce(to_char(t3.hora_entr_dtu::timestamp,'HH24:MI:SS'),'')hora_entrada,coalesce(to_char(t3.hora_sali_dtu::timestamp,'HH24:MI:SS'),'')hora_salida,'',now() created_at
	From personas t1
	inner join personal_turnos t2 on t1.id=t2.id_persona and t2.deleted_at is null
	inner join detalle_turnos t3 on t2.id_turno=t3.id_turno And t3.nume_ndia_dtu::int=case when extract(dow from p_fecha::date)::int=0 then 7 else extract(dow from p_fecha::date)::int end
	inner join tturnos t4 on t2.id_turno=t4.id and t4.deleted_at is null
	Where t1.estado='A' 
	--and t1.id=171
	order by t1.id;

	For entradas In
	select t4.id id_asistencia,t1.id id_persona,t1.numero_documento,R.dia_marcacion,R.hora_marcacion,
	coalesce(to_char(t3.hora_entr_dtu::timestamp,'HH24:MI:SS'),'')hora_entrada,coalesce(to_char(t3.hora_sali_dtu::timestamp,'HH24:MI:SS'),'')hora_salida,
	t3.flag_labo_dtu 
	From personas t1
	inner join (Select numero_documento,dia_marcacion,hora_marcacion 
		From dblink ('dbname='||p_dbname||' port='||p_port||' host='||p_host||' user='||p_user||' password='||p_password||'',
		'select LPAD(emp_code::text, 8, ''0'') numero_documento,to_char(t1.punch_time::timestamp,''dd-mm-yyyy'') dia_marcacion,to_char(t1.punch_time::timestamp,''HH24:MI:SS'') hora_marcacion
		from iclock_transaction t1 
		where 1=1 
		And to_char(punch_time::timestamp,''dd-mm-yyyy'')='''||p_fecha||''' 
		order by t1.id asc'
		)ret (numero_documento varchar,dia_marcacion varchar,hora_marcacion varchar)
	)R on t1.numero_documento=R.numero_documento
	inner join personal_turnos t2 on t1.id=t2.id_persona and t2.deleted_at is null
	inner join detalle_turnos t3 on t2.id_turno=t3.id_turno And t3.nume_ndia_dtu::int=case when extract(dow from p_fecha::date)::int=0 then 7 else extract(dow from p_fecha::date)::int end 
	inner join asistencias t4 on t4.id_persona=t1.id And t4.fech_regi_mar=to_char(p_fecha::date,'dd-mm-yyyy')
	Where t1.estado='A' 
	order by t1.id,hora_marcacion
	Loop
		
		
		--Raise Notice 'ingresa';
		--SI LA HORA DE LA MARCACIÓN ESTA EN CONCORDANCIA AL TURNO PROGRAMADO DE LA HORA DE ENTRADA, 3 HORAS ANTES Y 3 HORAS DESPUES
		if (entradas.dia_marcacion||' '||entradas.hora_marcacion)::timestamp 
			between (entradas.dia_marcacion||' '||entradas.hora_entrada)::timestamp - (interval '3 hours') 
			And 	(entradas.dia_marcacion||' '||entradas.hora_entrada)::timestamp + (interval '3 hours') 
		then
			update asistencias set fech_marc_rel=entradas.dia_marcacion,hora_entr_rel=entradas.hora_marcacion,updated_at=now() Where id=entradas.id_asistencia;
		end if;

		--SI LA HORA DE LA MARCACIÓN ESTA EN CONCORDANCIA AL TURNO PROGRAMADO DE LA HORA DE SALIDA, 3 HORAS ANTES Y 8 HORAS DESPUES

		if entradas.hora_entrada!='' And entradas.hora_entrada < entradas.hora_salida then 
		
			if (entradas.dia_marcacion||' '||entradas.hora_marcacion)::timestamp 
				between (entradas.dia_marcacion||' '||entradas.hora_salida)::timestamp - (interval '3 hours') 
				And 	(entradas.dia_marcacion||' '||entradas.hora_salida)::timestamp + (interval '8 hours') 
			then
				update asistencias set fech_sali_rel=entradas.dia_marcacion,hora_sali_rel=entradas.hora_marcacion,updated_at=now() Where id=entradas.id_asistencia;
			end if;

		else 
			
			if (entradas.dia_marcacion||' '||entradas.hora_marcacion)::timestamp 
				between (entradas.dia_marcacion||' '||entradas.hora_salida)::timestamp - (interval '3 hours') 
				And 	(entradas.dia_marcacion||' '||entradas.hora_salida)::timestamp + (interval '8 hours') 
			then
				v_dia_marcacion := to_char(entradas.dia_marcacion::timestamp - (interval '1 day'),'dd-mm-yyyy');
				select id into v_id_asistencia from asistencias where id_persona=entradas.id_persona 
				and fech_regi_mar=v_dia_marcacion and fech_marc_rel!='' order by 1 asc limit 1;
				update asistencias set fech_sali_rel=entradas.dia_marcacion,hora_sali_rel=entradas.hora_marcacion,updated_at=now() Where id=v_id_asistencia;
			end if;
		
		end if;
		
	End Loop;

	
	update asistencias set 
		minu_dife_eas=case when (fech_sali_rel||' '||hora_sali_rel)::timestamp>(fech_marc_rel||' '||hora_entr_rel)::timestamp
			then (fech_sali_rel||' '||hora_sali_rel)::timestamp-(fech_marc_rel||' '||hora_entr_rel)::timestamp else '0' end,

		minu_tard_eas=case when fech_marc_rel!='' and hora_entr_rel!='' and ((fech_marc_rel||' '||hora_entr_rel)::timestamp>(fech_marc_rel||' '||hora_entrada)::timestamp) 
			then (fech_marc_rel||' '||hora_entr_rel)::timestamp-(fech_marc_rel||' '||hora_entrada)::timestamp else '0' end,

		minu_apor_eas=case when fech_marc_rel!='' and hora_entr_rel!='' and ((fech_marc_rel||' '||hora_entrada)::timestamp>(fech_marc_rel||' '||hora_entr_rel)::timestamp)
			then (fech_marc_rel||' '||hora_entrada)::timestamp-(fech_marc_rel||' '||hora_entr_rel)::timestamp else '0' end
	Where id in (select id from asistencias where fech_regi_mar=to_char(p_fecha::date,'dd-mm-yyyy'));

	_fecha := p_fecha;
	return _fecha;	
	--return idp;
	/*EXCEPTION
	WHEN OTHERS THEN
        idp:=-1;
	return idp;*/
end;
$function$
;

