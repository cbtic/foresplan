$(document).ready(function () {
	
	$('#btnBuscar').click(function () {
		fn_ListarBusqueda();
	});
		
	$('#btnNuevo').click(function () {
		modalSeccion(0);
	});

	$('#denominacion').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
		}
	});
		
	datatablenew();

});

function datatablenew(){
                      
    var oTable1 = $('#tblSecciones').dataTable({
        "bServerSide": true,
        "sAjaxSource": "/secciones/listar_seccion_ajax",
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
			
            var almacen = $('#almacen_bus').val();
            var denominacion = $('#denominacion_bus').val();
            var codigo = $('#codigo_bus').val();
			var estado = $('#estado_bus').val();
			
			var _token = $('#_token').val();
            oSettings.jqXHR = $.ajax({
				"dataType": 'json',
                //"contentType": "application/json; charset=utf-8",
                "type": "POST",
                "url": sSource,
                "data":{NumeroPagina:iNroPagina,NumeroRegistros:iCantMostrar,
                        almacen:almacen,denominacion:denominacion,codigo:codigo,estado:estado,
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
                	var codigo_almacen = "";
					if(row.codigo_almacen!= null)codigo_almacen = row.codigo_almacen;
					return codigo_almacen;
                },
                "bSortable": true,
                "aTargets": [1]
                },
				
                {
                "mRender": function (data, type, row) {
                	var almacen = "";
					if(row.almacen!= null)almacen = row.almacen;
					return almacen;
                },
                "bSortable": true,
                "aTargets": [2]
                },
				
				{
                "mRender": function (data, type, row) {
                	var codigo_seccion = "";
					if(row.codigo_seccion!= null)codigo_seccion = row.codigo_seccion;
					return codigo_seccion;
                },
                "bSortable": true,
                "aTargets": [3]
                },

				{
				"mRender": function (data, type, row) {
					var seccion = "";
					if(row.seccion!= null)seccion = row.seccion;
					return seccion;
				},
				"bSortable": true,
				"aTargets": [4]
				},
                {
                "mRender": function (data, type, row) {
                    var html = '<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">';
                        
                    html += '<button style="font-size:12px;color:#FFFFFF;margin-left:10px" type="button" class="btn btn-sm btn-info" data-toggle="modal" onclick="modalVerAnaqueles('+row.id+')"><i class="fa fa-edit" style="font-size:9px!important"></i>Anaqueles</button>';
                    html += '</div>';
                    return html;
                },
                "bSortable": true,
                "aTargets": [5]
                },
				{
					"mRender": function (data, type, row) {
						var estado = "";
						if(row.estado == 1){
							estado = "Activo";
						}
						if(row.estado == 0){
							estado = "Inactivo";
						}
						return estado;
					},
					"bSortable": false,
					"aTargets": [6]
				},
				{
					"mRender": function (data, type, row) {
						var estado = "";
						var clase = "";
						if(row.estado == 1){
							estado = "Eliminar";
							clase = "btn-danger";
						}
						if(row.estado == 0){
							estado = "Activar";
							clase = "btn-success";
						}
						
						var html = '<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">';
						
						html += '<button style="font-size:12px" type="button" class="btn btn-sm btn-success" data-toggle="modal" onclick="modalSeccion('+row.id+')" ><i class="fa fa-edit"></i> Editar</button>'; 
						html += '<a href="javascript:void(0)" onclick=eliminarSeccion('+row.id+','+row.estado+') class="btn btn-sm '+clase+'" style="font-size:12px;margin-left:10px">'+estado+'</a>';
						
						//html += '<a href="javascript:void(0)" onclick=modalResponsable('+row.id+') class="btn btn-sm btn-info" style="font-size:12px;margin-left:10px">Detalle Responsable</a>';
						
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

function modalSeccion(id){
	
	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/secciones/modal_seccion/"+id,
			type: "GET",
			success: function (result) {  
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});

}

function eliminarSeccion(id,estado){
	var act_estado = "";
	if(estado==1){
		act_estado = "Eliminar";
		estado_=0;
	}
	if(estado==0){
		act_estado = "Activar";
		estado_=1;
	}
    bootbox.confirm({ 
        size: "small",
        message: "&iquest;Deseas "+act_estado+" la Seccion?", 
        callback: function(result){
            if (result==true) {
                fn_eliminar(id,estado_);
            }
        }
    });
    $(".modal-dialog").css("width","30%");
}

function fn_eliminar(id,estado){
	
    $.ajax({
            url: "/secciones/eliminar_seccion/"+id+"/"+estado,
            type: "GET",
            success: function (result) {
                //if(result="success")obtenerPlanDetalle(id_plan);
				datatablenew();
            }
    });
}

function modalVerAnaqueles(id){
	
	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/secciones/modal_ver_anaqueles/"+id,
			type: "GET",
			success: function (result) {
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});

}