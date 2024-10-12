//alert("ok");
//jQuery.noConflict(true);

$(document).ready(function() {

    $('#btnBuscar').click(function() {
        fn_ListarBusqueda();
    });

    $('#btnNuevo').click(function() {
        modalTablamaestra(0);
    });

    datatablenew();

    /*
    $("#plan_id").select2();
    $("#ubicacion_id").select2();

    $('#fecha_inicio').datepicker({
        autoclose: true,
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
    });

	*/
    //$("#fecha_vencimiento").datepicker($.datepicker.regional["es"]);
    /*
    $('#fecha_vencimiento').datepicker({
        autoclose: true,
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
    });
	*/

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
        $('#modalTablamaestraForm #apellido_paterno').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });
    $(function() {
        $('#modalTablamaestraForm #apellido_materno').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });
    $(function() {
        $('#modalTablamaestraForm #nombres').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });


    $(function() {
        $('#modalTablamaestraTitularForm #apellido_paterno').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });
    $(function() {
        $('#modalTablamaestraTitularForm #apellido_materno').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });
    $(function() {
        $('#modalTablamaestraTitularForm #nombres').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });
});

function habiliarTitular() {
    /*
	$('#divTitular').hide();
	if(!$("#chkTitular").is(':checked')) {
    	$('#divTitular').show();
	}
	*/
}

function guardarAfiliacion() {

    var msg = "";
    var persona_id = $('#persona_id').val();
    var titular_id = $('#titular_id').val();
    var plan_id = $('#plan_id').val();
    var fecha_inicio = $('#fecha_inicio').val();
    var fecha_vencimiento = $('#fecha_vencimiento').val();

    if (persona_id == "") msg += "Debe ingresar el Numero de Documento <br>";
    if (!$("#chkTitular").is(':checked')) {
        if (titular_id == "") msg += "Debe ingresar el Numero de Documento del Titular<br>";
    }
    if (plan_id == "0") msg += "Debe seleccionar un Plan/Tarifario <br>";
    if (fecha_inicio == "") msg += "Debe ingresar la fecha de inicio de la afiliacion <br>";
    if (fecha_vencimiento == "") msg += "Debe ingresar la fecha de fin de la afiliacion <br>";
    /*
    if($('input[name=horario]').is(':checked')==true){
    	var horario = $('input[name=horario]:checked').val();
    	var data = horario.split("#");
    	var fecha_cita = data[0];
    	var id_medico = data[1];
    }
    */


    if (msg != "") {
        bootbox.alert(msg);
        return false;
    } else {
        fn_save();
    }

    //fn_save();
}

function fn_save_() {

    //var fecha_atencion_original = $('#fecha_atencion').val();
    //var id_user = $('#id_user').val();
    $.ajax({
        url: "/afiliacion/send",
        type: "POST",
        //data : $("#frmCita").serialize()+"&id_medico="+id_medico+"&fecha_cita="+fecha_cita,
        data: $("#frmAfiliacion").serialize(),
        success: function(result) {
            /*$('#openOverlayOpc').modal('hide');
					$('#calendar').fullCalendar("refetchEvents");
					modalDelegar(fecha_atencion_original);*/
            //modalTurnos();
            //modalHistorial();
            //location.href="ver_cita/"+id_user+"/"+result;
            location.href = "/afiliacion";
        }
    });
}

function validaTipoDocumento() {
    var tipo_documento = $("#tipo_documento").val();
    $('#nombre_afiliado').val("");
    $('#empresa_afiliado').val("");
    $('#empresa_direccion').val("");
    $('#empresa_representante').val("");
    $('#codigo_afiliado').val("");
    $('#fecha_afiliado').val("");

    if (tipo_documento == "RUC") {
        $('#divNombreApellido').hide();
        $('#divCodigoAfliado').hide();
        $('#divFechaAfliado').hide();
        $('#divDireccionEmpresa').show();
        $('#divRepresentanteEmpresa').show();
    } else {
        $('#divNombreApellido').show();
        $('#divCodigoAfliado').show();
        $('#divFechaAfliado').show();
        $('#divDireccionEmpresa').hide();
        $('#divRepresentanteEmpresa').hide();
    }
}

function obtenerPersona() {

    var tipo_documento = $("#tipo_documento").val();
    var denominacion = $("#denominacion").val();
    var msg = "";

    if (msg != "") {
        bootbox.alert(msg);
        return false;
    }

    //$('#empresa_id').val("");
    $('#persona_id').val("");

    $.ajax({
        url: '/tabla_maestras/obtener_persona/' + tipo_documento + '/' + denominacion,
        dataType: "json",
        success: function(result) {
            var nombre_persona = result.persona.apellido_paterno + " " + result.persona.apellido_materno + ", " + result.persona.nombres;
            $('#nombre_persona').val(nombre_persona);
            $('#persona_id').val(result.persona.id);
            if (result.persona.titular_id > 0) {
                $("#chkTitular").attr("checked", false);
                $("#denominacion_tit").val(result.persona.denominacion_titular);
                obtenerTitularActual(result.persona.tipo_documento_titular, result.persona.denominacion_titular);
            }
            if (result.persona.titular_id == 0) {
                $("#chkTitular").attr("checked", true);
                $("#denominacion_tit").val(denominacion);
                obtenerTitularActual(tipo_documento, denominacion);
            }
        },
        error: function(data) {
            alert("Persona no encontrada en la Base de Datos.");
            $('#personaModal').modal('show');
        }

    });

}

function obtenerTitularActual(tipo_documento, denominacion) {

    //var tipo_documento = $("#tipo_documento_tit").val();
    //var denominacion = $("#denominacion_tit").val();
    var msg = "";

    if (msg != "") {
        bootbox.alert(msg);
        return false;
    }

    //$('#empresa_id').val("");
    $('#titular_id').val("");

    $.ajax({
        url: '/tabla_maestras/obtener_persona/' + tipo_documento + '/' + denominacion,
        dataType: "json",
        success: function(result) {
            var nombre_titular = result.persona.apellido_paterno + " " + result.persona.apellido_materno + ", " + result.persona.nombres;
            $('#nombre_titular').val(nombre_titular);
            $('#titular_id').val(result.persona.id);
        },
        error: function(data) {
            alert("Persona no encontrada en la Base de Datos.");
            $('#personaTitularModal').modal('show');
        }

    });

}

function obtenerTitular() {

    var tipo_documento = $("#tipo_documento_tit").val();
    var denominacion = $("#denominacion_tit").val();
    var msg = "";

    if (msg != "") {
        bootbox.alert(msg);
        return false;
    }

    //$('#empresa_id').val("");
    $('#titular_id').val("");

    $.ajax({
        url: '/tabla_maestras/obtener_persona/' + tipo_documento + '/' + denominacion,
        dataType: "json",
        success: function(result) {
            var nombre_titular = result.persona.apellido_paterno + " " + result.persona.apellido_materno + ", " + result.persona.nombres;
            $('#nombre_titular').val(nombre_titular);
            $('#titular_id').val(result.persona.id);
        },
        error: function(data) {
            alert("Persona no encontrada en la Base de Datos.");
            $('#personaTitularModal').modal('show');
        }

    });

}

function obtenerPlanDetalle() {

    var plan_costo = $('#plan_id option:selected').attr("plan_costo");
    var periodo = $('#plan_id option:selected').attr("periodo");
    $('#plan_costo').val(plan_costo);
    $('#periodo').val(periodo);

    var id = $('#plan_id').val();
    $.ajax({
        url: '/supervision/obtener_plan_detalle/' + id,
        dataType: "json",
        success: function(result) {
            //var productos = result.productos;
            var option = "";
            $('#tblPlan tbody').html("");
            $(result).each(function(ii, oo) {
                option += "<tr style='font-size:13px'><td class='text-left'>" + oo.pasm_smodulod + "</td><td class='text-left'>" + oo.pasm_precio + "</td></tr>";
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


    var denominacion = $("#denominacion").val();
    $("#tblPago tbody").html("");
	$.ajax({
			url: "/alquiler/obtener_devolucion/"+denominacion,
			type: "GET",
			success: function (result) {
					$("#tblDevolucion tbody").html(result);
			}
	});

}
*/


$('#modalTablamaestraSaveBtn').click(function(e) {
    e.preventDefault();
    $(this).html('Enviando datos..');

    $.ajax({
        data: $('#modalTablamaestraForm').serialize(),
        url: "/afiliacion/nueva_inscripcion_ajax",
        type: "POST",
        dataType: 'json',
        success: function(data) {

            $('#modalTablamaestraForm #modalTablamaestraForm').trigger("reset");
            $('#personaModal').modal('hide');
            $('#denominacion').val(data.denominacion);
            $('#nombre_persona').val(data.nombre_apellido);

            alert("La persona ha sido ingresada correctamente!");

        },
        error: function(data) {
            mensaje = "Revisar el formulario:\n\n";
            $.each(data["responseJSON"].errors, function(key, value) {
                mensaje += value + "\n";
            });
            $("#modalTablamaestraForm #modalTablamaestraSaveBtn").html("Grabar");
            alert(mensaje);
        }
    });
});

$('#modalTablamaestraTitularSaveBtn').click(function(e) {
    e.preventDefault();
    $(this).html('Enviando datos..');

    $.ajax({
        data: $('#modalTablamaestraTitularForm').serialize(),
        url: "/afiliacion/nueva_inscripcion_ajax",
        type: "POST",
        dataType: 'json',
        success: function(data) {

            $('#modalTablamaestraTitularForm #modalTablamaestraForm').trigger("reset");
            $('#personaTitularModal').modal('hide');
            $('#denominacion_tit').val(data.denominacion);
            $('#nombre_titular').val(data.nombre_apellido);

            alert("La persona ha sido ingresada correctamente!");

        },
        error: function(data) {
            mensaje = "Revisar el formulario:\n\n";
            $.each(data["responseJSON"].errors, function(key, value) {
                mensaje += value + "\n";
            });
            $("#modalTablamaestraTitularForm  #modalTablamaestraSaveBtn").html("Grabar");
            alert(mensaje);
        }
    });
});


function datatablenew() {
    var oTable1 = $('#tblAfiliado').dataTable({
        "bServerSide": true,
        "sAjaxSource": "/tabla_maestras/listar_tabla_maestras_ajax",
        "bProcessing": true,
        "sPaginationType": "full_numbers",
        //"paging":false,
        "bFilter": false,
        "bSort": false,
        "info": true,
        //"responsive": true,
        "language": { "url": "/js/Spanish.json" },
        "autoWidth": false,
        "bLengthChange": true,
        "destroy": true,
        "lengthMenu": [
            [10, 50, 100, 200, 60000],
            [10, 50, 100, 200, "Todos"]
        ],
        "aoColumns": [
            {},
        ],
        "dom": '<"top">rt<"bottom"flpi><"clear">',
        "fnDrawCallback": function(json) {
            $('[data-toggle="tooltip"]').tooltip();
        },

        "fnServerData": function(sSource, aoData, fnCallback, oSettings) {

            var sEcho = aoData[0].value;
            var iNroPagina = parseFloat(fn_util_obtieneNroPagina(aoData[3].value, aoData[4].value)).toFixed();
            var iCantMostrar = aoData[4].value;

            var tipo = $('#tipo').val();
            var denominacion = $('#denominacion').val();
            var orden = $('#orden').val();
            var estado = $('#estado').val();
            var codigo = $('#codigo').val();
            var tipo_nombre = $('#tipo_nombre').val();
            var _token = $('#_token').val();
            oSettings.jqXHR = $.ajax({
                "dataType": 'json',
                //"contentType": "application/json; charset=utf-8",
                "type": "POST",
                "url": sSource,
                "data": {
                    NumeroPagina: iNroPagina,
                    NumeroRegistros: iCantMostrar,
                    tipo: tipo,
                    denominacion: denominacion,
                    orden: orden,
                    estado: estado,
                    codigo: codigo,
                    tipo_nombre: tipo_nombre,
                    _token: _token
                },
                "success": function(result) {
                    fnCallback(result);
                },
                "error": function(msg, textStatus, errorThrown) {
                    //location.href="login";
                }
            });
        },

        "aoColumnDefs": [{
                "mRender": function(data, type, row) {
                    var tipo = "";
                    if (row.tipo != null) tipo = row.tipo;
                    return tipo;
                },
                "bSortable": false,
                "aTargets": [0],
                "className": "dt-center",
                //"className": 'control'
            },
            {
                "mRender": function(data, type, row) {
                    var denominacion = "";
                    if (row.denominacion != null) denominacion = row.denominacion;
                    return denominacion;
                },
                "bSortable": false,
                "aTargets": [1]
            },
            {
                "mRender": function(data, type, row) {
                    var orden = "";
                    if (row.orden != null) orden = row.orden;
                    return orden;
                },
                "bSortable": false,
                "aTargets": [2]
            },
            {
                "mRender": function(data, type, row) {
                    var estado = "";
                    if (row.estado != null) estado = row.estado;
                    return estado;
                },
                "bSortable": false,
                "aTargets": [3]
            },
            {
                "mRender": function(data, type, row) {
                    var codigo = "";
                    if (row.codigo != null) codigo = row.codigo;
                    return codigo;
                },
                "bSortable": false,
                "aTargets": [4]
            },
            {
                "mRender": function(data, type, row) {
                    var tipo_nombre = "";
                    if (row.tipo_nombre != null) tipo_nombre = row.tipo_nombre;
                    return tipo_nombre;
                },
                "bSortable": false,
                "aTargets": [5]
            },
            /*{
                "mRender": function (data, type, row) {
                	var tipo_relacion = "";
					if(row.tipo_relacion!= null)tipo_relacion = row.tipo_relacion;
					return tipo_relacion;
                },
                "bSortable": false,
                "aTargets": [5]
                },*/
            {
                "mRender": function(data, type, row) {
                    var nombre_estado = "";
                    if (row.estado == 1) nombre_estado = "Activo";
                    if (row.estado == 0) nombre_estado = "Eliminado";
                    return nombre_estado;
                },
                "bSortable": false,
                "aTargets": [6]
            },
            {
                "mRender": function(data, type, row) {
                    var estado = "";
                    var clase = "";
                    if (row.estado == 'A') {
                        estado = "Eliminar";
                        clase = "btn-danger";
                    }
                    if (row.estado == 'C') {
                        estado = "Activar";
                        clase = "btn-success";
                    }

                    var html = '<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">';
                    html += '<button style="font-size:12px" type="button" class="btn btn-sm btn-success" data-toggle="modal" onclick="modalTablamaestra(' + row.id + ')" ><i class="fa fa-edit"></i> Editar</button>';
                    html += '<a href="javascript:void(0)" onclick=eliminarTablamaestra(' + row.id + ',\'' + row.estado + '\') class="btn btn-sm ' + clase + '" style="font-size:12px;margin-left:10px">' + estado + '</a>';
                    html += '</div>';
                    return html;
                },
                "bSortable": false,
                "aTargets": [7],
            },
        ]


    });

}

function fn_ListarBusqueda() {
    datatablenew();
};

function modalTablamaestra(id) {

    $(".modal-dialog").css("width", "85%");
    $('#openOverlayOpc .modal-body').css('height', 'auto');

    $.ajax({
        url: "/tabla_maestras/modal_tablamaestras/" + id,
        type: "GET",
        success: function(result) {
            $("#diveditpregOpc").html(result);
            $('#openOverlayOpc').modal('show');
        }
    });

}


function eliminarTablamaestra(id, estado) {
    var act_estado = "";
    if (estado == 'A') {
        act_estado = "Eliminar";
        estado_ = 'C';
    }
    if (estado == 'C') {
        act_estado = "Activar";
        estado_ = 'A';
    }
    bootbox.confirm({
        size: "small",
        message: "&iquest;Deseas " + act_estado + " este valor?",
        callback: function(result) {
            if (result == true) {
                fn_eliminar_tabla_maestra(id, estado_);
            }
        }
    });
    $(".modal-dialog").css("width", "30%");
}

function fn_eliminar_tabla_maestra(id, estado) {

    $.ajax({
        url: "/tabla_maestras/eliminar_tabla_maestra/" + id + "/" + estado,
        type: "GET",
        success: function(result) {
            //if(result="success")obtenerPlanDetalle(id_plan);
            datatablenew();
        }
    });
}
