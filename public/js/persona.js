const { exists } = require("laravel-mix/src/File");

$(document).ready(function () {
	
	datatablenew();
	
	$('#addRow').on('click', function () {
		AddFila();
	});
	
	$('#btnNuevo').on('click', function () {
		Limpiar();
	});
	
	$('#tblProductos tbody').on('click', 'button.deleteFila', function () {
		var obj = $(this);
		obj.parent().parent().remove();
	});
	
	$('#btnBuscar').click(function () {
		fn_ListarBusqueda();
	});
	
	$('#fecha_desde').datepicker({
        autoclose: true,
		//dateFormat: 'dd-mm-yy',
		format: 'dd/mm/yyyy',
		changeMonth: true,
		changeYear: true,
    });
	
	$('#fecha_hasta').datepicker({
        autoclose: true,
		//dateFormat: 'dd-mm-yy',
		format: 'dd/mm/yyyy',
		changeMonth: true,
		changeYear: true,
    });
	
	
});

function aperturar(accion){
	var id_caja_ingreso = $('#id_caja_ingreso').val();
    var id_caja = $('#id_caja').val();
	var saldo_inicial = $('#saldo_inicial').val();
	var total_recaudado = $('#total_recaudado').val();
	var saldo_total = $('#saldo_total').val();
	var estado = '1';
	var _token = $('#_token').val();
	
	var msg = "";
	
	if(id_caja == "0")msg += "Debe seleccionar una Caja disponible <br>";
	if(saldo_inicial == "")msg += "Debe ingresar el saldo inicial de caja <br>";

	if(msg!=""){
        bootbox.alert(msg);
        return false;
    }
	
    $.ajax({
			url: "/ingreso/sendCaja",
            type: "POST",
            data : {accion:accion,id_caja_ingreso:id_caja_ingreso,id_caja:id_caja,saldo_inicial:saldo_inicial,total_recaudado:total_recaudado,saldo_total:saldo_total,estado:estado,_token:_token},
            success: function (result) {  
					location.reload();
              
            }
    });
}

function guardarValorizacion(){
    
    var msg = "";
    
	fn_save();
}

function fn_save(){
    
    //var fecha_atencion_original = $('#fecha_atencion').val();
	//var id_user = $('#id_user').val();
    $.ajax({
			url: "/ingreso/send",
            type: "POST",
            //data : $("#frmCita").serialize()+"&id_medico="+id_medico+"&fecha_cita="+fecha_cita,
            data : $("#frmValorizacion").serialize(),
            success: function (result) {  
                    /*$('#openOverlayOpc').modal('hide');
					$('#calendar').fullCalendar("refetchEvents");
					modalDelegar(fecha_atencion_original);*/
					//modalTurnos();
					//modalHistorial();
					//location.href="ver_cita/"+id_user+"/"+result;
            }
    });
}

function validaTipoDocumento(){
	var tipo_documento = $("#tipo_documento").val();
	$('#nombre_afiliado').val("");
	$('#empresa_afiliado').val("");
	$('#empresa_direccion').val("");
	$('#empresa_representante').val("");
	$('#codigo_afiliado').val("");	
	$('#fecha_afiliado').val("");
				
	if(tipo_documento == "RUC"){
		$('#divNombreApellido').hide();
		$('#divCodigoAfliado').hide();
		$('#divFechaAfliado').hide();
		$('#divDireccionEmpresa').show();
		$('#divRepresentanteEmpresa').show();
	}else{
		$('#divNombreApellido').show();
		$('#divCodigoAfliado').show();
		$('#divFechaAfliado').show();
		$('#divDireccionEmpresa').hide();
		$('#divRepresentanteEmpresa').hide();
	}
}

function obtenerEmpresa(){
		
	var numero_placa = $("#numero_placa").val();
	var flagBalanza = $("#flagBalanza").val();
	var msg = "";
	
	if (msg != "") {
		bootbox.alert(msg);
		return false;
	}
	
	$('#tblProductos tbody').html("");
	$('#nombre_empresa').val("");
	$('#numero_ejes').val("");
	$('#numero_ejes').val("");
	$('#peso_seco').val("");
	$('#procedencia').val("");
	$('#conductor').val("");
	$('#numero_documento').val("");
	$('#nombres_razon_social').val("");
	$('#servicio').val("");
	
	$.ajax({
		url: '/pesaje/obtener_datos_vehiculo/' + numero_placa,
		dataType: "json",
		success: function(result){
			if (result) {
				// Ver por la placa si el camion sigue dentro del estacionamiento.
				$('#estado_pesaje').val(result.estado);
				if (result.estado == '1') {
					bootbox.alert("El vehiculo no ha ingresado");
        			return false;
				} else {
					$("#id_ingreso_vehiculo").val(result.id);
					//$("#id_ubicacion").val(result.ubicacion_id);
					$('#nombre_empresa').val(result.empresa_transporte);
					$('#numero_ejes').val(result.ejes);
					$('#numero_documento').val(result.dueno_carga_documento);
					$('#nombres_razon_social').val(result.dueno_carga_nombre);
					$('#empresa_direccion').val(result.direccion);
					$('#procedencia').val(result.procedencia);
					$('#servicio').val(result.servicio);
					$('#peso_seco').val(result.peso_seco);
					if(result.peso_seco==null){
						$('#peso_seco').attr("disabled",false);
					}
					$('#exonerado').val(result.exonerado);
					$('#id_estacionamiento').val(result.id_estacionamiento);
					$('#msg_estacionamiento').html("Estacionamiento : "+result.estacionamiento);
					$('#tipo_comercio').attr("disabled",true);
					$('#conductor').val(result.conductor);

					var peso_ingreso = result.peso_ingreso;
					var fecha_ingreso = result.fecha_ingreso;
					$('#peso_ingreso_tmp').val(peso_ingreso);
					$('#fecha_ingreso_tmp').val(fecha_ingreso);
					$('#id_ubicacion').val(result.id_ubicacion);
					$('#persona_id').val(result.persona_id);

					$.ajax({
						url: '/pesaje/obtener_datos_carga/' + result.id,
						dataType: "json",
						success: function(data){
							
							var newRow = "";
							var ind = $('#tblProductos tbody tr').length;
							var tabindex = 11;
							$.map(data,function(obj){
								//cargaProductoExistente(obj.producto, obj.porcentaje)
								newRow ='<tr>';
								newRow +='<td><input value="'+obj.producto+'" onKeyPress="return soloNumerosMenosCero(event)" type="text" tabindex="'+(tabindex+2)+'" data-toggle="tooltip" data-placement="top" title="Ingresar la cantidad prescrita y presionar Enter para ingresar la cantidad entregada" name="producto_especie_[]" required="" readonly="readonly" id="producto_especie'+ind+'" class="limpia_text nro_solicitado producto_especie input-sm   form-control form-control-sm text-left" style="margin-left:4px; width:80%" /></td>';
								
								newRow +='<td><input value="'+obj.unidad+'" onKeyPress="return soloNumerosMenosCero(event)" type="text" tabindex="'+(tabindex+2)+'" data-toggle="tooltip" data-placement="top" title="Ingresar la cantidad prescrita y presionar Enter para ingresar la cantidad entregada" name="medida_especie[]" required="" readonly="readonly" id="medida_especie'+ind+'" class="limpia_text nro_solicitado medida_especie input-sm   form-control form-control-sm text-right" style="margin-left:4px; width:120px" /></td>';
								
								newRow +='<td><input value="'+obj.porcentaje+'" onKeyPress="return soloNumerosMenosCero(event)" type="text" tabindex="'+(tabindex+2)+'" data-toggle="tooltip" data-placement="top" title="Ingresar la cantidad prescrita y presionar Enter para ingresar la cantidad entregada" name="porcentaje_especie_[]" required="" readonly="readonly" id="porcentaje_especie'+ind+'" class="limpia_text nro_solicitado porcentaje_especie input-sm   form-control form-control-sm text-right" style="margin-left:4px; width:100px" /></td>';
								
								newRow +='<td><input value="'+obj.peso+'" onKeyPress="return soloNumerosMenosCero(event)" type="text" tabindex="'+(tabindex+2)+'" data-toggle="tooltip" data-placement="top" title="Ingresar la cantidad prescrita y presionar Enter para ingresar la cantidad entregada" name="cantidad_especie_[]" required="" readonly="readonly" id="cantidad_especie'+ind+'" class="limpia_text nro_solicitado cantidad_especie input-sm   form-control form-control-sm text-right" style="margin-left:4px; width:100px" /></td>';
								
								newRow +='<td><button type="button" class="btn btn-danger btn-xs" style="margin-left:4px" disabled="disabled"><i class="fa fa-times"></i> Eliminar</button></td>';
								newRow +='</tr>';
								$('#tblProductos tbody').append(newRow);
								ind++;
								 
							}); 
							
						}
					});
					
					$('#ventaRecarga').prop("disabled",false);
					$('#boton_pesar').html("PESAR_SALIDA");
				}
				
			} else {
				alert("El vehículo no esta registrado");
			}
		}
		
	});
	
}

function AddFila(){
	
	var newRow = "";
	var ind = $('#tblProductos tbody tr').length;
	var tabindex = 11;
	var nuevalperiodo = "";
	
	var item_tipo 	= "";
	$('#idTipoGarantiaTemp option').each(function(){
		item_tipo += "<option value="+$(this).val()+">"+$(this).html()+"</option>"	
	});
	/*
	var item_moneda		= "";
	$('#idMoneda option').each(function(){
		item_medida += "<option value="+$(this).val()+">"+$(this).html()+"</option>"	
	});
	*/
	newRow +='<tr>';
	newRow +='<td><select class="form-control form-control-sm id_tipo" id="id_tipo'+ind+'" ind="'+ind+'" tabindex="'+tabindex+'" name="id_tipo[]">'+item_tipo+'</select></td>';
	//newRow +='<td><select class="form-control form-control-sm idUnidad" id="idUnidad'+ind+'" ind="'+ind+'" tabindex="'+tabindex+'" name="id_unidad[]" style="margin-left:4px; width:120px">'+item_medida+'</select>';
	
	newRow +='<td><input onKeyPress="return soloNumerosMenosCero(event)" type="text" tabindex="'+(tabindex+2)+'" data-toggle="tooltip" data-placement="top" title="Ingresar la cantidad prescrita y presionar Enter para ingresar la cantidad entregada" name="descripcion[]" required="" id="descripcion'+ind+'" class="limpia_text nro_solicitado descripcion input-sm form-control form-control-sm text-left" style="margin-left:4px;" /></td>';
	
	newRow +='<td><input onKeyPress="return soloNumerosMenosCero(event)" type="text" tabindex="'+(tabindex+2)+'" data-toggle="tooltip" data-placement="top" title="Ingresar la cantidad prescrita y presionar Enter para ingresar la cantidad entregada" name="valor_actual[]" required="" id="valor_actual'+ind+'" class="limpia_text nro_solicitado valor_actual input-sm form-control form-control-sm text-right" style="margin-left:4px;" /></td>';
	
	//newRow +='<td><button type="button" class="btn btn-danger deleteFila btn-xs" style="margin-left:4px"><i class="fa fa-times"></i> Eliminar</button></td>';
	newRow +='</tr>';
	$('#tblProductos tbody').append(newRow);
	
	$("#id_tipo"+ind).select2({max_selected_options: 4});
	
	$("#id_tipo"+ind).on("change", function (e) {
		var flagx = 0;
		cmb = $(this);
		id_especie = $("#id_tipo"+ind).val();
	
		$('.id_tipo').each(function(){
			var ind_tmp = $(this).val();
			if($(this).val() == id_especie)flagx++;
		});
	
		if(flagx > 1){
			bootbox.alert("El Tipo de Garantia ya ha sido ingresado");
			$("#idEspecie"+ind).val("").trigger("change");
			return false;
		}
		
	});
	
	
}


function obtenerChoferes(empresa_id){

	$.ajax({
		url: '/pesaje/obtener_datos_choferes/' + empresa_id,
		dataType: "json",
		success: function(result){
			
			var myOptions = {};

			// alert(JSON.stringify(result[0].nombres));
			$.each(result, function(val, text) {
				// alert(JSON.stringify(text));
				myOptions[text.id] = text.nombres+' '+text.apellido_paterno;
			});
			

			$("#lista_chofer option").remove();
			$('#lista_chofer').append("<option value=''>Escoger</option>");
			var mySelect = $('#lista_chofer');
			$.each(myOptions, function(val, text) {
				mySelect.append(
					$('<option></option>').val(val).html(text)
				);
			});
		}
		
	});
}


function obtenerChofer(id){

	$('#numero_documento').val("");
	$('#nombres').val("");
	$('#apellidos').val("");

	$.ajax({
		url: '/pesaje/obtener_datos_chofer/' + id,
		dataType: "json",
		success: function(result){
			// alert(JSON.stringify(result));
			
			$('#numero_documento').val(result.numero_documento);
			$('#nombres').val(result.nombres);
			$('#apellidos').val(result.apellido_paterno + ' ' + result.apellido_materno);
			
		}
		
	});

	return false;
}

function cargarValorizacion(){
    
    
	//var numero_documento = $("#numero_documento").val();
	var tipo_documento = $("#tipo_documento").val();
	var persona_id = 0;
	if(tipo_documento=="RUC")persona_id = $('#empresa_id').val();
	else persona_id = $('#persona_id').val();

    $("#tblValorizacion tbody").html("");
	$.ajax({
			url: "/ingreso/obtener_valorizacion/"+tipo_documento+"/"+persona_id,
			type: "GET",
			success: function (result) {  
					$("#tblValorizacion tbody").html(result);
			}
	});

}


function cargarPagos(){
    
    
	//var numero_documento = $("#numero_documento").val();
	var tipo_documento = $("#tipo_documento").val();
	var persona_id = 0;
	if(tipo_documento=="RUC")persona_id = $('#empresa_id').val();
	else persona_id = $('#persona_id').val();

    $("#tblPago tbody").html("");
	$.ajax({
			//url: "/ingreso/obtener_pago/"+numero_documento,
			url: "/ingreso/obtener_pago/"+tipo_documento+"/"+persona_id,
			type: "GET",
			success: function (result) {  
					$("#tblPago tbody").html(result);
			}
	});

}

// Padding Zeros
function pad (str, max) {
	str = str.toString();
	return str.length < max ? pad("0" + str, max) : str;
  }

// Funciones para Agregar y eliminar productos en la Declaracionde carga

var cuentaproductos=1;

function cargaProductoNuevo() {
	cuentaproductos = cuentaproductos + 1;
	$('#tblProductos tr:last').after('<tr id="fila'+pad(cuentaproductos, 2)+'"><td class="text-right">#</td><td><input type="text" name="producto[]" id="producto'+pad(cuentaproductos, 2)+'" onkeyup="var query = $(this).val();$.ajax({url:\'../especie/search\',type:\'GET\',data:{\'denominacion\':query,\'listadoproducto\':\''+pad(cuentaproductos, 2)+'\'},success:function (data) {$(\'#producto'+pad(cuentaproductos, 2)+'_list\').html(data);}})" class="form-control form-control-sm"><div id="producto'+pad(cuentaproductos, 2)+'_list"></div></td><td><input type="text" name="porcentajeproducto[]" id="porcentajeproducto'+pad(cuentaproductos, 2)+'" class="form-control form-control-sm" onchange="calculaPorcentaje('+cuentaproductos+')" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"></td><td><input readonly="readonly" style="border:0px" type="text" name="peso_aprox[]" value="0 kg" id=peso_aprox_'+pad(cuentaproductos, 2)+' /></td></tr>');
	/*
	$("input[name^='producto']").blur(function() {
		if(this.value=="BONITO CONGELADO" || obj.producto=="JUREL CONGELADO"){
			$("#costo_tn").val(233);
			$("#span_costo_tn").html("233");
		}
	});
	*/
}

function cargaProductoExistente(producto, porcentaje) {
	
	$('#tblProductos tr:last').after('<tr id="fila'+pad(cuentaproductos, 2)+'"><td class="text-right">#</td><td><input value="' + producto + '" type="text" name="producto[]" id="producto'+pad(cuentaproductos, 2)+'" onkeyup="var query = $(this).val();$.ajax({url:\'../especie/search\',type:\'GET\',data:{\'denominacion\':query,\'listadoproducto\':\''+pad(cuentaproductos, 2)+'\'},success:function (data) {$(\'#producto'+pad(cuentaproductos, 2)+'_list\').html(data);}})" class="form-control form-control-sm"><div id="producto'+pad(cuentaproductos, 2)+'_list"></div></td><td><input value="' + porcentaje + '" type="text" name="porcentajeproducto[]" id="porcentajeproducto'+pad(cuentaproductos, 2)+'" class="form-control form-control-sm" onchange="calculaPorcentaje('+cuentaproductos+')"></td><td><input readonly="readonly" style="border:0px" type="text" name="peso_aprox[]" value="0 kg" id=peso_aprox_'+pad(cuentaproductos, 2)+' /></td></tr>');
	cuentaproductos = cuentaproductos + 1;
}

function eliminaFila(fila) {
	if (fila>1) {
		cuentaproductos = cuentaproductos - 1;
		$('#fila'+pad(fila, 2)).remove();
	}
}

// Funcion para evitar escribir texto no numerico en un input text
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

// Funciones para simular la carga de datos de balanza

function simulaPesar() {
	if ($('#peso_ingreso').html() == "") {
		$('#boton_pesar').html("PESAR SALIDA");
        $('#peso_ingreso').html("12,500 kg");
		$('#input_peso_ingreso').val("12500");
		
		$('#fecha_ingreso').html("fecha: 21/02/2020 06:15am");
		$('#input_fecha_ingreso').val("21/02/2020 06:15am");
	} else {
		$('#peso_salida').html("10,500 kg");
		$('#input_peso_salida').val("10500");
		
		$('#fecha_salida').html("fecha: 23/02/2020 15:25pm");
		$('#input_fecha_salida').val("23/02/2020 15:25pm");
		
		$('#peso_neto').html("2,000 kg");
		$('#input_peso_neto').val("2000");
		
		$('#dcto_por_hielo').html("200 kg");
		$('#input_dcto_por_hielo').val("200");
		
		$('#peso_a_cobrar').html("1,800 kg");
		$('#input_peso_a_cobrar').val("1800");
		
		$('#estadia').html("3d / 8h");
		$('#input_estadia').val("3d / 8h");
		
		/*********************/
		$('#cantidad_peso').html($('#peso_a_cobrar').html());
		$('#cantidad_dias').html("3");
		$('#cantidad_ejes').html("2");
		
		/*********************/
		$('#peso_aprox_01').val("1800 kg");
		//$('#porcentajeproducto01').html("1800 kg");
		// cantidad_permanencia

		$('#precio_peso').html("60.00");
		$('#precio_permanecia').html("50.00");
		$('#precio_subtotal').html("160.00");
		$('#precio_igv').html((parseFloat($('#precio_subtotal').html()).toFixed(2)*0.18).toFixed(2));
		$('#precio_total').html((parseFloat($('#precio_subtotal').html()).toFixed(2)*1.18).toFixed(2));

		//sobreestadia
		
		$('#fila_sobreestadia').show();
		$('#cantidad_dias_sobreestadia').html("1");
		$('#cantidad_ejes_sobreestadia').html("2");
		$('#precio_permanecia_sobreestadia').html("50.00");
		
	}
}

function simulaPesarCarreta() {
	
	//var precio_peso = $('#precio_peso').val();
	var precio_peso = parseFloat($('input[name="mov[0][importe]"]').val());
	
	var subtotal = precio_peso/1.18;
	var igv = precio_peso - subtotal;
	
	$('#precio_total').html(precio_peso.toFixed(2));
	
	$('#precio_igv').html(igv.toFixed(2));
	$('#precio_subtotal').html(subtotal.toFixed(2));
	
	//$('#precio_total').html((parseFloat($('#precio_subtotal').html()).toFixed(2)*1.18).toFixed(2));
	
	
	
	/*
	$('input[name="factura_detalle[0][subtotal]"]').val(precio_peso);
	$('input[name="factura_detalle[0][igv]"]').val((parseFloat($('#precio_subtotal').html()).toFixed(2)*0.18).toFixed(2));
	$('input[name="factura_detalle[0][total]"]').val((parseFloat($('#precio_subtotal').html()).toFixed(2)*1.18).toFixed(2));
	
	$('input[name="factura_detalles[0][subtotal]"]').val(precio_peso);
	$('input[name="factura_detalles[0][igv]"]').val((parseFloat($('#precio_subtotal').html()).toFixed(2)*0.18).toFixed(2));
	$('input[name="factura_detalles[0][total]"]').val((parseFloat($('#precio_subtotal').html()).toFixed(2)*1.18).toFixed(2));
	*/
	$('#btnBoleta').prop("disabled", false);
	$('#btnFactura').prop("disabled", false);
}

function enviarTipo(tipo){
	if(tipo == 1)$('#TipoF').val("FTFT");
	if(tipo == 2)$('#TipoF').val("BVBV");
	if(tipo == 3)$('#TipoF').val("TKTK");
	validar();
}

function validar() {
	
	var msg = "";
	var sw = true;
	
	//var MonAd = $('#MonAd').val();
	var total = $('#precio_peso').val();
	
	/*
	var dni = $('#dni').val();
	var len = dni.length;
	var id_establecimiento = $('#id_establecimiento').val();
	var id_farmacia = $('#id_farmacia').val();

	if (len != 8) {
		msg += "En Dni tiene que ser de 8 digitos.<br/>";
		sw = false
	}

	if ($('#flagestablecimientos').is(':checked')) {
	} else {
		if (id_establecimiento == "0") {
			msg += "Seleccione un Hospital y elija la opcion Todos de ser necesario.<br/>";
			sw = false
		}
	}
	if ($('#flagfarmacias').is(':checked')) {

	} else {
		if (id_farmacia == "0") {
			msg += "Seleccione una Farmacia y elija la opcion Todos de ser necesario.<br/>";
			sw = false
		}
	}
	
	if (tipo_registro == "") {
		msg += "Seleccione un Tipo de registro.<br/>";
		sw = false
	}
	*/
	
	if (sw == false) {
		bootbox.alert(msg);
		return sw;
	} else {
		//submitFrm();
		document.frmPesajeCarreta.submit();
	}
	return false;
}



function simulaGuardarValorizacion() {
	$('#btnBoleta').prop('disabled', false);
	$('#btnFactura').prop('disabled', false);
}

function calculaPorcentaje(fila) {
	if ($("#input_peso_ingreso").val == "") {
		contador = 0;
		$("input[name^='porcentajeproducto']").each(function(i, obj) {
			contador += parseInt(obj.value);
		});
		if (contador > 100) {
			alert("La suma no debe exceder del 100%");
		}
	} else {
		contador = 0;
		$("input[name^='porcentajeproducto']").each(function(i, obj) {
			contador += parseInt(obj.value);
		});
		if (contador > 100) {
			alert("La suma no debe exceder del 100%");
		}
		//console.log($('#porcentajeproducto'+pad(fila, 2)).val());
		valor_procentaje = $('#porcentajeproducto'+pad(fila, 2)).val()/100*($("#input_peso_a_cobrar").val());
		$('#peso_aprox_'+pad(fila, 2)).val(Math.round(valor_procentaje)+ " kg");
	}
}

function simulaEmitirBoleta() {
	alert("Generar Boleta...");
}

function simulaEmitirFactura() {
	alert("Generar Factura...");
}

// Codigo Alternativo para Autocompletar con Ajax para el producto
$(document).ready(function () {

	// Poner el foco en la placa
	//$('#numero_placa').focus();

	// El brevete, nombre, apellidis deben estar escritos con mayuscula 
	$(function() {
		$('#modalChoferForm #nro_brevete').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
	$(function() {
		$('#modalChoferForm #apellido_paterno').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
	$(function() {
		$('#modalChoferForm #apellido_materno').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
	$(function() {
		$('#modalChoferForm #nombres_chofer').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
	$(function() {
		$('#modalPersonaForm #apellido_paterno').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
	$(function() {
		$('#modalPersonaForm #apellido_materno').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
	$(function() {
		$('#modalPersonaForm #nombres_chofer').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
	$(function() {
		$('#empresa_razon_social').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
	$(function() {
		$('#modalEmpresaForm #empresa_razon_social').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
	$(function() {
		$('#vehiculo_numero_placa').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
	$(function() {
		$('#vehiculo_empresa').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
	$(function() {
		$('#producto01').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
	$(function() {
		$('#empresa_persona').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
	$(function() {
		$('#empresa_nuevo_dueno_carga').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
	$(function() {
		$('#persona_nuevo_dueno_carga').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});

	$('#modalChoferSaveBtn').click(function (e) {
		e.preventDefault();
		$(this).html('Enviando datos..');
	
		$.ajax({
		  data: $('#modalChoferForm').serialize(),
		  url: "/afiliacion/send_ajax",
		  type: "POST",
		  dataType: 'json',
		  success: function (data) {
	
			  $('#modalPersonaForm').trigger("reset");
			  $('#choferModal').modal('hide');

			  var mySelect = $('#lista_chofer');
			  mySelect.append(
				  $('<option></option>').val(data.persona_id).html(data.nombre_apellido)
			  );
			  alert("El chofer ha sido ingresado correctamente!");

	
		  },
		  error: function(data) {
        mensaje = "Revisar el formulario:\n\n";
        $.each( data["responseJSON"].errors, function( key, value ) {
          mensaje += value +"\n";
        });
        $("#modalChoferSaveBtn").html("Grabar");
        alert(mensaje);
      }
	  });
    });
    
	$('#modalPersonaSaveBtn').click(function (e) {
		e.preventDefault();
		$(this).html('Enviando datos..');
	
		$.ajax({
		  data: $('#modalPersonaForm').serialize(),
		  url: "/afiliacion/nueva_persona_ajax",
		  type: "POST",
		  dataType: 'json',
		  success: function (data) {
	
			  $('#modalPersonaForm').trigger("reset");
              $('#personaModal').modal('hide');
			  $('#numero_documento').val(data.numero_documento);
			  $('#persona_id').val(data.persona_id);
			  $("#id_ubicacion").val(data.ubicacion_id);//
              $('#nombres_razon_social').val(data.nombre_apellido);

			  alert("La persona ha sido ingresada correctamente!");
	
		  },
		  error: function(data) {
        mensaje = "Revisar el formulario:\n\n";
        $.each( data["responseJSON"].errors, function( key, value ) {
          mensaje += value +"\n";
        });
        $("#modalPersonaSaveBtn").html("Grabar");
        alert(mensaje);
      }
	  });
	});
    
	$('#modalPersonaCarretaSaveBtn').click(function (e) {
		e.preventDefault();
		$(this).html('Enviando datos..');
	
		$.ajax({
		  data: $('#modalPersonaForm').serialize(),
		  url: "/afiliacion/nueva_persona_ajax",
		  type: "POST",
		  dataType: 'json',
		  success: function (data) {
	
			  $('#modalPersonaForm').trigger("reset");
              $('#personaModal').modal('hide');
			  $('#numero_documento').val(data.numero_documento);
			  $('#persona_id').val(data.persona_id);
			  $('#nombres_razon_social').val(data.nombre_apellido);
			  $('#id_ubicacion').val(3070);

			  alert("La persona ha sido ingresada correctamente!");
	
		  },
		  error: function(data) {
        mensaje = "Revisar el formulario:\n\n";
        $.each( data["responseJSON"].errors, function( key, value ) {
          mensaje += value +"\n";
        });
        $("#modalPersonaSaveBtn").html("Grabar");
        alert(mensaje);
      }
	  });
	});
	
	$('#modalNuevoDuenoCargaCancelBtn').click(function (e) {
		$("#modalNuevoDuenoCargaSaveBtn").removeClass('btn-success').addClass('btn-primary');
		$("#modalNuevoDuenoCargaSaveBtn").html("Buscar");
		$("#numero_ruc_dni").val("");
		$("#empresa_nuevo_dueno_carga").val("");
		$("#persona_nuevo_dueno_carga").val("");
	});

	$('#modalNuevoDuenoCargaSaveBtn').click(function (e) {
        e.preventDefault();
        if ($("#modalNuevoDuenoCargaSaveBtn").html() != "Confirmar datos") {

            $(this).html('Realizando la consulta..');
			var empresa_id = $('#empresa_id').val();
            $.ajax({
              data: $('#modalNuevoDuenoCargaForm').serialize()+"&empresa_id="+empresa_id,
              url: "/empresa/buscar_ajax",
              type: "POST",
              dataType: 'json',
              success: function (data) {
        
                //   $('#modalNuevoDuenoCargaForm').trigger("reset");
                //   $('#duenoCargaModal').modal('hide');
    
                 //alert(data.msg);
                
                if (typeof data.ruc != "undefined") {
                    $("#numero_ruc_dni").val(data.ruc);
                } else {
                    $("#numero_ruc_dni").val(data.numero_documento);
                }
                
                $("#empresa_nuevo_dueno_carga").val(data.razon_social);
                $("#persona_nuevo_dueno_carga").val(data.nombre_completo);
                $("#empresa_direccion").val(data.direccion);
                $("#email").val(data.email);
				$("#persona_id").val(data.persona_id);
				$("#id_ubicacion").val(data.ubicacion_id);
                
                if (typeof data.ruc !== "undefined") {
                    $("#modalNuevoDuenoCargaSaveBtn").removeClass('btn-primary').addClass('btn-success');
                    $("#modalNuevoDuenoCargaSaveBtn").html("Confirmar datos");
                } else if (typeof data.numero_documento !== "undefined") {
                    $("#modalNuevoDuenoCargaSaveBtn").removeClass('btn-primary').addClass('btn-success');
                    $("#modalNuevoDuenoCargaSaveBtn").html("Confirmar datos");
                } else {
                    alert(data.msg);
                    if (data.nueva != "") {
                        $("#modalNuevoEmpresaPersonaBtn").html("Nueva "+data.nueva);
                        $("#modalNuevoEmpresaPersonaBtn").show();
                        // $('#empresa_numero_ruc').val(data.numero_ruc_dni);
                        // $('#numero_documento_nueva_persona').val(data.numero_ruc_dni);
                    }

                    $("#modalNuevoDuenoCargaSaveBtn").removeClass('btn-success').addClass('btn-primary');
                    $("#modalNuevoDuenoCargaSaveBtn").html("Buscar");
                }
        
              },
              error: function(data) {
                mensaje = "Revisar el formulario:\n\n";
                $.each( data["responseJSON"].errors, function( key, value ) {
                mensaje += value +"\n";
                });
                $("#modalNuevoDuenoCargaSaveBtn").html("Buscar");
                alert(mensaje);
          }
          });
        } else {
            if ($("#persona_nuevo_dueno_carga").val() == '') {
                $("#badge_particular").removeClass("badge-success");
                $("#badge_empresa").addClass("badge-success");
                $("#btn_boleta").attr("style", "display:none");
                $("#btn_factura").attr("style", "display:");
            } else {
                $("#badge_empresa").removeClass("badge-success");
                $("#badge_particular").addClass("badge-success");
                $("#btn_boleta").attr("style", "display:");
                $("#btn_factura").attr("style", "display:none");
            }

            // Carga los datos en el formulario padre
            $("#numero_documento").val($("#numero_ruc_dni").val());
            $("#nombres_razon_social").val($("#empresa_nuevo_dueno_carga").val()+$("#persona_nuevo_dueno_carga").val());
            // Reinicia el formulario modal
            $("#empresa_nuevo_dueno_carga").attr("style", "display:block");
            $("#persona_nuevo_dueno_carga").attr("style", "display:none");
            $("#modalNuevoDuenoCargaSaveBtn").html("Buscar");
            $("#modalNuevoDuenoCargaSaveBtn").removeClass('btn-success').addClass('btn-primary');
            $('#modalNuevoDuenoCargaForm').trigger("reset");
            $('#duenoCargaModal').modal('hide');            
        }
	});


    $("#modalNuevoEmpresaPersonaBtn").click(function (e) {
        e.preventDefault();
        $('#duenoCargaModal').modal('hide');
        if ($("#modalNuevoEmpresaPersonaBtn").html() == "Nueva persona") {
            $('#personaModal').modal('show');
        } else {
            $('#empresaNuevaModal').modal('show');
        }
	});

	$('#modalNuevaEmpresaSaveBtn').click(function (e) {
		e.preventDefault();
		$(this).html('Enviando datos..');
	
		$.ajax({
		  data: $('#modalNuevaEmpresaForm').serialize(),
		  url: "/empresa/send_nueva_empresa_ajax",
		  type: "POST",
		  dataType: 'json',
		  success: function (data) {
	
			  $('#modalNuevaEmpresaForm').trigger("reset");
              $('#empresaNuevaModal').modal('hide');
              $('#numero_documento').val(data.ruc);
              $('#nombres_razon_social').val(data.razon_social);
              $('#empresa_direccion').val(data.direccion);
              $('#email').val(data.email);
			  $('#id_ubicacion').val(data.id_ubicacion);
              $('#persona_id').val('0');
              $('#modalNuevoEmpresaPersonaBtn').hide();

			  alert(data.msg);
              $("#modalNuevaEmpresaSaveBtn").html("Grabar");
	
		  },
		  error: function(data) {
        mensaje = "Revisar el formulario:\n\n";
        $.each( data["responseJSON"].errors, function( key, value ) {
          mensaje += value +"\n";
        });
        $("#modalNuevaEmpresaSaveBtn").html("Grabar");
        alert(mensaje);
      }
	  });
    });
    
	$('#modalEmpresaSaveBtn').click(function (e) {
		e.preventDefault();
		$(this).html('Enviando datos..');
	
		$.ajax({
		  data: $('#modalEmpresaForm').serialize(),
		  url: "/empresa/send_ajax",
		  type: "POST",
		  dataType: 'json',
		  success: function (data) {
	
			  $('#modalEmpresaForm').trigger("reset");
			  $('#empresaModal').modal('hide');

			  alert(data.msg);
              $("#modalEmpresaSaveBtn").html("Grabar");
	
		  },
		  error: function(data) {
        mensaje = "Revisar el formulario:\n\n";
        $.each( data["responseJSON"].errors, function( key, value ) {
          mensaje += value +"\n";
        });
        $("#modalEmpresaSaveBtn").html("Grabar");
        alert(mensaje);
      }
	  });
	});

	$('#modalVehiculoSaveBtn').click(function (e) {
		e.preventDefault();
		$(this).html('Enviando datos..');
	
		$.ajax({
		  data: $('#modalVehiculoForm').serialize(),
		  url: "/vehiculo/send_ajax",
		  type: "POST",
		  dataType: 'json',
		  success: function (data) {
	
			  $('#modalVehiculoForm').trigger("reset");
			  $('#vehiculoModal').modal('hide');

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

	$('#vehiculo_empresa').focusin(function() { $('#vehiculo_empresa').select(); });

	$('#empresa_nuevo_dueno_carga').focusin(function() { $('#empresa_nuevo_dueno_carga').select(); });

	$('#persona_nuevo_dueno_carga').focusin(function() { $('#persona_nuevo_dueno_carga').select(); });
	
	$('#vehiculo_empresa').autocomplete({
	appendTo: "#vehiculo_empresa_busqueda",
    source: function(request, response) {
        $.ajax({
        url: 'list/'+$('#vehiculo_empresa').val(),
        dataType: "json",
        success: function(data){
        // alert(JSON.stringify(data));
           var resp = $.map(data,function(obj){
                // console.log(obj.id);
				var hash = {key: obj.id, value: obj.razon_social};
				if(obj.razon_social=='') { actualiza_ruc("") }
                return hash;
           }); 
           //alert(JSON.stringify(resp));
           //console.log(JSON.stringify(resp));
           response(resp);
		},
		error: function() {
			actualiza_ruc("");
		}
    });
    },
    select: function (event, ui) {
      // $("#vehiculo_empresa").val(ui.item.value);
	  $('#vehiculo_empresa').blur();
	  //alert(ui.item.value);
	  if (ui.item.value != ''){
		actualiza_ruc(ui.item.value);
		$("#modalVehiculoSaveBtn").attr("disabled", false);;
	  }
      $("#vehiculo_empresa_id").val(ui.item.key); // save selected id to hidden input
	  
    },
		minLength: 2,
		delay: 100
  });


	$('#empresa_nuevo_dueno_carga').autocomplete({
		appendTo: "#empresa_nuevo_dueno_carga_busqueda",
		source: function(request, response) {
			$.ajax({
			url: 'list/'+$('#empresa_nuevo_dueno_carga').val(),
			dataType: "json",
			success: function(data){
			// alert(JSON.stringify(data));
			   var resp = $.map(data,function(obj){
					// console.log(obj.id);
					var hash = {key: obj.id, direccion: obj.direccion, ruc: obj.ruc, razon_social: obj.razon_social, value: obj.razon_social, id_ubicacion: obj.id_ubicacion};
					return hash;
			   }); 
			   //alert(JSON.stringify(resp));
			   console.log(JSON.stringify(resp));
			   response(resp);
			}
		});
		},
		select: function (event, ui) {
		  // $("#vehiculo_empresa").val(ui.item.value);
		  // $('#vehiculo_empresa').blur();
		  //alert(ui.item.id_ubicacion); 
		  $("#id_ubicacion").val(ui.item.id_ubicacion);
		  $('#persona_id').val(0);
		  $("#numero_ruc_dni").val(ui.item.ruc); // save selected id to hidden input
  		  $("#modalNuevoDuenoCargaSaveBtn").removeClass('btn-primary').addClass('btn-success');
		  $("#modalNuevoDuenoCargaSaveBtn").html("Confirmar datos");
		  
		},
			minLength: 2,
			delay: 100
	  });

      $('#persona_nuevo_dueno_carga').autocomplete({
		appendTo: "#empresa_nuevo_dueno_carga_busqueda",
		source: function(request, response) {
			$.ajax({
			url: 'listar_personas/'+$('#persona_nuevo_dueno_carga').val(),
			dataType: "json",
			success: function(data){
			// alert(JSON.stringify(data));
			   var resp = $.map(data,function(obj){
					// console.log(obj.id);
					var hash = {key: obj.id, numero_documento: obj.numero_documento, value: obj.apellido_paterno+" "+obj.apellido_materno+", "+obj.nombres,id_ubicacion:obj.id_ubicacion};
					return hash;
			   }); 
			   //alert(JSON.stringify(resp));
			   console.log(JSON.stringify(resp));
			   response(resp);
			}
		});
		},
		select: function (event, ui) {
		  // $("#vehiculo_empresa").val(ui.item.value);
		  // $('#vehiculo_empresa').blur();
		  $("#id_ubicacion").val(ui.item.id_ubicacion);
		  $('#persona_id').val(ui.item.key);
		  $("#numero_ruc_dni").val(ui.item.numero_documento); // save selected id to hidden input
  		  $("#modalNuevoDuenoCargaSaveBtn").removeClass('btn-primary').addClass('btn-success');
		  $("#modalNuevoDuenoCargaSaveBtn").html("Confirmar datos");
		},
			minLength: 4,
			delay: 100
      });
      
	$('#producto01').autocomplete({
		appendTo: "#producto01_list",
		source: function(request, response) {
			$.ajax({
			url: 'producto/'+$('#producto01').val(),
			dataType: "json",
			success: function(data){
        // alert(JSON.stringify(data));
          var resp = $.map(data,function(obj){
            console.log(obj);
            return obj.denominacion;
          }); 
          //alert(JSON.stringify(resp));
          //console.log(JSON.stringify(resp));
          response(resp);
        }
      });
      },
    minLength: 1,
    delay: 100
        });
        
    $('#btn_guardar').click(function (e) {
        e.preventDefault();
        msg = "";

        if ($("#numero_placa").val() == '') {
            msg += "\nIngrese el numero de placa";
        }
        if ($("#nombre_empresa").val() == '') {
            msg += "\nIngrese el nombre de empresa del vehículo";
        }
        if ($("#procedencia").val() == '0') {
            msg += "\nElija la procedencia de la carga";
        }
        if ($("#lista_chofer").val() == '') {
            msg += "\nElija un conductor";
        }
        if ($("#numero_documento").val() == '' || $("#nombres_razon_social").val() == '') {
            msg += "\nElija un dueño de carga";
        }
        if ($("#producto01").val() == '') {
            msg += "\nElija un al menos un producto en la declaración de carga";
        }

        if (msg != "") {
            alert("Atencion, faltan los siguientes datos:\n"+msg);
        } else {
            

        if ($("#boton_pesar").html() == "PESAR_INGRESO") {
            alert("Aun no ha pesado el ingreso");
        } else {
            $.ajax({
                data: $('#frmPesaje').serialize(),
                url: "/vehiculo/ingreso_ajax",
                type: "POST",
                dataType: 'json',
                success: function (data) {
            
                        $('#modalVehiculoForm').trigger("reset");
                        $('#vehiculoModal').modal('hide');
                
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
        }


            $("#btn_boleta").prop('disabled', false);
            $("#btn_factura").prop('disabled', false);
        }
    });
        
});

// Manejar Ajax para mandar datos del Formulario Modal


function guardarPesajeCarreta(){
    
    var msg = "";
	var persona_id = $('#persona_id').val();
	var precio_peso = $('#precio_peso').val();
	
	if(persona_id == "")msg += "Debe buscar un Numero de Documento <br>";
	if(precio_peso == "" || precio_peso == "0")msg += "Debe ingresar un Importe de Pago <br>";
	
    if(msg!=""){
        bootbox.alert(msg); 
        return false;
    }
    else{
        fn_save_pesaje_carreta();
	}
	
	//fn_save_pesaje_carreta();
}

function fn_save_pesaje_carreta(){
    
    //var fecha_atencion_original = $('#fecha_atencion').val();
	//var id_user = $('#id_user').val();
    $.ajax({
			url: "/pesaje/send_pesaje_carreta",
            type: "POST",
            //data : $("#frmCita").serialize()+"&id_medico="+id_medico+"&fecha_cita="+fecha_cita,
            data : $("#frmPesajeCarreta").serialize(),
            success: function (result) {
					
					location.href="/pesaje/ver_pesaje_carreta/"+result;
            }
    });
}

function guardarPesaje(){
    
    var msg = "";
	var persona_id = $('#persona_id').val();
	var procedencia = $('#procedencia').val();
	var peso_valor = $('#input_peso_ingreso').val();
	var lista_chofer = $('#lista_chofer').val();
	//var precio_peso = $('#precio_peso').val();
	var tipo_comercio = $("#tipo_comercio").val();
	
	if(persona_id == "")msg += "Debe buscar un Numero de Documento <br>";
	if(procedencia == "0")msg += "Debe seleccionar una Procedencia <br>";
	if(peso_valor  =='')msg+=" No hay peso en la Balanza<br>";
	if(lista_chofer == "" || lista_chofer == "0")msg += "Debe seleccionar un conductor <br>";
	//if(precio_peso == "" || precio_peso == "0")msg += "Debe ingresar un Importe de Pago <br>";
	
	if(tipo_comercio!="recarga"){	
		var ind = $('#tblProductos thead tr').length;
		fila_productos=$('#tblProductos thead').children('tr');
		var cantidad_prod = 0;
		var cantidad_porc = 0;
		for (i = 1; i < ind; i++) {
			fila_producto=fila_productos[i];
			var producto = $(fila_producto).find('input[name="producto[]"]').val();
			var porcentajeproducto = $(fila_producto).find('input[name="porcentajeproducto[]"]').val();	
			if(producto == "" && cantidad_prod == 0){
				msg+="La declaracion de carga no cuenta con nombre del producto<br>";
				cantidad_prod++;
			}
			if(porcentajeproducto == "" && cantidad_porc == 0){
				msg+="La declaracion de carga no cuenta con porcentaje del producto<br>";
				cantidad_porc++;
			}
		}
	}
	
    if(msg!=""){
        bootbox.alert(msg); 
        return false;
    }
    else{
        fn_save_pesaje();
	}
	
	//fn_save_pesaje_carreta();
}

function fn_save_pesaje(){
    
    //var fecha_atencion_original = $('#fecha_atencion').val();
	//var id_user = $('#id_user').val();
	var input_peso_salida = $('#input_peso_salida').val();
    $.ajax({
			url: "/pesaje/send_pesaje",
            type: "POST",
            //data : $("#frmCita").serialize()+"&id_medico="+id_medico+"&fecha_cita="+fecha_cita,
            data : $("#frmPesaje").serialize(),
            success: function (result) {
					
					if(input_peso_salida == "")location.href="/pesaje/create";
					else location.href="/pesaje/ver_pesaje/"+result;
            }
    });
}



function obtenerPeso(){ 
	
	var tipo_comercio = $("#tipo_comercio").val();
	var peso_seco = $("#peso_seco").val();
	var input_peso_ingreso = $("#input_peso_ingreso").val();
	var input_peso_salida = $("#input_peso_salida").val();
	
	if(input_peso_ingreso=="")input_peso_ingreso=0;
	if(input_peso_salida=="")input_peso_salida=0;
	
	/*
	if(tipo_comercio=="venta y recarga" && peso_seco==""){
		bootbox.alert("Debe ingresar el peso seco del vehiculo"); 
        return false;	
	}
	*/
	if(peso_seco==""){
		bootbox.alert("Debe ingresar el peso seco del vehiculo obligatoriamente"); 
        return false;	
	}
	

	if ($('#boton_pesar').html()=="PESAR_SALIDA") {
		$.ajax({
			url: '/pesaje/obtener_peso/'+$('#id_ingreso_vehiculo').val()+'/'+input_peso_salida,
			dataType: 'json',
			type: 'GET',
			success: function(result){
				//alert(result);
				//$('#boton_pesar').html("PESAR SALIDA");
				var tipo_comercio = $("#tipo_comercio").val();
				var peso_seco = $("#peso_seco").val();
				var peso = "";
				//alert(tipo_comercio);
				var exonerado = $("#exonerado").val();
				if(tipo_comercio=="venta y recarga"){
					peso = peso_seco;
					$('#fila_venta_recarga').show();
					$('input[name="mov[3][importe]"]').val(33);
					$('#input_precio_venta_recarga').val(33);
					$('#precio_venta_recarga').html("33.00");
					input_precio_venta_recarga = parseFloat($('#input_precio_venta_recarga').val());
					//$('#fila_sobreestadia')
				}else{ 
					peso = result.peso;
					$('#fila_venta_recarga').hide();
					$('input[name="mov[3][importe]"]').val(0);
					$('#input_precio_venta_recarga').val(0);
					$('#precio_venta_recarga').html(0);
					input_precio_venta_recarga = parseFloat($('#input_precio_venta_recarga').val());
					
					venta_minima = result.venta_minima;
					if(venta_minima==true){
						$('#venta_minima').html("Venta Minima");
					}
				}
				
				$('#peso_salida').html(peso+" kg");
				$('#input_peso_salida').val(peso);
				
				var d = new Date(result.fecha);

				$('#fecha_salida').html("fecha: "+pad(d.getDate(),2)+"/"+pad(d.getMonth()+1,2)+"/"+d.getFullYear()+" "+pad(d.getHours(),2)+":"+pad(d.getMinutes(),2)+":"+pad(d.getSeconds(),2));
				$('#input_fecha_salida').val(result.fecha); 
				
				var peso_neto = "";
				if(tipo_comercio=="recarga")peso_neto = parseInt($('#input_peso_salida').val())-parseInt($('#input_peso_ingreso').val());
				else peso_neto = parseInt($('#input_peso_ingreso').val())-parseInt($('#input_peso_salida').val());
				//alert(peso_neto);
				$('#peso_neto').html(peso_neto+" kg");
				$('#input_peso_neto').val(peso_neto);
				
				if(tipo_comercio!="hielo" && tipo_comercio!="recarga" && tipo_comercio!="venta y recarga"){
					
					$('#dcto_por_hielo').html(0.1*peso_neto+" kg");
					$('#input_dcto_por_hielo').val(0.1*peso_neto);
				
					$('#peso_a_cobrar').html(0.9*peso_neto+" kg");
					$('#input_peso_a_cobrar').val(0.9*peso_neto);
				}else{
					$('#peso_a_cobrar').html(peso_neto+" kg");
					$('#input_peso_a_cobrar').val(peso_neto);
				}
				
				dias_horas = duration($('#input_fecha_ingreso').val(),$('#input_fecha_salida').val());
				
				dias = (typeof dias_horas.days == "undefined")?0:dias_horas.days;
				horas = (typeof dias_horas.hours == "undefined")?0:dias_horas.hours;
				minutos = (typeof dias_horas.minutes == "undefined")?0:dias_horas.minutes;

				$('#estadia').html(dias + " dias, " + horas + " horas y "+ minutos +" minutos");
				$('#input_estadia').val(dias + " dias, " + horas + " horas y "+ minutos +" minutos");
				
				if(tipo_comercio!="hielo" && tipo_comercio!="recarga" && tipo_comercio!="venta y recarga"){
					$('#cantidad_peso').html((0.9*peso_neto/1000)); 
				}else{
					//if(tipo_comercio=="recarga")$('#cantidad_peso').html((-1)*(peso_neto/1000));
					//else $('#cantidad_peso').html((peso_neto/1000));
					
					if(tipo_comercio=="recarga"){
						$('#cantidad_peso').html(1); 
					}else{
						$('#cantidad_peso').html((peso_neto/1000));
					}
					
				}
				
				cantidad_peso = parseFloat($('#cantidad_peso').html());
				costo_tn = parseFloat($('#costo_tn').val());
				//alert(cantidad_peso);alert(costo_tn);
				$('#precio_peso').html((cantidad_peso*costo_tn).toFixed(2)); 
				$('#input_precio_peso').val($('#precio_peso').html());
				$('input[name="mov[0][importe]"]').val($('#precio_peso').html());

				costo_tonelaje = parseFloat($('#input_precio_peso').val());
				costo_estadia = parseFloat($('#costo_estadia').val());
				costo_sobreestadia = parseFloat($('#costo_sobreestadia').val());
				numero_ejes = parseFloat($("#numero_ejes").val());
				
				//if(tipo_comercio!="hielo" && tipo_comercio!="recarga"){
					
					$("#cantidad_dias").html((dias > 2)?"2":dias);
					//document.getElementById("cantidad_ejes").innerHTML = numero_ejes;
					//alert(horas);
					if(tipo_comercio!="recarga" || horas > 4){
						$("#precio_permanecia").html(costo_estadia.toFixed(2));
						$('input[name="mov[1][importe]"]').val(costo_estadia);
						$("#input_precio_permanecia").val(costo_estadia.toFixed(2));
					}
					
					
					if (dias>=2) {
						// alert("Se aplica sobreestadia.");
						//$('#fila_sobreestadia').css('visibility', '');
						$('#fila_sobreestadia').show();
						$("#cantidad_dias").html("2");
						//document.getElementById("cantidad_ejes").innerHTML = numero_ejes;
						dias_sobre_estadia = (dias-1>=0)?(dias-1):0;
						alert("Dias de sobre estadia: "+dias_sobre_estadia);
						$("#cantidad_dias_sobreestadia").html((dias-2) + " dias, " + horas + " horas y "+ minutos +" minutos");
						//document.getElementById("cantidad_ejes_sobreestadia").innerHTML = numero_ejes;
						$("#precio_permanecia_sobreestadia").html((costo_sobreestadia*dias_sobre_estadia).toFixed(2));
						$('input[name="mov[2][importe]"]').val(costo_sobreestadia*dias_sobre_estadia);
						$("#input_precio_permanecia_sobreestadia").val(costo_sobreestadia*dias_sobre_estadia);
						precio_total = costo_tonelaje + costo_estadia + costo_sobreestadia*dias_sobre_estadia;
					} else {
						if(tipo_comercio!="recarga" || horas > 4){
							precio_total = costo_tonelaje + costo_estadia;
						}else{
							precio_total = costo_tonelaje;
						}
					}
				//}else{
					//precio_total = costo_tonelaje;
				//}
				
				if(input_precio_venta_recarga>0){
					precio_total+=input_precio_venta_recarga;
					if(dias>=2)$('.item').html('4)');
				}

				$("#precio_total").html(precio_total.toFixed(2));
				$('#input_precio_total').val(precio_total.toFixed(2));

				precio_subtotal = precio_total/1.18;

				$("#precio_subtotal").html(precio_subtotal.toFixed(2));
				$('#input_precio_subtotal').val(precio_subtotal);

				precio_igv = precio_subtotal*0.18;

				$("#precio_igv").html(precio_igv.toFixed(2));
				$('#input_precio_igv').val(precio_igv.toFixed(2));


				$("input[name^=porcentajeproducto]").each(function (index)
				{
					$("#peso_aprox_"+pad((index+1),2)).val(parseFloat($(this).val())*parseFloat($("#input_peso_a_cobrar").val())/100+" kg");
				});
				
				if(exonerado=="S"){
					//alert(numero_placa);
					$('input[name="mov[0][importe]"]').val(0);
					$('input[name="mov[1][importe]"]').val(0);
					$('input[name="mov[2][importe]"]').val(0);
					$('input[name="mov[3][importe]"]').val(0);
					
					$('#input_precio_peso').val(0);
					$('#input_precio_permanecia').val(0);
					$('#input_precio_permanecia_sobreestadia').val(0);
					$('#input_precio_venta_recarga').val(0);
					
					$('#precio_peso').html(0);
					$('#precio_permanecia').html(0);
					$('#precio_permanecia_sobreestadia').html(0);
					$('#precio_venta_recarga').html(0);
					$('#precio_subtotal').html(0);
					$('#precio_igv').html(0);
					$('#precio_total').html(0);
					
					$('#msg_exonerado').html("Vehiculo Exonerado");
					
				}
				
				$("#btnGuardar").prop("disabled",false);
			
			}
			
		});
	} else {
		$.ajax({
			url: '/pesaje/obtener_peso/'+$('#id_ingreso_vehiculo').val()+'/'+input_peso_ingreso,
			dataType: 'json',
			type: 'GET',
			success: function(result){
				//alert(result);
				//$('#boton_pesar').html("PESAR SALIDA");
				$('#peso_ingreso').html(result.peso+" kg");
				$('#input_peso_ingreso').val(result.peso);
				
				var d = new Date(result.fecha);

				$('#fecha_ingreso').html("fecha: "+pad(d.getDate(),2)+"/"+pad(d.getMonth()+1,2)+"/"+d.getFullYear()+" "+pad(d.getHours(),2)+":"+pad(d.getMinutes(),2)+":"+pad(d.getSeconds(),2));
				$('#input_fecha_ingreso').val(result.fecha);
				
				$("#btnGuardar").prop("disabled",false);
			}
			
		});
	}

}

function duration(t0, t1){
    let d = (new Date(t1)) - (new Date(t0));
    let weekdays     = Math.floor(d/1000/60/60/24/7);
    let days         = Math.floor(d/1000/60/60/24 - weekdays*7);
    let hours        = Math.floor(d/1000/60/60    - weekdays*7*24            - days*24);
    let minutes      = Math.floor(d/1000/60       - weekdays*7*24*60         - days*24*60         - hours*60);
    let seconds      = Math.floor(d/1000          - weekdays*7*24*60*60      - days*24*60*60      - hours*60*60      - minutes*60);
    let milliseconds = Math.floor(d               - weekdays*7*24*60*60*1000 - days*24*60*60*1000 - hours*60*60*1000 - minutes*60*1000 - seconds*1000);
    let t = {};
    ['weekdays', 'days', 'hours', 'minutes', 'seconds', 'milliseconds'].forEach(q=>{ if (eval(q)>0) { t[q] = eval(q); } });
    return t;
}

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


function cargarServicioPesaje(peso_ingreso,fecha_ingreso){
    
	var tipo_comercio = $("#tipo_comercio").val();
	var flagBalanza = $("#flagBalanza").val();
    $("#cardPeso").html("");
	$.ajax({
			url: "/pesaje/obtener_pesaje_peso/"+tipo_comercio,
			type: "GET",
			success: function (result) {
					$("#cardPeso").html(result);
					if(peso_ingreso!=""){
						$('#peso_ingreso').html(peso_ingreso+" kg");
						$('#input_peso_ingreso').val(peso_ingreso);
					}
					if(fecha_ingreso!=""){
						var d = new Date(fecha_ingreso);
						$('#fecha_ingreso').html("fecha: "+pad(d.getDate(),2)+"/"+pad(d.getMonth()+1,2)+"/"+d.getFullYear()+" "+pad(d.getHours(),2)+":"+pad(d.getMinutes(),2)+":"+pad(d.getSeconds(),2));
						$('#input_fecha_ingreso').val(fecha_ingreso);
					}
					
					if(flagBalanza==2){
						var estado_pesaje = $('#estado_pesaje').val();
						if(estado_pesaje == 1){
							$("#input_peso_ingreso").attr("type","text");
							$("#peso_ingreso").hide();
							$("#input_peso_ingreso").blur(function(e) {
								obtenerPeso();
							})
						}else{							
							$("#input_peso_salida").prop("type","text");
							$("#peso_salida").hide();
							$("#input_peso_salida").blur(function(e) {
								obtenerPeso();
							})
						}
						
					}
					
			}
	});
	
	$("#cardPago").html("");
	$.ajax({
			url: "/pesaje/obtener_pesaje_pago/"+tipo_comercio,
			type: "GET",
			success: function (result) {  
					$("#cardPago").html(result);
			}
	});

}

function venta_recarga(){
	
	if($('#ventaRecarga').is(":checked")){
		var peso_seco = $('#peso_seco').val();
		//if(peso_seco=="")$('#peso_seco').attr("disabled",false);
		$('#tipo_comercio').val("venta y recarga").attr("disabled",true);
		//cargarServicioPesaje('','');
	}else{
		var tipo_comercio_tmp = $("#tipo_comercio_tmp").val();
		if(tipo_comercio_tmp=="")tipo_comercio_tmp="pescado";
		//$('#peso_seco').attr("disabled",true);
		$('#tipo_comercio').val(tipo_comercio_tmp).attr("disabled",false);
	}
	
	var peso_ingreso = $('#peso_ingreso_tmp').val();
	var fecha_ingreso = $('#fecha_ingreso_tmp').val();
	cargarServicioPesaje(peso_ingreso,fecha_ingreso);
	$("#btnGuardar").prop("disabled",true);
	
}


function guardarSolicitud(){
    
    var msg = "";
	var numero_documento = $('#numero_documento').val();
	var monto_solicitado = $('#monto_solicitado').val();
	var nro_cuota = $('#nro_cuota').val();
	var id_estado = $('#estado').val();
	
	if(numero_documento == "")msg += "Debe buscar un Numero de Documento <br>";
	if(monto_solicitado == "" || monto_solicitado == "0")msg += "Debe ingresar un Monto Solicitado <br>";
	if(nro_cuota == "" || nro_cuota == "0")msg += "Debe ingresar el Numero de Cuotas <br>";
	if(id_estado == 5)msg += "La solicitud ya se encuentra desembolsado <br>";
	
    if(msg!=""){
        bootbox.alert(msg); 
        return false;
    }
    else{
        fn_save_solicitud();
	}
	
	//fn_save_pesaje_carreta();
}

function fn_save_solicitud(){
    
    //var fecha_atencion_original = $('#fecha_atencion').val();
	//var id_user = $('#id_user').val();
    $.ajax({
			url: "/solicitud/send",
            type: "POST",
            //data : $("#frmCita").serialize()+"&id_medico="+id_medico+"&fecha_cita="+fecha_cita,
            data : $("#frmSolicitud").serialize(),
            success: function (result) {
					datatablenew();
					Limpiar();
					/*
					$('#tblProductos tbody').html("");
					$('#id_solicitud').val("0");
					$('#estado').val("0");
					$('#tipo_documento').val("DNI");
					$('#numero_documento').val("");
					$('#nombres').val("");
					$('#telefono').val("");
					$('#email').val("");
					$('#monto_solicitado').val("");
					$('#tiempo_pago').val("1");
					*/
            }
    });
}

function datatablenew(){
    var oTable = $('#tblSolicitud').dataTable({
        "bServerSide": true,
        "sAjaxSource": "/solicitud/listar_solicitud_ajax",
        "bProcessing": true,
        "sPaginationType": "full_numbers",
        "bFilter": false,
        "bSort": false,
        "info": true,
        "language": {"url": "/js/Spanish.json"},
        "autoWidth": false,
        "bLengthChange": true,
        "destroy": true,
        "lengthMenu": [[10, 50, 100, 200, 60000], [10, 50, 100, 200, "Todos"]],
        "aoColumns": [
                        {},
        ],
		"dom": '<"top">rt<"bottom"flpi><"clear">',
        "fnDrawCallback": function(json) {
            $('[data-toggle="tooltip"]').tooltip();
        },

        "fnServerData": function (sSource, aoData, fnCallback, oSettings) {

            var sEcho           = aoData[0].value;
            var iNroPagina 	= parseFloat(fn_util_obtieneNroPagina(aoData[3].value, aoData[4].value)).toFixed();
            var iCantMostrar 	= aoData[4].value;
			
			var numero_documento = $('#numero_documento_buscar').val();
			var nombre = $('#nombre_buscar').val();
			var fecha_desde = $('#fecha_desde').val();
			var fecha_hasta = $('#fecha_hasta').val();
			var id_estado = $('#id_estado').val();
			
			var _token = $('#_token').val();
            oSettings.jqXHR = $.ajax({
				"dataType": 'json',
                "type": "POST",
                "url": sSource,
                "data":{NumeroPagina:iNroPagina,NumeroRegistros:iCantMostrar,
						numero_documento:numero_documento,nombre:nombre,
						fecha_desde:fecha_desde,fecha_hasta:fecha_hasta,id_estado:id_estado,
						_token:_token
                       },
                "success": function (result) {
                    fnCallback(result);
					
					//var moneda = result.aaData[0].moneda;
					//alert(moneda);
					
					
                },
                "error": function (msg, textStatus, errorThrown) {
                }
            });
        },
		"fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			if (aData.moneda == "DOLARES") {
				$('td', nRow).addClass('verde');
			} 
		},
        "aoColumnDefs":
            [	
			 	{
                "mRender": function (data, type, row, meta) {
					
					//var rowIndex = meta.row+1;
					//alert(rowIndex);
            		//$('#tblSolicitud tbody tr:nth-child('+rowIndex+')').addClass('verde');
					//$(row).addClass('verde');
			
                	var id = "";
					if(row.id!= null)id = row.id;
					return id;
                },
                "bSortable": false,
                "aTargets": [0]
                },
				{
                "mRender": function (data, type, row) {
                	var fecha_solicitud = "";
					if(row.fecha_solicitud!= null)fecha_solicitud = row.fecha_solicitud;
					return fecha_solicitud;
                },
                "bSortable": false,
                "aTargets": [1],
				//"className": "dt-center",
				//"className": 'control'
                },
				{
                "mRender": function (data, type, row) {
					var numero_documento = "";
					if(row.numero_documento!= null)numero_documento = row.numero_documento;
					return numero_documento;
                },
                "bSortable": false,
                "aTargets": [2],
                },
				{
                "mRender": function (data, type, row) {
                    var nombre = "";
					if(row.nombres!= null)nombre = row.nombres+" "+row.apellido_paterno+" "+row.apellido_materno;
					return nombre;
                },
                "bSortable": false,
                "aTargets": [3]
                },
                /*{
                "mRender": function (data, type, row) {
					var origen = "";
					if(row.origen!= null)origen = row.origen;
					return origen;
                },
                "bSortable": false,
                "aTargets": [4],
                },*/
                {
                "mRender": function (data, type, row) {
                	var motivo = "";
					if(row.motivo!= null)motivo = row.motivo;
					return motivo;
                },
                "bSortable": false,
                "aTargets": [4]
                },
				{
                "mRender": function (data, type, row) {
                	var tiempo_pago = "";
					if(row.tiempo_pago!= null)tiempo_pago = row.tiempo_pago;
					return tiempo_pago;
                },
                "bSortable": false,
                "aTargets": [5]
                },
				{
                "mRender": function (data, type, row) {
                	var periodo = "";
					if(row.periodo!= null)periodo = row.periodo;
					return periodo;
                },
                "bSortable": false,
                "aTargets": [6]
                },
				{
                "mRender": function (data, type, row) {
                	var nro_cuota = "";
					//if(row.periodo_valor!= null)cuotas = row.periodo_valor * row.tiempo_pago;
					if(row.nro_cuota!= null)nro_cuota = row.nro_cuota;
					return nro_cuota;
                },
                "bSortable": false,
                "aTargets": [7]
                },
				{
                "mRender": function (data, type, row) {
                	var moneda = "";
					if(row.moneda!= null)moneda = row.moneda;
					return moneda;
                },
                "bSortable": false,
                "aTargets": [8]
                },
				{
                "mRender": function (data, type, row) {
                	var monto_solicitado = "";
					if(row.monto_solicitado!= null)monto_solicitado = row.monto_solicitado;
					return monto_solicitado;
                },
                "bSortable": false,
                "aTargets": [9],
				"className": "dt-center",
                },
				{
                "mRender": function (data, type, row) {
                	var monto_valorizado = "";
					if(row.monto_valorizado!= null)monto_valorizado = row.monto_valorizado;
					return monto_valorizado;
                },
                "bSortable": false,
                "aTargets": [10],
				"className": "dt-center",
                },
				{
                "mRender": function (data, type, row) {
                	var monto_aprobado = "";
					if(row.monto_aprobado!= null)monto_aprobado = row.monto_aprobado;
					return monto_aprobado;
                },
                "bSortable": false,
                "aTargets": [11],
				"className": "dt-center",
                },
				{
                "mRender": function (data, type, row) {
                    var estado = "";
					if(row.id_estado!= null){
						if(row.id_estado==1)estado = "PENDIENTE";
						if(row.id_estado==2)estado = "VALORIZADO";
						if(row.id_estado==3)estado = "APROBADO";
						if(row.id_estado==4)estado = "RECHAZADO";
						if(row.id_estado==5)estado = "DESEMBOLSADO";
						//if(row.id_estado==6)estado = "RECHAZADO";
					}
					return estado;
                },
                "bSortable": false,
                "aTargets": [12],
				"className": 'control'
                },
				
            ]


    });


	fn_util_LineaDatatable("#tblSolicitud");
	
    //$('#tblSolicitud tbody').on('dblclick', 'tr', function () {
	$('#tblSolicitud tbody').on('click', 'tr', function () {
        var anSelected = fn_util_ObtenerNumeroFila(oTable);
        if (anSelected.length != 0) {
			var odtable = $("#tblSolicitud").DataTable();
			var idSolicitud = odtable.row(this).data().id;
			var id_estado = odtable.row(this).data().id_estado;
			$('#estado').val(id_estado);
			//alert(idSolicitud);
			obtenerSolicitud(idSolicitud);
			
			//var iIdProducto = odtable.row(this).data().iIdProducto;
			//AsignarDatosProductoCompra(iIdProveedor,iIdProducto)
        }
    });
	
	if(aprobador == true){
		$('#tblSolicitud tbody').on('dblclick', 'tr', function () {
			var anSelected = fn_util_ObtenerNumeroFila(oTable);
			if (anSelected.length != 0) {
				var odtable = $("#tblSolicitud").DataTable();
				var idSolicitud = odtable.row(this).data().id;
				var id_estado = odtable.row(this).data().id_estado;
				if(id_estado == 5){
					bootbox.alert("La solicitud ya se encuentra desembolsado");
					return false;
				}else{
					modalSolicitud(idSolicitud);	
				}
				
			}
		});
	}
}


function modalSolicitud(idSolicitud){
	
	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/solicitud/modal_solicitud/"+idSolicitud,
			type: "GET",
			success: function (result) {  
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});

}


function fn_ListarBusqueda() {
    datatablenew();
};

function obtenerSolicitud(id){
	
	//$('#tblProductos tbody').html("");

	alert(id);
	exists();
	
	$.ajax({
		url: '/solicitud/obtener_solicitud/'+id,
		dataType: "json",
		success: function(result){
			var solicitud = result.solicitud;
			var garantia = result.garantia;
			var nombres = solicitud.apellido_paterno+" "+solicitud.apellido_materno+", "+solicitud.nombres;
			var disabled = "";
				
			$('#id_solicitud').val(id);
			$('#numero_documento').val(solicitud.numero_documento);
			$('#nombres').val(nombres);
			$('#telefono').val(solicitud.telefono);
			$('#email').val(solicitud.email);
			$('#monto_solicitado').val(solicitud.monto_solicitado);
			$('#tiempo_pago').val(solicitud.tiempo_pago);
			$('#id_motivo').val(solicitud.id_motivo);
			$('#id_moneda').val(solicitud.id_moneda);
			$('#freecuencia_pago').val(solicitud.freecuencia_pago);
			$('#nro_cuota').val(solicitud.nro_cuota);
			//obtener_cuota();
			
			if(valorizador==true){
				disabled = "disabled='disabled'";
				$('#tipo_documento').attr("disabled",true);
				$('#numero_documento').attr("disabled",true);
				$('#id_motivo').attr("disabled",true);
				$('#id_moneda').attr("disabled",true);
				$('#monto_solicitado').attr("disabled",true);
				$('#tiempo_pago').attr("disabled",true);
				$('#freecuencia_pago').attr("disabled",true);
			}
			
			
			var newRow = "";
			var tabindex = 11;
			var ind = $('#tblProductos tbody tr').length;
			
			$('#tblProductos tbody').html("");
			$(garantia).each(function (ii, obj) {
				
				var item_tipo 	= "";
				$('#idTipoGarantiaTemp option').each(function(){
					var sel = "";
					if(obj.id_tipo == $(this).val())sel = "selected='selected'";
					item_tipo += "<option value="+$(this).val()+" "+sel+" >"+$(this).html()+"</option>"	
				});
					
				newRow +='<tr>';
				newRow +='<td><input type="hidden" value="'+obj.id+'" id="id_garantia_detalle'+ind+'" name="id_garantia_detalle[]" />';
				newRow +='<select '+disabled+' class="form-control form-control-sm id_tipo" id="id_tipo'+ind+'" ind="'+ind+'" tabindex="'+tabindex+'" name="id_tipo[]">'+item_tipo+'</select></td>';
				newRow +='<td><input value="'+obj.descripcion+'" '+disabled+' onKeyPress="return soloNumerosMenosCero(event)" type="text" tabindex="'+(tabindex+2)+'" data-toggle="tooltip" data-placement="top" title="Ingresar la cantidad prescrita y presionar Enter para ingresar la cantidad entregada" name="descripcion[]" required="" id="descripcion'+ind+'" class="limpia_text nro_solicitado descripcion input-sm form-control form-control-sm text-left" style="margin-left:4px;" /></td>';
				newRow +='<td><input value="'+obj.valor_actual+'" '+disabled+' onKeyPress="return soloNumerosMenosCero(event)" type="text" tabindex="'+(tabindex+2)+'" data-toggle="tooltip" data-placement="top" title="Ingresar la cantidad prescrita y presionar Enter para ingresar la cantidad entregada" name="valor_actual[]" required="" id="valor_actual'+ind+'" class="limpia_text nro_solicitado valor_actual input-sm form-control form-control-sm text-right" style="margin-left:4px;" /></td>';
				if(valorizador==true){
					var valor_garantia = (obj.valor_garantia!=null && obj.valor_garantia!=0)?obj.valor_garantia:"";
					newRow +='<td><input value="'+valor_garantia+'" onKeyPress="return soloNumerosMenosCero(event)" type="text" tabindex="'+(tabindex+2)+'" data-toggle="tooltip" data-placement="top" title="Ingresar la cantidad prescrita y presionar Enter para ingresar la cantidad entregada" name="valor_garantia[]" required="" id="valor_garantia'+ind+'" class="limpia_text nro_solicitado valor_garantia input-sm form-control form-control-sm text-right" style="margin-left:4px;" /></td>';
				}
				newRow +='</tr>';
				ind++;
			});
			
			$('#tblProductos tbody').html(newRow);
			
		}
		
	});
	
}

function obtenerBeneficiario(){
		
	var tipo_documento = $("#tipo_documento").val();
	var numero_documento = $("#numero_documento").val();
	var msg = "";
	
	if (msg != "") {
		bootbox.alert(msg);
		return false;
	}
	
	$.ajax({
		url: '/persona/buscar_persona/' + tipo_documento + '/' + numero_documento,
		dataType: "json",
		success: function(result){
			
			if(result.sw==2){
				bootbox.alert("No es colaborador de Felmo, los datos han sido obtenidos de Reniec");
				$('#telefono').attr("disabled",false);
				$('#email').attr("disabled",false);
			}
			if(result.sw==3){
				bootbox.alert("El numero de documento no se encontro en Felmo ni en Reniec");
				//$('#numero_documento').val("");
				$('#numero_documento').attr("disabled",false);
				$('#nombres').attr("disabled",false).attr("placeholder","Ingrese Nombres");
				
				$('#divApellidoP').show();
				$('#divApellidoM').show();
				
				$('#apellidop').attr("placeholder","Apellido Paterno");
				$('#apellidom').attr("placeholder","Apellido Materno");
				
				$('#telefono').attr("disabled",false);
				$('#email').attr("disabled",false);
				
				return false;
			}
			
			var persona = result.persona;
			
			var nombre = persona.apellido_paterno+" "+persona.apellido_materno+", "+persona.nombres;
			$('#nombres').val(nombre);
			$('#telefono').val(persona.telefono);
			$('#email').val(persona.email);

		}
		
	});
	
}

function obtener_cuota(obj){
	var nombre = $(obj).attr('name');
	var freecuencia_pago = $('#freecuencia_pago option:selected').attr("codigo");
	
	if(nombre=="tiempo_pago"){
		var tiempo_pago = $('#tiempo_pago').val();
		var nro_cuota = freecuencia_pago * tiempo_pago;
		$('#nro_cuota').val(nro_cuota);
	}
	
	if(nombre=="nro_cuota"){
		var nro_cuota = $('#nro_cuota').val();
		var tiempo_pago = nro_cuota/freecuencia_pago;
		tiempo_pago = Math.round(tiempo_pago * 100) / 100;
		$('#tiempo_pago').val(tiempo_pago);
	}
	
	if(nombre=="freecuencia_pago"){
		$('#tiempo_pago').val("1");
		var tiempo_pago = $('#tiempo_pago').val();
		var nro_cuota = freecuencia_pago * tiempo_pago;
		$('#nro_cuota').val(nro_cuota);
	}
	
}

function Limpiar(){
	
	$('#tblProductos tbody').html("");
	$('#id_solicitud').val("0");
	$('#estado').val("0");
	$('#tipo_documento').val("DNI");
	$('#numero_documento').val("");
	$('#nombres').val("");
	$('#telefono').val("");
	$('#email').val("");
	$('#monto_solicitado').val("");
	$('#tiempo_pago').val("1");
	$('#nro_cuota').val("12");
	$('#freecuencia_pago').val("117");
	
	$('#telefono').attr("disabled",true);
	$('#email').attr("disabled",true);
	$('#nombres').attr("disabled",true).attr("placeholder","");
	
	$('#divApellidoP').hide();
	$('#divApellidoM').hide();
	$('#apellidop').val("");
	$('#apellidom').val("");
	
	
}

