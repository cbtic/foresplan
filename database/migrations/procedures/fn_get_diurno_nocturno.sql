CREATE OR REPLACE FUNCTION fn_get_diurno_nocturno(
    p_fecha_ingreso varchar,
    p_hora_ingreso varchar,
    p_fecha_salida varchar,
    p_hora_salida varchar,
    p_opc varchar)
  RETURNS varchar AS
$BODY$
DECLARE
 v_hora NUMERIC;
 v_dias NUMERIC;
 v_fecha_hora_ingreso varchar;
 v_fecha_hora_salida varchar;
 v_fecha_hora_dif varchar;
 
 v_minutos_dias int;
 v_minutos_horas int;
 v_minutos int;
BEGIN

	--select extract(days from (timestamp p_fecha_salida - timestamp p_fecha_ingreso)) into v_dias;

	select extract(days from (p_fecha_salida::timestamp - p_fecha_ingreso::timestamp))+1 into v_dias;

	v_minutos_dias :=0;
	v_minutos_horas:=0;
	--FOR i IN 1..v_dias LOOP
		--p_fecha_salida:= p_fecha_ingreso;
		v_fecha_hora_ingreso	:= p_fecha_ingreso||' '||p_hora_ingreso;
		v_fecha_hora_salida	:= p_fecha_salida||' '||p_hora_salida;

		if p_opc = 'D' then
		
			if v_fecha_hora_salida > p_fecha_salida||' 06:00:00' then
			
				if v_fecha_hora_salida > p_fecha_salida||' 22:00:00' then
					v_fecha_hora_salida	:= p_fecha_salida||' 22:00:00';
				end if;

				if v_fecha_hora_ingreso < p_fecha_ingreso||' 06:00:00' then
					v_fecha_hora_ingreso	:= p_fecha_ingreso||' 06:00:00';
				end if;

				v_fecha_hora_dif := v_fecha_hora_salida::timestamp - v_fecha_hora_ingreso::timestamp;
				v_minutos_dias := extract(days from v_fecha_hora_dif::interval)*16*60;
				v_minutos_horas := extract(hour from v_fecha_hora_dif::interval)*60;
				v_minutos := extract(minute from v_fecha_hora_dif::interval);
				v_fecha_hora_dif := v_minutos_dias + v_minutos_horas + v_minutos;
			else
				v_fecha_hora_dif := 0;
			end if;

		end if;

		if p_opc = 'N' then
		
			if v_fecha_hora_ingreso < p_fecha_ingreso||' 06:00:00' then
				
				if v_fecha_hora_salida > p_fecha_salida||' 06:00:00' then
					v_fecha_hora_salida	:= p_fecha_salida||' 06:00:00';
				end if;
				
				if v_fecha_hora_ingreso < p_fecha_ingreso||' 00:00:00' then
					v_fecha_hora_ingreso	:= p_fecha_ingreso||' 00:00:00';
				end if;

				v_fecha_hora_dif := v_fecha_hora_salida::timestamp - v_fecha_hora_ingreso::timestamp;
				v_minutos_dias := extract(days from v_fecha_hora_dif::interval)*16*60;
				v_minutos_horas := extract(hour from v_fecha_hora_dif::interval)*60;
				v_minutos := extract(minute from v_fecha_hora_dif::interval);
				v_fecha_hora_dif := v_minutos_dias + v_minutos_horas + v_minutos;
			else
				v_fecha_hora_dif := 0;
			end if;

		end if;
		
		--v_fecha_hora_dif := v_fecha_hora_salida::timestamp;
		--v_fecha_hora_dif := 222;
	--END LOOP;
	--select fn_get_diurno_nocturno('24-01-2022','03:14:57','24-01-2022','11:33:31')
	
--RETURN coalesce( v_dias,NULL,0);
RETURN v_fecha_hora_dif;

END;
$BODY$
LANGUAGE plpgsql VOLATILE
  COST 100;
    