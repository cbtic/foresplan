<title>Sistema de Felmo</title>

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

	//activarTipo();

	var id = $('#id').val();
	if(id == 0){
		$('#fecha_').val(fecha);
		//console.log(fecha);	
	}
	else{
		//$('#id_tipo_operacion').readonly();
	}
	
	activarTipo();

	//$("#id_empresa").select2({ width: '100%' });
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
	var id_persona = $('#id_persona').val();
	var id_ubicacion = $('#id_ubicacion').val();
	var id_tipo_operacion = $('#id_tipo_operacion').val();
	var tipo_oper_top = $('#tipo_oper_top').val();
	var fech_inic_ope = $('#fech_inic_ope').val();
	var fech_fina_ope = $('#fech_fina_ope').val();
	var fecha = $('#fecha_').val();	
	var nume_reso_ope = $('#nume_reso_ope').val();
	var obse_oper_ope = $('#obse_oper_ope').val();
	var horainicope = $('#horainicope').val();
	var horafinaope = $('#horafinaope').val();
	var total = $('#total_').val();
	var persona = $('#persona_').val();

	//alert(horainicope);
	//return false;

	
	if(tipo_oper_top=="D"){
		if(fech_inic_ope == ""){msg += "Debe ingresar la Fecha de Inicio <br>";}
		if(fech_fina_ope == ""){msg += "Debe ingresar la Fecha de Fin <br>";}		
	}
	if(tipo_oper_top=="H"){
		if(horainicope == ""){msg += "Debe ingresar la Hora de Inicio <br>";}
		if(horafinaope == ""){msg += "Debe ingresar la Hora de Fin <br>";}
	}
	if(persona == "")msg += "Debe Seleccionar al Personal <br>";
	if(id_tipo_operacion == "0")msg += "Debe ingresar el Tipo de Papeleta <br>";
	if(tipo_oper_top == "0"){msg += "Debe ingresar el Tipo de Hora <br>";}

	calculaDias();
	if(parseInt(total) < 1){msg += "El total de tiempo es menor a 1 <br>";}
	//console.log(total);


	if(msg!=""){
        bootbox.alert(msg); 
        return false;
    }
    else{
		$.ajax({
				url: "/papeleta/send_papeleta",
				type: "POST",
				data : {_token:_token,id:id,id_persona:id_persona,id_ubicacion:id_ubicacion,id_tipo_operacion:id_tipo_operacion,tipo_oper_top:tipo_oper_top,
					fech_inic_ope:fech_inic_ope,fech_fina_ope:fech_fina_ope,horainicope:horainicope,horafinaope:horafinaope,nume_reso_ope:nume_reso_ope,
					obse_oper_ope:obse_oper_ope,total:total,fecha:fecha},
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
				Registro de Papeleta
			</div>
			
            <div class="card-body">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:10px">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" id="id" value="<?php echo $id?>">
						<input type="hidden" name="id_ubicacion" id="id_ubicacion" value="">
						<input type="hidden" name="id_persona" id="id_persona" value="">
						<!--<input type="hidden" name="id_ubicacion" id="id_ubicacion" value="<?php echo $papeleta->id_ubicacion?>">-->
						
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label class="control-label">Personal</label>
									<input id="persona_" name="persona_" class="form-control form-control-sm ui-autocomplete-input"  value="<?php echo $papeleta->persona?>" type="text" autocomplete="off" <?php if($id!=0)echo "readonly"?>>
									<!--<input id="id_persona" name="id_persona" class="form-control form-control-sm" value="<?php echo $papeleta->id_persona?>" type="hidden"> -->
									<div id="persona_busqueda" style="position: absolute;z-index: 100;background-color:#ffffff;width: 400px;"></div>																		
									@error('persona') <span ...>Dato requerido</span> @enderror
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
									<label class="control-label">Empresa</label>
									<input id="empresa_" name="empresa_" class="form-control form-control-sm" readonly value="<?php echo $papeleta->razon_social?>" type="text">
									@error('empresa') <span ...>Dato requerido</span> @enderror
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label class="control-label">Papeleta</label>
									<select name="id_tipo_operacion" id="id_tipo_operacion" class="form-control form-control-sm" <?php if($id!=0)echo "disabled"?>>
											<option value="0">Seleccionar</option>
											<?php foreach($justificacion as $row):?>
												<option value="<?php echo $row->id?>" <?php if($row->id==$papeleta->id_tipo_operacion)echo "selected='selected'"?> ><?php echo $row->denominacion?></option>
											<?php  endforeach;?>
									</select>
									@error('id_tipo_operacion') <span ...>Dato requerido</span> @enderror
								</div>
							</div>
							<div class="col-lg-2">
								<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
									<label class="control-label">Tipo</label>
									<select name="tipo_oper_top" id="tipo_oper_top" class="form-control form-control-sm" onChange="activarTipo()" <?php if($id!=0)echo "disabled"?> > 
										<option value="0">Seleccionar</option>
										<option value="D" <?php if($papeleta->tipo_oper_top == "D")echo "selected='selected'" ?> ><?php echo "Por Día"?></option>
										<option value="H" <?php if($papeleta->tipo_oper_top == "H")echo "selected='selected'" ?> ><?php echo "Por Hora"?></option>									
									</select>
									@error('tipo_hora_ope') <span ...>Dato requerido</span> @enderror
								</div>
							</div>
							<div class="col-lg-3" id="dvFA">
								<div class="form-group">
									<label class="control-label">Fecha</label>
									<input placeholder="Fecha" autocomplete="off" type="text" wire:model="fecha_" id="fecha_" class="form-control form-control-sm datepicker"  data-provide="datepicker" data-date-autoclose="true" 
										data-date-format="dd/mm/yyyy" data-date-today-highlight="true"                        
										onchange="this.dispatchEvent(new InputEvent('input'))" value="<?php echo $papeleta->fech_inic_ope?>" <?php if($id!=0)echo "disabled"?> >
										@error('fech_inic_ope') <span ...>Dato requerido</span> @enderror										
								</div>
							</div>
						</div>
						<div class="row" onmouseover ="calculaDias()">							
							<div class="col-lg-3" id="dvFI">
								<div class="form-group">
									<label class="control-label">F. Inicio</label>
									<input placeholder="Fecha Inicio" autocomplete="off" type="text" wire:model="fech_inic_ope" id="fech_inic_ope" class="form-control form-control-sm datepicker"  data-provide="datepicker" data-date-autoclose="true" 
										data-date-format="dd/mm/yyyy" data-date-today-highlight="true"                        
										onchange="this.dispatchEvent(new InputEvent('input'))" onChange="calculaDias()" value="<?php echo $papeleta->fech_inic_ope?>" <?php if($id!=0)echo "disabled"?>>
										@error('fech_inic_ope') <span ...>Dato requerido</span> @enderror										
								</div>
							</div>
							<div class="col-lg-3" id="dvFF">
								<div class="form-group">
									<label class="control-label">F. Fin</label>
									<input placeholder="Fecha Fin" autocomplete="off" type="text" wire:model="fech_fina_ope" id="fech_fina_ope" class="form-control form-control-sm datepicker"  data-provide="datepicker" data-date-autoclose="true" 
										data-date-format="dd/mm/yyyy" data-date-today-highlight="true"                        
										onchange="this.dispatchEvent(new InputEvent('input'))" onChange="calculaDias()" value="<?php echo $papeleta->fech_fina_ope?>" <?php if($id!=0)echo "disabled"?>>
										@error('fech_fina_ope') <span ...>Dato requerido</span> @enderror										
								</div>
							</div>								
							<div class="col-lg-3" id="dvHI">
								<div class="form-group">
									<label class="control-label">Hora Inicio</label>
									<input placeholder="Hora Inicio" type="time" wire:model="horainicope" id="horainicope" class="form-control form-control-sm" value="<?php echo $papeleta->horainicope?>">
										@error('horainicope') <span ...>Dato requerido</span> @enderror										
								</div>
							</div>
							<div class="col-lg-3" id="dvHF" >
								<div class="form-group">
									<label class="control-label">Hora Fin</label>
									<input placeholder="Hora Fin" type="time" wire:model="horafinaope" id="horafinaope" class="form-control form-control-sm" value="<?php echo $papeleta->horafinaope?>">
										@error('horafinaope') <span ...>Dato requerido</span> @enderror										
								</div>
							</div>
							<div class="col-lg-2" id="dvTot" >
								<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
									<label class="control-label" id="lblTotal">Total</label>
									<input placeholder="Total" id="total_" name="total_" class="form-control form-control-sm" value="<?php if($papeleta->tipo_oper_top == "D")echo $papeleta->nume_dias_ope; if($papeleta->tipo_oper_top == "H")echo $papeleta->nume_minut_ope; ?>" type="text" readonly>
								</div>
							</div>
						</div>
						<div class="row" onmouseover ="calculaDias()">								
							<div class="col-lg-6">
								<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
									<label class="control-label">Doc. Referencia</label>
									<input id="nume_reso_ope" name="nume_reso_ope" class="form-control form-control-sm"  value="<?php echo $papeleta->nume_reso_ope?>" type="text" >
									@error('nume_reso_ope') <span ...>Dato requerido</span> @enderror
								</div>
							</div>	
							<div class="col-lg-6">
								<div class="form-group" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px">
									<label class="control-label">Observación</label>
									<textarea id="obse_oper_ope" name="obse_oper_ope" class="form-control form-control-sm"  value="<?php echo $papeleta->obse_oper_ope?>" type="text"></textarea>
									@error('obse_oper_ope') <span ...>Dato requerido</span> @enderror
								</div>
							</div>																														

						</div>			
										
						<div style="margin-top:10px;float:right" class="form-group">
							<div class="col-sm-12 controls">
								<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">
									<a href="javascript:void(0)" onClick="fn_save()" class="btn btn-sm btn-success">Guardar</a>
								</div>
													
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
			if (fFecha1<=fFecha2){
				dias = dias+1;
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

