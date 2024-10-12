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

    $('#fecha_vencimiento').datepicker({
        autoclose: true,
		format: 'yyyy-mm-dd',
		changeMonth: true,
		changeYear: true,
        language: 'es'
    });

    $("#unidad_producto").select2({ width: '100%' });

    $("#unidad_medida").select2({ width: '100%' });

    $("#marca").select2({ width: '100%' });

    $("#tipo_producto").select2({ width: '100%' });
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

function AddFila(){
    // Crear un nuevo div para el grupo de usuario
    var newDiv = document.createElement('div');
    newDiv.className = 'col-lg-3 anaqueles-grupo';
    
    // Crear el HTML interno del nuevo div
    newDiv.innerHTML = `
        <div class="form-group">
            <label class="control-label form-control-sm">Anaqueles</label>
            <select name="anaquel[]" id="anaquel" class="form-control form-control-sm">
                <option value="">--Seleccionar--</option>
            </select>
        </div>`;
        
    
    // Agregar el nuevo div al contenedor
    document.getElementById('contenedor-anaqueles').appendChild(newDiv);

    $(newDiv).find('select[name="anaquel[]"]').select2({ width: '100%' });
    
    obtenerAnaquel();
}

function obtenerAnaquel(){

    var id_almacen = $('#almacen').val();

    $.ajax({
		url: '/anaqueles/obtener_anaquel/'+id_almacen,
		dataType: "json",
		success: function(result){
			
            var option = "<option value=''>--Seleccionar--</option>";
			//$('#anaquel').html("");
			$(result).each(function (ii, oo) {
				option += "<option value='"+oo.id+"'>"+oo.denominacion+"</option>";
			});
			$('select[name="anaquel[]"]').each(function() {
                if ($(this).children().length <= 1){
                    $(this).html(option);
                    $(this).attr("disabled", false);
                }
                
            });
			//$('#anaquel').attr("disabled",false);
			//$('.loader').hide();
			

		}
		
	});

}

function limpiar(){
	$('#id').val("0");
	$('#id_tipo_documento').val("");
	$('#denominacion').val("");
	$('#img_foto').val("");
}

function fn_save_producto(){
	
	$.ajax({
			url: "/productos/send_producto",
            type: "POST",
            data : $("#frmProducto").serialize(),
			success: function (result) {
				//alert(result);
            if (result.success) {
                bootbox.alert(result.success, function() {
                    $('#openOverlayOpc').modal('hide');
                    window.location.reload();
                });
            } else if (result.error) {
                bootbox.alert(result.error);
            }
            },
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
                    Registrar un producto
                </div>
                
                <div class="card-body">
                <form method="post" action="#" id="frmProducto" name="frmProducto">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:5px;padding-bottom:20px">
                                
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
                            
                            
                            <div class="row" style="padding-left:10px">
                                
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">N&uacute;mero Serie</label>
                                        <input id="numero_serie" name="numero_serie" on class="form-control form-control-sm"  value="<?php echo $producto->numero_serie?>" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Denominaci&oacute;n</label>
                                        <input id="denominacion" name="denominacion" on class="form-control form-control-sm"  value="<?php echo $producto->denominacion?>" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">C&oacute;digo</label>
                                        <input id="codigo" name="codigo" on class="form-control form-control-sm"  value="<?php echo $producto->codigo?>" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Unidad Producto</label>
                                        <select name="unidad_producto" id="unidad_producto" class="form-control form-control-sm" onchange="">
                                            <option value="">--Seleccionar--</option>
                                            <?php
                                            foreach ($unidad_producto as $row){?>
                                                <option value="<?php echo $row->codigo ?>" <?php if($row->codigo==$producto->id_unidad_producto)echo "selected='selected'"?>><?php echo $row->denominacion ?></option>
                                             <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Contenido</label>
                                        <input id="contenido" name="contenido" on class="form-control form-control-sm"  value="<?php echo $producto->contenido?>" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Unidad Medida</label>
                                        <select name="unidad_medida" id="unidad_medida" class="form-control form-control-sm" onchange="">
                                            <option value="">--Seleccionar--</option>
                                            <?php
                                            foreach ($unidad_medida as $row){?>
                                                <option value="<?php echo $row->codigo ?>" <?php if($row->codigo==$producto->id_unidad_medida)echo "selected='selected'"?>><?php echo $row->denominacion ?></option>
                                             <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Marca</label>
                                        <select name="marca" id="marca" class="form-control form-control-sm" onchange="">
                                            <option value="">--Seleccionar--</option>
                                            <?php
                                            foreach ($marca as $row){?>
                                                <option value="<?php echo $row->id ?>" <?php if($row->id==$producto->id_marca)echo "selected='selected'"?>><?php echo $row->denominiacion ?></option>
                                             <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Tipo Producto</label>
                                        <select name="tipo_producto" id="tipo_producto" class="form-control form-control-sm" onchange="">
                                            <option value="">--Seleccionar--</option>
                                            <?php
                                            foreach ($tipo_producto as $row){?>
                                                <option value="<?php echo $row->codigo ?>" <?php if($row->codigo==$producto->id_tipo_producto)echo "selected='selected'"?>><?php echo $row->denominacion ?></option>
                                             <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Estado Bien</label>
                                        <select name="estado_bien" id="estado_bien" class="form-control form-control-sm" onchange="">
                                            <option value="">--Seleccionar--</option>
                                            <?php
                                            foreach ($estado_bien as $row){?>
                                                <option value="<?php echo $row->codigo ?>" <?php if($row->codigo==$producto->id_estado_bien)echo "selected='selected'"?>><?php echo $row->denominacion ?></option>
                                             <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Stock Actual</label>
                                        <input id="stock_actual" name="stock_actual" on class="form-control form-control-sm"  value="<?php echo $producto->stock_actual?>" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Costo Unitario</label>
                                        <input id="costo_unitario" name="costo_unitario" on class="form-control form-control-sm"  value="<?php echo $producto->costo_unitario?>" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Moneda</label>
                                        <select name="moneda" id="moneda" class="form-control form-control-sm" onchange="">
                                            <option value="">--Seleccionar--</option>
                                            <?php
                                            foreach ($moneda as $row){?>
                                                <option value="<?php echo $row->codigo ?>" <?php if($row->codigo==$producto->id_moneda)echo "selected='selected'"?>><?php echo $row->denominacion ?></option>
                                             <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Fecha Vencimiento</label>
                                        <input id="fecha_vencimiento" name="fecha_vencimiento" on class="form-control form-control-sm"  value="<?php echo $producto->fecha_vencimiento?>" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Stock M&iacute;nimo</label>
                                        <input id="stock_minimo" name="stock_minimo" on class="form-control form-control-sm"  value="<?php echo $producto->stock_minimo?>" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div style="margin-top:15px" class="form-group">
                            <div class="col-sm-12 controls">
                                <div class="btn-group btn-group-sm float-right" role="group" aria-label="Log Viewer Actions">
                                    <a href="javascript:void(0)" onClick="fn_save_producto()" class="btn btn-sm btn-success">Registrar</a>
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

