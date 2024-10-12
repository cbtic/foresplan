CREATE OR REPLACE FUNCTION public.sp_listar_concepto_paginado(p_tipo character varying, p_denominacion character varying, p_estado character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
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

	v_campos=' c.id, t.tab_cort_des, c.codi_conc_tco, c.desc_conc_tco ';

	v_tabla='from conceptos c INNER JOIN tablas t on t.tab_ite1_cod = ''003'' AND trim (c.tipo_conc_tco) = trim(t.tab_ite2_cod)';

	v_where = ' Where 1=1 ';


	If p_tipo<>'' Then
	 --v_where:=v_where||' And codi_conc_tco like ''%'||p_tipo||'%'' ';
	End If;

	If p_denominacion<>'' Then
	 --v_where:=v_where||' And desc_conc_tco like ''%'||p_denominacion||'%'' ';
	End If;

	If p_estado<>'' Then
	 --v_where:=v_where||' And estado = '''||p_estado||''' ';
	End If;

	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By desc_conc_tco LIMIT '||p_limit||' OFFSET '||p_pagina||';';
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By desc_conc_tco asc;';
	End If;

	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End

$function$
;
