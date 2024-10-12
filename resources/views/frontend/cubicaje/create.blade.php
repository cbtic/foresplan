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
	*display:inline;
	*zoom:1;
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

/*
 VERSION PARA IMPRESORAS
*/
@page {
  margin: 0;
}

@media print {
	/*
  html, body {
    width: 80mm;
    height: 297mm;
  }
  */
	
    *, :after, :before {
        color: #FFF!important;
        text-shadow: none!important;
        background: blue!important;
        -webkit-box-shadow: none!important;
        box-shadow: none!important;
        font-family:sans-serif;
    }
	
    p,table, th, td {
        color: black !important;
        font-size: 16px !important;
        font-family:sans-serif;
    }
	
    .resaltado {
        color: black !important;
        font-size: 36px !important;
        font-weight: bold;
    }
	
    .divlogoimpresora {
        display: block !important;
    }
	
    .logoimpresora {
        margin-left: auto;
        margin-right: auto;
        margin-top: 0px;
        margin-bottom: 5px;
        display: block;
        width: 250px !important;
        height: 55px !important;
    }
	
    h3{
        color: black !important;
        font-size: 52px !important;
        text-align: center;
        font-family:sans-serif;
    }
	
    .separador {
        display: block;
        margin-top: 20px;
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
	
	#divTablaIngreso{
		display: none !important
	}
	
	.c-header.c-header-light.c-header-fixed{
		display: none !important
	}
	
	#btnGuardar{
		display: none !important
	}
	
	#btnImprimir{
		display: none !important
	}
	
	.bottom{
		display: none !important
	}
	
	.cubicaje{
		display: none !important
	}
	.form-control{
		border:0px !important;
		font-weight:bold !important;
		color:#000000 !important;
	}
	
	.card-header strong{
		padding: 10px 10px !important;
		font-weight:bold !important;
		color:#000000 !important;
		font-size: 22px !important;
		border:0px !important;
	}
	
	.card-header{
		border:0px !important;
	}
	.card{
		border:0px !important;
	}
	
	.c-footer{
		display: none !important
	}

	#divCubicaje{
		max-height: 5000px !important
	}
	
	#tblSolicitud tbody tr.even{
		display: none !important
	}
	/*
	#tblSolicitud{
		display: block !important
	}
	*/
	
}

</style>



@stack('before-scripts')
@stack('after-scripts')

@extends('backend.layouts.app')

@section('title', ' | ' . __('labels.frontend.afiliacion.box_title'))

@section('breadcrumb')
<ol class="breadcrumb" style="padding-left:130px;margin-top:0px;background-color:#283659">
    <li class="breadcrumb-item text-primary">Inicio</li>
    <li class="breadcrumb-item active">Registro de Solicitud</li>
    </li>
</ol>

@endsection

<div class="loader"></div>

@section('content')
<!--
    <ol class="breadcrumb" style="padding-left:120px;margin-top:0px;background-color:#355C9D">
        <li class="breadcrumb-item text-primary">Inicio</li>
            <li class="breadcrumb-item active">Nueva Asistencia</li>
        </li>
    </ol>
    -->

<div class="justify-content-center">
    <!--<div class="container-fluid">-->
	
	<a href="javascript:void(0)" onclick="ocultar_solicitud()"><i class="fa fa-bars fa-lg" style="position:absolute;right:50%;top:-24px;color:#FFFFFF"></i></a>
	
    <div class="card">

        <div class="card-body">

            <form class="form-horizontal" method="post" action="" id="frmIngreso" autocomplete="off" enctype="multipart/form-data">
				<!--
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" style="margin-top:15px">
                        <h4 class="card-title mb-0 text-primary" style="font-size:22px">
                            Registro Solicitudes
                        </h4>
                    </div>
                </div>
				-->
                <div class="row justify-content-center" style="margin-top:15px">
					
                    <input type="hidden" name="flag_ocultar" id="flag_ocultar" value="0">
					
					<div class="col col-sm-12 align-self-center">

                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id_ingreso_vehiculo_tronco_tipo_maderas" id="id_ingreso_vehiculo_tronco_tipo_maderas" value="0">
						
					<div class="row" style="padding-top:15px">

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<div class="card">
						
						<div class="divlogoimpresora" style="display:none;">
							<img class="logoimpresora" src="/img/logo_forestalpama.jpg" align="right">
						</div>
						
						<div class="card-header">
							<strong>Ingreso de Camiones - Cubicaje</strong>
						</div>
							
						<div id="divTablaIngreso" class="row col align-self-center" style="padding:10px 20px 10px 20px;">
					
							<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
								<input class="form-control form-control-sm" id="nombre_py_bus" name="nombre_py_bus" placeholder="Nombre del Proyecto">
							</div>
							
							<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
								<input class="form-control form-control-sm" id="detalle_py_bus" name="detalle_py_bus" placeholder="Detalle del Proyecto">
							</div>
							
							<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
								<select name="estado_py_bus" id="estado_py_bus" class="form-control form-control-sm" onchange="">
									<option value="">ESTADO PROYECTO</option>
									<?php
									
									?>
								</select>
							</div>
							
							<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
								<select name="estado" id="estado" class="form-control form-control-sm" onchange="">
									<option value="">ESTADO</option>
									<option value="1">ACTIVO</option>
									<option value="0">INACTIVO</option>
								</select>
							</div>
							
							<!--
							<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
								<select name="id_estado" id="id_estado" class="form-control form-control-sm" onchange="">
									<option value="0">Todos</option>
									<option value="1">PENDIENTE</option>
									<option value="2">VALORIZADO</option>
									<option value="3">APROBADO</option>
									<option value="4">RECHAZADO</option>
									<option value="5">DESEMBOLSADO</option>
								</select>
							</div>
							-->
							<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
								<input class="btn btn-warning btn-sm pull-rigth" value="Buscar" type="button" id="btnBuscar" />
							</div>
							
						</div>
						
						<div class="card-body">
							
							<div class="table-responsive">
							<!--table-hover-grid-->
							<table id="tblSolicitud" class="table table-hover table-sm">
							<thead>
							<tr style="font-size:13px">
								<th>Id</th>
								<th>Fecha</th>
								<th>Placa</th>
								<th>Ruc</th>
								<th>Empresa</th>
								<th>Doc Conductor</th>
								<th>Conductor</th>
								<th>Tipo Madera</th>
								<th>Cantidad</th>
								<th class="cubicaje">Cubicaje</th>
							</tr>
							</thead>
							<tbody style="font-size:13px">
							</tbody>
							</table>
							
							</div>
						</div>
						
						
						<!--
                        <div id="" class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">


                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

                                <br>

                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            </div>

                        </div>
						-->
                    </div>
					
					

                </div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        
					<div class="card">
						<div class="card-header">
							<strong>
								Cubicaje
							</strong>
						</div>

						<div class="card-body">
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<input class="btn btn-warning btn-sm float-right" style="margin-left:15px" value="Imprimir" type="button" id="btnImprimir" onclick="print()" />
								
								<input class="btn btn-success btn-sm float-right" value="Guardar" type="button" id="btnGuardar" />
								
							</div>
							
							<div id="divCubicaje" class="table-responsive overflow-auto" style="max-height: 500px">
								<table id="tblCubicaje" class="table table-hover table-sm">
									<thead>
										<tr style="font-size:13px">
											<th width="2%">Cantidad</th>
											<th width="10%">Diametro 1(cm)</th>
											<th width="10%">Diametro 2(cm)</th>
											<th width="10%">Diametro DM(m)</th>
											<th width="10%">Longitud(m)</th>
											<th width="10%">Volumen M3</th>
											<th width="10%">Volumen Pies</th>
											<th width="10%">Volumen Total M3</th>
											<th width="10%">Volumen Total Pies</th>
											<th width="10%">Precio Unitario</th>
											<th width="10%">Precio Total</th>
										</tr>
									</thead>
									<tbody>

									</tbody>
								</table>
							</div>
							
							<!--<a class='flotante' name="guardar" id="guardar" onclick="guardarSolicitud()" href='#' ><img src='/img/btn_save.png' border="0"/></a>-->
							
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								
								<input class="btn btn-warning btn-sm float-right" style="margin-left:15px" value="Imprimir" type="button" id="btnImprimir" onclick="print()" />
								
								<input class="btn btn-success btn-sm float-right" value="Guardar" type="button" id="btnGuardar" />
								
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
    
	<script type="text/javascript">
	
	$(document).ready(function() {
		$(".upload").on('click', function() {
			var formData = new FormData();
			var files = $('#image')[0].files[0];
			formData.append('file',files);
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url: "/proyecto/upload",
				type: 'post',
				data: formData,
				contentType: false,
				processData: false,
				success: function(response) {
				
					var ind_img = $("#ind_img").val();
					
					if (response != 0) {
						$("#img_ruta_"+ind_img).attr("src", "/img/proyecto/tmp/"+response).show();
						$(".delete_ruta").show();
						$("#img_foto_"+ind_img).val(response);
						
						ind_img++;
						
						var newRow = "";
						newRow += '<div class="img_ruta">';
						newRow += '<img src="" id="img_ruta_'+ind_img+'" width="130px" height="165px" alt="" style="text-align:center;margin-top:8px;display:none;margin-left:10px" />';
						newRow += '<span class="delete_ruta" style="display:none" onclick="DeleteImagen(this)"></span>';
						newRow += '<input type="hidden" id="img_foto_'+ind_img+'" name="img_foto[]" value="" />';
						newRow += '</div>';
						
						$("#divImagenes").append(newRow);
						$("#ind_img").val(ind_img);
						
					} else {
						alert('Formato de imagen incorrecto.');
					}
				}
			});
			return false;
		});
	
		$(".delete").on('click', function() {
			$("#img_ruta0").attr("src", "/dist/img/profile-icon.png");
			$("#img_foto0").val("");
		});
	
	});
	
	</script>
	
	<script src="{{ asset('js/cubicaje/create.js') }}"></script>
	
	@endpush