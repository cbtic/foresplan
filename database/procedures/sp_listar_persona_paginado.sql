CREATE OR REPLACE FUNCTION public.sp_listar_persona_paginado(p_numero_documento character varying, p_persona character varying, p_empresa character varying, p_estado character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
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
	
	v_campos=' p.id, t.denominacion tipo_documento , p.numero_documento, p.apellido_paterno||'' ''||p.apellido_materno||'' ''||p.nombres persona, 
				p.fecha_nacimiento, s.denominacion sexo, p.foto, p.estado ';

	v_tabla='  from personas p
				 inner join tabla_maestras t ON t.codigo = p.id_tipo_documento::text and t.tipo = ''9''
				 inner join tabla_maestras s ON s.codigo = p.id_sexo::text and s.tipo =  ''2''
			';
	
			
	v_where = ' Where 1 = 1 ';

	If p_estado<>'' Then
	 v_where:=v_where||'And p.estado = '''||p_estado||''' ';
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
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By  persona LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By  persona;'; 
	End If;
	
	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End
--select sp_listar_persona_paginado('','','','1','1','10','ref_cursor')
$function$
;
