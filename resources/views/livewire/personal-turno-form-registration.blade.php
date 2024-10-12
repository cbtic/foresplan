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
		<?php //echo "es ".$id_persona
		//print_r($personas);
		?>
		<!--wire:ignore-->
		<div class="col" >
			<label class="form-control-sm">Area</label>
			<select name="id_area_trabajo_" id="id_area_trabajo_" class="form-control form-control-sm">
				<option value="">- Seleccione Area-</option>
				<?php foreach($area_trabajo as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
				<?php }?>
			</select>
			<?php //echo $id_unidad_trabajo?>
        </div>
		<div class="col" >
			<label class="form-control-sm">Unidad</label>
			<select name="id_unidad_trabajo_" id="id_unidad_trabajo_" class="form-control form-control-sm">
				<option value="">---Seleccione Unidad---</option>
				<?php if($unidad_trabajo!=NULL){
					foreach($unidad_trabajo as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
				<?php }
					}
				?>
			</select>
			<?php //echo $id_unidad_trabajo?>
        </div>
        <div class="col" >
			<label class="form-control-sm">Persona</label>
			<!--
			<input id="persona_" name="persona_" class="form-control form-control-sm ui-autocomplete-input" value="<?php //echo $nomb?>" type="text" autocomplete="off">
			<div class="input-group" id="persona_busqueda"></div>
			-->
			<!--<input placeholder="id_persona" type="text" id="id_persona" class="form-control form-control-sm">-->
			<select name="id_persona" id="id_persona" class="form-control form-control-sm" wire:model="id_persona">
				<option value="0">---Seleccione Persona---</option>
				<?php foreach($personas as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->persona?></option>
				<?php }?>
			</select>
			
            @error('id_persona') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
			<label class="form-control-sm">Turno</label>
			<select name="id_turno" id="id_turno" class="form-control form-control-sm" wire:model="id_turno">
				<option value="0">---Seleccione Turno---</option>
				<?php foreach($turno as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->nomb_desc_tur?></option>
				<?php }?>
			</select>
			<!--
            <input placeholder="id_turno" type="number" wire:model="id_turno" id="id_turno" class="form-control form-control-sm">
			-->
            @error('id_turno') <span ...>Dato requerido</span> @enderror
        </div>
		<!--
        <div class="col">
            <input placeholder="codi_tarj_etu" type="text" wire:model="codi_tarj_etu" id="codi_tarj_etu" class="form-control form-control-sm">
            @error('codi_tarj_etu') <span ...>Dato requerido</span> @enderror
        </div>
		-->
		<!--
        <div class="col">
			<label class="form-control-sm">Fecha Asignaci&oacute;n</label>
            <input placeholder="Ingresar fecha asignaci&oacute;n" type="text" wire:model="fech_asig_ttu" id="fech_asig_ttu" class="form-control form-control-sm">
            @error('fech_asig_ttu') <span ...>Dato requerido</span> @enderror
        </div>
		-->
        <div class="col">
			<label class="form-control-sm">Marcaci&oacute;n</label>
			
			<br />
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="flag_cont_asis" name="flag_cont_asis" id="flag_cont_asis" value="S">
			<label class="form-check-label" for="flexRadioDefault1">Si</label>
			</div>
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="flag_cont_asis" name="flag_cont_asis" id="flag_cont_asis" checked value="N">
			<label class="form-check-label" for="flexRadioDefault2">No</label>
			</div>
			<!--
            <input placeholder="Ingresar S(si), N(no)" type="text" wire:model="flag_cont_asis" id="flag_cont_asis" class="form-control form-control-sm">
			-->
            @error('flag_cont_asis') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
			<label class="form-control-sm">Sobretiempo</label>
			
			<br />
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="flag_sobt_ent" name="flag_sobt_ent" id="flag_sobt_ent" value="0">
			<label class="form-check-label" for="flexRadioDefault1">Si</label>
			</div>
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="flag_sobt_ent" name="flag_sobt_ent" id="flag_sobt_ent" checked value="1">
			<label class="form-check-label" for="flexRadioDefault2">No</label>
			</div>
			<!--
            <input placeholder="Ingresar 0(SI), 1(No)" type="text" wire:model="flag_sobt_ent" id="flag_sobt_ent" class="form-control form-control-sm">
			-->
            @error('flag_sobt_ent') <span ...>Dato requerido</span> @enderror
        </div>
		
    <div class="col" style="padding-right: 0px;">
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

<script src="<?php echo URL::to('/') ?>/js/personalTurno.js"></script>
<script type="text/javascript">
	
	$(document).ready(function () {
		
        $('#id_persona').select2();
        $('#id_persona').on('change', function (e) {
            //var data = $('#id_persona').select2("val");
            //@this.set('id_persona', data);
			@this.set('id_persona', e.target.value);
			
        });
		
		$('#id_area_trabajo_').on('change', function (e) {
            @this.set('id_area_trabajo', e.target.value);
			
			//event.preventDefault();
			livewire.emit('resetFilters');
			
        });
		
		$('#id_unidad_trabajo_').on('change', function (e) {
            @this.set('id_unidad_trabajo', e.target.value);
        });
		
    });
	
	/*
	window.initSelect2 = () => {
        $("#id_persona").select2({
            minimumResultsForSearch: 2,
            //allowClear: true
        });
    }
    initSelect2();
		
	window.livewire.on('select2', ()=>{
        initSelect2();
    });
	*/
	
	/*
	$('#id_persona').select2();
	
	$('#id_persona').on('change', function (e) { 
		//console.log('select event');
		//Livewire.emit('getIdPersona',e.target.value);
		Livewire.emit('getIdPersona',e.target.value);
		//livewire.emit('selectedCompanyItem', e.target.value)
		//$('#id_persona').trigger("change");
		//$('#id_persona').val(e.target.value);
		//$('#id_persona').trigger("change");
		//@this.set('id_persona', e.target.value);
		
		//alert(e.target.value);
		
	});
	*/
	/*
	$(document).ready(function() {
		window.initSelectCompanyDrop=()=>{
			$('#id_persona').select2({
				placeholder: 'Select a Company',
				allowClear: true
				});
		}
		initSelectCompanyDrop();
		$('#id_persona').on('change', function (e) {
			livewire.emit('getIdPersona', e.target.value)
		});
		window.livewire.on('select2',()=>{
			initSelectCompanyDrop();
		});
		
		
	});
	*/

</script>
@endpush
