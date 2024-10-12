
CREATE OR REPLACE FUNCTION public.sp_listar_ingreso_vehiculo_tronco_paginado(p_placa character varying, p_pagina character varying, p_limit character varying, p_ref refcursor)
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
--v_perfil varchar;

Begin

	p_pagina=(p_pagina::Integer-1)*p_limit::Integer;

	v_campos=' ivt.id,ivttm.id id_ingreso_vehiculo_tronco_tipo_maderas,ivt.fecha_ingreso,e.ruc,e.razon_social,v.placa,v.ejes,p.numero_documento,
p.apellido_paterno||'' ''||p.apellido_materno||'' ''||p.nombres conductor,
tm.denominacion tipo_madera,ivttm.cantidad ';

	v_tabla=' from ingreso_vehiculo_troncos ivt
inner join empresas e on ivt.id_empresa_transportista=e.id
inner join vehiculos v on ivt.id_vehiculos=v.id
inner join conductores c on ivt.id_conductores=c.id
inner join personas p on c.id_personas=p.id
inner join ingreso_vehiculo_tronco_tipo_maderas ivttm on ivt.id=ivttm.id_ingreso_vehiculo_troncos
inner join tabla_maestras tm on ivttm.id_tipo_maderas=tm.codigo::int and tm.tipo=''42'' ';

	v_where = ' where 1=1  ';
	/*
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
	*/

	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By ivt.id Desc LIMIT '||p_limit||' OFFSET '||p_pagina||';';
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By ivt.id Desc;';
	End If;

	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End
$function$
;

