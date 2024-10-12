CREATE OR REPLACE FUNCTION public.sp_crud_automatico_asistencia(
    p_fecha character varying,
    p_dbname character varying,
    p_port character varying,
    p_host character varying,
    p_user character varying,
    p_password character varying)
  RETURNS character varying AS
$BODY$
declare
	entradas record;
	idp integer;
	v_id_asistencia integer;
	v_cant integer;
	_fecha varchar;

	
begin

	For entradas In
	select t1.id id_persona,t1.numero_documento,R.dia,R.hora,
	coalesce(to_char(t3.hora_entr_dtu::timestamp,'HH24:MI:SS'),'')hora_entrada,coalesce(to_char(t3.hora_sali_dtu::timestamp,'HH24:MI:SS'),'')hora_salida,
	case 
		when (R.dia||' '||R.hora)::timestamp 
			between (R.dia||' '||to_char(t3.hora_entr_dtu::timestamp,'HH24:MI:SS'))::timestamp - (interval '2 hours') 
			And 	(R.dia||' '||to_char(t3.hora_entr_dtu::timestamp,'HH24:MI:SS'))::timestamp + (interval '3 hours') 
			then '1' 
		when (R.dia||' '||R.hora)::timestamp 
			between (R.dia||' '||to_char(t3.hora_sali_dtu::timestamp,'HH24:MI:SS'))::timestamp - (interval '2 hours') 
			And 	(R.dia||' '||to_char(t3.hora_sali_dtu::timestamp,'HH24:MI:SS'))::timestamp + (interval '8 hours') 
			then '2' 
		else '0' 
	end flag_ingreso_salida,
	case when hora_entr_dtu < hora_sali_dtu then '1' else '2' end flag_dia,t3.flag_labo_dtu 
	From personas t1
	inner join (Select numero_documento,dia,hora 
		From dblink ('dbname='||p_dbname||' port='||p_port||' host='||p_host||' user='||p_user||' password='||p_password||'',
		'
		select t2.numero_documento,to_char(t1.time_second::timestamp,''dd-mm-yyyy'') dia,to_char(t1.time_second::timestamp,''HH24:MI:SS'') hora
		from zkteco_logs t1 
		inner join personas t2 on t1.pin::int=t2.id
		where t1.eventtype=''0''
		And to_char(t1.created_at,''dd-mm-yyyy'')='''||p_fecha||''' 
		--And t2.numero_documento=''43498391'' 
		order by t1.id asc
		'
		)ret (numero_documento varchar,dia varchar,hora varchar)
	)R on t1.numero_documento=R.numero_documento
	inner join personal_turnos t2 on t1.id=t2.id_persona
	inner join detalle_turnos t3 on t2.id_turno=t3.id_turno And t3.nume_ndia_dtu::int=case when extract(dow from p_fecha::date)::int=0 then 7 else extract(dow from p_fecha::date)::int end --And t3.flag_labo_dtu='S' 
	Where t1.estado='A' 
	Loop
		--_fecha:=entradas.id_persona||'#'||entradas.dia||'#'||entradas.hora||'#'||entradas.hora_entrada||'#'||entradas.hora_salida||'#'||entradas.flag_ingreso_salida||'#'||entradas.flag_dia;
		_fecha:=entradas.id_persona||'#'||entradas.dia||'#'||entradas.hora||'#'||entradas.hora_entrada||'#'||entradas.hora_salida||'#'||entradas.flag_ingreso_salida||'#'||entradas.flag_dia;
		
		
		if entradas.flag_ingreso_salida = '1' then

			--select count(*) into v_cant from asistencias where id_persona=entradas.id_persona and fech_marc_rel=entradas.dia; 
			select count(*) into v_cant from asistencias where id_persona=entradas.id_persona and fech_regi_mar=entradas.dia; 

			if v_cant = 0 and entradas.hora_entrada!='' then
				INSERT INTO asistencias(id_persona,fech_marc_rel,hora_entr_rel,minu_tard_eas,minu_tole_eas,nume_bole_eas,fech_regi_mar,created_at,hora_entrada,hora_salida)
				values(entradas.id_persona,entradas.dia,entradas.hora,'0','0','-',p_fecha,now(),entradas.hora_entrada,entradas.hora_salida);
			end if;
			
			
		end if;

		if entradas.flag_ingreso_salida = '2' then
			if entradas.flag_dia = '1' then
			
				--select id into v_id_asistencia from asistencias where id_persona=entradas.id_persona and fech_marc_rel=entradas.dia order by 1 asc limit 1;
				select id into v_id_asistencia from asistencias where id_persona=entradas.id_persona and fech_regi_mar=entradas.dia order by 1 asc limit 1;
				
				UPDATE asistencias set fech_sali_rel=entradas.dia,hora_sali_rel=entradas.hora,updated_at=now() Where id=v_id_asistencia;

				UPDATE asistencias set 
				minu_dife_eas=case when (fech_sali_rel||' '||hora_sali_rel)::timestamp>(fech_marc_rel||' '||hora_entr_rel)::timestamp
						then (fech_sali_rel||' '||hora_sali_rel)::timestamp-(fech_marc_rel||' '||hora_entr_rel)::timestamp else '0' end,

				minu_tard_eas=case when fech_marc_rel!='' and hora_entr_rel!='' and ((fech_marc_rel||' '||hora_entr_rel)::timestamp>(fech_marc_rel||' '||hora_entrada)::timestamp) 
						then (fech_marc_rel||' '||hora_entr_rel)::timestamp-(fech_marc_rel||' '||hora_entrada)::timestamp else '0' end,

				minu_apor_eas=case when fech_marc_rel!='' and hora_entr_rel!='' and ((fech_marc_rel||' '||hora_entrada)::timestamp>(fech_marc_rel||' '||hora_entr_rel)::timestamp)
						then (fech_marc_rel||' '||hora_entrada)::timestamp-(fech_marc_rel||' '||hora_entr_rel)::timestamp else '0' end
				Where id=v_id_asistencia;
				
				--select count(*) into v_cant from asistencias where id_persona=entradas.id_persona and fech_marc_rel=entradas.dia;
				select count(*) into v_cant from asistencias where id_persona=entradas.id_persona and fech_regi_mar=entradas.dia;

				if v_cant = 0 then
				
					INSERT INTO asistencias(id_persona,fech_marc_rel,fech_sali_rel,hora_sali_rel,minu_tard_eas,minu_tole_eas,nume_bole_eas,fech_regi_mar,created_at,hora_entrada,hora_salida)
					values(entradas.id_persona,'',entradas.dia,entradas.hora,'0','0','-',p_fecha,now(),entradas.hora_entrada,entradas.hora_salida);
				end if;
				
			end if;

			if entradas.flag_dia = '2' then
			
				--select id into v_id_asistencia from asistencias where id_persona=entradas.id_persona and fech_marc_rel::date<entradas.dia::date order by fech_marc_rel::date desc limit 1;
				select id into v_id_asistencia from asistencias where id_persona=entradas.id_persona and fech_regi_mar::date<entradas.dia::date order by fech_regi_mar::date desc limit 1;
				
				UPDATE asistencias set fech_sali_rel=entradas.dia,hora_sali_rel=entradas.hora,updated_at=now() Where id=v_id_asistencia;

				UPDATE asistencias set 
				minu_dife_eas=case when (fech_sali_rel||' '||hora_sali_rel)::timestamp>(fech_marc_rel||' '||hora_entr_rel)::timestamp
						then (fech_sali_rel||' '||hora_sali_rel)::timestamp-(fech_marc_rel||' '||hora_entr_rel)::timestamp else '0' end,

				minu_tard_eas=case when fech_marc_rel!='' and hora_entr_rel!='' and ((fech_marc_rel||' '||hora_entr_rel)::timestamp>(fech_marc_rel||' '||hora_entrada)::timestamp) 
						then (fech_marc_rel||' '||hora_entr_rel)::timestamp-(fech_marc_rel||' '||hora_entrada)::timestamp else '0' end,

				minu_apor_eas=case when fech_marc_rel!='' and hora_entr_rel!='' and ((fech_marc_rel||' '||hora_entrada)::timestamp>(fech_marc_rel||' '||hora_entr_rel)::timestamp)
						then (fech_marc_rel||' '||hora_entrada)::timestamp-(fech_marc_rel||' '||hora_entr_rel)::timestamp else '0' end
				Where id=v_id_asistencia;
				
			end if;
			
			
		end if;
		
	End Loop;

	--select sp_crud_automatico_asistencia('06-01-2022','sigtp_prod15','5432','localhost','postgres','postgres');
	/*
	delete from asistencias where id_persona=44;
	
	select t1.id,t2.numero_documento,to_char(t1.time_second::timestamp,'dd-mm-yyyy') dia,to_char(t1.time_second::timestamp,'HH24:MI:SS') hora
	from zkteco_logs t1 
	inner join personas t2 on t1.pin::int=t2.id
	where t1.eventtype='0'
	And to_char(t1.created_at,'dd-mm-yyyy')='14-10-2021'
	And t2.numero_documento='44335974'
	order by t1.id asc
	*/
	return _fecha;	
	--return idp;
	/*EXCEPTION
	WHEN OTHERS THEN
        idp:=-1;
	return idp;*/
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION public.sp_crud_automatico_asistencia(character varying, character varying, character varying, character varying, character varying, character varying)
  OWNER TO postgres;

