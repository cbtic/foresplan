CREATE OR REPLACE FUNCTION public.sp_listar_asistencia_resumen_paginado(p_area character varying, p_unidad character varying, p_persona character varying, p_anio character varying, p_mes character varying, p_estado character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
 RETURNS refcursor
 LANGUAGE plpgsql
AS $function$

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

	DROP TABLE IF EXISTS tmp_fecha_personas;
	create temp table tmp_fecha_personas as
	select fecha_dias,t1.id id_persona
	from personas t1 
	left join persona_detalles t2 on t2.id_persona = t1.id 
	,tmp_fechas
	order by t1.id asc,fecha_dias asc;
	
	p_pagina=(p_pagina::Integer-1)*p_limit::Integer;

	v_campos=' distinct t1.id id_pe

--	,flag_labo_dtu 
--	,to_char(hora_entr_dtu::timestamp,''HH24:MI'')hora_entr_dtu
--	,to_char(hora_sali_dtu::timestamp,''HH24:MI'')hora_sali_dtu
	,t2.id id_pd
	,t3.abre_docu_did tipo_documento
	,t1.numero_documento
	,t1.apellido_paterno||'' ''||t1.apellido_materno||'' ''||t1.nombres persona
	,t1.fecha_nacimiento
	,t1.sexo
	,(select sp_crud_obtiene_tabla_deno (t2.id_cargo)) cargo
	,(select sp_crud_obtiene_tabla_deno (t2.id_condicion_laboral)) condicion_laboral, 
	(select sp_crud_obtiene_tabla_deno (t2.id_regimen_pensionario)) regimen
	,(select sp_crud_obtiene_tabla_deno (t2.id_area_trabajo)) area_trabajo
	,(select sp_crud_obtiene_tabla_deno (t2.id_unidad_trabajo)) unidad_trabajo
	,t5.razon_social
	,t2.estado
--	,fech_marc_rel
--	,to_char(hora_entr_rel::time,''HH24:MI'')hora_entr_rel
--	,fech_sali_rel
--	,to_char(hora_sali_rel::time,''HH24:MI'')hora_sali_rel
	,minu_dife_eas tiempo_trabajado
	,t9.id id_asistencia
	';

	v_tabla=' from tmp_fecha_personas t0
			inner join personas t1 on t0.id_persona=t1.id 
			left join persona_detalles t2 on t2.id_persona = t1.id
			left join documento_identidades t3 on t3.id = t1.tipo_documento
			left join asistencias t9 on t9.id_persona=t1.id
			left join ubicacion_trabajos t4 on t4.id = t9.id_ubicacion 
			left join empresas t5 on t5.id = t4.id_empresa   
			';
			
	v_where = ' Where 1=1 ';

	
	If p_estado<>'' Then
/*	 		
		If p_estado='1' Then
			v_where:=v_where||'And fech_marc_rel!='''' And fech_sali_rel!='''' 
			And (case when (to_char((fech_sali_rel||'' ''||hora_sali_rel)::timestamp-(fech_marc_rel||'' ''||hora_entr_rel)::timestamp,''HH24:MI''))!='''' 
			then (((fech_sali_rel||'' ''||hora_sali_rel)::timestamp-(fech_marc_rel||'' ''||hora_entr_rel)::timestamp)::TIME 
			+ (case when minu_tard_eas!=''0'' then to_char(minu_tard_eas::time,''HH24:MI'') else ''00:00'' end)::TIME::INTERVAL 
			+ ''00:01''::TIME::INTERVAL) else ''00:00'' end)::time >= 
			(case when hora_salida!='''' then to_char((fech_sali_rel||'' ''||hora_salida)::timestamp-(fech_marc_rel||'' ''||hora_entrada)::timestamp,''HH24:MI'') end)::time ';
		End If;

		If p_estado='2' Then
			v_where:=v_where||'And fech_marc_rel!='''' And fech_sali_rel!='''' 
			And (case when (to_char((fech_sali_rel||'' ''||hora_sali_rel)::timestamp-(fech_marc_rel||'' ''||hora_entr_rel)::timestamp,''HH24:MI''))!='''' 
			then (((fech_sali_rel||'' ''||hora_sali_rel)::timestamp-(fech_marc_rel||'' ''||hora_entr_rel)::timestamp)::TIME 
			+ (case when minu_tard_eas!=''0'' then to_char(minu_tard_eas::time,''HH24:MI'') else ''00:00'' end)::TIME::INTERVAL 
			+ ''00:01''::TIME::INTERVAL) else ''00:00'' end)::time < 
			(case when hora_salida!='''' then to_char((fech_sali_rel||'' ''||hora_salida)::timestamp-(fech_marc_rel||'' ''||hora_entrada)::timestamp,''HH24:MI'') end)::time ';
		End If;

		If p_estado='3' Then
			v_where:=v_where||'And flag_labo_dtu=''S'' And (coalesce(fech_marc_rel,'''')='''' Or coalesce(fech_sali_rel,'''')='''')  ';
		End If;
	*/	
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


	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By t1.id LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By t1.id desc;'; 
	End If;
	
	Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End
$function$
;
