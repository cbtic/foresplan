CREATE OR REPLACE FUNCTION public.sp_crud_calcula_concepto_planilla(p_id bigint, p_formula character varying)
 RETURNS character varying
 LANGUAGE plpgsql
AS $function$
declare
/*
	_cuenta int;
	_formula varchar;
	_formulaT varchar;
	_persona int;
	_planilla int; 
	_subplanilla int; 
	_concepto int;
	_anio varchar;
	_peri varchar;
	_cant_conc_res int; 
	_cant_conc_rem varchar;
	_conceptoF int;
	_conceptoT varchar;
	_remuneracion varchar;
	_min_tardanza varchar;
	_resultado varchar;
	_cod_concepto varchar;
*/
_persona int;
_planilla int; 
_subplanilla int; 
_concepto int;
_anio varchar;
_peri varchar;
 --counter int = 0;
_formula varchar;
_posicion int = 0;
_cod_concepto varchar;
_monto numeric;
_id_concepto int;
_remuneracion varchar;
_tempo varchar;
_resultado varchar;

begin

	-- select sp_crud_calcula_concepto_planilla(81, '(Round(((($00100)/30)/480) * $00704,2)*-1)');
	-- select sp_crud_calcula_concepto_planilla(885, 'Round($00100 *0.10,2)');

	--select * from formulas f where id_concepto =67;
	--select * from resumenes r where id = 81;
/*	
	SELECT id_persona, id_planilla, id_subplanilla, id_concepto, cant_conc_res, cant_conc_rem, ano_peri_tpe, nume_peri_tpe  
			into _persona, _planilla, _subplanilla, _concepto, _cant_conc_res, _cant_conc_rem, _anio, _peri
	FROM resumenes
	where id = p_id;
*/
	SELECT id_persona, id_planilla, id_subplanilla, id_concepto, ano_peri_tpe, nume_peri_tpe  
	 into _persona, _planilla, _subplanilla, _concepto, _anio, _peri
	FROM resumenes
	where id = p_id;

	_formula := p_formula;

	_cod_concepto := '';
	_monto := '0';
	


	loop
  		_posicion := position('$' in _formula);
		_cod_concepto :=  SUBSTRING(_formula, _posicion + 1, 5);
		

		if _posicion <> 0 then
			select c.id into _id_concepto
			from conceptos c
			where c.codi_conc_tco = _cod_concepto and c.estado = 'A' ;
	
	 		--_remuneracion := '0';
			--select case when cant_conc_rem is null then cant_conc_res else cant_conc_rem end as ha into _remuneracion
	 	/*
			select case when cant_conc_rem is null then (case when cant_conc_res is null then '0' else cant_conc_res::text end) else cant_conc_rem::text end as ha into _remuneracion
			from resumenes
			where id_persona = _persona and id_planilla = _planilla and  id_subplanilla = _subplanilla 
				  and id_concepto = _id_concepto and ano_peri_tpe = _anio and  nume_peri_tpe = _peri;
			*/
	 	
			select coalesce (
			(select case when cant_conc_rem is null then (case when cant_conc_res is null then '0' else cant_conc_res::text end) else cant_conc_rem::text end
			from resumenes
			where id_persona = _persona and id_planilla = _planilla and  id_subplanilla = _subplanilla 
				  and id_concepto = _id_concepto and ano_peri_tpe = _anio and  nume_peri_tpe = _peri
			)
			,'0') into _remuneracion;

				 
				  --and cant_conc_rem is not null and cant_conc_rem is not null;

			--_monto := TO_NUMBER(_remuneracion,'L9G999g999.99');
				 
			_monto := _remuneracion;
		
			--if _monto < 0 then _monto :=  -1; end if;
			--_monto :=  -1;
		
		end if;


		_formula := REPLACE (_formula, '$'||_cod_concepto, _monto||'::DECIMAL');
	
    	exit when _posicion = 0;
   
		-- exit the loop if counter > 10
		----exit when counter > 20;
		-- skip the current iteration if counter is an even number
		--continue when mod(counter,2) = 0;
		-- print out the counter
		    --raise notice '%', _formula;
  	end loop;
 
 		--_formula := _cod_concepto;
 
  	EXECUTE ('SELECT '||_formula) INTO _resultado;
  
  	--if _resultado < 0 then _resultado :=  _resultado * -1; end if;
 
 --	 _resultado :=  SUBSTRING(_resultado, 1, 1);
  
  --_resultado:= _formula; 
 
  	raise notice '%', _resultado;

	return _resultado;
/*
	EXCEPTION
	WHEN OTHERS THEN
        _denominacion:='';
	return _denominacion;
*/
-- select sp_crud_calcula_concepto(1,3,67);

end;


	
$function$
;
