<div class="row">
    @if (session()->has('message'))
    <div class="alert alert-success col-sm-12">
        {{ session('message') }}
    </div>
    @endif
    <div class="col" style="display:none">
        <form wire:submit.prevent="submit">
            <input type="hidden" name="oculto">
    </div>
        <div class="col col-md-3">
			<label class="form-control-sm">Nombre del Turno</label>
            <input placeholder="Ingresar turno" type="text" wire:model="nomb_desc_tur" id="nomb_desc_tur" class="form-control form-control-sm">
            @error('nomb_desc_tur') <span ...>Dato requerido</span> @enderror
        </div>
		
		<!--
        <div class="col col-md-2">
			<label class="form-control-sm">Hora de Entrada</label>    
			<input placeholder="Ingresar hora entrada" type="time" wire:model="hora_entr_tur" id="hora_entr_tur" class="form-control form-control-sm" >
			@error('hora_entr_tur') <span ...>Dato requerido</span> @enderror
        </div>
		
        <div class="col col-md-2">
			<label class="form-control-sm">Hora de Salida</label>
            <input placeholder="Ingresar hora salida" type="time" wire:model="hora_sali_tur" id="hora_sali_tur" class="form-control form-control-sm">
            @error('hora_sali_tur') <span ...>Dato requerido</span> @enderror
        </div>
		-->
		<div class="col col-md-1">
			<label class="form-control-sm">Flag Tolerancia</label>
			<br />
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="flag_tole_tur" name="flag_tole_tur" id="flag_tole_tur1" value="0">
			<label class="form-check-label" for="flexRadioDefault1">Por Dia</label>
			</div>
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="flag_tole_tur" name="flag_tole_tur" id="flag_tole_tur2" checked value="1">
			<label class="form-check-label" for="flexRadioDefault2">Por Mes</label>
			</div>
			<!--
            <input placeholder="Ingresar 0(por dia), 1(por mes)" type="text" wire:model="flag_tole_tur" id="flag_tole_tur" class="form-control form-control-sm">
			-->
			
            @error('flag_tole_tur') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col col-md-1">
			<label class="form-control-sm">Minutos de Tolerancia</label>
            <input placeholder="Minutos tolerancia" type="text" wire:model="minu_tole_tur" id="minu_tole_tur" class="form-control form-control-sm">
            @error('minu_tole_tur') <span ...>Dato requerido</span> @enderror
        </div>
		<!--
        <div class="col">
            <input placeholder="tipo_refr_tur" type="text" wire:model="tipo_refr_tur" id="tipo_refr_tur" class="form-control form-control-sm">
            @error('tipo_refr_tur') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="refr_sali_tur" type="text" wire:model="refr_sali_tur" id="refr_sali_tur" class="form-control form-control-sm">
            @error('refr_sali_tur') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="refr_entr_tur" type="text" wire:model="refr_entr_tur" id="refr_entr_tur" class="form-control form-control-sm">
            @error('refr_entr_tur') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="refr_tole_tur" type="text" wire:model="refr_tole_tur" id="refr_tole_tur" class="form-control form-control-sm">
            @error('refr_tole_tur') <span ...>Dato requerido</span> @enderror
        </div>
		-->
		<div class="col col-md-5">
		<table class="table table-hover table-sm">
			<thead>
				<tr style="font-size:13px">
					<th>Dia</th>
					<th>Labora</th>
					<th>Hora Entrada</th>
					<th>Hora Salida</th>
				</tr>
				</thead>
				<tbody>
					
					@if($detalle_turno)
						@foreach($detalle_turno as $key => $row)
							 <tr>
								<td>
								<?php echo $dia[$row['nume_ndia_dtu']]; ?>
								<input type="hidden" wire:model="detalle_turno.{{$key}}.nume_ndia_dtu" id="nume_ndia_dtu" class="form-control form-control-sm" >
								</td>
								<td>
									<div class="form-check form-check-inline">
									<!--<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" value="S">-->
									<input class="form-check-input" type="radio" wire:model="detalle_turno.{{$key}}.flag_labo_dtu" name="detalle_turno.{{$key}}.flag_labo_dtu" id="flag_labo_dtu" value="S">
									<label class="form-check-label" for="flexRadioDefault1">Si</label>
									</div>
									<div class="form-check form-check-inline">
									<!--<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" checked value="N">-->
									<input class="form-check-input" type="radio" wire:model="detalle_turno.{{$key}}.flag_labo_dtu" name="detalle_turno.{{$key}}.flag_labo_dtu" id="flag_labo_dtu" checked value="N">
									<label class="form-check-label" for="flexRadioDefault2">No</label>
									</div>
								</td>
								<td>
									<!--
									<input placeholder="Ingresar hora entrada" wire:ignore wire:model="detalle_turno[{{$key}}]['hora_entr_dtu']" id="hora_entr_dtu" class="form-control form-control-sm" >
									-->
									<input type="time" wire:model="detalle_turno.{{$key}}.hora_entr_dtu" id="hora_entr_dtu" class="form-control form-control-sm" >
								</td>
								<td>
									<!--<input placeholder="Ingresar hora salida" type="time" wire:model="hora_sali_dtu" id="hora_sali_dtu" class="form-control form-control-sm">-->
									<input type="time" wire:model="detalle_turno.{{$key}}.hora_sali_dtu" id="hora_sali_dtu" class="form-control form-control-sm" >
								</td>
							</tr>						
						@endforeach
					@endif
					<?php 
					/*
					print_r($formSlugs);
					if($detalle_turno){
						foreach($detalle_turno as $key=>$row){
							//echo $row->nume_ndia_dtu; wire:ignore
							?>
							<tr wire:key="{{$key}}" >
								<td><?php echo $dia[$row->nume_ndia_dtu]; echo $row->id?></td>
								<td>
									<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" value="S">
									<label class="form-check-label" for="flexRadioDefault1">Si</label>
									</div>
									<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" checked value="N">
									<label class="form-check-label" for="flexRadioDefault2">No</label>
									</div>
								</td>
								<td>
								<!--
								<input placeholder="Ingresar hora entrada" wire:ignore wire:model="detalle_turno[{{$key}}]['hora_entr_dtu']" id="hora_entr_dtu" class="form-control form-control-sm" >
								-->
								</td>
								<td><input placeholder="Ingresar hora salida" type="time" wire:model="hora_sali_dtu" id="hora_sali_dtu" class="form-control form-control-sm"></td>
							</tr>
							<?php
						}
					}
					*/
					?>
					<!--
					<tr>
						<td>Lunes</td>
						<td>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" value="S">
							<label class="form-check-label" for="flexRadioDefault1">Si</label>
							</div>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" checked value="N">
							<label class="form-check-label" for="flexRadioDefault2">No</label>
							</div>
						</td>
						<td><input placeholder="Ingresar hora entrada" type="time" wire:model="hora_entr_tur" id="hora_entr_tur" class="form-control form-control-sm" ></td>
						<td><input placeholder="Ingresar hora salida" type="time" wire:model="hora_sali_tur" id="hora_sali_tur" class="form-control form-control-sm"></td>
					</tr>
					<tr>
						<td>Martes</td>
						<td>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" value="S">
							<label class="form-check-label" for="flexRadioDefault1">Si</label>
							</div>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" checked value="N">
							<label class="form-check-label" for="flexRadioDefault2">No</label>
							</div>
						</td>
						<td><input placeholder="Ingresar hora entrada" type="time" wire:model="hora_entr_tur" id="hora_entr_tur" class="form-control form-control-sm" ></td>
						<td><input placeholder="Ingresar hora salida" type="time" wire:model="hora_sali_tur" id="hora_sali_tur" class="form-control form-control-sm"></td>
					</tr>
					<tr>
						<td>Miercoles</td>
						<td>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" value="S">
							<label class="form-check-label" for="flexRadioDefault1">Si</label>
							</div>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" checked value="N">
							<label class="form-check-label" for="flexRadioDefault2">No</label>
							</div>
						</td>
						<td><input placeholder="Ingresar hora entrada" type="time" wire:model="hora_entr_tur" id="hora_entr_tur" class="form-control form-control-sm" ></td>
						<td><input placeholder="Ingresar hora salida" type="time" wire:model="hora_sali_tur" id="hora_sali_tur" class="form-control form-control-sm"></td>
					</tr>
					<tr>
						<td>Jueves</td>
						<td>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" value="S">
							<label class="form-check-label" for="flexRadioDefault1">Si</label>
							</div>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" checked value="N">
							<label class="form-check-label" for="flexRadioDefault2">No</label>
							</div>
						</td>
						<td><input placeholder="Ingresar hora entrada" type="time" wire:model="hora_entr_tur" id="hora_entr_tur" class="form-control form-control-sm" ></td>
						<td><input placeholder="Ingresar hora salida" type="time" wire:model="hora_sali_tur" id="hora_sali_tur" class="form-control form-control-sm"></td>
					</tr>
					<tr>
						<td>Viernes</td>
						<td>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" value="S">
							<label class="form-check-label" for="flexRadioDefault1">Si</label>
							</div>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" checked value="N">
							<label class="form-check-label" for="flexRadioDefault2">No</label>
							</div>
						</td>
						<td><input placeholder="Ingresar hora entrada" type="time" wire:model="hora_entr_tur" id="hora_entr_tur" class="form-control form-control-sm" ></td>
						<td><input placeholder="Ingresar hora salida" type="time" wire:model="hora_sali_tur" id="hora_sali_tur" class="form-control form-control-sm"></td>
					</tr>
					<tr>
						<td>Sabado</td>
						<td>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" value="S">
							<label class="form-check-label" for="flexRadioDefault1">Si</label>
							</div>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" checked value="N">
							<label class="form-check-label" for="flexRadioDefault2">No</label>
							</div>
						</td>
						<td><input placeholder="Ingresar hora entrada" type="time" wire:model="hora_entr_tur" id="hora_entr_tur" class="form-control form-control-sm" ></td>
						<td><input placeholder="Ingresar hora salida" type="time" wire:model="hora_sali_tur" id="hora_sali_tur" class="form-control form-control-sm"></td>
					</tr>
					<tr>
						<td>Domingo</td>
						<td>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" value="S">
							<label class="form-check-label" for="flexRadioDefault1">Si</label>
							</div>
							<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" wire:model="lune_dsem_tur" name="lune_dsem_tur" id="lune_dsem_tur" checked value="N">
							<label class="form-check-label" for="flexRadioDefault2">No</label>
							</div>
						</td>
						<td><input placeholder="Ingresar hora entrada" type="time" wire:model="hora_entr_tur" id="hora_entr_tur" class="form-control form-control-sm" ></td>
						<td><input placeholder="Ingresar hora salida" type="time" wire:model="hora_sali_tur" id="hora_sali_tur" class="form-control form-control-sm"></td>
					</tr>
					-->
				</tbody>
		</table>
		</div>
		
		<!--
        <div class="col">
			<label class="form-control-sm">Labora Domingo</label>
            <br />
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="domi_dsem_tur" name="domi_dsem_tur" id="domi_dsem_tur" value="S">
			<label class="form-check-label" for="flexRadioDefault1">Si</label>
			</div>
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="domi_dsem_tur" name="domi_dsem_tur" id="domi_dsem_tur" checked value="N">
			<label class="form-check-label" for="flexRadioDefault2">No</label>
			</div>
            @error('domi_dsem_tur') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <br />
			
            @error('lune_dsem_tur') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
			<label class="form-control-sm">Labora Martes</label>
            <br />
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="mart_dsem_tur" name="mart_dsem_tur" id="mart_dsem_tur" value="S">
			<label class="form-check-label" for="flexRadioDefault1">Si</label>
			</div>
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="mart_dsem_tur" name="mart_dsem_tur" id="mart_dsem_tur" checked value="N">
			<label class="form-check-label" for="flexRadioDefault2">No</label>
			</div>
            @error('mart_dsem_tur') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
			<label class="form-control-sm">Labora Miercoles</label>
            <br />
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="mier_dsem_tur" name="mier_dsem_tur" id="mier_dsem_tur" value="S">
			<label class="form-check-label" for="flexRadioDefault1">Si</label>
			</div>
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="mier_dsem_tur" name="mier_dsem_tur" id="mier_dsem_tur" checked value="N">
			<label class="form-check-label" for="flexRadioDefault2">No</label>
			</div>
            @error('mier_dsem_tur') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
			<label class="form-control-sm">Labora Jueves</label>
            <br />
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="juev_dsem_tur" name="juev_dsem_tur" id="juev_dsem_tur" value="S">
			<label class="form-check-label" for="flexRadioDefault1">Si</label>
			</div>
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="juev_dsem_tur" name="juev_dsem_tur" id="juev_dsem_tur" checked value="N">
			<label class="form-check-label" for="flexRadioDefault2">No</label>
			</div>
            @error('juev_dsem_tur') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
			<label class="form-control-sm">Labora Viernes</label>
            <br />
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="vier_dsem_tur" name="vier_dsem_tur" id="vier_dsem_tur" value="S">
			<label class="form-check-label" for="flexRadioDefault1">Si</label>
			</div>
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="vier_dsem_tur" name="vier_dsem_tur" id="vier_dsem_tur" checked value="N">
			<label class="form-check-label" for="flexRadioDefault2">No</label>
			</div>
            @error('vier_dsem_tur') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
			<label class="form-control-sm">Labora Sabado</label>
            <br />
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="saba_dsem_tur" name="saba_dsem_tur" id="saba_dsem_tur" value="S">
			<label class="form-check-label" for="flexRadioDefault1">Si</label>
			</div>
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="saba_dsem_tur" name="saba_dsem_tur" id="saba_dsem_tur" checked value="N">
			<label class="form-check-label" for="flexRadioDefault2">No</label>
			</div>
            @error('saba_dsem_tur') <span ...>Dato requerido</span> @enderror
        </div>
		-->
		<!--
        <div class="col">
            <input placeholder="hora_sema_tur" type="text" wire:model="hora_sema_tur" id="hora_sema_tur" class="form-control form-control-sm">
            @error('hora_sema_tur') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="tiemp_refr_min" type="text" wire:model="tiemp_refr_min" id="tiemp_refr_min" class="form-control form-control-sm">
            @error('tiemp_refr_min') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="perm_dia_tur" type="text" wire:model="perm_dia_tur" id="perm_dia_tur" class="form-control form-control-sm">
            @error('perm_dia_tur') <span ...>Dato requerido</span> @enderror
        </div>
		-->
		
    <div class="col" style="padding-right: 0px; margin-top:20px">
        @if ($updateMode)
        <button wire:click.prevent="update()" class="btn btn-dark">Actualizar</button>
        @else
        <button wire:click.prevent="store()" class="btn btn-success">Grabar</button>
        @endif
        <button wire:click.prevent="cancel()" class="btn btn-success">Cancelar</button>
        </form>
    </div>
</div>

@push('after-scripts')
<!--
E:\proyectos laravel\sigplan8\public\bower_components\bootstrap-timepicker\js\bootstrap-timepicker
E:\proyectos laravel\sigplan8\public\bower_components\bootstrap-timepicker\css\timepicker.less
<script src="resources/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<link rel="stylesheet" href="resources/plugins/timepicker/bootstrap-timepicker.min.css">
-->
<!--
<script src="<?php //echo URL::to('/') ?>/bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
<link rel="stylesheet" href="<?php //echo URL::to('/') ?>/bower_components/bootstrap-timepicker/css/timepicker.less">
-->


<!--     
<link rel="stylesheet" href="<?php //echo URL::to('/') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php //echo URL::to('/') ?>/bower_components/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="<?php //echo URL::to('/') ?>/bower_components/icons/css/icons.min.css">

<script src="<?php //echo URL::to('/') ?>/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
<link rel="stylesheet" href="<?php //echo URL::to('/') ?>/bower_components/timepicker/bootstrap-timepicker.min.css">
-->


<script type="text/javascript">
	/*
	$('#hora_entr_tur').timepicker({
		showInputs: false,
	});
	
	$('#hora_entr_tur').on('change', function (e) {
		//Livewire.emit('getHoraEntrTur',e.target.value);
		@this.set('hora_entr_tur', e.target.value);
	});
	*/
	
</script>
@endpush