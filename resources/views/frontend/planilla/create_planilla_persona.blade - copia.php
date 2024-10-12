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

    .modal { overflow: auto !important; }
    .ui-front {
        z-index: 9999!important;
    }
	
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

</style>

@extends('frontend.layouts.app')

@section('title',  ' | ' . __('labels.frontend.contact.box_title'))

@section('breadcrumb')
<ol class="breadcrumb" style="padding-left:130px;margin-top:0px;background-color:#283659">
        <li class="breadcrumb-item text-primary">Inicio</li>
            <li class="breadcrumb-item active">Consulta de Personas</li>
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
    <div class="justify-content-center">
    <!--<div class="container-fluid">-->

    <div class="card">

        <div class="card-body">

            <form class="form-horizontal" method="post" action="{{ route('frontend.planilla.create')}}" id="frmPlanilla" autocomplete="off">
				
                <div class="row justify-content-center" style="margin-top:15px">

                    <div class="col col-sm-12 align-self-center">

                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="id_periodo" id="id_periodo" value="0">
						<input type="hidden" name="id_persona" id="id_persona" value="0">
                        
					<div class="row">

						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

							<div class="card">
						
								<div class="card-header">
									<strong>Registrar Planilla</strong>
								</div>
						
								<div class="card-body">
						
									<div class="row">	
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="control-label">Empresa</label>
												<select class="form-control form-control-sm" id="id_ubicacion" name="id_ubicacion" onchange="fn_ListarBusqueda();">
													<option value="0">- Seleccione Empresa -</option>
													<?php foreach ($empresa as $row) {?>
														<option value="<?php echo $row->id?>"><?php echo $row->razon_social?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									
									<div class="row" >
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="control-label">Planilla</label>
												<select class="form-control form-control-sm" id="id_planilla" name="id_planilla" onChange="obtenerSubPlanilla()">
													<option value="0">- Seleccione Planilla -</option>
													<?php foreach ($planilla as $row) {?>
														<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="control-label">SubPlanilla</label>
												<select class="form-control form-control-sm" id="id_subplanilla" name="id_subplanilla" onchange="fn_ListarBusqueda();">
													<option value="0">- Seleccione SubPlanilla -</option>
												</select>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="control-label">A&ntilde;o</label>
												<select class="form-control form-control-sm" id="anio" name="anio" onchange="fn_ListarBusqueda();">
													<?php for($i=2020;$i<=date("Y");$i++){?>
														<option value="<?php echo $i?>" <?php if($i==date("Y"))echo "selected='selected'"?> ><?php echo $i?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="control-label">Mes</label>
												<select class="form-control form-control-sm" id="mes" name="mes" onchange="fn_ListarBusqueda();">
													<?php foreach ($meses as $row) {?>
														<option value="<?php echo $row->id?>" <?php if($row->id==date("m"))echo "selected='selected'"?>><?php echo $row->nombre_mes?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="control-label">Fecha de Inicio</label>
												<input class="form-control form-control-sm" id="fech_inic_tpe" name="fech_inic_tpe" value="" placeholder="Fecha Inicio">
											</div>
										</div>
									
										<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
											<div class="form-group">
												<label class="control-label">Fecha de Fin</label>
												<input class="form-control form-control-sm" id="fech_fina_tpe" name="fech_fina_tpe" value="" placeholder="Fecha Inicio">
											</div>
										</div>
									</div>
						
								</div>
					
							</div>
							
						</div>
						
						
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

							<div class="card">
						
								<div class="card-header">
									<strong>Personas Asignados</strong>
								</div>
						
								<div class="card-body">
									
									<div class="col-md-12" style="padding-top:10px">
										<input class="form-control" id="system-search" name="q" placeholder="Buscar ...">                        
									</div>
									
									<div class="table-responsive overflow-auto" style="max-height: 500px;padding-top:20px">
										<table id="tblSolicitud" class="table table-hover table-sm">
										<thead>
										<tr style="font-size:13px">
											<th><input type="checkbox" name="select_all" value="1" id="example-select-all" ></th>
											<th>Tipo</th>
											<th>N.Documento</th>
											<th>Nombres</th>
											<!--<th>Cond.Laboral</th>-->
											<!--<th>Reg.Pens.</th>-->
											<th>Area Trab.</th>
											<th>Unidad Trab.</th>
											<!--<th>Empresa</th>-->
										</tr>
										</thead>
										<tbody style="font-size:13px">
										</tbody>
										</table>
									</div>
								</div>
								
								<!--
								<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="display:none" id="divConceptoPersona">
							
									<strong>Conceptos Asignados</strong>
									
									<div class="table-responsive overflow-auto" style="max-height: 500px;padding-top:20px">
										<table id="tblCronograma" class="table table-hover table-sm">
											<thead>
												<tr style="font-size:13px">
													<th width="15%">Código</th>
													<th width="50%">Concepto Trabajador</th>
													<th width="25%">Monto</th>
													<th width="15%"></th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
								-->
	
							</div>
						
						</div>
						
                    </div>						

                </div>


        </div>
        <!--col-->
				
				<a class='flotante' name="guardar" id="guardar" onclick="guardarPlanilla()" href='#' ><img src='/img/btn_save.png' border="0"/></a>
				
        </form>

        

    </div>
    <!--row-->
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

<script src="{{ asset('js/planillaPersona.js') }}"></script>
@endpush
