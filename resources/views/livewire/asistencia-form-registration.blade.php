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
            <input placeholder="id_persona" type="number" wire:model="id_persona" id="id_persona" class="form-control form-control-sm">
            @error('id_persona') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="fech_marc_rel" type="text" wire:model="fech_marc_rel" id="fech_marc_rel" class="form-control form-control-sm">
            @error('fech_marc_rel') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="hora_entr_rel" type="text" wire:model="hora_entr_rel" id="hora_entr_rel" class="form-control form-control-sm">
            @error('hora_entr_rel') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="hora_sali_rel" type="text" wire:model="hora_sali_rel" id="hora_sali_rel" class="form-control form-control-sm">
            @error('hora_sali_rel') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="refr_sali_rel" type="text" wire:model="refr_sali_rel" id="refr_sali_rel" class="form-control form-control-sm">
            @error('refr_sali_rel') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="refr_entr_rel" type="text" wire:model="refr_entr_rel" id="refr_entr_rel" class="form-control form-control-sm">
            @error('refr_entr_rel') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="doc_iden_per" type="text" wire:model="doc_iden_per" id="doc_iden_per" class="form-control form-control-sm">
            @error('doc_iden_per') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="nro_doc_rel" type="text" wire:model="nro_doc_rel" id="nro_doc_rel" class="form-control form-control-sm">
            @error('nro_doc_rel') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="fech_regi_eas" type="text" wire:model="fech_regi_eas" id="fech_regi_eas" class="form-control form-control-sm">
            @error('fech_regi_eas') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="tipo_erro_eas" type="text" wire:model="tipo_erro_eas" id="tipo_erro_eas" class="form-control form-control-sm">
            @error('tipo_erro_eas') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="tipo_dias_eas" type="text" wire:model="tipo_dias_eas" id="tipo_dias_eas" class="form-control form-control-sm">
            @error('tipo_dias_eas') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="tipo_marc_eas" type="text" wire:model="tipo_marc_eas" id="tipo_marc_eas" class="form-control form-control-sm">
            @error('tipo_marc_eas') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="hora_marc_eas" type="text" wire:model="hora_marc_eas" id="hora_marc_eas" class="form-control form-control-sm">
            @error('hora_marc_eas') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="minu_tard_eas" type="text" wire:model="minu_tard_eas" id="minu_tard_eas" class="form-control form-control-sm">
            @error('minu_tard_eas') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="minu_apor_eas" type="text" wire:model="minu_apor_eas" id="minu_apor_eas" class="form-control form-control-sm">
            @error('minu_apor_eas') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="minu_tole_eas" type="text" wire:model="minu_tole_eas" id="minu_tole_eas" class="form-control form-control-sm">
            @error('minu_tole_eas') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="minu_dife_eas" type="text" wire:model="minu_dife_eas" id="minu_dife_eas" class="form-control form-control-sm">
            @error('minu_dife_eas') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="flag_marc_eas" type="text" wire:model="flag_marc_eas" id="flag_marc_eas" class="form-control form-control-sm">
            @error('flag_marc_eas') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="nume_bole_eas" type="text" wire:model="nume_bole_eas" id="nume_bole_eas" class="form-control form-control-sm">
            @error('nume_bole_eas') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="flag_bole_eas" type="text" wire:model="flag_bole_eas" id="flag_bole_eas" class="form-control form-control-sm">
            @error('flag_bole_eas') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="id_corr_rel" type="text" wire:model="id_corr_rel" id="id_corr_rel" class="form-control form-control-sm">
            @error('id_corr_rel') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="fech_regi_mar" type="text" wire:model="fech_regi_mar" id="fech_regi_mar" class="form-control form-control-sm">
            @error('fech_regi_mar') <span ...>Dato requerido</span> @enderror
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