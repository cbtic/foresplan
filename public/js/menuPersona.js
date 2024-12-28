$(document).ready(function () {

	$('#btnBuscar').click(function () {
		fn_ListarBusqueda();
	});
	
	$('#btnNuevo').click(function () {
		modalMenuPersona(0);
	});

	$("#concepto_bus").select2({ width: '100%' });
	

	datatablenew();

	//alert("ok");	
	/*
	$("#ubicacion_id").select2();
	
	$('#fecha_inicio').datepicker({
        autoclose: true,
		dateFormat: 'dd/mm/yy',
		changeMonth: true,
		changeYear: true,
    });
	
	$('#fecha_vencimiento').datepicker({
        autoclose: true,
        dateFormat: 'dd/mm/yy',
		changeMonth: true,
		changeYear: true,
    });
	*/
	
	/*
	$('#persona_').keyup(function() {
		this.value = this.value.toLocaleUpperCase();
	});
		
	$('#persona_').focusin(function() { $('#persona_').select(); });
	
	$('#persona_').autocomplete({
		appendTo: "#persona_busqueda",
		source: function(request, response) {
			$.ajax({
			url: '/personalTurno/list_persona/'+$('#persona_').val(),
			dataType: "json",
			success: function(data){
			   var resp = $.map(data,function(obj){
					var hash = {key: obj.id, value: obj.persona};
					return hash;
			   }); 
			   response(resp);
			},
			error: function() {
			}
		});
		},
		select: function (eventx, ui) {
			//$("#id_persona").val(ui.item.key);
			Livewire.emit('getIdPersona',ui.item.key);
			
		},
			minLength: 2,
			delay: 100
	  });
  	*/


});

function datatablenew(){
    var oTable1 = $('#tblMenuPersona').dataTable({
        "bServerSide": true,
        "sAjaxSource": "/menu_persona/listar_menu_persona_ajax",
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
			
			var numero_documento = $('#numero_documento_bus').val();
			var persona = $('#persona_bus').val();
			var fecha = $('#fecha_bus').val();
			var estado = $('#estado_bus').val();
			var _token = $('#_token').val();
            oSettings.jqXHR = $.ajax({
				"dataType": 'json',
                //"contentType": "application/json; charset=utf-8",
                "type": "POST",
                "url": sSource,
                "data":{NumeroPagina:iNroPagina,NumeroRegistros:iCantMostrar,
						numero_documento:numero_documento,persona:persona,fecha:fecha,
						estado:estado,_token:_token
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
						var nombres = "";
						if(row.nombres!= null)nombres = row.nombres;
						return nombres;
					},
					"bSortable": false,
					"aTargets": [3]
                },
				{
					"mRender": function (data, type, row) {
						var fecha = "";
						if(row.fecha!= null)fecha = row.fecha;
						return fecha;
					},
					"bSortable": false,
					"aTargets": [4]
                },
				{
					"mRender": function (data, type, row) {
						var menu = "";
						if(row.menu!= null)menu = row.menu;
						return menu;
					},
					"bSortable": false,
					"aTargets": [5]
                },
				{
					"mRender": function (data, type, row) {
						var estado = "";
						if(row.estado == '1')estado = "Activo";
						if(row.estado == '0')estado = "Inactivo";
						return estado;
					},
					"bSortable": false,
					"aTargets": [6]
                },			
				{
				"mRender": function (data, type, row) {
					var estado = "";
					var clase = "";
					if(row.estado == '1'){
						estado = "Eliminar";
						clase = "btn-danger";
					}
					if(row.estado == '0'){
						estado = "Activar";
						clase = "btn-success";
					}
			
					var html = '<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">';
					html += '<button style="font-size:12px" type="button" class="btn btn-sm btn-success" data-toggle="modal" onclick="modalMenuPersona('+row.id+')" ><i class="fa fa-edit"></i> Editar</button>';
					html += '<a href="javascript:void(0)" onclick="eliminarMenuPersona('+row.id+', \''+row.estado+'\')" class="btn btn-sm '+clase+'" style="font-size:12px;margin-left:10px">'+estado+'</a>';
					html += '</div>';
					return html;
				}
				,
                "bSortable": false,
                "aTargets": [7],
                },
            ]
    });
}

function fn_ListarBusqueda() {
    datatablenew();
};

function modalMenuPersona(id){
	
	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/menu_persona/modal_persona_menu/"+id,
			type: "GET",
			success: function (result) {  
					$("#diveditpregOpc").html(result);
					$('#openOverlayOpc').modal('show');
			}
	});

}

function eliminarMenu(id,estado){
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
        message: "&iquest;Deseas "+act_estado+" el Registro?", 
        callback: function(result){
            if (result==true) {
                fn_eliminar_menu_persona(id,estado_);
            }
        }
    });
    $(".modal-dialog").css("width","30%");
}

function fn_eliminar_menu_persona(id,estado){
	
    $.ajax({
            url: "/menu_persona/eliminar_menu_persona/"+id+"/"+estado,
            type: "GET",
            success: function (result) {
                //if(result="success")obtenerPlanDetalle(id_plan);
				datatablenew();
            }
    });
}
