CREATE OR REPLACE FUNCTION public.sp_listar_empresa_paginado(p_razon_social character varying, p_ruc character varying, p_estado character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
 RETURNS refcursor
 LANGUAGE plpgsql
AS $function$

Declare
--v_id numeric;
--v_numinf character varying;
v_scad varchar;
v_campos varchar;
v_tabla varchar;
v_where varchar;
v_count varchar;
v_col_count varchar;
--v_perfil varchar;

Begin

	p_pagina=(p_pagina::Integer-1)*p_limit::Integer;
	
	v_campos=' e.id, e.ruc, e.nombre_comercial, e.razon_social, e.direccion, e.email, e.telefono, e.representante, e.estado ';

	v_tabla='from empresas e';
	
	v_where = ' Where 1=1  ';
	
	If p_ruc<>'' Then
	 v_where:=v_where||'And e.ruc ilike ''%'||p_ruc||'%'' ';
	End If;
	
	If p_razon_social<>'' Then
	 v_where:=v_where||'And e.razon_social ilike ''%'||p_razon_social||'%'' ';
	End If;

	If p_estado<>'' Then
	 v_where:=v_where||'And e.estado = '''||p_estado||''' ';
	End If;
	
	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By e.id Desc LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By e.id Desc;'; 
	End If;
	
	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End

$function$
;
