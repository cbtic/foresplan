CREATE OR REPLACE FUNCTION public.sp_listar_anaqueles_paginado(p_denominacion character varying, p_codigo character varying, p_estado character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
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

begin
	
	p_pagina=(p_pagina::Integer-1)*p_limit::Integer;

	v_campos=' a.id, a.codigo, a.denominacion, a.estado, a2.denominacion almacen';

	v_tabla=' from anaqueles a 
	left join almacenes a2 on a.id_almacen=a2.id';
	
	v_where = ' Where 1=1 ';

	If p_denominacion<>'' Then
	 v_where:=v_where||'And a.denominacion ilike  ''%'||p_denominacion||'%'' ';
	End If;

	If p_codigo<>'' Then
	 v_where:=v_where||'And a.codigo =  '''||p_codigo||''' ';
	End If;

	If p_estado<>'' Then
	 v_where:=v_where||'And a.estado  = '''||p_estado||''' ';
	End If;
	
	
	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By a.id desc LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By a.id desc;'; 
	End If;

	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End
--select sp_listar_periodos_paginado('','','','','','1','10','ref');fetch all in ref
$function$
;
