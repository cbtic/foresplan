CREATE OR REPLACE FUNCTION public.sp_listar_persona_paginado(p_numero_documento character varying, p_persona character varying, p_unidad character varying, p_empresa character varying, p_estado character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
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
	
	v_campos=' p.id id_pe, pd.id id_pd, di.abre_docu_did tipo_documento, p.numero_documento, p.apellido_paterno||'' ''||p.apellido_materno||'' ''||p.nombres persona, 
				p.fecha_nacimiento, p.sexo, (select sp_crud_obtiene_tabla_deno (pd.id_cargo)) cargo, 
				(select sp_crud_obtiene_tabla_deno (pd.id_condicion_laboral)) condicion_laboral, 
				(select sp_crud_obtiene_tabla_deno (pd.id_regimen_pensionario)) regimen,
				(select sp_crud_obtiene_tabla_deno (pd.id_area_trabajo)) area_trabajo,
				(select sp_crud_obtiene_tabla_deno (pd.id_unidad_trabajo)) unidad_trabajo, 
				e.razon_social, pd.estado, c.mont_cont_ctr ';

	v_tabla=' from personas p 
				left join persona_detalles pd on pd.id_persona = p.id 
				left join documento_identidades di on di.id = p.tipo_documento 
				left join ubicacion_trabajos ut  on ut.id = pd.id_ubicacion 
				left join empresas e  on e.id = ut.id_empresa
				left join contratos c  on c.id = pd.id_contrato 
			';
	
			
	v_where = ' Where pd.eliminado = ''N'' ';

	If p_estado<>'' Then
	 v_where:=v_where||'And pd.estado = '''||p_estado||''' ';
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

	If p_unidad<>'' Then
	 v_where:=v_where||'And (select sp_crud_obtiene_tabla_deno (pd.id_unidad_trabajo)) ilike ''%'||p_unidad||'%'' ';
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
--select sp_listar_persona_paginado('','','A','1','10','ref_cursor')
$function$
;
