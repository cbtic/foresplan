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
            <input placeholder="codi_banc_tbc" type="text" wire:model="codi_banc_tbc" id="codi_banc_tbc" class="form-control form-control-sm">
            @error('codi_banc_tbc') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="nomb_banc_tbc" type="text" wire:model="nomb_banc_tbc" id="nomb_banc_tbc" class="form-control form-control-sm">
            @error('nomb_banc_tbc') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="nomb_cort_tbc" type="text" wire:model="nomb_cort_tbc" id="nomb_cort_tbc" class="form-control form-control-sm">
            @error('nomb_cort_tbc') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="flag_activ_ban" type="text" wire:model="flag_activ_ban" id="flag_activ_ban" class="form-control form-control-sm">
            @error('flag_activ_ban') <span ...>Dato requerido</span> @enderror
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