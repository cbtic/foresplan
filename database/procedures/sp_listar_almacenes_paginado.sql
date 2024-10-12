CREATE OR REPLACE FUNCTION public.sp_listar_almacenes_paginado(p_denominacion character varying, p_encargado character varying, p_estado character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
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

	v_campos=' a2.id, a2.codigo,a2.denominacion, u.desc_ubigeo ubicacion , a2.direccion, a2.estado, 
	a2.encargado,a2.telefono  ';

	v_tabla=' from almacenes a2 
	inner join ubigeos u on a2.id_ubigeo = u.id_ubigeo  ';
	
	v_where = ' Where 1=1 ';

	If p_denominacion<>'' Then
	 v_where:=v_where||'And a2.denominacion ilike  ''%'||p_denominacion||'%'' ';
	End If;

	If p_encargado<>'' Then
	 v_where:=v_where||'And a2.encargado ilike  ''%'||p_encargado||'%'' ';
	End If;

	If p_estado<>'' Then
	 v_where:=v_where||'And a2.estado  = '''||p_estado||''' ';
	End If;
	
	
	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By a2.id LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By a2.id;'; 
	End If;

	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End
--select sp_listar_periodos_paginado('','','','','','1','10','ref');fetch all in ref
$function$
;
