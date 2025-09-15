$(document).ready(function () {

	$('#btnBuscar').click(function () {
		fn_ListarBusqueda();
	});
	
	$('#btnNuevo').click(function () {
		modalMenu(0);
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
    var oTable1 = $('#tblMenu').dataTable({
        "bServerSide": true,
        "sAjaxSource": "/menu_persona/listar_menu_ajax",
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
			var estado = $('#estado_bus').val();
			var _token = $('#_token').val();
            oSettings.jqXHR = $.ajax({
				"dataType": 'json',
                //"contentType": "application/json; charset=utf-8",
                "type": "POST",
                "url": sSource,
                "data":{NumeroPagina:iNroPagina,NumeroRegistros:iCantMostrar,
						denominacion:denominacion,fecha:fecha,
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
						var menu = "";
						if(row.menu!= null)menu = row.menu;
						return menu;
					},
					"bSortable": false,
					"aTargets": [1],
					"className": "dt-center",
					//"className": 'control'
					},				
				{
					"mRender": function (data, type, row) {
						var precio = "";
						if (row.precio != null) {
							var value = parseFloat(row.precio);
							precio = value.toFixed(2); 
						}
						return precio;
					},
					"bSortable": false,
					"aTargets": [2]
                },
                {
					"mRender": function (data, type, row) {
						var fecha = "";
						if(row.fecha!= null)fecha = row.fecha;
						return fecha;
					},
					"bSortable": false,
					"aTargets": [3]
                },
				{
					"mRender": function (data, type, row) {
						var estado = "";
						if(row.estado == '1')estado = "Activo";
						if(row.estado == '0')estado = "Inactivo";
						return estado;
					},
					"bSortable": false,
					"aTargets": [4]
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
					html += '<button style="font-size:12px" type="button" class="btn btn-sm btn-success" data-toggle="modal" onclick="modalMenu('+row.id+')" ><i class="fa fa-edit"></i> Editar</button>';
					html += '<a href="javascript:void(0)" onclick="eliminarMenu('+row.id+', \''+row.estado+'\')" class="btn btn-sm '+clase+'" style="font-size:12px;margin-left:10px">'+estado+'</a>';
					html += '</div>';
					return html;
				}
				,
                "bSortable": false,
                "aTargets": [5],
                },
            ]
    });
}

function fn_ListarBusqueda() {
    datatablenew();
};

function modalMenu(id){
	
	$(".modal-dialog").css("width","85%");
	$('#openOverlayOpc .modal-body').css('height', 'auto');

	$.ajax({
			url: "/menu_persona/modal_menu/"+id,
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
        message: "&iquest;Deseas "+act_estado+" el Menu?", 
        callback: function(result){
            if (result==true) {
                fn_eliminar_menu(id,estado_);
            }
        }
    });
    $(".modal-dialog").css("width","30%");
}

function fn_eliminar_menu(id,estado){
	
    $.ajax({
            url: "/menu_persona/eliminar_menu/"+id+"/"+estado,
            type: "GET",
            success: function (result) {
                //if(result="success")obtenerPlanDetalle(id_plan);
				datatablenew();
            }
    });
}

function obtenerSubPlanilla(){
	
	var id = $('#id_tipo_planilla_bus').val();
	if(id=="")return false;
	
	var msgLoader = "";
	msgLoader = "Procesando, espere un momento por favor";
	var heightBrowser = $(window).width()/2;
	$('.loader').css("opacity","0.8").css("height",heightBrowser).html("<div id='Grd1_wrapper' class='dataTables_wrapper'><div id='Grd1_processing' class='dataTables_processing panel-default'>"+msgLoader+"</div></div>");
    $('.loader').show();
	
	$.ajax({
		url: '/planilla/obtener_sub_planilla/'+id,
		dataType: "json",
		success: function(result){
			var option = "<option value='0'>- Seleccionar Sub Tipo Planilla -</option>";
			$('#sub_tipo_planilla_bus').html("");
			$(result).each(function (ii, oo) {
				option += "<option value='"+oo.id+"'>"+oo.denominacion+"</option>";
			});
			$('#sub_tipo_planilla_bus').html(option);
			//$('#id_subplanilla').select2();
			
			$('#sub_tipo_planilla_bus').attr("disabled",false);
			$('.loader').hide();
			
		}
	});	
}
/*
function obtenerUnidad(){
	
	var id = $('#id_area_trabajo_').val();
	if(id=="")return false;
	//$('#ubigeodireccionprincipal').attr("disabled",true);
	
	var msgLoader = "";
	msgLoader = "Procesando, espere un momento por favor";
	var heightBrowser = $(window).width()/2;
	$('.loader').css("opacity","0.8").css("height",heightBrowser).html("<div id='Grd1_wrapper' class='dataTables_wrapper'><div id='Grd1_processing' class='dataTables_processing panel-default'>"+msgLoader+"</div></div>");
    $('.loader').show();
	
	$.ajax({
		url: '/unidad/obtener_unidad/'+id,
		dataType: "json",
		success: function(result){
			var option = "<option value=''>Seleccionar</option>";
			$('#id_unidad_trabajo_').html("");
			$(result).each(function (ii, oo) {
				option += "<option value='"+oo.id+"'>"+oo.denominacion+"</option>";
			});
			$('#id_unidad_trabajo_').html(option);
			$('#id_unidad_trabajo_').select2();
			
			$('#id_unidad_trabajo_').attr("disabled",false);
			$('.loader').hide();
			
		}
	});	
}
*/