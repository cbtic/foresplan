CREATE OR REPLACE FUNCTION public.sp_listar_entrada_producto_paginado(p_denominacion character varying, p_estado character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
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

	v_campos=' ep.id, ep.fecha_ingreso ingreso, tm.denominacion tipo_documento, tm2.denominacion unidad_origen, e.razon_social, ep.numero_comprobante, ep.fecha_comprobante, ep.estado ';

	v_tabla=' from entrada_productos ep 
	inner join tabla_maestras tm on ep.id_tipo_documento = tm.codigo ::int and tm.tipo = ''48''
	inner join tabla_maestras tm2 on ep.unidad_origen::int = tm2.codigo::int and tm2.tipo = ''50''
	inner join empresas e on ep.id_proveedor = e.id ';
	
	v_where = ' Where 1=1 ';

	/*If p_denominacion<>'' Then
	 v_where:=v_where||'And ep.denominacion ilike  ''%'||p_denominacion||'%'' ';
	End If;*/

	If p_estado<>'' Then
	 v_where:=v_where||'And ep.estado  = '''||p_estado||''' ';
	End If;
	
	
	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By ep.id desc LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By ep.id desc;'; 
	End If;

	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End
--select sp_listar_periodos_paginado('','','','','','1','10','ref');fetch all in ref
$function$
;
