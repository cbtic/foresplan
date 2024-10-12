CREATE OR REPLACE FUNCTION public.sp_listar_tabla_ubicaciones_paginado(
    p_id_cliente character varying,
    p_pagina character varying,
    p_limit character varying,
    p_ref refcursor)
  RETURNS refcursor AS
$BODY$

Declare
v_scad varchar;
v_campos varchar;
v_tabla varchar;
v_where varchar;
v_group varchar;
v_count varchar;
v_col_count varchar;

Begin

	p_pagina=(p_pagina::Integer-1)*p_limit::Integer;
	
	v_campos=' t1.id_cliente,t1.tabla,t1.columna_den columna,count(*) cantidad ';

	v_tabla=' from tabla_ubicaciones t1 ';
	
			
	v_where = ' where estado=''A''  ';

	If p_id_cliente<>'' Then
	 v_where:=v_where||'And id_cliente = '''||p_id_cliente||''' ';
	End If;

	v_group = ' group by t1.id_cliente,t1.tabla,t1.columna_den ';
	
	--EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	EXECUTE ('SELECT count(1) From (SELECT count(1) '||v_tabla||v_where||v_group||')R') INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||v_group||' Order By t1.tabla LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||v_group||' Order By t1.tabla;'; 
	End If;
	
	Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End

--select sp_listar_tabla_ubicaciones_paginado('1','1','10','ref');fetch all in ref;

$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
