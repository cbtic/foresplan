<div class="row">
    @if (session()->has('message'))
    <div class="alert alert-success col-sm-12">
        {{ session('message') }}
    </div>
    @endif

    <div class="col">
        <input placeholder="Direccion" type="text" wire:model="direccion" id="direccion" class="form-control form-control-sm">
        @error('direccion') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Telefono" type="text" wire:model="telefono" id="telefono" class="form-control form-control-sm">
        @error('telefono') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Email" type="text" wire:model="email" id="email" class="form-control form-control-sm">
        @error('email') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="F. Ingreso" type="text" wire:model="fecha_ingreso" id="fecha_ingreso" class="form-control form-control-sm">
        @error('fecha_ingreso') <span ...>Dato requerido</span> @enderror
    </div>        
    <div class="col-xl-12 p-2"></div>

    <div class="col">
        <!--
        <input placeholder="Condicion Laboral" type="text" wire:model="id_condicion_laboral" id="id_condicion_laboral" class="form-control form-control-sm">
-->
        <input placeholder="Condicion Laboral" type="text" wire:model="id_condicion_laboral" id="producto01" name="producto[]" class="form-control form-control-sm">
        <div class="input-group" style="position: absolute;" id="producto01_list"></div>
    
        @error('id_condicion_laboral') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Tipo Planilla" type="text" wire:model="id_tipo_planilla" id="id_tipo_planilla" class="form-control form-control-sm">
        @error('id_tipo_planilla') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Profesion" type="text" wire:model="id_profesion" id="id_profesion" class="form-control form-control-sm">
        @error('id_profesion') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Banco Sueldo" type="text" wire:model="id_banco_sueldo" id="id_banco_sueldo" class="form-control form-control-sm">
        @error('id_banco_sueldo') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col-xl-12 p-2"></div>
    <div class="col">
        <input placeholder="N.Cuenta Sueldo" type="text" wire:model="num_cuenta_sueldo" id="num_cuenta_sueldo" class="form-control form-control-sm">
        @error('num_cuenta_sueldo') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Sueldo" type="text" wire:model="cci_sueldo" id="cci_sueldo" class="form-control form-control-sm">
        @error('cci_sueldo') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Regimen Pensionario" type="text" wire:model="id_regimen_pensionario" id="id_regimen_pensionario" class="form-control form-control-sm">
        @error('id_regimen_pensionario') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="AFP" type="text" wire:model="id_afp" id="id_afp" class="form-control form-control-sm">
        @error('id_afp') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col-xl-12 p-2"></div>
    <div class="col">
        <input placeholder="F. Afiliacion Afp" type="text" wire:model="fecha_afiliacion_afp" id="fecha_afiliacion_afp" class="form-control form-control-sm">
        @error('fecha_afiliacion_afp') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Tipo Comision Afp" type="text" wire:model="id_tipo_comision_afp" id="id_tipo_comision_afp" class="form-control form-control-sm">
        @error('id_tipo_comision_afp') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="cuspp" type="text" wire:model="cuspp" id="cuspp" class="form-control form-control-sm">
        @error('cuspp') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="F Cese" type="text" wire:model="fecha_cese" id="fecha_cese" class="form-control form-control-sm">
        @error('fecha_cese') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col-xl-12 p-2"></div>
    <div class="col">
        <input placeholder="F. Termino Contrato" type="text" wire:model="fecha_termino_contrato" id="fecha_termino_contrato" class="form-control form-control-sm">
        @error('fecha_termino_contrato') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Num. Contrato" type="text" wire:model="num_contrato" id="num_contrato" class="form-control form-control-sm">
        @error('num_contrato') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Cargo" type="text" wire:model="id_cargo" id="id_cargo" class="form-control form-control-sm">
        @error('id_cargo') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Nivel" type="text" wire:model="id_nivel" id="id_nivel" class="form-control form-control-sm">
        @error('id_nivel') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col-xl-12 p-2"></div>
    <div class="col">
        <input placeholder="Banco Cts" type="text" wire:model="id_banco_cts" id="id_banco_cts" class="form-control form-control-sm">
        @error('id_banco_cts') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Num. Cuenta Cts" type="text" wire:model="num_cuenta_cts" id="num_cuenta_cts" class="form-control form-control-sm">
        @error('num_cuenta_cts') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Moneda Cts" type="text" wire:model="id_moneda_cts" id="id_moneda_cts" class="form-control form-control-sm">
        @error('id_moneda_cts') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="estado" type="text" wire:model="estado" id="estado" class="form-control form-control-sm">
        @error('estado') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="id_ubicacion" type="text" wire:model="id_ubicacion" id="id_ubicacion" class="form-control form-control-sm">
        @error('id_ubicacion') <span ...>Dato requerido</span> @enderror
    </div>      
<!--
    ['id_persona', 'direccion', 'ubigeo', 'telefono', 'email', 'foto', 'fecha_ingreso', 'id_condicion_laboral', 'id_tipo_planilla', 
     'id_profesion', 'id_banco_sueldo', 'num_cuenta_sueldo', 'cci_sueldo', 'id_regimen_pensionario', 'id_afp', 'fecha_afiliacion_afp', 
     'id_tipo_comision_afp', 'cuspp', 'fecha_cese', 'fecha_termino_contrato', 'num_contrato', 'id_cargo', 'id_nivel', 'id_banco_cts', 
     'num_cuenta_cts', 'id_moneda_cts', 'estado', 'id_ubicacion'];
-->
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
