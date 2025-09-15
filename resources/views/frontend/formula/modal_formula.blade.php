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
	max-width:50%!important
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
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
	$('#hora_solicitud').mask('00:00');
	//$("#id_empresa").select2({ width: '100%' });
});
</script>

<script type="text/javascript">

$('#openOverlayOpc').on('shown.bs.modal', function() {
     $('#fecha_solicitudxx').datepicker({
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
		obtenerSubPlanilla();
	}

	
	$("#concepto_").select2({ width: '100%' });

});

function fn_save(){  
	
	var msg = "";
	

	var id_tipo_planilla = $('#id_tipo_planilla_').val();
	var sub_tipo_planilla = $('#sub_tipo_planilla_').val();
	var concepto = $('#concepto_').val();
	var formula = $('#formula_').val();

	if(id_tipo_planilla == "0")msg += "Debe ingresar el Tipo de Planilla <br>";
	if(sub_tipo_planilla == "0"){msg += "Debe ingresar el Sub Tipo de Planilla <br>";}
	if(concepto == "0"){msg += "Debe ingresar el Concepto <br>";}
	if(formula == ""){msg+="Debe ingresar la Formula <br>";} 

	if(msg!=""){
        bootbox.alert(msg); 
        return false;
    }
    else{
		$.ajax({
				url: "/formula/send_formula",
				type: "POST",
				data : $('#frmFormula').serialize(),
				success: function (result) {
					$('#openOverlayOpc').modal('hide');
					datatablenew();
				}
		});
	}
}

function obtenerSubPlanilla(){
	
	var id = $('#id_tipo_planilla_').val();
	if(id=="")return false;
	
	var msgLoader = "";
	msgLoader = "Procesando, espere un momento por favor";
	var heightBrowser = $(window).width()/2;
	$('.loader').css("opacity","0.8").css("height",heightBrowser).html("<div id='Grd1_wrapper' class='dataTables_wrapper'><div id='Grd1_processing' class='dataTables_processing panel-default'>"+msgLoader+"</div></div>");
    $('.loader').show();
	
	$.ajax({
		url: '/planilla/obtener_sub_planilla/'+id,
		dataType: "json",
		success: function(result){
			var preselectedId = "<?php echo $formula->id_subplanilla; ?>";
			var option = "<option value='0'>Seleccionar</option>";
			$('#sub_tipo_planilla_').html("");
			$(result).each(function (ii, oo) {
				var selected = (oo.id == preselectedId) ? "selected='selected'" : "";
				option += "<option value='" + oo.id + "' " + selected + ">" + oo.denominacion + "</option>";
			});
			$('#sub_tipo_planilla_').html(option);
			//$('#id_subplanilla').select2();
			
			$('#sub_tipo_planilla_').attr("disabled",false);
			$('.loader').hide();
			
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
					Edici&oacute;n de Formulas
				</div>
				
				<div class="card-body">
					<form method="post" action="#" id="frmFormula" name="frmFormula">
						<div id="general" class="tab-pane fade in active" style="opacity:100">

							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="id" id="id" value="<?php echo $id?>">
						
							<div class="row">
								<div class="col-lg-2">
									<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
										<label class="control-label">Tipo Planilla</label>
										<select name="id_tipo_planilla_" id="id_tipo_planilla_" class="form-control form-control-sm" onchange="obtenerSubPlanilla()">
												<option value="0">Seleccionar</option>
												<?php foreach($tipPlanilla as $row):?>
													<option value="{{ $row->id }}" {{ $row->id == $formula->id_planilla ? 'selected' : '' }}>{{ $row->denominacion }}</option>
												<?php  endforeach;?>
										</select>
										@error('id_tipo_planilla_') <span ...>Dato requerido</span> @enderror
									</div>
								</div>

								<div class="col-lg-4">
									<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
										<label class="control-label">Sub Planilla</label>
										<select name="sub_tipo_planilla_" id="sub_tipo_planilla_" class="form-control form-control-sm">
												<option value="0">Seleccionar</option>
										</select>
										@error('sub_tipo_planilla_') <span ...>Dato requerido</span> @enderror
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
										<label class="control-label">Concepto</label>
										<select name="concepto_" id="concepto_" class="form-control form-control-sm">
												<option value="0">Seleccionar</option>
												<?php foreach($concepto as $row):?>
													<option value="{{ $row->id }}" {{ $row->id == $formula->id_concepto ? 'selected' : '' }} >{{ $row->denominacion }}</option>
												<?php  endforeach;?>
										</select>
										@error('concepto_') <span ...>Dato requerido</span> @enderror
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-10">
									<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
										<label class="control-label">Formula</label>
										<textarea id="formula_" name="formula_" class="form-control form-control-sm">{{ $formula->formula_for }}</textarea>
										@error('formula_') <span ...>Dato requerido</span> @enderror
									</div>
								</div>
								<div class="col-lg-2">
									<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
										<label class="control-label">Orden</label>
										<input id="orden_" name="orden_" class="form-control form-control-sm" value="{{ $formula->orden }}" type="text" >
										@error('orden_') <span ...>Dato requerido</span> @enderror
									</div>
								</div>
							</div>
											
							<div style="margin-top:10px;float:right" class="form-group">
								<div class="col-sm-12 controls">
									<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">
										<a href="javascript:void(0)" onClick="fn_save()" class="btn btn-sm btn-success">Guardar</a>
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
    </div>
    <!-- /.content-wrapper -->
</body>   

<!--
<script type="text/javascript">
$(document).ready(function () {	
	$('#tblReservaEstacionamiento').DataTable({
		"dom": '<"top">rt<"bottom"flpi><"clear">'
		});
	$("#system-search").keyup(function() {
		var dataTable = $('#tblReservaEstacionamiento').dataTable();
		dataTable.fnFilter(this.value);
	}); 
	
	$('#tblReservaEstacionamientoPreferente').DataTable({
		"dom": '<"top">rt<"bottom"flpi><"clear">'
		});
	$("#system-searchp").keyup(function() {
		var dataTable = $('#tblReservaEstacionamientoPreferente').dataTable();
		dataTable.fnFilter(this.value);
	});
	
	$('#tblSinReservaEstacionamiento').DataTable({
		"dom": '<"top">rt<"bottom"flpi><"clear">'
		});
	$("#system-search2").keyup(function() {
		var dataTable = $('#tblSinReservaEstacionamiento').dataTable();
		dataTable.fnFilter(this.value);
	}); 
	
	
});

</script>

-->

<script type="text/javascript">
$(document).ready(function() {
	
	//$('#txtIdUbiDepar').select2();
	//$('#txtIdUbiProv').select2();
	//$('#ubigeodireccionprincipal').select2();
	
	$('#telefono_').mask("900000000");

/*
	
	$("#id_especie").select2({ width: '100%' });
	
	$('#numero_placa').focus();
	$('#numero_placa').mask('AAA-000');
	$('#vehiculo_numero_placa').mask('AAA-000');
	
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
	*/
	
});



function obtenerBeneficiario(){
		
		var tipo_documento = $("#tipo_documento_").val();
		var numero_documento = $("#numero_documento_").val();
		var msg = "";

		//alert(tipo_documento);
		//alert(numero_documento);
		//exit();
		
		if (msg != "") {
			bootbox.alert(msg);
			return false;
		}

		if (tipo_documento == "0" || numero_documento == "") {
			bootbox.alert(msg);
			return false;
		}

		
		$.ajax({
			url: '/persona/buscar_persona/' + tipo_documento + '/' + numero_documento,
			dataType: "json",
			success: function(result){
				
				if(result.sw==2){
					bootbox.alert("No es colaborador de Felmo, los datos han sido obtenidos de Reniec");
					//$('#telefono').attr("disabled",false);
					//$('#email').attr("disabled",false);
				}
				if(result.sw==3){
					bootbox.alert("El numero de documento no se encontro en Felmo ni en Reniec");
					//$('#numero_documento').val("");
					
					/*
					$('#numero_documento').attr("disabled",false);
					$('#nombres').attr("disabled",false).attr("placeholder","Ingrese Nombres");
					
					$('#divApellidoP').show();
					$('#divApellidoM').show();
					
					$('#apellidop').attr("placeholder","Apellido Paterno");
					$('#apellidom').attr("placeholder","Apellido Materno");
					
					$('#telefono').attr("disabled",false);
					$('#email').attr("disabled",false);
					*/
					return false;
				}
				

				var persona = result.persona;
				var persona_detalle = result.persona_detalle;
				//bootbox.alert("Datos recuperados ->" + persona.apellido_materno);
				
				var nombre = persona.apellido_paterno+" "+persona.apellido_materno+", "+persona.nombres;
				$('#nombres_').val(nombre);
				$('#fecha_nacimiento_').val(persona.fecha_nacimiento);
				$('#sexo_').val(persona.sexo);
				$('#id').val(persona.id);
				$('#id_per_det').val(0);
				

				$('#telefono_').val(persona_detalle.telefono);
				$('#email_').val(persona_detalle.email);

				$('#tipo_documento_').attr("disabled",true);
				$('#numero_documento_').attr("disabled",true);
			}	
		},
		{
			url: '/persona/buscar_persona/' + tipo_documento + '/' + numero_documento,
			dataType: "json",
			success: function(result){
				
				if(result.sw==2){
					bootbox.alert("No es colaborador de Felmo, los datos han sido obtenidos de Reniec");
					//$('#telefono').attr("disabled",false);
					//$('#email').attr("disabled",false);
				}
				if(result.sw==3){
					bootbox.alert("El numero de documento no se encontro en Felmo ni en Reniec");
					//$('#numero_documento').val("");
					
					/*
					$('#numero_documento').attr("disabled",false);
					$('#nombres').attr("disabled",false).attr("placeholder","Ingrese Nombres");
					
					$('#divApellidoP').show();
					$('#divApellidoM').show();
					
					$('#apellidop').attr("placeholder","Apellido Paterno");
					$('#apellidom').attr("placeholder","Apellido Materno");
					
					$('#telefono').attr("disabled",false);
					$('#email').attr("disabled",false);
					*/
					return false;
				}
				

				var persona = result.persona;
				var persona_detalle = result.persona_detalle;
				//bootbox.alert("Datos recuperados ->" + persona.apellido_materno);
				
				var nombre = persona.apellido_paterno+" "+persona.apellido_materno+", "+persona.nombres;
				$('#nombres_').val(nombre);
				$('#fecha_nacimiento_').val(persona.fecha_nacimiento);
				$('#sexo_').val(persona.sexo);
				$('#id').val(persona.id);
				$('#id_per_det').val(0);
				

				$('#telefono_').val(persona_detalle.telefono);
				$('#email_').val(persona_detalle.email);

				$('#tipo_documento_').attr("disabled",true);
				$('#numero_documento_').attr("disabled",true);
			}	
		}
		);
		
	}

	function obtenerProvincia(){
	
	var id = $('#txtIdUbiDepar').val();
	if(id=="")return false;
	$('#txtIdUbiProv').attr("disabled",true);
	$('#ubigeodireccionprincipal').attr("disabled",true);
	
	var msgLoader = "";
	msgLoader = "Procesando, espere un momento por favor";
	var heightBrowser = $(window).width()/2;
	$('.loader').css("opacity","0.8").css("height",heightBrowser).html("<div id='Grd1_wrapper' class='dataTables_wrapper'><div id='Grd1_processing' class='dataTables_processing panel-default'>"+msgLoader+"</div></div>");
    $('.loader').show();
	
	//alert(id); exit();

	$.ajax({
		url: '/ubigeo/obtener_provincia/'+id,		
		dataType: "json",
		success: function(result){
			var option = "<option value='' selected='selected'>Seleccionar</option>";
			$('#txtIdUbiProv').html("");
			$(result).each(function (ii, oo) {
				option += "<option value='"+oo.id+"'>"+oo.nombre+"</option>";
			});
			$('#txtIdUbiProv').html(option);
			$('#txtIdUbiProv').select2();
			
			var option2 = "<option value=''>Seleccionar</option>";
			$('#ubigeodireccionprincipal').html(option2);
			
			$('#txtIdUbiProv').attr("disabled",false);
			$('#ubigeodireccionprincipal').attr("disabled",false);
			
			$('.loader').hide();
			
		}
		
	});
	
}
function obtenerDistrito(){
	
	var id = $('#txtIdUbiProv').val();
	if(id=="")return false;
	$('#ubigeodireccionprincipal').attr("disabled",true);
	
	var msgLoader = "";
	msgLoader = "Procesando, espere un momento por favor";
	var heightBrowser = $(window).width()/2;
	$('.loader').css("opacity","0.8").css("height",heightBrowser).html("<div id='Grd1_wrapper' class='dataTables_wrapper'><div id='Grd1_processing' class='dataTables_processing panel-default'>"+msgLoader+"</div></div>");
    $('.loader').show();
	
	$.ajax({
		url: '/ubigeo/obtener_distrito/'+id,
		dataType: "json",
		success: function(result){
			var option = "<option value=''>Seleccionar</option>";
			$('#ubigeodireccionprincipal').html("");
			$(result).each(function (ii, oo) {
				option += "<option value='"+oo.id+"'>"+oo.nombre+"</option>";
			});
			$('#ubigeodireccionprincipal').html(option);
			$('#ubigeodireccionprincipal').select2();
			
			$('#ubigeodireccionprincipal').attr("disabled",false);
			$('.loader').hide();
			
		}
		
	});
	
}
function obtenerUnidad(){
	
	var id = $('#id_area_trabajo_').val();
	if(id=="")return false;
	//$('#ubigeodireccionprincipal').attr("disabled",true);
	
	var msgLoader = "";
	msgLoader = "Procesando, espere un momento por favor";
	var heightBrowser = $(window).width()/2;
	$('.loader').css("opacity","0.8").css("height",heightBrowser).html("<div id='Grd1_wrapper' class='dataTables_wrapper'><div id='Grd1_processing' class='dataTables_processing panel-default'>"+msgLoader+"</div></div>");
    $('.loader').show();
	
	$.ajax({
		url: '/unidad/obtener_unidad/'+id,
		dataType: "json",
		success: function(result){
			var option = "<option value=''>Seleccionar</option>";
			$('#id_unidad_trabajo_').html("");
			$(result).each(function (ii, oo) {
				option += "<option value='"+oo.id+"'>"+oo.denominacion+"</option>";
			});
			$('#id_unidad_trabajo_').html(option);
			$('#id_unidad_trabajo_').select2();
			
			$('#id_unidad_trabajo_').attr("disabled",false);
			$('.loader').hide();
			
		}
	});	
}

function calcularEdad(fecha_nacimiento) {
    var hoy = new Date();
    var cumpleanos = new Date(fecha_nacimiento);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();
    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }
    return edad;
}



</script>

