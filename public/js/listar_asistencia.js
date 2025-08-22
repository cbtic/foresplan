//alert("ok");
//jQuery.noConflict(true);

$(document).ready(function () {
	
	$('#btnPapeleta').click(function () {
		modalPapeleta(0);
	});
	
	$('#persona').keyup(function() {
		this.value = this.value.toLocaleUpperCase();
	});
	
	$('#persona').focusin(function() { $('#persona').select(); });
	
	$('#persona').autocomplete({
		appendTo: "#persona_busqueda",
		open: function() { $('#persona').autocomplete("widget").width(300)  },
		source: function(request, response) {
			$.ajax({
			url: '/persona/list_persona/'+$('#persona').val(),
			dataType: "json",
			success: function(data){
			var resp = $.map(data,function(obj){
					var hash = {key: obj.id_persona, key1: obj.id_ubicacion, value: obj.persona, value1:obj.razon_social};
					return hash;
			}); 
			response(resp);
			},
			error: function() {
			}
		});
		},
		select: function (event, ui) {
			$("#id_persona_bus").val(ui.item.key);
			$("#id_ubicacion").val(ui.item.key1);
			$('#empresa_').val(ui.item.value1);
			//alert(ui.item.value1);
		},
			minLength: 2,
			delay: 100
	});		
	
	
	
	$('#btnBuscar').click(function () {
		fn_ListarBusqueda();
	});
	
	$('#btnNuevo').click(function () {
		modalPersona(0);
	});
		
	datatablenew();
	
	$("#plan_id").select2();
	$("#ubicacion_id").select2();
	
	$('#fecha_inicio').datepicker({
        autoclose: true,
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
		changeYear: true,
    });
	
	//$("#fecha_vencimiento").datepicker($.datepicker.regional["es"]);
	$('#fecha_vencimiento').datepicker({
        autoclose: true,
        dateFormat: 'dd/mm/yy',
		changeMonth: true,
		changeYear: true,
    });
	
	$('#fecha_ini').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy',
		language: 'es',
		changeMonth: true,
		changeYear: true,
	});

	$('#fecha_fin').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy',
		language: 'es',
		changeMonth: true,
		changeYear: true,
	});

	$('#fecha_proceso').datepicker({
        autoclose: true,
		format: 'dd-mm-yyyy',
		changeMonth: true,
		changeYear: true,
    });

	/*
    $('#tblAlquiler').dataTable({
    	"language": {
    	"emptyTable": "No se encontraron resultados"
    	}
	});
	*/
	/*
	$('#tblAlquiler').dataTable( {
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningun dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "ultimo",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                },
                "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        } );
	*/


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
		$('#modalPersonaForm #nombres').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});


	$(function() {
		$('#modalPersonaTitularForm #apellido_paterno').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
	$(function() {
		$('#modalPersonaTitularForm #apellido_materno').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
	$(function() {
		$('#modalPersonaTitularForm #nombres').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
	});
});

function habiliarTitular(){
	/*
	$('#divTitular').hide();
	if(!$("#chkTitular").is(':checked')) {
    	$('#divTitular').show();
	}
	*/
}

function guardarAfiliacion(){
    
    var msg = "";
    var persona_id = $('#persona_id').val();
    var titular_id = $('#titular_id').val();
	var plan_id = $('#plan_id').val();
	var fecha_inicio = $('#fecha_inicio').val();
	var fecha_vencimiento = $('#fecha_vencimiento').val();
	
	if(persona_id == "")msg += "Debe ingresar el Numero de Documento <br>";
	if(!$("#chkTitular").is(':checked')) {
    	if(titular_id == "")msg += "Debe ingresar el Numero de Documento del Titular<br>";
	}
    if(plan_id == "0")msg+="Debe seleccionar un Plan/Tarifario <br>";
	if(fecha_inicio == "")msg += "Debe ingresar la fecha de inicio de la afiliacion <br>";
	if(fecha_vencimiento == "")msg += "Debe ingresar la fecha de fin de la afiliacion <br>";
	/*
	if($('input[name=horario]').is(':checked')==true){
		var horario = $('input[name=horario]:checked').val();
		var data = horario.split("#");
		var fecha_cita = data[0];
		var id_medico = data[1];
	}
	*/

	
    if(msg!=""){
        bootbox.alert(msg); 
        return false;
    }
    else{
        fn_save();
	}
	
	//fn_save();
}

function fn_save_(){
    
    //var fecha_atencion_original = $('#fecha_atencion').val();
	//var id_user = $('#id_user').val();
    $.ajax({
			url: "/afiliacion/send",
            type: "POST",
            //data : $("#frmCita").serialize()+"&id_medico="+id_medico+"&fecha_cita="+fecha_cita,
            data : $("#frmAfiliacion").serialize(),
            success: function (result) {  
                    /*$('#openOverlayOpc').modal('hide');
					$('#calendar').fullCalendar("refetchEvents");
					modalDelegar(fecha_atencion_original);*/
					//modalTurnos();
					//modalHistorial();
					//location.href="ver_cita/"+id_user+"/"+result;
					location.href="/afiliacion";
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



function obtenerPersona(){
		
	var tipo_documento = $("#tipo_documento").val();
	var numero_documento = $("#numero_documento").val();
	var msg = "";
	
	if (msg != "") {
		bootbox.alert(msg);
		return false;
	}
	
	//$('#empresa_id').val("");
	$('#persona_id').val("");
	
	$.ajax({
		url: '/persona/obtener_persona/' + tipo_documento + '/' + numero_documento,
		dataType: "json",
		success: function(result){
			var nombre_persona= result.persona.apellido_paterno+" "+result.persona.apellido_materno+", "+result.persona.nombres;
			$('#nombre_persona').val(nombre_persona);
			$('#persona_id').val(result.persona.id);
			if(result.persona.titular_id > 0){
				$("#chkTitular").attr("checked",false);
				$("#numero_documento_tit").val(result.persona.numero_documento_titular);
				obtenerTitularActual(result.persona.tipo_documento_titular,result.persona.numero_documento_titular);
			}
			if(result.persona.titular_id == 0){
				$("#chkTitular").attr("checked",true);
				$("#numero_documento_tit").val(numero_documento);
				obtenerTitularActual(tipo_documento,numero_documento);
			}
		},
		error: function(data) {
			alert("Persona no encontrada en la Base de Datos.");
			$('#personaModal').modal('show');
		}
		
	});
	
}

function obtenerTitularActual(tipo_documento,numero_documento){
		
	//var tipo_documento = $("#tipo_documento_tit").val();
	//var numero_documento = $("#numero_documento_tit").val();
	var msg = "";
	
	if (msg != "") {
		bootbox.alert(msg);
		return false;
	}
	
	//$('#empresa_id').val("");
	$('#titular_id').val("");
	
	$.ajax({
		url: '/persona/obtener_persona/' + tipo_documento + '/' + numero_documento,
		dataType: "json",
		success: function(result){
			var nombre_titular = result.persona.apellido_paterno+" "+result.persona.apellido_materno+", "+result.persona.nombres;
			$('#nombre_titular').val(nombre_titular);
			$('#titular_id').val(result.persona.id);
		},
		error: function(data) {
			alert("Persona no encontrada en la Base de Datos.");
			$('#personaTitularModal').modal('show');
		}
		
	});
	
}

function obtenerTitular(){
		
	var tipo_documento = $("#tipo_documento_tit").val();
	var numero_documento = $("#numero_documento_tit").val();
	var msg = "";
	
	if (msg != "") {
		bootbox.alert(msg);
		return false;
	}
	
	//$('#empresa_id').val("");
	$('#titular_id').val("");
	
	$.ajax({
		url: '/persona/obtener_persona/' + tipo_documento + '/' + numero_documento,
		dataType: "json",
		success: function(result){
			var nombre_titular = result.persona.apellido_paterno+" "+result.persona.apellido_materno+", "+result.persona.nombres;
			$('#nombre_titular').val(nombre_titular);
			$('#titular_id').val(result.persona.id);
		},
		error: function(data) {
			alert("Persona no encontrada en la Base de Datos.");
			$('#personaTitularModal').modal('show');
		}
		
	});
	
}

function obtenerPlanDetalle(){
	
	var plan_costo = $('#plan_id option:selected').attr("plan_costo");
	var periodo = $('#plan_id option:selected').attr("periodo");
	$('#plan_costo').val(plan_costo);
	$('#periodo').val(periodo);
	
	var id = $('#plan_id').val();
	$.ajax({
		url: '/supervision/obtener_plan_detalle/'+id,
		dataType: "json",
		success: function(result){
			//var productos = result.productos;
			var option = "";
			$('#tblPlan tbody').html("");
			$(result).each(function (ii, oo) {
				option += "<tr style='font-size:13px'><td class='text-left'>"+oo.pasm_smodulod+"</td><td class='text-left'>"+oo.pasm_precio+"</td></tr>";
			});
			$('#tblPlan tbody').html(option);
		}
		
	});
	
}

/*
function cargarAlquiler(){
    
    var empresa_id = $('#empresa_id').val();
	if(empresa_id == "")empresa_id=0;
	
    $("#tblAlquiler tbody").html("");
	$.ajax({
			url: "/alquiler/obtener_alquiler/"+empresa_id,
			type: "GET",
			success: function (result) {  
					$("#tblAlquiler tbody").html(result);
					//$('#tblAlquiler').dataTable();
			}
	});

}


function cargarDevolucion(){
    
    
    var numero_documento = $("#numero_documento").val();
    $("#tblPago tbody").html("");
	$.ajax({
			url: "/alquiler/obtener_devolucion/"+numero_documento,
			type: "GET",
			success: function (result) {  
					$("#tblDevolucion tbody").html(result);
			}
	});

}
*/


$('#modalPersonaSaveBtn').click(function (e) {
	e.preventDefault();
	$(this).html('Enviando datos..');

	$.ajax({
	  data: $('#modalPersonaForm').serialize(),
	  url: "/afiliacion/nueva_inscripcion_ajax",
	  type: "POST",
	  dataType: 'json',
	  success: function (data) {

		  $('#modalPersonaForm #modalPersonaForm').trigger("reset");
		  $('#personaModal').modal('hide');
		  $('#numero_documento').val(data.numero_documento);
		  $('#nombre_persona').val(data.nombre_apellido);

		  alert("La persona ha sido ingresada correctamente!");

	  },
	  error: function(data) {
	mensaje = "Revisar el formulario:\n\n";
	$.each( data["responseJSON"].errors, function( key, value ) {
	  mensaje += value +"\n";
	});
	$("#modalPersonaForm #modalPersonaSaveBtn").html("Grabar");
	alert(mensaje);
  }
  });
});

$('#modalPersonaTitularSaveBtn').click(function (e) {
	e.preventDefault();
	$(this).html('Enviando datos..');

	$.ajax({
	  data: $('#modalPersonaTitularForm').serialize(),
	  url: "/afiliacion/nueva_inscripcion_ajax",
	  type: "POST",
	  dataType: 'json',
	  success: function (data) {

		  $('#modalPersonaTitularForm #modalPersonaForm').trigger("reset");
		  $('#personaTitularModal').modal('hide');
		  $('#numero_documento_tit').val(data.numero_documento);
		  $('#nombre_titular').val(data.nombre_apellido);

		  alert("La persona ha sido ingresada correctamente!");

	  },
	  error: function(data) {
	mensaje = "Revisar el formulario:\n\n";
	$.each( data["responseJSON"].errors, function( key, value ) {
	  mensaje += value +"\n";
	});
	$("#modalPersonaTitularForm  #modalPersonaSaveBtn").html("Grabar");
	alert(mensaje);
  }
  });
});


function datatablenew(){
    var oTable1 = $('#tblAfiliado').dataTable({
        "bServerSide": true,
        "sAjaxSource": "/asistencia/listar_asistencia_ajax",
        "bProcessing": true,
        "sPaginationType": "full_numbers",
        //"paging":false,
        "bFilter": false,
        "bSort": false,
        "info": true,
		//"responsive": true,
        "language": {"url": "/js/Spanish.json"},
        "autoWidth": false,
        "bLengthChange": true,
        "destroy": true,
        "lengthMenu": [[31, 60, 90, 6000000], [31, 60, 90, "Todos"]],
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
			
			var id_area_trabajo = $('#id_area_trabajo_').val(); 
			var id_unidad_trabajo = $('#id_unidad_trabajo_').val(); 
			var id_persona = $('#id_persona_bus').val(); 
			var anio = $('#anio').val();
			var mes = $('#mes').val();
			var fecha_ini = $('#fecha_ini').val();
			var fecha_fin = $('#fecha_fin').val();
            var id_sede = $('#id_sede_').val();
            var estado = $('#estado').val();
			var _token = $('#_token').val();
            oSettings.jqXHR = $.ajax({
				"dataType": 'json',
                //"contentType": "application/json; charset=utf-8",
                "type": "POST",
                "url": sSource,
                "data":{NumeroPagina:iNroPagina,NumeroRegistros:iCantMostrar,
						id_area_trabajo:id_area_trabajo,id_unidad_trabajo:id_unidad_trabajo,
						id_persona:id_persona,anio:anio,
						mes:mes,estado:estado,fecha_ini:fecha_ini,fecha_fin:fecha_fin,id_sede:id_sede,
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
		"fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			
			var fech_marc_rel = "";
			var fech_sali_rel = "";
			var tiempo_programado = "";
			var tiempo_trabajado = "";
			var tiempo_trabajado_total = "";
			var estado="";
			var flag_labo_dtu = "";
			
			if(aData.fech_marc_rel!= null)fech_marc_rel = aData.fech_marc_rel;
			if(aData.fech_sali_rel!= null)fech_sali_rel = aData.fech_sali_rel;
			if(aData.tiempo_programado!= null)tiempo_programado = aData.tiempo_programado;
			if(aData.tiempo_trabajado!= null)tiempo_trabajado = aData.tiempo_trabajado;
			if(aData.tiempo_trabajado_total!= null)tiempo_trabajado_total = aData.tiempo_trabajado_total;
			if(aData.flag_labo_dtu!= null)flag_labo_dtu = aData.flag_labo_dtu;
			
			if(fech_marc_rel!="" && fech_sali_rel!="" && tiempo_trabajado_total >= tiempo_programado)estado="Ok";
			if(fech_marc_rel!="" && fech_sali_rel!="" && tiempo_programado > tiempo_trabajado_total)estado="Abandono";
			if(fech_marc_rel=="" || fech_sali_rel=="" )estado="Observado";
			
			if(fech_marc_rel=="" && fech_sali_rel=="" && flag_labo_dtu=='N')estado=""; 
			
			if (estado == "Ok") {
				$('td', nRow).addClass('verde_claro');
			}
			
			if (estado == "Abandono") {
				$('td', nRow).addClass('amarillo');
			}
			if (estado == "Observado") {
				$('td', nRow).addClass('rojo');
			}
			
			if (estado == "") {
				$('td', nRow).addClass('rojo');
			}
			
			
		},
        "aoColumnDefs":
            [	
			 	/*
				{
					"mRender": function (data, type, row) {
						var fecha_dias = "";
						if(row.fecha_dias!= null)fecha_dias = row.fecha_dias;
						return fecha_dias;
					},
					"bSortable": false,
					"aTargets": [0]
                },*/
				{
					"mRender": function (data, type, row) {
						var numero_documento = "";
						if(row.numero_documento!= null)numero_documento = row.numero_documento;
						return numero_documento;
					},
					"bSortable": false,
					"aTargets": [0]
                },
				{
					"mRender": function (data, type, row) {
						var persona = "";
						if(row.persona!= null)persona = row.persona;
						return persona;
					},
					"bSortable": false,
					"aTargets": [1]
                },
				{
					"mRender": function (data, type, row) {
						var area_trabajo = "";
						if(row.area_trabajo!= null)area_trabajo = row.area_trabajo;
						return area_trabajo;
					},
					"bSortable": false,
					"aTargets": [2]
                },
				{
					"mRender": function (data, type, row) {
						var unidad_trabajo = "";
						if(row.unidad_trabajo!= null)unidad_trabajo = row.unidad_trabajo;
						return unidad_trabajo;
					},
					"bSortable": false,
					"aTargets": [3]
                },
                /*{
					"mRender": function (data, type, row) {
						var turno = "";
						if(row.turno!= null)turno = row.turno;
						return turno;
					},
					"bSortable": false,
					"aTargets": [4]
                },*/
				{
					"mRender": function (data, type, row) {
						var hora_entr_dtu = "";
						var hora_sali_dtu = "";
						if(row.hora_entr_dtu!= null)hora_entr_dtu = row.hora_entr_dtu;
						if(row.hora_sali_dtu!= null)hora_sali_dtu = row.hora_sali_dtu;
						return hora_entr_dtu+'-'+hora_sali_dtu;
					},
					"bSortable": false,
					"aTargets": [4]
                },
				{
					"mRender": function (data, type, row) {
						var fecha_dias = "";
						if(row.fecha_dias!= null)fecha_dias = row.fecha_dias;
						return fecha_dias;
					},
					"bSortable": false,
					"aTargets": [5],
					"className": 'verde',
                },
				{
					"mRender": function (data, type, row) {
						var dia = "";
						if(row.dia!= null)dia = row.dia;
						return dia;
					},
					"bSortable": false,
					"aTargets": [6]
                },
				{
					"mRender": function (data, type, row) {
						var flag_labo_dtu = "";
						if(row.flag_labo_dtu!= null)flag_labo_dtu = row.flag_labo_dtu;
						return flag_labo_dtu;
					},
					"bSortable": false,
					"aTargets": [7]
                },
				
				{
					"mRender": function (data, type, row) {
						var fech_marc_rel = "";
						if(row.fech_marc_rel!= null)fech_marc_rel = row.fech_marc_rel;
						return fech_marc_rel;
					},
					"bSortable": false,
					"aTargets": [8]
                },
				
				{
					"mRender": function (data, type, row) {
						var hora_entr_rel = "";
						if(row.hora_entr_rel!= null)hora_entr_rel = row.hora_entr_rel;
						return hora_entr_rel;
					},
					"bSortable": false,
					"aTargets": [9]
                },
				
                {
					"mRender": function (data, type, row) {
						var fech_sali_rel = "";
						if(row.fech_sali_rel!= null)fech_sali_rel = row.fech_sali_rel;
						return fech_sali_rel;
					},
					"bSortable": false,
					"aTargets": [10]
                },
				
                {
					"mRender": function (data, type, row) {
						var hora_sali_rel = "";
						if(row.hora_sali_rel!= null)hora_sali_rel = row.hora_sali_rel;
						return hora_sali_rel;
					},
					"bSortable": false,
					"aTargets": [11]
                },
				{
					"mRender": function (data, type, row) {
						var tiempo_programado = "";
						if(row.tiempo_programado!= null)tiempo_programado = row.tiempo_programado;
						return tiempo_programado;
					},
					"bSortable": false,
					"aTargets": [12]
                },
				{
					"mRender": function (data, type, row) {
						var minu_tard_eas = "";
						if(row.minu_tard_eas!= null)minu_tard_eas = row.minu_tard_eas;
						return minu_tard_eas;
					},
					"bSortable": false,
					"aTargets": [13]
                },
				{
					"mRender": function (data, type, row) {
						var tiempo_trabajado = "";
						if(row.tiempo_trabajado!= null)tiempo_trabajado = row.tiempo_trabajado;
						return tiempo_trabajado;
					},
					"bSortable": false,
					"aTargets": [14]
                },
				{
					"mRender": function (data, type, row) {
						var fech_marc_rel = "";
						var fech_sali_rel = "";
						var tiempo_programado = "";
						var tiempo_trabajado = "";
						var tiempo_trabajado_total = "";
						var estado="";
						var flag_labo_dtu = "";
						
						if(row.fech_marc_rel!= null)fech_marc_rel = row.fech_marc_rel;
						if(row.fech_sali_rel!= null)fech_sali_rel = row.fech_sali_rel;
						if(row.tiempo_programado!= null)tiempo_programado = row.tiempo_programado;
						if(row.tiempo_trabajado!= null)tiempo_trabajado = row.tiempo_trabajado;
						if(row.tiempo_trabajado_total!= null)tiempo_trabajado_total = row.tiempo_trabajado_total;
						if(row.flag_labo_dtu!= null)flag_labo_dtu = row.flag_labo_dtu;
						
						if(fech_marc_rel!="" && fech_sali_rel!="" && tiempo_trabajado_total >= tiempo_programado)estado="Ok";
						if(fech_marc_rel!="" && fech_sali_rel!="" && tiempo_programado > tiempo_trabajado_total)estado="Abandono";
						if(fech_marc_rel=="" || fech_sali_rel=="" )estado="Observado";
						if(fech_marc_rel=="" && fech_sali_rel=="" && flag_labo_dtu=='N')estado=""; 
						return estado;
					},
					"bSortable": false,
					"aTargets": [15]
                },
				/*
				{
					"mRender": function (data, type, row) {
						//var hora_sali_rel = "";
						//if(row.hora_sali_rel!= null)hora_sali_rel = row.hora_sali_rel;
						return null;
					},
					"bSortable": false,
					"aTargets": [14]
                },
				*/
				{
					"mRender": function (data, type, row) {
						var tipo_marc_eas = "";
						if(row.tipo_marc_eas!= null)tipo_marc_eas = row.tipo_marc_eas;
						return tipo_marc_eas;
					},
					"bSortable": false,
					"aTargets": [16]
                },	
				{
					"mRender": function (data, type, row) {
						var hora_permiso = "";
						if(row.hora_permiso!= null)hora_permiso = row.hora_permiso;
						return hora_permiso;
					},
					"bSortable": false,
					"aTargets": [17]
                },
				{
					"mRender": function (data, type, row) {
						var minu_dife_pap = "";
						if(row.minu_dife_pap!= null)minu_dife_pap = row.minu_dife_pap;
						return minu_dife_pap;
					},
					"bSortable": false,
					"aTargets": [18]
                },											
				{
                "mRender": function (data, type, row) {
					
					var html = '';
					if(row.id_deta_operacion!=null){
						var html = '<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">';
						html += '<button style="font-size:12px" type="button" class="btn btn-sm btn-info" data-toggle="modal" onclick="modalPapeleta('+row.id_deta_operacion+')" ><i class="fa fa-eye"></i> Ver </button>';
						html += '</div>';
					}
	
					return html;
					},
					"bSortable": false,
					"aTargets": [19],
                },
				{
                "mRender": function (data, type, row) {					
					var html = '';
					if(row.fech_marc_rel!= null){
						var html = '<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">';
						html += '<button style="font-size:12px" type="button" class="btn btn-sm btn-success" data-toggle="modal" onclick="modalAsistencia('+row.id_asistencia+')" ><i class="fa fa-edit"></i> Editar</button>';
						html += '</div>';
					}
	
					return html;
					},
					"bSortable": false,
					"aTargets": [20],
                },
				
				{
                "mRender": function (data, type, row) {					
					var html = '';
					if(row.fecha_dias!= null){
						var html = '<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">';
						html += '<button style="font-size:12px" type="button" class="btn btn-sm btn-warning" data-toggle="modal" onclick=modalZktecoLog("'+row.fecha_dias+'","'+row.numero_documento+'") ><i class="fa fa-edit"></i> Detalle Zkteco</button>';
						html += '</div>';
					}
	
					return html;
					},
					"bSortable": false,
					"aTargets": [21],
                },
				
				
            ]


    });

}

function fn_ListarBusqueda() {
    datatablenew();
};

function modalPersona(id){
	
	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/persona/modal_persona/"+id,
			type: "GET",
			success: function (result) {  
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});

}


function eliminarPersona(id,estado){
	
	var act_estado = "";
	//var eliminado = "";
	if(estado==1){
		act_estado = "Eliminar";
		estado_=0;
		//eliminado = "S";
	}
	if(estado==0){
		act_estado = "Activar";
		estado_=1;
		//eliminado = "N";
	}
    bootbox.confirm({ 
        size: "small",
        message: "&iquest;Deseas "+act_estado+" la Persona?", 
        callback: function(result){
            if (result==true) {
                fn_eliminar_persona(id,act_estado);
            }
        }
    });
    $(".modal-dialog").css("width","30%");
}

function fn_eliminar_persona(id,estado){
	
    $.ajax({
            url: "/persona/eliminar_personad/"+id+"/"+estado,
            type: "GET",
            success: function (result) {
                //if(result="success")obtenerPlanDetalle(id_plan);
				datatablenew();
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

function modalPapeleta(id){
	
	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/papeleta/modal_papeleta/"+id,
			type: "GET",
			success: function (result) {  
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});

}

function modalAsistencia(id){
	
	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/asistencia/modal_asistencia/"+id,
			type: "GET",
			success: function (result) {  
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});

}

function modalZktecoLog(fecha,numero_documento){
	
	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/asistencia/modal_zkteco_log/"+fecha+'/'+numero_documento,
			type: "GET",
			success: function (result) {  
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});

}

function asistenciaAutomatico(){
    
	var msgLoader = "";
	msgLoader = "Procesando, espere un momento por favor";
	var heightBrowser = $(window).width()/2;
	$('.loader').css("opacity","0.8").css("height",heightBrowser).html("<div id='Grd1_wrapper' class='dataTables_wrapper'><div id='Grd1_processing' class='dataTables_processing panel-default'>"+msgLoader+"</div></div>");
    $('.loader').show();
	//$('#guardar').hide();

	var fecha = $("#fecha_proceso").val();
	$.ajax({
			url: "/asistencia/asistencia_automatico/"+fecha,
			type: "GET",
			success: function (result) {  
					$('.loader').hide();
					datatablenew();
			}
	});

}
