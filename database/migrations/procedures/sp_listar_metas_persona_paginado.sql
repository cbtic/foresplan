CREATE OR REPLACE FUNCTION public.sp_listar_metas_persona_paginado(
    p_id_ubicacion character varying,
    p_id_planilla character varying,
    p_id_subplanilla character varying,
    p_anio character varying,
    p_mes character varying,
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
v_count varchar;
v_col_count varchar;

Begin

	p_pagina=(p_pagina::Integer-1)*p_limit::Integer;

	if((select count(*) from meta_personas where id_ubicacion=p_id_ubicacion::int and id_planilla=p_id_planilla::int and id_subplanilla=p_id_subplanilla::int and anno_ejec_eje=p_anio)=0) Then
	
		v_campos=' 1 opc,t2.id_persona,t6.id_registro id_planilla,t2.id_ubicacion,t3.abre_docu_did tipo_documento,t1.numero_documento,t1.apellido_paterno||'' ''||t1.apellido_materno||'' ''||t1.nombres persona, 
					(select sp_crud_obtiene_tabla_deno (t2.id_condicion_laboral)) condicion_laboral, 
					(select sp_crud_obtiene_tabla_deno (t2.id_regimen_pensionario)) regimen,
					(select sp_crud_obtiene_tabla_deno (t2.id_area_trabajo)) area_trabajo,
					(select sp_crud_obtiene_tabla_deno (t2.id_unidad_trabajo)) unidad_trabajo,
					t5.razon_social ';

		v_tabla=' from personas t1 
					inner join persona_detalles t2 on t2.id_persona = t1.id 
					inner join documento_identidades t3 on t3.id = t1.tipo_documento 
					inner join ubicacion_trabajos t4  on t4.id = t2.id_ubicacion 
					inner join empresas t5 on t5.id = t4.id_empresa 
					inner join tabla_ubicaciones t6 on t6.id = t2.id_tipo_planilla 
					';
		
		v_where = ' Where t2.eliminado = ''N'' ';

		If p_id_planilla<>'' Then
		 v_where:=v_where||'And t6.id_registro = '''||p_id_planilla||''' ';
		End If;

		If p_id_ubicacion<>'' Then
		 v_where:=v_where||'And t2.id_ubicacion = '''||p_id_ubicacion||''' ';
		End If;
		
	else

		v_campos=' 1 opc,t2.id_persona,t0.id_planilla,t2.id_ubicacion,t3.abre_docu_did tipo_documento,t1.numero_documento,t1.apellido_paterno||'' ''||t1.apellido_materno||'' ''||t1.nombres persona, 
					(select sp_crud_obtiene_tabla_deno (t2.id_condicion_laboral)) condicion_laboral, 
					(select sp_crud_obtiene_tabla_deno (t2.id_regimen_pensionario)) regimen,
					(select sp_crud_obtiene_tabla_deno (t2.id_area_trabajo)) area_trabajo,
					(select sp_crud_obtiene_tabla_deno (t2.id_unidad_trabajo)) unidad_trabajo,
					t5.razon_social ';

		v_tabla=' from meta_personas t0
					inner join personas t1 on t0.id_persona=t1.id
					inner join persona_detalles t2 on t2.id_persona = t1.id 
					inner join documento_identidades t3 on t3.id = t1.tipo_documento 
					inner join ubicacion_trabajos t4  on t4.id = t0.id_ubicacion 
					inner join empresas t5 on t5.id = t4.id_empresa 
					';
		
		v_where = ' Where t2.eliminado = ''N'' ';

		If p_id_planilla<>'' Then
		 v_where:=v_where||'And t0.id_planilla = '''||p_id_planilla||''' ';
		End If;

		If p_id_subplanilla<>'' Then
		 v_where:=v_where||'And t0.id_subplanilla = '''||p_id_subplanilla||''' ';
		End If;

		If p_id_ubicacion<>'' Then
		 v_where:=v_where||'And t0.id_ubicacion  = '''||p_id_ubicacion||''' ';
		End If;
	
	End If;
	
	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By t5.razon_social, persona LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By t5.razon_social, persona;'; 
	End If;

	--Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
End
--select sp_listar_metas_persona_paginado('473','','','','','','','','','1','10','ref');fetch all in ref
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION public.sp_listar_metas_persona_paginado(character varying, character varying, character varying, character varying, character varying, character varying, character varying, refcursor)
  OWNER TO postgres;
