<div class="row">
    @if (session()->has('message'))
    <div class="alert alert-success col-sm-12">
        {{ session('message') }}
    </div>
    @endif
    <div class="col">
        <select name="tipo_documento" class="form-control form-control-sm" wire:model="tipo_documento" id="tipo_documento">
            <option value="">Seleccionar</option>
            <option value="DNI" {{ $tipo_documento == 'DNI' ? 'selected="selected"' : '' }}>DNI</option>
            <option value="CARNET_EXTRANJERIA" {{ $tipo_documento == 'CARNET_EXTRANJERIA' ? 'selected="selected"' : '' }}>CARNET EXTRANJERIA</option>
            <option value="PASAPORTE" {{ $tipo_documento == 'PASAPORTE' ? 'selected="selected"' : '' }}>PASAPORTE</option>
            <option value="CEDULA" {{ $tipo_documento == 'CEDULA' ? 'selected="selected"' : '' }}>CEDULA</option>
            <option value="PTP/PTEP" {{ $tipo_documento == 'PTP/PTEP' ? 'selected="selected"' : '' }}>PTP/PTEP</option>
        </select>
        @error('tipo_documento') <span ...>Dato requerido</span> @enderror
    </div>

    <div class="col">
        <input placeholder="DNI" type="text" wire:model="numero_documento" id="numero_documento" class="form-control form-control-sm">
        @error('numero_documento') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col-sm-2">
        <input placeholder="A Paterno" type="text" wire:model="apellido_paterno" id="apellido_paterno" class="form-control form-control-sm">
        @error('apellido_paterno') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="A Materno" type="text" wire:model="apellido_materno" id="apellido_materno" class="form-control form-control-sm">
        @error('apellido_materno') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <input placeholder="Nombres" type="text" wire:model="nombres" id="nombres" class="form-control form-control-sm">
        @error('nombres') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col-xl-12 p-2"></div>
    <div class="col-xl-2">
        <input placeholder="F Nacimiento" autocomplete="off" type="text" wire:model="fecha_nacimiento" id="fecha_nacimiento" class="form-control form-control-sm datepicker" data-provide="datepicker" data-date-autoclose="true" 
        data-date-format="yyyy-mm-dd" data-date-today-highlight="true"                        
        onchange="this.dispatchEvent(new InputEvent('input'))">
        @error('fecha_nacimiento') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <select name="sexo" class="form-control form-control-sm" wire:model="sexo" id="sexo">
            <option value="">Seleccionar</option>
            <option value="M" {{ $sexo == 'M' ? 'selected="selected"' : '' }}>Masculino</option>
            <option value="F" {{ $sexo == 'F' ? 'selected="selected"' : '' }}>Femenino</option>
        </select>
        @error('Sexo') <span ...>Dato requerido</span> @enderror
    </div>
    <div class="col">
        <select name="estado" class="form-control form-control-sm" wire:model="estado" id="estado">
            <option value="">Seleccionar</option>
            <option value="A" {{ $estado == 'A' ? 'selected="selected"' : '' }}>Activo</option>
            <option value="I" {{ $estado == 'I' ? 'selected="selected"' : '' }}>Inactivo</option>
        </select>
        @error('estado') <span ...>Dato requerido</span> @enderror
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