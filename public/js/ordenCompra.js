$(document).ready(function () {
	
	$('#btnBuscar').click(function () {
		fn_ListarBusqueda();
	});

	$('#btnNuevo').click(function () {
		modalOrdenCompra(0);
	});

	$('#tipo_documento_bus').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
			return false;
		}
	});

	$('#empresa_compra_bus').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
			return false;
		}
	});

	$('#empresa_vende_bus').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
			return false;
		}
	});

	$('#fecha_bus').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
			return false;
		}
	});

	$('#numero_orden_compra_bus').keypress(function(e){
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

	$('#fecha_bus').datepicker({
        autoclose: true,
		format: 'yyyy-mm-dd',
		changeMonth: true,
		changeYear: true,
        language: 'es'
    });
		
	datatablenew();

});

function datatablenew(){
                      
    var oTable1 = $('#tblOrdenCompra').dataTable({
        "bServerSide": true,
        "sAjaxSource": "/orden_compra/listar_orden_compra_ajax",
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
			
            var tipo_documento = $('#tipo_documento_bus').val();
			var empresa_compra = $('#empresa_compra_bus').val();
			var empresa_vende = $('#empresa_vende_bus').val();
			var fecha = $('#fecha_bus').val();
			var numero_orden_compra = $('#numero_orden_compra_bus').val();
			var situacion = $('#situacion_bus').val();
			var almacen_origen = $('#almacen_origen_bus').val();
			var almacen_destino = $('#almacen_destino_bus').val();
			var estado = $('#estado_bus').val();
			
			var _token = $('#_token').val();
            oSettings.jqXHR = $.ajax({
				"dataType": 'json',
                //"contentType": "application/json; charset=utf-8",
                "type": "POST",
                "url": sSource,
                "data":{NumeroPagina:iNroPagina,NumeroRegistros:iCantMostrar,
						tipo_documento:tipo_documento,empresa_compra:empresa_compra,empresa_vende:empresa_vende,
						fecha:fecha,numero_orden_compra:numero_orden_compra,almacen_origen:almacen_origen,
						almacen_destino:almacen_destino,situacion:situacion,estado:estado,
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
						var tipo_documento = "";
						if(row.tipo_documento!= null)tipo_documento = row.tipo_documento;
						return tipo_documento;
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
                	var empresa_compra = "";
					if(row.empresa_compra!= null)empresa_compra = row.empresa_compra;
					return empresa_compra;
                },
                "bSortable": true,
                "aTargets": [2]
                },
				
				{
                "mRender": function (data, type, row) {
                	var empresa_vende = "";
					if(row.empresa_vende!= null)empresa_vende = row.empresa_vende;
					return empresa_vende;
                },
                "bSortable": true,
                "aTargets": [3]
                },

				{
				"mRender": function (data, type, row) {
					var fecha_orden_compra = "";
					if(row.fecha_orden_compra!= null)fecha_orden_compra = row.fecha_orden_compra;
					return fecha_orden_compra;
				},
				"bSortable": true,
				"aTargets": [4]
				},
				{
				"mRender": function (data, type, row) {
					var numero_orden_compra = "";
					if(row.numero_orden_compra!= null)numero_orden_compra = row.numero_orden_compra;
					return numero_orden_compra;
				},
				"bSortable": true,
				"aTargets": [5]
				},
				{
				"mRender": function (data, type, row) {
					var almacen_origen = "";
					if(row.almacen_origen!= null)almacen_origen = row.almacen_origen;
					return almacen_origen;
				},
				"bSortable": true,
				"aTargets": [6]
				},
				{
				"mRender": function (data, type, row) {
					var almacen_destino = "";
					if(row.almacen_destino!= null)almacen_destino = row.almacen_destino;
					return almacen_destino;
				},
				"bSortable": true,
				"aTargets": [7]
				},
				{
				"mRender": function (data, type, row) {
					var cerrado = "";
					if(row.cerrado!= null)cerrado = row.cerrado;
					return cerrado;
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
						
						html += '<button style="font-size:12px" type="button" class="btn btn-sm btn-success" data-toggle="modal" onclick="modalOrdenCompra('+row.id+')" ><i class="fa fa-edit"></i> Editar</button>'; 
						html += '<a href="javascript:void(0)" onclick=eliminarOrdenCompra('+row.id+','+row.estado+') class="btn btn-sm '+clase+'" style="font-size:12px;margin-left:10px">'+estado+'</a>';
						if(almacenUsuario.some(almacen => almacen.id_almacen == row.id_almacen_destino) && row.id_cerrado==1){
							html += '<button style="font-size:12px; margin-left:10px" type="button" class="btn btn-sm btn-info" data-toggle="modal" onclick="modalEntradaProductoOrdenCompra('+row.id+','+row.id_tipo_documento+')">Atender</button>';
						}else{
							html += '<button style="font-size:12px; margin-left:10px" type="button" class="btn btn-sm btn-info" data-toggle="modal" onclick="modalEntradaProductoOrdenCompra('+row.id+','+row.id_tipo_documento+')" disabled>Atender</button>';
						}
						
						html += '<button style="font-size:12px; margin-left:10px" type="button" class="btn btn-sm btn-warning" data-toggle="modal" onclick="modalHistorialEntradaProducto('+row.id+','+row.id_tipo_documento+')">Historial</button>';  
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

function modalOrdenCompra(id){
	
	/*var tipo_mov="";
	if(tipo=='INGRESO'){tipo_mov=1};
	if(tipo=='SALIDA'){tipo_mov=2};*/

	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/orden_compra/modal_orden_compra/"+id,
			type: "GET",
			success: function (result) {  
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});
}

function eliminarOrdenCompra(id,estado){
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
        message: "&iquest;Deseas "+act_estado+" la Orden de Compra?", 
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
            url: "/orden_compra/eliminar_orden_compra/"+id+"/"+estado,
            type: "GET",
            success: function (result) {
                //if(result="success")obtenerPlanDetalle(id_plan);
				datatablenew();
            }
    });
}

function modalEntradaProductoOrdenCompra(id,id_tipo_documento){

	//var tipo = $('#tipo_documento').val();
	
	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/entrada_productos/modal_detalle_producto_orden_compra/"+id+"/"+id_tipo_documento,
			type: "GET",
			success: function (result) {  
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});
}

function modalHistorialEntradaProducto(id, id_tipo_documento){

	$.ajax({
		url: "/entrada_productos/modal_historial_entrada_producto/"+id+"/"+id_tipo_documento,
		type: "GET",
		success: function (result) {
				$("#diveditpregOpc").html(result);
				$('#openOverlayOpc').modal('show');
		}
	});
}
