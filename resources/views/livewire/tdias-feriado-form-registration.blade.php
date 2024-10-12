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
            <input placeholder="fech_feri_tdf" type="text" wire:model="fecha_feriado" id="fech_feri_tdf" " class="form-control form-control-sm datepicker" data-provide="datepicker" data-date-autoclose="true" 
            data-date-format="dd/mm/yyyy" data-date-today-highlight="true" onchange="this.dispatchEvent(new InputEvent('input'))">
            @error('fech_feri_tdf') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="flag_mdia_tdf" type="text" wire:model="flag_mdia_tdf" id="flag_mdia_tdf" class="form-control form-control-sm">
            @error('flag_mdia_tdf') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="moti_feri_tdf" type="text" wire:model="moti_feri_tdf" id="moti_feri_tdf" class="form-control form-control-sm">
            @error('moti_feri_tdf') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="flag_nlab_tdf" type="text" wire:model="flag_nlab_tdf" id="flag_nlab_tdf" class="form-control form-control-sm">
            @error('flag_nlab_tdf') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="flag_recu_tdf" type="text" wire:model="flag_recu_tdf" id="flag_recu_tdf" class="form-control form-control-sm">
            @error('flag_recu_tdf') <span ...>Dato requerido</span> @enderror
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