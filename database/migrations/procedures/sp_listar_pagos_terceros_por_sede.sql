--DROP FUNCTION sp_listar_pagos_terceros_por_sede(bigint,character varying,character varying);
CREATE OR REPLACE FUNCTION sp_listar_pagos_terceros_por_sede(
    p_id_sede         bigint,
    p_num_documento   varchar,
    p_busqueda_nombre varchar
)
RETURNS TABLE (
    id_persona           bigint,
    tipo_documento       bigint,
    numero_documento     varchar,
    apellido_paterno     varchar,
    apellido_materno     varchar,
    nombres              varchar,
    fecha_nacimiento     date,
    sexo	 							 varchar,
    telefono             varchar,
    email                varchar,
    fecha_ingreso        date,
    condicion_laboral    varchar,
    nomb_cort_lab        varchar,
    num_cuenta_sueldo    varchar,
    cci_sueldo           varchar,
    id_banco_sueldo      bigint,
    id_area_trabajo      bigint,
    area_trabajo 				 varchar,
    id_unidad_trabajo    bigint,
    unidad_trabajo 			 varchar,
    id_sede              bigint,
    id_cliente_ubicacion bigint,
    denominacion_ubic    varchar,
    estado 							 varchar
)
LANGUAGE plpgsql
AS
$$
BEGIN
    RETURN QUERY
    SELECT
        p.id                           AS id_persona,
        p.tipo_documento,
        p.numero_documento,
        p.apellido_paterno,
        p.apellido_materno,
        p.nombres,
        p.fecha_nacimiento,
        p.sexo,
        pd.telefono,
        pd.email,
        pd.fecha_ingreso,
        cl.desc_cond_lab               AS condicion_laboral,
        cl.nomb_cort_lab,
        pd.num_cuenta_sueldo,
        pd.cci_sueldo,
        pd.id_banco_sueldo,
        pd.id_area_trabajo,
				(select sp_crud_obtiene_tabla_deno (pd.id_area_trabajo)) area_trabajo,
        pd.id_unidad_trabajo,
				(select sp_crud_obtiene_tabla_deno (pd.id_unidad_trabajo)) unidad_trabajo,
        pd.id_sede,
        tu.id_cliente                  AS id_cliente_ubicacion,
        tu.columna_den                 AS denominacion_ubic,
				pd.estado
    FROM personas p
    JOIN persona_detalles pd
          ON pd.id_persona = p.id
    JOIN tabla_ubicaciones tu
          ON tu.id = pd.id_condicion_laboral
         AND tu.tabla = 'condicion_laborales'
         --AND COALESCE(tu.estado, '1') = '1'
    JOIN condicion_laborales cl
          ON cl.id = tu.id_registro

    WHERE cl.desc_cond_lab = 'RECIBO POR HONORARIO'
      -- AND COALESCE(p.estado, '1') = '1'
      -- AND COALESCE(pd.estado, '1') = '1'

      AND (p_id_sede IS NULL OR pd.id_sede = p_id_sede)

      AND (
            p_num_documento IS NULL
         OR p_num_documento = ''
         OR p.numero_documento ILIKE '%' || p_num_documento || '%'
      )

      AND (
            p_busqueda_nombre IS NULL
         OR p_busqueda_nombre = ''
         OR p.apellido_paterno ILIKE '%' || p_busqueda_nombre || '%'
         OR p.apellido_materno ILIKE '%' || p_busqueda_nombre || '%'
         OR p.nombres          ILIKE '%' || p_busqueda_nombre || '%'
      )
;
END;
$$;
