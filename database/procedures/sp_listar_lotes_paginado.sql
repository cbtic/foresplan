CREATE OR REPLACE FUNCTION public.sp_listar_lotes_paginado(p_denominacion character varying, p_marca character varying, p_anaquel character varying, p_estado character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
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

	v_campos=' lp.id, p.denominacion producto, tm.denominacion marca, lp.numero_lote, lp.numero_serie, tm2.denominacion unidad_medida, lp.cantidad, lp.costo, tm3.denominacion moneda, lp.fecha_fabricacion, lp.fecha_vencimiento, a.codigo codigo_anaquel, a.denominacion anaquel, lp.estado ';

	v_tabla=' from lote_productos lp 
	inner join productos p on lp. id_producto = p.id 
	inner join anaqueles a on lp.id_anaquel = a.id
	left join tabla_maestras tm on lp.id_marca = tm.codigo::int and tm.tipo =''47''
	left join tabla_maestras tm2 on lp.id_unidad_medida = tm2.codigo::int and tm2.tipo =''43''
	left join tabla_maestras tm3 on lp.id_moneda = tm3.codigo::int and tm3.tipo =''1''';
	
	v_where = ' Where 1=1 ';

	If p_denominacion<>'' Then
	 v_where:=v_where||'And p.denominacion ilike  ''%'||p_denominacion||'%'' ';
	End If;

	If p_marca<>'' Then
	 v_where:=v_where||'And lp.id_marca =  '''||p_marca||''' ';
	End If;

	If p_anaquel<>'' Then
	 v_where:=v_where||'And a.denominacion ilike  ''%'||p_anaquel||'%'' ';
	End If;

	If p_estado<>'' Then
	 v_where:=v_where||'And lp.estado  = '''||p_estado||''' ';
	End If;
	
	
	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By lp.id desc LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By lp.id desc;'; 
	End If;

	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End
--select sp_listar_periodos_paginado('','','','','','1','10','ref');fetch all in ref
$function$
;
