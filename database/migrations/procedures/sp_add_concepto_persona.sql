CREATE OR REPLACE FUNCTION public.sp_add_concepto_persona(p_id_periodo character varying,p_id_persona character varying)
 RETURNS character varying
 LANGUAGE plpgsql
AS $function$
declare
	cursor_personas record;
	cursor_conceptos record;
	idp integer;
	v_id_asistencia integer;
	v_cant integer;
	_fecha varchar;

	v_interes decimal;
	v_capital_amortizado decimal;
	v_capital_vivo decimal;

	v_id_tipo_planilla integer;
	v_id_planilla integer;
	v_id_subplanilla integer;
	v_id_ubicacion integer;
	v_fech_inic_tpe varchar;
	v_fech_fina_tpe varchar;
	v_ano_peri_tpe varchar;

	v_mont_fijo_cmf float;
begin

	select id_planilla,id_subplanilla,id_ubicacion,fech_inic_tpe,fech_fina_tpe,ano_peri_tpe 
	into v_id_planilla,v_id_subplanilla,v_id_ubicacion,v_fech_inic_tpe,v_fech_fina_tpe,v_ano_peri_tpe 
	from tperiodos
	where id=p_id_periodo::int;
	
	select id into v_id_tipo_planilla from tabla_ubicaciones where tabla='tplanillas' and id_registro=1;

	delete from concepto_personas 
	where id_periodo =p_id_periodo::int
	and id_persona=p_id_persona::int;
		
	_fecha='';
	
	insert into meta_personas(id_periodo,id_ubicacion,id_planilla,id_subplanilla,id_persona,anno_ejec_eje,estado,created_at,updated_at)
	values (p_id_periodo::int,v_id_ubicacion,v_id_planilla,v_id_subplanilla,p_id_persona::int,v_ano_peri_tpe,'1',now(),now());

	For cursor_conceptos In
	select t3.id_planilla,t4.id_subplanilla,t4.id_concepto,t1.desc_tipo_tpl,t3.desc_subt_stp,t5.desc_conc_tco
	from tplanillas t1
	inner join tabla_ubicaciones t2 on t2.id_registro=t1.id and tabla='tplanillas'
	inner join subtplanillas t3 on t1.id=t3.id_planilla
	inner join concepto_planes t4 on t4.id_planilla=t3.id_planilla and t4.id_subplanilla=t3.id
	inner join conceptos t5 on t4.id_concepto=t5.id
	where t2.id=v_id_tipo_planilla
	
		loop
			v_mont_fijo_cmf := null;
			if cursor_conceptos.id_concepto = 27 then 
				select mont_cont_ctr into v_mont_fijo_cmf from contratos where id_persona = p_id_persona::int order by id desc limit 1;
			end if;
			if cursor_conceptos.id_concepto = 39 then
				v_mont_fijo_cmf := 930;
			end if;
		
			insert into concepto_personas(id_periodo,id_planilla,id_subplanilla,id_persona,id_ubicacion,id_concepto,mont_fijo_cmf,estado,created_at,updated_at)
			values (p_id_periodo::int,cursor_conceptos.id_planilla,cursor_conceptos.id_subplanilla,p_id_persona::int,v_id_ubicacion,cursor_conceptos.id_concepto,v_mont_fijo_cmf,'1',now(),now());
			
		End Loop;
	
	return _fecha;	
	--return idp;
	/*EXCEPTION
	WHEN OTHERS THEN
        idp:=-1;
	return idp;*/
end;
$function$
;
