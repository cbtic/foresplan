//alert("ok");
//jQuery.noConflict(true);

$(document).ready(function () {

	$('#btnBuscar').click(function () {
		fn_ListarBusqueda();
	});
	/*
	$('#btnNuevo').click(function () {
		modalPapeleta(0);
	});
	*/
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

    var tblPlanilla = $('#tblPlanilla').DataTable({
        "bServerSide": true,
        "sAjaxSource": "/planilla/listar_planilla_persona_ajax",
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

            var sEcho        = aoData[0].value;
            var iNroPagina   = parseFloat(fn_util_obtieneNroPagina(aoData[3].value, aoData[4].value)).toFixed();
            var iCantMostrar = aoData[4].value;

            var numero_documento = $('#numero_documento').val();
            var persona          = $('#persona').val();
            var empresa          = $('#empresa').val();
            var tipo             = $('#tipo_justifica').val();
            var estado           = $('#estado').val();
            var _token           = $('#_token').val();

            oSettings.jqXHR = $.ajax({
                dataType: 'json',
                type: "POST",
                url: sSource,
                data: {
                    NumeroPagina:    iNroPagina,
                    NumeroRegistros: iCantMostrar,
                    numero_documento: numero_documento,
                    tipo:             tipo,
                    persona:          persona,
                    empresa:          empresa,
                    estado:           estado,
                    _token:           _token
                },
                success: function (result) {
                    fnCallback(result);
                },
                error: function (msg, textStatus, errorThrown) {
                    // manejo de error
                }
            });
        },
        "aoColumnDefs":
            [
				{
					"mRender": function (data, type, row) {
						var empresa = "";
						if(row.empresa!= null)empresa = row.empresa;
						return empresa;
					},
					"bSortable": false,
					"aTargets": [0],
					"className": "dt-center",
					//"className": 'control'
        },

				{
					"mRender": function (data, type, row) {
						var planilla = "";
						if(row.planilla!= null)planilla = row.planilla;
						return planilla;
					},
					"bSortable": false,
					"aTargets": [1],
					"className": "dt-center",
					//"className": 'control'
					},
				{
					"mRender": function (data, type, row) {
						var subplanilla = "";
						if(row.subplanilla!= null)subplanilla = row.subplanilla;
						return subplanilla;
					},
					"bSortable": false,
					"aTargets": [2]
                },
                {
					"mRender": function (data, type, row) {
						var anio = "";
						if(row.anio!= null)anio = row.anio;
						return anio;
					},
					"bSortable": false,
					"aTargets": [3]
                },
                {
					"mRender": function (data, type, row) {
						var mes = "";
						if(row.mes!= null)mes = row.mes;
						return mes;
					},
					"bSortable": false,
					"aTargets": [4]
                },

                {
					"mRender": function (data, type, row) {
						var tipo_planilla = "";
						if(row.tipo_planilla!= null)tipo_planilla = row.tipo_planilla;
						return tipo_planilla;
					},
					"bSortable": false,
					"aTargets": [5]
                },
                {
					"mRender": function (data, type, row) {
						var fech_inic_tpe = "";
						if(row.fech_inic_tpe!= null)fech_inic_tpe = row.fech_inic_tpe;
						return fech_inic_tpe;
					},
					"bSortable": false,
					"aTargets": [6]
                },

                {
					"mRender": function (data, type, row) {
						var fech_fina_tpe = "";
						if(row.fech_fina_tpe!= null)fech_fina_tpe = row.fech_fina_tpe;
						return fech_fina_tpe;
					},
					"bSortable": false,
					"aTargets": [7]
                },
				{
                "mRender": function (data, type, row) {
					var html = '<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">';
					html += '<a target="_blank" href="agregar_persona_planilla/'+row.id+'" class="btn btn-success" style="font-size:12px;margin-left:10px"><i class="fa fa-university"></i></a>';
					html += '</div>';
					return html;
                },
                "bSortable": false,
                "aTargets": [8],
				"className": "text-center",
                },
				{
                "mRender": function (data, type, row) {
					var estado = "";
					var clase = "";
					if(row.esta_plan_tpe == 1){
						estado = "Abierto";
					}
					if(row.esta_plan_tpe == 2){
						estado = "Cerrado";
					}
					return estado;
                },
                "bSortable": false,
                "aTargets": [9],
                },
				{
                "mRender": function (data, type, row) {
					var estado = "";
					var clase = "";
					if(row.esta_plan_tpe == 1){
						estado = "Cerrar";
						clase = "btn-warning";
					}
					if(row.esta_plan_tpe == 2){
						estado = "Abrir";
						clase = "btn-success";
					}
                	var html = '<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">';
					html += '<a href="javascript:void(0)" onclick=cerrarPeriodo('+row.id+','+row.esta_plan_tpe+') class="btn btn-sm '+clase+'" style="font-size:12px">';
					html += estado+'</a></div>';
					return html;
                },
                "bSortable": false,
                "aTargets": [10],
				"className": "text-center",
                },

				/*{
                "mRender": function (data, type, row) {
					var estado = "";
					var clase = "";
					estado = "Eliminar";
					clase = "btn-danger";
					accion = "1";
					var html = '<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">';
					html += '<button style="font-size:12px" type="button" class="btn btn-sm btn-success" data-toggle="modal" onclick="modalPapeleta('+row.id+')" ><i class="fa fa-edit"></i> Editar</button>';
					html += '<a href="javascript:void(0)" onclick=eliminarPapeleta('+row.id+','+accion+') class="btn btn-sm '+clase+'" style="font-size:12px;margin-left:10px">'+estado+'</a>';


					html += '</div>';
					return html;
                },
                "bSortable": false,
                "aTargets": [13],
                },*/
            ]


    });

}

function fn_ListarBusqueda() {
    datatablenew();
};

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


function eliminarPapeleta(id,estado){
	//alert(id);
	var act_estado = "";
	//var eliminado = "";
	if(estado==1){
		act_estado = "Eliminar";
		estado_="S";
		//eliminado = "S";
	}
	if(estado==0){
		act_estado = "Activar";
		estado_="N";
		//eliminado = "N";
	}
    bootbox.confirm({
        size: "small",
        message: "&iquest;Deseas "+act_estado+" la Papeleta?",
        callback: function(result){
            if (result==true) {
                fn_eliminar_papeleta(id,estado_);
            }
        }
    });
    $(".modal-dialog").css("width","30%");
}

function fn_eliminar_papeleta(id,estado){

    $.ajax({
            url: "/papeleta/eliminar_papeleta/"+id+"/"+estado,
            type: "GET",
            success: function (result) {
                //if(result="success")obtenerPlanDetalle(id_plan);
				datatablenew();
            }
    });
}

function showTblLoader() {
    $('#tblPlanilla_loader').css('display', 'flex');
}

function hideTblLoader() {
    $('#tblPlanilla_loader').css('display', 'none');
}

function cerrarPeriodo(id, estado) {
    var act_estado = "";
    var estado_ = estado;

    if (estado == 1) {
        act_estado = "Cerrar";
        estado_ = 2;
    }
    if (estado == 2) {
        act_estado = "Abrir";
        estado_ = 1;
    }

    bootbox.confirm({
        size: "small",
        message: "&iquest;Deseas " + act_estado + " el Periodo?",
        callback: function (result) {
            if (result === true) {

                showTblLoader(); // mostrar loader antes del ajax

                $.ajax({
                    url: "/planilla/actualizar_periodo/" + id + "/" + estado_,
                    type: "GET",
                    dataType: "json",
                    success: function (result) {

                        if (result.sw == false) {
                            hideTblLoader();
                            bootbox.alert(result.msg);
                            return;
                        }

                        datatablenew();   // tu lógica actual para recargar tabla
                        setTimeout(hideTblLoader, 500);
                    },
                    error: function () {
                        hideTblLoader();
                        bootbox.alert("Ocurrió un error al actualizar el periodo.");
                    }
                });
            }
        }
    });

    $(".modal-dialog").css("width","30%");
}


function fn_cerrar_periodo(id,estado){

    $.ajax({
      url: "/planilla/actualizar_periodo/"+id+"/"+estado,
      type: "GET",
			dataType: 'json',
      success: function (result) {
      //if(result="success")obtenerPlanDetalle(id_plan);

				if(result.sw==false){
          hideTblLoader();
					bootbox.alert(result.msg);
          return;
				}

				datatablenew();
        setTimeout(hideTblLoader, 500);
      }
    });
}

