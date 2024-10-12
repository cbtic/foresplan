
$(document).ready(function () {
	
	$('#btnBuscar').click(function () {
		fn_ListarBusqueda();
	});
	
	$('#btnEliminarBloque').click(function () {
		fn_eliminar_valorizacion_bloque();
	});
	
	$('#btnInactivarTarjetaBloque').click(function () {
		fn_eliminar_tarjeta_bloque();
	});
	
	$('#fecha_proceso').datepicker({
        autoclose: true,
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
    });
	
	$('#fecha_inicio').datepicker({
        autoclose: true,
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
    });
	
	$('#fecha_fin').datepicker({
        autoclose: true,
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
    });
	
	datatablenew();
	
	$('#example-select-all').on('click', function(){
		if($(this).is(':checked')){
			$('.mov').prop('checked', true);
		}else{
			$('.mov').prop('checked', false);
		}
		
		calcular_total();
		/*
		var total = 0;
		$(".mov:checked").each(function (){
			var val_total = $(this).parent().parent().parent().find('.val_total').html();
			total += Number(val_total); 
		});
		$('#total').val(total);
		*/
	});
});


function guardarValorizacion(){
    
    var msg = "";
    //var id_establecimiento = $('#id_establecimiento').val();
    //var id_servicio = $('#id_servicio').val();
	
	//if(dni_beneficiario == "")msg += "Debe ingresar el Numero de Documento <br>";
    //if(id_establecimiento=="")msg+="Debe seleccionar un Establecimiento<br>";
    //if(id_servicio=="")msg+="Debe ingresar un Servicio<br>";
	//if($('input[name=horario]').is(':checked')==false)msg+="Debe seleccionar un Turno<br>";
	/*
	if($('input[name=horario]').is(':checked')==true){
		var horario = $('input[name=horario]:checked').val();
		var data = horario.split("#");
		var fecha_cita = data[0];
		var id_medico = data[1];
	}
	*/

	/*
    if(msg!=""){
        bootbox.alert(msg); 
        return false;
    }
    else{
        fn_save();
	}
	*/
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
					cargarValorizacion();
					cargarPagos();
                    /*$('#openOverlayOpc').modal('hide');
					$('#calendar').fullCalendar("refetchEvents");
					modalDelegar(fecha_atencion_original);*/
					//modalTurnos();
					//modalHistorial();
					//location.href="ver_cita/"+id_user+"/"+result;
            }
    });
}


function aperturar(accion){
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
	
    //var fecha_atencion_original = $('#fecha_atencion').val();
	//var id_user = $('#id_user').val();
    $.ajax({
			url: "/ingreso/sendCaja",
            type: "POST",
            //data : $("#frmCita").serialize()+"&id_medico="+id_medico+"&fecha_cita="+fecha_cita,
            data : {accion:accion,id_caja:id_caja,saldo_inicial:saldo_inicial,total_recaudado:total_recaudado,saldo_total:saldo_total,estado:estado,_token:_token},
            success: function (result) {  
					//cargarValorizacion();
					//cargarPagos();
					location.reload();
              
            }
    });
}

function calcular_total(){
	var total = 0;
	var descuento = 0;
	var valor_venta_bruto = 0;
	var valor_venta = 0;
	var igv = 0;
	//var cantidad = $("#tblValorizacion input[type='checkbox']:checked").length;
	var cantidad = $(".mov:checked").length;
	//alert(cantidad);
	//$("#tblValorizacion input[type='checkbox']:checked").each(function (){
	$(".mov:checked").each(function (){
		var val_total = $(this).parent().parent().parent().find('.val_total').html();
		
		var val_descuento = $(this).parent().parent().parent().find('.val_descuento').html();
		
		if(val_descuento!="")
			{
				valor_venta_bruto = val_total/1.18;
				descuento = (val_total*val_descuento/100)/1.18;
				valor_venta = valor_venta_bruto - descuento;
				igv = valor_venta*0.18;
				total += igv + valor_venta_bruto - descuento;	
			}
		else{
				total += Number(val_total);
		}

	});
	//total -= descuento;
	$('#total').val(total.toFixed(2));
	if(cantidad > 1){
		$('#MonAd').attr("readonly",true);
		$('#MonAd').val("0");
	}else{
		$('#MonAd').attr("readonly",false);
		$('#MonAd').val(total.toFixed(2));
	}
	
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
	
	obtenerBeneficiario();
}

function obtenerBeneficiario(){
		
	var tipo_documento = $("#tipo_documento").val();
	var numero_documento = $("#numero_documento").val();
	var msg = "";
	
	if (msg != "") {
		bootbox.alert(msg);
		return false;
	}
	
	$('#empresa_id').val("");
	$('#persona_id').val("");

	$.ajax({
		url: '/afiliacion/obtener_afiliado/' + tipo_documento + '/' + numero_documento,
		dataType: "json",
		success: function(result){
			//alert(result.afiliado.id);
			
			if(tipo_documento == "RUC"){
				$('#empresa_afiliado').val(result.afiliado.razon_social);
				$('#empresa_direccion').val(result.afiliado.direccion);
				$('#empresa_representante').val(result.afiliado.representante);
				$('#empresa_id').val(result.afiliado.id);
				$('#id_ubicacion').val(result.afiliado.id_ubicacion);
			}else{
				var afiliado = result.afiliado.apellido_paterno+" "+result.afiliado.apellido_materno+", "+result.afiliado.nombres;
				$('#nombre_afiliado').val(afiliado);
				$('#codigo_afiliado').val(result.afiliado.codigo);	
				$('#empresa_afiliado').val(result.afiliado.razon_social);
				$('#fecha_afiliado').val(result.afiliado.fecha_inicio);
				$('#persona_id').val(result.afiliado.id);				
				$('#id_ubicacion').val(result.afiliado.id_ubicacion);
			}

			cargarValorizacion();
			cargarPagos();
			
		}
		
	});
	
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


function enviarTipo(tipo){
	if(tipo == 1)$('#TipoF').val("FTFT");
	if(tipo == 2)$('#TipoF').val("BVBV");
	if(tipo == 3)$('#TipoF').val("TKTK");
	validar();
}

function validar() {
	
	var msg = "";
	var sw = true;
	
	var MonAd = $('#MonAd').val();
	var total = $('#total').val();
	
	var tipo_documento = $('#tipo_documento').val();
    var persona_id = $('#persona_id').val();
	var empresa_id = $('#empresa_id').val();
	var mov = $('.mov:checked').length;
	
	if(tipo_documento != "RUC" && persona_id == "")msg += "Debe ingresar el Numero de Documento <br>";
	if(tipo_documento == "RUC" && empresa_id == "")msg += "Debe ingresar el Numero de Documento <br>";
	if(mov=="0")msg+="Debe seleccionar minimo un Concepto del Estado de Cuenta <br>";
	
	if(msg!=""){
		bootbox.alert(msg);
		//return false;
	} else {
		//submitFrm();
		document.frmValorizacion.submit();
	}
	return false;
}


function modalLiquidacion(id){
	
	$(".modal-dialog").css("width","80%");
	$('#openOverlayOpc').modal('show');
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/ingreso/modal_liquidacion/"+id,
			type: "GET",
			success: function (result) {  
					$("#diveditpregOpc").html(result);
			}
	});

}


function fn_ordenar(order){
	
	$('#order').val(order);
	var sort_ = $('#sort').val();
	//alert(sort_);
	if(sort_=="Asc")$('#sort').val("Desc");
	else $('#sort').val("Asc");
	
	datatablenew();
}

function datatablenew(){
    var oTable1 = $('#tblAfiliado').dataTable({
        "bServerSide": true,
        "sAjaxSource": "/ingreso/listar_estado_cuenta_ajax",
        "bProcessing": true,
        "sPaginationType": "full_numbers",
        //"paging":false,
        "bFilter": false,
        //"bSort": false,
		"bSort": false,
        "info": true,
		//"responsive": true,
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
			
			var afiliado = $('#afiliado').val();
            var numero_documento = $('#numero_documento').val();
            var tipo = $('#tipo').val();
			var periodo = $('#periodo').val();
			var fecha_proceso = $('#fecha_proceso').val();
			var fecha_inicio = $('#fecha_inicio').val();
			var fecha_fin = $('#fecha_fin').val();
			var pago = $('#pago').val();
			var order = $('#order').val();
			var sort_ = $('#sort').val();
			var flag_tarjeta = $('#flag_tarjeta').val();
			var _token = $('#_token').val();
            oSettings.jqXHR = $.ajax({
				"dataType": 'json',
                //"contentType": "application/json; charset=utf-8",
                "type": "POST",
                "url": sSource,
                "data":{NumeroPagina:iNroPagina,NumeroRegistros:iCantMostrar,
						afiliado:afiliado,numero_documento:numero_documento,tipo:tipo,periodo:periodo,fecha_inicio:fecha_inicio,fecha_fin:fecha_fin,
						pago:pago,order:order,sort_:sort_,flag_tarjeta:flag_tarjeta, 
						_token:_token
                       },
                "success": function (result) {
                    fnCallback(result);
                },
                "error": function (msg, textStatus, errorThrown) {
                    //location.href="login";
                }
            });
        },

        "aoColumnDefs":
            [	
			 	{
                "mRender": function (data, type, row) {
					var html = '';
					html += '<input type="checkbox" class="mov" name="mov[]" value="'+row.id+'" />';
					return html;
                },
                "bSortable": false,
                "aTargets": [0],
				"className": "dt-center",
				},
				{
                "mRender": function (data, type, row) {
                	var val_fecha = "";
					if(row.val_fecha!= null)val_fecha = row.val_fecha;
					return val_fecha;
                },
                "bSortable": false,
                "aTargets": [1],
				"className": "dt-center",
				"visible": $('#pago').val()=="N"?true:false,
                },
				{
                "mRender": function (data, type, row) {
                	var tipo_documento = "";
					if(row.tipo_documento!= null)tipo_documento = row.tipo_documento;
					return tipo_documento;
                },
                "bSortable": false,
                "aTargets": [2],
				"className": "dt-center",
                },
				{
                "mRender": function (data, type, row) {
                	var numero_documento = "";
					if(row.numero_documento!= null)numero_documento = row.numero_documento;
					return numero_documento;
                },
                "bSortable": false,
                "aTargets": [3],
				"className": "dt-center",
                },
                {
                "mRender": function (data, type, row) {
					var val_pac_nombre = "";
					if(row.val_pac_nombre!= null)val_pac_nombre = row.val_pac_nombre;
					return val_pac_nombre;
                },
                "bSortable": false,
                "aTargets": [4],
                },
				{
                "mRender": function (data, type, row) {
					var tarjeta = "";
					if(row.tarjeta!= null)tarjeta = row.tarjeta;
					return tarjeta;
                },
                "bSortable": false,
                "aTargets": [5],
                },
                {
                "mRender": function (data, type, row) {
                	var plan_denominacion = "";
					if(row.plan_denominacion!= null)plan_denominacion = row.plan_denominacion;
					return plan_denominacion;
                },
                "bSortable": false,
                "aTargets": [6]
                },
				{
                "mRender": function (data, type, row) {
                    var periodo = "";
					if(row.periodo!= null)periodo = row.periodo;
					return periodo;
                },
                "bSortable": false,
                "aTargets": [7]
                },
				{
                "mRender": function (data, type, row) {
                	var smod_control = "";
					if(row.smod_control!= null)smod_control = row.smod_control;
					return smod_control;
                },
                "bSortable": false,
                "aTargets": [8]
                },
				{
                "mRender": function (data, type, row) {
                	var vsm_smodulod = "";
					if(row.vsm_smodulod!= null)vsm_smodulod = row.vsm_smodulod;
					return vsm_smodulod;
                },
                "bSortable": false,
                "aTargets": [9],
				"visible": $('#pago').val()=="N"?true:false,
                },
				{
                "mRender": function (data, type, row) {
                    var descuento = "";
					if(row.descuento!= null)descuento = row.descuento;
					return descuento;
                },
                "bSortable": false,
                "aTargets": [10],
				"className": 'text-right',
				"visible": $('#pago').val()=="N"?true:false,
                },
				{
                "mRender": function (data, type, row) {
                    var vsm_precio = "";
					if(row.vsm_precio!= null)vsm_precio = row.vsm_precio;
					return vsm_precio;
                },
                "bSortable": false,
                "aTargets": [11],
				"className": 'text-right',
				"visible": $('#pago').val()=="N"?true:false,
                },
				{
                "mRender": function (data, type, row) {
                    var fac_fecha = "";
					if(row.fac_fecha!= null)fac_fecha = row.fac_fecha;
					return fac_fecha;
                },
                "bSortable": false,
                "aTargets": [12],
				"className": 'text-center',
				"visible": $('#pago').val()=="N"?false:true,
                },
				{
                "mRender": function (data, type, row) {
                    var fac_tipo = "";
					if(row.fac_tipo!= null)fac_tipo = row.fac_tipo;
					return fac_tipo;
                },
                "bSortable": false,
                "aTargets": [13],
				"className": 'text-center',
				"visible": $('#pago').val()=="N"?false:true,
                },
				{
                "mRender": function (data, type, row) {
                    var fac_serie = "";
					if(row.fac_serie!= null)fac_serie = row.fac_serie;
					return fac_serie;
                },
                "bSortable": false,
                "aTargets": [14],
				"className": 'text-center',
				"visible": $('#pago').val()=="N"?false:true,
                },
				{
                "mRender": function (data, type, row) {
                    var fac_numero = "";
					if(row.fac_numero!= null)fac_numero = row.fac_numero;
					return fac_numero;
                },
                "bSortable": false,
                "aTargets": [15],
				"className": 'text-center',
				"visible": $('#pago').val()=="N"?false:true,
                },
				{
                "mRender": function (data, type, row) {
                    var fac_total = "";
					if(row.fac_total!= null)fac_total = row.fac_total;
					return fac_total;
                },
                "bSortable": false,
                "aTargets": [16],
				"className": 'text-right',
				"visible": $('#pago').val()=="N"?false:true,
                },
				
            ]


    });

}

function fn_ListarBusqueda() {
    datatablenew();
};

function estadoCuentaAutomatico(){
    
	var fecha = $("#fecha_proceso").val();
	$.ajax({
			url: "/ingreso/estado_cuenta_automatico/"+fecha,
			type: "GET",
			success: function (result) {  
					datatablenew();
			}
	});

}

function reporteEstadoCuenta(){
	
	var tipo = $('#tipo').val();
	var afiliado = $('#afiliado').val();
	var numero_documento = $('#numero_documento').val();
	var periodo = $('#periodo').val();
	var fecha_inicio = $('#fecha_inicio').val();
	var fecha_fin = $('#fecha_fin').val();
	var pago = $('#pago').val();
	var order = $('#order').val();
	var sort_ = $('#sort').val();
	
	if (tipo == "")tipo = 0;
	if (afiliado == "")afiliado = 0;
	if (numero_documento == "")numero_documento = 0;
	if (periodo == "")periodo = 0;
	if (fecha_inicio == "")fecha_inicio = 0;
	if (fecha_fin == "")fecha_fin = 0;
	if (pago == "")pago = 0;
	if (order == "")order = 0;
	
	location.href = '/ingreso/exportar_estado_cuenta/' + tipo + '/' + afiliado + '/' + numero_documento + '/' + periodo + '/' + fecha_inicio + '/' + fecha_fin + '/' + pago + '/' + order + '/' + sort_;
	
}

function fn_eliminar_valorizacion_bloque(){
	
	var msgLoader = "";
	msgLoader = "Procesando, espere un momento por favor";
	var heightBrowser = $(window).width()/2;
	$('.loader').css("opacity","0.8").css("height",heightBrowser).html("<div id='Grd1_wrapper' class='dataTables_wrapper'><div id='Grd1_processing' class='dataTables_processing panel-default'>"+msgLoader+"</div></div>");
    $('.loader').show();
	$('#btnEliminarBloque').hide();
	
	$.ajax({
			url: "/ingreso/eliminar_valorizacion_bloque",
			data: $("#frmAfiliacion").serialize(),
			type: "POST",
			success: function (result) {  
				$('.loader').hide();
				$('#btnEliminarBloque').show();
				$('#example-select-all').prop('checked', false);
				datatablenew();
			}
	});

}

function fn_eliminar_tarjeta_bloque(){
	
	var msgLoader = "";
	msgLoader = "Procesando, espere un momento por favor";
	var heightBrowser = $(window).width()/2;
	$('.loader').css("opacity","0.8").css("height",heightBrowser).html("<div id='Grd1_wrapper' class='dataTables_wrapper'><div id='Grd1_processing' class='dataTables_processing panel-default'>"+msgLoader+"</div></div>");
    $('.loader').show();
	$('#btnInactivarTarjetaBloque').hide();
	
	$.ajax({
			url: "/tarjeta/eliminar_persona_tarjeta_bloque",
			data: $("#frmAfiliacion").serialize(),
			type: "POST",
			success: function (result) {  
				$('.loader').hide();
				$('#btnInactivarTarjetaBloque').show();
				$('#example-select-all').prop('checked', false);
				datatablenew();
			}
	});

}



