<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
//use PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\PersonaDetalle;
use App\Models\Planilla;
use App\Models\PlanillaCalculada;
use App\Models\MetaPersona;
use Illuminate\Support\Facades\DB;
use Luecano\NumeroALetras\NumeroALetras;
use App\Models\UnidadTrabajo;

class BoletaController extends Controller
{
    // Boleta en version PDF
    public function boletaPDF($id_periodo, $id_persona) {
        $pdf = $this->getBoletaContent($id_periodo, $id_persona);
        
        return $pdf->download('boleta_' . strval($id_periodo) . "_" . strval($id_persona) . '.pdf');
    }



    // Boleta en version Vista Previa
    public function boletaVistaPrevia($id_periodo, $id_persona) {

        $total_ingresos=0;
        $total_egresos=0;
        $total_aportes=0;
        $total_aportes_empleador=0;
        $total_neto=0;
        $remuneracion_basica="";
        $anio_mes_planilla="";
        $id_planilla="";

        $planilla_calculada_ingresos = DB::table('planilla_calculadas')
            ->leftJoin('conceptos', 'planilla_calculadas.id_concepto', '=', 'conceptos.id')
            ->where('planilla_calculadas.id_periodo', $id_periodo)->where('planilla_calculadas.id_persona', $id_persona)
            ->where('conceptos.tipo_conc_tco', '1')
            ->get();
        $planilla_calculada_egresos = DB::table('planilla_calculadas')
            ->leftJoin('conceptos', 'planilla_calculadas.id_concepto', '=', 'conceptos.id')
            ->where('planilla_calculadas.id_periodo', $id_periodo)->where('planilla_calculadas.id_persona', $id_persona)
            ->where('conceptos.tipo_conc_tco', '2')
            ->get();
        $planilla_calculada_aportes = DB::table('planilla_calculadas')
            ->leftJoin('conceptos', 'planilla_calculadas.id_concepto', '=', 'conceptos.id')
            ->where('planilla_calculadas.id_periodo', $id_periodo)->where('planilla_calculadas.id_persona', $id_persona)
            ->where('conceptos.tipo_conc_tco', '3')
            ->get();
        $planilla_calculada_aportes_empleador = DB::table('planilla_calculadas')
            ->leftJoin('conceptos', 'planilla_calculadas.id_concepto', '=', 'conceptos.id')
            ->where('planilla_calculadas.id_periodo', $id_periodo)->where('planilla_calculadas.id_persona', $id_persona)
            ->where('conceptos.tipo_conc_tco', '4')
            ->get();
        // $planilla_calculada_egresos = PlanillaCalculada::where('ano_peri_tpe', $anio)->where('nume_peri_tpe', $mes)->where('id_persona', $id_persona)->where('nume_peri_tpe', $mes)->where('tipo_conc_tco', '2')->firstOrFail();

        //Calculando totales
        foreach($planilla_calculada_ingresos as $data) {
            if ($data->codi_conc_tco == '00101') {
                $remuneracion_basica = $data->valo_calc_pca;
            }
            $anio_mes_planilla=$data->nume_peri_tpe."/".$data->ano_peri_tpe;
            $id_planilla = $data->id;
            $total_ingresos += $data->valo_calc_pca;
        }

        foreach($planilla_calculada_egresos as $data) {
            $total_egresos += $data->valo_calc_pca;
            $anio_mes_planilla=$data->nume_peri_tpe."/".$data->ano_peri_tpe;
            $id_planilla = $data->id;
        }

        foreach($planilla_calculada_aportes as $data) {
            $total_aportes += $data->valo_calc_pca;
            $anio_mes_planilla=$data->nume_peri_tpe."/".$data->ano_peri_tpe;
            $id_planilla = $data->id;
        }

        foreach($planilla_calculada_aportes_empleador as $data) {
            $total_aportes_empleador += $data->valo_calc_pca;
            $anio_mes_planilla=$data->nume_peri_tpe."/".$data->ano_peri_tpe;
            $id_planilla = $data->id;
        }

        $total_neto = $total_ingresos - $total_egresos - $total_aportes;

        //Convirtiendo en letras
        $formatter = new NumeroALetras();
        $total_neto_letras = $formatter->toInvoice( $total_neto, 2, 'Soles');
        
        //Datos de la persona
        $persona = Persona::find($id_persona);
        $persona_detalle = PersonaDetalle::where('id_persona', $persona->id)->firstOrFail();
        

        if ($persona_detalle->id_area_trabajo){
            $unidad_model = new UnidadTrabajo;
            $unidad_trabajo_array = $unidad_model->getUnidad($persona_detalle->id_area_trabajo);
            $unidad_trabajo = $unidad_trabajo_array[0]->denominacion;
        }else{$unidad_trabajo='';}

       // print_r($unidad_trabajo);
       // exit();
        
       $pdf = Pdf::loadView('frontend.boletas.boleta-pdf',compact(
        'persona',
        'persona_detalle',
        'planilla_calculada_ingresos',
        'planilla_calculada_egresos',
        'planilla_calculada_aportes',
        'planilla_calculada_aportes_empleador',
        'total_ingresos',
        'total_egresos',
        'total_aportes',
        'total_neto',
        'total_aportes_empleador',
        'total_neto_letras',
        'remuneracion_basica',
        'unidad_trabajo',
        'anio_mes_planilla',
        'id_planilla'
        ));
       $pdf->getDomPDF()->set_option("enable_php", true);
        
       $pdf->setPaper('A4', 'landscape'); // Tamaño de papel (puedes cambiarlo según tus necesidades)
       $pdf->setOption('margin-top', 20); // Márgen superior en milímetros
       $pdf->setOption('margin-right', 50); // Márgen derecho en milímetros
       $pdf->setOption('margin-bottom', 20); // Márgen inferior en milímetros
       $pdf->setOption('margin-left', 100); // Márgen izquierdo en milímetros
               
       return $pdf->stream('reporte.pdf');
        

		/*return view('frontend.boletas.boleta-pdf',compact(
            'persona',
            'persona_detalle',
            'planilla_calculada_ingresos',
            'planilla_calculada_egresos',
            'planilla_calculada_aportes',
            'planilla_calculada_aportes_empleador',
            'total_ingresos',
            'total_egresos',
            'total_aportes',
            'total_neto',
            'total_aportes_empleador',
            'total_neto_letras',
            'remuneracion_basica',
            'unidad_trabajo',
            'anio_mes_planilla',
            'id_planilla'
        ));*/
        
    }

    // Guardar boletas en version PDF
    public function guardarBoletasPDF($id_periodo) {

		$sw = true;
		$msg = "";
        $anio = "2025";
        $empresa = "Forespama";

		$planilla_model = new PlanillaCalculada;
		$p[]=null;       //$request->id_area_trabajo;
		$p[]=null;       //$request->id_unidad_trabajo;
		$p[]=null;       //$request->id_persona;
		$p[]=$id_periodo;
		$p[]=null;       //$request->estado;
		$p[]='1';        //$request->NumeroPagina;
		$p[]='10000';    //NumeroRegistros
		$data = $planilla_model->listar_planilla_ajax($p);

        for ($i=0; $i < count($data); $i++) {
            # crear una nueva boleta
            $id_persona = $data[$i]->id;
            $pdf = $this->getBoletaContent($id_periodo, $id_persona);

            $content = $pdf->download()->getOriginalContent();
            # guardar la nueva boleta
            \Storage::put('public/boletas/' . $anio . '/' . $empresa . '/' . $id_periodo . '/boleta_' . $id_persona . '.pdf', $content) ;
            // $pdf->Output(base_path() . "/public/boletas/boleta_" . $id_periodo . "_" . $id_persona . ".pdf","F");
        }

        $msg = "Se procesaron " . strval(count($data)) . ' boletas.';
        
		$array["sw"] = $sw;
        $array["msg"] = $msg;
        
        echo json_encode($array);
    }


    private function getBoletaContent($id_periodo, $id_persona){
        
        $total_ingresos=0;
        $total_egresos=0;
        $total_aportes=0;
        $total_aportes_empleador=0;
        $total_neto=0;
        $remuneracion_basica="";
        $anio_mes_planilla="";
        $id_planilla="";

        $planilla_calculada_ingresos = DB::table('planilla_calculadas')
            ->leftJoin('conceptos', 'planilla_calculadas.id_concepto', '=', 'conceptos.id')
            ->where('planilla_calculadas.id_periodo', $id_periodo)->where('planilla_calculadas.id_persona', $id_persona)
            ->where('conceptos.tipo_conc_tco', '1')
            ->get();
        $planilla_calculada_egresos = DB::table('planilla_calculadas')
            ->leftJoin('conceptos', 'planilla_calculadas.id_concepto', '=', 'conceptos.id')
            ->where('planilla_calculadas.id_periodo', $id_periodo)->where('planilla_calculadas.id_persona', $id_persona)
            ->where('conceptos.tipo_conc_tco', '2')
            ->get();
        $planilla_calculada_aportes = DB::table('planilla_calculadas')
            ->leftJoin('conceptos', 'planilla_calculadas.id_concepto', '=', 'conceptos.id')
            ->where('planilla_calculadas.id_periodo', $id_periodo)->where('planilla_calculadas.id_persona', $id_persona)
            ->where('conceptos.tipo_conc_tco', '3')
            ->get();
        $planilla_calculada_aportes_empleador = DB::table('planilla_calculadas')
            ->leftJoin('conceptos', 'planilla_calculadas.id_concepto', '=', 'conceptos.id')
            ->where('planilla_calculadas.id_periodo', $id_periodo)->where('planilla_calculadas.id_persona', $id_persona)
            ->where('conceptos.tipo_conc_tco', '4')
            ->get();
        // $planilla_calculada_egresos = PlanillaCalculada::where('ano_peri_tpe', $anio)->where('nume_peri_tpe', $mes)->where('id_persona', $id_persona)->where('nume_peri_tpe', $mes)->where('tipo_conc_tco', '2')->firstOrFail();

        //Calculando totales
        foreach($planilla_calculada_ingresos as $data) {
            if ($data->codi_conc_tco == '00101') {
                $remuneracion_basica = $data->valo_calc_pca;
            }
            $anio_mes_planilla = $data->ano_peri_tpe . "/" . $data->nume_peri_tpe;
            $id_planilla = $data->id;
            $total_ingresos += $data->valo_calc_pca;
        }

        foreach($planilla_calculada_egresos as $data) {
            $total_egresos += $data->valo_calc_pca;
            $anio_mes_planilla = $data->ano_peri_tpe . "/" . $data->nume_peri_tpe;
            $id_planilla = $data->id;
        }

        foreach($planilla_calculada_aportes as $data) {
            $total_aportes += $data->valo_calc_pca;
            $anio_mes_planilla = $data->ano_peri_tpe . "/" . $data->nume_peri_tpe;
            $id_planilla = $data->id;
        }

        foreach($planilla_calculada_aportes_empleador as $data) {
            $total_aportes_empleador += $data->valo_calc_pca;
            $anio_mes_planilla = $data->ano_peri_tpe . "/" . $data->nume_peri_tpe;
            $id_planilla = $data->id;
        }

        //dd($anio_mes_periodo);exit();
        $total_neto = $total_ingresos - $total_egresos - $total_aportes;

        //Convirtiendo en letras
        $formatter = new NumeroALetras();
        $total_neto_letras = $formatter->toInvoice( $total_neto, 2, 'Soles');
        
        //Datos de la persona
        $persona = Persona::find($id_persona);
        $persona_detalle = PersonaDetalle::where('id_persona', $persona->id)->firstOrFail();
        

        if ($persona_detalle->id_area_trabajo){
            $unidad_model = new UnidadTrabajo;
            $unidad_trabajo_array = $unidad_model->getUnidad($persona_detalle->id_area_trabajo);
            $unidad_trabajo = $unidad_trabajo_array[0]->denominacion;
        }else{$unidad_trabajo='';}
        
        return PDF::loadView('frontend/boletas/boleta-pdf', compact(
            'persona',
            'persona_detalle',
            'planilla_calculada_ingresos',
            'planilla_calculada_egresos',
            'planilla_calculada_aportes',
            'planilla_calculada_aportes_empleador',
            'total_ingresos',
            'total_egresos',
            'total_aportes',
            'total_neto',
            'total_aportes_empleador',
            'total_neto_letras',
            'remuneracion_basica',
            'unidad_trabajo',
            'anio_mes_planilla',
            'id_planilla'));
    }
}
