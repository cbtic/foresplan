<title>Sistema de Asistencia</title>

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
	max-width:50%!important;
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

.ui-autocomplete { z-index:2147483647!important; }
.ui-menu,.ui-menu>.ui-menu-item,.ui-menu-item>a {min-width:800px !important}

</style>

<script type="text/javascript">

$(document).ready(function() {
	var hoy = new Date();
	fecha = zfill(hoy.getDate().toString(), 2) + '/' + zfill((hoy.getMonth() + 1).toString(), 2) + '/' + zfill(hoy.getFullYear().toString(), 2);
	//hora = zfill(hoy.getHours().toString(), 2) + ':' + zfill(hoy.getMinutes().toString(), 2) + ':' + zfill(hoy.getSeconds().toString(), 2);
	hora = zfill(hoy.getHours().toString(), 2) + ':' + zfill(hoy.getMinutes().toString(), 2);
	
	//$('#hora_solicitud').mask('00:00');

	var id = $('#id').val();
	
	/*
	if(id == 0){
		$('#fecha_').val(fecha);
		//console.log(fecha);
	}
	*/
	//activarTipo();

	//$("#id_empresa").select2({ width: '100%' });
	
	$('#fech_marc_rel').datepicker({
        autoclose: true,
		format: 'dd-mm-yyyy',
		changeMonth: true,
		changeYear: true,
    });
	
	$('#fech_sali_rel').datepicker({
        autoclose: true,
		format: 'dd-mm-yyyy',
		changeMonth: true,
		changeYear: true,
    });
	
});


function zfill(number, width) {
    var numberOutput = Math.abs(number); /* Valor absoluto del número */
    var length = number.toString().length; /* Largo del número */ 
    var zero = "0"; /* String de cero */  
    
    if (width <= length) {
        if (number < 0) {
             return ("-" + numberOutput.toString()); 
        } else {
             return numberOutput.toString(); 
        }
    } else {
        if (number < 0) {
            return ("-" + (zero.repeat(width - length)) + numberOutput.toString()); 
        } else {
            return ((zero.repeat(width - length)) + numberOutput.toString()); 
        }
    }
}

</script>

<script type="text/javascript">

function validacion(){
    
    var msg = "";
    var cobservaciones=$("#frmComentar #estado_").val();
    
    if(cobservaciones==""){msg+="Debe ingresar una Observacion <br>";}
    
    if(msg!=""){
        bootbox.alert(msg); 
        return false;
    }
}



function fn_save(){  
	var msg = "";
	var _token = $('#_token').val();
	var id = $('#id').val();
	//var id_persona = $('#id_persona').val();
	//var id_ubicacion = $('#id_ubicacion').val();
	//var id_tipo_operacion = $('#id_tipo_operacion').val();
	//var tipo_oper_top = $('#tipo_oper_top').val();
	var fech_marc_rel = $('#fech_marc_rel').val();
	var hora_entr_rel = $('#hora_entr_rel').val();
	var fech_sali_rel = $('#fech_sali_rel').val();
	var hora_sali_rel = $('#hora_sali_rel').val();
	/*
	if(tipo_oper_top=="D"){
		if(fech_inic_ope == ""){msg += "Debe ingresar la Fecha de Inicio <br>";}
		if(fech_fina_ope == ""){msg += "Debe ingresar la Fecha de Fin <br>";}		
	}
	if(tipo_oper_top=="H"){
		if(horainicope == ""){msg += "Debe ingresar la Hora de Inicio <br>";}
		if(horafinaope == ""){msg += "Debe ingresar la Hora de Fin <br>";}
	}
	*/
	if(msg!=""){
        bootbox.alert(msg); 
        return false;
    }
    else{
		$.ajax({
				url: "/asistencia/send_asistencia",
				type: "POST",
				data : {_token:_token,id:id,fech_marc_rel:fech_marc_rel,hora_entr_rel:hora_entr_rel,fech_sali_rel:fech_sali_rel,hora_sali_rel:hora_sali_rel},
				success: function (result) {
					$('#openOverlayOpc').modal('hide');
					datatablenew();
				}
				
		});
	}
}
</script>

<body class="hold-transition skin-blue sidebar-mini">

    <div>
		<div class="justify-content-center">		

		<div class="card">
			
			<div class="card-header" style="padding:5px!important;padding-left:20px!important">
				Edici&oacute;n de Asistencia
			</div>
			
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:10px">
						
						<div class="card-body">
									
							<div class="table-responsive">
							<table id="tblAdelanto" class="table table-hover table-sm">
							<thead>
							<tr style="font-size:13px">
								<th>Num</th>
								<th>Persona</th>
								<th>Num Documento</th>
								<th>Num Tarjeta</th>
								<th>Dia</th>
								<th>Hora</th>
							</tr>
							</thead>
							<tbody style="font-size:13px">
							<?php
								foreach($asistencia as $key=>$row){
							?>	
								<tr>
									<td><?php echo ($key + 1)?></td>
									<td><?php echo $row->persona?></td>
									<td><?php echo $row->numero_documento?></td>
									<td><?php echo $row->tarjeta?></td>
									<td><?php echo $row->dia?></td>
									<td><?php echo $row->hora?></td>
								</tr>
							<?php
								}
							?>
							</tbody>
							</table>
							
							</div>
						</div>
						
					</div> 	
				</div> 

                       <!-- /.box -->
        	</div>
        	    <!--/.col (left) -->
        </div>
          <!-- /.row -->
          <!-- </section> -->
         <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>   


<script type="text/javascript">
$('#openOverlayOpc').on('shown.bs.modal', function() {
     $('#fecha_solicitudxx').datepicker({
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
		$('#persona_').keyup(function() {
			this.value = this.value.toLocaleUpperCase();
		});
			
		$('#persona_').focusin(function() { $('#persona_').select(); });
		
		$('#persona_').autocomplete({
			appendTo: "#persona_busqueda",
			open: function() { $('#persona_').autocomplete("widget").width(300)  },
			source: function(request, response) {
				$.ajax({
				url: '/persona/list_persona/'+$('#persona_').val(),
				dataType: "json",
				success: function(data){
				var resp = $.map(data,function(obj){
						var hash = {key: obj.id_persona, key1: obj.id_ubicacion, value: obj.persona, value1:obj.razon_social};
						return hash;
				}); 
				response(resp);
				},
				error: function() {
				}
			});
			},
			select: function (event, ui) {
				$("#id_persona").val(ui.item.key);
				$("#id_ubicacion").val(ui.item.key1);
				$('#empresa_').val(ui.item.value1);
				//alert(ui.item.value1);
			},
				minLength: 2,
				delay: 100
		});		
		
		
	});

	function activarTipo(){
		var tipo = $("#tipo_oper_top").val();
		//alert(tipo);

		//$('#lblFechaInic').html("Fecha");
		$('#dvFA').hide();
		$('#dvFI').hide();
		$('#dvFF').hide();
		$('#dvHI').hide();
		$('#dvHF').hide();
		$('#dvTot').hide();

		if(tipo == "D"){
			//$('#lblFechaInic').html("F. Inicio");
			$('#dvFI').show();
			$('#dvFF').show();
			$('#dvHI').show();
			$('#dvHF').show();
			$('#dvFA').hide();
			//$('#horafincope').hide();

			$('#dvTot').show();
			$('#lblTotal').html("Total Días");
			
		}
		if(tipo == "H"){
			//$('#lblFechaInic').html("Fecha");
			$('#dvFI').hide();
			$('#dvFF').hide();
			$('#dvFA').show();
			$('#dvHI').show();
			$('#dvHF').show();

			$('#dvTot').show();
			$('#lblTotal').html("Total Minutos");
		}
	}

	function duration(t0, t1){
		let d = (new Date(t1)) - (new Date(t0));
		let weekdays     = Math.floor(d/1000/60/60/24/7);
		let days_         = Math.floor(d/1000/60/60/24 - weekdays*7);
		let days        = Math.floor(d/1000/60/60/24);
		let hours        = Math.floor(d/1000/60/60    - weekdays*7*24            - days_*24);
		let minutes      = Math.floor(d/1000/60       - weekdays*7*24*60         - days_*24*60         - hours*60);
		let seconds      = Math.floor(d/1000          - weekdays*7*24*60*60      - days_*24*60*60      - hours*60*60      - minutes*60);
		let milliseconds = Math.floor(d               - weekdays*7*24*60*60*1000 - days_*24*60*60*1000 - hours*60*60*1000 - minutes*60*1000 - seconds*1000);
		let t = {};
		
		//alert(days);
		//alert(Math.floor(d/1000/60/60/24));
		
		['weekdays', 'days', 'hours', 'minutes', 'seconds', 'milliseconds'].forEach(q=>{ if (eval(q)>0) { t[q] = eval(q); } });
		return t;
	}

	function calculaDias(){
		
		var fecha = $('#fecha_').val();
		var finic = $('#fech_inic_ope').val();
		var fina = $('#fech_fina_ope').val();
		var tipo = $("#tipo_oper_top").val();

		if(finic != "" && fina != "" && tipo =="D"){
			var aFecha1 = finic.split('/');
			var aFecha2 = fina.split('/');
			var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
			var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
			var dif = fFecha2 - fFecha1;
			var dias = Math.floor(dif / (1000 * 60 * 60 * 24));

			if (fFecha1>fFecha2){
				dias = 0;
			}


				
			document.getElementById("total_").value = dias;
		}

		var hinic = $('#horainicope').val();
		var hfina = $('#horafinaope').val();
		
		if(hinic != "" && hfina != "" && tipo =="H"){
			var aFecha1 = fecha.split('/');
			var fFecha1 = aFecha1[2]+"-"+aFecha1[1]+"-"+aFecha1[0];

			//console.log(fFecha1);
			var finic = fFecha1 + " " + hinic + ":00";
			var fhfin = fFecha1 + " " + hfina +":00";

			dias_horas = duration(finic,fhfin);
			dias = (typeof dias_horas.days == "undefined")?0:dias_horas.days;
			horas = (typeof dias_horas.hours == "undefined")?0:dias_horas.hours;
			minutos = (typeof dias_horas.minutes == "undefined")?0:dias_horas.minutes;

			//console.log(horas+":"+minutos);
			var total_minutos = 60 * horas + minutos;

			if (finic>fhfin){
				total_minutos = 0;
			}

			$('#total_').val(total_minutos);

		}		
		//return dias;

	}

	
</script>

