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

</style>

@extends('frontend.layouts.app')

@section('title',  ' | ' . __('labels.frontend.contact.box_title'))

@section('breadcrumb')
<ol class="breadcrumb" style="padding-left:130px;margin-top:0px;background-color:#283659">
        <li class="breadcrumb-item text-primary">Inicio</li>
            <li class="breadcrumb-item active">Consulta de Formulas</li>
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
        
        <div class="card">

        <div class="card-body">

            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0 text-primary">
                        Consultar Formulas <!--<small class="text-muted">Usuarios activos</small>-->
                    </h4>
                </div><!--col-->
            </div>

        <div class="row justify-content-center">
        
        <div class="col col-sm-12 align-self-center">

            <div class="card">
                <div class="card-header">
                    <strong>
                        Lista de Formulas
                    </strong>
                </div><!--card-header-->
				
				<form class="form-horizontal" method="post" action="" id="frmFormula" autocomplete="off">
				
				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
				
				<div class="row" style="padding:20px 20px 0px 20px;">
				
                    <div class="col-lg-2">
                        <div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
                            <select name="id_tipo_planilla_bus" id="id_tipo_planilla_bus" class="form-control form-control-sm" onChange="obtenerSubPlanilla()">>
                                    <option value="0">- Seleccionar Tipo Planilla -</option>
                                    <?php foreach($tipPlanilla as $row):?>
                                        <option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
                                    <?php  endforeach;?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
                           <select name="sub_tipo_planilla_bus" id="sub_tipo_planilla_bus" class="form-control form-control-sm">
                                    <option value="0">- Seleccionar Sub Tipo Planilla -</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
                            <select name="concepto_bus" id="concepto_bus" class="form-control form-control-sm">
                                    <option value="0">- Seleccionar Concepto -</option>
                                    <?php foreach($concepto as $row):?>
                                        <option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
                                    <?php  endforeach;?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<select name="estado_bus" id="estado_bus" class="form-control form-control-sm">
							<option value="">- Seleccione Estado -</option>
							<option value="A"selected="selected">Activo</option>
							<option value="E">Inactivo</option>
						</select>
					</div>

                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="padding-right:0px">
						<input class="btn btn-warning pull-rigth" value="Buscar" type="button" id="btnBuscar" />
						<input class="btn btn-success pull-rigth" value="Nuevo" type="button" id="btnNuevo" style="margin-left:15px" />
					</div>
				</div>
				
                <div class="card-body">

                    <div class="table-responsive">
                    <table id="tblFormula" class="table table-hover table-sm">
                        <thead>
                        <tr style="font-size:13px">
                            <th>Id</th>
                            <th>Tipo Planilla</th>
                            <th>Sub Tipo Planilla</th>
							<th>Concepto</th>
							<th>Formula</th>
							<th>Orden</th>
							<th>Acciones</th>
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

<script src="{{ asset('js/formula.js') }}"></script>
@endpush
