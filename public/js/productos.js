$(document).ready(function () {
	
	$('#btnBuscar').click(function () {
		fn_ListarBusqueda();
	});
		
	$('#btnNuevo').click(function () {
		modalProducto(0);
	});

	$('#serie_bus').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
			return false;
		}
	});

	$('#codigo_bus').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
			return false;
		}
	});

	$('#denominacion_bus').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
			return false;
		}
	});

	$('#estado_bien_bus').keypress(function(e){
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
                      
    var oTable1 = $('#tblProductos').dataTable({
        "bServerSide": true,
        "sAjaxSource": "/productos/listar_producto_ajax",
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
			
            var serie = $('#serie_bus').val();
            var codigo = $('#codigo_bus').val();
            var denominacion = $('#denominacion_bus').val();
			var estado_bien = $('#estado_bien_bus').val();
			var estado = $('#estado_bus').val();
			
			var _token = $('#_token').val();
            oSettings.jqXHR = $.ajax({
				"dataType": 'json',
                //"contentType": "application/json; charset=utf-8",
                "type": "POST",
                "url": sSource,
                "data":{NumeroPagina:iNroPagina,NumeroRegistros:iCantMostrar,
						serie:serie,denominacion:denominacion,codigo:codigo,estado_bien:estado_bien,estado:estado,
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
                	var numero_serie = "";
					if(row.numero_serie!= null)numero_serie = row.numero_serie;
					return numero_serie;
                },
                "bSortable": true,
                "aTargets": [1]
                },

				{
				"mRender": function (data, type, row) {
					var denominacion = "";
					if(row.denominacion!= null)denominacion = row.denominacion;
					return denominacion;
				},
				"bSortable": true,
				"aTargets": [2]
				},
				
                {
                "mRender": function (data, type, row) {
                	var codigo = "";
					if(row.codigo!= null)codigo = row.codigo;
					return codigo;
                },
                "bSortable": true,
                "aTargets": [3]
                },

				{
				"mRender": function (data, type, row) {
					var unidad = "";
					if(row.unidad!= null)unidad = row.unidad;
					return unidad;
				},
				"bSortable": true,
				"aTargets": [4]
				},
				{
				"mRender": function (data, type, row) {
					var contenido = "";
					if(row.contenido!= null)contenido = row.contenido;
					return contenido;
				},
				"bSortable": true,
				"aTargets": [5]
				},
				{
				"mRender": function (data, type, row) {
					var unidad_medida = "";
					if(row.unidad_medida!= null)unidad_medida = row.unidad_medida;
					return unidad_medida;
				},
				"bSortable": true,
				"aTargets": [6]
				},
				{
				"mRender": function (data, type, row) {
					var marca = "";
					if(row.marca!= null)marca = row.marca;
					return marca;
				},
				"bSortable": true,
				"aTargets": [7]
				},
				{
				"mRender": function (data, type, row) {
					var unidad_medida_producto = "";
					if(row.unidad_medida_producto!= null)unidad_medida_producto = row.unidad_medida_producto;
					return unidad_medida_producto;
				},
				"bSortable": true,
				"aTargets": [8]
				},
				{
				"mRender": function (data, type, row) {
					var estado_bien = "";
					if(row.estado_bien!= null)estado_bien = row.estado_bien;
					return estado_bien;
				},
				"bSortable": true,
				"aTargets": [9]
				},
				{
				"mRender": function (data, type, row) {
					var stock = "";
					if(row.stock!= null)stock = row.stock;
					return stock;
				},
				"bSortable": true,
				"aTargets": [10]
				},
				{
				"mRender": function (data, type, row) {
					var fecha_vencimiento = "";
					if(row.fecha_vencimiento!= null)fecha_vencimiento = row.fecha_vencimiento;
					return fecha_vencimiento;
				},
				"bSortable": true,
				"aTargets": [11]
				},
				{
				"mRender": function (data, type, row) {
					var stock_minimo = "";
					if(row.stock_minimo!= null)stock_minimo = row.stock_minimo;
					return stock_minimo;
				},
				"bSortable": true,
				"aTargets": [12]
				},
				{
				"mRender": function (data, type, row) {
					var stock_actual = "";
					if(row.stock_actual!= null)stock_actual = row.stock_actual;
					return stock_actual;
				},
				"bSortable": true,
				"aTargets": [13]
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
					"aTargets": [14]
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
						
						html += '<button style="font-size:12px" type="button" class="btn btn-sm btn-success" data-toggle="modal" onclick="modalProducto('+row.id+')" ><i class="fa fa-edit"></i> Editar</button>'; 
						html += '<a href="javascript:void(0)" onclick=eliminarProducto('+row.id+','+row.estado+') class="btn btn-sm '+clase+'" style="font-size:12px;margin-left:10px">'+estado+'</a>';
						
						//html += '<a href="javascript:void(0)" onclick=modalResponsable('+row.id+') class="btn btn-sm btn-info" style="font-size:12px;margin-left:10px">Detalle Responsable</a>';
						
						html += '</div>';
						return html;
					},
					"bSortable": false,
					"aTargets": [15],
				},

            ]


    });

}

function fn_ListarBusqueda() {
    datatablenew();
};

function modalProducto(id){
	
	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/productos/modal_producto/"+id,
			type: "GET",
			success: function (result) {  
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});

}

function eliminarProducto(id,estado){
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
        message: "&iquest;Deseas "+act_estado+" el Producto?", 
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
            url: "/productos/eliminar_producto/"+id+"/"+estado,
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