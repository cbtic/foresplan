-- DROP FUNCTION public.sp_cerrar_periodo(varchar);

CREATE OR REPLACE FUNCTION public.sp_cerrar_periodo(p_id_periodo character varying)
 RETURNS character varying
 LANGUAGE plpgsql
AS $function$
DECLARE
    cursor_personas   RECORD;
    cursor_conceptos  RECORD;

    v_cant_conc_res   numeric;
    v_cant_conc_res_  numeric;

    v_id_planilla     integer;
    v_id_subplanilla  integer;
    v_id_ubicacion    integer;

    v_fech_inic_tpe   varchar;   -- dd/mm/yyyy
    v_fech_fina_tpe   varchar;   -- dd/mm/yyyy

    v_f_ini_date      date;
    v_f_fin_date      date;

    _fecha            varchar;
BEGIN
    -- Obtener datos del periodo (fechas como texto dd/mm/yyyy)
    SELECT id_planilla,
           id_subplanilla,
           id_ubicacion,
           fech_inic_tpe,
           fech_fina_tpe
    INTO   v_id_planilla,
           v_id_subplanilla,
           v_id_ubicacion,
           v_fech_inic_tpe,
           v_fech_fina_tpe
    FROM tperiodos
    WHERE id = p_id_periodo::int;

    -- Parsear a date usando el formato correcto dd/mm/yyyy
    v_f_ini_date := to_date(v_fech_inic_tpe, 'DD/MM/YYYY');
    v_f_fin_date := to_date(v_fech_fina_tpe, 'DD/MM/YYYY');

    -- Limpiar resumenes del periodo
    DELETE FROM resumenes
    WHERE id_periodo = p_id_periodo::int;

    -- Loop personas
    FOR cursor_personas IN
        SELECT id_persona
        FROM meta_personas
        WHERE id_periodo = p_id_periodo::int
          AND COALESCE(estado,'1') = '1'
    LOOP

        -- Loop conceptos por persona
        FOR cursor_conceptos IN
            SELECT id_concepto, mont_fijo_cmf
            FROM concepto_personas
            WHERE id_periodo = p_id_periodo::int
              AND id_persona = cursor_personas.id_persona
              AND COALESCE(estado,'1') = '1'
        LOOP

            v_cant_conc_res  := 0;
            v_cant_conc_res_ := 0;

            -- MINUTOS DE TARDANZA
            IF cursor_conceptos.id_concepto = 8 THEN
                -- minu_tard_eas está en HH:MI
                SELECT COALESCE(
                           SUM(
                               EXTRACT(hour   FROM (minu_tard_eas::time)) * 60 +
                               EXTRACT(minute FROM (minu_tard_eas::time))
                           ),
                           0
                       )
                INTO v_cant_conc_res
                FROM asistencias
                WHERE id_persona = cursor_personas.id_persona
                  AND fech_marc_rel <> ''
                  AND to_date(fech_marc_rel, 'DD-MM-YYYY')
                        BETWEEN v_f_ini_date AND v_f_fin_date
                  AND minu_tard_eas <> '0'
                  AND minu_tard_eas <> '00:00';

                -- minu_dife_pap también HH:MI / HH:MM
                SELECT COALESCE(
                           SUM(
                               EXTRACT(hour   FROM (minu_dife_pap::time)) * 60 +
                               EXTRACT(minute FROM (minu_dife_pap::time))
                           ),
                           0
                       )
                INTO v_cant_conc_res_
                FROM asistencias
                WHERE id_persona = cursor_personas.id_persona
                  AND fech_marc_rel <> ''
                  AND to_date(fech_marc_rel, 'DD-MM-YYYY')
                        BETWEEN v_f_ini_date AND v_f_fin_date
                  AND minu_dife_pap <> '0'
                  AND minu_dife_pap <> '00:00';

                v_cant_conc_res := v_cant_conc_res - v_cant_conc_res_;
            END IF;

            -- DIAS INASISTENCIA
            IF cursor_conceptos.id_concepto = 7 THEN
                DROP TABLE IF EXISTS tmp_fechas;
                CREATE TEMP TABLE tmp_fechas AS
                SELECT cursor_personas.id_persona AS id_persona,
                       fecha_dias::date
                FROM generate_series(v_f_ini_date, v_f_fin_date, INTERVAL '1 day') AS fecha_dias;

                SELECT
                    (
                        SELECT COUNT(*)
                        FROM tmp_fechas t0
                        LEFT JOIN personal_turnos t1
                               ON t0.id_persona = t1.id_persona
                        LEFT JOIN detalle_turnos t2
                               ON t2.id_turno = t1.id_turno
                              AND t2.nume_ndia_dtu::int =
                                  CASE
                                      WHEN EXTRACT(dow FROM t0.fecha_dias)::int = 0
                                      THEN 7
                                      ELSE EXTRACT(dow FROM t0.fecha_dias)::int
                                  END
                        WHERE t1.id_persona = cursor_personas.id_persona
                          AND t2.flag_labo_dtu = 'S'
                    )
                    -
                    (
                        SELECT COUNT(*)
                        FROM asistencias
                        WHERE id_persona = cursor_personas.id_persona
                          AND fech_marc_rel <> ''
                          AND to_date(fech_marc_rel, 'DD-MM-YYYY')
                                BETWEEN v_f_ini_date AND v_f_fin_date
                    )
                    -
                    (
                        SELECT COUNT(*)
                        FROM asistencias
                        WHERE id_persona = cursor_personas.id_persona
                          AND fech_regi_mar <> ''
                          AND to_date(fech_regi_mar, 'DD-MM-YYYY')
                                BETWEEN v_f_ini_date AND v_f_fin_date
                          AND COALESCE(id_deta_operacion,0) > 0
                    )
                INTO v_cant_conc_res;
            END IF;

            -- DIAS TRABAJADOS
            IF cursor_conceptos.id_concepto = 40 THEN
                SELECT
                    (
                        SELECT COUNT(*)
                        FROM asistencias
                        WHERE id_persona = cursor_personas.id_persona
                          AND fech_marc_rel <> ''
                          AND to_date(fech_marc_rel, 'DD-MM-YYYY')
                                BETWEEN v_f_ini_date AND v_f_fin_date
                    )
                    +
                    (
                        SELECT COUNT(*)
                        FROM asistencias
                        WHERE id_persona = cursor_personas.id_persona
                          AND fech_regi_mar <> ''
                          AND to_date(fech_regi_mar, 'DD-MM-YYYY')
                                BETWEEN v_f_ini_date AND v_f_fin_date
                          AND COALESCE(id_deta_operacion,0) > 0
                    )
                INTO v_cant_conc_res;
            END IF;

            -- HORA DIURNO TRAB.
            IF cursor_conceptos.id_concepto = 81 THEN
                SELECT
                    FLOOR(
                        SUM(
                            fn_get_diurno_nocturno(
                                fech_marc_rel,
                                hora_entr_rel,
                                fech_sali_rel,
                                ((hora_sali_rel::interval
                                  + COALESCE(minu_dife_pap,'00:00:00')::interval)::varchar),
                                'D'
                            )::int
                        ) / 60
                    )
                INTO v_cant_conc_res
                FROM asistencias
                WHERE id_persona = cursor_personas.id_persona
                  AND fech_marc_rel <> ''
                  AND hora_entr_rel <> ''
                  AND fech_sali_rel <> ''
                  AND hora_sali_rel <> ''
                  AND to_date(fech_marc_rel, 'DD-MM-YYYY')
                        BETWEEN v_f_ini_date AND v_f_fin_date;
            END IF;

            -- HORA NOCTURNO TRAB.
            IF cursor_conceptos.id_concepto = 82 THEN
                SELECT
                    FLOOR(
                        SUM(
                            fn_get_diurno_nocturno(
                                fech_marc_rel,
                                hora_entr_rel,
                                fech_sali_rel,
                                hora_sali_rel,
                                'N'
                            )::int
                        ) / 60
                    )
                INTO v_cant_conc_res
                FROM asistencias
                WHERE id_persona = cursor_personas.id_persona
                  AND fech_marc_rel <> ''
                  AND hora_entr_rel <> ''
                  AND fech_sali_rel <> ''
                  AND hora_sali_rel <> ''
                  AND to_date(fech_marc_rel, 'DD-MM-YYYY')
                        BETWEEN v_f_ini_date AND v_f_fin_date;
            END IF;

            -- Insertar en resumenes (aunque v_cant_conc_res sea 0)
            INSERT INTO resumenes(
                id_persona,
                id_planilla,
                id_subplanilla,
                ano_peri_tpe,
                nume_peri_tpe,
                id_ubicacion,
                id_concepto,
                cant_conc_res,
                cant_conc_rem,
                created_at,
                updated_at,
                id_periodo
            )
            VALUES (
                cursor_personas.id_persona,
                v_id_planilla,
                v_id_subplanilla,
                to_char(v_f_ini_date, 'YYYY'),
                to_char(v_f_ini_date, 'MM'),
                v_id_ubicacion,
                cursor_conceptos.id_concepto,
                v_cant_conc_res,
                cursor_conceptos.mont_fijo_cmf,
                now(),
                now(),
                p_id_periodo::int
            );

        END LOOP; -- cursor_conceptos

    END LOOP; -- cursor_personas

    RETURN _fecha; -- devuelve lo mismo que la función inicial (null si no se asigna)
END;
$function$
;
