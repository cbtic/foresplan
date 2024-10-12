<title>FORESPAMA</title>

<style>
/*
.datepicker {
  z-index: 1600 !important; 
}
*/
/*.datepicker{ z-index:99999 !important; }*/

.datepicker,
.table-condensed {
  width: 250px;
  height:250px;
}


.modal-dialog {
	width: 100%;
	max-width:90%!important
  }
  
#tablemodal{
    border-spacing: 0;
    display: flex;/*Se ajuste dinamicamente al tamano del dispositivo**/
    max-height: 80vh; /*El alto que necesitemos**/
    overflow-y: auto; /**El scroll verticalmente cuando sea necesario*/
    overflow-x: hidden;/*Sin scroll horizontal*/
    table-layout: fixed;/**Forzamos a que las filas tenga el mismo ancho**/
    width: 98vw; /*El ancho que necesitemos*/
    border:1px solid #c4c0c9;
}

#tablemodal thead{
    background-color: #e2e3e5;
    position: fixed !important;
}


#tablemodal th{
    border-bottom: 1px solid #c4c0c9;
    border-right: 1px solid #c4c0c9;
}

#tablemodal th{
    font-weight: normal;
    margin: 0;
    max-width: 9.5vw; 
    min-width: 9.5vw;
    word-wrap: break-word;
    font-size: 10px;
	font-weight:bold;
    height: 3.5vh !important;
	line-height:12px;
	vertical-align:middle;
	/*height:20px;*/
    padding: 4px;
    border-right: 1px solid #c4c0c9;
}

#tablemodal td{
    font-weight: normal;
    margin: 0;
    max-width: 9.5vw; 
    min-width: 9.5vw;
    word-wrap: break-word;
    font-size: 11px;
    height: 3.5vh !important;
    padding: 4px;
    border-right: 1px solid #c4c0c9;
}

#tablemodal tbody tr:hover td, #tablemodal tbody tr:hover th {
  /*background-color: red!important;*/
  font-weight:bold;
  /*mix-blend-mode: difference;*/
  
}

#tablemodalm{
	
}
</style>

<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>-->
<!--<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>-->
<!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>-->


<!--<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>-->


<!--Se quito estas dos lineas de datepicker y se puso las 3 de abajo -->
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />-->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker3.css" />


<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>-->

<!--
<script src="resources/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<link rel="stylesheet" href="resources/plugins/timepicker/bootstrap-timepicker.min.css">
-->

<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css">
-->

<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/js/bootstrap-datetimepicker.min.js" integrity="sha512-r/mHP22LKVhxWFlvCpzqMUT4dWScZc6WRhBMVUQh+SdofvvM1BS1Hdcy94XVOod7QqQMRjLQn5w/AQOfXTPvVA==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.4/css/bootstrap-datetimepicker.css" integrity="sha512-HWqapTcU+yOMgBe4kFnMcJGbvFPbgk39bm0ExFn0ks6/n97BBHzhDuzVkvMVVHTJSK5mtrXGX4oVwoQsNcsYvg==" crossorigin="anonymous" />
-->

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>-->
<script type="text/javascript">
/*
jQuery(function($){
$.mask.definitions['H'] = "[0-1]";
$.mask.definitions['h'] = "[0-9]";
$.mask.definitions['M'] = "[0-5]";
$.mask.definitions['m'] = "[0-9]";
$.mask.definitions['P'] = "[AaPp]";
$.mask.definitions['p'] = "[Mm]";
});
*/
$(document).ready(function() {

    $('#fecha_entrada').datepicker({
        autoclose: true,
		format: 'yyyy-mm-dd',
		changeMonth: true,
		changeYear: true,
        language: 'es'
    });

    $('#fecha_comprobante').datepicker({
        autoclose: true,
		format: 'yyyy-mm-dd',
		changeMonth: true,
		changeYear: true,
        language: 'es'
    });

    $("#item").select2({ width: '100%' });
    $("#ubicacion_fisica_seccion").select2({ width: '100%' });
    $("#ubicacion_fisica_anaquel").select2({ width: '100%' });

});

</script>

<script type="text/javascript">

$('#openOverlayOpc').on('shown.bs.modal', function() {
     $('#fecha_solicitud').datepicker({
		format: "dd-mm-yyyy",
		autoclose: true,
		//container: '#openOverlayOpc modal-body'
		container: '#openOverlayOpc modal-body'
     });
	 /*
	 $('#hora_solicitud').timepicker({
		showInputs: false,
		container: '#openOverlayOpc modal-body'
	});
	*/
	 
});

$(document).ready(function() {
    if($('#id').val()==0){
        cambiarTipoCambio();
        cambiarOrigen()
    }
});

function cambiarTipoCambio(){

    var moneda = $('#moneda').val();
    //alert(moneda);
    if(moneda==2){
        $('#tipo_cambio_dolar_, #tipo_cambio_dolar_input').show();
    }else if(moneda==1){
        $('#tipo_cambio_dolar_, #tipo_cambio_dolar_input').hide();
    }else{
        $('#tipo_cambio_dolar_, #tipo_cambio_dolar_input').hide();
    }
}

function cambiarOrigen(){

    var unidad_origen = $('#unidad_origen').val();
    //alert(moneda);
    if(unidad_origen==1){
        $('#proveedor_select, #proveedor_').hide();
    }else if(unidad_origen==2){
        $('#proveedor_select, #proveedor_').show();
        $('#proveedor').val("");
    }else if(unidad_origen==3){
        $('#proveedor_select, #proveedor_').show();
        $('#proveedor').val(28);
    }else{
        $('#proveedor_select, #proveedor_').hide();
    }
}

function obtenerAnaquel(selectElement){

    var fila = $(selectElement).closest('tr');
    var id =  $(selectElement).val();

    $.ajax({
            url: "/lotes/obtener_anaquel_seccion/"+id,
            dataType: "json",
            success: function (result) {

                var option = "<option value=''>- Seleccione -</option>";
                //$('#ubicacion_fisica_anaquel').html("");
                var anaquelSelect = fila.find('select[name="ubicacion_fisica_anaquel[]"]');
                anaquelSelect.html("");
                $(result).each(function (ii, oo) {
                    option += "<option value='"+oo.id+"'>"+oo.anaquel+"</option>";
                });
                //$('#ubicacion_fisica_anaquel').html(option);
                anaquelSelect.html(option); 
                //$('#seccion').attr("disabled",false);
                                
            }
    });

}

function obtenerDescripcion(selectElement){

    var fila = $(selectElement).closest('tr');

    var descripcion_completo = $(selectElement).find('option:selected').text();

    var descripcion_partes = descripcion_completo.split('-');

    var descripcion = descripcion_partes.length > 1 ? descripcion_partes[1].trim() : '';

    fila.find('input[name="descripcion[]"]').val(descripcion);

}

function obtenerCodInterno(selectElement, n){

    var id_producto = $(selectElement).val();

    $.ajax({
            url: "/productos/obtener_producto/"+id_producto,
            dataType: "json",
            success: function(result){
                //alert(result[0].codigo);
                $('#cod_interno' + n).val(result[0].codigo);
                $('#item' + n).val(result[0].numero_serie);
            }
        });
}

function obtenerCodigo(selectElement){

    var selectedOption = selectElement.options[selectElement.selectedIndex];
    
    var codigo = selectedOption.text.split('-')[0].trim();

    selectedOption.text = codigo;

}

function calcularCantidadPendiente(input) {
    var fila = $(input).closest('tr');

    var cantidad_ingreso = parseFloat(fila.find('.cantidad_ingreso').val()) || 0;
    var cantidad_compra = parseFloat(fila.find('.cantidad_compra').val()) || 0;

    var cantidad_pendiente = cantidad_compra - cantidad_ingreso;

    fila.find('.cantidad_pendiente').val(cantidad_pendiente.toFixed(2));
}

function calcularSubTotal(input) {
    var fila = $(input).closest('tr');

    var cantidad_ingreso = parseFloat(fila.find('.cantidad_ingreso').val()) || 0;
    var precio_unitario = parseFloat(fila.find('.precio_unitario').val()) || 0;

    var sub_total = cantidad_ingreso * precio_unitario;

    fila.find('.sub_total').val(sub_total.toFixed(2));

    var igvInputId = fila.find('.igv').attr('id');
    var totalInputId = fila.find('.total').attr('id');

    console.log('IGV ID:', igvInputId);
    console.log('Total ID:', totalInputId);

    calcularIGV(sub_total, igvInputId, totalInputId);

    actualizarTotalGeneral();
}

function calcularIGV(subTotal, igvInputId, totalInputId) {
    subTotal = parseFloat(subTotal) || 0;
    
    var igvPorcentaje = $('#igv_compra').val() == 2 ? 0.18 : 0;
    var igvValor = subTotal * igvPorcentaje;
    var total = subTotal + igvValor;

    if (!igvInputId || !totalInputId) {
        console.error("Error: Los IDs de IGV o Total no son válidos.");
        return;
    }
    
    $('#' + igvInputId).val(igvValor.toFixed(2) + ' (' + (igvPorcentaje * 100) + '%)');
    
    $('#' + totalInputId).val(total.toFixed(2));
}

function actualizarTotalGeneral() {
    var totalGeneral = 0;
    $('#tblDetalleEntrada tbody tr').each(function() {
        var totalFila = parseFloat($(this).find('.total').val()) || 0;
        totalGeneral += totalFila;
    });
    
    $('#totalGeneral').text(totalGeneral.toFixed(2));
}

$('#almacen').change(function() {
    
    var almacenElement = this;
    
    $('#tblDetalleEntrada tbody tr').each(function(index, row) {
        var n = index + 1;
        actualizarSecciones(almacenElement, n);
    });
});

function actualizarSecciones(selectElement, n) {
    //var id_almacen = $('#almacen').val();
    var id_almacen = $(selectElement).val();

    //alert(id_almacen);

    if (!id_almacen) {
        bootbox.alert('Debe seleccionar un almacén.');
        $('#ubicacion_fisica_seccion' + n).html('<option value="">- Seleccione -</option>');
        return;
    }

    $.ajax({
        url: "/lotes/obtener_seccion_almacen/"+id_almacen,
        dataType: "json",
        success: function (result) {

            var option = "<option value=''>- Seleccione -</option>";

            var ubicacionFisicaSeccion = $('#ubicacion_fisica_seccion' + n);
            //console.log(ubicacionFisicaSeccion);
            ubicacionFisicaSeccion.html("");

            $(result).each(function (ii, oo) {
                option += "<option value='" + oo.id + "'>" + oo.codigo_seccion + "-" + oo.seccion + "</option>";
            });

            ubicacionFisicaSeccion.html(option);
        }
    });
}

function cambiarDocumento(){

    var tipo_movimiento = $('#tipo_movimiento').val();

    if(tipo_movimiento==1){

        $.ajax({
            url: "/entrada_productos/obtener_documento_entrada",
            dataType: "json",
            success: function(result){
                var option = "<option value=''>--Seleccionar--</option>";
                $('#tipo_documento').html("");
                $(result).each(function (ii, oo) {
                    option += "<option value='"+oo.codigo+"'>"+oo.denominacion+"</option>";
                });
                $('#tipo_documento').html(option);
                
                $('#tipo_documento').attr("disabled",false);
                $('.loader').hide();
                
            }
        });

    }else if(tipo_movimiento==2){

        $.ajax({
            url: "/entrada_productos/obtener_documento_salida",
            dataType: "json",
            success: function(result){
                var option = "<option value=''>--Seleccionar--</option>";
                $('#tipo_documento').html("");
                $(result).each(function (ii, oo) {
                    option += "<option value='"+oo.codigo+"'>"+oo.denominacion+"</option>";
                });
                $('#tipo_documento').html(option);
                
                $('#tipo_documento').attr("disabled",false);
                $('.loader').hide();
                
            }
        });

    }
}


function agregarProducto(){

    var cantidad = 1;
    var newRow = "";
    for (var i = 0; i < cantidad; i++) { 
        var n = $('#tblDetalleEntrada tbody tr').length + 1;
        var item = '<input name="item[]" id="item' + n + '" class="form-control form-control-sm" value="" type="text">';
        var cantidad = '<input name="cantidad[]" id="cantidad' + n + '" class="form-control form-control-sm" value="" type="text">';
        var descripcion = '<select name="descripcion[]" id="descripcion' + n + '" class="form-control form-control-sm" onChange="obtenerCodInterno(this, ' + n + ')"> <option value="">--Seleccionar--</option> <?php foreach ($producto as $row) {?> <option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option> <?php } ?> </select>';
        var ubicacion_fisica_seccion = '<select name="ubicacion_fisica_seccion[]" id="ubicacion_fisica_seccion' + n + '" class="form-control form-control-sm" onChange="obtenerAnaquel(this)"> <option value="">--Seleccionar--</option> <?php //foreach ($almacen_seccion as $row) {?> <option value="<?php //echo $row->id?>"><?php //echo $row->codigo_seccion."-".$row->seccion?></option> <?php //} ?> </select>';
        var ubicacion_fisica_anaquel = '<select name="ubicacion_fisica_anaquel[]" id="ubicacion_fisica_anaquel' + n + '" class="form-control form-control-sm" onChange=""> <option value="">--Seleccionar--</option>} ?> </select>';
        var cod_interno = '<input name="cod_interno[]" id="cod_interno' + n + '" class="form-control form-control-sm" value="" type="text">';
        var unidad = '<select name="unidad[]" id="unidad' + n + '" class="form-control form-control-sm" onChange=""> <option value="">- Selecione -</option> <?php foreach ($unidad as $row) {?> <option value="<?php echo $row->codigo?>"><?php echo $row->denominacion?></option> <?php } ?> </select>';
        var cantidad_ingreso = '<input name="cantidad_ingreso[]" id="cantidad_ingreso' + n + '" class="cantidad_ingreso form-control form-control-sm" value="" type="text" oninput="calcularCantidadPendiente(this)">';
        var cantidad_compra = '<input name="cantidad_compra[]" id="cantidad_compra' + n + '" class="cantidad_compra form-control form-control-sm" value="" type="text" oninput="calcularCantidadPendiente(this)">';
        var cantidad_pendiente = '<input name="cantidad_pendiente[]" id="cantidad_pendiente' + n + '" class="cantidad_pendiente form-control form-control-sm" value="" type="text" readonly="readonly">';
        var stock_actual = '<input name="stock_actual[]" id="stock_actual' + n + '" class="form-control form-control-sm" value="" type="text">';
        var precio_unitario = '<input name="precio_unitario[]" id="precio_unitario' + n + '" class="precio_unitario form-control form-control-sm" value="" type="text" oninput="calcularSubTotal(this)">';
        var sub_total = '<input name="sub_total[]" id="sub_total' + n + '" class="sub_total form-control form-control-sm" value="" type="text" readonly="readonly">';
        var igv = '<input name="igv[]" id="igv' + n + '" class="igv form-control form-control-sm" value="" type="text" readonly="readonly">';
        var total = '<input name="total[]" id="total' + n + '" class="total form-control form-control-sm" value="" type="text" readonly="readonly">';
        
        newRow += '<tr>';
        newRow += '<td>' + n + '</td>';
        newRow += '<td>' + item + '</td>';
        newRow += '<td>' + cantidad + '</td>';
        newRow += '<td>' + descripcion + '</td>';
        newRow += '<td>' + ubicacion_fisica_seccion + '</td>';
        newRow += '<td>' + ubicacion_fisica_anaquel + '</td>';
        newRow += '<td>' + cod_interno + '</td>';
        newRow += '<td>' + unidad + '</td>';
        newRow += '<td>' + cantidad_ingreso + '</td>';
        newRow += '<td>' + cantidad_compra + '</td>';
        newRow += '<td>' + cantidad_pendiente + '</td>';
        newRow += '<td>' + stock_actual + '</td>';
        newRow += '<td>' + precio_unitario + '</td>';
        newRow += '<td>' + sub_total + '</td>';
        newRow += '<td>' + igv + '</td>';
        newRow += '<td>' + total + '</td>';
        newRow += '</tr>';

        $('#tblDetalleEntrada tbody').append(newRow);

        var almacenElement = document.getElementById('almacen');
        actualizarSecciones(almacenElement, n);

    }

    actualizarTotalGeneral();
}

function limpiar(){
	$('#id').val("0");
	$('#id_tipo_documento').val("");
	$('#denominacion').val("");
	$('#img_foto').val("");
}

function fn_save_detalle_producto(){
	
	$.ajax({
			url: "/entrada_productos/send_entrada_producto",
            type: "POST",
            data : $("#frmDetalleProductos").serialize(),
			success: function (result) {
                //alert(result.id)
                //$('#openOverlayOpc').modal('hide');
                if (result.id>0) {
                    modalEntradaProducto(result.id);   

                // Mostrar nuevamente el modal
                //$('#openOverlayOpc').modal('show');
               
            }
								
            }
    });
}

function pdf_documento(){

    var id = $('#id').val();
    var tipo_movimiento = $('#tipo_movimiento').val();

    var href = '/entrada_productos/movimiento_pdf/'+id+'/'+tipo_movimiento;
    window.open(href, '_blank');

}

</script>


<body class="hold-transition skin-blue sidebar-mini">
    
    <div>
		<!--
        <section class="content-header">
          <h1>
            <small style="font-size: 20px">Programados del Medicos del dia <?php //echo $fecha_atencion?></small>
          </h1>
        </section>
		-->
		<div class="justify-content-center">

            <div class="card">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <img width="200px" height="80px" style="top:-30px" src="/img/logo_forestalpama.jpg">
                    </div>
                </div>
                <div style="text-align: center; font-size:16px">
                    <b>Tipo Movimiento</b>
                </div>
                
                <div class="card-body">
                
					<div class="table-responsive">
						<table id="tblDetalleEntrada" class="table table-hover table-sm">
							<thead>
							<tr style="font-size:13px">
								<th>#</th>
								<th>Item</th>
								<th>Cnd</th>
								<th>Descripci&oacute;n</th>
								<th>Ub. Fisica Secci&oacute;n</th>
                                <th>Ub. Fisica Anaquel</th>
								<th>COD. INT.</th>
                                <th>Unidad</th>
                                <th>Cantidad Ingreso</th>
                                <th>Cantidad Compra</th>
                                <th>Cantidad Pendiente</th>
                                <th>Stock Actual</th>
                                <th>Precio Unitario</th>
                                <th>Sub Total</th>
                                <th>IGV</th>
                                <th>Total</th>
							</tr>
							</thead>
							<tbody>
                                <?php foreach($detalle as $row){ ?>
                                        <tr>
                                        <td>
                                        var ubicacion_fisica_seccion = '<select name="ubicacion_fisica_seccion[]" id="ubicacion_fisica_seccion' + n + '" class="form-control form-control-sm" onChange="obtenerAnaquel(this)"> <option value="">- Selecione -</option> <?php //foreach ($almacen_seccion as $row) {?> <option value="<?php //echo $row->id?>"><?php //echo $row->codigo_seccion."-".$row->seccion?></option> <?php //} ?> </select>';
                                        var ubicacion_fisica_anaquel = '<select name="ubicacion_fisica_anaquel[]" id="ubicacion_fisica_anaquel' + n + '" class="form-control form-control-sm" onChange=""> <option value="">- Selecione -</option> ?> </select>';
                                        var cod_interno = '<input name="cod_interno[]" id="cod_interno' + n + '" class="form-control form-control-sm" value="" type="text">';
                                        var unidad = '<select name="unidad[]" id="unidad' + n + '" class="form-control form-control-sm" onChange=""> <option value="">- Selecione -</option> <?php foreach ($unidad as $row) {?> <option value="<?php echo $row->codigo?>"><?php echo $row->denominacion?></option> <?php } ?> </select>';
                                        var cantidad_ingreso = '<input name="cantidad_ingreso[]" id="cantidad_ingreso' + n + '" class="cantidad_ingreso form-control form-control-sm" value="" type="text" oninput="calcularCantidadPendiente(this)">';
                                        var cantidad_compra = '<input name="cantidad_compra[]" id="cantidad_compra' + n + '" class="cantidad_compra form-control form-control-sm" value="" type="text" oninput="calcularCantidadPendiente(this)">';
                                        var cantidad_pendiente = '<input name="cantidad_pendiente[]" id="cantidad_pendiente' + n + '" class="cantidad_pendiente form-control form-control-sm" value="" type="text" readonly="readonly">';
                                        var stock_actual = '<input name="stock_actual[]" id="stock_actual' + n + '" class="form-control form-control-sm" value="" type="text">';
                                        var precio_unitario = '<input name="precio_unitario[]" id="precio_unitario' + n + '" class="precio_unitario form-control form-control-sm" value="" type="text" oninput="calcularSubTotal(this)">';
                                        var sub_total = '<input name="sub_total[]" id="sub_total' + n + '" class="sub_total form-control form-control-sm" value="" type="text" readonly="readonly">';
                                        var igv = '<input name="igv[]" id="igv' + n + '" class="igv form-control form-control-sm" value="" type="text" readonly="readonly">';
                                        var total = '<input name="total[]" id="total' + n + '" class="total form-control form-control-sm" value="" type="text" readonly="readonly">';
        
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>

                                        </tr>

                                    <?php } ?>

							</tbody>
						</table>
					</div>
                    
                            
                    </div>
                </form>
                </div>
                <!-- /.box -->
                
            </div>
            <!--/.col (left) -->

        </div>
        <!-- /.row -->
    
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

    
<script type="text/javascript">
$(document).ready(function () {

	$('#ruc_').blur(function () {
		var id = $('#id').val();
			if(id==0) {
				validaRuc(this.value);
			}
		//validaRuc(this.value);
	});
	
	
	
	
});


</script>

<script type="text/javascript">
$(document).ready(function() {
	//$('#numero_placa').focus();
	//$('#numero_placa').mask('AAA-000');
	//$('#vehiculo_numero_placa').mask('AAA-000');
	
	
});




</script>

