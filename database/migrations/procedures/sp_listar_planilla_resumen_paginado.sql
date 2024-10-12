CREATE OR REPLACE FUNCTION public.sp_listar_planilla_resumen_paginado(
    p_persona character varying,
    p_id_periodo character varying,
    p_estado character varying,
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


v_fecha_desde varchar;
v_fecha_hasta varchar;
--v_fecha_ultimo varchar;

Begin
	
	p_pagina=(p_pagina::Integer-1)*p_limit::Integer;

	v_campos=' distinct t1.id
	,t3.abre_docu_did tipo_documento
	,t1.numero_documento
	,t1.apellido_paterno||'' ''||t1.apellido_materno||'' ''||t1.nombres persona
	,tp.desc_tipo_tpl planilla
	,sp.desc_subt_stp splanilla
	--,c.desc_conc_tco 
	,t5.razon_social
 	,pc.ano_peri_tpe anio
	,pc.nume_peri_tpe peri
	,pc.id_periodo 
	';

	v_tabla=' from resumenes pc 
	 		inner join tplanillas tp on tp.id = pc.id_planilla
	 		inner join subtplanillas sp  on sp.id = pc.id_subplanilla and sp.id_planilla = pc.id_planilla 
			inner join personas t1 on pc.id_persona=t1.id 
			left join persona_detalles t2 on t2.id_persona = t1.id and t2.eliminado = ''N'' and t2.estado = ''A''
			left join documento_identidades t3 on t3.id = t1.tipo_documento
			left join ubicacion_trabajos t4 on t4.id = pc.id_ubicacion 
			left join empresas t5 on t5.id = t4.id_empresa   
			';
			
	v_where = ' Where 1=1  and 
				pc.id_periodo =  '''||p_id_periodo::int||''' 

			';

	
	If p_estado<>'' Then
	/*	 			*/	
	End If;

	If p_persona<>'' Then
	 v_where:=v_where||'And t1.id = '||p_persona||' ';
	End If;

	EXECUTE ('SELECT count(1) '||v_tabla||v_where) INTO v_count;
	v_col_count:=' ,'||v_count||' as TotalRows ';

	If v_count::Integer > p_limit::Integer then
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By t1.id LIMIT '||p_limit||' OFFSET '||p_pagina||';'; 
	else
		v_scad:='SELECT '||v_campos||v_col_count||v_tabla||v_where||' Order By t1.id desc;'; 
	End If;
	
	Raise Notice '%',v_scad;
	Open p_ref For Execute(v_scad);
	Return p_ref;
-- SELECT sp_listar_planilla_paginado('','','','1','','1','100','ref'); fetch all in ref;
End
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
