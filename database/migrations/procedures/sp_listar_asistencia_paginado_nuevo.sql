CREATE OR REPLACE FUNCTION public.sp_listar_asistencia_paginado_nuevo(p_area character varying, p_unidad character varying, p_persona character varying, p_anio character varying, p_mes character varying, p_fecha_ini character varying, p_fecha_fin character varying, p_sede character varying, p_condicion_laboral character varying, p_id_user character varying, p_estado character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
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
v_id_rol_admin integer;

v_fecha_desde varchar;
v_fecha_hasta varchar;
--v_fecha_ultimo varchar;

Begin

	select role_id into v_id_rol_admin from model_has_roles mhr where mhr.model_id::varchar=p_id_user and mhr.role_id in ('1','4','5');
	
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
	left join persona_detalles t2 on t2.id_persona = t1.id and t2.estado = 'A'
	,tmp_fechas
	order by t1.id asc,fecha_dias asc;

	DROP TABLE IF EXISTS tmp_turno_fecha_personas;
	create temp table tmp_turno_fecha_personas as
	select t6.id_persona,t8.nume_ndia_dtu,flag_labo_dtu,hora_entr_dtu,hora_sali_dtu
	from personal_turnos t6 
	inner join tturnos t7 on t6.id_turno=t7.id and t7.deleted_at is null
	inner join detalle_turnos t8 on t8.id_turno=t7.id
	where t6.deleted_at is null 
	and t6.id_persona is not null 
	and t6.id_persona in (select distinct id_persona from tmp_fecha_personas)
	order by t6.id_persona asc, t8.nume_ndia_dtu asc;
	
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
	,coalesce(t9.flag_labo_dtu,t8.flag_labo_dtu)flag_labo_dtu
	,case 	when t9.hora_entrada!='''' and t9.hora_entrada is not null then to_char(t9.hora_entrada::time,''HH24:MI'') 
		when t8.hora_entr_dtu!='''' and t8.hora_entr_dtu is not null then to_char(t8.hora_entr_dtu::timestamp,''HH24:MI'') 
		else '''' 
	end hora_entr_dtu
	,case 	when t9.hora_salida!='''' and t9.hora_salida is not null then to_char(t9.hora_salida::time,''HH24:MI'') 
		when t8.hora_sali_dtu!='''' and t8.hora_sali_dtu is not null then to_char(t8.hora_sali_dtu::timestamp,''HH24:MI'') 
		else '''' 
	end hora_sali_dtu
	,t2.id id_pd, t3.abre_docu_did tipo_documento, t1.numero_documento, t1.apellido_paterno||'' ''||t1.apellido_materno||'' ''||t1.nombres persona, 
	t1.fecha_nacimiento, t1.sexo, (select sp_crud_obtiene_tabla_deno (t2.id_cargo)) cargo, /*t7.nomb_desc_tur turno,*/
	(select sp_crud_obtiene_tabla_deno (t2.id_condicion_laboral)) condicion_laboral, 
	(select sp_crud_obtiene_tabla_deno (t2.id_regimen_pensionario)) regimen,
	(select sp_crud_obtiene_tabla_deno (t2.id_area_trabajo)) area_trabajo,
	(select sp_crud_obtiene_tabla_deno (t2.id_unidad_trabajo)) unidad_trabajo, 
	t5.razon_social, t2.estado,
	fech_marc_rel,to_char(hora_entr_rel::time,''HH24:MI'')hora_entr_rel,
	fech_sali_rel,to_char(hora_sali_rel::time,''HH24:MI'')hora_sali_rel,
	--to_char((fech_sali_rel||'' ''||hora_sali_rel)::timestamp-(fech_marc_rel||'' ''||hora_entr_rel)::timestamp,''HH24:MI'')tiempo_trabajado,
    minu_dife_eas tiempo_trabajado,
	t9.id_deta_operacion, tj.desc_just_jus, t9.id id_asistencia,
	case when fech_sali_rel!='''' and hora_salida!='''' and fech_marc_rel!='''' and hora_entrada!='''' then to_char((fech_sali_rel||'' ''||hora_salida)::timestamp-(fech_marc_rel||'' ''||hora_entrada)::timestamp,''HH24:MI'') end tiempo_programado,
	case when minu_tard_eas!=''0'' then to_char(minu_tard_eas::time,''HH24:MI'') else ''00:00'' end minu_tard_eas,

	case when (coalesce(fech_sali_rel,'''')!='''' and coalesce(hora_sali_rel,'''')!=''''
	and coalesce(fech_marc_rel,'''')!='''' and coalesce(hora_entr_rel,'''')!=''''
	and (fech_sali_rel||'' ''||hora_sali_rel)::timestamp>(fech_marc_rel||'' ''||hora_entr_rel)::timestamp
	) 
		then ((to_char((fech_sali_rel||'' ''||hora_sali_rel)::timestamp-(fech_marc_rel||'' ''||hora_entr_rel)::timestamp,''HH24:MI''))::TIME 
		+ (case when minu_tard_eas!=''0'' then to_char(minu_tard_eas::time,''HH24:MI'') else ''00:00'' end)::TIME::INTERVAL 
		+ ''00:01''::TIME::INTERVAL) else ''00:00'' end as tiempo_trabajado_total, 

	t9.tipo_marc_eas, t9.hora_marc_eas||'' ''||t9.hora_marc_sal hora_permiso, t9.minu_dife_pap
	';

	v_tabla=' from tmp_fecha_personas t0
			inner join personas t1 on t0.id_persona=t1.id
			left join persona_detalles t2 on t2.id_persona = t1.id and t2.estado = ''A'' 
			left join documento_identidades t3 on t3.id = t1.tipo_documento 
			left join ubicacion_trabajos t4 on t4.id = t2.id_ubicacion 
			left join empresas t5 on t5.id = t4.id_empresa 

			--left join personal_turnos t6 on t6.id_persona=t2.id_persona and t6.deleted_at is null 
			--left join tturnos t7 on t6.id_turno=t7.id and t7.deleted_at is null
			--left join detalle_turnos t8 on t8.id_turno=t7.id And t8.nume_ndia_dtu::int=case when extract(dow from fecha_dias::date)::int=0 then 7 else extract(dow from fecha_dias::date)::int end

			left join tmp_turno_fecha_personas t8 on t2.id_persona=t8.id_persona and t8.nume_ndia_dtu::int=case when extract(dow from fecha_dias::date)::int=0 then 7 else extract(dow from fecha_dias::date)::int end
			
			left join asistencias t9 on t9.id_persona=t1.id And t9.fech_regi_mar=to_char(fecha_dias::date,''dd-mm-yyyy'')
			left join deta_operaciones deo on t9.id_deta_operacion = deo.id
			left join tabla_ubicaciones tu on deo.id_tipo_operacion = tu.id
			left join tipo_justificaciones tj on tu.id_registro = tj.id
			';
			
	v_where = ' Where 1=1 ';

	If p_persona<>'' Then
	 v_where:=v_where||'And t1.id = '||p_persona||' ';
	End If;
	

	If p_fecha_ini<>'' Then
	 v_where:=v_where||'And t9.fech_regi_mar::date >= '''||p_fecha_ini||' :00:00:00'' ';
	End If;
	
	If p_fecha_fin<>'' Then
	 v_where:=v_where||'And t9.fech_regi_mar::date <= '''||p_fecha_fin||' :23:59'' ';
	End If;
	

	If p_estado<>'' Then
	 		
		If p_estado='1' Then
			v_where:=v_where||'And coalesce(fech_marc_rel,'''')!='''' And coalesce(fech_sali_rel,'''')!=''''  
			And (case when (to_char((fech_sali_rel||'' ''||hora_sali_rel)::timestamp-(fech_marc_rel||'' ''||hora_entr_rel)::timestamp,''HH24:MI''))!='''' 
			then (((fech_sali_rel||'' ''||hora_sali_rel)::timestamp-(fech_marc_rel||'' ''||hora_entr_rel)::timestamp)::TIME 
			+ (case when minu_tard_eas!=''0'' then to_char(minu_tard_eas::time,''HH24:MI'') else ''00:00'' end)::TIME::INTERVAL 
			+ ''00:01''::TIME::INTERVAL) else ''00:00'' end)::time >= 
			(case when fech_marc_rel!='''' and hora_salida!='''' then to_char((fech_sali_rel||'' ''||hora_salida)::timestamp-(fech_marc_rel||'' ''||hora_entrada)::timestamp,''HH24:MI'') end)::time ';

		End If;

		If p_estado='2' Then
			v_where:=v_where||'And coalesce(fech_marc_rel,'''')!='''' And coalesce(fech_sali_rel,'''')!='''' 
			And (case when (to_char((fech_sali_rel||'' ''||hora_sali_rel)::timestamp-(fech_marc_rel||'' ''||hora_entr_rel)::timestamp,''HH24:MI''))!='''' 
			then (((fech_sali_rel||'' ''||hora_sali_rel)::timestamp-(fech_marc_rel||'' ''||hora_entr_rel)::timestamp)::TIME 
			+ (case when minu_tard_eas!=''0'' then to_char(minu_tard_eas::time,''HH24:MI'') else ''00:00'' end)::TIME::INTERVAL 
			+ ''00:01''::TIME::INTERVAL) else ''00:00'' end)::time < 
			(case when fech_marc_rel!='''' and hora_salida!='''' then to_char((fech_sali_rel||'' ''||hora_salida)::timestamp-(fech_marc_rel||'' ''||hora_entrada)::timestamp,''HH24:MI'') end)::time ';
		End If;

		If p_estado='3' Then
			v_where:=v_where||'And coalesce(t9.flag_labo_dtu,t8.flag_labo_dtu)=''S'' And (coalesce(fech_marc_rel,'''')='''' Or coalesce(fech_sali_rel,'''')='''')  ';
		End If;
		
	End If;

	If p_area<>'' Then
	 v_where:=v_where||'And t2.id_area_trabajo = '''||p_area||''' ';
	End If;
	
	If p_unidad<>'' Then
	 --v_where:=v_where||'And (select sp_crud_obtiene_tabla_deno (pd.id_unidad_trabajo)) ilike ''%'||p_unidad||'%'' ';
	 v_where:=v_where||'And t2.id_unidad_trabajo = '''||p_unidad||''' ';
	End If;

	If p_sede<>'' Then
	 v_where:=v_where||'And t2.id_sede = '''||p_sede||''' ';
	End If;

	If v_id_rol_admin=4 Then 
		v_where:=v_where||'And t2.id_sede = ''722'' ';
	End If;

	If v_id_rol_admin=5 Then 
		v_where:=v_where||'And t2.id_sede = ''721'' ';
	End If;

	If p_condicion_laboral<>'' Then
	 v_where:=v_where||'And t2.id_condicion_laboral = '''||p_condicion_laboral||''' ';
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
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By fecha_dias asc, t1.id desc LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By fecha_dias asc, t1.id desc;'; 
	End If;
	
	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End
$function$
;
