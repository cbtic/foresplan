<!--<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>-->
<!--
<script src="<?php echo URL::to('/') ?>/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo URL::to('/') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo URL::to('/') ?>/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo URL::to('/') ?>/dist/js/adminlte.min.js"></script>
<script src="<?php echo URL::to('/') ?>/dist/js/demo.js"></script>
<script src="<?php echo URL::to('/') ?>/dist/js/js.util.grid.js"></script>
<script src="<?php echo URL::to('/') ?>/bower_components/select2/dist/js/select2.full.min.js"></script>

<link rel="stylesheet" href="<?php echo URL::to('/') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link media="all" type="text/css" rel="stylesheet" href="https://app-gsf.saludpol.gob.pe:29692/css/datatables/dataTables.bootstrap.min.css">
<script src="https://app-gsf.saludpol.gob.pe:29692/js/datatables/datatables.min.js"></script>

<!--<script src="<?php echo URL::to('/') ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>-->
<!--<script src="<?php echo URL::to('/') ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>-->
<link rel="stylesheet"
    href="<?php echo URL::to('/') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link rel="stylesheet" type="text/css"
    href="<?php echo URL::to('/') ?>assets/vendor/datatables/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
<script src="<?php echo URL::to('/') ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<style type="text/css">
body {
    background-color: #bdc3c7;
}

.table-fixed {
    width: 100%;
    background-color: #f3f3f3;
}

.table-fixed tbody {
    height: 200px;
    overflow-y: auto;
    width: 100%;
}

.table-fixed thead,
.table-fixed tbody,
.table-fixed tr,
.table-fixed td,
.table-fixed th {
    display: block;
}

.table-fixed tbody td {
    float: left;
}

.table-fixed thead tr th {
    float: left;
    background-color: #f39c12;
    border-color: #e67e22;
}

/* Begin - Overriding styles for this page */
.card-body {
    padding: 0 1.25rem !important;
}

.form-control-sm {
    line-height: 1.1 !important;
    margin: 0 !important;
}

.form-group {
    margin-bottom: 0.5rem !important;
}

.breadcrumb {
    padding: 0.2rem 2rem !important;
    margin-bottom: 0 !important;
}

.card-header {
    padding: 0.2rem 1.25rem !important;
}

.pesajeIngreso {
    line-height: 2.8;
}

.fecha_ingreso_salida {
    color: blue;
    font-size: 14px;
    font-style: italic;
}

br {
    line-height: 30px;
}

.flotante {
    display: inline;
    position: fixed;
    bottom: 0px;
    right: 0px;
}

.flotanteC {
    display: inline;
    position: fixed;
    bottom: 65px;
    right: 0px;
}

/*
 VERSION PARA IMPRESORAS
*/
@page {
  margin: 0;
}

@media print {
  html, body {
    width: 80mm;
    height: 297mm;
  }

    *, :after, :before {
        color: #FFF!important;
        text-shadow: none!important;
        background: blue!important;
        -webkit-box-shadow: none!important;
        box-shadow: none!important;
        font-family:'Times New Roman', Times, serif;
    }
    p,table, th, td {
        color: black !important;
        font-size: 38px !important;
        font-weight: bolder;
        font-family:'Times New Roman', Times, serif;
    }
    h3{
        color: black !important;
        font-size: 52px !important;
        font-weight: bold;
        text-align: center;
        font-family:'Times New Roman', Times, serif;
    }
    .navbar.navbar-expand-lg.navbar-dark.bg-primary.mb-0 {
        display: none
    }
    h4,ol{
        display: none !important
    }

    .flotante,.flotanteC {
        display: none !important
    }
}
</style>


@stack('before-scripts')
{!! script(asset('js/pesaje.js')) !!}
@stack('after-scripts')

@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('labels.frontend.afiliacion.box_title'))

@section('breadcrumb')
<ol class="breadcrumb" style="padding-left:130px;margin-top:0px;background-color#283659">
    <li class="breadcrumb-item text-primary">Inicio</li>
    <li class="breadcrumb-item active">Facturacion</li>
    <li class="breadcrumb-item active">Mostrar</li>
    </li>
</ol>
@endsection

@section('content')


<div class="justify-content-center">
    <!--<div class="container-fluid">-->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0 text-primary">
                        Detalle de la Factura
                        <!--<small class="text-muted">Usuarios activos</small>-->
                    </h4>
                </div>
                <!--col-->
            </div>
            <div class="row justify-content-center">
                <div class="col col-sm-12 align-self-center">
                    <form class="form-horizontal" method="post" action="{{ route('frontend.contact.send')}}"
                        id="frmPesaje" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div id="" class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <div id="" class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <h3>
                                                            FELMO SRLTDA
                                                        </h3> <br>
                                                        <p>AV. NESTOR GAMBETA Nº 6311 - CALLAO</p>
                                                        <p>RUC 20160453908</p>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <strong>
                                                            <p>
                                                                @switch($factura->fac_tipo)
                                                                @case('FT')
                                                                <p> FACTURA ELECTRONICA</p>
                                                                @break

                                                                @case('BV')
                                                                <p>BOLETA ELECTRONICA</p>
                                                                @break

                                                                @case('TK')
                                                                <p>BOLETA ELECTRONICA</p>
                                                                @break

                                                                @default
                                                                <p>No esta identificado el tipo de documento</p>
                                                                @endswitch
                                                            </p>
                                                            <p><a href="/{{ $factura->fac_ruta_comprobante }}" target="_blank" class="link-factura">{{ $factura->fac_serie }}-{{ $factura->fac_numero }}</a></p>
                                                        </strong>

                                                    </div>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <p>Fecha de expedición: {{ $factura->fac_fecha }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="fsFiltro" class="card-body">

                                            </div>
                                            <!--card-body-->
                                        </div>
                                        <!--card-->
                                    </div>
                                </div>
                                <br>

                                <div id="" class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div >
                                                    <table id="tblProductos" class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center" width="8%">Cant.</th>
                                                                <th width="37%">Descripción</th>
                                                                <th class="text-right" width="10%">%Dcto.</th>
                                                                <th class="text-right" width="15%">PU</th>
                                                                <!--<th class="text-right" width="15%">IGV</th> -->
                                                                <th class="text-right" width="15%">Monto</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($factura_detalles as $factura_detalle)
                                                            <tr id="fila{{ $loop->iteration }}">
                                                                <td class="text-center">
                                                                    {{ $factura_detalle->facd_cantidad }}</td>
                                                                <td class="text-left">
                                                                    {{ $factura_detalle->facd_descripcion }}
                                                                </td>
                                                                <td class="text-right">{{ $factura_detalle->facd_descuento }}
                                                                </td>

                                                                <td class="text-right">{{ number_format($factura_detalle->facd_pu,2)  }}
                                                                </td>
                                                                <!--
                                                                <td class="text-right">
                                                                    {{ number_format($factura_detalle->facd_igv_total,2) }}</td>
                                                                -->
                                                                <td class="text-right">
                                                                    {{ number_format($factura_detalle->facd_importe,2) }}</td>
                                                            </tr>
                                                            @endforeach
                                                            <tr id="fila_sub_total">
                                                                <td class="text-right" colspan="4">OP.GRAVADAS S/ </td>
                                                                <td class="text-right">{{ number_format($factura->fac_subtotal,2)  }}</td>
                                                            </tr>
                                                            <tr id="fila_igv">
                                                                <td class="text-right" colspan="4">IGV(18%) S/ </td>
                                                                <td class="text-right">{{ number_format($factura->fac_impuesto,2) }}</td>
                                                            </tr>
                                                            <tr id="fila_total">
                                                                <td class="text-right" colspan="4">IMPORTE TOTAL S/ </td>
                                                                <td class="text-right">{{ number_format($factura->fac_total,2) }}</td>


                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!--table-responsive-->
                                            </div>
                                            <!--card-body-->
                                        </div>
                                        <!--card-->
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <p>Son: {{ $factura->fac_letras }}</p>
                                    </div>
                                    <?php if ($factura->fac_tipo == 'FT'|| $factura->fac_tipo == 'BV'){?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <p>RUC/DNI: {{ $factura->fac_cod_tributario }}</p>
                                        <p>RAZON SOCIAL/NOMBRE: {{ $factura->fac_destinatario }}</p>
                                        <p>DIRECCION: {{ $factura->fac_direccion }}</p>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        <p>Representación impresa generada en el sisteman de SUNAT, puede verificarla
                                            utilizando su clave SOL</p>

                                    </div>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                        <a class='flotante' href='#' onclick="print()"><img src='/img/btn_print.png' border="0" /></a>
                        <!--<a class='flotante' href='#'><img src='/img/deshacer.png' border="0" /></a>-->
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--row-->
    @endsection

    @push('after-scripts')
    @if(config('access.captcha.contact'))
    @captchaScripts
    @endif
    @endpush
