CREATE OR REPLACE FUNCTION public.sp_listar_persona_paginado_nuevo(
    p_numero_documento      character varying,
    p_persona               character varying,
    p_unidad                character varying,
    p_empresa               character varying,
    p_id_user               character varying,
    p_estado                character varying,
    p_pagina                character varying,
    p_limit                 character varying,
    p_sede_actual           integer,
    p_ref                   refcursor
)
RETURNS refcursor
LANGUAGE plpgsql
AS $function$
DECLARE
    v_scad          text;
    v_campos        text;
    v_tabla         text;
    v_where         text;
    v_count         integer;
    v_col_count     text;
    v_id_rol        integer;
    v_user_id_int   integer;
    v_user_type     text;
BEGIN
    v_user_id_int := p_id_user::integer;

    -- Tipo de usuario (admin/user) desde tabla users
    SELECT type
      INTO v_user_type
      FROM users
     WHERE id = v_user_id_int;

    -- (opcional) rol principal, si aún lo usas
    SELECT role_id
      INTO v_id_rol
      FROM model_has_roles mhr
     WHERE mhr.model_id = v_user_id_int
     LIMIT 1;

    -- paginación
    p_pagina := (p_pagina::integer - 1) * p_limit::integer;

    v_campos := ' p.id id_pe, pd.id id_pd, di.abre_docu_did tipo_documento, p.numero_documento,
                  p.apellido_paterno||'' ''||p.apellido_materno||'' ''||p.nombres persona,
                  p.fecha_nacimiento, p.sexo,
                  (select sp_crud_obtiene_tabla_deno (pd.id_cargo)) cargo,
                  (select sp_crud_obtiene_tabla_deno (pd.id_condicion_laboral)) condicion_laboral,
                  (select sp_crud_obtiene_tabla_deno (pd.id_regimen_pensionario)) regimen,
                  (select sp_crud_obtiene_tabla_deno (pd.id_area_trabajo)) area_trabajo,
                  (select sp_crud_obtiene_tabla_deno (pd.id_unidad_trabajo)) unidad_trabajo,
                  e.razon_social, pd.estado, c.mont_cont_ctr ';

    v_tabla := ' FROM personas p
                 LEFT JOIN persona_detalles pd ON pd.id_persona = p.id
                 LEFT JOIN documento_identidades di ON di.id = p.tipo_documento
                 LEFT JOIN ubicacion_trabajos ut  ON ut.id = pd.id_ubicacion
                 LEFT JOIN empresas e  ON e.id = ut.id_empresa
                 LEFT JOIN contratos c  ON c.id = pd.id_contrato ';

    v_where := ' WHERE pd.eliminado = ''N'' ';

    IF p_estado <> '' THEN
        v_where := v_where || 'AND pd.estado = ''' || p_estado || ''' ';
    END IF;

    IF p_numero_documento <> '' THEN
        v_where := v_where || 'AND p.numero_documento ILIKE ''%' || p_numero_documento || '%'' ';
    END IF;

    IF p_persona <> '' THEN
        v_where := v_where
            || 'AND p.apellido_paterno||'' ''||p.apellido_materno||'' ''||p.nombres ILIKE ''%'
            || p_persona || '%'' ';
    END IF;

    IF p_empresa <> '' THEN
        v_where := v_where || 'AND e.razon_social ILIKE ''%' || p_empresa || '%'' ';
    END IF;

    IF p_unidad <> '' THEN
        v_where := v_where
            || 'AND (select sp_crud_obtiene_tabla_deno (pd.id_unidad_trabajo)) ILIKE ''%'
            || p_unidad || '%'' ';
    END IF;

    -- Si NO es admin, restringir por sedes de sus roles
    IF v_user_type <> 'admin' THEN
        v_where := v_where ||
            'AND pd.id_sede IN (' ||
                'SELECT DISTINCT rs.sede_id ' ||
                'FROM model_has_roles mhr ' ||
                'JOIN role_sede rs ON mhr.role_id = rs.role_id ' ||
                'WHERE mhr.model_id = ' || v_user_id_int::varchar ||
            ') ';
    END IF;

    -- Filtro por sede actual (si viene)
    IF p_sede_actual IS NOT NULL THEN
        v_where := v_where || 'AND pd.id_sede = ' || p_sede_actual::varchar || ' ';
    END IF;

    -- total filas
    EXECUTE 'SELECT count(1) ' || v_tabla || v_where INTO v_count;
    v_col_count := ' ,' || v_count::text || ' AS totalrows ';

    IF v_count > p_limit::integer THEN
        v_scad := 'SELECT ' || v_campos || v_col_count || v_tabla || v_where
                  || ' ORDER BY e.razon_social, persona LIMIT ' || p_limit
                  || ' OFFSET ' || p_pagina || ';';
    ELSE
        v_scad := 'SELECT ' || v_campos || v_col_count || v_tabla || v_where
                  || ' ORDER BY e.razon_social, persona;';
    END IF;

    OPEN p_ref FOR EXECUTE v_scad;

    RETURN p_ref;
END;
$function$;
