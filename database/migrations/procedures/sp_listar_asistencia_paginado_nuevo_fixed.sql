CREATE OR REPLACE FUNCTION public.sp_listar_asistencia_paginado_nuevo(
  p_area character varying,
  p_unidad character varying,
  p_persona character varying,
  p_anio character varying,
  p_mes character varying,
  p_fecha_ini character varying,
  p_fecha_fin character varying,
  p_sede character varying,
  p_condicion_laboral character varying,
  p_estado character varying,
  p_pagina character varying,
  p_limit character varying,
  p_ref refcursor
)
RETURNS refcursor
LANGUAGE plpgsql
AS $function$
DECLARE
    v_fecha_desde date;
    v_fecha_hasta date;
    v_offset integer;
BEGIN
    v_fecha_desde := (p_anio||'-'||p_mes||'-01')::date;
    SELECT last_day_month(p_anio::int,p_mes::int)::date INTO v_fecha_hasta;

    v_offset := (p_pagina::integer - 1) * p_limit::integer;

    OPEN p_ref FOR
    WITH tmp_fechas AS (
        SELECT
            d::date AS fecha_dias,
            CASE WHEN tf.fech_feri_tdf::date IS NOT NULL THEN 1 ELSE 0 END AS es_feriado
        FROM generate_series(v_fecha_desde, v_fecha_hasta, interval '1 day') AS d
        LEFT JOIN tdias_feriados tf
          ON tf.fech_feri_tdf::date = d::date
    ),
    tmp_fecha_personas AS (
        SELECT
            tf.fecha_dias,
            tf.es_feriado,
            p.id AS id_persona
        FROM personas p
        LEFT JOIN persona_detalles pd
          ON pd.id_persona = p.id
         AND pd.estado IN ('A','C')
         AND pd.eliminado = 'N'
        CROSS JOIN tmp_fechas tf
    ),
    turno_unico AS (
        SELECT DISTINCT ON (pt.id_persona, dt.nume_ndia_dtu)
            pt.id_persona,
            dt.nume_ndia_dtu,
            dt.flag_labo_dtu,
            dt.hora_entr_dtu,
            dt.hora_sali_dtu
        FROM personal_turnos pt
        JOIN tturnos t
          ON pt.id_turno = t.id
         AND t.deleted_at IS NULL
        JOIN detalle_turnos dt
          ON dt.id_turno = t.id
        WHERE pt.deleted_at IS NULL
          AND pt.id_persona IS NOT NULL
        ORDER BY pt.id_persona, dt.nume_ndia_dtu, pt.id DESC
    ),
    asistencia_unica AS (
        SELECT DISTINCT ON (a.id_persona, a.fech_regi_mar::date)
            a.*
        FROM asistencias a
        ORDER BY a.id_persona, a.fech_regi_mar::date, a.id DESC
    ),
    base AS (
        SELECT
            t1.id AS id_pe,
            t0.fecha_dias AS fecha_raw,
            to_char(t0.fecha_dias,'dd-mm-yyyy') AS fecha_dias,
            CASE
                WHEN extract(dow FROM t0.fecha_dias)::int = 0 THEN 'Dom'
                WHEN extract(dow FROM t0.fecha_dias)::int = 1 THEN 'Lun'
                WHEN extract(dow FROM t0.fecha_dias)::int = 2 THEN 'Mar'
                WHEN extract(dow FROM t0.fecha_dias)::int = 3 THEN 'Mie'
                WHEN extract(dow FROM t0.fecha_dias)::int = 4 THEN 'Jue'
                WHEN extract(dow FROM t0.fecha_dias)::int = 5 THEN 'Vie'
                WHEN extract(dow FROM t0.fecha_dias)::int = 6 THEN 'Sab'
            END AS dia,
            t0.es_feriado,
            coalesce(a.flag_labo_dtu, tu.flag_labo_dtu) AS flag_labo_dtu,

            -- Horas protegidas con NULLIF
            CASE
                WHEN NULLIF(a.hora_entrada,'') IS NOT NULL
                THEN to_char(NULLIF(a.hora_entrada,'')::time,'HH24:MI')
                ELSE ''
            END AS hora_entrada,
            CASE
                WHEN NULLIF(a.hora_salida,'') IS NOT NULL
                THEN to_char(NULLIF(a.hora_salida,'')::time,'HH24:MI')
                ELSE ''
            END AS hora_salida,
            CASE
                WHEN tu.hora_entr_dtu IS NOT NULL
                THEN to_char(tu.hora_entr_dtu::time,'HH24:MI')
                ELSE ''
            END AS hora_entr_dtu,
            CASE
                WHEN tu.hora_sali_dtu IS NOT NULL
                THEN to_char(tu.hora_sali_dtu::time,'HH24:MI')
                ELSE ''
            END AS hora_sali_dtu,
            CASE
                WHEN NULLIF(a.hora_entr_rel,'') IS NOT NULL
                THEN to_char(NULLIF(a.hora_entr_rel,'')::time,'HH24:MI')
                ELSE ''
            END AS hora_entr_rel,
            CASE
                WHEN NULLIF(a.hora_sali_rel,'') IS NOT NULL
                THEN to_char(NULLIF(a.hora_sali_rel,'')::time,'HH24:MI')
                ELSE ''
            END AS hora_sali_rel,

            CASE
                WHEN NULLIF(a.minu_tard_eas,'') IS NOT NULL
                     AND a.minu_tard_eas <> '0'
                THEN to_char(NULLIF(a.minu_tard_eas,'')::time,'HH24:MI')
                ELSE '00:00'
            END AS minu_tard_eas,

            pd.id AS id_pd,
            di.abre_docu_did AS tipo_documento,
            t1.numero_documento,
            t1.apellido_paterno||' '||t1.apellido_materno||' '||t1.nombres AS persona,
            t1.fecha_nacimiento,
            t1.sexo,
            (select sp_crud_obtiene_tabla_deno (pd.id_cargo)) AS cargo,
            (select sp_crud_obtiene_tabla_deno (pd.id_condicion_laboral)) AS condicion_laboral,
            (select sp_crud_obtiene_tabla_deno (pd.id_regimen_pensionario)) AS regimen,
            (select sp_crud_obtiene_tabla_deno (pd.id_area_trabajo)) AS area_trabajo,
            (select sp_crud_obtiene_tabla_deno (pd.id_unidad_trabajo)) AS unidad_trabajo,
            e.razon_social,
            pd.estado,
            a.fech_marc_rel,
            a.fech_sali_rel,
            a.minu_dife_eas AS tiempo_trabajado,
            a.id_deta_operacion,
            tj.desc_just_jus,
            a.id AS id_asistencia,
            a.tipo_marc_eas,
            a.hora_marc_eas,
            a.hora_marc_sal,
            a.minu_dife_pap
        FROM tmp_fecha_personas t0
        JOIN personas t1 ON t0.id_persona = t1.id
        LEFT JOIN persona_detalles pd
          ON pd.id_persona = t1.id
         AND pd.estado IN ('A','C')
         AND pd.eliminado = 'N'
        LEFT JOIN documento_identidades di ON di.id = t1.tipo_documento
        LEFT JOIN ubicacion_trabajos ut ON ut.id = pd.id_ubicacion
        LEFT JOIN empresas e ON e.id = ut.id_empresa
        LEFT JOIN turno_unico tu
          ON pd.id_persona = tu.id_persona
         AND tu.nume_ndia_dtu::int = CASE
               WHEN extract(dow FROM t0.fecha_dias)::int = 0 THEN 7
               ELSE extract(dow FROM t0.fecha_dias)::int
             END
        LEFT JOIN asistencia_unica a
          ON a.id_persona = t1.id
         AND a.fech_regi_mar::date = t0.fecha_dias
        LEFT JOIN deta_operaciones deo ON a.id_deta_operacion = deo.id
        LEFT JOIN tabla_ubicaciones tab_ubi ON deo.id_tipo_operacion = tab_ubi.id
        LEFT JOIN tipo_justificaciones tj ON tab_ubi.id_registro = tj.id
        WHERE 1=1
          AND (p_persona = '' OR t1.id::text = p_persona)
          AND (p_area = '' OR pd.id_area_trabajo::text = p_area)
          AND (p_unidad = '' OR pd.id_unidad_trabajo::text = p_unidad)
          AND (p_sede = '' OR pd.id_sede::text = p_sede)
          AND (p_condicion_laboral = '' OR pd.id_condicion_laboral::text = p_condicion_laboral)
          AND (
                p_fecha_ini = ''
                OR (
                    a.fech_regi_mar IS NOT NULL
                    AND a.fech_regi_mar::timestamp >= to_timestamp(p_fecha_ini||' 00:00:00','DD/MM/YYYY HH24:MI:SS')
                )
          )
          AND (
                p_fecha_fin = ''
                OR (
                    a.fech_regi_mar IS NOT NULL
                    AND a.fech_regi_mar::timestamp <= to_timestamp(p_fecha_fin||' 23:59:59','DD/MM/YYYY HH24:MI:SS')
                )
          )
          AND (
                p_estado = '' OR
                (p_estado = '3' AND t0.es_feriado = 0 AND coalesce(a.flag_labo_dtu, tu.flag_labo_dtu) = 'S'
                 AND (a.fech_marc_rel IS NULL OR a.fech_sali_rel IS NULL))
          )
    )
    SELECT *,
           count(*) OVER() AS TotalRows
    FROM base
    ORDER BY fecha_raw ASC, id_pe DESC
    LIMIT p_limit::integer OFFSET v_offset;

    RETURN p_ref;
END
$function$;
