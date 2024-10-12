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
            <input placeholder="codi_oper_top" type="text" wire:model="codi_oper_top" id="codi_oper_top" class="form-control form-control-sm">
            @error('codi_oper_top') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="tipo_oper_top" type="text" wire:model="tipo_oper_top" id="tipo_oper_top" class="form-control form-control-sm">
            @error('tipo_oper_top') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="codi_conc_tco" type="text" wire:model="codi_conc_tco" id="codi_conc_tco" class="form-control form-control-sm">
            @error('codi_conc_tco') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="desc_oper_top" type="text" wire:model="desc_oper_top" id="desc_oper_top" class="form-control form-control-sm">
            @error('desc_oper_top') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="cont_dias_top" type="text" wire:model="cont_dias_top" id="cont_dias_top" class="form-control form-control-sm">
            @error('cont_dias_top') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="nume_dias_top" type="text" wire:model="nume_dias_top" id="nume_dias_top" class="form-control form-control-sm">
            @error('nume_dias_top') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="desc_pago_top" type="text" wire:model="desc_pago_top" id="desc_pago_top" class="form-control form-control-sm">
            @error('desc_pago_top') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="veri_reso_top" type="text" wire:model="veri_reso_top" id="veri_reso_top" class="form-control form-control-sm">
            @error('veri_reso_top') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="dcto_cts_top" type="text" wire:model="dcto_cts_top" id="dcto_cts_top" class="form-control form-control-sm">
            @error('dcto_cts_top') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="clas_oper_top" type="text" wire:model="clas_oper_top" id="clas_oper_top" class="form-control form-control-sm">
            @error('clas_oper_top') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="flag_omis_top" type="text" wire:model="flag_omis_top" id="flag_omis_top" class="form-control form-control-sm">
            @error('flag_omis_top') <span ...>Dato requerido</span> @enderror
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