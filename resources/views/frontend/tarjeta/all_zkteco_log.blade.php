<!--<script src="<?php echo URL::to('/') ?>/js/manifest.js"></script>
<script src="<?php echo URL::to('/') ?>/js/vendor.js"></script>
<script src="<?php echo URL::to('/') ?>/js/frontend.js"></script>-->


<link rel="stylesheet" href="<?php echo URL::to('/') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!--<link rel="stylesheet" type="text/css" href="<?php echo URL::to('/') ?>assets/vendor/datatables/dataTables.bootstrap4.min.css">-->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
<!--<script src="<?php echo URL::to('/') ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>-->

<style>
	#tblAfiliado tbody tr{
		font-size:13px
	}
    .table-sortable tbody tr {
        cursor: move;
    }
	/*
    #global {        
        width: 95%;        
        margin: 15px 15px 15px 15px;     
        height: 380px !important;        
        border: 1px solid #ddd;
        overflow-y: scroll !important;
    }
	*/
	#global {
        height: 650px !important;
        width: auto;
        border: 1px solid #ddd;
		margin:15px
       /* background: #f1f1f1;*/
        /*overflow-y: scroll !important;*/
    }
	
    .margin{

        margin-bottom: 20px;
    }
    .margin-buscar{
        margin-bottom: 5px;
        margin-top: 5px;
    }

    /*.row{
        margin-top:10px;
        padding: 0 10px;
    }*/
    .clickable{
        cursor: pointer;   
    }

    /*.panel-heading div {
        margin-top: -18px;
        font-size: 15px;        
    }
    .panel-heading div span{
        margin-left:5px;
    }*/
    .panel-body{
        display: block;
    }
	
	.dataTables_filter {
	   display: none;
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

</style>

@extends('frontend.layouts.app1')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('breadcrumb')
<ol class="breadcrumb" style="padding-left:130px;margin-top:0px;background-color:#283659">
        <li class="breadcrumb-item text-primary">Inicio</li>
            <li class="breadcrumb-item active">Consulta Logs Zkteco</li>
        </li>
    </ol>
@endsection

@section('content')

    <!--<ol class="breadcrumb" style="padding-left:120px;margin-top:0px">
        <li class="breadcrumb-item text-primary">Inicio</li>
            <li class="breadcrumb-item active">Consulta de Afiliados</li>
        </li>
    </ol>
    -->

<div class="loader"></div>

    <div class="justify-content-center">
        
        <div class="card">

        <div class="card-body">

            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0 text-primary">
                        Consulta Logs Zkteco<!--<small class="text-muted">Usuarios activos</small>-->
                    </h4>
                </div><!--col-->
            </div>

        <div class="row justify-content-center">
        
        <div class="col col-sm-12 align-self-center">

            <div class="card">
                <div class="card-header">
                    <strong>
                        Lista de Logs Zkteco
                    </strong>
                </div><!--card-header-->
				
				<form class="form-horizontal" method="post" action="{{ route('frontend.contact.send')}}" id="frmAfiliacion" autocomplete="off">
				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
				
				<div class="row" style="padding:20px 20px 0px 20px;">
				
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="numero_documento" name="numero_documento" placeholder="Numero de documento">
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="persona" name="persona" placeholder="Nombres y Apellidos">
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="numero_tarjeta" name="numero_tarjeta" placeholder="Numero de tarjeta">
					</div>
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<select name="id_estado" id="id_estado" class="form-control form-control-sm">
							<option value="0" selected="selected">Todos estados</option>
							<option value="1">acceso normal</option>
							<option value="2">bloqueado</option>
						</select>
					</div>
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12" style="padding-left:0px;margin-left:0px;padding-right:0px;margin-right:0px">
						<input class="form-control form-control-sm" id="fecha_ini" name="fecha_ini" value="<?php echo $fecha_actual?>" placeholder="Fecha Inicio Desde">
					</div>
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12" style="padding-left:0px;margin-left:20px;padding-right:0px;margin-right:0px">
						<input class="form-control form-control-sm" id="fecha_fin" name="fecha_fin" value="<?php echo $fecha_actual?>" placeholder="Fecha Inicio Hasta">
					</div>
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<select name="cantidad" id="cantidad" class="form-control form-control-sm">
							<option value="0" selected="selected">Todas las Cantidades</option>
							<option value="1">De 1 al 10</option>
							<option value="2">De 11 a mas</option>
						</select>
					</div>
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12" style="padding-left:0px;margin-left:20px;padding-right:0px;margin-right:0px">
						<input class="btn btn-warning pull-rigth" value="Buscar" type="button" id="btnBuscar" />
					</div>
					
				</div>
				
                <div class="card-body">				

                    <div class="table-responsive">
                    <table id="tblAfiliado" class="table table-hover table-sm">
                        <thead>
                        <tr style="font-size:13px">
							<th>Cod</th>
							<th>Fecha</th>
                            <th>Numero Tarjeta</th>
							<th>IdPersona</th>
							<th>Tipo Documento</th>
							<th>Numero Documento</th>
							<th>Nombres y Apellidos</th>
							<!--<th>Verified</th>
                            <th>Puerta</th>>-->
							<th>Estado</th>
							<th>Cantidad</th>
							<!--<th>InOutState</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div><!--table-responsive-->
                </form>



                </div><!--card-body-->
            </div><!--card-->
        <!--</div>--><!--col-->
    <!--</div>--><!--row-->

@endsection

<div id="openOverlayOpc" class="modal fade" role="dialog">
  <div class="modal-dialog" >

	<div id="id_content_OverlayoneOpc" class="modal-content" style="padding: 0px;margin: 0px">
	
	  <div class="modal-body" style="padding: 0px;margin: 0px">

			<div id="diveditpregOpc"></div>

	  </div>
	
	</div>

  </div>
	
</div>

@push('after-scripts')
{!! script(asset('js/zktecoLogsLista.js')) !!}
@endpush
