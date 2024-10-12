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
	max-width:60%!important
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
    $('select[name="anaquel[]"]').select2({ width: '100%' });
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
	 if($('#id').val()>0){
        cargarAnaqueles();
     }
});

function cargarAnaqueles(){

var id = $("#id").val();
const contenedorAnaqueles = $('#contenedor-anaqueles');
contenedorAnaqueles.empty();

$.ajax({
    url: "/secciones/cargar_anaqueles/"+id,
    type: "GET",
    success: function (result) {

        let n = 1;
        let almacenAnaqueles = @json($anaquel);

        result.forEach(anaqueles_secciones => {
            let anaquelOptions = '<option value="">--Seleccionar--</option>';
            
            almacenAnaqueles.forEach(almacenAnaquel => {
                let selected = (anaqueles_secciones.id_anaqueles == almacenAnaquel.id) ? 'selected' : '';
                anaquelOptions += `<option value="${anaqueles_secciones.id}" ${selected}>${almacenAnaquel.denominacion}</option>`;
            });

            const row = `<div class="col-lg-3 anaqueles-grupo">\
                <div class="form-group">\
                    <label class="control-label form-control-sm">Anaqueles</label>\
                    <select name="anaquel[]" id="anaquel${n}" class="form-control form-control-sm">\
                        ${anaquelOptions}\
                    </select>\
                </div>\
            </div>`;
            
            contenedorAnaqueles.append(row);
            n++;
        });
    }
});
}

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
            if(result.length>0){
                $(result).each(function (ii, oo) {
                    option += "<option value='"+oo.id+"'>"+oo.denominacion+"</option>";
                });

                $('select[name="anaquel[]"]').each(function() {
                    if ($(this).children().length <= 1){
                        $(this).empty();
                        $(this).html(option);
                        $(this).attr("disabled", false);
                    }
                    
                });
            }else {
                // Si no hay resultados, vacía el select y muestra solo la opción "Seleccionar"
                $('select[name="anaquel[]"]').each(function() {
                    $(this).empty(); // Vacía las opciones anteriores
                    $(this).html(option); // Muestra solo la opción "Seleccionar"
                    $(this).attr("disabled", false); // Habilita el select
                });
            }
			
			
			//$('#anaquel').attr("disabled",false);
			//$('.loader').hide();
			

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

function fn_save_seccion(){
    
	var _token = $('#_token').val();
	var id = $('#id').val();
	var codigo = $('#codigo').val();
	var denominacion = $('#denominacion').val();
	var distrito = $('#distrito').val();
	var direccion = $('#direccion').val();
    var encargado = $('#encargado').val();
    var usuario = $('#usuario').val();
    var telefono = $('#telefono').val();
	
	$.ajax({
			url: "/secciones/send_seccion",
            type: "POST",
            data : $("#frmSeccion").serialize(),
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
                    Registrar Secciones
                </div>
                
                <div class="card-body">
                <form method="post" action="#" id="frmSeccion" name="frmSeccion">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:5px;padding-bottom:20px">
                                
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" id="id" value="<?php echo $id?>">
                            
                            
                            <div class="row" style="padding-left:10px">
                                
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Almacen</label>
                                        <select name="almacen" id="almacen" class="form-control form-control-sm" onchange="obtenerAnaquel()">
                                            <option value="">--Seleccionar--</option>
                                            <?php
                                            foreach ($almacen as $row){?>
                                                <option value="<?php echo $row->id ?>" <?php if ($id > 0 && $row->id == $almacen_seccion->id_almacenes) echo "selected='selected'"; ?>><?php echo $row->codigo . '-' . $row->denominacion ?></option>
                                             <?php 
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">C&oacute;digo</label>
                                        <input id="codigo" name="codigo" on class="form-control form-control-sm"  value="<?php if($id>0){echo $seccion->codigo;}else{echo $codigo[0]->codigo;}?>" type="text" readonly="readonly">
                                    
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Denominaci&oacute;n</label>
                                        <input id="denominacion" name="denominacion" on class="form-control form-control-sm"  value="<?php echo $seccion->denominacion?>" type="text" >
                                    
                                    </div>
                                </div>
                            </div>
                            <!--<div class="row" style="padding-left:10px">-->
                            <div id="contenedor-anaqueles" class="row" style="padding-left:10px">
                                <div class="col-lg-3 anaqueles-grupo">
                                    <div class="form-group">
                                        <label class="control-label form-control-sm">Anaqueles</label>
                                        <select name="anaquel[]" id="anaquel" class="form-control form-control-sm">
                                            <option value="">--Seleccionar--</option>
                                            <?php //foreach ($anaquel as $row) { ?>
                                            <!--<option value="<?php //echo $row->id?>"><?php //echo $row->denominacion ?></option>-->
                                            <?php //} ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                                <div style="margin-top:37px" class="form-group">
                                    <div class="col-sm-12 controls">
                                        <div class="btn-group btn-group-sm float-right" role="group" aria-label="Log Viewer Actions">
                                            <a href="javascript:void(0)" onClick="AddFila()" class="btn btn-sm btn-success">Agregar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top:15px" class="form-group">
                            <div class="col-sm-12 controls">
                                <div class="btn-group btn-group-sm float-right" role="group" aria-label="Log Viewer Actions">
                                    <a href="javascript:void(0)" onClick="fn_save_seccion()" class="btn btn-sm btn-success">Registrar</a>
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

