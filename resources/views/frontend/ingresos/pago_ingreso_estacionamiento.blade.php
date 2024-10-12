<link rel="stylesheet" href="<?php echo URL::to('/') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
<style>
	#tblPesaje tbody tr{
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

@hasanyrole('administrator')
	<script type="text/javascript">var flagAccion=true</script>
@else
	<script type="text/javascript">var flagAccion=false</script>
@endhasanyrole


@extends('frontend.layouts.app1')

@section('title', app_name() . ' | ' . __('labels.frontend.contact.box_title'))

@section('breadcrumb')
<ol class="breadcrumb" style="padding-left:130px;margin-top:0px;background-color:#283659">
        <li class="breadcrumb-item text-primary">Inicio</li>
            <li class="breadcrumb-item active">Pago Ingreso Estacionamiento</li>
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
				<!--
                <div class="col-sm-5">
                    <h4 class="card-title mb-0 text-primary">
                        Pago Pesaje de Carreta 
                    </h4>
                </div>-->
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="margin-top:15px">
                    <h4 class="card-title mb-0 text-primary" style="font-size:24px">
                        Pago Ingreso Estacionamiento 
                        <!--<small class="text-muted">Usuarios activos</small>-->
                    </h4>
                </div>
				
				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
					<div class="form-group">
						<br>
						
						<?php 
						$readonly='';
						$saldo_inicial = "";
						$total_recaudado = "";
						$saldo_total = "";
						$disabled="disabled='disabled'";
						if(isset($caja_usuario) && $caja_usuario->estado==1):
							$readonly="readonly='readonly'";
							$disabled = "";
							$saldo_inicial = number_format($caja_usuario->saldo_inicial,2);
							$total_recaudado = number_format($caja_usuario->total_recaudado,2);
							$saldo_total = number_format($caja_usuario->saldo_total,2);
						?>
						<input class="btn btn-warning btn-sm pull-right" value="CERRAR DE CAJA" name="cerrar" type="button" form="prestacionescrea" id="btnGuardar" onclick="aperturar('u')" />
						<?php else:?>
						<input class="btn btn-warning btn-sm pull-right" value="APERTURA DE CAJA" name="aperturar" type="button" form="prestacionescrea" id="btnGuardar" onclick="aperturar('i')" />
						<?php endif;?>
						
						
					</div>
				</div>
				
				
				<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12" style="padding:0px">
					<div class="form-group">
						<label class="form-control-sm">Caja</label>
						
						<?php 
						//$readonly='';
						if(isset($caja_usuario) && $caja_usuario->estado==1):
							//$readonly="readonly='readonly'";
						?>
						<input type="text" name="caja" id="caja" readonly="" value="<?php echo $caja_usuario->caja?>"  placeholder="" class="form-control form-control-sm">
						<input type="hidden" name="id_caja" id="id_caja" value="<?php echo $caja_usuario->id_caja?>" />
						<input type="hidden" name="id_caja_ingreso" id="id_caja_ingreso" value="<?php echo $caja_usuario->id?>" />
						<?php else:?>
						<select name="id_caja" id="id_caja" class="form-control form-control-sm">
							<option value="0">Seleccionar</option>
							<?php foreach($caja as $row):?>
								<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
							<?php  endforeach;?>
						</select>
						<input type="hidden" name="id_caja_ingreso" id="id_caja_ingreso" value="0" />
						<?php endif;?>
					</div>	
				</div>
				
				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="form-control-sm">Saldo Caja</label>
						<input type="text" name="saldo_inicial" id="saldo_inicial" <?php echo $readonly?> value="<?php echo $saldo_inicial?>"  placeholder="" class="form-control form-control-sm text-right">
					</div>	
				</div>
				
				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="form-control-sm">Total Recaudado</label>
						<input type="text" name="total_recaudado" id="total_recaudado" value="<?php echo $total_recaudado?>" readonly=""  placeholder="" class="form-control form-control-sm text-right">
					</div>
				</div>
				
				<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
					<div class="form-group">
						<label class="form-control-sm">Saldo Total</label>
						<input type="text" name="saldo_total" id="saldo_total" value="<?php echo $saldo_total?>" readonly="" placeholder="" class="form-control form-control-sm text-right">
					</div>
				</div>
				<!--
				<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12" style="padding-top:30px">
					<a class="btn btn-success pull-rigth" href="<?php //echo URL::to('/')."/pesaje/consulta_pesaje_carreta" ?>"  target="_blank"/>Detalle Caja</a>
				</div>
				-->
            </div>

        <div class="row justify-content-center">
        
        <div class="col col-sm-12 align-self-center">

            <div class="card">
                <div class="card-header">
                    <strong>
						Lista de Pesaje de Carreta
                    </strong>
                </div><!--card-header-->
				<!--
				<div class="col-md-12" style="padding-top:10px">
					<input class="form-control" id="system-search" name="q" placeholder="Buscar ...">                        
				</div>
				-->
				
				<form class="form-horizontal" method="post" action="{{ route('frontend.contact.send')}}" id="frmAfiliacion" autocomplete="off">
				<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
				
				<div class="row" style="padding:20px 20px 0px 20px;">
					
					<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
						<select name="tipo" id="tipo" class="form-control form-control-sm">
							<option value="1">PENDIENTE</option>
							<option value="2">PAGADO</option>
						</select>
					</div>
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="numero_documento" name="numero_documento" placeholder="Num Documento">
					</div>
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="afiliado" name="afiliado" placeholder="Afiliado">
					</div>
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="placa" name="placa" placeholder="Placa">
					</div>
					
					<div class="col-lg-1 col-md-2 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="fecha_ingreso" name="fecha_ingreso" value="" placeholder="Fecha Ingreso">
					</div>
					
					<div class="col-lg-1 col-md-2 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="fecha_salida" name="fecha_salida" value="" placeholder="Fecha Salida">
					</div>
					
					<div class="col-lg-1 col-md-2 col-sm-12 col-xs-12">
						<input class="form-control form-control-sm" id="fecha_pago" name="fecha_pago" value="" placeholder="Fecha Pago">
					</div>
					
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<input class="btn btn-warning pull-rigth" value="Buscar" type="button" id="btnBuscar" />
					</div>
					
					<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
						<input class="btn btn-danger pull-rigth" value="Renovar" type="button" id="btnRenovar" onclick="renovarIngresoEstacionamiento()" />
					</div>
					
					@hasanyrole('cajero y balanza|cajero')
						<input type="hidden" class="form-control form-control-sm" id="id_usuario" name="id_usuario" value="<?php echo $id_user?>">
					@else
						<input type="hidden" class="form-control form-control-sm" id="id_usuario" name="id_usuario" value="0">
					@endhasanyrole
					
				</div>
				
                <div class="card-body">

                    <div class="table-responsive">
                    <table id="tblPesaje" class="table table-hover table-sm">
                        <thead>
                        <tr style="font-size:13px">
                            <th>Tip Doc</th>
                            <th>Num Documento</th>
                            <th>Due&ntilde;o de la carga</th>
                            <th>Placa</th>
							<th>Ejes</th>
							<th>Fecha Ingreso</th>
							<th>Fecha Salida</th>
							<!--<th>Fecha</th>-->
                            <th>Concepto de Pago</th>
							<th>Importe</th>
                            <th class="text-left">Estac</th>
							<th class="text-left">Ticket</th>
							<th class="text-left">Eliminar</th>
							<!--<th class="text-left">Eliminar</th>-->
                        </tr>
                        </thead>
                        <tbody><!--
                            <?php /*foreach($pesaje as $row):
							
								$tipo_documento = $row->tipo_documento;
								$numero_documento = $row->numero_documento;
								$val_pac_nombre = $row->val_pac_nombre;
								if($row->val_persona == 0){
									$numero_documento = $row->ruc;
									$tipo_documento = "RUC";
									$val_pac_nombre = $row->nombre_comercial;
								}*/
                            ?>
                                <tr style="font-size:13px">
                                    <td class="text-left"><?php //echo $tipo_documento?></td>
                                    <td class="text-left"><?php //echo $numero_documento?></td>
                                    <td class="text-left"><?php //echo $val_pac_nombre?></td>
									<td class="text-left"><?php //echo date("d/m/Y", strtotime($row->val_fecha));?></td>
                                    <td class="text-left"><?php //echo $row->vsm_smodulod?></td>
									<td class="text-left"><?php //echo $row->val_total?></td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">
                                            <a href="/pesaje/ver_pesaje_carreta/<?php //echo $row->id?>" class="btn btn-sm btn-info" target="_blank">
                                                <i class="fa fa-search"></i>
                                            </a>
                                        </div>
                                    </td>
									<td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">
											<?php //if($row->id_factura > 0){?>
                                            <a href="/factura/<?php //echo $row->id_factura?>" class="btn btn-sm btn-success" target="_blank">
                                                <i class="fa fa-search"></i>
                                            </a>
											<?php //}else{?>
												<button type="button" class="btn btn-sm btn-success" data-toggle="modal" disabled="disabled">
													<i class="fa fa-search"></i>
                                            	</button>
										<?php //} ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php //endforeach;?>
                        	-->
                            <!--<tr>
                                <td colspan="11" class="text-center">
                                    <span class="badge badge-default">{{ __('log-viewer::general.empty-logs') }}</span>
                                </td>
                            </tr>
                            -->
                        </tbody>
						<tfoot id="tBodyTotalPagado" style="display:none">
							<tr>
							<td colspan="8" align="right"><strong>Total</strong></td>
							<td><strong><span id="total_pagado">500</span></strong></td>
							<td colspan="3"></td>
							</tr>
						</tfoot>
                    </table>
                </div><!--table-responsive-->
                



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
{!! script(asset('js/pagoIngresoEstacionamientoLista.js')) !!}
<script type="text/javascript">
//$(document).ready(function () {
	/*$('#tblPesaje').DataTable({
		"dom": '<"top">rt<"bottom"flpi><"clear">'
		});
	$("#system-search").keyup(function() {
			var dataTable = $('#tblPesaje').dataTable();
		   dataTable.fnFilter(this.value);
		}); */
//});

var id_caja = "<?php echo (isset($caja_usuario) && $caja_usuario->estado==1)?$caja_usuario->id_caja:0?>";
//alert(id_caja);
</script>
@endpush

