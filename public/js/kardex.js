$(document).ready(function () {
	
	$('#btnBuscar').click(function () {
		fn_ListarBusqueda();
	});
		
	$('#denominacion').keypress(function(e){
		if(e.which == 13) {
			datatablenew();
		}
	});

	$("#producto_bus").select2({ width: '100%' });
		
	datatablenew();

});

function datatablenew(){
                      
    var oTable1 = $('#tblKardex').dataTable({
        "bServerSide": true,
        "sAjaxSource": "/kardex/listar_kardex_ajax",
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
			
            var producto = $('#producto_bus').val();
			var almacen = $('#almacen_bus').val();
			
			var _token = $('#_token').val();
            oSettings.jqXHR = $.ajax({
				"dataType": 'json',
                //"contentType": "application/json; charset=utf-8",
                "type": "POST",
                "url": sSource,
                "data":{NumeroPagina:iNroPagina,NumeroRegistros:iCantMostrar,
						producto:producto,almacen:almacen,
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
					var entrada = "";
					if(row.entrada!= null)entrada = row.entrada;
					return entrada;
				},
				"bSortable": true,
				"aTargets": [2]
				},
				
                {
                "mRender": function (data, type, row) {
                	var costo_entrada = "";
					if(row.costo_entrada!= null)costo_entrada = row.costo_entrada;
					return costo_entrada;
                },
                "bSortable": true,
                "aTargets": [3]
                },

				{
				"mRender": function (data, type, row) {
					var total_entrada = "";
					if(row.total_entrada!= null)total_entrada = row.total_entrada;
					return total_entrada;
				},
				"bSortable": true,
				"aTargets": [4]
				},
				{
				"mRender": function (data, type, row) {
					var salida = "";
					if(row.salida!= null)salida = row.salida;
					return salida;
				},
				"bSortable": true,
				"aTargets": [5]
				},
				{
				"mRender": function (data, type, row) {
					var costo_salida = "";
					if(row.costo_salida!= null)costo_salida = row.costo_salida;
					return costo_salida;
				},
				"bSortable": true,
				"aTargets": [6]
				},
				{
				"mRender": function (data, type, row) {
					var total_salida = "";
					if(row.total_salida!= null)total_salida = row.total_salida;
					return total_salida;
				},
				"bSortable": true,
				"aTargets": [7]
				},
				{
				"mRender": function (data, type, row) {
					var saldos = "";
					if(row.saldos!= null)saldos = row.saldos;
					return saldos;
				},
				"bSortable": true,
				"aTargets": [8]
				},
				{
				"mRender": function (data, type, row) {
					var costo_saldos = "";
					if(row.costo_saldos!= null)costo_saldos = row.costo_saldos;
					return costo_saldos;
				},
				"bSortable": true,
				"aTargets": [9]
				},
				{
				"mRender": function (data, type, row) {
					var total_saldos = "";
					if(row.total_saldos!= null)total_saldos = row.total_saldos;
					return total_saldos;
				},
				"bSortable": true,
				"aTargets": [10]
				},
				{
				"mRender": function (data, type, row) {
					var almacen_destino = "";
					if(row.almacen_destino!= null)almacen_destino = row.almacen_destino;
					return almacen_destino;
				},
				"bSortable": true,
				"aTargets": [11]
				},
				{
				"mRender": function (data, type, row) {
					var almacen_salida = "";
					if(row.almacen_salida!= null)almacen_salida = row.almacen_salida;
					return almacen_salida;
				},
				"bSortable": true,
				"aTargets": [12]
				},
            ]
    });
}

function fn_ListarBusqueda() {
    datatablenew();
};
