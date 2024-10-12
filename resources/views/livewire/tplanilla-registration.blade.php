<div class="row">
    @if (session()->has('message'))
    <div class="alert alert-success col-sm-12">
        {{ session('message') }}
    </div>
    @endif
    <div class=" col">
        <form wire:submit.prevent="submit">
            <input placeholder="Código" type="text" wire:model="tipo_plan_tpl" id="tipo_plan_tpl" class="form-control form-control-sm">
            @error('tipo_plan_tpl') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Descripcion Larga" type="text" wire:model="desc_tipo_tpl" id="desc_tipo_tpl" class="form-control form-control-sm">
        @error('desc_tipo_tpl') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col-sm-2">
        <input placeholder="Tarj Inic" type="text" wire:model="tarj_inic_tpl" id="tarj_inic_tpl" class="form-control form-control-sm">
        @error('tarj_inic_tpl') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Tarj Fin" type="text" wire:model="tarj_fina_tpl" id="tarj_fina_tpl" class="form-control form-control-sm">
        @error('tarj_fina_tpl') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Cantidad" type="number" wire:model="cant_peri_tpl" id="cant_peri_tpl" class="form-control form-control-sm">
        @error('cant_peri_tpl') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Codigo Oper" type="text" wire:model="codi_oper_ope" id="codi_oper_ope" class="form-control form-control-sm">
        @error('codi_oper_ope') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Tipo" type="text" wire:model="tipo_clas_tpl" id="tipo_clas_tpl" class="form-control form-control-sm">
        @error('tipo_clas_tpl') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col-xl-12 p-2"></div>
    <div class="col">
        <input placeholder="Cond Laboral" type="number" wire:model="codi_cond_lab" id="codi_cond_lab" class="form-control form-control-sm">
        @error('codi_cond_lab') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Codigo Anexo" type="text" wire:model="codi_anex_anx" id="codi_anex_anx" class="form-control form-control-sm">
        @error('codi_anex_anx') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Codi Peri" type="text" wire:model="codi_peri_tpe" id="codi_peri_tpe" class="form-control form-control-sm">
        @error('codi_peri_tpe') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Tipo Documento" type="number" wire:model="tipo_docu_tpd" id="tipo_docu_tpd" class="form-control form-control-sm">
        @error('tipo_docu_tpd') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Cate pers" type="text" wire:model="cate_pers_tpl" id="cate_pers_tpl" class="form-control form-control-sm">
        @error('cate_pers_tpl') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Nume dia vac" type="text" wire:model="nume_dia_vac" id="nume_dia_vac" class="form-control form-control-sm">
        @error('nume_dia_vac') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col" style="padding-right: 0px;">
        @if ($updateMode)
        <button wire:click.prevent="update()" class="btn btn-dark btn-sm">Actualizar</button>
        @else
        <button wire:click.prevent="store()" class="btn btn-success btn-sm">Nuevo</button>
        @endif
        <button wire:click.prevent="cancel()" class="btn btn-success btn-sm">Cancelar</button>
        </form>
    </div>
</div>