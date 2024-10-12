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
        <th>Trabajador:</th>
        <td>{{ $persona->apellido_paterno . " " . $persona->apellido_paterno . ", " . $persona->nombres }}</td>
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
      </tr>
    </table>
  &nbsp;
    <table class="data" style="width:100%">
      <tr class="data">
        <th colspan="2" class="data">INGRESOS</th>
        <th colspan="2" class="data">EGRESOS</th>
        <th colspan="2" class="data">APORTACIONES</th>
        <th colspan="2" class="data">APORTACIONES<br>DEL EMPLEADOR</th>
      </tr>
      <tr class="data">
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
      <tr><th><p>TOTAL: {{ number_format((float)$total_neto, 2, '.', '') }}</p></th></tr>
    </table>
  &nbsp;
  &nbsp;
  <table class="data" style="width:100%">
      <tr><th><p>SON: {{ $total_neto_letras }}</p></th></tr>
    </table>
  &nbsp;
  <table class="data" style="width:100%">
      <tr><th><p>OBSERVACIONES: </p></th></tr>
  </table>
  &nbsp;
  <table class="data" style="width:100%">
      <tr>
        <th>
          <p style="height: 160px;"> &nbsp;</p>
        </th>
        <th>
          <div style="text-align: right; margin-right: 25px">{!! QrCode::size(120)->generate('RemoteStack') !!}</div>
        </th>
      </tr>
      <tr><th class="firma" colspan="2"><h3>EMPLEADOR</h3></th></tr>
  </table>
  </body>
</html>