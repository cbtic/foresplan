<title>Sistema de Felmo</title>

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

function validacion(){
    
    var msg = "";
    var cobservaciones=$("#frmComentar #cobservaciones").val();
    
    if(cobservaciones==""){msg+="Debe ingresar una Observacion <br>";}
    
    if(msg!=""){
        bootbox.alert(msg); 
        return false;
    }
}

function guardarCita__(){
	alert("fdssf");
}

function guardarCita(id_medico,fecha_cita){
    
    var msg = "";
    var id_ipress = $('#id_ipress').val();
    var id_consultorio = $('#id_consultorio').val();
    var fecha_atencion = $('#fecha_atencion').val();
    var dni_beneficiario = $("#dni_beneficiario").val();
	//alert(id_ipress);
	if(dni_beneficiario == "")msg += "Debe ingresar el numero de documento <br>";
    if(id_ipress==""){msg+="Debe ingresar una Ipress<br>";}
    if(id_consultorio==""){msg+="Debe ingresar un Consultorio<br>";}
    if(fecha_atencion==""){msg+="Debe ingresar una fecha de atencion<br>";}
   
    if(msg!=""){
        bootbox.alert(msg); 
        return false;
    }
    else{
        fn_save_cita(id_medico,fecha_cita);
    }
}

function validaDni() {

	var dni = $("#numero_documento_").val();
	var msg = "";
	
	/*
	if (msg != "") {
		bootbox.alert(msg);
		return false;
	}

	if (tipo_documento == "0" || numero_documento == "") {
		bootbox.alert(msg);
		return false;
	}
	*/
	
	var settings = {
		"url": "https://apiperu.dev/api/dni/" + dni,
		"method": "GET",
		"timeout": 0,
		"headers": {
			"Authorization": "Bearer 20b6666ddda099db4204cf53854f8ca04d950a4eead89029e77999b0726181cb"
		},
	};

	$.ajax(settings).done(function(response) {
		console.log(response);

		if (response.success == true) {

			var data = response.data;

			$('#apellido_paterno_').val('')
			$('#apellido_materno_').val('')
			$('#nombre').val('')

			$('#apellido_paterno_').val(data.apellido_paterno);
			$('#apellido_materno_').val(data.apellido_materno);
			$('#nombres_').val(data.nombres);
			$("#id_persona_").val(0);
			//alert(data.nombre_o_razon_social);

		} else {
			Swal.fire("DNI Inv&aacute;lido. Revise el DNI digitado!");
			return false;
		}

	});
}

function fn_save(){
    
	var _token = $('#_token').val();
	var id  = $('#id').val();
	var id_personas = $('#id_persona_').val();
	var licencia = $('#licencia').val();
	var apellido_paterno = $('#apellido_paterno_').val();
	var apellido_materno = $('#apellido_materno_').val();
	var nombres = $('#nombres_').val();
	var id_tipo_documento = $('#tipo_documento_').val();
	var numero_documento = $('#numero_documento_').val();
	
    $.ajax({
			url: "/conductores/send_conductor_ingreso",
            type: "POST",
            data : {_token:_token,id:id,id_personas:id_personas,licencia:licencia,apellido_paterno:apellido_paterno,apellido_materno:apellido_materno,nombres:nombres,id_tipo_documento:id_tipo_documento,numero_documento:numero_documento},
			dataType: 'json',
            success: function (result) {
				
				if(result.sw==false){
					bootbox.alert(result.msg);
					
					var conductor = result.conductor;
					var persona = result.persona;
					var nombre_conductor = persona.apellido_paterno+" "+persona.apellido_materno+" "+persona.nombres;
					$("#id_conductores").val(conductor.id);
					$("#frmIngreso #numero_documento").val(persona.numero_documento);
					$("#frmIngreso #conductor").val(nombre_conductor);
					
				}else{
					
					var conductor = result.conductor;
					var persona = result.persona;
					var nombre_conductor = persona.apellido_paterno+" "+persona.apellido_materno+" "+persona.nombres;
					$("#id_conductores").val(conductor.id);
					$("#frmIngreso #numero_documento").val(persona.numero_documento);
					$("#frmIngreso #conductor").val(nombre_conductor);
					
				}
				
				$('#openOverlayOpc').modal('hide');
				//datatablenew();
				
            }
    });
}

function fn_liberar(id){
    
	//var id_estacionamiento = $('#id_estacionamiento').val();
	var _token = $('#_token').val();
	
    $.ajax({
			url: "/estacionamiento/liberar_asignacion_estacionamiento_vehiculo",
            type: "POST",
            data : {_token:_token,id:id},
            success: function (result) {
				$('#openOverlayOpc').modal('hide');
				cargarAsignarEstacionamiento();
            }
    });
}


function validarLiquidacion() {
	
	var msg = "";
	var sw = true;
	
	var saldo_liquidado = $('#saldo_liquidado').val();
	var estado = $('#estado').val();
	
	if(saldo_liquidado == "")msg += "Debe ingresar un saldo liquidado <br>";
	if(estado == "")msg += "Debe ingresar una observacion <br>";
	
	if(msg!=""){
		bootbox.alert(msg);
		//return false;
	} else {
		//submitFrm();
		document.frmLiquidacion.submit();
	}
	return false;
}


function obtenerVehiculo(id,obj){
	
	//$("#tblPlan tbody text-white").attr('class','bg-primary text-white');
	if(obj!=undefined){
		$("#tblSinReservaEstacionamiento tbody tr").each(function (ii, oo) {
			var clase = $(this).attr("clase");
			$(this).attr('class',clase);
		});
		
		$(obj).attr('class','bg-success text-white');
	}
	//$('#tblPlanDetalle tbody').html("");
	$('#id_empresa').val(id);
	var id_estacionamiento = $('#id_estacionamiento').val();
	$.ajax({
		url: '/estacionamiento/obtener_vehiculo/'+id+'/'+id_estacionamiento,
		dataType: "json",
		success: function(result){
			
			var newRow = "";
			$('#tblPlanDetalle').dataTable().fnDestroy(); //la destruimos
			$('#tblPlanDetalle tbody').html("");
			$(result).each(function (ii, oo) {
				newRow += "<tr class='normal'><td>"+oo.placa+"</td>";
				newRow += '<td class="text-left" style="padding:0px!important;margin:0px!important">';
				newRow += '<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">';
				newRow += '<a href="javascript:void(0)" onClick=fn_save("'+oo.id_vehiculo+'") class="btn btn-sm btn-normal">';
				newRow += '<i class="fa fa-2x fa-check" style="color:green"></i></a></a></div></td></tr>';
			});
			$('#tblPlanDetalle tbody').html(newRow);
			
			$('#tblPlanDetalle').DataTable({
				//"sPaginationType": "full_numbers",
				"paging":false,
				"dom": '<"top">rt<"bottom"flpi><"clear">',
				"language": {"url": "/js/Spanish.json"},
			});
			
			$("#system-search2").keyup(function() {
				var dataTable = $('#tblPlanDetalle').dataTable();
			   dataTable.fnFilter(this.value);
			});
			
		}
		
	});
	
}

/*
$('#fecha_solicitud').datepicker({
	autoclose: true,
	dateFormat: 'dd-mm-yy',
	changeMonth: true,
	changeYear: true,
	container: '#openOverlayOpc modal-body'
});
*/
/*
$('#fecha_solicitud').datepicker({
	format: "dd/mm/yyyy",
	startDate: "01-01-2015",
	endDate: "01-01-2020",
	todayBtn: "linked",
	autoclose: true,
	todayHighlight: true,
	container: '#openOverlayOpc modal-body'
});
*/

/*				
format: "dd/mm/yyyy",
startDate: "01-01-2015",
endDate: "01-01-2020",
todayBtn: "linked",
autoclose: true,
todayHighlight: true,
container: '#myModal modal-body'
*/	
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
				Edici&oacute;n Conductor
			</div>
			
            <div class="card-body">

			<div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:10px">
					
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id" id="id" value="<?php echo $id?>">
					<input type="hidden" name="id_persona_" id="id_persona_" value="">
					
					
					<div class="row">
						
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label">Nro Brevete</label>
								<input id="licencia" name="licencia" class="form-control form-control-sm"  value="<?php echo $conductor->licencia?>" type="text" >
							</div>
						</div>
						
					</div>
					
					<div class="row">
						
						<?php 
							$readonly=$id>0?"readonly='readonly'":'';
							$readonly_=$id>0?'':"readonly='readonly'";
						?>
						
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label">Tipo de Documento</label>
								<select name="tipo_documento_" id="tipo_documento_" class="form-control form-control-sm" onChange="">
									<option value="">--Selecionar--</option>
									<?php
									foreach ($tipo_documento as $row) { ?>
										<option value="<?php echo $row->codigo ?>" <?php //if ($row->codigo == $persona->id_tipo_documento) echo "selected='selected'" ?>><?php echo $row->denominacion ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>
						
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label">Numero de Documento</label>
								<input id="numero_documento_" name="numero_documento_" class="form-control form-control-sm"  value="<?php //echo $conductor->ruc?>" type="text" <?php echo $readonly?> >
							</div>
						</div>
						
					</div>
					
					<div class="row">
						
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label">Apellido Paterno</label>
								<input id="apellido_paterno_" name="apellido_paterno_" class="form-control form-control-sm"  value="<?php //echo $conductor->razon_social?>" type="text" readonly>
							</div>
						</div>
						
					</div>
					
					<div class="row">
						
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label">Apellido Materno</label>
								<input id="apellido_materno_" name="apellido_materno_" class="form-control form-control-sm"  value="<?php //echo $conductor->razon_social?>" type="text" readonly>
							</div>
						</div>
						
					</div>
					
					<div class="row">
						
						<div class="col-lg-12">
							<div class="form-group">
								<label class="control-label">Nombres</label>
								<input id="nombres_" name="nombres_" class="form-control form-control-sm"  value="<?php echo $conductor->nombres?>" type="text" readonly>
							</div>
						</div>
						
					</div>
					
					<div style="margin-top:10px" class="form-group">
						<div class="col-sm-12 controls">
							<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">
								<a href="javascript:void(0)" onClick="fn_save()" class="btn btn-sm btn-success">Guardar</a>
							</div>
												
						</div>
					</div> 
					
              </div>
			  
              
          </div>
          <!-- /.box -->
          

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
	
	$('#numero_documento_').blur(function () {
		/*
		var id = $('#id').val();
			if(id==0) {
				validaRuc(this.value);
			}
		*/
		//validaRuc(this.value);
		var tipo_documento = $("#tipo_documento_").val();
		var numero_documento = $("#numero_documento_").val();
		obtenerPersona(tipo_documento, numero_documento);
		
	});
	
	
});

function obtenerPersona(tipo_documento, numero_documento){

	$.ajax({
		//url: '/pesaje/obtener_datos_choferes/' + empresa_id,
		url: '/persona/obtener_persona/' + tipo_documento + '/' + numero_documento,
		dataType: "json",
		success: function(result){
			
			var persona = result.persona;
			if(persona==null){
				validaDni();
				return false;
			}
			$("#apellido_paterno_").val(persona.apellido_paterno);
			$("#apellido_materno_").val(persona.apellido_paterno);
			$("#nombres_").val(persona.nombres);
			$("#id_persona_").val(persona.id);
		}
		
	});
}

function validaRuc(ruc){
	var settings = {
		"url": "https://apiperu.dev/api/ruc/"+ruc,
		"method": "GET",
		"timeout": 0,
		"headers": {
		  "Authorization": "Bearer 20b6666ddda099db4204cf53854f8ca04d950a4eead89029e77999b0726181cb"
		},
	  };
	  
	  $.ajax(settings).done(function (response) {
		console.log(response);
		
		if (response.success == true){

			var data= response.data;

			$('#razon_social_').val('')
			$('#direccion_').val('')
			$('#telefono_').val('')
			$('#email_').val('')

			$('#razon_social_').val(data.nombre_o_razon_social);
			//$('#direccion_').attr('readonly', true);

			if (typeof data.direccion_completa != "undefined"){
				$('#direccion_').val(data.direccion_completa);
			}
			else{
				$('#direccion_').attr('readonly', false);
			}
			

			//alert(data.nombre_o_razon_social);

		}
		else{
			bootbox.alert("RUC Invalido,... revise el RUC digitado ¡");
			return false;
		}

		
	  });
}

</script>

<script type="text/javascript">
$(document).ready(function() {
	//$('#numero_placa').focus();
	//$('#numero_placa').mask('AAA-000');
	//$('#vehiculo_numero_placa').mask('AAA-000');
	
	$('#vehiculo_numero_placa').keyup(function() {
		this.value = this.value.toLocaleUpperCase();
	});
	
	$('#vehiculo_empresa').keyup(function() {
		this.value = this.value.toLocaleUpperCase();
	});
		
	$('#vehiculo_empresa').focusin(function() { $('#vehiculo_empresa').select(); });
	
	$('#vehiculo_empresa').autocomplete({
		appendTo: "#vehiculo_empresa_busqueda",
		source: function(request, response) {
			$.ajax({
			url: '/pesaje/list/'+$('#vehiculo_empresa').val(),
			dataType: "json",
			success: function(data){
			   var resp = $.map(data,function(obj){
					var hash = {key: obj.id, value: obj.razon_social, ruc: obj.ruc};
					//if(obj.razon_social=='') { actualiza_ruc("") }
					return hash;
			   }); 
			   response(resp);
			},
			error: function() {
				//actualiza_ruc("");
			}
		});
		},
		select: function (event, ui) {
			$('#vehiculo_empresa').blur();
			$('#ruc').val(ui.item.ruc);
			//if (ui.item.value != ''){
			//actualiza_ruc(ui.item.value);
			//}
			obtener_vehiculos(ui.item.key);
			$("#id_empresa").val(ui.item.key); // save selected id to hidden input
		},
			minLength: 2,
			delay: 100
	  });
	  
	
	$('#modalVehiculoSaveBtn').click(function (e) {
		e.preventDefault();
		$(this).html('Enviando datos..');
	
		$.ajax({
		  data: $('#modalVehiculoForm').serialize(),
		  url: "/vehiculo/send_ajax_asignar",
		  type: "POST",
		  dataType: 'json',
		  success: function (data) {
	
			  $('#modalVehiculoForm').trigger("reset");
			  //$('#vehiculoModal').modal('hide');
			  $('#openOverlayOpc').modal('hide');

        alert(data.msg);
        $("#nombre_empresa").val(data.vehiculo_empresa);
        $("#numero_placa").val(data.vehiculo_numero_placa);
        $("#numero_ejes").val(data.ejes);
        $("#numero_documento").val(data.ruc);
        $("#nombres_razon_social").val(data.razon_social);
        $("#empresa_direccion").val(data.direccion);

        $("#modalVehiculoSaveBtn").html("Grabar");
	
		  },
		  error: function(data) {
        mensaje = "Revisar el formulario:\n\n";
        $.each( data["responseJSON"].errors, function( key, value ) {
          mensaje += value +"\n";
        });
        $("#modalVehiculoSaveBtn").html("Grabar");
        alert(mensaje);
      }
	  });
	});	  
	
});

function actualiza_ruc(razon_social) {
	$.ajax({
		url: '/pesaje/obtener_ruc/'+razon_social,
		dataType: 'json',
		type: 'GET',
		success: function(result){
			//alert(result);
			$('#ruc').val(result);
		},
		error: function(){
			$('#ruc').val('');
		}

	});
}


function obtener_vehiculos(id){
	
	option = {
		url: '/pesaje/obtener_vehiculo_empresa/' + id,
		type: 'GET',
		dataType: 'json',
		data: {}
	};
	$.ajax(option).done(function (data) {
		
		var option = "<option value='0'>Seleccionar</option>";
		$("#id_vehiculo").html("");
		$(data).each(function (ii, oo) {
			option += "<option value='"+oo.id+"'>"+oo.placa+"</option>";
		});
		$("#id_vehiculo").html(option);
		$("#id_vehiculo").val(id).select2();
		
		/*
		var cantidad = data.cantidad;
		var cantidadEstablecimiento = data.cantidadEstablecimiento;
		var cantidadAlmacen = data.cantidadAlmacen;
		$(cmb).closest("tr").find(".limpia_text").val("");                
		$(cmb).closest("tr").find("#nro_stocks").val(cantidad);
		$(cmb).closest("tr").find("#nro_stocks_establecimiento").val(cantidadEstablecimiento);
		$(cmb).closest("tr").find("#nro_stocks_almacen").val(cantidadAlmacen);
		$(cmb).closest("tr").find("#nro_med_solictados").val("");  
		$(cmb).closest("tr").find("#nro_med_entregados").val("");
		$(cmb).closest("tr").find("#lotes_lote").val("");
		$(cmb).closest("tr").find("#lotes_cantidad").val("");
		$(cmb).closest("tr").find("#lotes_registro_sanitario").val("");
		$(cmb).closest("tr").find("#lotes_fecha_vencimiento").val("");
		*/
	});
	
		
}
</script>

