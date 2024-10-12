<title>FORESPAMA</title>

<style>
/*
.datepicker {
  z-index: 1600 !important; 
}
*/
/*.datepicker{ z-index:99999 !important; }*/

.datepicker,
.table-condensed {
  width: 250px;
  height:250px;
}


.modal-dialog {
	width: 100%;
	max-width:40%!important
  }
  
#tablemodal{
    border-spacing: 0;
    display: flex;/*Se ajuste dinamicamente al tamano del dispositivo**/
    max-height: 80vh; /*El alto que necesitemos**/
    overflow-y: auto; /**El scroll verticalmente cuando sea necesario*/
    overflow-x: hidden;/*Sin scroll horizontal*/
    table-layout: fixed;/**Forzamos a que las filas tenga el mismo ancho**/
    width: 98vw; /*El ancho que necesitemos*/
    border:1px solid #c4c0c9;
}

#tablemodal thead{
    background-color: #e2e3e5;
    position: fixed !important;
}


#tablemodal th{
    border-bottom: 1px solid #c4c0c9;
    border-right: 1px solid #c4c0c9;
}

#tablemodal th{
    font-weight: normal;
    margin: 0;
    max-width: 9.5vw; 
    min-width: 9.5vw;
    word-wrap: break-word;
    font-size: 10px;
	font-weight:bold;
    height: 3.5vh !important;
	line-height:12px;
	vertical-align:middle;
	/*height:20px;*/
    padding: 4px;
    border-right: 1px solid #c4c0c9;
}

#tablemodal td{
    font-weight: normal;
    margin: 0;
    max-width: 9.5vw; 
    min-width: 9.5vw;
    word-wrap: break-word;
    font-size: 11px;
    height: 3.5vh !important;
    padding: 4px;
    border-right: 1px solid #c4c0c9;
}

#tablemodal tbody tr:hover td, #tablemodal tbody tr:hover th {
  /*background-color: red!important;*/
  font-weight:bold;
  /*mix-blend-mode: difference;*/
  
}

#tablemodalm{
	
}
</style>

<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>-->
<!--<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>-->
<!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>-->


<!--<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>-->


<!--Se quito estas dos lineas de datepicker y se puso las 3 de abajo -->
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />-->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.css" />


<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>-->

<!--
<script src="resources/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<link rel="stylesheet" href="resources/plugins/timepicker/bootstrap-timepicker.min.css">
-->

<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css">
-->

<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js" integrity="sha512-r/mHP22LKVhxWFlvCpzqMUT4dWScZc6WRhBMVUQh+SdofvvM1BS1Hdcy94XVOod7QqQMRjLQn5w/AQOfXTPvVA==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/css/bootstrap-datetimepicker.css" integrity="sha512-HWqapTcU+yOMgBe4kFnMcJGbvFPbgk39bm0ExFn0ks6/n97BBHzhDuzVkvMVVHTJSK5mtrXGX4oVwoQsNcsYvg==" crossorigin="anonymous" />
-->

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>-->
<script type="text/javascript">
/*
jQuery(function($){
$.mask.definitions['H'] = "[0-1]";
$.mask.definitions['h'] = "[0-9]";
$.mask.definitions['M'] = "[0-5]";
$.mask.definitions['m'] = "[0-9]";
$.mask.definitions['P'] = "[AaPp]";
$.mask.definitions['p'] = "[Mm]";
});
*/
$(document).ready(function() {

    $('#fecha_entrada').datepicker({
        autoclose: true,
		format: 'yyyy-mm-dd',
		changeMonth: true,
		changeYear: true,
        language: 'es'
    });

    $('#fecha_comprobante').datepicker({
        autoclose: true,
		format: 'yyyy-mm-dd',
		changeMonth: true,
		changeYear: true,
        language: 'es'
    });

    if($('#id').val()==0){
        /*$('#tipo_cambio_dolar_').hide();*/
        cambiarTipoCambio();
        cambiarOrigen()
        //$("#proveedor").select2({ width: '100%' });
    }

    

});

</script>

<script type="text/javascript">

$('#openOverlayOpc').on('shown.bs.modal', function() {
     $('#fecha_solicitud').datepicker({
		format: "dd-mm-yyyy",
		autoclose: true,
		//container: '#openOverlayOpc modal-body'
		container: '#openOverlayOpc modal-body'
     });
	 /*
	 $('#hora_solicitud').timepicker({
		showInputs: false,
		container: '#openOverlayOpc modal-body'
	});
	*/
	 
});

$(document).ready(function() {
	 
});

function cambiarTipoCambio(){

    var moneda = $('#moneda').val();
    //alert(moneda);
    if(moneda==2){
        $('#tipo_cambio_dolar_').show();
    }else if(moneda==1){
        $('#tipo_cambio_dolar_').hide();
    }else{
        $('#tipo_cambio_dolar_').hide();
    }

}

function cambiarOrigen(){

    var unidad_origen = $('#unidad_origen').val();
    //alert(moneda);
    if(unidad_origen==1){
        $('#proveedor_').hide();
    }else if(unidad_origen==2){
        $('#proveedor_').show();
    }else if(unidad_origen==3){
        $('#proveedor_').show();
        $('#proveedor').val(28);
    }else{
        $('#proveedor_').hide();
    }
}

function limpiar(){
	$('#id').val("0");
	$('#id_tipo_documento').val("");
	$('#denominacion').val("");
	$('#img_foto').val("");
}

function fn_save_entrada_producto(){
	
	$.ajax({
			url: "/entrada_productos/send_entrada_producto",
            type: "POST",
            data : $("#frmEntradaProductos").serialize(),
			success: function (result) {
				$('#openOverlayOpc').modal('hide');
                window.location.reload();
				datatablenew();
				//limpiar();
								
            }
    });
}

function modalDetalleProducto(id){
	
	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/entrada_productos/modal_detalle_producto",
			type: "GET",
            data : $("#frmEntradaProductos").serialize(),
			success: function (result) {  
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});

}


</script>


<body class="hold-transition skin-blue sidebar-mini">

    <div>
		<!--
        <section class="content-header">
          <h1>
            <small style="font-size: 20px">Programados del Medicos del dia <?php //echo $fecha_atencion?></small>
          </h1>
        </section>
		-->
		<div class="justify-content-center">		

            <div class="card">
                
                <div class="card-header" style="padding:5px!important;padding-left:20px!important">
                    Registrar Entrada
                </div>
                
                <div class="card-body">
                <form method="post" action="#" id="frmEntradaProductos" name="frmEntradaProductos">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:5px;padding-bottom:20px">
                                
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
                            
                            
                            <div class="row" style="padding-left:10px">
                                
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Fecha Ingreso</label>
                                        <input id="fecha_entrada" name="fecha_entrada" on class="form-control form-control-sm"  value="<?php //echo $lote->fecha_fabricacion?>" type="text">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Tipo Doc.</label>
                                        <select name="tipo_documento" id="tipo_documento" class="form-control form-control-sm" onchange="">
                                            <option value="">--Seleccionar--</option>
                                            <?php
                                            foreach ($tipo_documento as $row){?>
                                                <option value="<?php echo $row->codigo ?>" <?php //if($row->codigo==$lote->id_producto)echo "selected='selected'"?>><?php echo $row->denominacion ?></option>
                                             <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Unidad Origen</label>
                                        <select name="unidad_origen" id="unidad_origen" class="form-control form-control-sm" onchange="cambiarOrigen()">
                                            <option value="">--Seleccionar--</option>
                                            <?php
                                            foreach ($unidad_origen as $row){?>
                                                <option value="<?php echo $row->codigo ?>" <?php //if($row->codigo==$lote->id_producto)echo "selected='selected'"?>><?php echo $row->denominacion ?></option>
                                             <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4" id="proveedor_">
                                    
                                        <label class="control-label form-control-sm">Proveedor</label>
                                        <select name="proveedor" id="proveedor" class="form-control form-control-sm" onchange="">
                                            <option value="">--Seleccionar--</option>
                                            <?php
                                            foreach ($proveedor as $row){?>
                                                <option value="<?php echo $row->id ?>" <?php //if($row->id==$lote->id_producto)echo "selected='selected'"?>><?php echo $row->razon_social ?></option>
                                             <?php 
                                            }
                                            ?>
                                        </select>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Almacen Destino</label>
                                        <select name="almacen" id="almacen" class="form-control form-control-sm" onchange="">
                                            <option value="">--Seleccionar--</option>
                                            <?php
                                            foreach ($almacen as $row){?>
                                                <option value="<?php echo $row->id ?>" <?php //if($row->id==$lote->id_producto)echo "selected='selected'"?>><?php echo $row->denominacion ?></option>
                                                <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">N&uacute;mero Comprobante</label>
                                        <input id="numero_comprobante" name="numero_comprobante" on class="form-control form-control-sm"  value="<?php //echo $lote->numero_lote?>" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Fecha Comprobante</label>
                                        <input id="fecha_comprobante" name="fecha_comprobante" on class="form-control form-control-sm"  value="<?php //echo $lote->fecha_fabricacion?>" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Moneda</label>
                                        <select name="moneda" id="moneda" class="form-control form-control-sm" onchange="cambiarTipoCambio()">
                                            <option value="">--Seleccionar--</option>
                                            <?php
                                            foreach ($moneda as $row){?>
                                                <option value="<?php echo $row->codigo ?>" <?php //if($row->codigo==$lote->id_moneda)echo "selected='selected'"?>><?php echo $row->denominacion ?></option>
                                             <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-4" id="tipo_cambio_dolar_">
                                        <label class="control-label form-control-sm">Tipo Cambio Dolar</label>
                                        <input id="tipo_cambio_dolar" name="tipo_cambio_dolar" on class="form-control form-control-sm"  value="<?php echo $tipo_cambio[0]->valor_venta?>" type="text">
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Sub Total Compra</label>
                                        <input id="sub_total_compra" name="sub_total_compra" on class="form-control form-control-sm"  value="<?php //echo $lote->numero_lote?>" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Igv Compra</label>
                                        <select name="igv_compra" id="igv_compra" class="form-control form-control-sm" onchange="">
                                            <option value="">--Seleccionar--</option>
                                            <?php
                                            foreach ($igv_compra as $row){?>
                                                <option value="<?php echo $row->codigo ?>" <?php //if($row->codigo==$lote->id_producto)echo "selected='selected'"?>><?php echo $row->denominacion ?></option>
                                             <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Total Compra</label>
                                        <input id="total_compra" name="total_compra" on class="form-control form-control-sm"  value="<?php //echo $lote->numero_lote?>" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Cerrado</label>
                                        <select name="cerrado" id="cerrado" class="form-control form-control-sm" onchange="">
                                            <option value="">--Seleccionar--</option>
                                            <?php
                                            foreach ($cerrado_entrada as $row){?>
                                                <option value="<?php echo $row->codigo ?>" <?php if($row->codigo=='1')echo "selected='selected'"?>><?php echo $row->denominacion ?></option>
                                             <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Observaci&oacute;n</label>
                                        <input id="observacion" name="observacion" on class="form-control form-control-sm"  value="<?php //echo $lote->numero_lote?>" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div style="margin-top:15px" class="form-group">
                            <div class="col-sm-12 controls">
                                <div class="btn-group btn-group-sm float-right" role="group" aria-label="Log Viewer Actions">
                                    <a href="javascript:void(0)" onClick="modalDetalleProducto()" class="btn btn-sm btn-success">Registrar</a>
                                </div>
                                                    
                            </div>
                        </div> 
                            
                    </div>
                </form>
                </div>
                <!-- /.box -->
                
            </div>
            <!--/.col (left) -->

        </div>
        <!-- /.row -->
    
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

    
<script type="text/javascript">
$(document).ready(function () {

	$('#ruc_').blur(function () {
		var id = $('#id').val();
			if(id==0) {
				validaRuc(this.value);
			}
		//validaRuc(this.value);
	});
	
	
	
	
});


</script>

<script type="text/javascript">
$(document).ready(function() {
	//$('#numero_placa').focus();
	//$('#numero_placa').mask('AAA-000');
	//$('#vehiculo_numero_placa').mask('AAA-000');
	
	
});




</script>

