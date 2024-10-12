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
            <input placeholder="codi_conc_tco" type="text" wire:model="codi_conc_tco" id="codi_conc_tco" class="form-control form-control-sm">
            @error('codi_conc_tco') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="desc_conc_tco" type="text" wire:model="desc_conc_tco" id="desc_conc_tco" class="form-control form-control-sm">
            @error('desc_conc_tco') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="desc_cort_tco" type="text" wire:model="desc_cort_tco" id="desc_cort_tco" class="form-control form-control-sm">
            @error('desc_cort_tco') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">												
			<select name="estado" id="estado" class="form-control form-control-sm" wire:model="estado">
				<option value="0">---Seleccione---</option>
				<option value="A">A</option>
				<option value="C">C</option>
			</select>			
            @error('estado') <span ...>Dato requerido</span> @enderror
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