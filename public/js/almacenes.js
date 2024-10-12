$(document).ready(function () {
	
	$('#btnBuscar').click(function () {
		fn_ListarBusqueda();
	});
		
	$('#btnNuevo').click(function () {
		modalAlmacen(0);
	});

	$('#denominacion_bus').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
			return false;
		}
	});

    $('#encargado_bus').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
			return false;
		}
	});

    $('#estado_bus').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
			return false;
		}
	});
		
	datatablenew();

});

function datatablenew(){
                      
    var oTable1 = $('#tblAlmacenes').dataTable({
        "bServerSide": true,
        "sAjaxSource": "/almacenes/listar_almacenes_ajax",
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
            var encargado = $('#encargado_bus').val();
			var estado = $('#estado_bus').val();
			
			var _token = $('#_token').val();
            oSettings.jqXHR = $.ajax({
				"dataType": 'json',
                //"contentType": "application/json; charset=utf-8",
                "type": "POST",
                "url": sSource,
                "data":{NumeroPagina:iNroPagina,NumeroRegistros:iCantMostrar,
                        denominacion:denominacion,encargado:encargado,estado:estado,
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
                	var codigo = "";
					if(row.codigo!= null)codigo = row.codigo;
					return codigo;
                },
                "bSortable": true,
                "aTargets": [1]
                },

                {
                "mRender": function (data, type, row) {
                    var sigla = "";
                    if(row.sigla!= null)sigla = row.sigla;
                    return sigla;
                },
                "bSortable": true,
                "aTargets": [2]
                },
				
                {
                "mRender": function (data, type, row) {
                	var denominacion = "";
					if(row.denominacion!= null)denominacion = row.denominacion;
					return denominacion;
                },
                "bSortable": true,
                "aTargets": [3]
                },
				
				{
                "mRender": function (data, type, row) {
                	var ubicacion = "";
					if(row.ubicacion!= null)ubicacion = row.ubicacion;
					return ubicacion;
                },
                "bSortable": true,
                "aTargets": [4]
                },

				{
				"mRender": function (data, type, row) {
					var direccion = "";
					if(row.direccion!= null)direccion = row.direccion;
					return direccion;
				},
				"bSortable": true,
				"aTargets": [5]
				},

                {
                    "mRender": function (data, type, row) {
                        var telefono = "";
                        if(row.telefono!= null)telefono = row.telefono;
                        return telefono;
                    },
                    "bSortable": true,
                    "aTargets": [6]
                    },

                {
                "mRender": function (data, type, row) {
                    var encargado = "";
                    if(row.encargado!= null)encargado = row.encargado;
                    return encargado;
                },
                "bSortable": true,
                "aTargets": [7]
                },
                {
                "mRender": function (data, type, row) {
                    var html = '<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">';
                        
                    html += '<button style="font-size:12px;color:#FFFFFF;margin-left:10px" type="button" class="btn btn-sm btn-info" data-toggle="modal" onclick="modalVerUsuarios('+row.id+')"><i class="fa fa-edit" style="font-size:9px!important"></i>Usuarios</button>';
                    html += '</div>';
                    return html;
                },
                "bSortable": true,
                "aTargets": [8]
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
					"aTargets": [9]
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
						
						html += '<button style="font-size:12px" type="button" class="btn btn-sm btn-success" data-toggle="modal" onclick="modalAlmacen('+row.id+')" ><i class="fa fa-edit"></i> Editar</button>'; 
						html += '<a href="javascript:void(0)" onclick=eliminarAlmacen('+row.id+','+row.estado+') class="btn btn-sm '+clase+'" style="font-size:12px;margin-left:10px">'+estado+'</a>';
						
						//html += '<a href="javascript:void(0)" onclick=modalResponsable('+row.id+') class="btn btn-sm btn-info" style="font-size:12px;margin-left:10px">Detalle Responsable</a>';
						
						html += '</div>';
						return html;
					},
					"bSortable": false,
					"aTargets": [10],
				},

            ]


    });

}

function fn_ListarBusqueda() {
    datatablenew();
};

function modalAlmacen(id){
	
	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/almacenes/modal_almacen/"+id,
			type: "GET",
			success: function (result) {  
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});

}

function eliminarAlmacen(id,estado){
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
        message: "&iquest;Deseas "+act_estado+" el Almacen?", 
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
            url: "/almacenes/eliminar_almacen/"+id+"/"+estado,
            type: "GET",
            success: function (result) {
                //if(result="success")obtenerPlanDetalle(id_plan);
				datatablenew();
            }
    });
}

function modalVerUsuarios(id){
	
	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/almacenes/modal_usuario/"+id,
			type: "GET",
			success: function (result) {
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});

}


