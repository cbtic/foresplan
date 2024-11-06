<?php
# Inicio importacion de Modelos
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
# Fin importacion de Modelos

use Tabuna\Breadcrumbs\Trail;

use App\Http\Controllers\Frontend\PersonaController;

/*
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */

Route::get('/info', function () {
    phpinfo(); 
})->name('phpmyinfo');

Route::get('/', [HomeController::class, 'index'])
    ->name('index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('frontend.index'));
    });

// Route::get('manten/create', [TablaController::class, 'create'])->name('manten.create');
Route::get('manten/create', [TablaController::class, 'index'])->name('manten.index');
Route::view('contacts', 'users.contacts');
// Route::post('manten/listar_concepto_ajax', [ConceptoController::class, 'listar_concepto_ajax'])->name('manten.listar_concepto_ajax');

# Inicio rutas de mantenimiento
Route::get('manten/planilla', [TplanillaController::class, 'index'])->name('manten.planilla');
Route::get('manten/tbancos', [TbancoController::class, 'index'])->name('manten.tbancos');
Route::get('manten/empresas', [EmpresaController::class, 'index'])->name('manten.empresas');
Route::get('manten/vacaciones', [VacacioneController::class, 'index'])->name('manten.vacaciones');
Route::get('manten/clientes', [ClienteController::class, 'index'])->name('manten.clientes');
Route::get('manten/persona-detalles', [PersonaDetalleController::class, 'index'])->name('manten.persona-detalles');
Route::get('manten/asistencias', [AsistenciaController::class, 'index'])->name('manten.asistencias');
Route::get('asistencia/listar_asistencia', [AsistenciaController::class, 'listar_asistencia'])->name('asistencia.listar_asistencia');
Route::post('asistencia/listar_asistencia_ajax', [AsistenciaController::class, 'listar_asistencia_ajax'])->name('asistencia.listar_asistencia_ajax');
Route::get('asistencia/modal_asistencia/{id}', [AsistenciaController::class, 'modal_asistencia'])->name('asistencia.modal_asistencia');
Route::post('asistencia/send_asistencia', [AsistenciaController::class, 'send_asistencia'])->name('asistencia.send_asistencia');
Route::get('asistencia/resumen', [AsistenciaController::class, 'resumen'])->name('asistencia.resumen');
Route::post('asistencia/listar_asistencia_resumen_ajax', [AsistenciaController::class, 'listar_asistencia_resumen_ajax'])->name('asistencia.listar_asistencia_resumen_ajax');

Route::get('asistencia/modal_zkteco_log/{fecha}/{numero_documento}', [AsistenciaController::class, 'modal_zkteco_log'])->name('asistencia.modal_zkteco_log');

Route::get('manten/tturnos', [TturnoController::class, 'index'])->name('manten.tturnos');
Route::get('manten/detalle_turnos', [DetalleTurnoController::class, 'index'])->name('manten.detalle-turnos');
Route::get('manten/personal_turnos', [PersonalTurnoController::class, 'index'])->name('manten.personal-turnos');
Route::get('manten/tdias_feriados', [TdiasFeriadoController::class, 'index'])->name('manten.tdias-feriados');
Route::get('manten/tipo_operaciones', [TipoOperacioneController::class, 'index'])->name('manten.tipo-operaciones');
Route::get('manten/deta-operaciones', [DetaOperacioneController::class, 'index'])->name('manten.deta-operaciones');
Route::get('manten/formulas', [FormulaController::class, 'index'])->name('manten.formulas');
Route::get('manten/subtplanillas', [SubtplanillaController::class, 'index'])->name('manten.subtplanillas');
Route::get('manten/conceptos', [ConceptoController::class, 'index'])->name('manten.conceptos');
# Fin rutas de mantenimiento

Route::get('terms', [TermsController::class, 'index'])
    ->name('pages.terms')
    ->breadcrumbs(function (Trail $trail) {
        $trail->parent('frontend.index')
            ->push(__('Terms & Conditions'), route('frontend.pages.terms'));
    });

Route::get('persona', [personaController::class, 'index'])->name('persona');
Route::post('persona/listar_persona_ajax', [PersonaController::class, 'listar_persona_ajax'])->name('persona.listar_persona_ajax');
Route::get('persona/modal_persona/{id}', [PersonaController::class, 'modal_persona'])->name('persona.modal_persona');
Route::post('persona/send_persona', [PersonaController::class, 'send_persona'])->name('persona.send_persona');
Route::get('persona/eliminar_persona/{id}/{estado}', [PersonaController::class, 'eliminar_persona'])->name('persona.eliminar_persona');
Route::get('persona/obtener_persona/{tipo_documento}/{numero_documento}', [PersonaController::class, 'obtener_persona'])->name('persona.obtener_persona')->where('tipo_documento', '(.*)');
Route::get('persona/buscar_persona/{tipo_documento}/{numero_documento}', [PersonaController::class, 'buscar_persona'])->name('persona.buscar_persona');
Route::get('persona/create', [personaController::class, 'create'])->name('persona.create');
Route::get('persona/list_persona/{term}', [personaController::class, 'list_persona'])->name('persona.list_persona');

Route::post('persona/send_personad', [PersonaDetalleController::class, 'send_personad'])->name('persona.send_personad');
Route::get('persona/eliminar_personad/{id}/{estado}', [PersonaDetalleController::class, 'eliminar_personad'])->name('persona.eliminar_personad');
Route::get('personalTurno/list_persona/{term}', [PersonalTurnoController::class, 'list_persona'])->name('personalTurno.list_persona');

Route::get('persona/modal_persona_contrato/{id}', [personaController::class, 'modal_persona_contrato'])->name('persona.modal_persona_contrato');
Route::post('persona/send_persona_contrato', [personaController::class, 'send_persona_contrato'])->name('persona.send_persona_contrato');


Route::get('papeleta/create', [DetaOperacioneController::class, 'create'])->name('papeleta.create');
Route::post('papeleta/listar_papeleta_ajax', [DetaOperacioneController::class, 'listar_papeleta_ajax'])->name('papeleta.listar_papeleta_ajax');
Route::get('papeleta/eliminar_papeleta/{id}/{estado}', [DetaOperacioneController::class, 'eliminar_papeleta'])->name('papeleta.eliminar_papeleta');
Route::get('papeleta/modal_papeleta/{id}', [DetaOperacioneController::class, 'modal_papeleta'])->name('papeleta.modal_papeleta');
Route::post('papeleta/send_papeleta', [DetaOperacioneController::class, 'send_papeleta'])->name('papeleta.send_papeleta');


Route::get('/ubigeo/obtener_departamento/{id}', [UbigeoController::class, 'obtener_departamento'])->name('ubigeo.obtener_departamento');
Route::get('/ubigeo/obtener_provincia/{id}', [UbigeoController::class, 'obtener_provincia'])->name('ubigeo.obtener_provincia');
Route::get('/ubigeo/obtener_distrito/{id}', [UbigeoController::class, 'obtener_distrito'])->name('ubigeo.obtener_distrito');

Route::get('reporte/reporte_area', [ReporteController::class, 'reporte_area'])->name('manten.reporte_area');
Route::post('reporte/listar_reporte_area_ajax', [ReporteController::class, 'listar_reporte_area_ajax'])->name('reporte.listar_reporte_area_ajax');

Route::get('/unidad/obtener_unidad/{id}', [UnidadController::class, 'obtener_unidad'])->name('unidad.obtener_unidad');



Route::get('planilla/create', [PlanillaCalculadaController::class, 'create'])->name('planilla.create');
//Route::get('planilla/listar_planilla', [PlanillaCalculadaController::class, 'listar_planilla'])->name('planilla.listar_planilla');
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

Route::get('planilla/eliminar_meta_persona/{id}', [PlanillaCalculadaController::class, 'eliminar_meta_persona'])->name('planilla.eliminar_meta_persona');
Route::get('planilla/obtener_concepto_planilla/{id_periodo}/{id_persona}', [PlanillaCalculadaController::class, 'obtener_concepto_planilla'])->name('planilla.obtener_concepto_planilla');
Route::get('planilla/obtener_concepto_planilla_resumen/{id_periodo}/{id_persona}', [PlanillaCalculadaController::class, 'obtener_concepto_planilla_resumen'])->name('planilla.obtener_concepto_planilla_resumen');

Route::get('planilla/listar_planilla_resumen', [PlanillaCalculadaController::class, 'listar_planilla_resumen'])->name('planilla.listar_planilla_resumen');
Route::post('planilla/listar_planilla_resumen_ajax', [PlanillaCalculadaController::class, 'listar_planilla_resumen_ajax'])->name('planilla.listar_planilla_resumen_ajax');

Route::get('maestro/create_ubicacion_maestro', [TablaController::class, 'create_ubicacion_maestro'])->name('maestro.create_ubicacion_maestro');
Route::post('maestro/listar_ubicacion_maestro_ajax', [TablaController::class, 'listar_ubicacion_maestro_ajax'])->name('maestro.listar_ubicacion_maestro_ajax');
Route::get('maestro/obtener_ubicacion_maestro_cliente/{id_cliente}/{tabla}/{columna}', [TablaController::class, 'obtener_ubicacion_maestro_cliente'])->name('maestro.obtener_ubicacion_maestro_cliente');


//Route::get('/ubigeo/obtener_departamento/{id}', 'UbigeoController@obtener_departamento');
//Route::get('/ubigeo/obtener_provincia/{id}', 'UbigeoController@obtener_provincia');
//Route::get('/ubigeo/obtener_distrito/{id}', 'UbigeoController@obtener_distrito');

Route::get('/boleta_pdf/{id_periodo}/{id_persona}',[BoletaController::class, 'boletaPDF'])->name('boleta_pfd.boletaPDF');
Route::get('/boleta_vista_previa/{id_periodo}/{id_persona}',[BoletaController::class, 'boletaVistaPrevia'])->name('boleta_pfd.boletaVistaPrevia');
Route::get('/genera_boletas/{id_periodo}', [BoletaController::class, 'guardarBoletasPDF'])->name('boleta_pfd.guardarBoletasPDF');

Route::get('concepto_plan/create', [ConceptoPlanController::class, 'create'])->name('concepto_plan.create');
Route::post('concepto_plan/listar_concepto_plan_ajax', [ConceptoPlanController::class, 'listar_concepto_plan_ajax'])->name('papeconcepto_planleta.listar_concepto_plan_ajax');
Route::get('concepto_plan/eliminar_concepto_plan/{id}/{estado}', [ConceptoPlanController::class, 'eliminar_concepto_plan'])->name('concepto_plan.eliminar_concepto_plan');
Route::get('concepto_plan/modal_concepto_plan/{id}', [ConceptoPlanController::class, 'modal_concepto_plan'])->name('concepto_plan.modal_concepto_plan');
Route::post('concepto_plan/send_concepto_plan', [ConceptoPlanController::class, 'send_concepto_plan'])->name('concepto_plan.send_concepto_plan');

Route::get('asistencia/asistencia_automatico/{fecha}', [AsistenciaController::class, 'asistencia_automatico'])->name('asistencia.asistencia_automatico');


