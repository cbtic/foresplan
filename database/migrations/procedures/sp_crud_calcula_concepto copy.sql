CREATE OR REPLACE FUNCTION sp_crud_calcula_concepto(p_id bigint, p_concepto bigint)
 RETURNS character varying
 LANGUAGE plpgsql
AS $function$
declare

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

begin

	-- select sp_crud_calcula_concepto(81, 67);
	-- select sp_crud_calcula_concepto(885, 25);
	
	SELECT id_persona, id_planilla, id_subplanilla, id_concepto, cant_conc_res, cant_conc_rem, ano_peri_tpe, nume_peri_tpe  
			into _persona, _planilla, _subplanilla, _concepto, _cant_conc_res, _cant_conc_rem, _anio, _peri
	FROM resumenes
	where id = p_id;

	select f.formula_for, c.codi_conc_tco into _formula, _cod_concepto
	from formulas f 
	inner join conceptos c on c.id = f.id_concepto
	where f.id_planilla = _planilla and  f.id_subplanilla = _subplanilla and f.id_concepto = _concepto;

/*
	select f.formula_for, c.codi_conc_tco --into _formula, _cod_concepto
	from formulas f 
	inner join conceptos c on c.id = f.id_concepto
	where f.id_planilla = 1 and  f.id_subplanilla = 3 and f.id_concepto = 25;
*/

/*	
	if _formula is not null then 
	
		if _concepto = p_concepto then
			--_resultado := _formula;
		end if;
	
	/*
		select tabla into _tabla from tabla_ubicaciones where id = p_id;
			select columna_den into _columna  from tabla_ubicaciones where id = p_id;
       
		_script ='select t2.'||_columna||' as denominacion
	        from tabla_ubicaciones t1
	        inner join '||_tabla||' t2 on t2.id = t1.id_registro
	        Where t1.id = '||p_id;
       
       EXECUTE (_script) INTO _denominacion;
      */
	
	 _denominacion := _formula;
  else
  	_denominacion := '';
  end if;

 */

	if _formula is not null then 
		_formulaT := _formula;
		
		_cuenta := position('$' in _formulaT);
		_resultado :=  SUBSTRING(_formula, _cuenta + 1, 5);
		_conceptoT := _resultado;


		
		if _cod_concepto = '00182' then

			SELECT id into _conceptoF 
			FROM public.conceptos c
			WHERE c.codi_conc_tco = _resultado and c.estado = 'A' ;
		
			SELECT cant_conc_rem into _remuneracion
			FROM resumenes
			where id_persona = _persona and id_planilla = _planilla and  id_subplanilla = _subplanilla and id_concepto = _conceptoF and ano_peri_tpe = _anio and  nume_peri_tpe = _peri;
	
			_formulaT := REPLACE (_formula, '$'||_conceptoT, _remuneracion ||'.00');
		
			_cuenta := position('$' in _formulaT);
			_resultado :=  SUBSTRING(_formulaT, _cuenta + 1, 5);
			_conceptoT := _resultado;
		
			SELECT id into _conceptoF 
			FROM public.conceptos c
			WHERE c.codi_conc_tco = _conceptoT and c.estado = 'A' ;
		
		
			SELECT cant_conc_res into _min_tardanza
			FROM resumenes
			where id_persona = _persona and id_planilla = _planilla and  id_subplanilla = _subplanilla and id_concepto = _conceptoF and ano_peri_tpe = _anio and  nume_peri_tpe = _peri;
		
		
			_formulaT := REPLACE (_formulaT, '$'||_conceptoT, _min_tardanza);
		
			--_resultado := (Round((((_remuneracion::numeric)/30)/480) * _min_tardanza::numeric,2)*-1);
			--_resultado := REPLACE (_formula, '$'||_conceptoT, _min_tardanza);

		end if;
	
		if _cod_concepto = '00105' then
			SELECT id into _conceptoF 
			FROM public.conceptos c
			WHERE c.codi_conc_tco = _resultado and c.estado = 'A' ;
		
			SELECT cant_conc_rem into _remuneracion
			FROM resumenes
			where id_persona = _persona and id_planilla = _planilla and  id_subplanilla = _subplanilla and id_concepto = _conceptoF and ano_peri_tpe = _anio and  nume_peri_tpe = _peri;
	
			_formulaT := REPLACE (_formula, '$'||_conceptoT, _remuneracion ||'.00');
		end if;
	
	
		EXECUTE ('SELECT '||_formulaT) INTO _resultado;
	
	end if;

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
