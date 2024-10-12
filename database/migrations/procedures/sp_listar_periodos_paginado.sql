CREATE OR REPLACE FUNCTION public.sp_listar_periodos_paginado(p_id_ubicacion character varying, p_id_planilla character varying, p_id_subplanilla character varying, p_anio character varying, p_mes character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
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
	

	v_campos=' t1.id,t2.desc_tipo_tpl planilla,t3.desc_subt_stp subplanilla,t1.ano_peri_tpe anio,t4.nombre_mes mes,t1.fech_inic_tpe,t1.fech_fina_tpe,t1.desc_peri_tpe,t1.esta_plan_tpe,t6.razon_social empresa, t.tab_larg_des tipo_planilla';

	v_tabla=' from Tperiodos t1
		inner join tplanillas t2 on t2.id = t1.id_planilla
		inner join subtplanillas t3 on t3.id = t1.id_subplanilla and t3.id_planilla = t1.id_planilla
		inner join meses t4 on t1.id_mes=t4.id
		inner join ubicacion_trabajos t5 on t5.id = t1.id_ubicacion 
		inner join empresas t6 on t6.id = t5.id_empresa 
		left join tablas t on t.tab_ite1_cod =  ''004'' and t.tab_ite2_cod::int = t1.id_tipo_planilla ';
	
	v_where = ' Where 1=1 ';

	If p_id_planilla<>'' Then
	 v_where:=v_where||'And t1.id_planilla = '''||p_id_planilla||''' ';
	End If;

	If p_id_subplanilla<>'' Then
	 v_where:=v_where||'And t1.id_subplanilla = '''||p_id_subplanilla||''' ';
	End If;

	If p_id_ubicacion<>'' Then
	 v_where:=v_where||'And t1.id_ubicacion  = '''||p_id_ubicacion||''' ';
	End If;
	
	
	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By t1.id LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By t1.id;'; 
	End If;

	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End
--select sp_listar_periodos_paginado('','','','','','1','10','ref');fetch all in ref
$function$
;
