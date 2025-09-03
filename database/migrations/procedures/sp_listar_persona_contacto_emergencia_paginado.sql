-- DROP FUNCTION public.sp_listar_persona_paginado(varchar, varchar, varchar, varchar, varchar, varchar, varchar, refcursor);

CREATE OR REPLACE FUNCTION public.sp_listar_persona_contacto_emergencia_paginado(p_numero_documento character varying, p_persona character varying, p_estado character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
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
	
	v_campos=' pce.id, di.desc_docu_did tipo_documento, p.numero_documento, p.apellido_paterno ||'' ''|| p.apellido_materno ||'' ''|| p.nombres nombre_personal, pce.nombre_contacto, pce.celular_contacto, t.denominacion vinculo, pce.estado ';

	v_tabla=' from persona_contacto_emergencias pce 
	inner join personas p on pce.id_persona = p.id and p.estado = ''A''
	inner join documento_identidades di on p.tipo_documento = di.id 
	left join tabla_ubicaciones tu on tu.id=pce.id_vinculo and tabla = ''tvinculos''
	left join tvinculos t on tu.id_registro = t.id ';
	
	
	v_where = ' Where pce.estado = ''1'' ';

	If p_estado<>'' Then
	 v_where:=v_where||'And pce.estado = '''||p_estado||''' ';
	End If;
	
	If p_numero_documento<>'' Then
	 v_where:=v_where||'And p.numero_documento ilike ''%'||p_numero_documento||'%'' ';
	End If;
	
	If p_persona<>'' Then
	 v_where:=v_where||'And p.apellido_paterno||'' ''||p.apellido_materno||'' ''||p.nombres ilike ''%'||p_persona||'%'' ';
	End If;

	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By pce.id desc LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By pce.id desc;'; 
	End If;
	
	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End
--select sp_listar_persona_paginado('','','A','1','10','ref_cursor')
$function$
;
