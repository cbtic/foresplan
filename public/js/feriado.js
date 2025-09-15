$(document).ready(function () {

	$('#btnBuscar').click(function () {
		fn_ListarBusqueda();
	});
	
	$('#btnNuevo').click(function () {
		modalFeriado(0);
	});

	datatablenew();

	$('#fecha_bus').datepicker({
        autoclose: true,
		format: 'yyyy-mm-dd',
		changeMonth: true,
		changeYear: true,
        language: 'es'
    });

});

function datatablenew(){
    var oTable1 = $('#tblFeriado').dataTable({
        "bServerSide": true,
        "sAjaxSource": "/feriado/listar_feriado_ajax",
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
			
            var denominacion = $('#denominacion_bus').val();
			var fecha = $('#fecha_bus').val();
			var _token = $('#_token').val();
            oSettings.jqXHR = $.ajax({
				"dataType": 'json',
                //"contentType": "application/json; charset=utf-8",
                "type": "POST",
                "url": sSource,
                "data":{NumeroPagina:iNroPagina,NumeroRegistros:iCantMostrar,
						denominacion:denominacion,fecha:fecha,
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
						var id = "";
						if(row.id!= null)id = row.id;
						return id;
					},
					"bSortable": false,
					"aTargets": [0],
					"className": "dt-center",
					//"className": 'control'
                },
				
				{
					"mRender": function (data, type, row) {
						var fecha_feriado = "";
						if(row.fecha_feriado!= null)fecha_feriado = row.fecha_feriado;
						return fecha_feriado;
					},
					"bSortable": false,
					"aTargets": [1],
					"className": "dt-center",
					//"className": 'control'
					},				
				{
					"mRender": function (data, type, row) {
						var flag_medio_dia = "";
						if(row.flag_medio_dia == 'N')flag_medio_dia = "NO";
						if(row.flag_medio_dia == 'S')flag_medio_dia = "SI";
						return flag_medio_dia;
					},
					"bSortable": false,
					"aTargets": [2]
                },
                {
					"mRender": function (data, type, row) {
						var salida_medio_dia = "";
						if(row.salida_medio_dia!= null)salida_medio_dia = row.salida_medio_dia;
						return salida_medio_dia;
					},
					"bSortable": false,
					"aTargets": [3]
                },
                {
					"mRender": function (data, type, row) {
						var motivo_feriado = "";
						if(row.motivo_feriado!= null)motivo_feriado = row.motivo_feriado;
						return motivo_feriado;
					},
					"bSortable": false,
					"aTargets": [4]
                },	
				{
					"mRender": function (data, type, row) {
						var flag_no_laborable = "";
						if(row.flag_no_laborable == '0')flag_no_laborable = "NO";
						if(row.flag_no_laborable == '1')flag_no_laborable = "SI";
						return flag_no_laborable;
					},
					"bSortable": false,
					"aTargets": [5]
                },	
				{
					"mRender": function (data, type, row) {
						var flag_recuperacion = "";
						if(row.flag_recuperacion == '0')flag_recuperacion = "NO";
						if(row.flag_recuperacion == '1')flag_recuperacion = "SI";
						return flag_recuperacion;
					},
					"bSortable": false,
					"aTargets": [6]
                },
				{
					"mRender": function (data, type, row) {
						var fecha_inicio_recuperacion = "";
						if(row.fecha_inicio_recuperacion!= null)fecha_inicio_recuperacion = row.fecha_inicio_recuperacion;
						return fecha_inicio_recuperacion;
					},
					"bSortable": false,
					"aTargets": [7]
                },
				{
					"mRender": function (data, type, row) {
						var fecha_fin_recuperacion = "";
						if(row.fecha_fin_recuperacion!= null)fecha_fin_recuperacion = row.fecha_fin_recuperacion;
						return fecha_fin_recuperacion;
					},
					"bSortable": false,
					"aTargets": [8]
                },	
				{
				"mRender": function (data, type, row) {
					/*var estado = "";
					var clase = "";
					if(row.estado == 'A'){
						estado = "Eliminar";
						clase = "btn-danger";
					}
					if(row.estado == 'E'){
						estado = "Activar";
						clase = "btn-success";
					}*/
			
					var html = '<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">';
					html += '<button style="font-size:12px" type="button" class="btn btn-sm btn-success" data-toggle="modal" onclick="modalFeriado('+row.id+')" ><i class="fa fa-edit"></i> Editar</button>';
					//html += '<a href="javascript:void(0)" onclick="eliminarFormula('+row.id+', \''+row.estado+'\')" class="btn btn-sm '+clase+'" style="font-size:12px;margin-left:10px">'+estado+'</a>';
					html += '</div>';
					return html;
				}
				,
                "bSortable": false,
                "aTargets": [9],
                },
            ]
    });
}

function fn_ListarBusqueda() {
    datatablenew();
};

function modalFeriado(id){
	
	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/feriado/modal_feriado/"+id,
			type: "GET",
			success: function (result) {  
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});

}

function eliminarFeriado(id,estado){
	//alert(id);
	var act_estado = "";
	//var eliminado = "";
	if(estado=='A'){
		act_estado = "Eliminar";
		estado_="E";
		//eliminado = "S";
	}
	if(estado=='E'){
		act_estado = "Activar";
		estado_="A";
		//eliminado = "N";
	}
    bootbox.confirm({ 
        size: "small",
        message: "&iquest;Deseas "+act_estado+" el Feriado?", 
        callback: function(result){
            if (result==true) {
                fn_eliminar_feriado(id,estado_);
            }
        }
    });
    $(".modal-dialog").css("width","30%");
}

function fn_eliminar_feriado(id,estado){
	
    $.ajax({
            url: "/feriado/eliminar_feriado/"+id+"/"+estado,
            type: "GET",
            success: function (result) {
                //if(result="success")obtenerPlanDetalle(id_plan);
				datatablenew();
            }
    });
}
