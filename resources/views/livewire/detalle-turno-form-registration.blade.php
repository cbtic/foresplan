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
        <div class="col">
			<label class="form-control-sm">Dia</label>
			<select name="nume_ndia_dtu" id="nume_ndia_dtu" class="form-control form-control-sm" wire:model="nume_ndia_dtu">
				<option value="0">---Seleccione Turno---</option>
				<?php foreach($dia as $key=>$row){?>
				<option value="<?php echo $key?>"><?php echo $row?></option>
				<?php }?>
			</select>
			<!--
            <input placeholder="nume_ndia_dtu" type="text" wire:model="nume_ndia_dtu" id="nume_ndia_dtu" class="form-control form-control-sm">
			-->
            @error('nume_ndia_dtu') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
			<label class="form-control-sm">Labora</label>  
			<br />
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="flag_labo_dtu" name="flag_labo_dtu" id="flag_labo_dtu" value="S">
			<label class="form-check-label" for="flexRadioDefault1">Si</label>
			</div>
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" wire:model="flag_labo_dtu" name="flag_labo_dtu" id="flag_labo_dtu" checked value="N">
			<label class="form-check-label" for="flexRadioDefault2">No</label>
			</div>
            <!--<input placeholder="Ingresar S(si), N(no)" type="text" wire:model="flag_labo_dtu" id="flag_labo_dtu" class="form-control form-control-sm">-->
			
            @error('flag_labo_dtu') <span ...>Dato requerido</span> @enderror
        </div>
		<!--
        <div class="col">
			<label class="form-control-sm">Minutos de Tolerancia</label>
            <input placeholder="Ingresar minutos tolerancia" type="text" wire:model="minu_tole_dtu" id="minu_tole_dtu" class="form-control form-control-sm">
            @error('minu_tole_dtu') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
			<label class="form-control-sm">Hora de Entrada</label>
            <input placeholder="Ingresar hora entrada" type="time" wire:model="hora_entr_dtu" id="hora_entr_dtu" class="form-control form-control-sm">
            @error('hora_entr_dtu') <span ...>Dato requerido</span> @enderror
        </div>
		<div class="col">
			<label class="form-control-sm">Hora de Salida</label>
            <input placeholder="Ingresar hora salida" type="time" wire:model="hora_sali_dtu" id="hora_sali_dtu" class="form-control form-control-sm">
            @error('hora_sali_dtu') <span ...>Dato requerido</span> @enderror
        </div>
		-->
		
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

<style type="text/css">
.hidden{
	display:none!important
}
.alert alert-success{
	display:none!important
}

</style>