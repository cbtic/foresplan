<!--<script src="<?php echo URL::to('/') ?>/js/manifest.js"></script>
<script src="<?php echo URL::to('/') ?>/js/vendor.js"></script>
<script src="<?php echo URL::to('/') ?>/js/frontend.js"></script>-->


<link rel="stylesheet" href="<?php echo URL::to('/') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!--<link rel="stylesheet" type="text/css" href="<?php echo URL::to('/') ?>assets/vendor/datatables/dataTables.bootstrap4.min.css">-->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
<!--<script src="<?php echo URL::to('/') ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>-->

<style>

    .table-hover tbody tr.row_selected td{background-color:#239244!important;color:#ffffff!important}

    .table td.verde{
        background:#CAE983  !important
    }

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
                        <input type="hidden" name="id_planilla" id="id_planilla" value="0">
                        <input type="hidden" name="id_persona_bus" id="id_persona_bus" value="">
						
                        <div class="row">

                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                                <div class="card">
                                
                                    <div class="card-header">
                                        <strong>
                                            Lista de Planillas
                                            <!--<input class="btn btn-warning btn-sm pull-right" value="GENERAR PLANILLA" type="button" id="btnPlanilla" onclick="generarPlanilla()" style="margin-left:20px" />-->
                                            <input class="btn btn-success btn-sm pull-right" value="GUARDAR PDF DE BOLETAS" type="button" id="btnGuardarPDFPlanilla" onclick="guardarPDFPlanilla()" style="margin-left:20px" disabled="disabled"/>
                                        </strong>
                                    </div>
                                    
                                    <div class="row" style="padding:10px 20px 10px 20px;">

                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <input class="form-control form-control-sm" id="persona" name="persona" placeholder="Apellidos y Nombres">
                                            <div id="persona_busqueda" style="position: absolute;z-index: 100;background-color:#ffffff;width: 400px;"></div>
                                        </div>

                                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                            <select class="form-control form-control-sm" id="id_periodo" name="id_periodo">
                                                <option value="0">- Seleccione Periodo -</option>
                                                <?php 
                                                if($periodos!=""){
                                                    foreach ($periodos as $row) {?>
                                                    <option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
                                                <?php 
                                                    } 
                                                }
                                                ?>
                                            </select>
                                        </div>


                                        <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                            <input class="btn btn-warning btn-sm pull-rigth" value="Buscar" type="button" id="btnBuscar" />
                                        </div>

                                        <!--<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                                            <input class="btn btn-danger btn-sm pull-rigth" value="Eliminar" type="button" id="btnEliminar" />
                                        </div>-->
                                        
                                    </div>

                                    <div class="card-body">
                                        
                                        <div class="table-responsive">
                                            <table id="tblListaPlanilla" class="table table-hover table-sm">
                                                <thead>
                                                    <tr style="font-size:13px">
                                                        <th>Id</th>
                                                        <th>Empresa</th>
                                                        <th>Planilla</th>
                                                        <th>Mes</th>
                                                        <th>Periodo</th>
                                                        <th>Fecha Periodo</th>
                                                        <th>Estado</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="font-size:13px">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">
                                        
                                        <div class="table-responsive">
                                            <table id="tblPlanilla" class="table table-hover table-sm">
                                                <thead>
                                                    <tr style="font-size:13px">
                                                        <th>Id</th>
                                                        <th>Tipo Doc.</th>
                                                        <th>N.Documento</th>
                                                        <th>Nombres</th>
                                                        <th>Planilla</th>
                                                        <th>S.Planilla</th>
                                                        <th>Empresa</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="font-size:13px">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>						
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" id="divPlanillaConcepto">                                        
                                
								
								<div class="card">
                                    <div class="card-header">
                                        <strong>
                                            Ingresos
                                        </strong>
                                    </div>

                                    <div class="card-body">
                                        
                                        <div class="table-responsive overflow-auto" style="max-height: 500px;padding-top:20px">
                                            <table id="tblIngreso" class="table table-hover table-sm">
                                                <thead>
                                                    <tr style="font-size:13px">
                                                        <th width="10%">id</th>
                                                        <th width="15%">Código</th>
                                                        <th width="60%">Concepto</th>
                                                        <th width="15%">Monto</th>
                                                        <!--<th width="5%"></th>-->
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>                                        
                                        
                                    </div>                                    
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <strong>
                                            Egresos
                                        </strong>
                                    </div>

                                    <div class="card-body">
                                        
                                        <div class="table-responsive overflow-auto" style="max-height: 500px;padding-top:20px">
                                            <table id="tblEgreso" class="table table-hover table-sm">
                                                <thead>
                                                    <tr style="font-size:13px">
                                                        <th width="10%">id</th>
                                                        <th width="15%">Código</th>
                                                        <th width="60%">Concepto</th>
                                                        <th width="15%">Monto</th>
                                                        <!--<th width="5%"></th>-->
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>                                        
                                        
                                    </div>                                    
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <strong>
                                            Aportaciones
                                        </strong>
                                    </div>

                                    <div class="card-body">
                                        
                                        <div class="table-responsive overflow-auto" style="max-height: 500px;padding-top:20px">
                                            <table id="tblAportaciones" class="table table-hover table-sm">
                                                <thead>
                                                    <tr style="font-size:13px">
                                                        <th width="10%">id</th>
                                                        <th width="15%">Código</th>
                                                        <th width="60%">Concepto</th>
                                                        <th width="15%">Monto</th>
                                                        <!--<th width="5%"></th>-->
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>                                        
                                        
                                    </div>                                    
                                </div>
								
								
								
                            </div>
                         
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>        
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

<script src="{{ asset('js/planillaLista.js') }}"></script>
@endpush
