<?php
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\TermsController;
use App\Http\Controllers\Frontend\TablaController;
use App\Http\Controllers\Frontend\TplanillaController;
use App\Http\Controllers\Frontend\TbancoController;
use App\Http\Controllers\Frontend\EmpresaController;
use App\Http\Controllers\Frontend\VacacioneController;
use App\Http\Controllers\Frontend\ClienteController;
use App\Http\Controllers\Frontend\PersonaDetalleController;
use App\Http\Controllers\Frontend\AsistenciaController;
use App\Http\Controllers\Frontend\TturnoController;
use App\Http\Controllers\Frontend\DetalleTurnoController;
use App\Http\Controllers\Frontend\PersonalTurnoController;
use App\Http\Controllers\Frontend\UbigeoController;
use App\Http\Controllers\Frontend\TdiasFeriadoController;
use App\Http\Controllers\Frontend\TipoOperacioneController;
use App\Http\Controllers\Frontend\DetaOperacioneController;
use App\Http\Controllers\Frontend\ReporteController;
use App\Http\Controllers\Frontend\UnidadController;
use App\Http\Controllers\Frontend\PapeletaController;
use App\Http\Controllers\Frontend\FormulaController;
use App\Http\Controllers\Frontend\SubtplanillaController;
use App\Http\Controllers\Frontend\ConceptoController;
use App\Http\Controllers\Frontend\PlanillaCalculadaController;
use App\Http\Controllers\Frontend\BoletaController;
use App\Http\Controllers\Frontend\ConceptoPlanController;
use App\Http\Controllers\Frontend\MenuPersonaController;
use App\Http\Controllers\Frontend\ClienteUserController;
use App\Http\Controllers\Frontend\TarjetaController;
use App\Http\Controllers\Frontend\PersonaController;
use App\Http\Controllers\Frontend\SedeController;
use App\Http\Controllers\Frontend\TerceroController;
use App\Http\Controllers\Frontend\ReciboTerceroController;
use Tabuna\Breadcrumbs\Trail;

Route::get('/info', function () {
    phpinfo();
})->name('phpmyinfo');

Route::get('/', [HomeController::class, 'index'])
    ->name('index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.user.account'));
    });

Route::get('/terceros/{persona}/recibos/create', [ReciboTerceroController::class, 'create'])
    ->name('terceros.recibos.create');

Route::post('/terceros/{persona}/recibos', [ReciboTerceroController::class, 'store'])
    ->name('terceros.recibos.store');

Route::middleware('auth')->group(function () {


        Route::get('terceros', [TerceroController::class, 'index'])->name('terceros.index');
        Route::post('terceros/buscar', [TerceroController::class, 'buscar'])->name('terceros.buscar');
    /*
     * ADMINISTRATOR: puede ver TODO
     */
    Route::middleware('role:Administrator')->group(function () {
      Log::info("===================== role:Administrator");

        // Mantenimientos completos
        Route::get('manten/create', [TablaController::class, 'index'])->name('manten.index');
        Route::view('contacts', 'users.contacts');

        Route::get('manten/planilla', [TplanillaController::class, 'index'])->name('manten.planilla');
        Route::get('manten/tbancos', [TbancoController::class, 'index'])->name('manten.tbancos');
        Route::get('manten/empresas', [EmpresaController::class, 'index'])->name('manten.empresas');

        // Maestro ubicaciones / clientes / cliente_usuario
        Route::get('maestro/create_ubicacion_maestro', [TablaController::class, 'create_ubicacion_maestro'])->name('maestro.create_ubicacion_maestro');
        Route::post('maestro/listar_ubicacion_maestro_ajax', [TablaController::class, 'listar_ubicacion_maestro_ajax'])->name('maestro.listar_ubicacion_maestro_ajax');
        Route::get('maestro/obtener_ubicacion_maestro_cliente/{id_cliente}/{tabla}/{columna}', [TablaController::class, 'obtener_ubicacion_maestro_cliente'])->name('maestro.obtener_ubicacion_maestro_cliente');

        Route::get('cliente_usuario/create', [ClienteUserController::class, 'create'])->name('cliente_usuario.create');
        Route::post('cliente_usuario/listar_cliente_user_ajax', [ClienteUserController::class, 'listar_cliente_user_ajax'])->name('cliente_usuario.listar_cliente_user_ajax');
        Route::get('cliente_usuario/modal_cliente_user/{id}', [ClienteUserController::class, 'modal_cliente_user'])->name('cliente_usuario.modal_cliente_user');
        Route::post('cliente_usuario/send_cliente_user', [ClienteUserController::class, 'send_cliente_user'])->name('cliente_usuario.send_cliente_user');

        // Menu persona
        Route::get('menu_persona/create_menu', [MenuPersonaController::class, 'create_menu'])->name('menu_persona.create_menu');
        Route::get('menu_persona/create_persona_menu', [MenuPersonaController::class, 'create_persona_menu'])->name('menu_persona.create_persona_menu');
        Route::post('menu_persona/listar_menu_ajax', [MenuPersonaController::class, 'listar_menu_ajax'])->name('menu_persona.listar_menu_ajax');
        Route::post('menu_persona/listar_menu_persona_ajax', [MenuPersonaController::class, 'listar_menu_persona_ajax'])->name('menu_persona.listar_menu_persona_ajax');
        Route::get('menu_persona/modal_menu/{id}', [MenuPersonaController::class, 'modal_menu'])->name('menu_persona.modal_menu');
        Route::get('menu_persona/modal_persona_menu/{id}', [MenuPersonaController::class, 'modal_persona_menu'])->name('menu_persona.modal_persona_menu');
        Route::post('menu_persona/send_menu', [MenuPersonaController::class, 'send_menu'])->name('menu_persona.send_menu');
        Route::post('menu_persona/send_menu_persona', [MenuPersonaController::class, 'send_menu_persona'])->name('menu_persona.send_menu_persona');
        Route::get('menu_persona/eliminar_menu/{id}/{estado}', [MenuPersonaController::class, 'eliminar_menu'])->name('menu_persona.eliminar_menu');
        Route::get('menu_persona/eliminar_menu_persona/{id}/{estado}', [MenuPersonaController::class, 'eliminar_menu_persona'])->name('menu_persona.eliminar_menu_persona');
        Route::get('menu_persona/obtener_menu/{fecha}', [MenuPersonaController::class, 'obtener_menu'])->name('menu_persona.obtener_menu');
    });

    /*
     * JEFE RRHH: todo EXCEPTO:
     * - manten/clientes
     * - maestro/create_ubicacion_maestro
     * - cliente_usuario/create y relacionadas
     * Además, quieres que NO vea planilla, turnos, feriados, fórmulas → simplemente no se definen aquí.
     */
    Route::middleware('role:Administrator|Jefe RRHH')->group(function () {
      Log::info("===================== role:Administrator|Jefe RRHH");
        // Mantenimientos completos
        Route::get('manten/vacaciones', [VacacioneController::class, 'index'])->name('manten.vacaciones');
        Route::get('manten/persona-detalles', [PersonaDetalleController::class, 'index'])->name('manten.persona-detalles');
        Route::get('manten/asistencias', [AsistenciaController::class, 'index'])->name('manten.asistencias');
        Route::get('manten/tturnos', [TturnoController::class, 'index'])->name('manten.tturnos');
        Route::get('manten/tdias_feriados', [TdiasFeriadoController::class, 'index'])->name('manten.tdias-feriados');
        Route::get('manten/tipo_operaciones', [TipoOperacioneController::class, 'index'])->name('manten.tipo-operaciones');
        Route::get('manten/deta-operaciones', [DetaOperacioneController::class, 'index'])->name('manten.deta-operaciones');
        Route::get('manten/formulas', [FormulaController::class, 'index'])->name('manten.formulas');
        Route::get('manten/subtplanillas', [SubtplanillaController::class, 'index'])->name('manten.subtplanillas');
        Route::get('manten/conceptos', [ConceptoController::class, 'index'])->name('manten.conceptos');

        // Concepto plan
        Route::get('concepto_plan/create', [ConceptoPlanController::class, 'create'])->name('concepto_plan.create');
        Route::post('concepto_plan/listar_concepto_plan_ajax', [ConceptoPlanController::class, 'listar_concepto_plan_ajax'])->name('concepto_plan.listar_concepto_plan_ajax');
        Route::get('concepto_plan/eliminar_concepto_plan/{id}/{estado}', [ConceptoPlanController::class, 'eliminar_concepto_plan'])->name('concepto_plan.eliminar_concepto_plan');
        Route::get('concepto_plan/modal_concepto_plan/{id}', [ConceptoPlanController::class, 'modal_concepto_plan'])->name('concepto_plan.modal_concepto_plan');
        Route::post('concepto_plan/send_concepto_plan', [ConceptoPlanController::class, 'send_concepto_plan'])->name('concepto_plan.send_concepto_plan');

        // Fórmulas
        Route::get('formula/create', [FormulaController::class, 'create'])->name('formula.create');
        Route::post('formula/listar_formula_ajax', [FormulaController::class, 'listar_formula_ajax'])->name('formula.listar_formula_ajax');
        Route::get('formula/modal_formula/{id}', [FormulaController::class, 'modal_formula'])->name('formula.modal_formula');
        Route::post('formula/send_formula', [FormulaController::class, 'send_formula'])->name('formula.send_formula');
        Route::get('formula/eliminar_formula/{id}/{estado}', [FormulaController::class, 'eliminar_formula'])->name('formula.eliminar_formula');

    });

    /*
     * ASISTENTE RRHH VES / OXA:
     * - Mismas pantallas que Jefe RRHH (sin planilla, turnos, feriados, fórmulas)
     * - Limitado a su sede vía middleware 'sede.access'
     */
    Route::middleware(['role:Administrator|Jefe RRHH|Asistente RRHH VES|Asistente RRHH OXA', 'sede.access'])->group(function () {
      Log::info("===================== role:Administrator|Jefe RRHH|Asistente RRHH VES|Asistente RRHH OXA");

        // Persona / PersonaDetalle / Ubigeo / Unidad / Papeleta / Reportes / etc. (todo lo que ya tenías)
        Route::get('persona', [PersonaController::class, 'index'])->name('persona');
        Route::post('persona/listar_persona_ajax', [PersonaController::class, 'listar_persona_ajax'])->name('persona.listar_persona_ajax');
        Route::get('persona/modal_persona/{id}', [PersonaController::class, 'modal_persona'])->name('persona.modal_persona');
        Route::post('persona/send_persona', [PersonaController::class, 'send_persona'])->name('persona.send_persona');
        Route::get('persona/eliminar_persona/{id}/{estado}', [PersonaController::class, 'eliminar_persona'])->name('persona.eliminar_persona');
        Route::get('persona/obtener_persona/{tipo_documento}/{numero_documento}', [PersonaController::class, 'obtener_persona'])->name('persona.obtener_persona')->where('tipo_documento', '(.*)');
        Route::get('persona/buscar_persona/{tipo_documento}/{numero_documento}', [PersonaController::class, 'buscar_persona'])->name('persona.buscar_persona');
        Route::get('persona/create', [PersonaController::class, 'create'])->name('persona.create');
        Route::get('persona/list_persona/{term}', [PersonaController::class, 'list_persona'])->name('persona.list_persona');

        Route::get('manten/detalle_turnos', [DetalleTurnoController::class, 'index'])->name('manten.detalle-turnos');
        Route::get('manten/personal_turnos', [PersonalTurnoController::class, 'index'])->name('manten.personal-turnos');

        Route::post('persona/send_personad', [PersonaDetalleController::class, 'send_personad'])->name('persona.send_personad');
        Route::get('persona/eliminar_personad/{id}/{estado}', [PersonaDetalleController::class, 'eliminar_personad'])->name('persona.eliminar_personad');
        Route::get('personalTurno/list_persona/{term}', [PersonalTurnoController::class, 'list_persona'])->name('personalTurno.list_persona');

        Route::get('persona/modal_persona_contrato/{id}', [PersonaController::class, 'modal_persona_contrato'])->name('persona.modal_persona_contrato');
        Route::post('persona/send_persona_contrato', [PersonaController::class, 'send_persona_contrato'])->name('persona.send_persona_contrato');

        Route::get('papeleta/create', [DetaOperacioneController::class, 'create'])->name('papeleta.create');
        Route::post('papeleta/listar_papeleta_ajax', [DetaOperacioneController::class, 'listar_papeleta_ajax'])->name('papeleta.listar_papeleta_ajax');
        Route::get('papeleta/eliminar_papeleta/{id}/{estado}', [DetaOperacioneController::class, 'eliminar_papeleta'])->name('papeleta.eliminar_papeleta');
        Route::get('papeleta/modal_papeleta/{id}', [DetaOperacioneController::class, 'modal_papeleta'])->name('papeleta.modal_papeleta');
        Route::post('papeleta/send_papeleta', [DetaOperacioneController::class, 'send_papeleta'])->name('papeleta.send_papeleta');
        Route::post('papeleta/upload_papeleta', [DetaOperacioneController::class, 'upload_papeleta'])->name('papeleta.upload_papeleta');

        Route::get('/ubigeo/obtener_departamento/{id}', [UbigeoController::class, 'obtener_departamento'])->name('ubigeo.obtener_departamento');
        Route::get('/ubigeo/obtener_provincia/{id}', [UbigeoController::class, 'obtener_provincia'])->name('ubigeo.obtener_provincia');
        Route::get('/ubigeo/obtener_distrito/{id}', [UbigeoController::class, 'obtener_distrito'])->name('ubigeo.obtener_distrito');

        Route::get('reporte/reporte_area', [ReporteController::class, 'reporte_area'])->name('manten.reporte_area');
        Route::post('reporte/listar_reporte_area_ajax', [ReporteController::class, 'listar_reporte_area_ajax'])->name('reporte.listar_reporte_area_ajax');

        Route::get('/unidad/obtener_unidad/{id}', [UnidadController::class, 'obtener_unidad'])->name('unidad.obtener_unidad');

        // PLANILLA (todas las rutas de planilla)
        Route::get('planilla/create', [PlanillaCalculadaController::class, 'create'])->name('planilla.create');
        Route::post('planilla/listar_metas_persona_ajax', [PlanillaCalculadaController::class, 'listar_metas_persona_ajax'])->name('planilla.listar_metas_persona_ajax');
        Route::post('planilla/listar_planilla_ajax', [PlanillaCalculadaController::class, 'listar_planilla_ajax'])->name('planilla.listar_planilla_ajax');
        Route::get('planilla/obtener_sub_planilla/{id_planilla}', [PlanillaCalculadaController::class, 'obtener_sub_planilla'])->name('planilla.obtener_sub_planilla');
        Route::get('planilla/obtener_concepto_persona/{id_periodo}/{id_persona}', [PlanillaCalculadaController::class, 'obtener_concepto_persona'])->name('planilla.obtener_concepto_persona');
        Route::get('planilla/obtener_concepto_persona_resumen/{id_planilla}/{id_subplanilla}/{id_persona}', [PlanillaCalculadaController::class, 'obtener_concepto_persona_resumen'])->name('planilla.obtener_concepto_persona_resumen');
        Route::post('planilla/send', [PlanillaCalculadaController::class, 'send'])->name('planilla.send');
        Route::get('planilla/obtener_periodo/{id_ubicacion}/{id_planilla}/{id_subplanilla}/{anio}/{mes}/{rd_tipo}', [PlanillaCalculadaController::class, 'obtener_periodo'])->name('planilla.obtener_periodo');
        Route::get('planilla/eliminar_concepto_persona/{id}', [PlanillaCalculadaController::class, 'eliminar_concepto_persona'])->name('planilla.eliminar_concepto_persona');
        Route::get('planilla/modal_concepto_persona/{id}/{id_periodo}/{id_persona}', [PlanillaCalculadaController::class, 'modal_concepto_persona'])->name('planilla.modal_concepto_persona');
        Route::post('planilla/send_concepto_persona', [PlanillaCalculadaController::class, 'send_concepto_persona'])->name('planilla.send_concepto_persona');
        Route::get('planilla/create_resumen_asistencia', [PlanillaCalculadaController::class, 'create_resumen_asistencia'])->name('planilla.create_resumen_asistencia');
        Route::get('planilla/modal_concepto_persona_resumen/{id}/{id_planilla}/{id_subplanilla}/{id_persona}', [PlanillaCalculadaController::class, 'modal_concepto_persona_resumen'])->name('planilla.modal_concepto_persona_resumen');
        Route::post('planilla/send_resumen', [PlanillaCalculadaController::class, 'send_resumen'])->name('planilla.send_resumen');
        Route::get('planilla/modal_persona/{id_periodo}', [PlanillaCalculadaController::class, 'modal_persona'])->name('planilla.modal_persona');
        Route::post('planilla/send_meta_persona', [PlanillaCalculadaController::class, 'send_meta_persona'])->name('planilla.send_meta_persona');
        Route::get('planilla/listar_planilla_persona', [PlanillaCalculadaController::class, 'listar_planilla_persona'])->name('planilla.listar_planilla_persona');
        Route::post('planilla/listar_planilla_persona_ajax', [PlanillaCalculadaController::class, 'listar_planilla_persona_ajax'])->name('planilla.listar_planilla_persona_ajax');
        Route::get('planilla/create_planilla_persona', [PlanillaCalculadaController::class, 'create_planilla_persona'])->name('planilla.create_planilla_persona');
        Route::get('planilla/agregar_persona_planilla/{id}', [PlanillaCalculadaController::class, 'agregar_persona_planilla'])->name('planilla.agregar_persona_planilla');
        Route::get('planilla/obtener_metas_persona/{id_periodo}', [PlanillaCalculadaController::class, 'obtener_metas_persona'])->name('planilla.obtener_metas_persona');
        Route::get('planilla/listar_metas_persona/{id_ubicacion}/{id_planilla}/{id_subplanilla}/{anio}/{mes}', [PlanillaCalculadaController::class, 'listar_metas_persona'])->name('planilla.listar_metas_persona');
        Route::get('planilla/actualizar_periodo/{id}/{estado}', [PlanillaCalculadaController::class, 'actualizar_periodo'])->name('planilla.actualizar_periodo');
        Route::get('planilla/generar_planilla_calculada_periodo/{id}', [PlanillaCalculadaController::class, 'generar_planilla_calculada_periodo'])->name('planilla.generar_planilla_calculada_periodo');
        Route::get('planilla/eliminar_planilla_calculada_periodo/{id}', [PlanillaCalculadaController::class, 'eliminar_planilla_calculada_periodo'])->name('planilla.eliminar_planilla_calculada_periodo');
        Route::get('planilla/eliminar_meta_persona/{id}', [PlanillaCalculadaController::class, 'eliminar_meta_persona'])->name('planilla.eliminar_meta_persona');
        Route::get('planilla/obtener_concepto_planilla/{id_periodo}/{id_persona}', [PlanillaCalculadaController::class, 'obtener_concepto_planilla'])->name('planilla.obtener_concepto_planilla');
        Route::get('planilla/obtener_concepto_planilla_resumen/{id_periodo}/{id_persona}', [PlanillaCalculadaController::class, 'obtener_concepto_planilla_resumen'])->name('planilla.obtener_concepto_planilla_resumen');
        Route::get('planilla/listar_planilla_resumen', [PlanillaCalculadaController::class, 'listar_planilla_resumen'])->name('planilla.listar_planilla_resumen');
        Route::post('planilla/listar_planilla_resumen_ajax', [PlanillaCalculadaController::class, 'listar_planilla_resumen_ajax'])->name('planilla.listar_planilla_resumen_ajax');
        Route::post('planilla/listar_periodo_ajax', [PlanillaCalculadaController::class, 'listar_periodo_ajax'])->name('planilla.listar_periodo_ajax');

        // Boletas
        Route::get('/boleta_pdf/{id_periodo}/{id_persona}',[BoletaController::class, 'boletaPDF'])->name('boleta_pfd.boletaPDF');
        Route::get('/boleta_vista_previa/{id_periodo}/{id_persona}',[BoletaController::class, 'boletaVistaPrevia'])->name('boleta_pfd.boletaVistaPrevia');
        Route::get('/genera_boletas/{id_periodo}', [BoletaController::class, 'guardarBoletasPDF'])->name('boleta_pfd.guardarBoletasPDF');

        // Feriados
        Route::get('feriado/create', [TdiasFeriadoController::class, 'create'])->name('feriado.create');
        Route::post('feriado/listar_feriado_ajax', [TdiasFeriadoController::class, 'listar_feriado_ajax'])->name('feriado.listar_feriado_ajax');
        Route::get('feriado/modal_feriado/{id}', [TdiasFeriadoController::class, 'modal_feriado'])->name('feriado.modal_feriado');
        Route::post('feriado/send_feriado', [TdiasFeriadoController::class, 'send_feriado'])->name('feriado.send_feriado');
        Route::get('feriado/eliminar_feriado/{id}/{estado}', [TdiasFeriadoController::class, 'eliminar_feriado'])->name('feriado.eliminar_feriado');

        // Tarjeta
        Route::get('tarjeta/create', [TarjetaController::class, 'create'])->name('tarjeta.create');
        Route::post('tarjeta/listar_tarjeta_ajax', [TarjetaController::class, 'listar_tarjeta_ajax'])->name('tarjeta.listar_tarjeta_ajax');
        Route::get('tarjeta/modal_tarjeta/{id}', [TarjetaController::class, 'modal_tarjeta'])->name('tarjeta.modal_tarjeta');
        Route::get('tarjeta/list_persona/{term}', [TarjetaController::class, 'list_persona'])->name('tarjeta.list_persona');
        Route::post('tarjeta/send_tarjeta', [TarjetaController::class, 'send_tarjeta'])->name('tarjeta.send_tarjeta');
        Route::get('tarjeta/eliminar_tarjeta/{id}/{estado}', [TarjetaController::class, 'eliminar_tarjeta'])->name('tarjeta.eliminar_tarjeta');
        Route::post('tarjeta/eliminar_tarjeta_bloque', [TarjetaController::class, 'eliminar_tarjeta_bloque'])->name('tarjeta.eliminar_tarjeta_bloque');

        // Contactos de emergencia
        Route::get('persona/modal_persona_contacto_emergencia/{id_persona}/{id}', [PersonaController::class, 'modal_persona_contacto_emergencia'])->name('persona.modal_persona_contacto_emergencia');
        Route::post('persona/send_contacto_emergencia', [PersonaController::class, 'send_contacto_emergencia'])->name('persona.send_contacto_emergencia');
        Route::get('persona/create_contacto_emergencia', [PersonaController::class, 'create_contacto_emergencia'])->name('persona.create_contacto_emergencia');
        Route::post('persona/listar_persona_contacto_emergencia_ajax', [PersonaController::class, 'listar_persona_contacto_emergencia_ajax'])->name('persona.listar_persona_contacto_emergencia_ajax');

        Route::get('persona/valida_persona/{id}', [PersonaDetalleController::class, 'valida_persona'])->name('persona.valida_persona');
        Route::get('persona/cargar_contrato_pdf/{id}', [PersonaController::class, 'cargar_contrato_pdf'])->name('persona.cargar_contrato_pdf');
        Route::get('persona/exportar_persona/{numero_documento}/{persona}/{unidad_trabajo}/{empresa}/{estado}', [PersonaController::class, 'exportar_persona'])->name('persona.exportar_persona');

    });

    /*
     * CONTROL ASISTENCIA: solo asistencia
     */
    Route::middleware(['role:Administrator|Jefe RRHH|Asistente RRHH VES|Asistente RRHH OXA|Control Asistencia', 'sede.access'])->group(function () {
      Log::info("===================== role:Administrator|Jefe RRHH|Asistente RRHH VES|Asistente RRHH OXA|Control Asistencia");
        // Asistencia (todas las acciones)
        Route::get('asistencia/listar_asistencia', [AsistenciaController::class, 'listar_asistencia'])->name('asistencia.listar_asistencia');
        Route::post('asistencia/listar_asistencia_ajax', [AsistenciaController::class, 'listar_asistencia_ajax'])->name('asistencia.listar_asistencia_ajax');
        Route::get('asistencia/modal_asistencia/{id}', [AsistenciaController::class, 'modal_asistencia'])->name('asistencia.modal_asistencia');
        Route::post('asistencia/send_asistencia', [AsistenciaController::class, 'send_asistencia'])->name('asistencia.send_asistencia');
        Route::get('asistencia/resumen', [AsistenciaController::class, 'resumen'])->name('asistencia.resumen');
        Route::post('asistencia/listar_asistencia_resumen_ajax', [AsistenciaController::class, 'listar_asistencia_resumen_ajax'])->name('asistencia.listar_asistencia_resumen_ajax');
        Route::get('asistencia/modal_zkteco_log/{fecha}/{numero_documento}', [AsistenciaController::class, 'modal_zkteco_log'])->name('asistencia.modal_zkteco_log');
        Route::get('asistencia/asistencia_automatico/{fecha}', [AsistenciaController::class, 'asistencia_automatico'])->name('asistencia.asistencia_automatico');
        Route::get('asistencia/exportar_listar_reporte_asistencia/{id_area_trabajo}/{id_unidad_trabajo}/{id_persona}/{anio}/{mes}/{fecha_ini}/{fecha_fin}/{id_sede}/{id_condicion_laboral}/{estado}', [AsistenciaController::class, 'exportar_listar_reporte_asistencia'])->name('asistencia.exportar_listar_reporte_asistencia');
    });

    Route::middleware(['role:Administrator|Jefe RRHH|Asistente RRHH VES|Asistente RRHH OXA', 'sede.access'])->group(function () {
        Route::get('manten/tturnos', [TturnoController::class, 'index'])->name('manten.tturnos');
    });

    Route::post('/cambiar-sede-actual', [SedeController::class, 'cambiarSedeActual'])->name('sede.cambiar');

});

Route::get('terms', [TermsController::class, 'index'])
    ->name('pages.terms')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
    });

