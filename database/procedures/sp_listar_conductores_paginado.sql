CREATE OR REPLACE FUNCTION public.sp_listar_conductores_paginado(
    p_estado character varying,
    p_tipo_documento character varying,
    p_numero_documento character varying,
    p_persona character varying,
    p_telefono character varying,
    p_email character varying,
    p_razon_social character varying,
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

	v_campos=' c.estado , p.tipo_documento, p.numero_documento, p.apellido_paterno || '' '' || p.apellido_materno || '' '' || p.nombres persona, p.telefono, p.email, e.razon_social ';

	v_tabla=' from conductores c inner join personas p on c.id_personas = p.id inner join empresas e on e.id = p.empresa_id ';

	v_where = ' Where ';

	If p_estado<>'' Then
	 v_where:=v_where||'c.estado = '''||p_estado||''' ';
	End If;
	v_where = ' Where ';

	If p_tipo_documento<>'' Then
	 v_where:=v_where||'p.tipo_documento = '''||p_tipo_documento||''' ';
	End If;
	v_where = ' Where ';

	If p_numero_documento<>'' Then
	 v_where:=v_where||'p.numero_documento = '''||p_numero_documento||''' ';
	End If;
	v_where = ' Where ';

	If p_persona<>'' Then
	 v_where:=v_where||'And p.apellido_paterno || '' '' || p.apellido_materno || '' '' || p.nombres persona ilike ''%'||p_persona||'%'' ';
	End If;

	If p_telefono<>'' Then
	 v_where:=v_where||'And p.telefono ilike ''%'||p_telefono||'%'' ';
	End If;

	If p_email<>'' Then
	 v_where:=v_where||'And p.email ilike ''%'||p_email||'%'' ';
	End If;

	If p_razon_social<>'' Then
	 v_where:=v_where||'And e.razon_social ilike ''%'||p_razon_social||'%'' ';
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
--select sp_listar_conductores_paginado('','','A','1','10','ref_cursor')
$function$
;
