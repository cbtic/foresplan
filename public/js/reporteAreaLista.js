//alert("ok");
//jQuery.noConflict(true);

$(document).ready(function () {
	
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
        "sAjaxSource": "/reporte/listar_reporte_area_ajax",
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
			
			var id_area_trabajo = $('#id_area_trabajo_').val();
			var id_unidad_trabajo = $('#id_unidad_trabajo_').val();
			var numero_documento = $('#numero_documento').val();
            var persona = $('#persona').val();
			var empresa = $('#empresa').val();
			var estado = $('#estado').val();
			var _token = $('#_token').val();
            oSettings.jqXHR = $.ajax({
				"dataType": 'json',
                //"contentType": "application/json; charset=utf-8",
                "type": "POST",
                "url": sSource,
                "data":{NumeroPagina:iNroPagina,NumeroRegistros:iCantMostrar,
						id_area_trabajo:id_area_trabajo,id_unidad_trabajo:id_unidad_trabajo,
						numero_documento:numero_documento,persona:persona,empresa:empresa,estado:estado,
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
						var persona = "";
						if(row.persona!= null)persona = row.persona;
						return persona;
					},
					"bSortable": false,
					"aTargets": [0]
                },
				{
					"mRender": function (data, type, row) {
						var area_trabajo = "";
						if(row.area_trabajo!= null)area_trabajo = row.area_trabajo;
						return area_trabajo;
					},
					"bSortable": false,
					"aTargets": [1]
                },
				{
					"mRender": function (data, type, row) {
						var unidad_trabajo = "";
						if(row.unidad_trabajo!= null)unidad_trabajo = row.unidad_trabajo;
						return unidad_trabajo;
					},
					"bSortable": false,
					"aTargets": [2]
                },
                {
					"mRender": function (data, type, row) {
						var turno = "";
						if(row.turno!= null)turno = row.turno;
						return turno;
					},
					"bSortable": false,
					"aTargets": [3]
                },				
				{
					"mRender": function (data, type, row) {
						var horario = "";
						if(row.lune_dsem_tur!= null && row.lune_dsem_tur== "S")horario += "LU-";
						if(row.mart_dsem_tur!= null && row.mart_dsem_tur== "S")horario += "MA-";
						if(row.mier_dsem_tur!= null && row.mier_dsem_tur== "S")horario += "MI-";
						if(row.juev_dsem_tur!= null && row.juev_dsem_tur== "S")horario += "JU-";
						if(row.vier_dsem_tur!= null && row.vier_dsem_tur== "S")horario += "VI-";
						if(row.saba_dsem_tur!= null && row.saba_dsem_tur== "S")horario += "SA-";
						if(row.domi_dsem_tur!= null && row.domi_dsem_tur== "S")horario += "DO-";
						if(horario!="")horario=horario.substring(0,horario.length-1);
						if(row.hora_entr_tur!= null)horario += " ("+row.hora_entr_tur;
						if(row.hora_sali_tur!= null)horario += "-"+row.hora_sali_tur+")";
						
						return horario;
					},
					"bSortable": false,
					"aTargets": [4]
                },
                {
					"mRender": function (data, type, row) {
						var d1 = "";
						if(row.d1!= null)d1 = row.d1;
						return d1;
					},
					"bSortable": false,
					"aTargets": [5]
                },
                {
					"mRender": function (data, type, row) {
						var d2 = "";
						if(row.d2!= null)d2 = row.d2;
						return d2;
					},
					"bSortable": false,
					"aTargets": [6]
                },
				{
					"mRender": function (data, type, row) {
						var d3 = "";
						if(row.d3!= null)d3 = row.d3;
						return d3;
					},
					"bSortable": false,
					"aTargets": [7]
                },
				{
					"mRender": function (data, type, row) {
						var d4 = "";
						if(row.d4!= null)d4 = row.d4;
						return d4;
					},
					"bSortable": false,
					"aTargets": [8]
                },
				{
					"mRender": function (data, type, row) {
						var d5 = "";
						if(row.d5!= null)d5 = row.d5;
						return d5;
					},
					"bSortable": false,
					"aTargets": [9]
                },
				{
					"mRender": function (data, type, row) {
						var d6 = "";
						if(row.d6!= null)d6 = row.d6;
						return d6;
					},
					"bSortable": false,
					"aTargets": [10]
                },
				{
					"mRender": function (data, type, row) {
						var d7 = "";
						if(row.d7!= null)d7 = row.d7;
						return d7;
					},
					"bSortable": false,
					"aTargets": [11]
                },
				{
					"mRender": function (data, type, row) {
						var d8 = "";
						if(row.d8!= null)d8 = row.d8;
						return d8;
					},
					"bSortable": false,
					"aTargets": [12]
                },
				{
					"mRender": function (data, type, row) {
						var d9 = "";
						if(row.d9!= null)d9 = row.d9;
						return d9;
					},
					"bSortable": false,
					"aTargets": [13]
                },
				{
					"mRender": function (data, type, row) {
						var d10 = "";
						if(row.d10!= null)d10 = row.d10;
						return d10;
					},
					"bSortable": false,
					"aTargets": [14]
                },
				{
					"mRender": function (data, type, row) {
						var d11 = "";
						if(row.d11!= null)d11 = row.d11;
						return d11;
					},
					"bSortable": false,
					"aTargets": [15]
                },
				{
					"mRender": function (data, type, row) {
						var d12 = "";
						if(row.d12!= null)d12 = row.d12;
						return d12;
					},
					"bSortable": false,
					"aTargets": [16]
                },
				{
					"mRender": function (data, type, row) {
						var d13 = "";
						if(row.d13!= null)d13 = row.d13;
						return d13;
					},
					"bSortable": false,
					"aTargets": [17]
                },
				{
					"mRender": function (data, type, row) {
						var d14 = "";
						if(row.d14!= null)d14 = row.d14;
						return d14;
					},
					"bSortable": false,
					"aTargets": [18]
                },
				{
					"mRender": function (data, type, row) {
						var d15 = "";
						if(row.d15!= null)d15 = row.d15;
						return d15;
					},
					"bSortable": false,
					"aTargets": [19]
                },
				{
					"mRender": function (data, type, row) {
						var d16 = "";
						if(row.d16!= null)d16 = row.d16;
						return d16;
					},
					"bSortable": false,
					"aTargets": [20]
                },
				{
					"mRender": function (data, type, row) {
						var d17 = "";
						if(row.d17!= null)d17 = row.d17;
						return d17;
					},
					"bSortable": false,
					"aTargets": [21]
                },
				{
					"mRender": function (data, type, row) {
						var d18 = "";
						if(row.d18!= null)d18 = row.d18;
						return d18;
					},
					"bSortable": false,
					"aTargets": [22]
                },
				{
					"mRender": function (data, type, row) {
						var d19 = "";
						if(row.d19!= null)d19 = row.d19;
						return d19;
					},
					"bSortable": false,
					"aTargets": [23]
                },
				{
					"mRender": function (data, type, row) {
						var d20 = "";
						if(row.d20!= null)d20 = row.d20;
						return d20;
					},
					"bSortable": false,
					"aTargets": [24]
                },
				{
					"mRender": function (data, type, row) {
						var d21 = "";
						if(row.d21!= null)d21 = row.d21;
						return d21;
					},
					"bSortable": false,
					"aTargets": [25]
                },
				{
					"mRender": function (data, type, row) {
						var d22 = "";
						if(row.d22!= null)d22 = row.d22;
						return d22;
					},
					"bSortable": false,
					"aTargets": [26]
                },
				{
					"mRender": function (data, type, row) {
						var d23 = "";
						if(row.d23!= null)d23 = row.d23;
						return d23;
					},
					"bSortable": false,
					"aTargets": [27]
                },
				{
					"mRender": function (data, type, row) {
						var d24 = "";
						if(row.d24!= null)d24 = row.d24;
						return d24;
					},
					"bSortable": false,
					"aTargets": [28]
                },
				{
					"mRender": function (data, type, row) {
						var d25 = "";
						if(row.d25!= null)d25 = row.d25;
						return d25;
					},
					"bSortable": false,
					"aTargets": [29]
                },
				{
					"mRender": function (data, type, row) {
						var d26 = "";
						if(row.d26!= null)d26 = row.d26;
						return d26;
					},
					"bSortable": false,
					"aTargets": [30]
                },
				{
					"mRender": function (data, type, row) {
						var d27 = "";
						if(row.d27!= null)d27 = row.d27;
						return d27;
					},
					"bSortable": false,
					"aTargets": [31]
                },
				{
					"mRender": function (data, type, row) {
						var d28 = "";
						if(row.d28!= null)d28 = row.d28;
						return d28;
					},
					"bSortable": false,
					"aTargets": [32]
                },
				{
					"mRender": function (data, type, row) {
						var d29 = "";
						if(row.d29!= null)d29 = row.d29;
						return d29;
					},
					"bSortable": false,
					"aTargets": [33]
                },
				{
					"mRender": function (data, type, row) {
						var d30 = "";
						if(row.d30!= null)d30 = row.d30;
						return d30;
					},
					"bSortable": false,
					"aTargets": [34]
                },
				{
					"mRender": function (data, type, row) {
						var d31 = "";
						if(row.d31!= null)d31 = row.d31;
						return d31;
					},
					"bSortable": false,
					"aTargets": [35]
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

