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

@section('content')

<div class="justify-content-center">
    <!--<div class="container-fluid">-->

    <div class="card">

        <div class="card-body">

            <form class="form-horizontal" method="post" action="{{ route('frontend.asistencia.resumen')}}" id="frmSolicitud" autocomplete="off">
				
                <div class="row justify-content-center" style="margin-top:15px">

                    <div class="col col-sm-12 align-self-center">


                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="id_solicitud" id="id_solicitud" value="0">
                        
					<div class="row">

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<div class="card">
						
						<div class="card-header">
							<strong>Resumen de Asistencia</strong>
						</div>
						
						<div class="row" style="padding:10px 20px 10px 20px;">
					
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

							<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
								<select name="id_estado" id="id_estado" class="form-control form-control-sm" onchange="">
									<option value="3,5">Todos</option>
									<option value="3">CAS</option>
									<option value="5">TERCEROS</option>
								</select>
							</div>
							
							<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
								<input class="btn btn-warning btn-sm pull-rigth" value="Buscar" type="button" id="btnBuscar" />
							</div>
							
						</div>
												

                    </div>
					
					
					<div class="row" style="padding-top:15px">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div id="" class="row">

									<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">                                        
                                        <div class="card">
                                            <div class="card-header">
                                                <strong>
                                                    Lista de Personal
                                                </strong>
                                            </div>

                                            <div class="card-body">
												
                                                <div class="table-responsive overflow-auto" style="max-height: 500px;padding-top:20px">
                                                    <table id="tblAfiliado" class="table table-hover table-sm">
                                                        <thead>
                                                            <tr style="font-size:13px">
                                                            <!--
                                                                <th width="15%">Tipo</th>
																<th width="15%">Código</th>
																<th width="70%">Concepto</th>
                                    -->
                                                                <th>Id</th>                                                                
                                                                <th>N.Documento</th>
                                                                <th>Nombres</th>
                                                                <th>Área</th>
                                                                <th>Unidad</th>                                                                
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
												
												<!--<a class='flotante' name="guardar" id="guardar" onclick="guardarSolicitud()" href='#' ><img src='/img/btn_save.png' border="0"/></a>-->
												

                                            </div>
                                        </div>
                                    </div>
									
									<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">                                        
                                        <div class="card">
                                            <div class="card-header">
                                                <strong>
                                                    Valores de los Días Trabajados
                                                </strong>
                                            </div>

                                            <div class="card-body">
												
                                                <div class="table-responsive overflow-auto" style="max-height: 500px;padding-top:20px">
                                                    <table id="tblCronograma" class="table table-hover table-sm">
                                                        <thead>
                                                            <tr style="font-size:13px">
																<th width="15%">Código</th>
																<th width="30%">Concepto</th>
                                                                <th width="55%">Tiempo</th>
																<!--<th width="5%"></th>-->
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
												
												<!--<a class='flotante' name="guardar" id="guardar" onclick="guardarSolicitud()" href='#' ><img src='/img/btn_save.png' border="0"/></a>-->
												

                                            </div>
                                        </div>
                                    </div>
									
                                </div>

                                <br>

                                <div id="" class="row">
                                                                        
                                </div>


                            </div>
                        </div>
						
						

                </div>



        </div>
        <!--col-->

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

<script src="{{ asset('js/resumen.js') }}"></script>
@endpush

