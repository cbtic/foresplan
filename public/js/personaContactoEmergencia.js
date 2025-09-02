//alert("ok");
//jQuery.noConflict(true);

$(document).ready(function () {
	
	$('#btnBuscar').click(function () {
		fn_ListarBusqueda();
	});
	
	datatablenew();
	
});

function datatablenew(){
    var oTable1 = $('#tblContactoEmergenciaPersonal').dataTable({
        "bServerSide": true,
        "sAjaxSource": "/persona/listar_persona_contacto_emergencia_ajax",
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
			
			var numero_documento = $('#numero_documento').val();
            var persona = $('#persona').val();
			var estado = $('#estado').val();
			var _token = $('#_token').val();
            oSettings.jqXHR = $.ajax({
				"dataType": 'json',
                //"contentType": "application/json; charset=utf-8",
                "type": "POST",
                "url": sSource,
                "data":{NumeroPagina:iNroPagina,NumeroRegistros:iCantMostrar,
						numero_documento:numero_documento,persona:persona,
						estado:estado,_token:_token
                       },
                "success": function (result) {
                    fnCallback(result);
                },
                "error": function (msg, textStatus, errorThrown) {
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
						var nombre_personal = "";
						if(row.nombre_personal!= null)nombre_personal = row.nombre_personal;
						return nombre_personal;
					},
					"bSortable": false,
					"aTargets": [3]
                },
                {
					"mRender": function (data, type, row) {
						var nombre_contacto = "";
						if(row.nombre_contacto!= null)nombre_contacto = row.nombre_contacto;
						return nombre_contacto;
					},
					"bSortable": false,
					"aTargets": [4]
                },				
				{
					"mRender": function (data, type, row) {
						var celular_contacto = "";
						if(row.celular_contacto!= null)celular_contacto = row.celular_contacto;
						return celular_contacto;
					},
					"bSortable": false,
					"aTargets": [5]
                },	
                {
					"mRender": function (data, type, row) {
						var vinculo = "";
						if(row.vinculo!= null)vinculo = row.vinculo;
						return vinculo;
					},
					"bSortable": false,
					"aTargets": [6]
                },
            ]
    });

}

function fn_ListarBusqueda() {
    datatablenew();
};
