CREATE OR REPLACE FUNCTION public.sp_listar_asistencia_paginado(
    p_area character varying,
    p_unidad character varying,
    p_persona character varying,
    p_anio character varying,
    p_mes character varying,
    p_estado character varying,
    p_pagina character varying,
    p_limit character varying,
    p_ref refcursor)
  RETURNS refcursor AS
$BODY$

Declare
v_scad varchar;
v_campos varchar;
v_tabla varchar;
v_where varchar;
v_count varchar;
v_col_count varchar;


v_fecha_desde varchar;
v_fecha_hasta varchar;
--v_fecha_ultimo varchar;

Begin

	v_fecha_desde=p_anio||'-'||p_mes||'-01';
	--v_fecha_hasta='2021-10-31';
	--v_fecha_hasta='2021-10-31';
	
	select last_day_month(p_anio::int,p_mes::int) into v_fecha_hasta;

	DROP TABLE IF EXISTS tmp_fechas;
	create temp table tmp_fechas as
	select fecha_dias::date from generate_series(v_fecha_desde::date, v_fecha_hasta::date, '1 day'::interval) fecha_dias;
	
	p_pagina=(p_pagina::Integer-1)*p_limit::Integer;

	v_campos=' t1.id id_pe, to_char(fecha_dias,''dd-mm-yyyy'')fecha_dias,
	case 
		when extract(dow from fecha_dias::date)::int=0 then ''Dom'' 
		when extract(dow from fecha_dias::date)::int=1 then ''Lun'' 
		when extract(dow from fecha_dias::date)::int=2 then ''Mar'' 
		when extract(dow from fecha_dias::date)::int=3 then ''Mie'' 
		when extract(dow from fecha_dias::date)::int=4 then ''Jue'' 
		when extract(dow from fecha_dias::date)::int=5 then ''Vie'' 
		when extract(dow from fecha_dias::date)::int=6 then ''Sab'' 
	end dia
	,(select flag_labo_dtu from detalle_turnos where id_turno=t6.id_turno And nume_ndia_dtu::int=case when extract(dow from fecha_dias::date)::int=0 then 7 else extract(dow from fecha_dias::date)::int end)flag_labo_dtu
	,(select to_char(hora_entr_dtu::timestamp,''HH24:MI'')hora_entr_dtu from detalle_turnos where id_turno=t6.id_turno And nume_ndia_dtu::int=case when extract(dow from fecha_dias::date)::int=0 then 7 else extract(dow from fecha_dias::date)::int end)hora_entr_dtu
	,(select to_char(hora_sali_dtu::timestamp,''HH24:MI'')hora_sali_dtu from detalle_turnos where id_turno=t6.id_turno And nume_ndia_dtu::int=case when extract(dow from fecha_dias::date)::int=0 then 7 else extract(dow from fecha_dias::date)::int end)hora_sali_dtu
	,t2.id id_pd, t3.abre_docu_did tipo_documento, t1.numero_documento, t1.apellido_paterno||'' ''||t1.apellido_materno||'' ''||t1.nombres persona, 
				t1.fecha_nacimiento, t1.sexo, (select sp_crud_obtiene_tabla_deno (t2.id_cargo)) cargo, t7.nomb_desc_tur turno,
				(select sp_crud_obtiene_tabla_deno (t2.id_condicion_laboral)) condicion_laboral, 
				(select sp_crud_obtiene_tabla_deno (t2.id_regimen_pensionario)) regimen,
				(select sp_crud_obtiene_tabla_deno (t2.id_area_trabajo)) area_trabajo,
				(select sp_crud_obtiene_tabla_deno (t2.id_unidad_trabajo)) unidad_trabajo, 
				t5.razon_social, t2.estado,
				(select min(fech_marc_rel) from asistencias t1_ where t1_.id_persona=t1.id and t1_.fech_regi_mar=to_char(fecha_dias::date,''dd-mm-yyyy''))fech_marc_rel,
				(select to_char(min(hora_entr_rel)::time,''HH24:MI'') from asistencias t1_ where t1_.id_persona=t1.id and t1_.fech_regi_mar=to_char(fecha_dias::date,''dd-mm-yyyy''))hora_entr_rel,
				(select max(fech_sali_rel) from asistencias t1_ where t1_.id_persona=t1.id and t1_.fech_regi_mar=to_char(fecha_dias::date,''dd-mm-yyyy''))fech_sali_rel,
				(select to_char(max(hora_sali_rel)::time,''HH24:MI'') from asistencias t1_ where t1_.id_persona=t1.id and t1_.fech_regi_mar=to_char(fecha_dias::date,''dd-mm-yyyy''))hora_sali_rel,
				(select to_char(
				max(fech_sali_rel||'' ''||hora_sali_rel)::timestamp
				-
				min(fech_marc_rel||'' ''||hora_entr_rel)::timestamp
				,''HH24:MI'')
				from asistencias t1_ where t1_.id_persona=t1.id and t1_.fech_marc_rel=to_char(fecha_dias::date,''dd-mm-yyyy''))tiempo_trabajado,
				(select min(id_deta_operacion) from asistencias t1_ where t1_.id_persona=t1.id and t1_.fech_marc_rel=to_char(fecha_dias::date,''dd-mm-yyyy''))id_deta_operacion,
				(select min(id) from asistencias t1_ where t1_.id_persona=t1.id and t1_.fech_marc_rel=to_char(fecha_dias::date,''dd-mm-yyyy''))id_asistencia,
				(select to_char(
				max(fech_sali_rel||'' ''||hora_salida)::timestamp
				-
				min(fech_marc_rel||'' ''||hora_entrada)::timestamp
				,''HH24:MI'')
				from asistencias t1_ where t1_.id_persona=t1.id and t1_.fech_marc_rel=to_char(fecha_dias::date,''dd-mm-yyyy''))tiempo_programado
				';
	
	v_tabla=' from personas t1 
			left join persona_detalles t2 on t2.id_persona = t1.id 
			left join documento_identidades t3 on t3.id = t1.tipo_documento 
			left join ubicacion_trabajos t4 on t4.id = t2.id_ubicacion 
			left join empresas t5 on t5.id = t4.id_empresa 
			left join personal_turnos t6 on t6.id_persona=t2.id_persona
			left join tturnos t7 on t6.id_turno=t7.id
			,tmp_fechas
			';
	
			
	v_where = ' Where 1=1 ';


	
	/*
	v_campos=' t2.apellido_paterno||'' ''||t2.apellido_materno||'' ''||t2.nombres as persona,t2.numero_documento,
	(select sp_crud_obtiene_tabla_deno (t3.id_area_trabajo)) area_trabajo,
	(select sp_crud_obtiene_tabla_deno (t3.id_unidad_trabajo)) unidad_trabajo, 
	t1.* ';

	v_tabla=' from asistencias t1
		inner join personas t2 on t2.id=t1.id_persona 
		left join persona_detalles t3 on t3.id_persona = t2.id
		,tmp_fechas 
';
	
			
	v_where = ' Where t2.estado = ''A'' ';
	*/

	
	If p_estado<>'' Then
	 --v_where:=v_where||'And pd.estado = '''||p_estado||''' ';
	End If;

	If p_persona<>'' Then
	 v_where:=v_where||'And t1.id = '||p_persona||' ';
	End If;

	If p_area<>'' Then
	 v_where:=v_where||'And t2.id_area_trabajo = '''||p_area||''' ';
	End If;
	
	If p_unidad<>'' Then
	 --v_where:=v_where||'And (select sp_crud_obtiene_tabla_deno (pd.id_unidad_trabajo)) ilike ''%'||p_unidad||'%'' ';
	 v_where:=v_where||'And t2.id_unidad_trabajo = '''||p_unidad||''' ';
	End If;


	/*
	If p_anio<>'' Then
	 v_where:=v_where||'And to_char(t1.fech_marc_rel::date,''YYYY'') = '''||p_anio||''' ';
	End If;

	If p_mes<>'' Then
	 v_where:=v_where||'And to_char(t1.fech_marc_rel::date,''MM'')::int = '''||p_mes||''' ';
	End If;
	*/
	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By t1.id desc LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By t1.id desc;'; 
	End If;
	
	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
