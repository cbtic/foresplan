<div class="row">
    @if (session()->has('message'))
    <div class="alert alert-success col-sm-12">
        {{ session('message') }}
    </div>
    @endif
    <div class="col" style="display: none;">
        <form wire:submit.prevent="submit">
            <input type="hidden" name="oculto">
    </div>
        <div class="col">
            <input placeholder="codi_empl_per" type="text" wire:model="codi_empl_per" id="codi_empl_per" class="form-control form-control-sm">
            @error('codi_empl_per') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="ano_peri_vac" type="text" wire:model="ano_peri_vac" id="ano_peri_vac" class="form-control form-control-sm">
            @error('ano_peri_vac') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="nume_peri_vac" type="text" wire:model="nume_peri_vac" id="nume_peri_vac" class="form-control form-control-sm">
            @error('nume_peri_vac') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="fech_inic_vac" type="text" wire:model="fech_inic_vac" id="fech_inic_vac" class="form-control form-control-sm">
            @error('fech_inic_vac') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="fech_fina_vac" type="text" wire:model="fech_fina_vac" id="fech_fina_vac" class="form-control form-control-sm">
            @error('fech_fina_vac') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="id_corr" type="text" wire:model="id_corr" id="id_corr" class="form-control form-control-sm">
            @error('id_corr') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="id_corrant" type="text" wire:model="id_corrant" id="id_corrant" class="form-control form-control-sm">
            @error('id_corrant') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="fg_estado" type="text" wire:model="fg_estado" id="fg_estado" class="form-control form-control-sm">
            @error('fg_estado') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="fech_registro" type="text" wire:model="fech_registro" id="fech_registro" class="form-control form-control-sm">
            @error('fech_registro') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="secu_oper_ope" type="text" wire:model="secu_oper_ope" id="secu_oper_ope" class="form-control form-control-sm">
            @error('secu_oper_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="nume_reso_ope" type="text" wire:model="nume_reso_ope" id="nume_reso_ope" class="form-control form-control-sm">
            @error('nume_reso_ope') <span ...>Dato requerido</span> @enderror
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