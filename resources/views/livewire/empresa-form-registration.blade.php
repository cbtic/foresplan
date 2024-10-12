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
            <input placeholder="ruc" type="text" wire:model="ruc" id="ruc" class="form-control form-control-sm">
            @error('ruc') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="nombre_comercial" type="text" wire:model="nombre_comercial" id="nombre_comercial" class="form-control form-control-sm">
            @error('nombre_comercial') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="razon_social" type="text" wire:model="razon_social" id="razon_social" class="form-control form-control-sm">
            @error('razon_social') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="direccion" type="text" wire:model="direccion" id="direccion" class="form-control form-control-sm">
            @error('direccion') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="representante" type="text" wire:model="representante" id="representante" class="form-control form-control-sm">
            @error('representante') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="email" type="text" wire:model="email" id="email" class="form-control form-control-sm">
            @error('email') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="telefono" type="text" wire:model="telefono" id="telefono" class="form-control form-control-sm">
            @error('telefono') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="estado" type="text" wire:model="estado" id="estado" class="form-control form-control-sm">
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