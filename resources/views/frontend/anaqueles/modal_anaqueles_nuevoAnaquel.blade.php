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
	max-width:30%!important
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


<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
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
	//$('#hora_solicitud').focus();
	//$('#hora_solicitud').mask('00:00');
	//$("#id_empresa").select2({ width: '100%' });
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

function obtenerProvincia(){
	
	var id = $('#departamento').val();
	if(id=="")return false;
	$('#provincia').attr("disabled",true);
	$('#distrito').attr("disabled",true);
	
	var msgLoader = "";
	msgLoader = "Procesando, espere un momento por favor";
	var heightBrowser = $(window).width()/2;
	$('.loader').css("opacity","0.8").css("height",heightBrowser).html("<div id='Grd1_wrapper' class='dataTables_wrapper'><div id='Grd1_processing' class='dataTables_processing panel-default'>"+msgLoader+"</div></div>");
    $('.loader').show();
	
	$.ajax({
		url: '/almacenes/obtener_provincia/'+id,
		dataType: "json",
		success: function(result){
			var option = "<option value='' selected='selected'>Seleccionar</option>";
			$('#provincia').html("");
			$(result).each(function (ii, oo) {
				option += "<option value='"+oo.id_provincia+"'>"+oo.desc_ubigeo+"</option>";
			});
			$('#provincia').html(option);
			
			var option2 = "<option value=''>Seleccionar</option>";
			$('#distrito').html(option2);
			
			$('#provincia').attr("disabled",false);
			$('#distrito').attr("disabled",false);
			
			$('.loader').hide();
		}
	});
}

function obtenerDistrito(){
	
	var id_departamento = $('#departamento').val();
	var id = $('#provincia').val();
	if(id=="")return false;
	$('#distrito').attr("disabled",true);
	
	var msgLoader = "";
	msgLoader = "Procesando, espere un momento por favor";
	var heightBrowser = $(window).width()/2;
	$('.loader').css("opacity","0.8").css("height",heightBrowser).html("<div id='Grd1_wrapper' class='dataTables_wrapper'><div id='Grd1_processing' class='dataTables_processing panel-default'>"+msgLoader+"</div></div>");
    $('.loader').show();
	
	$.ajax({
		url: '/almacenes/obtener_distrito/'+id_departamento+'/'+id,
		dataType: "json",
		success: function(result){
			var option = "<option value=''>Seleccionar</option>";
			$('#distrito').html("");
			$(result).each(function (ii, oo) {
				option += "<option value='"+oo.id_ubigeo+"'>"+oo.desc_ubigeo+"</option>";
			});
			$('#distrito').html(option);
			
			$('#distrito').attr("disabled",false);
			$('.loader').hide();
			
		}
		
	});
	
}

function obtenerDatosUbigeo(){

    var id = $('#id').val();

    $.ajax({
        url: '/almacenes/obtener_provincia_distrito/'+id,
        dataType: "json",
        success: function(result){
            
            //alert(result[0].provincia);

            $('#provincia').val(result[0].provincia);

            obtenerDistrito_(function(){

                $('#distrito').val(result[0].distrito);

            });
            
        }
        
    });

}

function obtenerDistrito_(callback){
		
    var departamento = $('#departamento').val();
    var id = $('#provincia').val();
    if(id=="")return false;
    $('#distrito').attr("disabled",true);
    
    var msgLoader = "";
    msgLoader = "Procesando, espere un momento por favor";
    var heightBrowser = $(window).width()/2;
    $('.loader').css("opacity","0.8").css("height",heightBrowser).html("<div id='Grd1_wrapper' class='dataTables_wrapper'><div id='Grd1_processing' class='dataTables_processing panel-default'>"+msgLoader+"</div></div>");
    $('.loader').show();
    
    $.ajax({
        url: '/almacenes/obtener_distrito/'+departamento+'/'+id,
        dataType: "json",
        success: function(result){
            var option = "<option value=''>Seleccionar</option>";
            $('#distrito').html("");
            $(result).each(function (ii, oo) {
                option += "<option value='"+oo.id_ubigeo+"'>"+oo.desc_ubigeo+"</option>";
            });
            $('#distrito').html(option);
            
            $('#distrito').attr("disabled",false);
            $('.loader').hide();

            callback();
        
        }
        
    });
}

function editarPuesto(id){

	$.ajax({
		url: '/concurso/obtener_puesto/'+id,
		dataType: "json",
		success: function(result){
			//alert(result);
			console.log(result);
			$('#id').val(result.id);
			$('#id_tipo_plaza').val(result.id_tipo_plaza);
			$('#numero_plazas').val(result.numero_plazas);
		}
		
	});

}

function eliminarPuesto(id){
	
    bootbox.confirm({ 
        size: "small",
        message: "&iquest;Deseas eliminar el Puesto?", 
        callback: function(result){
            if (result==true) {
                fn_eliminar_puesto(id);
            }
        }
    });
    //$(".modal-dialog").css("width","30%");
}

function fn_eliminar_puesto(id){
	
	$.ajax({
            url: "/concurso/eliminar_puesto/"+id,
            type: "GET",
            success: function (result) {
				datatablenewRequisito();
            }
    });
}


function validacion(){
    
    var msg = "";
    var cobservaciones=$("#frmComentar #cobservaciones").val();
    
    if(cobservaciones==""){msg+="Debe ingresar una Observacion <br>";}
    
    if(msg!=""){
        bootbox.alert(msg); 
        return false;
    }
}

function limpiar(){
	$('#id').val("0");
	$('#id_tipo_documento').val("");
	$('#denominacion').val("");
	$('#img_foto').val("");
}

function fn_save_anaquel(){
    
	var _token = $('#_token').val();
	var id = $('#id').val();
	var codigo = $('#codigo').val();
	var denominacion = $('#denominacion').val();
	
	$.ajax({
			url: "/anaqueles/send_anaquel",
            type: "POST",
            data : $("#frmAnaquel").serialize(),
			success: function (result) {
				$('#openOverlayOpc').modal('hide');
                window.location.reload();
				datatablenew();
				//limpiar();
								
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
				Registrar Anaqueles
			</div>
			
            <div class="card-body">
            <form method="post" action="#" id="frmAnaquel" name="frmAnaquel">

                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:5px;padding-bottom:20px">
                            
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
                            
                            
                            <div class="row" style="padding-left:10px">
                                
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Almacen</label>
                                        <select name="almacen" id="almacen" onChange="" class="form-control form-control-sm">
                                            <option value="">--Seleccionar--</option>
                                            <?php
                                            foreach ($almacen as $row) {?>
                                            <option value="<?php echo $row->id?>" <?php //if($row->id_almacen==$anaquel->id_almacen)echo "selected='selected'"?>><?php echo $row->codigo.'-'.$row->denominacion ?></option>
                                            <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding-left:10px">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Fila</label>
                                        <input id="fila" name="fila" on class="form-control form-control-sm"  value="<?php echo $anaquel->codigo?>" type="text">
                                    
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Sigla</label>
                                        <input id="sigla" name="sigla" on class="form-control form-control-sm"  value="<?php echo $anaquel->codigo?>" type="text">
                                    
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">C&oacute;digo</label>
                                        <input id="codigo" name="codigo" on class="form-control form-control-sm"  value="<?php echo $anaquel->codigo?>" type="text">
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="padding-left:10px">
                            
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Denominaci&oacute;n</label>
                                        <input id="denominacion" name="denominacion" on class="form-control form-control-sm"  value="<?php echo $anaquel->denominacion?>" type="text" >
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div style="margin-top:15px" class="form-group">
                            <div class="col-sm-12 controls">
                                <div class="btn-group btn-group-sm float-right" role="group" aria-label="Log Viewer Actions">
                                    <a href="javascript:void(0)" onClick="fn_save_anaquel()" class="btn btn-sm btn-success">Registrar</a>
                                </div>
                                                    
                            </div>
                        </div> 
                            
                    </div>
                    
                </div>
                <!-- /.box -->
                </form>
            </div>
            <!--/.col (left) -->

        </div>
        <!-- /.row -->
    </section>
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

