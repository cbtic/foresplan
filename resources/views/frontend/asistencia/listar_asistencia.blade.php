<!--<script src="<?php echo URL::to('/') ?>/js/manifest.js"></script>
<script src="<?php echo URL::to('/') ?>/js/vendor.js"></script>
<script src="<?php echo URL::to('/') ?>/js/frontend.js"></script>-->


<link rel="stylesheet" href="<?php echo URL::to('/') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!--<link rel="stylesheet" type="text/css" href="<?php echo URL::to('/') ?>assets/vendor/datatables/dataTables.bootstrap4.min.css">-->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
<!--<script src="<?php echo URL::to('/') ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>-->

<!--
<link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" />
-->



<style>

.table td.verde{
	background:#CAE983 !important
}
.table td.amarillo{
	background:#FFFF77 !important
}
.table td.rojo{
	background:#FFD9D9 !important
}

.table td.verde_claro{
	background:#B3FFB3 !important
}

.page-item.active .page-link {
    background-color: lightgrey !important;
    border: 1px solid black;
}
.page-link {
    color: black !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
  background: none;
  color: black!important;
  /*change the hover text color*/
}


/*below block of css for change style when active*/

.dataTables_wrapper .dataTables_paginate .paginate_button:active {
  background: none;
  color: black!important;
}
</style>

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
		top: 400px!important;
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

@extends('frontend.layouts.app')

@section('title',  ' | ' . __('labels.frontend.contact.box_title'))

@section('breadcrumb')
<ol class="breadcrumb" style="padding-left:130px;margin-top:0px;background-color:#283659">
        <li class="breadcrumb-item text-primary">Inicio</li>
            <li class="breadcrumb-item active">Reporte por Area</li>
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
                        Listar Asistencia <!--<small class="text-muted">Usuarios activos</small>-->
                    </h4>
                </div><!--col-->
            </div>

        <div class="row justify-content-center">
        
        <div class="col col-sm-12 align-self-center">

            <div class="card">
                <div class="card-header">
                    <strong>
                        Listar Asistencia
                    </strong>
                </div><!--card-header-->
				
				<form class="form-horizontal" method="post" action="{{ route('frontend.persona')}}" id="frmMantenimiento" autocomplete="off">
				
				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="id_persona_bus" id="id_persona_bus" value="">
				
				<div class="row" style="padding:20px 20px 0px 20px;">
					
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<select class="form-control form-control-sm" id="id_area_trabajo_" name="id_area_trabajo_" onChange="obtenerUnidad()">
							<option value="">- Seleccione Area -</option>
							<?php 
							if($area_trabajo!=""){
								foreach ($area_trabajo as $row) {?>
								<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
							<?php 
								} 
							}
							?>
						</select>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<select class="form-control form-control-sm" id="id_unidad_trabajo_" name="id_unidad_trabajo_">
							<option value="">Selec. Unidad</option>
						</select>
					</div>
					
						
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="persona" name="persona" placeholder="Apellidos y Nombres">
						<div id="persona_busqueda" style="position: absolute;z-index: 100;background-color:#ffffff;width: 400px;"></div>
					</div>
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<select class="form-control form-control-sm" id="anio" name="anio" >
							<?php for($i=2020;$i<=date("Y");$i++){?>
								<option value="<?php echo $i?>" <?php if($i==date("Y"))echo "selected='selected'"?> ><?php echo $i?></option>
							<?php } ?>
						</select>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<select class="form-control form-control-sm" id="mes" name="mes">
							<?php foreach($meses as $key=>$row){?>
								<option value="<?php echo $key?>" <?php if($key==date("m"))echo "selected='selected'"?>><?php echo $row?></option>
							<?php }?>
						</select>
					</div>
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<select name="estado" id="estado" class="form-control form-control-sm">
							<option value="">Todos</option>
							<option value="1">Ok</option>
							<option value="2">Abandono</option>
							<option value="3">Observado</option>
						</select>
					</div>

				</div>
				<div class="row" style="padding:20px 20px 0px 20px;">

					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<div class="form-group">
                            <label class="form-control-sm">Fecha inicio</label>
							<input class="form-control form-control-sm" id="fecha_ini" name="fecha_ini" value="<?php echo date("d/m/Y")?>" placeholder="Fecha Inicio">
						</div>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="form-control-sm">Fecha Fin</label>
							<input class="form-control form-control-sm" id="fecha_fin" name="fecha_fin" value="" placeholder="Fecha fin">
						</div>
					</div>

					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="padding-right:0px;padding-top:30px">
						<input class="btn btn-warning pull-rigth" value="Buscar" type="button" id="btnBuscar" />
						<input class="btn btn-success pull-rigth" value="Nueva Papeleta" type="button" id="btnPapeleta" style="margin-left:15px" />
					</div>

					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="form-control-sm">Fecha Proceso</label>
							<input class="form-control form-control-sm" id="fecha_proceso" name="fecha_proceso" value="" placeholder="Fecha Proceso">
						</div>
					</div>

					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="padding-right:0px;padding-top:30px">
						<input class="btn btn-danger pull-rigth" value="Procesar" type="button" id="btnProcesar" onclick="asistenciaAutomatico()" />
					</div>

				</div>
				
                <div class="card-body">				

                    <div class="table-responsive">
                    <table id="tblAfiliado" class="table table-hover table-sm">
                        <thead>
                        <tr style="font-size:13px">
							<th>Doc Identidad</th>
							<th>Persona</th>							
							<th>Area</th>
							<th>Unidad</th>
							<!--<th>Turno</th>-->
							<th>Hora Prog</th>
							<!--<th>Salida Prog</th>-->
							<th>Fecha Asistencia</th>
							<th>Dia</th>
							<th>Labora</th>
							<th>Fecha Ingreso</th>
							<th>Hora Ingreso</th>
							<th>Fecha Salida</th>
							<th>Hora Salida</th>
							<th>Tiempo Prog</th>
							<th>Tardanza</th>
							<th>Tiempo Trabajado</th>
							<th>Estado</th>
							<!--<th>Observaci&oacute;n</th>-->
							<th>Tip. Pap.</th>
							<th>Hora. Pap.</th>
							<th>Tiempo Pap.</th>

							<th>Papeleta</th>
							<th>Editar</th>
							<th>Detalle</th>
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

<script src="{{ asset('js/listar_asistencia.js') }}"></script>
@endpush
