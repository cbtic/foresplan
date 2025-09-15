-- DROP FUNCTION public.sp_procesar_planilla(varchar);

CREATE OR REPLACE FUNCTION public.sp_procesar_planilla(p_id_periodo character varying)
 RETURNS character varying
 LANGUAGE plpgsql
AS $function$
declare
	cur_personal record;
	cur_resumen record;
	idp integer;
	v_id_asistencia integer;
	v_cant integer;
	_fecha varchar;

	_monto varchar;
	
begin
/*
INSERT INTO planilla_calculadas(id_planilla, id_subplanilla, ano_peri_tpe, nume_peri_tpe, id_persona, id_concepto, valo_calc_pca, id_ubicacion)
    SELECT id_planilla, id_subplanilla, ano_peri_tpe, nume_peri_tpe, id_persona, id_concepto, cant_conc_res, id_ubicacion 
    FROM resumenes    
    WHERE ano_peri_tpe = '2021' and nume_peri_tpe = '11';
    
SELECT id, id_planilla, id_subplanilla, ano_peri_tpe, nume_peri_tpe, id_persona, id_concepto, valo_calc_pca, created_at, updated_at, id_ubicacion
FROM public.planilla_calculadas;

SELECT id, id_persona, id_planilla, id_subplanilla, ano_peri_tpe, nume_peri_tpe, id_concepto, cant_conc_res, cant_conc_rem, created_at, updated_at, id_ubicacion
FROM public.resumenes;
*/



	For cur_personal In
	select distinct id_persona, id_planilla, id_subplanilla, id_ubicacion
	from public.resumenes
	where id_periodo = p_id_periodo::int
	--and id_persona= 9
	order by 1
	--and ano_peri_tpe = '2021' and nume_peri_tpe = '11'
	
	Loop
		
		For cur_resumen In
	    SELECT r.id, r.id_planilla, r.id_subplanilla, r.ano_peri_tpe, r.nume_peri_tpe, r.id_persona, r.id_concepto, r.cant_conc_res, r.cant_conc_rem, r.id_ubicacion,
	    	   c.codi_conc_tco, f.formula_for
	    FROM resumenes r  
	    inner join conceptos c on c.id = r.id_concepto
	    inner join formulas f on f.id_planilla = r.id_planilla and f.id_subplanilla = r.id_subplanilla and f.id_concepto = r.id_concepto 	    	    
	    WHERE r.id_persona = cur_personal.id_persona
	    and r.id_periodo=p_id_periodo::int	
	    and f.estado = 'A'
	    order by f.orden 
/*
	    SELECT r.id_planilla, r.id_subplanilla, r.ano_peri_tpe, r.nume_peri_tpe, r.id_persona, r.id_concepto, r.cant_conc_res, r.cant_conc_rem, r.id_ubicacion
	    ,c.codi_conc_tco
	    ,f.formula_for
	    ,c.desc_cort_tco 
	    FROM resumenes r 
	    inner join conceptos c on c.id = r.id_concepto
	    inner join formulas f on f.id_planilla = r.id_planilla and f.id_subplanilla = r.id_subplanilla and f.id_concepto = r.id_concepto 
	    WHERE r.id_persona = 1;
	    

	   	SELECT r.id_planilla, r.id_subplanilla, r.ano_peri_tpe, r.nume_peri_tpe, r.id_persona, r.id_concepto, r.cant_conc_res, r.cant_conc_rem, r.id_ubicacion
	    ,c.codi_conc_tco
	    ,f.formula_for
	    ,c.desc_cort_tco 
	    FROM resumenes r 
	    inner join conceptos c on c.id = r.id_concepto
	    left join formulas f on f.id_planilla = r.id_planilla and f.id_subplanilla = r.id_subplanilla and f.id_concepto = r.id_concepto 
	    WHERE r.id_persona = 1;
	   
	    select *  from conceptos c where c.codi_conc_tco in ('00183','00424');
	    (($00101+$00181+$00182+$00203+$00286+$00183)-$00424)*0.08
	    
	    select *  from formulas f ;
	    */
	    
	    

	  
		loop
		
			_monto := '0';
		/*
			if 	cur_resumen.codi_conc_tco = '00182' then -- TARDANZAS
				select sp_crud_calcula_concepto_planilla(cur_resumen.id, cur_resumen.formula_for) into _monto;
				update resumenes set cant_conc_rem = _monto::DECIMAL where id = cur_resumen.id;
			end if;
		
			if 	cur_resumen.codi_conc_tco = '00105' then -- ASIG. FAM.
				select sp_crud_calcula_concepto_planilla(cur_resumen.id, cur_resumen.formula_for) into _monto;
				update resumenes set cant_conc_rem = _monto::DECIMAL where id = cur_resumen.id;
			end if;

			if 	cur_resumen.codi_conc_tco = '00101' then -- REMUNERACION
				select sp_crud_calcula_concepto_planilla(cur_resumen.id, cur_resumen.formula_for) into _monto;
				update resumenes set cant_conc_rem = _monto::DECIMAL where id = cur_resumen.id;
			end if;		

			if 	cur_resumen.codi_conc_tco = '00181' then -- FALTAS
				select sp_crud_calcula_concepto_planilla(cur_resumen.id, cur_resumen.formula_for) into _monto;
				update resumenes set cant_conc_rem = _monto::DECIMAL where id = cur_resumen.id;
			end if;	
		
			if 	cur_resumen.codi_conc_tco = '00203' then -- REINTEGRO
				select sp_crud_calcula_concepto_planilla(cur_resumen.id, cur_resumen.formula_for) into _monto;
				update resumenes set cant_conc_rem = _monto::DECIMAL where id = cur_resumen.id;
			end if;	
		
			if 	cur_resumen.codi_conc_tco = '00424' then -- D.U. 063-2020 (-10%)
				select sp_crud_calcula_concepto_planilla(cur_resumen.id, cur_resumen.formula_for) into _monto;
				update resumenes set cant_conc_rem = _monto::DECIMAL where id = cur_resumen.id;
			end if;	

			if 	cur_resumen.codi_conc_tco = '00183' then -- D.U. 063-2020 (-10%)
				select sp_crud_calcula_concepto_planilla(cur_resumen.id, cur_resumen.formula_for) into _monto;
				update resumenes set cant_conc_rem = _monto::DECIMAL where id = cur_resumen.id;
			end if;	
		
			if 	cur_resumen.codi_conc_tco = '00505' then -- ESSALUD
				select sp_crud_calcula_concepto_planilla(cur_resumen.id, cur_resumen.formula_for) into _monto;
				update resumenes set cant_conc_rem = _monto::DECIMAL where id = cur_resumen.id;
			end if;
			
			if 	cur_resumen.codi_conc_tco = '00308' then -- IMP. A LA RENTA
				select sp_crud_calcula_concepto_planilla(cur_resumen.id, cur_resumen.formula_for) into _monto;
				update resumenes set cant_conc_rem = _monto::DECIMAL where id = cur_resumen.id;
			end if;	

			if 	cur_resumen.codi_conc_tco = '00902' then -- REMUNERACION TOTAL
				select sp_crud_calcula_concepto_planilla(cur_resumen.id, cur_resumen.formula_for) into _monto;
				update resumenes set cant_conc_rem = _monto::DECIMAL where id = cur_resumen.id;
			end if;	
*/		
		
			select sp_crud_calcula_concepto_planilla(cur_resumen.id, cur_resumen.formula_for) into _monto;
		
			if _monto::DECIMAL < 0 then _monto:='0'; end if;
			update resumenes set cant_conc_rem = _monto::DECIMAL where id = cur_resumen.id;
			
			insert into planilla_calculadas(id_planilla, id_subplanilla, ano_peri_tpe, nume_peri_tpe, id_persona, id_concepto, valo_calc_pca, id_ubicacion,created_at,updated_at, id_periodo, estado)
			values (cur_resumen.id_planilla, cur_resumen.id_subplanilla, cur_resumen.ano_peri_tpe, cur_resumen.nume_peri_tpe, cur_resumen.id_persona, cur_resumen.id_concepto, _monto, cur_resumen.id_ubicacion, now(), now(), p_id_periodo::int, 1);
			
		End Loop;

	End Loop;
	
	return _fecha;	
	--return idp;
	/*EXCEPTION
	WHEN OTHERS THEN
        idp:=-1;
	return idp;*/
/*
truncate TABLE concepto_personas RESTART IDENTITY;
select sp_procesar_concepto_persona();

truncate TABLE resumenes RESTART IDENTITY;
select sp_cerrar_periodo('2021', '11')

update resumenes set cant_conc_rem = '930' where id_concepto = 39;
update resumenes set cant_conc_res = '6' where id_concepto = 7;
update resumenes set cant_conc_res = '30' where id_concepto = 40;

update resumenes set cant_conc_res = '150' where id_concepto = 81;
update resumenes set cant_conc_res = '70' where id_concepto = 82;

update resumenes set cant_conc_res = '180' where id_concepto = 8;
update resumenes set cant_conc_rem = '300' where id_concepto = 4;
update resumenes set cant_conc_rem = '3' where id_concepto = 77;
	   
 truncate TABLE planilla_calculadas RESTART IDENTITY; 
 select sp_procesar_planilla();
 
 
*/



end;
$function$
;
