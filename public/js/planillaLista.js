//alert("ok");
//jQuery.noConflict(true);

//const { exists } = require("laravel-mix/src/File");

$(document).ready(function() {



    $('#persona').keyup(function() {
        this.value = this.value.toLocaleUpperCase();
    });

    $('#persona').focusin(function() { $('#persona').select(); });

    $('#persona').autocomplete({
        appendTo: "#persona_busqueda",
        open: function() { $('#persona').autocomplete("widget").width(300) },
        source: function(request, response) {
            $.ajax({
                url: '/persona/list_persona/' + $('#persona').val(),
                dataType: "json",
                success: function(data) {
                    var resp = $.map(data, function(obj) {
                        var hash = { key: obj.id_persona, key1: obj.id_ubicacion, value: obj.persona, value1: obj.razon_social };
                        return hash;
                    });
                    response(resp);
                },
                error: function() {}
            });
        },
        select: function(event, ui) {
            $("#id_persona_bus").val(ui.item.key);
            $("#id_ubicacion").val(ui.item.key1);
            $('#empresa_').val(ui.item.value1);
            //alert(ui.item.value1);
        },
        minLength: 2,
        delay: 100
    });

    $('#btnBuscar').click(function() {
        fn_ListarBusqueda();
    });


    $('#btnNuevo').click(function() {
        modalPapeleta(0);
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

    $("#id_periodo").change(function() {
        if ($("#id_periodo").val() != 0) {
            $("#btnGuardarPDFPlanilla").val("GUARDAR BOLETAS DEL PERIODO " + $("#id_periodo").val());
            $("#btnGuardarPDFPlanilla").removeAttr('disabled');
        } else {
            $("#btnGuardarPDFPlanilla").val("GUARDAR PDF DE BOLETAS");
            $("#btnGuardarPDFPlanilla").attr('disabled', 'disabled');
        }
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
        success: function(result) {
            var nombre_persona = result.persona.apellido_paterno + " " + result.persona.apellido_materno + ", " + result.persona.nombres;
            $('#nombre_persona').val(nombre_persona);
            $('#persona_id').val(result.persona.id);
            if (result.persona.titular_id > 0) {
                $("#chkTitular").attr("checked", false);
                $("#numero_documento_tit").val(result.persona.numero_documento_titular);
                obtenerTitularActual(result.persona.tipo_documento_titular, result.persona.numero_documento_titular);
            }
            if (result.persona.titular_id == 0) {
                $("#chkTitular").attr("checked", true);
                $("#numero_documento_tit").val(numero_documento);
                obtenerTitularActual(tipo_documento, numero_documento);
            }
        },
        error: function(data) {
            alert("Persona no encontrada en la Base de Datos.");
            $('#personaModal').modal('show');
        }

    });

}

function obtenerTitularActual(tipo_documento, numero_documento) {

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


$('#modalPersonaSaveBtn').click(function(e) {
    e.preventDefault();
    $(this).html('Enviando datos..');

    $.ajax({
        data: $('#modalPersonaForm').serialize(),
        url: "/afiliacion/nueva_inscripcion_ajax",
        type: "POST",
        dataType: 'json',
        success: function(data) {

            $('#modalPersonaForm #modalPersonaForm').trigger("reset");
            $('#personaModal').modal('hide');
            $('#numero_documento').val(data.numero_documento);
            $('#nombre_persona').val(data.nombre_apellido);

            alert("La persona ha sido ingresada correctamente!");

        },
        error: function(data) {
            mensaje = "Revisar el formulario:\n\n";
            $.each(data["responseJSON"].errors, function(key, value) {
                mensaje += value + "\n";
            });
            $("#modalPersonaForm #modalPersonaSaveBtn").html("Grabar");
            alert(mensaje);
        }
    });
});

$('#modalPersonaTitularSaveBtn').click(function(e) {
    e.preventDefault();
    $(this).html('Enviando datos..');

    $.ajax({
        data: $('#modalPersonaTitularForm').serialize(),
        url: "/afiliacion/nueva_inscripcion_ajax",
        type: "POST",
        dataType: 'json',
        success: function(data) {

            $('#modalPersonaTitularForm #modalPersonaForm').trigger("reset");
            $('#personaTitularModal').modal('hide');
            $('#numero_documento_tit').val(data.numero_documento);
            $('#nombre_titular').val(data.nombre_apellido);

            alert("La persona ha sido ingresada correctamente!");

        },
        error: function(data) {
            mensaje = "Revisar el formulario:\n\n";
            $.each(data["responseJSON"].errors, function(key, value) {
                mensaje += value + "\n";
            });
            $("#modalPersonaTitularForm  #modalPersonaSaveBtn").html("Grabar");
            alert(mensaje);
        }
    });
});


function datatablenew() {
    var oTable = $('#tblPlanilla').dataTable({
        "bServerSide": true,
        "sAjaxSource": "/planilla/listar_planilla_ajax",
        "bProcessing": true,
        "sPaginationType": "full_numbers",
        "bFilter": false,
        "bSort": false,
        //"info": true,
        "info": false,
        "lengthChange": false,
        //"paging":   false,
        "ordering": false,
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


            var id_area_trabajo = $('#id_area_trabajo_').val();
            var id_unidad_trabajo = $('#id_unidad_trabajo_').val();
            var id_persona = $('#id_persona_bus').val();
            var anio = $('#anio').val();
            var mes = $('#mes').val();
            var id_periodo = $('#id_periodo').val();
            var estado = $('#estado').val();
            var _token = $('#_token').val();

            oSettings.jqXHR = $.ajax({
                "dataType": 'json',
                //"contentType": "application/json; charset=utf-8",
                "type": "POST",
                "url": sSource,
                "data": {
                    NumeroPagina: iNroPagina,
                    NumeroRegistros: iCantMostrar,
                    id_area_trabajo: id_area_trabajo,
                    id_unidad_trabajo: id_unidad_trabajo,
                    id_persona: id_persona,
                    id_periodo: id_periodo,
                    anio: anio,
                    mes: mes,
                    estado: estado,
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
                    var id = "";
                    if (row.id != null) id = row.id;
                    return id;
                },
                "bSortable": false,
                "aTargets": [0],
                "className": "dt-center",
                //"className": 'control'
            },

            {
                "mRender": function(data, type, row) {
                    var tipo_documento = "";
                    if (row.tipo_documento != null) tipo_documento = row.tipo_documento;
                    return tipo_documento;
                },
                "bSortable": false,
                "aTargets": [1],
                "className": "dt-center",
                //"className": 'control'
            },
            {
                "mRender": function(data, type, row) {
                    var numero_documento = "";
                    if (row.numero_documento != null) numero_documento = row.numero_documento;
                    return numero_documento;
                },
                "bSortable": false,
                "aTargets": [2]
            },
            {
                "mRender": function(data, type, row) {
                    var persona = "";
                    if (row.persona != null) persona = row.persona;
                    return persona;
                },
                "bSortable": false,
                "aTargets": [3]
            },
            {
                "mRender": function(data, type, row) {
                    var planilla = "";
                    if (row.planilla != null) planilla = row.planilla;
                    return planilla;
                },
                "bSortable": false,
                "aTargets": [4]
            },
            {
                "mRender": function(data, type, row) {
                    var splanilla = "";
                    if (row.splanilla != null) splanilla = row.splanilla;
                    return splanilla;
                },
                "bSortable": false,
                "aTargets": [5]
            },
            {
                "mRender": function(data, type, row) {
                    var razon_social = "";
                    if (row.razon_social != null) razon_social = row.razon_social;
                    return razon_social;
                },
                "bSortable": false,
                "aTargets": [6]
            },

            {
                "mRender": function(data, type, row) {
                    var html = '<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">';
                    html += '<a href="/boleta_vista_previa/' + $("#id_periodo").val() + '/' + row.id + '" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-search"></i></a>';
                    html += '<a href="/boleta_pdf/' + $("#id_periodo").val() + '/' + row.id + '" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-download"></i></a>';
                    return html;
                },
                "bSortable": false,
                "aTargets": [7],
            },


        ]


    });

    fn_util_LineaDatatable("#tblPlanilla");

    $('#tblPlanilla tbody').on('click', 'tr', function() {
        var anSelected = fn_util_ObtenerNumeroFila(oTable);
        if (anSelected.length != 0) {
            var odtable = $("#tblPlanilla").DataTable();
            var anio = odtable.row(this).data().anio;
            var mes = odtable.row(this).data().peri;
            var persona = odtable.row(this).data().id;
            var id_periodo = $('#id_periodo').val();
			
			cargarPlanillaConcepto(id_periodo, persona);
			
            //cargarIngreso(id_periodo, persona);
            //cargarEgreso(id_periodo, persona);
            //cargarAportaciones(id_periodo, persona);
            //cargarConcepto(anio, mes, persona);
        }
    });
}

function cargarPlanillaConcepto(id_periodo, persona) {
    //alert(anio); exit();

    $("#divPlanillaConcepto").html("");
    $.ajax({
        url: "obtener_concepto_planilla/" + id_periodo + "/" + persona,
        type: "GET",
        success: function(result) {
            $("#divPlanillaConcepto").html(result);
        }
    });

}


function cargarIngreso(id_periodo, persona) {
    //alert(anio); exit();

    $("#tblIngreso tbody").html("");
    $.ajax({
        url: "obtener_concepto_planilla/" + id_periodo + "/" + persona + "/1",
        type: "GET",
        success: function(result) {
            $("#tblIngreso tbody").html(result);
        }
    });

}

function cargarEgreso(id_periodo, persona) {
    //alert(anio); exit();

    $("#tblEgreso tbody").html("");
    $.ajax({
        url: "obtener_concepto_planilla/" + id_periodo + "/" + persona + "/2",
        type: "GET",
        success: function(result) {
            $("#tblEgreso tbody").html(result);
        }
    });

}

function cargarAportaciones(id_periodo, persona) {
    //alert(anio); exit();

    $("#tblAportaciones tbody").html("");
    $.ajax({
        url: "obtener_concepto_planilla/" + id_periodo + "/" + persona + "/3",
        type: "GET",
        success: function(result) {
            $("#tblAportaciones tbody").html(result);
        }
    });

}

function generarPlanilla() {
    var id_periodo = $("#id_periodo").val();

    bootbox.confirm({
        size: "small",
        message: "&iquest;Deseas generar la Planilla?",
        callback: function(result) {
            if (result == true) {
                fn_crear_planilla(id_periodo);
            }
        }
    });
    $(".modal-dialog").css("width", "30%");
}

function fn_crear_planilla(id_periodo) {

    $.ajax({
        url: "/planilla/generar_planilla_calculada_periodo/" + id_periodo,
        type: "GET",
        dataType: 'json',
        success: function(result) {
            //if(result="success")obtenerPlanDetalle(id_plan);

            if (result.sw == false) {
                bootbox.alert(result.msg);
            }

            datatablenew();
        }
    });
}

function guardarPDFPlanilla() {
    var id_periodo = $("#id_periodo").val();

    bootbox.confirm({
        size: "small",
        message: "&iquest;Deseas descargar la Planilla en formato PDF?",
        callback: function(result) {
            if (result == true) {
                fn_grabar_planilla(id_periodo);
            }
        }
    });
    $(".modal-dialog").css("width", "30%");
}

function fn_grabar_planilla(id_periodo) {

    $.ajax({
        url: "/genera_boletas/" + id_periodo,
        type: "GET",
        dataType: 'json',
        success: function(result) {
            //if(result="success")obtenerPlanDetalle(id_plan);

            if (result.sw == false) {
                bootbox.alert(result.msg);
            }

            datatablenew();
        }
    });
}

/*
function cargarAportaciones(anio, mes, persona) {
    //alert(anio); exit();

    $("#tblAportaciones tbody").html("");
    $.ajax({
        url: "obtener_concepto_planilla/" + id_periodo + "/" + persona + "/4",
        type: "GET",
        success: function(result) {
            $("#tblAportaciones tbody").html(result);
        }
    });

}
*/

function fn_ListarBusqueda() {
    //datatablenew();
	$('#tblPlanilla').DataTable().ajax.reload();;
};

function modalPapeleta(id) {

    $(".modal-dialog").css("width", "85%");
    $('#openOverlayOpc .modal-body').css('height', 'auto');

    $.ajax({
        url: "/papeleta/modal_papeleta/" + id,
        type: "GET",
        success: function(result) {
            $("#diveditpregOpc").html(result);
            $('#openOverlayOpc').modal('show');
        }
    });

}


function eliminarPapeleta(id, estado) {
    //alert(id);
    var act_estado = "";
    //var eliminado = "";
    if (estado == 1) {
        act_estado = "Eliminar";
        estado_ = "S";
        //eliminado = "S";
    }
    if (estado == 0) {
        act_estado = "Activar";
        estado_ = "N";
        //eliminado = "N";
    }
    bootbox.confirm({
        size: "small",
        message: "&iquest;Deseas " + act_estado + " la Papeleta?",
        callback: function(result) {
            if (result == true) {
                fn_eliminar_papeleta(id, estado_);
            }
        }
    });
    $(".modal-dialog").css("width", "30%");
}

function fn_eliminar_papeleta(id, estado) {

    $.ajax({
        url: "/papeleta/eliminar_papeleta/" + id + "/" + estado,
        type: "GET",
        success: function(result) {
            //if(result="success")obtenerPlanDetalle(id_plan);
            datatablenew();
        }
    });
}