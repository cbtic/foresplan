<title>FORESPAMA</title>

<style>
    @page {
		margin-left: 2.5cm;
		margin-right: 2.5cm;
	}
    .container {
    position: relative;
    height: 100vh; /* Establece la altura del contenedor al 100% de la altura de la ventana del navegador */
    left: 570px;
    top: -100px;
}
.two-columns {
        column-count: 2;      /* Divide el contenido en dos columnas */
        column-gap: 40px;    /* Espacio entre las dos columnas */
    }

.vertical-text {
    position: absolute;
    top: ;
    right: 0;
    writing-mode: vertical-rl; /* Texto orientado verticalmente de derecha a izquierda */
    transform: rotate(90deg); /* Gira el texto 180 grados para que esté orientado de arriba hacia abajo */
    transform-origin: top right; /* Define el punto de origen de la transformación */
    text-align: justify;
    white-space: nowrap; /* Evita que el texto se rompa */
    color: black; /* Asegúrate de que el color del texto sea visible */
}
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
.p{
    font-size: 8.5;
}

.td{
    font-size:11px
}

table.data {
    border-collapse:separate;
    border:solid black 1px;
    border-radius:8px;
    padding: 3px;
    border-spacing: 0;
}

td.data, th.data {
    border-left:solid black 1px;
    border-top:solid black 1px;
    text-align:center;
    border-top: none;
    font-size:11px;
}

.modal-dialog {
	width: 100%;
	max-width:60%!important
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


<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />


<script type="text/javascript">

$(document).ready(function() {
	//$('#hora_solicitud').focus();
	//$('#hora_solicitud').mask('00:00');
	//$("#id_empresa").select2({ width: '100%' });
});
</script>

<script type="text/javascript">

</script>

<body class="hold-transition skin-blue sidebar-mini">

    <!--<div>
        <img width="200px" height="80px" style="top:-30px" src="img/logo_forestalpama.jpg">
    </div>-->
    <table class="data" style="width:100%; font-size:11px">
        <tr>
            <th><h2><?php echo $tipo_documento ." N° ". $numero_orden_compra;?></h2></th>
        </tr>
    </table>
    <!--<div style="display: flex !important; width:100%">
        <span style="width: 50%; ">Div 1</span>
        <span style="width: 50%; float: right;">Div 2</span>
    </div>-->
    
    <!--<hr>-->
    &nbsp;
        <div class="contenido">
            
            <table class="data" style="width:100%; background-color:white !important;border-spacing:1px; width: 100%; margin: 0 auto; font-size:12px; vertical-align:top">
                <tbody>
                    <tr>
                        <td class="td" style ="text-align: left; width: 15%;"><b>Fecha de Emisi&oacute;n:</b></td>
                        <td class="td" style ="text-align: left; width: 20%;"><?php echo $fecha_orden_compra;?></td>
                        <td class="td" style ="text-align: left; width: 65%;"></td>
                    </tr>
                    <tr>
                        <td class="td" style ="text-align: left; width: 15%;"><b>Empresa Compra:</b></td>
                        <td class="td" style ="text-align: left; width: 20%;"><?php echo $empresa_compra;?></td>
                        <td class="td" style ="text-align: left; width: 65%;"></td>
                    </tr>
                    <tr>
                        <td class="td" style ="text-align: left; width: 15%;"><b>Empresa Vende:</b></td>
                        <td class="td" style ="text-align: left; width: 20%;"><?php echo $empresa_vende;?></td>
                        <td class="td" style ="text-align: left; width: 65%;"></td>
                    </tr>
                    <tr>
                        <td class="td" style ="text-align: left; width: 15%;"><b>IGV:</b></td>
                        <td class="td" style ="text-align: left; width: 20%;"><?php echo $igv;?></td>
                        <td class="td" style ="text-align: left; width: 65%;"></td>
                    </tr>
                </tbody>
            </table>
            &nbsp;
            <table class="data" style="border-collapse: separate; border-spacing: 0; background-color:white !important; width: 100%; border-radius: 8px; font-size:11px">
                <tbody>
                    <tr class="data">
                        <td class="td" style ="text-align: left; width: 5%; height:25px; border-bottom: 1px solid black;"><b>#</b></td>
                        <td class="td" style ="text-align: left; width: 5%; height:25px; border-bottom: 1px solid black;"><b>ITEM</b></td>
                        <td class="td" style ="text-align: left; width: 20%; height:25px; border-bottom: 1px solid black;"><b>DESCRIPCI&Oacute;N</b></td>
                        <td class="td" style ="text-align: left; width: 5%; height:25px; border-bottom: 1px solid black;"><b>MARCA</b></td>
                        <td class="td" style ="text-align: left; width: 5%; height:25px; border-bottom: 1px solid black;"><b>COD. INTERNO</b></td>
                        <td class="td" style ="text-align: left; width: 10%; height:25px; border-bottom: 1px solid black;"><b>F. FABRICACI&Oacute;N</b></td>
                        <td class="td" style ="text-align: left; width: 10%; height:25px; border-bottom: 1px solid black;"><b>F. VENCIMIENTO</b></td>
                        <td class="td" style ="text-align: left; width: 5%; height:25px; border-bottom: 1px solid black;"><b>ESTADO BIEN</b></td>
                        <td class="td" style ="text-align: left; width: 5%; height:25px; border-bottom: 1px solid black;"><b>UNIDAD</b></td>
                        <td class="td" style ="text-align: left; width: 5%; height:25px; border-bottom: 1px solid black;"><b>CANTIDAD</b></td>
                        <td class="td" style ="text-align: left; width: 5%; height:25px; border-bottom: 1px solid black;"><b>PRECIO UNITARIO</b></td>
                        <td class="td" style ="text-align: left; width: 5%; height:25px; border-bottom: 1px solid black;"><b>DESCUENTO</b></td>
                        <td class="td" style ="text-align: left; width: 5%; height:25px; border-bottom: 1px solid black;"><b>SUB TOTAL</b></td>
                        <td class="td" style ="text-align: left; width: 5%; height:25px; border-bottom: 1px solid black;"><b>IGV</b></td>
                        <td class="td" style ="text-align: left; width: 5%; height:25px; border-bottom: 1px solid black;"><b>TOTAL</b></td>
                    </tr>
                    
                    <?php 
                    $subtotal_suma=0;
                    $igv_suma=0;
                    $total_suma=0;
                    foreach($datos_detalle as $key=>$r) { ?>
                        <tr>
                            <td class="td" style ="text-align: left; width: 5%; height:25px"><?php echo $r->row_num;?></td>
                            <td class="td" style ="text-align: left; width: 5%; height:25px"><?php echo $r->numero_serie;?></td>
                            <td class="td" style ="text-align: left; width: 10%; height:25px"><?php echo $r->producto;?></td>
                            <td class="td" style ="text-align: left; width: 5%; height:25px"><?php echo $r->marca;?></td>
                            <td class="td" style ="text-align: left; width: 5%; height:25px"><?php echo $r->codigo;?></td>
                            <td class="td" style ="text-align: left; width: 10%; height:25px"><?php echo $r->fecha_fabricacion;?></td>
                            <td class="td" style ="text-align: left; width: 10%; height:25px"><?php echo $r->fecha_vencimiento;?></td>
                            <td class="td" style ="text-align: left; width: 5%; height:25px"><?php echo $r->estado_producto;?></td>
                            <td class="td" style ="text-align: left; width: 5%; height:25px"><?php echo $r->unidad_medida;?></td>
                            <td class="td" style ="text-align: left; width: 5%; height:25px"><?php echo $r->cantidad_requerida;?></td>
                            <td class="td" style ="text-align: left; width: 5%; height:25px"><?php echo number_format($r->precio,2,'.',',');?></td>
                            <td class="td" style ="text-align: left; width: 5%; height:25px"><?php echo $r->descuento;?></td>
                            <td class="td" style ="text-align: left; width: 5%; height:25px"><?php echo number_format($r->sub_total,2,'.',',');?></td>
                            <td class="td" style ="text-align: left; width: 5%; height:25px"><?php echo number_format($r->igv,2,'.',',');?></td>
                            <td class="td" style ="text-align: left; width: 5%; height:25px"><?php echo number_format($r->total,2,'.',',');?></td>
                            <?php 
                            $subtotal_suma+=$r->sub_total;
                            $igv_suma+=$r->igv;
                            $total_suma+=$r->total;
                            ?>
                        </tr>
                    <?php }
           
                    use Luecano\NumeroALetras\NumeroALetras;

                    $numeroALetras = new NumeroALetras();
                    $total_en_letras =$numeroALetras->toInvoice( $total_suma, 2, 'Soles');
                      ?>
                </tbody>
            </table>
            &nbsp;
            <table class="data" style="border-collapse: separate; border-spacing: 0; background-color:white !important; border-radius: 8px; font-size:11px; margin: 0 0 0 auto">
                <tbody>
                    <tr>
                        <td class="td" style ="text-align: right; width: 70%; height:25px"></td>
                        <td class="td" style ="text-align: right; width: 15%; height:25px; border-bottom: 1px solid black;"><b>SUB TOTAL:</b></td>
                        <td class="data" style ="text-align: right; width: 15%; height:25px; border-bottom: 1px solid black;"><?php echo number_format($subtotal_suma,2,'.',',');;?></td>
                    </tr>
                    <tr>
                        <td class="td" style ="text-align: right; width: 70%; height:25px"></td>
                        <td class="td" style ="text-align: right; width: 15%; height:25px; border-bottom: 1px solid black;"><b>IGV:</b></td>
                        <td class="data" style ="text-align: right; width: 15%; height:25px; border-bottom: 1px solid black;"><?php echo number_format($igv_suma,2,'.',',');;?></td>
                    </tr>
                    <tr>
                        <td class="td" style ="text-align: right; width: 70%; height:25px"></td>
                        <td class="td" style ="text-align: right; width: 15%; height:25px"><b>TOTAL:</b></td>
                        <td class="data" style ="text-align: right; width: 15%; height:25px"><?php echo number_format($total_suma,2,'.',',');;?></td>
                    </tr>
                </tbody>
            </table>
            &nbsp;
            <table class="data" style="width:100%">
                <tr>
                    <td>SON: <?php echo $total_en_letras; ?></td>
                </tr>
            </table>
            &nbsp;
        </div>
    </div>
    <!-- /.content-wrapper -->
    
@push('after-scripts')

<script src="{{ asset('js/ordenCompra.js') }}"></script>

@endpush

<script>

function showMessage() {
    return "hola";
}

function Unidades(num){

switch(num)
{
    case 1: return "UN";
    case 2: return "DOS";
    case 3: return "TRES";
    case 4: return "CUATRO";
    case 5: return "CINCO";
    case 6: return "SEIS";
    case 7: return "SIETE";
    case 8: return "OCHO";
    case 9: return "NUEVE";
}

return "";
}//Unidades()

function Decenas(num){

decena = Math.floor(num/10);
unidad = num - (decena * 10);

switch(decena)
{
    case 1:
        switch(unidad)
        {
            case 0: return "DIEZ";
            case 1: return "ONCE";
            case 2: return "DOCE";
            case 3: return "TRECE";
            case 4: return "CATORCE";
            case 5: return "QUINCE";
            default: return "DIECI" + Unidades(unidad);
        }
    case 2:
        switch(unidad)
        {
            case 0: return "VEINTE";
            default: return "VEINTI" + Unidades(unidad);
        }
    case 3: return DecenasY("TREINTA", unidad);
    case 4: return DecenasY("CUARENTA", unidad);
    case 5: return DecenasY("CINCUENTA", unidad);
    case 6: return DecenasY("SESENTA", unidad);
    case 7: return DecenasY("SETENTA", unidad);
    case 8: return DecenasY("OCHENTA", unidad);
    case 9: return DecenasY("NOVENTA", unidad);
    case 0: return Unidades(unidad);
}
}//Unidades()

function DecenasY(strSin, numUnidades) {
if (numUnidades > 0)
return strSin + " Y " + Unidades(numUnidades)

return strSin;
}//DecenasY()

function Centenas(num) {
centenas = Math.floor(num / 100);
decenas = num - (centenas * 100);

switch(centenas)
{
    case 1:
        if (decenas > 0)
            return "CIENTO " + Decenas(decenas);
        return "CIEN";
    case 2: return "DOSCIENTOS " + Decenas(decenas);
    case 3: return "TRESCIENTOS " + Decenas(decenas);
    case 4: return "CUATROCIENTOS " + Decenas(decenas);
    case 5: return "QUINIENTOS " + Decenas(decenas);
    case 6: return "SEISCIENTOS " + Decenas(decenas);
    case 7: return "SETECIENTOS " + Decenas(decenas);
    case 8: return "OCHOCIENTOS " + Decenas(decenas);
    case 9: return "NOVECIENTOS " + Decenas(decenas);
}

return Decenas(decenas);
}//Centenas()

function Seccion(num, divisor, strSingular, strPlural) {
cientos = Math.floor(num / divisor)
resto = num - (cientos * divisor)

letras = "";

if (cientos > 0)
    if (cientos > 1)
        letras = Centenas(cientos) + " " + strPlural;
    else
        letras = strSingular;

if (resto > 0)
    letras += "";

return letras;
}//Seccion()

function Miles(num) {
divisor = 1000;
cientos = Math.floor(num / divisor)
resto = num - (cientos * divisor)

strMiles = Seccion(num, divisor, "UN MIL", "MIL");
strCentenas = Centenas(resto);

if(strMiles == "")
    return strCentenas;

return strMiles + " " + strCentenas;
}//Miles()

function Millones(num) {
divisor = 1000000;
cientos = Math.floor(num / divisor)
resto = num - (cientos * divisor)

strMillones = Seccion(num, divisor, "UN MILLON DE", "MILLONES DE");
strMiles = Miles(resto);

if(strMillones == "")
    return strMiles;

return strMillones + " " + strMiles;
}//Millones()

function NumeroALetras(num) {
var data = {
    numero: num,
    enteros: Math.floor(num),
    centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
    letrasCentavos: "",
    letrasMonedaPlural: '',//"PESOS", 'Dólares', 'Bolívares', 'etcs'
    letrasMonedaSingular: '', //"PESO", 'Dólar', 'Bolivar', 'etc'

    letrasMonedaCentavoPlural: "CENTAVOS",
    letrasMonedaCentavoSingular: "CENTAVO"
};

if (data.centavos > 0) {
    data.letrasCentavos = "CON " + (function (){
        if (data.centavos == 1)
            return Millones(data.centavos) + " " + data.letrasMonedaCentavoSingular;
        else
            return Millones(data.centavos) + " " + data.letrasMonedaCentavoPlural;
        })();
};

if(data.enteros == 0)
    return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
if (data.enteros == 1)
    return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
else
    return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
}//NumeroALetras()

</script>



