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

function fn_save(){

	var _token = $('#_token').val();
	var id  = $('#_id').val();
	var tipo = $('#tipo_').val();
	var denominacion = $('#denominacion_').val();
	var orden = $('#orden_').val();
	var estado = $('#estado_').val();
	var codigo = $('#codigo_').val();
	var tipo_nombre = $('#tipo_nombre_').val();

    $.ajax({
			url: "/tabla_maestras/send",
            type: "POST",
            data : {_token:_token,id:id,tipo:tipo,denominacion:denominacion,orden:orden,
                estado:estado,codigo:codigo,tipo_nombre:tipo_nombre},
            success: function (result) {
				$('#openOverlayOpc').modal('hide');
				datatablenew();
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
				Edici&oacute;n Empresa
			</div>

            <div class="card-body">

			<div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:10px">

					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id" id="id" value="<?php echo $id?>">

					<!--
					<div class="col-lg-12 col-md-12 col-sm-12 col-tipo_documentoxs-12">
						<div class="form-group">
							<div id="custom-search-input">
								<div class="input-group">
									<input id="vehiculo_empresa" class="form-control form-control-sm ui-autocomplete-input" placeholder="Buscar Empresa" name="vehiculo_empresa" type="text" autocomplete="off">
								</div>
								<div class="input-group" id="vehiculo_empresa_busqueda"><ul class="ui-autocomplete ui-front ui-menu ui-widget ui-widget-content" id="ui-id-278" tabindex="0" style="display: none;"></ul></div>
							</div>
						</div>
					</div>
					-->
					<div class="row">

						<div class="col-lg-6">
							<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
								<label class="control-label">Tipo</label>
								<select name="tipo_" id="tipo_" class="form-control form-control-sm">
                                    <option value="<?php echo $tabla_maestra::NC?>" <?php if($tabla_maestra::NC==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::NC?></option>
                                    <option value="<?php echo $tabla_maestra::ND?>" <?php if($tabla_maestra::ND==$tabla_maestra->tipo)echo "selected='selected'" ?>><?php echo $tabla_maestra::ND?></option>
                                    <option value="<?php echo $tabla_maestra::GUIA?>" <?php if($tabla_maestra::GUIA==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::GUIA?></option>
                                    <option value="<?php echo $tabla_maestra::DOC_RELA?>" <?php if($tabla_maestra::DOC_RELA==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::DOC_RELA?></option>
									<option value="<?php echo $tabla_maestra::TIPO_OPE?>" <?php if($tabla_maestra::TIPO_OPE==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::TIPO_OPE?></option>
									<option value="<?php echo $tabla_maestra::TIPO_IGV?>" <?php if($tabla_maestra::TIPO_IGV==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::TIPO_IGV?></option>
									<option value="<?php echo $tabla_maestra::UNIDADES?>" <?php if($tabla_maestra::UNIDADES==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::UNIDADES?></option>
									<option value="<?php echo $tabla_maestra::CODIGOBYS?>" <?php if($tabla_maestra::CODIGOBYS==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::CODIGOBYS?></option>
									<option value="<?php echo $tabla_maestra::ESTADO_BALANZA?>" <?php if($tabla_maestra::ESTADO_BALANZA==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::ESTADO_BALANZA?></option>
									<option value="<?php echo $tabla_maestra::G_DOC_RELA?>" <?php if($tabla_maestra::G_DOC_RELA==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::G_DOC_RELA?></option>
									<option value="<?php echo $tabla_maestra::MOTIVO_T?>" <?php if($tabla_maestra::MOTIVO_T==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::MOTIVO_T?></option>
									<option value="<?php echo $tabla_maestra::MODAL_T?>" <?php if($tabla_maestra::MODAL_T==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::MODAL_T?></option>
									<option value="<?php echo $tabla_maestra::SERIES?>" <?php if($tabla_maestra::SERIES==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::SERIES?></option>
									<option value="<?php echo $tabla_maestra::CAJA?>" <?php if($tabla_maestra::CAJA==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::CAJA?></option>
									<option value="<?php echo $tabla_maestra::BALANZA?>" <?php if($tabla_maestra::BALANZA==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::BALANZA?></option>
									<option value="<?php echo $tabla_maestra::CARRETA?>" <?php if($tabla_maestra::CARRETA==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::CARRETA?></option>
									<option value="<?php echo $tabla_maestra::ESPACIO?>" <?php if($tabla_maestra::ESPACIO==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::ESPACIO?></option>
									<option value="<?php echo $tabla_maestra::ESTACIONAMIENTO?>" <?php if($tabla_maestra::ESTACIONAMIENTO==$tabla_maestra->tipo)echo "selected='selected'" ?> ><?php echo $tabla_maestra::ESTACIONAMIENTO?></option>
                                </select>
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
								<label class="control-label">Denominación</label>
								<input id="denominacion_" name="denominacion_" class="form-control form-control-sm"  value="<?php echo $tabla_maestra->denominacion?>" type="text">
							</div>
						</div>

					</div>


					<div class="row">

						<div class="col-lg-6">
							<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
								<label class="control-label">Código</label>
								<input id="codigo_" name="codigo_" class="form-control form-control-sm"  value="<?php echo $tabla_maestra->codigo?>" type="text" maxlength="3">
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
								<label class="control-label">Tipo Nombre</label>
								<input id="tipo_nombre_" name="tipo_nombre_" class="form-control form-control-sm"  value="<?php echo $tabla_maestra->tipo_nombre?>" type="text">
							</div>
						</div>
					</div>

					<div class="row">

						<div class="col-lg-6">
							<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
								<label class="control-label">Orden</label>
								<input id="orden_" name="orden_" class="form-control form-control-sm"  value="<?php echo $tabla_maestra->orden?>" type="text">
							</div>
						</div>

						<div class="col-lg-6">
							<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
								<label class="control-label">Estado</label>
								<select name="estado_" id="estado_" class="form-control form-control-sm">
                                    <option value="<?php echo $tabla_maestra::ACTIVO?>" <?php if($tabla_maestra::ACTIVO==$tabla_maestra->tipo)echo "selected='selected'" ?> >ACTIVO</option>
                                    <option value="<?php echo $tabla_maestra::CANCELADO?>" <?php if($tabla_maestra::CANCELADO==$tabla_maestra->tipo)echo "selected='selected'" ?>>CANCELADO</option>
                                </select>
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

<script type="text/javascript">
$(document).ready(function() {
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

