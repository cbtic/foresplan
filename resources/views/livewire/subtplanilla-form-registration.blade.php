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
            <input placeholder="tipo_plan_tpl" type="text" wire:model="tipo_plan_tpl" id="tipo_plan_tpl" class="form-control form-control-sm">
            @error('tipo_plan_tpl') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="subt_plan_stp" type="text" wire:model="subt_plan_stp" id="subt_plan_stp" class="form-control form-control-sm">
            @error('subt_plan_stp') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="desc_subt_stp" type="text" wire:model="desc_subt_stp" id="desc_subt_stp" class="form-control form-control-sm">
            @error('desc_subt_stp') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="titu_subt_stp" type="text" wire:model="titu_subt_stp" id="titu_subt_stp" class="form-control form-control-sm">
            @error('titu_subt_stp') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="tipo_docu_tpd" type="text" wire:model="tipo_docu_tpd" id="tipo_docu_tpd" class="form-control form-control-sm">
            @error('tipo_docu_tpd') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="tipo_mcpp_stp" type="text" wire:model="tipo_mcpp_stp" id="tipo_mcpp_stp" class="form-control form-control-sm">
            @error('tipo_mcpp_stp') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="clase_mcpp_stp" type="text" wire:model="clase_mcpp_stp" id="clase_mcpp_stp" class="form-control form-control-sm">
            @error('clase_mcpp_stp') <span ...>Dato requerido</span> @enderror
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