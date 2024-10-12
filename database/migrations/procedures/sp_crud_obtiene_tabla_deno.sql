CREATE OR REPLACE FUNCTION public.sp_crud_obtiene_tabla_deno(p_id bigint)
 RETURNS character varying
 LANGUAGE plpgsql
AS $function$
declare
	_denominacion varchar;
	_tabla varchar;
	_columna varchar;
	_script varchar;
	_cuenta int;
begin
	
	select count(*) into _cuenta from tabla_ubicaciones where id = p_id;
	

	if _cuenta = 0 then 
		_denominacion := '';
	else
			select tabla into _tabla from tabla_ubicaciones where id = p_id;
			select columna_den into _columna  from tabla_ubicaciones where id = p_id;
       
		_script ='select t2.'||_columna||' as denominacion
	        from tabla_ubicaciones t1
	        inner join '||_tabla||' t2 on t2.id = t1.id_registro
	        Where t1.id = '||p_id;
       
       EXECUTE (_script) INTO _denominacion;
      
   end if;


	return _denominacion;
/*
	EXCEPTION
	WHEN OTHERS THEN
        _denominacion:='';
	return _denominacion;
*/
end;

--Select sp_crud_obtiene_tabla_deno(241);

	
--	select tabla into _tabla from tabla_ubicaciones where id = p_id;
--	select columna_den into _columna  from tabla_ubicaciones where id = p_id;

--select tabla , columna_den   from tabla_ubicaciones where id = 241;
	
	/*
	select * from tabla_ubicaciones tu
inner join condicion_laborales cl on cl.id = tu.id_registro 
--and tu.tabla = 'condicion_laborales' and tu.id_cliente = 1
where tu.id = 241
*/

/*
_script ='select cl.desc_cond_lab from tabla_ubicaciones tu
inner join condicion_laborales cl on cl.id = tu.id_registro 
where tu.id = 241 limit 1';
       
*/
/*
select count(*) 
from tabla_ubicaciones tu
inner join condicion_laborales cl on cl.id = tu.id_registro 
where tu.id = 0;
*/
	
$function$
;
