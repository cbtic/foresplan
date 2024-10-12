CREATE OR REPLACE FUNCTION public.sp_listar_tabla_maestra_paginado(
    p_tipo character varying,
    p_estado character varying,
    p_codigo character varying,
    p_tipo_nombre character varying,
    p_pagina character varying,
    p_limit character varying,
    p_ref refcursor)
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

	v_campos=' t.id, t.tipo, t.denominacion, t.orden ,t.estado, t.codigo, t.tipo_nombre ';

	v_tabla=' from tabla_maestras t';

	v_where = ' Where ';

	If p_estado<>'' Then
	 v_where:=v_where||'t.estado = '''||p_estado||''' ';
	End If;

	If p_tipo<>'' Then
	 v_where:=v_where||'And t.tipo ilike ''%'||p_tipo||'%'' ';
	End If;

	If p_codigo<>'' Then
	 v_where:=v_where||'And t.codigo ilike ''%'||p_codigo||'%'' ';
	End If;

	If p_tipo_nombre<>'' Then
	 v_where:=v_where||'And t.tipo_nombre ilike ''%'||p_tipo_nombre||'%'' ';
	End If;

	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By t.denominacion, tipo_nombre LIMIT '||p_limit||' OFFSET '||p_pagina||';';
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By t.denominacion, tipo_nombre;';
	End If;

	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End
--select sp_listar_tabla_maestra_paginado('','','A','1','10','ref_cursor')
$function$
;
