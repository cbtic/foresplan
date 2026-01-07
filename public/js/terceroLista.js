//jQuery.noConflict(true);

$(document).ready(function () {

	$('#btnBuscar').click(function () {
		fn_ListarBusqueda();
	});

	datatablenew();
});

function datatablenew(){
  var oTable1 = $('#tblTercero').dataTable({
    "bServerSide": true,
    "sAjaxSource": "/terceros/buscar",
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

        var sede = $('#id_sede').val();
        var numero_documento = $('#numero_documento').val();
        var persona = $('#persona').val();
        var unidad = $('#unidad_trabajo').val();
        var estado = $('#estado').val();
        var periodo_anio = $('#periodo_anio').val();
        var periodo_mes = $('#periodo_mes').val();
        var _token = $('#_token').val();
        oSettings.jqXHR = $.ajax({
        "dataType": 'json',
          //"contentType": "application/json; charset=utf-8",
          "type": "POST",
          "url": sSource,
          "data":{ NumeroPagina:iNroPagina, NumeroRegistros:iCantMostrar,
            numero_documento:numero_documento, persona:persona,
            id_sede:sede, periodo_anio: periodo_anio, periodo_mes: periodo_mes,
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
            var id_pe = "";
            if(row.id_pe!= null)id_pe = row.id_pe;
            return id_pe;
          },
          "bSortable": false,
          "aTargets": [0],
          "className": "dt-center",
          //"className": 'control'
        },

        {
          "mRender": function (data, type, row) {
            var tipo_documento = "";
            if(row.tipo_documento!= null)tipo_documento = row.tipo_documento;
            return tipo_documento;
          },
          "bSortable": false,
          "aTargets": [1],
          "className": "dt-center",
          //"className": 'control'
          },
        {
          "mRender": function (data, type, row) {
            var numero_documento = "";
            if(row.numero_documento!= null)numero_documento = row.numero_documento;
            return numero_documento;
          },
          "bSortable": false,
          "aTargets": [2]
        },
        {
          "mRender": function (data, type, row) {
            var persona = "";
            if(row.persona!= null)persona = row.persona;
            return persona;
          },
          "bSortable": false,
          "aTargets": [3]
        },
        {
          "mRender": function (data, type, row) {
            var fecha_nacimiento = "";
            if(row.fecha_nacimiento!= null)fecha_nacimiento = row.fecha_nacimiento;
            return fecha_nacimiento;
          },
          "bSortable": false,
          "aTargets": [4]
        },
        {
          "mRender": function (data, type, row) {
            var sexo = "";
            if(row.sexo == "M")sexo = "Masculino";
            if(row.sexo == "F")sexo = "Femenino";
            return sexo;
          },
          "bSortable": false,
          "aTargets": [5]
        },
        {
          "mRender": function (data, type, row) {
            var condicion_laboral = "";
            if(row.condicion_laboral!= null)condicion_laboral = row.condicion_laboral;
            return condicion_laboral;
          },
          "bSortable": false,
          "aTargets": [6]
        },
        {
          "mRender": function (data, type, row) {
            var area_trabajo = "";
            if(row.area_trabajo!= null)area_trabajo= row.area_trabajo;
            return area_trabajo;
          },
          "bSortable": false,
          "aTargets": [7]
        },
        {
          "mRender": function (data, type, row) {
            var unidad_trabajo = "";
            if(row.unidad_trabajo!= null)unidad_trabajo = row.unidad_trabajo;
            return unidad_trabajo;
          },
          "bSortable": false,
          "aTargets": [8]
                },

        {
          "mRender": function (data, type, row) {
            var estado = "";
            if(row.estado == 'A')estado = "Activo";
            if(row.estado == 'C')estado = "Cesado";
            return estado;
          },
          "bSortable": false,
          "aTargets": [9]
        },
        {
          "mRender": function (data, type, row) {
            var importe_ultimo_recibo = "";
            if(row.importe_ultimo_recibo!= null)importe_ultimo_recibo= row.importe_ultimo_recibo;
            return importe_ultimo_recibo;
          },
          "bSortable": false,
          "aTargets": [10]
        },
        {
          "mRender": function (data, type, row) {
            var importe_total_recibos= "";
            if(row.importe_total_recibos!= null)importe_total_recibos= row.importe_total_recibos;
            return importe_total_recibos;
          },
          "bSortable": false,
          "aTargets": [11]
        },

          /*
        {
          "mRender": function (data, type, row) {
            var mont_cont_ctr = "";
            var canSeeSalary = $('#tblTercero').data('salary');
            if(canSeeSalary){
              if(row.mont_cont_ctr!= null)mont_cont_ctr = row.mont_cont_ctr;
              return mont_cont_ctr;
            }else{ return '' }
          },
          "bSortable": false,
          "aTargets": [10]
                },*/

        {
          "mRender": function (data, type, row) {
            var estado = "";
            var clase = "";
            estado = "Eliminar";
            clase = "btn-danger";
            accion = "1";
            var html = '<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">';
            html += '<button style="font-size:12px" type="button" class="btn btn-sm btn-success" data-toggle="modal" onclick="modalTercero('+row.id_pe+')" ><i class="fa fa-edit"></i> Registrar recibo</button>';

            html += '</div>';
            return html;
          },
          "bSortable": false,
          "aTargets": [12],
        },
      ]

    });

}

function fn_ListarBusqueda() {
    datatablenew();
};

function modalTercero(persona_id){

  $(".modal-dialog").css("width","85%");
  $('#openOverlayOpc .modal-body').css('height', 'auto');

  $.ajax({
    url: "/terceros/"+persona_id+"/recibos/create",
    type: "GET",
    success: function (result) {
      $("#diveditpregOpc").html(result);
      $('#openOverlayOpc').modal('show');
    }
  });

}

$(function () {
    var RETENCION_PORCENTAJE = 0.08;

    function sanitizePositive($input) {
        var val = parseFloat($input.val());
        if (isNaN(val) || val < 0) {
            $input.val('');
        }
    }

    function calcularImporteRetenido() {
        var aplicaRetencion = $('#retencion_si').is(':checked');
        var importe = parseFloat($('#importe').val());

        if (!aplicaRetencion || isNaN(importe)) {
            $('#importe_retenido').val('');
            return;
        }

        var retenido = importe * RETENCION_PORCENTAJE;
        $('#importe_retenido').val(retenido.toFixed(2));
    }

    // Solo positivos en inputs numéricos (incluidos los del modal)
    $(document).on('input', '#importe, #importe_retenido', function () {
        sanitizePositive($(this));
    });

    // Recalcular cuando cambia importe
    $(document).on('input', '#importe', function () {
        calcularImporteRetenido();
    });

    // Radio: Sí → calcular, No → limpiar
    $(document).on('change', '#retencion_si', function () {
        if ($(this).is(':checked')) {
            calcularImporteRetenido();
        }
    });

    $(document).on('change', '#retencion_no', function () {
        if ($(this).is(':checked')) {
            $('#importe_retenido').val('');
        }
    });
});

