CREATE OR REPLACE FUNCTION public.sp_listar_tipo_cambio_paginado(p_fecha character varying,p_moneda_compra character varying,p_moneda_venta character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
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
	
	v_campos=' t1.id,to_char(t1.fecha,''dd/mm/yyyy'')fecha,t2.denominacion moneda_compra,
	t3.denominacion moneda_venta,t1.valor_venta,t1.valor_compra,t1.id_tipo_moneda_compra,t1.estado ';

	v_tabla='from tipo_cambios t1
inner join tabla_maestras t2 on t1.id_tipo_moneda_compra=t2.id and t2.tipo=''1''
inner join tabla_maestras t3 on t1.id_tipo_moneda_venta=t3.id and t3.tipo=''1''';
	
	v_where = ' Where t1.estado=''1'' ';
	
	If p_fecha<>'' Then
	 v_where:=v_where||'And to_char(t1.fecha,''dd/mm/yyyy'') = '''||p_fecha||''' ';
	End If;

	If p_moneda_compra<>'' Then
	 v_where:=v_where||'And t1.id_tipo_moneda_compra = '''||p_moneda_compra||''' ';
	End If;

	If p_moneda_venta<>'' Then
	 v_where:=v_where||'And t1.id_tipo_moneda_venta = '''||p_moneda_venta||''' ';
	End If;
	
	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By t2.orden Asc LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By t2.orden Asc;'; 
	End If;
	
	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End

$function$
;
