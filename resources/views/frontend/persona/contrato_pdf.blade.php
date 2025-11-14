<title>Sistema FORESPLAN</title>

<style>
    @page {
		margin-left: 2.5cm;
		margin-right: 2.5cm;
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

    <div>
    <!--<img width="200px" height="100px" style="top:-30px" src="img/logo_forestalpama.jpg">-->
    <h2 style="text-align:center">CONTRATO DE TRABAJO DE NATURALEZA TEMPORAL</h2>
    <p style="text-align:center">  N° : 000001 </p>
        <hr>
        <div class="contenido">
            <!--<p style="margin-left: 2cm;">         N° INSCRIPCIÓN REGIONAL: <?php //echo $datos[0]->numero_regional;?> </p>-->
            <p style="text-align: justify;" > Conste por el presente documento el Contrato de Trabajo a plazo fijo bajo la modalidad de 
                “Contrato por incremento de nueva actividad” que celebran al amparo del Art. 57º de la Ley de 
                Productividad y Competitividad Laboral aprobado por D. S. N.º 003-97-TR y normas 
                complementarias, de una parte FORESTAL PAMA SAC, con R.U.C. N.º 20486785994 y domicilio 
                fiscal en AV MIRAFLORES S/N OXAPAMPA - PASCO, debidamente representada por el señor 
                ROJAS MEDINA JULIO CESAR con D.N.I. N.º 21532370, a quien en adelante se le denominará 
                simplemente EL EMPLEADOR; y de la otra parte <?php echo $tratodesc ?> <?php echo $nombre ?>; con D.N.I. 
                Nº <?php echo $numero_documento ?>, domiciliado en <?php echo $direccion ?> 
                a quien en adelante se le denominará simplemente EL TRABAJADOR; en los términos y 
                condiciones siguientes:</p>
            <br>

            <p style="text-align: justify;"> PRIMERO: EL EMPLEADOR ha ampliado su línea de producción para dedicarse a la fabricación 
                de puertas contra placadas, puertas sólidas, muebles y artículos de madera y que, por el 
                incremento de sus actividades, requiere cubrir las necesidades de promoción de ventas de los 
                artículos de madera que fabrica.</p>
            <br>

            <p style="text-align: justify;"> SEGUNDO: Por el presente documento EL EMPLEADOR contrata a plazo fijo bajo la modalidad 
                ya indicada, los servicios de EL TRABAJADOR quien desempeñará el cargo de <?php echo $cargo ?>, 
                en relación con las causas objetivas señaladas en la cláusula anterior. </p>
            <br>

            <p style="text-align: justify;"> TERCERA. – OBJETO DEL CONTRATO</p>
            <br>

            <p style="text-align: justify;"> LA EMPRESA, contrata a EL TRABAJADOR, para que realice la labor de 
                <?php echo $cargo ?>, y realizar las actividades siguientes:  </p>
            <br>
            <p style="text-align: justify;"> Realizar y apoyar en la planificación y ejecución de campañas de marketing.
                Gestionar y actualizar las redes sociales corporativas.
                Colaborar en la elaboración de material gráfico y publicitario.
                Realizar reportes de resultados de campañas y estudios de mercado.
                Coordinar eventos, promociones y actividades de comunicación.
                Apoyar en tareas administrativas propias del área de marketing.
                Monitorear las tendencias del mercado y la competencia para proponer mejoras 
                en las estrategias de marketing.
                Mantener actualizada la base de datos de clientes, leads y contactos 
                comerciales.
                Brindar soporte en la comunicación interna de la empresa, elaborando boletines 
                o comunicados informativos.
                Participar en reuniones de coordinación con proveedores, agencias o aliados 
                estratégicos.
                Realizar otras funciones relacionadas con el cargo que le sean asignadas por la 
                jefatura inmediata o, en su defecto, por la Gerencia. Debiendo someterse al 
                cumplimiento estricto de la labor para la cual ha sido contratado bajo las 
                directivas de ambas gerencias; así como también las actividades que se 
                impartan por necesidad del servicio en ejercicio de las facultades de 
                administración y dirección de la empresa, de conformidad con el artículo 9° 
                del Texto Único Ordenado de la Ley de Productividad y Competitividad Laboral, 
                aprobado por Decreto Supremo N° 003-97-TR.</p>
            <br><!-- para todos desde Realizar otras funciones relacionadas -->

            <p style="text-align: justify;"> CUARTO: El plazo de duración del presente contrato es de XXXX, y rige desde el <?php echo $fecha_inicio ?>,
                fecha en que debe empezar sus labores EL TRABAJADOR, hasta el <?php echo $fecha_cese ?>, 
                fecha en que quedará extinguido automáticamente el presente contrato, 
                de no mediar comunicación escrita para la renovación del mismo, por parte de LA EMPRESA. 
                Durante este periodo EL TRABAJADOR cumplirá una labor de lunes a viernes de 8:00 -17:36 y 
                sábados de 8:00 – 13:00; el horario de almuerzo es de una hora y se tomará de preferencia 
                desde las 13:00 hasta las 14:00 horas. </p>
            <br>

            <p style="text-align: justify;"> QUINTO:  El trabajador cumplirá con el horario de trabajo que establezca la empresa de acuerdo 
                a sus necesidades que no deberán superar las 48 horas semanales de acuerdo a ley.  </p>
            <br>

            <p style="text-align: justify;"> SEXTO: EL TRABAJADOR deberá cumplir con las normas propias del Centro de Trabajo, así 
                como las contenidas en el Reglamento interno de Trabajo y en las demás normas laborales, y 
                las que se impartan por necesidades del servicio en ejercicio de las facultades de administración 
                de la empresa, de conformidad con el Art. 9º de la Ley de Productividad y Competitividad Laboral 
                aprobado por D. S. N.º 003-97-TR. </p>
            <br>

            <p style="text-align: justify;"> SETIMO: en contraprestación a sus servicios, el empleador se obliga a pagar una remuneración 
                total de S/. XXXX (XXXX con 00/100 soles), compuesto por un básico de S/. 
                XXXX soles (XXXX con 00/100 soles), más asignación familiar de corresponder, 
                movilidad de S/. XXXX (XXXX con 00/100 soles) y asignación de costo de actividad de 
                S/. XXXX (XXXX con 00/100 soles) según corresponda y de ser el caso se deducirá las 
                aportaciones y descuentos que corresponda conforme a ley.  </p>
            <br>

            <p style="text-align: justify;"> OCTAVO: Queda entendido que EL EMPLEADOR no está obligado a dar aviso alguno adicional 
                referente al término del presente contrato, operando su extinción en la fecha de su vencimiento 
                conforme la cláusula tercera, oportunidad en la cual se abonará al TRABAJADOR los beneficios 
                sociales que le pudieran corresponder de acuerdo a ley.  </p>
            <br>

            <p style="text-align: justify;"> El periodo de prueba es de tres, a cuyo término EL TRABAJADOR alcanza el derecho de 
                protección contra el despido arbitrario en virtud del Artículo 10° de la Ley de Productividad y 
                Competitividad Laboral. Queda entendido que, durante este periodo de prueba, LA EMPRESA 
                puede rescindir el contrato sin expresión de causa, pudiendo incluso comunicar la decisión el 
                mismo día. Dicha situación no genera responsabilidad mayor para la empresa, excepto el pago 
                efectivo de la liquidación de beneficios sociales, según corresponda.  </p>
            <br>

            <p style="text-align: justify;"> NOVENO: En caso EL TRABAJADOR opte por renunciar antes del término de plazo del presente 
                contrato; queda obligado a presentar Carta de Renuncia dirigida a Gerencia con 15 (quince) días 
                de anticipación y efectuando una entrega de cargo al nuevo personal que cubra el puesto.  </p>
            <br>

            <p style="text-align: justify;"> DÉCIMA: CLÁUSULA DE CONFIDENCIALIDAD 
                Todas las notas, informes y cualesquiera otros documentos (incluyendo los almacenados en 
                dispositivos electrónicos), elaborados por EL TRABAJADOR durante la vigencia del presente 
                contrato y que se refieran a la actividad de la empresa son propiedad de LA EMPRESA. Se 
                informa que queda restringido el acceso para personas ajenas a la empresa sin previo aviso y 
                autorización de Gerencia. Asimismo, la información de compras, ventas, etc.; brindada a EL 
                TRABAJADOR debe ser de uso exclusivamente interno. La vulneración de este compromiso será 
                considerada como causa justificada de extinción del presente contrato, sin derecho a la 
                percepción de indemnización alguna. LA EMPRESA se reserva el derecho de reclamar el 
                resarcimiento de los daños y perjuicios que le pudieran causar como consecuencia de la 
                vulneración del deber de confidencialidad y secreto profesional pactado en la presente 
                cláusula. </p>
            <br>

            <p style="text-align: justify;"> DÉCIMO PRIMERA: Este contrato queda sujeto a las disposiciones que contiene el TUO del D. 
                Leg. N.º 728 aprobado por D. S. N.º 003-97-TR Ley de Productividad y Competitividad Laboral, 
                y demás normas legales que lo regulen o que sean dictadas durante la vigencia del contrato. 
                Como muestra de conformidad con todas las cláusulas del presente contrato firman las partes, 
                por duplicado al XXXX. </p>
            
            <p></p>
            <p  style="text-align:right">Lima, <?php echo $fecha_actual;?></p>
        </div>
    </div>
    <!-- /.content-wrapper -->
    
@push('after-scripts')

<script src="{{ asset('js/certificado.js') }}"></script>

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



