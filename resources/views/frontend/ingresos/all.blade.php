<!--<link rel="stylesheet" href="<?php //echo URL::to('/') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">-->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
<style type="text/css">

.table td.verde{
	background:#CAE983  !important
}

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
	float:left
}

br {
    line-height: 30px;
}

/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}

ul.ui-autocomplete {
    z-index: 1100;
}

.btn-xsm {
    font-size: 11px !important;
}

/* End - Overriding styles for this page */
/*********************************************************/
.switch {
  position: relative;
  display: inline-block;
  width: 42px;
  height: 24px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 0px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.no {padding-right:3px;padding-left:0px;display:block;width:20px;float:left;font-size:11px;text-align:right;padding-top:5px}
.si {padding-right:0px;padding-left:3px;display:block;width:20px;float:left;font-size:11px;text-align:left;padding-top:5px}

.flotante {
    display:inline;
        position:fixed;
        bottom:0px;
        right:0px;
		z-index:1000
}
.flotanteC {
    display:inline;
        position:fixed;
        bottom:65px;
        right:0px;
}

label.form-control-sm{
	padding-left:0px!important;
	padding-right:0px;
	padding-top:5px!important;
	height:25px!important;
	/*line-height:10px!important*/
}

.loader {
	width: 100%;
	height: 100%;
	/*height: 1500px;*/
	overflow: hidden;
	top: 0px;
	left: 0px;
	z-index: 10000;
	text-align: center;
	position:absolute;
	background-color: #000;
	opacity:0.6;
	filter:alpha(opacity=40);
	display:none;
}

.dataTables_processing {
	position: absolute;
	top: 50%;
	left: 50%;
	width: 500px!important;
	font-size: 1.7em;
	border: 0px;
	margin-left: -17%!important;
	text-align: center;
	background: #3c8dbc;
	color: #FFFFFF;
}

.btn-file {
  position: relative;
  overflow: hidden;
}
.btn-file input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  min-width: 100%;
  min-height: 100%;
  font-size: 100px;
  text-align: right;
  filter: alpha(opacity=0);
  opacity: 0;
  outline: none;
  background: white;
  cursor: inherit;
  display: block;
}

.wrapper {
	/*background:#EFEFEF; */
	/*box-shadow: 1px 1px 10px #999; */
	margin: auto;
	text-align: center;
	position: relative;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	margin-bottom: 20px !important;
	width: 800px;
	padding-top: 5px;
}
.scrolls {
	overflow-x: scroll;
	overflow-y: hidden;
	height: 200px;
	white-space:nowrap
}
.imageDiv img {
	box-shadow: 1px 1px 10px #999;
	margin: 2px;
	max-height: 50px;
	cursor: pointer;
	display:inline-block;
	display:inline;
	zoom:1;
	vertical-align:top;
}


.img_ruta{
	position:relative;
	float:left
}

.delete_ruta{
	background-image:url(img/delete.png);
	top:0px;
	left:110px;
	background-size: 100%;
	position:absolute;
	display:block;
	width:30px;
	height:30px;
	cursor:pointer
}

</style>



@stack('before-scripts')
@stack('after-scripts')

@extends('backend.layouts.app')

@section('title', ' | ' . __('labels.frontend.afiliacion.box_title'))

@section('breadcrumb')
<ol class="breadcrumb" style="padding-left:130px;margin-top:0px;background-color:#283659">
    <li class="breadcrumb-item text-primary">Inicio</li>
    <li class="breadcrumb-item active">Consulta de Estado de Cuenta</li>
    </li>
</ol>

@endsection

<div class="loader"></div>

@section('content')

    <!--<ol class="breadcrumb" style="padding-left:120px;margin-top:0px">
        <li class="breadcrumb-item text-primary">Inicio</li>
            <li class="breadcrumb-item active">Consulta de Afiliados</li>
        </li>
    </ol>
    -->
    <div class="justify-content-center">
        
        <div class="card">

        <div class="card-body">

            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0 text-primary">
                        Consultar Estado de Cuenta <!--<small class="text-muted">Usuarios activos</small>-->
                    </h4>
                </div><!--col-->
            </div>

        <div class="row justify-content-center">
        
        <div class="col col-sm-12 align-self-center">

            <div class="card">
                <div class="card-header">
                    <strong>
                        Lista de Estado de Cuenta
                    </strong>
                </div><!--card-header-->
				
				<form class="form-horizontal" method="post" action="{{ route('frontend.persona.send')}}" id="frmAfiliacion" autocomplete="off">
				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
				
				<input type="hidden" name="order" id="order" value="">
				<input type="hidden" name="sort" id="sort" value="Asc">
				
				<div class="row" style="padding:20px 20px 0px 20px;">
					
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<select name="pago" id="pago" class="form-control form-control-sm">
							<option value="N">PENDIENTE</option>
							<option value="S">PAGADO</option>
						</select>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<select name="tipo" id="tipo" class="form-control form-control-sm">
							<!--
							<option value="">Todos los Planes</option>
							<option value="LINEA BLANCA">LINEA BLANCA</option>
							<option value="MARISCOS">MARISCOS</option>
							-->
							<option value="">Todas las Areas Planes</option>
							<option value="">Sin Plan</option>
							<?php foreach($area as $row):?>
							<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
							<?php  endforeach;?>
						</select>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<!--<input class="form-control form-control-sm" id="periodo" name="periodo" placeholder="Periodo">-->
						<select name="periodo" id="periodo" class="form-control form-control-sm">
							<option value="">Todos periodos</option>
							<option value="MENSUAL">MENSUAL</option>
							<option value="SEMANAL">SEMANAL</option>
							<option value="DIA">DIA</option>
						</select>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<select name="flag_tarjeta" id="flag_tarjeta" class="form-control form-control-sm">
							<option value="">T. Tarjeta</option>
							<option value="1">Con Tarjeta</option>
							<option value="2">Sin Tarjeta</option>
						</select>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="numero_documento" name="numero_documento" placeholder="Doc. Identidad">
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="afiliado" name="afiliado" placeholder="Afiliado">
					</div>
				</div>
				
				<div class="row" style="padding:20px 20px 0px 20px;">
					<!--
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="tipo" name="tipo" placeholder="Tipo">
					</div>
					-->
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="fecha_inicio" name="fecha_inicio" placeholder="Fecha Inicio">
					</div>
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="fecha_fin" name="fecha_fin" placeholder="Fecha Fin">
					</div>
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="fecha_proceso" name="fecha_proceso" placeholder="Fecha Proceso">
					</div>
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<input class="btn btn-warning pull-rigth" value="Buscar" type="button" id="btnBuscar" />
					</div>
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<input class="btn btn-success pull-rigth" value="Excel" type="button" id="btnExcel" onclick="reporteEstadoCuenta()"/>
					</div>
					@hasanyrole('administrator')
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<input class="btn btn-info pull-rigth" value="Procesar" type="button" id="btnProcesar" onclick="estadoCuentaAutomatico()" />
					</div>
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<input class="btn btn-danger pull-rigth" value="Elim. Bloque" type="button" id="btnEliminarBloque"/>
					</div>
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<input class="btn btn-danger pull-rigth" value="Inact. Tarjeta Bloque" type="button" id="btnInactivarTarjetaBloque" style="margin-left:20px;margin-right:0px" />
					</div>
					
					@endhasanyrole
				</div>
				
                <div class="card-body">				

                    <div class="table-responsive">
                    <table id="tblAfiliado" class="table table-hover table-sm">
                        <thead>
                        <tr style="font-size:13px">
							<th style="text-align: center; padding-bottom:0px;padding-right:5px;margin-bottom: 0px; vertical-align: middle" class="text-left">
								<input type="checkbox" name="select_all" value="1" id="example-select-all" <?php //echo $seleccionar_todos ?> >
							</th>
                            <th>Fecha</th>
							<th>Tipo Doc.</th>
							<th>Documento</th>
                            <th>Nombres Y Apellidos</th>
							<th>N&uacute;mero de Tarjeta</th>
							<th>Plan</th>
							<th>Per&iacute;odo</th>
                            <th>Concepto Corto</th>
							<th>Concepto Largo</th>
							<th>Dscto</th>
                            <th onclick="fn_ordenar('t3.vsm_precio')">Monto</th>
							<th>Fecha Fac</th>
							<th>Tipo</th>
							<th>Serie</th>
							<th>Numero</th>
							<th onclick="fn_ordenar('t4.fac_total')">Importe</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div><!--table-responsive-->
                </form>



                </div><!--card-body-->
            </div><!--card-->
        <!--</div>--><!--col-->
    <!--</div>--><!--row-->

@endsection

@push('after-scripts')
{!! script(asset('js/ingresoLista.js')) !!}
<script type="text/javascript">
$(document).ready(function () {
	
	/*
	$('#tblAfiliado').DataTable({
		"dom": '<"top">rt<"bottom"flpi><"clear">'
		});
	$("#system-search").keyup(function() {
			var dataTable = $('#tblAfiliado').dataTable();
		   dataTable.fnFilter(this.value);
		}); 
	*/
	
	
	
});
</script>
@endpush
