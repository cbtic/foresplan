<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Asistencia;
use Illuminate\Http\Request;
use App\Models\TablaUbicacione;
use App\Models\Persona;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.manten.asistencia');
        //
    }
	
	public function listar_asistencia()
    {
		$tabla_model = new TablaUbicacione;
		$area_trabajo = $tabla_model->getTablaUbicacionAll("area_trabajos","1");
		$condicion_laboral = $tabla_model->getTablaUbicacionAll("condicion_laborales","1");
		$sedes = $tabla_model->getTablaUbicacionAll("sedes","1");
		
		$meses[1]="ENERO";
		$meses[2]="FEBRERO";
		$meses[3]="MARZO";
		$meses[4]="ABRIL";
		$meses[5]="MAYO";
		$meses[6]="JUNIO";
		$meses[7]="JULIO";
		$meses[8]="AGOSTO";
		$meses[9]="SETIEMBRE";
		$meses[10]="OCTUBRE";
		$meses[11]="NOVIEMBRE";
		$meses[12]="DICIEMBRE";
	
        return view('frontend.asistencia.listar_asistencia',compact('meses','area_trabajo','sedes','condicion_laboral'));
        //
    }
	
    public function listar_resumen()
    {
		//$tabla_model = new TablaUbicacione;
		//$area_trabajo = $tabla_model->getTablaUbicacionAll("area_trabajos","1");
		
		$meses[1]="ENERO";
		$meses[2]="FEBRERO";
		$meses[3]="MARZO";
		$meses[4]="ABRIL";
		$meses[5]="MAYO";
		$meses[6]="JUNIO";
		$meses[7]="JULIO";
		$meses[8]="AGOSTO";
		$meses[9]="SETIEMBRE";
		$meses[10]="OCTUBRE";
		$meses[11]="NOVIEMBRE";
		$meses[12]="DICIEMBRE";
	
        //return view('frontend.asistencia.listar_asistencia',compact('meses','area_trabajo'));
        return view('frontend.asistencia.listar_asistencia',compact('meses'));
    }

	public function listar_asistencia_ajax(Request $request){
		
		$asistencia_model = new Asistencia;
		$p[]=$request->id_area_trabajo;
		$p[]=$request->id_unidad_trabajo;
		$p[]=$request->id_persona;
		$p[]=$request->anio;
		$p[]=$request->mes;
        $p[]=$request->fecha_ini;
        $p[]=$request->fecha_fin;
        $p[]=$request->id_sede;
        $p[]=$request->id_condicion_laboral;
		$p[]=$request->estado;
		$p[]=$request->NumeroPagina;
		$p[]=$request->NumeroRegistros;
		$data = $asistencia_model->listar_asistencia_ajax($p);
		$iTotalDisplayRecords = isset($data[0]->totalrows)?$data[0]->totalrows:0;
		
		$result["PageStart"] = $request->NumeroPagina;
		$result["pageSize"] = $request->NumeroRegistros;
		$result["SearchText"] = "";
		$result["ShowChildren"] = true;
		$result["iTotalRecords"] = $iTotalDisplayRecords;
		$result["iTotalDisplayRecords"] = $iTotalDisplayRecords;
		$result["aaData"] = $data;
		
		echo json_encode($result);
		
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function show(Asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asistencia  $asistencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asistencia $asistencia)
    {
        //
    }
	
	public function modal_asistencia($id){
		$id_user = Auth::user()->id;
        $asistencia = Asistencia::find($id);
		
		$persona = new Persona;
		$persona = Persona::find($asistencia->id_persona);
		
		return view('frontend.asistencia.modal_asistencia',compact('id','asistencia','persona'));
	}
	
	public function modal_zkteco_log($fecha,$numero_documento){
		
		$asistencia_model = new Asistencia;
		$asistencia = $asistencia_model->get_zkteco_log($fecha,$numero_documento);
		
		return view('frontend.asistencia.modal_zkteco_log',compact('asistencia'));
	}
	
	public function send_asistencia(Request $request){
		$asistencia = Asistencia::find($request->id);
		$asistencia->fech_marc_rel= $request->fech_marc_rel;
		$asistencia->hora_entr_rel = $request->hora_entr_rel;
		$asistencia->fech_sali_rel = $request->fech_sali_rel;
		$asistencia->hora_sali_rel = $request->hora_sali_rel;

        $asistencia->hora_entrada = $request->hora_entrada;
        $asistencia->hora_salida = $request->hora_salida;

        $asistencia->save();
		$asistencia_model = new Asistencia;
		$asistencia_model->recalcular_asistencia($asistencia->id);
	
	}
    
    public function asistencia_automatico($fecha){

        $asistencia_model = new Asistencia;
        //$datos[] = str_replace("-","/",$fecha);
        $datos[] = $fecha;
        $id_asistencia = $asistencia_model->registrar_asistencia_automatico($datos);
        echo $id_asistencia;

    }

    public function exportar_listar_reporte_asistencia($id_area_trabajo, $id_unidad_trabajo, $id_persona, $anio, $mes, $fecha_ini, $fecha_fin, $id_sede, $id_condicion_laboral, $estado) {

		if($id_area_trabajo=="0")$id_area_trabajo = "";
		if($id_unidad_trabajo=="0")$id_unidad_trabajo = "";
		if($id_persona=="0")$id_persona = "";
		if($anio=="0")$anio = "";
		if($mes=="0")$mes = "";
		if($fecha_ini=="0")$fecha_ini = "";
		if($fecha_fin=="0")$fecha_fin = "";
		if($id_sede=="0")$id_sede = "";
		if($id_condicion_laboral=="0")$id_condicion_laboral = "";
		if($estado=="0")$estado = "";

		$asistencia_model = new Asistencia;
		$p[]=$id_area_trabajo;
		$p[]=$id_unidad_trabajo;
		$p[]=$id_persona;
		$p[]=$anio;
		$p[]=$mes;
        $p[]=$fecha_ini;
        $p[]=$fecha_fin;
        $p[]=$id_sede;
        $p[]=$id_condicion_laboral;
		$p[]=$estado;
		$p[]=1;
		$p[]=10000;
		$data = $asistencia_model->listar_asistencia_ajax($p);
		
		$variable = [];
		$n = 1;

		array_push($variable, array("N°","Documento Identidad","Persona","Condicion Laboral","Area","Unidad","Hora Programada","Fecha Asistencia","Dia","Labora","Fecha Ingreso","Hora Ingreso","Fecha Salida","Hora Salida","Tiempo Programado","Tardanza","Tiempo Trabajado","Estado","Papeleta","Tipo Papeleta","Hora Papeleta","Tiempo Papeleta"));
		
		foreach ($data as $r) {

            $hora_entr_dtu = "";
            $hora_sali_dtu = "";

            $fech_marc_rel = "";
            $fech_sali_rel = "";
            $tiempo_programado = "";
            $tiempo_trabajado = "";
            $tiempo_trabajado_total = "";
            $estado="";
            $flag_labo_dtu = "";

            if($r->hora_entr_dtu!= null)$hora_entr_dtu = $r->hora_entr_dtu;
            if($r->hora_sali_dtu!= null)$hora_sali_dtu = $r->hora_sali_dtu;

            
            if($r->fech_marc_rel!= null)$fech_marc_rel = $r->fech_marc_rel;
            if($r->fech_sali_rel!= null)$fech_sali_rel = $r->fech_sali_rel;
            if($r->tiempo_programado!= null)$tiempo_programado = $r->tiempo_programado;
            if($r->tiempo_trabajado!= null)$tiempo_trabajado = $r->tiempo_trabajado;
            if($r->tiempo_trabajado_total!= null)$tiempo_trabajado_total = $r->tiempo_trabajado_total;
            if($r->flag_labo_dtu!= null)$flag_labo_dtu = $r->flag_labo_dtu;
            
            if($fech_marc_rel!="" && $fech_sali_rel!="" && $tiempo_trabajado_total >= $tiempo_programado)$estado="Ok";
            if($fech_marc_rel!="" && $fech_sali_rel!="" && $tiempo_programado > $tiempo_trabajado_total)$estado="Abandono";
            if($fech_marc_rel=="" || $fech_sali_rel=="" )$estado="Observado";
            if($fech_marc_rel=="" && $fech_sali_rel=="" && $flag_labo_dtu=='N')$estado="";

			array_push($variable, array($n++,$r->numero_documento,$r->persona, $r->condicion_laboral, $r->area_trabajo, $r->unidad_trabajo, $hora_entr_dtu.'-'.$hora_sali_dtu, $r->fecha_dias, $r->dia, $r->flag_labo_dtu, $r->fech_marc_rel, $r->hora_entr_rel, $r->fech_sali_rel, $r->hora_sali_rel, $this->convertirHoraExcel($r->tiempo_programado), $this->convertirHoraExcel($r->minu_tard_eas), $this->convertirHoraExcel($r->tiempo_trabajado), $estado, $r->desc_just_jus, $r->tipo_marc_eas, $r->hora_permiso, $r->minu_dife_pap));
		}

		$export = new InvoicesExport([$variable]);
		return Excel::download($export, 'reporte_asistencia.xlsx');
    }

    private function normalizarHora($hora)
    {
        if (!$hora || trim($hora) == "") {
            return null;
        }

        // Si viene como HH:MM
        if (preg_match('/^\d{1,2}:\d{2}$/', $hora)) {
            return $hora . ':00';
        }

        // Si ya viene como HH:MM:SS
        if (preg_match('/^\d{1,2}:\d{2}:\d{2}$/', $hora)) {
            return $hora;
        }

        return null;
    }

    private function convertirHoraExcel($hora)
    {
        if ($hora === null) return null;

        $hora = trim($hora);

        if ($hora === "") return null;

        // HH:MM → convertir a HH:MM:SS
        if (preg_match('/^\d{2}:\d{2}$/', $hora)) {
            $hora .= ":00";
        }

        if (preg_match('/^\d{2}:\d{2}:\d{2}$/', $hora)) {
            list($h, $m, $s) = explode(':', $hora);
            return ($h * 3600 + $m * 60 + $s) / 86400;
        }

        return null;
    }

}

class InvoicesExport implements FromArray, WithHeadings, WithStyles, WithEvents
{
    
	protected $invoices;

	public function __construct(array $invoices)
	{
		$this->invoices = $invoices;
	}

	public function array(): array
	{
		return $this->invoices;
	}

    public function headings(): array
    {
        return ["N°","Documento Identidad","Persona","Condicion Laboral","Area","Unidad","Hora Programada","Fecha Asistencia","Dia","Labora","Fecha Ingreso","Hora Ingreso","Fecha Salida","Hora Salida","Tiempo Programado","Tardanza","Tiempo Trabajado","Estado","Papeleta","Tipo Papeleta","Hora Papeleta","Tiempo Papeleta"];
    }

	public function styles(Worksheet $sheet)
    {

		$sheet->mergeCells('A1:V1');

        $sheet->setCellValue('A1', "REPORTE DE ASISTENCIA - FORESPLAN");
        $sheet->getStyle('A1:V1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '246257'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

		$sheet->getStyle('A1')->getAlignment()->setWrapText(true);
		$sheet->getRowDimension(1)->setRowHeight(30);

        $sheet->getStyle('A2:V2')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '000000'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2EB85C'],
            ],
			'alignment' => [
			'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    		],
        ]);

		$sheet->fromArray($this->headings(), NULL, 'A2');

        foreach (range('A', 'V') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {

                $sheet = $event->sheet->getDelegate();

                // Tiempo Programado (columna O)
                $sheet->getStyle('O3:O10000')
                    ->getNumberFormat()
                    ->setFormatCode('hh:mm');

                // Tardanza (columna P)
                $sheet->getStyle('P3:P10000')
                    ->getNumberFormat()
                    ->setFormatCode('hh:mm');

                // Tiempo Trabajado (columna Q)
                $sheet->getStyle('Q3:Q10000')
                    ->getNumberFormat()
                    ->setFormatCode('hh:mm:ss');
            }
        ];
    }

}
