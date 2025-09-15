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

@section('title', ' | ' . __('labels.frontend.contact.box_title'))

@section('breadcrumb')
<ol class="breadcrumb" style="padding-left:130px;margin-top:0px;background-color:#283659">
        <li class="breadcrumb-item text-primary">Inicio</li>
            <li class="breadcrumb-item active">Asignar Persona Tarjeta</li>
        </li>
    </ol>
@endsection

@section('content')

<div class="loader"></div>

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
                        Asignar Persona Tarjeta <!--<small class="text-muted">Usuarios activos</small>-->
                    </h4>
                </div><!--col-->
            </div>

        <div class="row justify-content-center">
        
        <div class="col col-sm-12 align-self-center">

            <div class="card">
                <div class="card-header">
                    <strong>
                        Lista de Asignaci&oacute;n de Tarjetas
                    </strong>
                </div><!--card-header-->
				
				<form class="form-horizontal" method="post" action="" id="frmAfiliacion" autocomplete="off">
				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
				
				<div class="row" style="padding:20px 20px 0px 20px;">
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<select name="tipo_documento" id="tipo_documento" class="form-control form-control-sm">
							<option value="0">Todos Tipo Documento</option>
							<?php foreach($documento_identidad as $row):?>
							<option value="<?php echo $row->docu_iden_did?>"><?php echo $row->desc_docu_did?></option>
							<?php  endforeach;?>
						</select>
					</div>
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="numero_documento" name="numero_documento" placeholder="N&deg; documento">
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="persona" name="persona" placeholder="Nombres y Apellidos">
					</div>
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="numero_tarjeta" name="numero_tarjeta" placeholder="N&deg; tarjeta">
					</div>
					
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<select name="id_area" id="id_area" class="form-control form-control-sm" onchange="obtenerPlan()">
							<option value="0" selected="selected">Todas las Areas Planes</option>
							<option value="">Sin Plan</option>
							<?php foreach($area as $row):?>
							<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
							<?php  endforeach;?>
						</select>
					</div>
					
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<select name="id_plan" id="id_plan" class="form-control form-control-sm">
							<option value="0" selected="selected">Seleccionar</option>
						</select>
					</div>

					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<select name="estado" id="estado" class="form-control form-control-sm">
							<option value="">Todos</option>
							<option value="1" selected="selected">Activo</option>
							<option value="2">Inactivo</option>
						</select>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="padding-right:0px;padding-left:0px">
						<input class="btn btn-sm btn-warning pull-rigth" value="Buscar" type="button" id="btnBuscar" />
						<input class="btn btn-sm btn-success pull-rigth" value="Nuevo" type="button" id="btnNuevo" style="margin-left:7px" />
						<input class="btn btn-sm btn-danger pull-rigth" value="Inac. Bloque" type="button" id="btnInactivarBloque" style="margin-left:7px;margin-right:0px" />
					</div>
				</div>
				
                <div class="card-body">

                    <div class="table-responsive">
                    <table id="tblAfiliado" class="table table-hover table-sm">
                        <thead>
                        <tr style="font-size:13px;text-align:left">
                            <th style="text-align: center; padding-bottom:0px;padding-right:5px;margin-bottom: 0px; vertical-align: middle" class="text-left">
								<input type="checkbox" name="select_all" value="1" id="example-select-all" <?php //echo $seleccionar_todos ?> >
							</th>
							<th>Id Persona</th>
							<th>Tipo Documento</th>
                            <th>Numero Documento</th>
							<th>Persona</th>
							<th>Puesto del Plan</th>
							<th>N&uacute;mero de Tarjeta</th>
							<th>Estado</th>
							<th>Acceso</th>
							<!--<th>Mensaje</th>-->
							<th>Flag Negativo</th>
							<th>Opci&oacute;n</th>
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
{!! script(asset('js/tarjetaLista.js')) !!}
@endpush
