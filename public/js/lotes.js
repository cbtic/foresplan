$(document).ready(function () {
	
	$('#btnBuscar').click(function () {
		fn_ListarBusqueda();
	});
		
	$('#btnNuevo').click(function () {
		modalLote(0);
	});

	$('#denominacion').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
		}
	});
		
	datatablenew();

});

function datatablenew(){
                      
    var oTable1 = $('#tblLotes').dataTable({
        "bServerSide": true,
        "sAjaxSource": "/lotes/listar_lote_ajax",
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
			var marca = $('#marca_bus').val();
			var anaquel = $('#anaquel_bus').val();
			var estado = $('#estado_bus').val();
			
			var _token = $('#_token').val();
            oSettings.jqXHR = $.ajax({
				"dataType": 'json',
                //"contentType": "application/json; charset=utf-8",
                "type": "POST",
                "url": sSource,
                "data":{NumeroPagina:iNroPagina,NumeroRegistros:iCantMostrar,
						denominacion:denominacion,marca:marca,anaquel:anaquel,estado:estado,
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
                	var producto = "";
					if(row.producto!= null)producto = row.producto;
					return producto;
                },
                "bSortable": true,
                "aTargets": [1]
                },
				
                {
                "mRender": function (data, type, row) {
                	var marca = "";
					if(row.marca!= null)marca = row.marca;
					return marca;
                },
                "bSortable": true,
                "aTargets": [2]
                },
				
				{
                "mRender": function (data, type, row) {
                	var numero_lote = "";
					if(row.numero_lote!= null)numero_lote = row.numero_lote;
					return numero_lote;
                },
                "bSortable": true,
                "aTargets": [3]
                },

				{
				"mRender": function (data, type, row) {
					var numero_serie = "";
					if(row.numero_serie!= null)numero_serie = row.numero_serie;
					return numero_serie;
				},
				"bSortable": true,
				"aTargets": [4]
				},
				{
				"mRender": function (data, type, row) {
					var unidad_medida = "";
					if(row.unidad_medida!= null)unidad_medida = row.unidad_medida;
					return unidad_medida;
				},
				"bSortable": true,
				"aTargets": [5]
				},
				{
				"mRender": function (data, type, row) {
					var cantidad = "";
					if(row.cantidad!= null)cantidad = row.cantidad;
					return cantidad;
				},
				"bSortable": true,
				"aTargets": [6]
				},
				{
				"mRender": function (data, type, row) {
					var costo = "";
					if(row.costo!= null)costo = row.costo;
					return costo;
				},
				"bSortable": true,
				"aTargets": [7]
				},
				{
				"mRender": function (data, type, row) {
					var moneda = "";
					if(row.moneda!= null)moneda = row.moneda;
					return moneda;
				},
				"bSortable": true,
				"aTargets": [8]
				},
				{
				"mRender": function (data, type, row) {
					var fecha_fabricacion = "";
					if(row.fecha_fabricacion!= null)fecha_fabricacion = row.fecha_fabricacion;
					return fecha_fabricacion;
				},
				"bSortable": true,
				"aTargets": [9]
				},
				{
				"mRender": function (data, type, row) {
					var fecha_vencimiento = "";
					if(row.fecha_vencimiento!= null)fecha_vencimiento = row.fecha_vencimiento;
					return fecha_vencimiento;
				},
				"bSortable": true,
				"aTargets": [10]
				},
				{
				"mRender": function (data, type, row) {
					var codigo_anaquel = "";
					if(row.codigo_anaquel!= null)codigo_anaquel = row.codigo_anaquel;
					return codigo_anaquel;
				},
				"bSortable": true,
				"aTargets": [11]
				},
				{
				"mRender": function (data, type, row) {
					var anaquel = "";
					if(row.anaquel!= null)anaquel = row.anaquel;
					return anaquel;
				},
				"bSortable": true,
				"aTargets": [12]
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
					"aTargets": [13]
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
						
						html += '<button style="font-size:12px" type="button" class="btn btn-sm btn-success" data-toggle="modal" onclick="modalLote('+row.id+')" ><i class="fa fa-edit"></i> Editar</button>'; 
						html += '<a href="javascript:void(0)" onclick=eliminarLote('+row.id+','+row.estado+') class="btn btn-sm '+clase+'" style="font-size:12px;margin-left:10px">'+estado+'</a>';
						
						//html += '<a href="javascript:void(0)" onclick=modalResponsable('+row.id+') class="btn btn-sm btn-info" style="font-size:12px;margin-left:10px">Detalle Responsable</a>';
						
						html += '</div>';
						return html;
					},
					"bSortable": false,
					"aTargets": [14],
				},

            ]


    });

}

function fn_ListarBusqueda() {
    datatablenew();
};

function modalLote(id){
	
	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/lotes/modal_lote/"+id,
			type: "GET",
			success: function (result) {  
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});

}

function eliminarLote(id,estado){
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
        message: "&iquest;Deseas "+act_estado+" el Lote?", 
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
            url: "/lotes/eliminar_lote/"+id+"/"+estado,
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