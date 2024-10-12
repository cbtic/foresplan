CREATE OR REPLACE FUNCTION public.sp_listar_papeleta_paginado(p_numero_documento character varying, p_persona character varying, p_tipo character varying, p_empresa character varying, p_estado character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
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

Begin

	p_pagina=(p_pagina::Integer-1)*p_limit::Integer;
	
	v_campos=' d.id, di.abre_docu_did tipo_documento, p.numero_documento, p.apellido_paterno||'' ''||p.apellido_materno||'' ''||p.nombres persona, (select sp_crud_obtiene_tabla_deno (d.id_tipo_operacion)) tipo_justificacion, d.nume_reso_ope, 
d.tipo_hora_ope, to_char(d.fech_inic_ope::timestamp,''dd/mm/yyyy'')fech_inic_ope, to_char(d.fech_fina_ope::timestamp,''dd/mm/yyyy'')fech_fina_ope, d.nume_dias_ope, to_char(d.fech_inic_ope::timestamp,''HH24:MI:SS'') horainicope, 
to_char(d.fech_fina_ope::timestamp,''HH24:MI:SS'') horafinaope, d.nume_minut_ope,
d.obse_oper_ope, '''' flag_omis_top,d.tipo_hora_ope, d.codi_relo_per, d.esta_oper_ope, d.obse_jefe_ope, d.obse_rrhh_ope, e.razon_social ';

	v_tabla=' from deta_operaciones d
			inner join personas p on p.id = d.id_persona
			inner join documento_identidades di on di.id = p.tipo_documento
			inner join persona_detalles pd on pd.id_persona = p.id
			inner join ubicacion_trabajos ut on ut.id = d.id_ubicacion 
			inner join empresas e on e.id = ut.id_empresa  ';
	
			
	v_where = ' Where d.eliminado = ''N'' ';

	If p_estado<>'' Then
	 v_where:=v_where||'And d.esta_oper_ope = '''||p_estado||''' ';
	End If;
	
	If p_numero_documento<>'' Then
	 v_where:=v_where||'And p.numero_documento ilike ''%'||p_numero_documento||'%'' ';
	End If;
	
	If p_persona<>'' Then
	 v_where:=v_where||'And p.apellido_paterno||'' ''||p.apellido_materno||'' ''||p.nombres ilike ''%'||p_persona||'%'' ';
	End If;

	If p_empresa<>'' Then
	 v_where:=v_where||'And e.razon_social ilike ''%'||p_empresa||'%'' ';
	End If;

	If p_tipo<>'' Then
	 v_where:=v_where||'And  (select sp_crud_obtiene_tabla_deno (d.id_tipo_operacion)) ilike ''%'||p_tipo||'%'' ';
	End If;

	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By e.razon_social, persona LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By e.razon_social, persona;'; 
	End If;
	
	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End
--select sp_listar_papeleta_paginado('','','','','A','1','10','ref_cursor')
$function$
;
