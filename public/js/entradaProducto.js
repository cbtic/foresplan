$(document).ready(function () {
	
	$('#btnBuscar').click(function () {
		fn_ListarBusqueda();
	});

	$('#btnNuevo').click(function () {
		modalEntradaProducto(0,0);
	});

	$('#tipo_movimiento_bus').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
			return false;
		}
	});

	$('#tipo_documento_bus').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
			return false;
		}
	});

	$('#unidad_origen_bus').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
			return false;
		}
	});

	$('#almacen_destino_bus').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
			return false;
		}
	});

	$('#proveedor_bus').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
			return false;
		}
	});

	$('#numero_comprobante_bus').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
			return false;
		}
	});

	$('#situacion_bus').keypress(function(e){
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
                      
    var oTable1 = $('#tblEntradaProductos').dataTable({
        "bServerSide": true,
        "sAjaxSource": "/entrada_productos/listar_entrada_productos_ajax",
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
			
            var tipo_movimiento = $('#tipo_movimiento_bus').val();
			var tipo_documento = $('#tipo_documento_bus').val();
			var unidad_origen = $('#unidad_origen_bus').val();
			var almacen_destino = $('#almacen_destino_bus').val();
			var proveedor = $('#proveedor_bus').val();
			var numero_comprobante = $('#numero_comprobante_bus').val();
			var situacion = $('#situacion_bus').val();
			var estado = $('#estado_bus').val();
			
			var _token = $('#_token').val();
            oSettings.jqXHR = $.ajax({
				"dataType": 'json',
                //"contentType": "application/json; charset=utf-8",
                "type": "POST",
                "url": sSource,
                "data":{NumeroPagina:iNroPagina,NumeroRegistros:iCantMostrar,
						tipo_movimiento:tipo_movimiento,tipo_documento:tipo_documento,unidad_origen:unidad_origen,
						almacen_destino:almacen_destino,proveedor:proveedor,numero_comprobante:numero_comprobante,
						situacion:situacion,estado:estado,
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
						var tipo = "";
						if(row.tipo!= null)tipo = row.tipo;
						return tipo;
					},
					"bSortable": true,
					"aTargets": [1]
					},
				
				/*{
                "mRender": function (data, type, row) {
                	var ingreso = "";
					if(row.ingreso!= null)ingreso = row.ingreso;
					return ingreso;
                },
                "bSortable": true,
                "aTargets": [2]
                },*/
				
                {
                "mRender": function (data, type, row) {
                	var tipo_documento = "";
					if(row.tipo_documento!= null)tipo_documento = row.tipo_documento;
					return tipo_documento;
                },
                "bSortable": true,
                "aTargets": [2]
                },
				
				{
                "mRender": function (data, type, row) {
                	var unidad_origen = "";
					if(row.unidad_origen!= null)unidad_origen = row.unidad_origen;
					return unidad_origen;
                },
                "bSortable": true,
                "aTargets": [3]
                },

				{
				"mRender": function (data, type, row) {
					var razon_social = "";
					if(row.razon_social!= null)razon_social = row.razon_social;
					return razon_social;
				},
				"bSortable": true,
				"aTargets": [4]
				},

				{
				"mRender": function (data, type, row) {
					var almacen = "";
					if(row.almacen!= null)almacen = row.almacen;
					return almacen;
				},
				"bSortable": true,
				"aTargets": [5]
				},

				{
				"mRender": function (data, type, row) {
					var codigo = "";
					if(row.codigo!= null)codigo = row.codigo;
					return codigo;
				},
				"bSortable": true,
				"aTargets": [6]
				},
				{
				"mRender": function (data, type, row) {
					var fecha_comprobante = "";
					if(row.fecha_comprobante!= null)fecha_comprobante = row.fecha_comprobante;
					return fecha_comprobante;
				},
				"bSortable": true,
				"aTargets": [7]
				},
				{
				"mRender": function (data, type, row) {
					var usuario_recibe = "";
					if(row.usuario_recibe!= null)usuario_recibe = row.usuario_recibe;
					return usuario_recibe;
				},
				"bSortable": true,
				"aTargets": [8]
				},
				{
				"mRender": function (data, type, row) {
					var cerrado = "";
					//if(row.cerrado_nombre!= null)cerrado_nombre = row.cerrado_nombre;
					if(row.cerrado == 1){
						cerrado = "ABIERTO";
					}
					if(row.cerrado == 2){
						cerrado = "CERRADO";
					}
					return cerrado;
				},
				"bSortable": true,
				"aTargets": [9]
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
					"aTargets": [10]
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
						
						var tipo_mov="";
						if(row.tipo=='INGRESO'){tipo_mov=1}
						if(row.tipo=='SALIDA'){tipo_mov=2}
						var html = '<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">';
						
						html += '<button style="font-size:12px" type="button" class="btn btn-sm btn-success" data-toggle="modal" onclick="modalEntradaProducto('+row.id+','+tipo_mov+')" ><i class="fa fa-edit"></i> Editar</button>'; 
						html += '<a href="javascript:void(0)" onclick=eliminarEntradaProducto('+row.id+','+row.estado+') class="btn btn-sm '+clase+'" style="font-size:12px;margin-left:10px">'+estado+'</a>';
						
						//html += '<a href="javascript:void(0)" onclick=modalResponsable('+row.id+') class="btn btn-sm btn-info" style="font-size:12px;margin-left:10px">Detalle Responsable</a>';
						
						html += '</div>';
						return html;
					},
					"bSortable": false,
					"aTargets": [11],
				},

            ]


    });

}

function fn_ListarBusqueda() {
    datatablenew();
};

function modalEntradaProducto(id, tipo){
	
	/*var tipo_mov="";
	if(tipo=='INGRESO'){tipo_mov=1};
	if(tipo=='SALIDA'){tipo_mov=2};*/

	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/entrada_productos/modal_detalle_producto/"+id+"/"+tipo,
			type: "GET",
			success: function (result) {  
					//console.log(result);
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});
}

function eliminarEntradaProducto(id,estado){
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
        message: "&iquest;Deseas "+act_estado+" la entrada?", 
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
            url: "/entrada_productos/eliminar_entrada_producto/"+id+"/"+estado,
            type: "GET",
            success: function (result) {
                //if(result="success")obtenerPlanDetalle(id_plan);
				datatablenew();
            }
    });
}
