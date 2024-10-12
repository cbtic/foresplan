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
            <input placeholder="fech_oper_ope" type="text" wire:model="fech_oper_ope" id="fech_oper_ope" class="form-control form-control-sm">
            @error('fech_oper_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="id_tipo_operacion" type="number" wire:model="id_tipo_operacion" id="id_tipo_operacion" class="form-control form-control-sm">
            @error('id_tipo_operacion') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="id_persona" type="number" wire:model="id_persona" id="id_persona" class="form-control form-control-sm">
            @error('id_persona') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="tipo_oper_top" type="text" wire:model="tipo_oper_top" id="tipo_oper_top" class="form-control form-control-sm">
            @error('tipo_oper_top') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="fech_inic_ope" type="text" wire:model="fech_inic_ope" id="fech_inic_ope" class="form-control form-control-sm">
            @error('fech_inic_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="fech_fina_ope" type="text" wire:model="fech_fina_ope" id="fech_fina_ope" class="form-control form-control-sm">
            @error('fech_fina_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="nume_dias_ope" type="text" wire:model="nume_dias_ope" id="nume_dias_ope" class="form-control form-control-sm">
            @error('nume_dias_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="nume_reso_ope" type="text" wire:model="nume_reso_ope" id="nume_reso_ope" class="form-control form-control-sm">
            @error('nume_reso_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="nomb_auto_ope" type="text" wire:model="nomb_auto_ope" id="nomb_auto_ope" class="form-control form-control-sm">
            @error('nomb_auto_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="fech_reso_ope" type="text" wire:model="fech_reso_ope" id="fech_reso_ope" class="form-control form-control-sm">
            @error('fech_reso_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="tipo_hora_ope" type="text" wire:model="tipo_hora_ope" id="tipo_hora_ope" class="form-control form-control-sm">
            @error('tipo_hora_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="fech_elab_ope" type="text" wire:model="fech_elab_ope" id="fech_elab_ope" class="form-control form-control-sm">
            @error('fech_elab_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="nume_minut_ope" type="text" wire:model="nume_minut_ope" id="nume_minut_ope" class="form-control form-control-sm">
            @error('nume_minut_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="secu_oper_ope" type="text" wire:model="secu_oper_ope" id="secu_oper_ope" class="form-control form-control-sm">
            @error('secu_oper_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="esta_oper_ope" type="text" wire:model="esta_oper_ope" id="esta_oper_ope" class="form-control form-control-sm">
            @error('esta_oper_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="obse_oper_ope" type="text" wire:model="obse_oper_ope" id="obse_oper_ope" class="form-control form-control-sm">
            @error('obse_oper_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="codi_relo_per" type="text" wire:model="codi_relo_per" id="codi_relo_per" class="form-control form-control-sm">
            @error('codi_relo_per') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="nro_citt_ope" type="text" wire:model="nro_citt_ope" id="nro_citt_ope" class="form-control form-control-sm">
            @error('nro_citt_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="nro_sevit_ope" type="text" wire:model="nro_sevit_ope" id="nro_sevit_ope" class="form-control form-control-sm">
            @error('nro_sevit_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="nro_medi_ope" type="text" wire:model="nro_medi_ope" id="nro_medi_ope" class="form-control form-control-sm">
            @error('nro_medi_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="obse_jefe_ope" type="text" wire:model="obse_jefe_ope" id="obse_jefe_ope" class="form-control form-control-sm">
            @error('obse_jefe_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="obse_rrhh_ope" type="text" wire:model="obse_rrhh_ope" id="obse_rrhh_ope" class="form-control form-control-sm">
            @error('obse_rrhh_ope') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="rowidi" type="text" wire:model="rowidi" id="rowidi" class="form-control form-control-sm">
            @error('rowidi') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="num_archivo" type="text" wire:model="num_archivo" id="num_archivo" class="form-control form-control-sm">
            @error('num_archivo') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="codi_moti_tmo" type="text" wire:model="codi_moti_tmo" id="codi_moti_tmo" class="form-control form-control-sm">
            @error('codi_moti_tmo') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="user_crea" type="text" wire:model="user_crea" id="user_crea" class="form-control form-control-sm">
            @error('user_crea') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="fech_crea" type="text" wire:model="fech_crea" id="fech_crea" class="form-control form-control-sm">
            @error('fech_crea') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="user_modi" type="text" wire:model="user_modi" id="user_modi" class="form-control form-control-sm">
            @error('user_modi') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="fech_modi" type="text" wire:model="fech_modi" id="fech_modi" class="form-control form-control-sm">
            @error('fech_modi') <span ...>Dato requerido</span> @enderror
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