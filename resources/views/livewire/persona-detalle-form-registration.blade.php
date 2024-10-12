
<div class="row">
    @if (session()->has('message'))
    <div class="alert alert-success col-sm-12">
        {{ session('message') }}
    </div>
    @endif
	
	<!--<?php echo $nomb ?>-->

    <div class="col" style="display:none">
        <form wire:submit.prevent="submit">
            <input type="hidden" name="oculto">
    </div>
    
        <div class="col">
            <input placeholder="Nombres" type="text" readonly value="<?php echo $nomb ?>"  class="form-control form-control-sm">
        </div>
        <div class="col">
            <input placeholder="Tipo Documento" type="text" readonly value="<?php echo $tDoc ?>"  class="form-control form-control-sm">
        </div>
        <div class="col">
            <input placeholder="Nro. Documento" type="text" readonly value="<?php echo $nDoc ?>"  class="form-control form-control-sm">
        </div>
        <div class="col">
            <input placeholder="Fecha Nacimiento" type="text" readonly value="<?php echo $fNac ?>"  class="form-control form-control-sm">
        </div>
        <div class="col">
            <input placeholder="Género" type="text" readonly value="<?php echo $sexo ?>"  class="form-control form-control-sm">
        </div>                        
        <div class="col-xl-12 p-2"></div>
        <div class="col">
            <input placeholder="direccion" type="text" wire:model="direccion" id="direccion" class="form-control form-control-sm">
            @error('direccion') <span ...>Dato requerido</span> @enderror
        </div>
<!--
        <div class="col">
            <input placeholder="ubigeo" type="text" wire:model="ubigeo" id="ubigeo" class="form-control form-control-sm">
            @error('ubigeo') <span ...>Dato requerido</span> @enderror
        </div>
-->
        <div class="col">
            <input placeholder="telefono" type="text" wire:model="telefono" id="telefono" class="form-control form-control-sm">
            @error('telefono') <span ...>Dato requerido</span> @enderror
        </div>        
        <div class="col">
            <input placeholder="email" type="text" wire:model="email" id="email" class="form-control form-control-sm">
            @error('email') <span ...>Dato requerido</span> @enderror
        </div>
<!--        
        <div class="col">
            <input placeholder="foto" type="text" wire:model="foto" id="foto" class="form-control form-control-sm">
            @error('foto') <span ...>Dato requerido</span> @enderror
        </div>
-->
       
        <div class="col">
            <input placeholder="fecha_ingreso" autocomplete="off" type="text" wire:model="fecha_ingreso" id="fecha_ingreso" class="form-control form-control-sm datepicker" data-provide="datepicker" data-date-autoclose="true" 
            data-date-format="yyyy-mm-dd" data-date-today-highlight="true"                        
            onchange="this.dispatchEvent(new InputEvent('input'))">
            @error('fecha_ingreso') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">												
			<select name="id_condicion_laboral" id="id_condicion_laboral" class="form-control form-control-sm" wire:model="id_condicion_laboral">
				<option value="0">---Seleccione Condición Laboral---</option>
				<?php foreach($lista_condicion as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
				<?php }?>
			</select>			
            @error('id_condicion_laboral') <span ...>Dato requerido</span> @enderror
        </div>        
        <div class="col-xl-12 p-2"></div>
        <div class="col">												
			<select name="id_tipo_planilla" id="id_tipo_planilla" class="form-control form-control-sm" wire:model="id_tipo_planilla">
				<option value="0">---Seleccione Planilla---</option>
				<?php foreach($lista_tplanilla as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
				<?php }?>
			</select>			
            @error('id_tipo_planilla') <span ...>Dato requerido</span> @enderror
        </div> 
        <!--
        <div class="col">
            <input placeholder="id_tipo_planilla" type="number" wire:model="id_tipo_planilla" id="id_tipo_planilla" class="form-control form-control-sm">
            @error('id_tipo_planilla') <span ...>Dato requerido</span> @enderror
        </div>
                -->
        <div class="col">												
			<select name="id_profesion" id="id_profesion" class="form-control form-control-sm" wire:model="id_profesion">
				<option value="0">---Seleccione Profesión---</option>
				<?php foreach($lista_tprofesiones as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
				<?php }?>
			</select>			
            @error('id_profesion') <span ...>Dato requerido</span> @enderror
        </div> 

                <!--
        <div class="col">
            <input placeholder="id_profesion" type="number" wire:model="id_profesion" id="id_profesion" class="form-control form-control-sm">
            @error('id_profesion') <span ...>Dato requerido</span> @enderror
        </div>
                -->
        <div class="col">												
			<select name="id_banco_sueldo" id="id_banco_sueldo" class="form-control form-control-sm" wire:model="id_banco_sueldo">
				<option value="0">---Seleccione Banco Sueldo---</option>
				<?php foreach($lista_tbanco as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
				<?php }?>
			</select>			
            @error('id_banco_sueldo') <span ...>Dato requerido</span> @enderror
        </div> 
                <!--
        <div class="col">
            <input placeholder="id_banco_sueldo" type="number" wire:model="id_banco_sueldo" id="id_banco_sueldo" class="form-control form-control-sm">
            @error('id_banco_sueldo') <span ...>Dato requerido</span> @enderror
        </div> 
                -->      
        <div class="col">
            <input placeholder="num_cuenta_sueldo" type="text" wire:model="num_cuenta_sueldo" id="num_cuenta_sueldo" class="form-control form-control-sm">
            @error('num_cuenta_sueldo') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="cci_sueldo" type="text" wire:model="cci_sueldo" id="cci_sueldo" class="form-control form-control-sm">
            @error('cci_sueldo') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col-xl-12 p-2"></div>
        <div class="col">												
			<select name="id_regimen_pensionario" id="id_regimen_pensionario" class="form-control form-control-sm" wire:model="id_regimen_pensionario">
				<option value="0">---Seleccione Regimen Pensionario---</option>
				<?php foreach($lista_RegimenPensionario as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
				<?php }?>
			</select>			
            @error('id_regimen_pensionario') <span ...>Dato requerido</span> @enderror
        </div>                 
        <!--
        <div class="col">
            <input placeholder="id_regimen_pensionario" type="number" wire:model="id_regimen_pensionario" id="id_regimen_pensionario" class="form-control form-control-sm">
            @error('id_regimen_pensionario') <span ...>Dato requerido</span> @enderror
        </div>
                -->
        <div class="col">												
			<select name="id_afp" id="id_afp" class="form-control form-control-sm" wire:model="id_afp">
				<option value="0">---Seleccione AFP---</option>
				<?php foreach($lista_tafp as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
				<?php }?>
			</select>			
            @error('id_afp') <span ...>Dato requerido</span> @enderror
        </div>                 
<!--
        <div class="col">
            <input placeholder="id_afp" type="number" wire:model="id_afp" id="id_afp" class="form-control form-control-sm">
            @error('id_afp') <span ...>Dato requerido</span> @enderror
        </div>
                -->
        <div class="col">
            <input placeholder="fecha_afiliacion_afp" autocomplete="off" type="text" wire:model="fecha_afiliacion_afp" id="fecha_afiliacion_afp" class="form-control form-control-sm datepicker" data-provide="datepicker" data-date-autoclose="true" 
            data-date-format="yyyy-mm-dd" data-date-today-highlight="true"                        
            onchange="this.dispatchEvent(new InputEvent('input'))">
            @error('fecha_afiliacion_afp') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">												
			<select name="id_tipo_comision_afp" id="id_tipo_comision_afp" class="form-control form-control-sm" wire:model="id_tipo_comision_afp">
				<option value="0">---Seleccione Comisión AFP---</option>
				<?php foreach($lista_comisione as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
				<?php }?>
			</select>			
            @error('id_tipo_comision_afp') <span ...>Dato requerido</span> @enderror
        </div>           
        <!--       
        <div class="col">
            <input placeholder="id_tipo_comision_afp" type="number" wire:model="id_tipo_comision_afp" id="id_tipo_comision_afp" class="form-control form-control-sm">
            @error('id_tipo_comision_afp') <span ...>Dato requerido</span> @enderror
        </div> 
                -->       
        <div class="col">
            <input placeholder="cuspp" type="text" wire:model="cuspp" id="cuspp" class="form-control form-control-sm">
            @error('cuspp') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col-xl-12 p-2"></div>
        <div class="col">
            <input placeholder="fecha_cese" autocomplete="off" type="text" wire:model="fecha_cese" id="fecha_cese" class="form-control form-control-sm datepicker" data-provide="datepicker" data-date-autoclose="true" 
            data-date-format="yyyy-mm-dd" data-date-today-highlight="true"                        
            onchange="this.dispatchEvent(new InputEvent('input'))">
            @error('fecha_cese') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="fecha_termino_contrato" autocomplete="off" type="text" wire:model="fecha_termino_contrato" id="fecha_termino_contrato" class="form-control form-control-sm datepicker" data-provide="datepicker" data-date-autoclose="true" 
            data-date-format="yyyy-mm-dd" data-date-today-highlight="true"                        
            onchange="this.dispatchEvent(new InputEvent('input'))">
            @error('fecha_termino_contrato') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">
            <input placeholder="num_contrato" type="text" wire:model="num_contrato" id="num_contrato" class="form-control form-control-sm">
            @error('num_contrato') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">												
			<select name="id_cargo" id="id_cargo" class="form-control form-control-sm" wire:model="id_cargo">
				<option value="0">---Seleccione Cargo---</option>
				<?php foreach($lista_cargo as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
				<?php }?>
			</select>			
            @error('id_cargo') <span ...>Dato requerido</span> @enderror
        </div> 

        <!--       
        <div class="col">
            <input placeholder="id_cargo" type="number" wire:model="id_cargo" id="id_cargo" class="form-control form-control-sm">
            @error('id_cargo') <span ...>Dato requerido</span> @enderror
        </div>
                -->
        <div class="col">												
			<select name="id_nivel" id="id_nivel" class="form-control form-control-sm" wire:model="id_nivel">
				<option value="0">---Seleccione Nivel Educativo---</option>
				<?php foreach($lista_nivelEducativo as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
				<?php }?>
			</select>			
            @error('id_nivel') <span ...>Dato requerido</span> @enderror
        </div>                 
                <!--
        <div class="col">
            <input placeholder="id_nivel" type="number" wire:model="id_nivel" id="id_nivel" class="form-control form-control-sm">
            @error('id_nivel') <span ...>Dato requerido</span> @enderror
        </div>
                -->
        <div class="col-xl-12 p-2"></div>
        <div class="col">												
			<select name="id_banco_cts" id="id_banco_cts" class="form-control form-control-sm" wire:model="id_banco_cts">
				<option value="0">---Seleccione Banco CTS---</option>
				<?php foreach($lista_tbanco as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
				<?php }?>
			</select>			
            @error('id_banco_cts') <span ...>Dato requerido</span> @enderror
        </div>         
        <!--
        <div class="col">
            <input placeholder="id_banco_cts" type="number" wire:model="id_banco_cts" id="id_banco_cts" class="form-control form-control-sm">
            @error('id_banco_cts') <span ...>Dato requerido</span> @enderror
        </div>
                -->
        <div class="col">
            <input placeholder="num_cuenta_cts" type="text" wire:model="num_cuenta_cts" id="num_cuenta_cts" class="form-control form-control-sm">
            @error('num_cuenta_cts') <span ...>Dato requerido</span> @enderror
        </div> 
        <div class="col">												
			<select name="id_moneda_cts" id="id_moneda_cts" class="form-control form-control-sm" wire:model="id_moneda_cts">
				<option value="0">---Seleccione Moneda CTS---</option>
				<?php foreach($lista_tipoMoneda as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->denominacion?></option>
				<?php }?>
			</select>			
            @error('id_moneda_cts') <span ...>Dato requerido</span> @enderror
        </div>                 
<!--
        <div class="col">
            <input placeholder="id_moneda_cts" type="number" wire:model="id_moneda_cts" id="id_moneda_cts" class="form-control form-control-sm">
            @error('id_moneda_cts') <span ...>Dato requerido</span> @enderror
        </div>        
                -->
        <div class="col">
            <input placeholder="estado" type="text" wire:model="estado" id="estado" class="form-control form-control-sm">
            @error('estado') <span ...>Dato requerido</span> @enderror
        </div>
        <div class="col">												
			<select name="id_ubicacion" id="id_ubicacion" class="form-control form-control-sm" wire:model="id_ubicacion">
				<option value="0">---Seleccione Empresa---</option>
				<?php foreach($lista_empresa as $row){?>
				<option value="<?php echo $row->id?>"><?php echo $row->razon_social?></option>
				<?php }?>
			</select>			
            @error('id_ubicacion') <span ...>Dato requerido</span> @enderror
        </div>            
        <!--
        <div class="col">
            <input placeholder="id_ubicacion" type="number" wire:model="id_ubicacion" id="id_ubicacion" class="form-control form-control-sm">
            @error('id_ubicacion') <span ...>Dato requerido</span> @enderror
        </div>
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


