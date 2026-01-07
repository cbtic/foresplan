CREATE OR REPLACE FUNCTION fn_get_diurno_nocturno(
    p_fecha_ingreso varchar,
    p_hora_ingreso  varchar,
    p_fecha_salida  varchar,
    p_hora_salida   varchar,
    p_opc           varchar
)
RETURNS varchar AS
$BODY$
DECLARE
    v_dias                numeric;
    v_fecha_ingreso_ts    timestamp;
    v_fecha_salida_ts     timestamp;

    v_fecha_hora_ingreso_ts timestamp;
    v_fecha_hora_salida_ts  timestamp;
    v_fecha_hora_dif_int    interval;

    v_minutos_dias   int;
    v_minutos_horas  int;
    v_minutos        int;
    v_total_minutos  int;
BEGIN
    -- Parsear fechas en formato 'DD-MM-YYYY'
    v_fecha_ingreso_ts := to_timestamp(p_fecha_ingreso, 'DD-MM-YYYY');
    v_fecha_salida_ts  := to_timestamp(p_fecha_salida,  'DD-MM-YYYY');

    -- Diferencia en días (si luego se necesita)
    SELECT extract(day FROM (v_fecha_salida_ts - v_fecha_ingreso_ts)) + 1
    INTO v_dias;

    v_minutos_dias  := 0;
    v_minutos_horas := 0;
    v_minutos       := 0;
    v_total_minutos := 0;

    -- Combinar fecha + hora en timestamps completos
    v_fecha_hora_ingreso_ts :=
        to_timestamp(
            to_char(v_fecha_ingreso_ts::date, 'YYYY-MM-DD') || ' ' || p_hora_ingreso,
            'YYYY-MM-DD HH24:MI:SS'
        );

    v_fecha_hora_salida_ts :=
        to_timestamp(
            to_char(v_fecha_salida_ts::date, 'YYYY-MM-DD') || ' ' || p_hora_salida,
            'YYYY-MM-DD HH24:MI:SS'
        );

    -- Opción DIURNO
    IF p_opc = 'D' THEN

        IF v_fecha_hora_salida_ts >
           to_timestamp(to_char(v_fecha_salida_ts::date, 'YYYY-MM-DD') || ' 06:00:00',
                        'YYYY-MM-DD HH24:MI:SS') THEN

            -- Limitar salida máxima a 22:00
            IF v_fecha_hora_salida_ts >
               to_timestamp(to_char(v_fecha_salida_ts::date, 'YYYY-MM-DD') || ' 22:00:00',
                            'YYYY-MM-DD HH24:MI:SS') THEN
                v_fecha_hora_salida_ts :=
                    to_timestamp(to_char(v_fecha_salida_ts::date, 'YYYY-MM-DD') || ' 22:00:00',
                                 'YYYY-MM-DD HH24:MI:SS');
            END IF;

            -- Limitar ingreso mínimo a 06:00
            IF v_fecha_hora_ingreso_ts <
               to_timestamp(to_char(v_fecha_ingreso_ts::date, 'YYYY-MM-DD') || ' 06:00:00',
                            'YYYY-MM-DD HH24:MI:SS') THEN
                v_fecha_hora_ingreso_ts :=
                    to_timestamp(to_char(v_fecha_ingreso_ts::date, 'YYYY-MM-DD') || ' 06:00:00',
                                 'YYYY-MM-DD HH24:MI:SS');
            END IF;

            v_fecha_hora_dif_int := v_fecha_hora_salida_ts - v_fecha_hora_ingreso_ts;

            v_minutos_dias  := extract(day   FROM v_fecha_hora_dif_int) * 16 * 60;
            v_minutos_horas := extract(hour  FROM v_fecha_hora_dif_int) * 60;
            v_minutos       := extract(minute FROM v_fecha_hora_dif_int);

            v_total_minutos := v_minutos_dias + v_minutos_horas + v_minutos;
        ELSE
            v_total_minutos := 0;
        END IF;

    END IF;

    -- Opción NOCTURNO
    IF p_opc = 'N' THEN

        IF v_fecha_hora_ingreso_ts <
           to_timestamp(to_char(v_fecha_ingreso_ts::date, 'YYYY-MM-DD') || ' 06:00:00',
                        'YYYY-MM-DD HH24:MI:SS') THEN

            -- Limitar salida máxima a 06:00
            IF v_fecha_hora_salida_ts >
               to_timestamp(to_char(v_fecha_salida_ts::date, 'YYYY-MM-DD') || ' 06:00:00',
                            'YYYY-MM-DD HH24:MI:SS') THEN
                v_fecha_hora_salida_ts :=
                    to_timestamp(to_char(v_fecha_salida_ts::date, 'YYYY-MM-DD') || ' 06:00:00',
                                 'YYYY-MM-DD HH24:MI:SS');
            END IF;

            -- Limitar ingreso mínimo a 00:00
            IF v_fecha_hora_ingreso_ts <
               to_timestamp(to_char(v_fecha_ingreso_ts::date, 'YYYY-MM-DD') || ' 00:00:00',
                            'YYYY-MM-DD HH24:MI:SS') THEN
                v_fecha_hora_ingreso_ts :=
                    to_timestamp(to_char(v_fecha_ingreso_ts::date, 'YYYY-MM-DD') || ' 00:00:00',
                                 'YYYY-MM-DD HH24:MI:SS');
            END IF;

            v_fecha_hora_dif_int := v_fecha_hora_salida_ts - v_fecha_hora_ingreso_ts;

            v_minutos_dias  := extract(day   FROM v_fecha_hora_dif_int) * 16 * 60;
            v_minutos_horas := extract(hour  FROM v_fecha_hora_dif_int) * 60;
            v_minutos       := extract(minute FROM v_fecha_hora_dif_int);

            v_total_minutos := v_minutos_dias + v_minutos_horas + v_minutos;
        ELSE
            v_total_minutos := 0;
        END IF;

    END IF;

    RETURN v_total_minutos::varchar;
END;
$BODY$
LANGUAGE plpgsql
VOLATILE
COST 100;
