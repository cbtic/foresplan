<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style type="text/css">

body {
        height: 100%;
        margin: 10mm;
        padding: 0;
        background-color: #FAFAFA;
        font: 10pt "Arial";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }

    .page-break {
        page-break-after: always;
    }

    h1, h2, h3 {
      text-align:center;
      margin: 0;
    }

    tr {
      height: 36px;
    }

    th {
      text-align:left;
    }

    #rcorners {
      border-radius: 8px;
      border: 2px solid black;
      padding: 10px;
      width: 100%;
    }

    table.data {
        border-left:solid black 2px;
        border-bottom:solid black 2px;
        border-collapse:separate;
        border:solid black 2px;
        border-radius:8px;
        padding: 3px;
    }

    td.data, th.data {
        border-left:solid black 2px;
        border-top:solid black 2px;
        text-align:center;
        border-bottom:solid black 2px;
        border-top: none;
    }
    tr.font_10{
        font-size: 10px;
    }
    th.data:first-child {
        border-left:none;
    }
    td.data_monto, th.data_monto {
        border-left:solid black 2px;
        border-top:solid black 2px;
        text-align:right;
        padding-right: 12px;
        border-bottom:solid black 2px;
        border-top: none;
        font-size: 10px;
    }
    th.data_monto:first-child {
        border-left:none;
    }

    th.concepto {
        white-space: nowrap;
        border-bottom:solid black 2px;
        padding-top: 5px;
        padding-left: 5px;
        font-size: 10px;
    }

    th.concepto2 {
        white-space: nowrap;
        border-left:solid black 2px;
        border-bottom:solid black 2px;
        padding-top: 5px;
        padding-left: 5px;
        font-size: 10px;
    }

    th.concepto3, th.concepto4 {
        border-left:solid black 2px;
        border-bottom:solid black 2px;
        padding-top: 5px;
        padding-left: 5px;
        font-size: 10px;
    }

    td.total,th.total {
        border-bottom: none;
        border-left:solid black 2px;
        text-align: center;
        font-size: 10px;
    }
    td.total_data,th.total_data {
        border-bottom: none;
        border-left:solid black 2px;
        text-align: right;
        padding-right: 12px;
        font-size: 10px;
    }

    th.total:first-child {
        border-left:none;
    }

    th.firma {
        text-align:center;
        border-top:solid black 2px;
    }

    h3 {
      margin-bottom: -10px;
      padding-bottom: 0px;
    }
  </style>
  </head>
  <body>
  <div class="page">
    <table class="data" style="width:100%">
      <tr><th><h2>Boleta de Pago</h2></th></tr>
    </table>
    &nbsp;
    <table class="data" style="width:100%">
      <tr>
        <th>RUC:</th>
        <td>20486785994</td>
      </tr>
      <tr>
        <th>Empleador:</th>
        <td>FORESTAL PAMA S.A.C.</td>
      </tr>
      <tr>
        <th>Periodo:</th>
        <td>{{ $anio_mes_planilla }}</td>
        <th>Sede:</th>
        <td>{{ $sede }}</td>
      </tr>
      <tr>
        <th>PDT Planilla Electronica</th>
        <td></td>
        <th>N&uacute;mero de Orden:</th>
        <td>{{ $id_planilla }}</td>
      </tr>
    </table>
    &nbsp;
    <table class="data" style="width:100%">
      <tr>
        <th class="data" colspan="2">Documento de Identidad</th>
        <th class="data" rowspan="2" colspan ="4">Nombre y Apellidos</th>
        <th class="data" rowspan="2" colspan ="2">Situaci&oacute;n</th>
      </tr>
      <tr>
        <th class="data">Tipo</th>
        <th class="data">N&uacute;mero</th>
      </tr>
      <tr>
        <td class="data">{{ ($persona->tipo_documento == 1) ? "DNI" : "C.E./PASSAPORTE" }}</td>
        <td class="data">{{ $persona->numero_documento }}</td>
        <td class="data" colspan ="4">{{ $persona->apellido_paterno . " " . $persona->apellido_materno . ", " . $persona->nombres }}</td>
        <td class="data" colspan ="2">{{ $situacion }}</td>
      </tr>
      <tr>
        <th class="data" colspan="2">Fecha Ingreso</th>
        <th class="data" colspan="2">Tipo Empleado</th>
        <th class="data" colspan="2">Regimen Pensionario</th>
        <th class="data" colspan="2">CUSPP</th>
      </tr>
      <tr>
        <td class="data" colspan="2">{{ \Carbon\Carbon::parse($persona_detalle->fecha_ingreso)->format('d-m-Y') }}</td>
        <td class="data" colspan="2">EMPLEADO</td>
        <td class="data" colspan="2">{{ $regimen_pensionario }}</td>
        <td class="data" colspan="2">{{ $persona_detalle->cuspp }}</td>
      </tr>
      <tr>
        <th class="data" rowspan="2">D&iacute;as Laborados</th>
        <th class="data" rowspan="2">D&iacute;as no Laborados</th>
        <th class="data" rowspan="2">D&iacute;as Subsiciados</th>
        <th class="data" rowspan="2">Condici&oacute;n</th>
        <th class="data" colspan="2">Jornada Ordinaria</th>
        <th class="data" colspan="2">Sobretiempo</th>
      </tr>
      <tr>
        <th class="data">Total Horas</th>
        <th class="data">Minutos</th>
        <th class="data">Total Horas</th>
        <th class="data">Minutos</th>
      </tr>
      <tr>
        <td class="data">{{ $dias_trabajados[0]->dias_trabajados }}</td>
        <td class="data">{{ $dias_no_trabajados[0]->dias_inasistencia }}</td>
        <td class="data">{{ $dias_subsidio[0]->cantidad }}</td>
        <td class="data">{{ $condicion }}</td>
        <td class="data">{{ $horas_diurnas_trabajados[0]->horas_diurnas_trabajadas }}</td>
        <td class="data"></td>
        <td class="data">{{ $horas_extras[0]->cantidad }}</td>
        <td class="data"></td>
      </tr>
      <tr>
        <th class="data" colspan="6">Motivo de Suspensi&oacute;n de Labores</th>
        <th class="data" rowspan="2" colspan="2">Otros empleadores por renta de 5ta categor&iacute;a</th>
      </tr>
      <tr>
        <th class="data">Tipo</th>
        <th class="data"colspan="4">Motivo</th>
        <th class="data">N° D&iacute;as</th>
      </tr>
      <tr>
        <td class="data">&nbsp;</td>
        <td class="data" colspan="4"></td>
        <td class="data"></td>
        <td class="data" colspan="2"></td>
      </tr>


      <!--<tr>
        <th >Trabajador:</th>
        <td>{{ $persona->apellido_paterno . " " . $persona->apellido_materno . ", " . $persona->nombres }}</td>
        <th>{{ ($persona->tipo_documento == 1) ? "DNI" : "C.E./PASSAPORTE" }}:</th>
        <td>{{ $persona->numero_documento }}</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th>Sexo:</th>
        <td>{{ ($persona->sexo == "M") ? "MASCULINO" : "FEMENINO" }}</td>
        <th>Nacionalidad:</th>
        <td>{{ ($persona->tipo_documento == 1) ? "PERUANO" : "EXTRANJERO" }}</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <th>Ubicación:</th>
        <td>{{ $unidad_trabajo }}</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>-->
    </table>
  &nbsp;
    <table class="data" style="width:100%">
      <tr class="data font_10">
        <th colspan="2" class="data">INGRESOS</th>
        <th colspan="2" class="data">EGRESOS</th>
        <th colspan="2" class="data">APORTACIONES</th>
        <th colspan="2" class="data">APORTACIONES<br>DEL EMPLEADOR</th>
      </tr>
      <tr class="data font_10">
        <th class="data">CONCEPTO</th>
        <th class="data">MONTO</th>
        <th class="data">CONCEPTO</th>
        <th class="data">MONTO</th>
        <th class="data">CONCEPTO</th>
        <th class="data">MONTO</th>
        <th class="data">CONCEPTO</th>
        <th class="data">MONTO</th>
      </tr>

      <tr class="data">
        <th class="concepto">
          @foreach($planilla_calculada_ingresos as $key => $data)
            {{ $data->codi_conc_tco }}: {{ $data->desc_conc_tco }}
            <br>
          @endforeach
          <br>
          <br>
          <br>
        </th>
        <td class="data_monto">
          @foreach($planilla_calculada_ingresos as $key => $data)
            {{ $data->valo_calc_pca }}
            <br>
          @endforeach
          <br>
          <br>
          <br>
        </td>
        <th class="concepto2">
          @foreach($planilla_calculada_egresos as $key => $data)
            {{ $data->codi_conc_tco }}: {{ $data->desc_cort_tco }}
            <br>
          @endforeach
          <br>
          <br>
          <br>
        </th>
        <td class="data_monto">
          @foreach($planilla_calculada_egresos as $key => $data)
            {{ number_format((float)$data->valo_calc_pca, 2, '.', '') }}
            <br>
          @endforeach
          <br>
          <br>
          <br>
        </td>
        <th class="concepto3">
          @foreach($planilla_calculada_aportes as $key => $data)
            {{ $data->codi_conc_tco }}: {{ $data->desc_conc_tco }}
            <br>
          @endforeach
          <br>
          <br>
          <br>
        </th>
        <td class="data_monto">
          @foreach($planilla_calculada_aportes as $key => $data)
            {{ number_format((float)$data->valo_calc_pca, 2, '.', '') }}
            <br>
          @endforeach
          <br>
          <br>
          <br>
        </td>

        <th class="concepto4">
          @foreach($planilla_calculada_aportes_empleador as $key => $data)
            {{ $data->codi_conc_tco }}: {{ $data->desc_conc_tco }}
            <br>
          @endforeach
          <br>
          <br>
          <br>
        </th>
        <td class="data_monto">
          @foreach($planilla_calculada_aportes_empleador as $key => $data)
            {{ number_format((float)$data->valo_calc_pca, 2, '.', '') }}
            <br>
          @endforeach
          <br>
          <br>
          <br>
        </td>
      </tr>
      <tr>
        <th class="total">TOTAL INGRESOS:</th>
        <td class="total_data">{{ number_format((float)$total_ingresos, 2, '.', '') }}</td>
        <th class="total">TOTAL EGRESOS:</th>
        <td class="total_data">{{ number_format((float)$total_egresos, 2, '.', '') }}</td>
        <th class="total">TOTAL APORTACIONES:</th>
        <td class="total_data">{{ number_format((float)$total_aportes, 2, '.', '') }}</td>
        <th class="total">TOTAL APORT. EMP.:</th>
        <td class="total_data">{{ number_format((float)$total_aportes_empleador, 2, '.', '') }}</td>
      </tr>
    </table>
  </div>
  &nbsp;
  <table class="data" style="width:100%">
      <tr><th>TOTAL: {{ number_format((float)$total_neto, 2, '.', '') }}</th></tr>
      <tr><th>SON: {{ $total_neto_letras }}</th></tr>
    </table>
  &nbsp;
  <table class="data" style="width:100%">
      <tr><th><p>OBSERVACIONES: </p></th></tr>
  </table>
  &nbsp;
  <div style="display: flex; justify-content: space-between; width: 100%;">
    <table class="data" style="width:48%; float: left">
        <tr>
          <th>
            <p style="height: 60px;"> &nbsp;</p>
          </th>
          <th>
            <div style="text-align: right; margin-right: 25px">{!! QrCode::size(120)->generate('RemoteStack') !!}</div>
          </th>
        </tr>
        <tr><th class="firma" colspan="2"><h3>EMPLEADOR</h3></th></tr>
    </table>
    <table class="data" style="width:48%; float: right">
        <tr>
          <th>
            <p style="height: 60px;"> &nbsp;</p>
          </th>
          <th>
            <div style="text-align: right; margin-right: 25px"></div>
          </th>
        </tr>
        <tr><th class="firma" colspan="2"><h3>TRABAJADOR</h3></th></tr>
    </table>
  </div>
  </body>
</html>
