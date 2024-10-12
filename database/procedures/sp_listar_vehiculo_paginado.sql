CREATE OR REPLACE FUNCTION public.sp_listar_vehiculo_paginado(
p_placa character varying, p_ejes character varying, p_exonerado character varying, 
p_control character varying, p_bloqueado character varying, p_estado character varying, p_usuario_inserta character varying, p_fecha_inserta character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
 RETURNS refcursor
 LANGUAGE plpgsql
AS $function$
Declare
--v_id numeric;
--v_numinf character varying;
v_scad varchar;
v_campos varchar;
v_tabla varchar;
v_where varchar;
v_count varchar;
v_col_count varchar;
--v_perfil varchar;

Begin

	p_pagina=(p_pagina::Integer-1)*p_limit::Integer;
	
	v_campos=' t1.id,t1.placa,t1.ejes,t1.peso_tracto,t1.peso_carreta,t1.peso_seco,t1.exonerado,t1.control,t1.bloqueado,
	t2.name usuario_inserta,
	t1.estado ';

	v_tabla=' from vehiculos t1 
	inner join users t2 on t1.id_usuario_inserta=t2.id';
	
	v_where = ' where 1=1  ';
	
	If p_placa<>'' Then
	 v_where:=v_where||'And t1.placa = '''||p_placa||''' ';
	End If;

	If p_ejes<>'' Then
	 v_where:=v_where||'And t1.ejes = '''||p_ejes||''' ';
	End If;

	If p_exonerado<>'' Then
	 v_where:=v_where||'And t1.exonerado = '''||p_exonerado||''' ';
	End If;

	If p_control<>'' Then
	 v_where:=v_where||'And t1.control = '''||p_control||''' ';
	End If;

	If p_bloqueado<>'' Then
	 v_where:=v_where||'And t1.bloqueado = '''||p_bloqueado||''' ';
	End If;

	If p_estado<>'' Then
	 v_where:=v_where||'And t1.estado = '''||p_estado||''' ';
	End If;
	
	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By t1.id Desc LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By t1.id Desc;'; 
	End If;
	
	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End
$function$
;
