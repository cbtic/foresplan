<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<title>Sistema FORESPAMA</title>

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
		height: 250px;
	}


	.modal-dialog {
		width: 100%;
		max-width: 50% !important
	}

	#tablemodal {
		border-spacing: 0;
		display: flex;
		/*Se ajuste dinamicamente al tamano del dispositivo**/
		max-height: 80vh;
		/*El alto que necesitemos**/
		overflow-y: auto;
		/**El scroll verticalmente cuando sea necesario*/
		overflow-x: hidden;
		/*Sin scroll horizontal*/
		table-layout: fixed;
		/**Forzamos a que las filas tenga el mismo ancho**/
		width: 98vw;
		/*El ancho que necesitemos*/
		border: 1px solid #c4c0c9;
	}

	#tablemodal thead {
		background-color: #e2e3e5;
		position: fixed !important;
	}


	#tablemodal th {
		border-bottom: 1px solid #c4c0c9;
		border-right: 1px solid #c4c0c9;
	}

	#tablemodal th {
		font-weight: normal;
		margin: 0;
		max-width: 9.5vw;
		min-width: 9.5vw;
		word-wrap: break-word;
		font-size: 10px;
		font-weight: bold;
		height: 3.5vh !important;
		line-height: 12px;
		vertical-align: middle;
		/*height:20px;*/
		padding: 4px;
		border-right: 1px solid #c4c0c9;
	}

	#tablemodal td {
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

	.img_ruta {
		position: relative;
		float: left
	}

	.delete_ruta {
		background-image: url(img/delete.png);
		top: 0px;
		left: 110px;
		background-size: 100%;
		position: absolute;
		display: block;
		width: 30px;
		height: 30px;
		cursor: pointer
	}

	#tablemodal tbody tr:hover td,
	#tablemodal tbody tr:hover th {
		/*background-color: red!important;*/
		font-weight: bold;
		/*mix-blend-mode: difference;*/

	}

	#tablemodalm {}

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
		background-color: #337ab7;
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

	input:checked+.slider {
		background-color: #4cae4c;
	}

	input:focus+.slider {
		box-shadow: 0 0 1px #4cae4c;
	}

	input:checked+.slider:before {
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

	.no {
		padding-right: 3px;
		padding-left: 0px;
		display: block;
		width: 100px;
		float: left;
		font-size: 14px;
		text-align: right;
		padding-top: 5px
	}

	.si {
		padding-right: 0px;
		padding-left: 3px;
		display: block;
		width: 100px;
		float: left;
		font-size: 14px;
		text-align: left;
		padding-top: 5px
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
		
		$('#fecha').datepicker({
			autoclose: true,
			format: 'yyyy-mm-dd',
			changeMonth: true,
			changeYear: true,
			language: 'es'
		});

	});
</script>

<script type="text/javascript">
$('#openOverlayOpc').on('shown.bs.modal', function() {
	$('#fecha_egresado').datepicker({
		format: "dd-mm-yyyy",
		autoclose: true,
		container: '#openOverlayOpc modal-body'
	});
});

$('#openOverlayOpc').on('shown.bs.modal', function() {
	$('#fecha_graduado').datepicker({
		format: "dd-mm-yyyy",
		autoclose: true,
		container: '#openOverlayOpc modal-body'
	});
});

$(document).ready(function() {



});

function fn_save_menu() {

	var msg = "";
	var _token = $('#_token').val();
	var id = $('#id').val();
	var denominacion = $('#denominacion').val();
	var precio = $('#precio').val();
	var fecha = $('#fecha').val();

	if(denominacion == "")msg += "Debe ingresar la Denominacion <br>";
	if(precio == ""){msg += "Debe ingresar el Precio <br>";}
	if(fecha == ""){msg += "Debe ingresar la Fecha <br>";}

	if(msg!=""){
        bootbox.alert(msg);
        return false;
    }else{

		var msgLoader = "";
		msgLoader = "Procesando, espere un momento por favor";
		var heightBrowser = $(window).width()/2;
		$('.loader').css("opacity","0.8").css("height",heightBrowser).html("<div id='Grd1_wrapper' class='dataTables_wrapper'><div id='Grd1_processing' class='dataTables_processing panel-default'>"+msgLoader+"</div></div>");
		$('.loader').show();

		$.ajax({
			url: "/menu_persona/send_menu",
			type: "POST",
			data : $('#frmMenu').serialize(),
			success: function(result) {
				datatablenew();
				$('.loader').hide();
				bootbox.alert("Se guard&oacute; satisfactoriamente"); 
				$('#openOverlayOpc').modal('hide');
			}
		});
			
	}
}


$(document).ready(function() {

	if ($('#id').val() > 0) {
		const precioInput = document.getElementById('precio');
		formatoPrecio(precioInput);
	}

});

function formatoPrecio() {
	const input = document.getElementById('precio');
	let value = input.value;

	// Verifica si el valor es un número
	if (!isNaN(value) && value.trim() !== "") {
		// Convierte a flotante y formatea con dos decimales
		value = parseFloat(value).toFixed(2);
		input.value = value;
	}
}

/*function formatoPrecio(input) {
	
	const value = parseFloat(input.value) || 0;
	input.value = value.toFixed(2);
}*/

function formatPrecio(input) {

	let value = input.value;

	value = value.replace(/[^0-9.]/g, '');

	const parts = value.split('.');
	if (parts.length > 2) {
		value = parts[0] + '.' + parts[1];
	}

	if (parts.length === 2) {
		value = parts[0] + '.' + parts[1].substring(0, 2);
	}

	input.value = value;
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
            <small style="font-size: 20px">Programados del Medicos del dia <?php //echo $fecha_atencion
																			?></small>
          </h1>
        </section>
		-->
		<div class="justify-content-center">

			<div class="card">

				<div class="card-header" style="padding:5px!important;padding-left:20px!important; font-weight: bold">
					Registro Menu
				</div>

				<div class="card-body">
					<form method="post" action="#" id="frmMenu" name="frmMenu">
					<div class="row">
						<!--aaaa-->
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:5px;padding-bottom:20px">

							<form method="post" action="#" enctype="multipart/form-data">
								<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="id" id="id" value="<?php echo $id ?>">

								<div class="row">
									<div class="col-lg-7">
										<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
											<label class="control-label form-control-sm">Denominaci&oacute;n</label>
											<input id="denominacion" name="denominacion" class="form-control form-control-sm" value="<?php echo $menu->denominacion ?>"  type="text">
										</div>
									</div>

									<div class="col-lg-2">
										<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
											<label class="control-label form-control-sm">Precio</label>
											<input id="precio" name="precio" class="form-control form-control-sm" value="<?php echo $menu->precio?>" type="text" onblur="formatoPrecio()">
										</div>
									</div>

									<div class="col-lg-3">
										<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
											<label class="control-label form-control-sm">Fecha</label>
											<input id="fecha" name="fecha" class="form-control form-control-sm" value="<?php echo isset($menu->fecha) && !empty($menu->fecha) ? date('Y-m-d', strtotime($menu->fecha)) : date('Y-m-d'); ?>" type="text">
										</div>
									</div>
								</div>

								<div style="margin-top:15px" class="form-group">
									<div class="col-sm-12 controls">
										<div class="btn-group btn-group-sm float-right" role="group" aria-label="Log Viewer Actions">
											<a href="javascript:void(0)" onClick="fn_save_menu()" class="btn btn-sm btn-success">Guardar</a>
										</div>

									</div>
								</div>
							</div>

						</div>

					</div>
					</form>
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
			$(document).ready(function() {


				$('#numero_documento').blur(function() {
					var id = $('#id').val();
					if (id == 0) {
						validaDni(this.value);
					}
				});

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

				$('#persona_').keyup(function() {
					this.value = this.value.toLocaleUpperCase();
				});

				$('#persona_').focusin(function() {
					$('#persona_').select();
				});
				/*
				$('#usuario_').autocomplete({
					appendTo: "#usuario_busqueda",
					source: function(request, response) {
						$.ajax({
						url: '/empresa/list_usuario/'+$('#usuario_').val(),
						dataType: "json",
						success: function(data){
							var resp = $.map(data,function(obj){
								var hash = {key: obj.id, value: obj.usuario};
								return hash;
							});
							response(resp);
						},
						error: function() {
						}
					});
					},
					select: function (event, ui) {
						$("#user_id").val(ui.item.key);
					},
						minLength: 2,
						delay: 100
					});
				*/

				$('#empresa_').keyup(function() {
					this.value = this.value.toLocaleUpperCase();
				});

				$('#empresa_').focusin(function() {
					$('#empresa_').select();
				});

				$('#empresa_').autocomplete({
					appendTo: "#empresa_busqueda",
					source: function(request, response) {
						$.ajax({
							url: '/empresa/list_empresa/' + $('#empresa_').val(),
							dataType: "json",
							success: function(data) {
								var resp = $.map(data, function(obj) {
									var hash = {
										key: obj.id,
										value: obj.razon_social,
										ruc: obj.ruc
									};
									return hash;
								});
								response(resp);
							},
							error: function() {}
						});
					},
					select: function(event, ui) {
						$("#id_empresa").val(ui.item.key);
					},
					minLength: 1,
					delay: 100
				});

				$('#persona_').autocomplete({
					appendTo: "#persona_busqueda",
					source: function(request, response) {
						$.ajax({
							url: '/persona/list_persona/' + $('#persona_').val(),
							dataType: "json",
							success: function(data) {
								var resp = $.map(data, function(obj) {
									var hash = {
										key: obj.id,
										value: obj.persona
									};
									return hash;
								});
								response(resp);
							},
							error: function() {}
						});
					},
					select: function(event, ui) {
						$("#id_persona").val(ui.item.key);
					},
					minLength: 1,
					delay: 100
				});


			});

			function validaDni(dni) {

				var numero_documento = $("#numero_documento").val();
				var msg = "";

				if (msg != "") {
					bootbox.alert(msg);
					return false;
				}

				if (tipo_documento == "0" || numero_documento == "") {
					bootbox.alert(msg);
					return false;
				}

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

						$('#apellido_paterno').val('')
						$('#apellido_materno').val('')
						$('#nombre').val('')

						$('#apellido_paterno').val(data.apellido_paterno);
						$('#apellido_materno').val(data.apellido_materno);
						$('#nombre').val(data.nombres);

						//alert(data.nombre_o_razon_social);

					} else {
						Swal.fire("DNI Inv&aacute;lido. Revise el DNI digitado!");
						return false;
					}

				});
			}
		</script>
