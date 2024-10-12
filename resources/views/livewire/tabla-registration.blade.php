<div class="row">
    @if (session()->has('message'))
    <div class="alert alert-success col-sm-12">
        {{ session('message') }}
    </div>
    @endif
    <div class=" col">
        <form wire:submit.prevent="submit">
            <input placeholder="Código" type="text" wire:model="tab_ite1_cod" id="tab_ite1_cod" class="form-control form-control-sm">
            @error('tab_ite1_cod') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Código tabla secundaria" type="text" wire:model="tab_ite2_cod" id="tab_ite2_cod" class="form-control form-control-sm">
        @error('tab_ite2_cod') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col-sm-2">
        <input placeholder="Descripción larga" type="text" wire:model="tab_larg_des" id="tab_larg_des" class="form-control form-control-sm">
        @error('tab_larg_des') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Descripción corta" type="text" wire:model="tab_cort_des" id="tab_cort_des" class="form-control form-control-sm">
        @error('tab_cort_des') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Monto Imp" type="number" wire:model="tab_mont_imp" id="tab_mont_imp" class="form-control form-control-sm">
        @error('tab_mont_imp') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Orde Vis" type="text" wire:model="tab_orde_vis" id="tab_orde_vis" class="form-control form-control-sm">
        @error('tab_orde_vis') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <select name="tab_tabl_est" class="form-control form-control-sm" wire:model="tab_tabl_est" id="tab_tabl_est">
            <option value="">Seleccionar</option>
            <option value="A" {{ $tab_tabl_est == 'A' ? 'selected="selected"' : '' }}>Activo</option>
            <option value="I" {{ $tab_tabl_est == 'I' ? 'selected="selected"' : '' }}>Inactivo</option>
        </select>
        @error('tab_tabl_est') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col" style="padding-right: 0px;">
        @if ($updateMode)
        <button wire:click.prevent="update()" class="btn btn-dark btn-sm">Actualizar</button>
        @else
        <button wire:click.prevent="store()" class="btn btn-success btn-sm">Grabar</button>
        @endif
        <button wire:click.prevent="cancel()" class="btn btn-success btn-sm">Cancelar</button>
        </form>
    </div>
</div>