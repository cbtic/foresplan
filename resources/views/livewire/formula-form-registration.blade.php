<div class="row">
    @if (session()->has('message'))
    <div class="alert alert-success col-sm-12">
        {{ session('message') }}
    </div>
    @endif
    <div class="col">
        <form wire:submit.prevent="submit">
            <input type="hidden" name="oculto">
    </div>
        <div class="col">
			<label class="form-control-sm">Planilla</label>
			<select name="id_planilla" id="id_planilla" class="form-control form-control-sm" wire:model="id_planilla">
				<option value="">- Seleccione Planilla-</option>
				<?php foreach($planillas as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->desc_tipo_tpl?></option>
				<?php }?>
			</select>
            @error('id_planilla') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
			<label class="form-control-sm">Subplanilla</label>
			<select name="id_subplanilla" id="id_subplanilla" class="form-control form-control-sm" wire:model="id_subplanilla">
				<option value="">- Seleccione Subplanilla-</option>
				<?php foreach($subplanillas as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->titu_subt_stp?></option>
				<?php }?>
			</select>
            @error('id_subplanilla') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
			<label class="form-control-sm">Concepto</label>
			<select name="id_concepto" id="id_concepto" class="form-control form-control-sm" wire:model="id_concepto">
				<option value="">- Seleccione Concepto-</option>
				<?php foreach($conceptos as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->desc_cort_tco?></option>
				<?php }?>
			</select>
            @error('id_concepto') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <textarea placeholder="formula_for" wire:model="formula_for" name="formula_for" id="formula_for" cols="30" rows="3"><?php echo $formula_for?></textarea>
            @error('formula_for') <span ...>Dato requerido</span> @enderror
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

<script src="<?php echo URL::to('/') ?>/js/formula.js"></script>
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