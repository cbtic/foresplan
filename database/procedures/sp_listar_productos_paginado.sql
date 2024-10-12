CREATE OR REPLACE FUNCTION public.sp_listar_productos_paginado(p_serie character varying, p_denominacion character varying, p_codigo character varying, p_estado_bien character varying, p_estado character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
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

	v_campos=' p.id, p.numero_serie, p.codigo, p.denominacion, tm.denominacion unidad_medida, p.stock_actual stock, p.fecha_vencimiento, tm2.denominacion estado_bien, p.stock_minimo, p.stock_actual, p.estado ';

	v_tabla=' from productos p 
	left join tabla_maestras tm on p.id_unidad_medida = tm.codigo::int and tm.tipo =''43''
	left join tabla_maestras tm2 on p.id_estado_bien = tm2.codigo::int and tm2.tipo =''4''';
	
	v_where = ' Where 1=1 ';

	If p_serie<>'' Then
	 v_where:=v_where||'And p.numero_serie =  '''||p_serie||''' ';
	End If;

	If p_estado_bien<>'' Then
	 v_where:=v_where||'And p.id_estado_bien =  '''||p_estado_bien||''' ';
	End If;

	If p_denominacion<>'' Then
	 v_where:=v_where||'And p.denominacion ilike  ''%'||p_denominacion||'%'' ';
	End If;

	If p_codigo<>'' Then
	 v_where:=v_where||'And p.codigo =  '''||p_codigo||''' ';
	End If;

	If p_estado<>'' Then
	 v_where:=v_where||'And p.estado  = '''||p_estado||''' ';
	End If;
	
	
	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By p.id desc LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By p.id desc;'; 
	End If;

	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End
--select sp_listar_periodos_paginado('','','','','','1','10','ref');fetch all in ref
$function$
;
