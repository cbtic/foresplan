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
    #for campo in campos
        #if campo.new_type == 'integer'
        <div class="col">
            <input placeholder="$campo.name" type="$campo.form_type" wire:model="$campo.name" id="$campo.name" class="form-control form-control-sm">
            @error('$campo.name') <span ...>Dato requerido</span> @enderror
        </div>
        #end
        #if (campo.new_type.find('string') != -1)
        <div class="col">
            <input placeholder="$campo.name" type="$campo.form_type" wire:model="$campo.name" id="$campo.name" class="form-control form-control-sm">
            @error('$campo.name') <span ...>Dato requerido</span> @enderror
        </div>
        #end
        #if campo.new_type == 'date'
        <div class="col">
            <input placeholder="$campo.name" autocomplete="off" type="text" wire:model="$campo.name" id="$campo.name" class="form-control form-control-sm datepicker" data-provide="datepicker" data-date-autoclose="true" 
            data-date-format="yyyy-mm-dd" data-date-today-highlight="true"                        
            onchange="this.dispatchEvent(new InputEvent('input'))">
            @error('$campo.name') <span ...>Dato requerido</span> @enderror
        </div>
        #end
    #end
    <div class="col" style="padding-right: 0px;">
        @if (${("$")}updateMode)
        <button wire:click.prevent="update()" class="btn btn-dark">Actualizar</button>
        @else
        <button wire:click.prevent="store()" class="btn btn-success">Grabar</button>
        @endif
        <button wire:click.prevent="cancel()" class="btn btn-success">Cancelar</button>
        </form>
    </div>
</div>