<div class="card">
	<div class="card-header">
		<strong>
			Ingresos
		</strong>
	</div>

	<div class="card-body">
		
		<div class="table-responsive overflow-auto" style="max-height: 500px;padding-top:20px">
			<table id="tblIngreso" class="table table-hover table-sm">
				<thead>
					<tr style="font-size:13px">
						<th width="10%">id</th>
						<th width="15%">C&oacute;digo</th>
						<th width="60%">Concepto</th>
						<th width="15%">Valor</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						if($ingreso):
						foreach($ingreso as $row): 
					?>
						<tr style="font-size:13px" class="test" data-toggle="tooltip" data-placement="top">
							<td class="text-left"><?php echo $row->id?></td>
							<td class="text-left"><?php echo $row->codigo?></td>
							<td class="text-left"><?php echo $row->concepto?></td>
							<td class="text-left">
							<?php 
								$valor = "0";
								if($row->cant_conc_res > 0)$valor = $row->cant_conc_res;
								if($row->cant_conc_rem > 0)$valor = $row->cant_conc_rem;
								echo $valor;
							?>
							</td>
							<td class="text-left">
								<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">
								</div>
							</td>
						</tr>
					<?php
						endforeach;
						endif;
					?>
				</tbody>
			</table>
		</div>
	</div>                                    
</div>
<!--
<div class="card">
	<div class="card-header">
		<strong>
			Egresos
		</strong>
	</div>

	<div class="card-body">
		
		<div class="table-responsive overflow-auto" style="max-height: 500px;padding-top:20px">
			<table id="tblEgreso" class="table table-hover table-sm">
				<thead>
					<tr style="font-size:13px">
						<th width="10%">id</th>
						<th width="15%">C&oacute;digo</th>
						<th width="60%">Concepto</th>
						<th width="15%">Valor</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>                                        
		
	</div>                                    
</div>
			-->
<div class="card">
	<div class="card-header">
		<strong>
			Asistencia
		</strong>
	</div>

	<div class="card-body">
		
		<div class="table-responsive overflow-auto" style="max-height: 500px;padding-top:20px">
			<table id="tblAportaciones" class="table table-hover table-sm">
				<thead>
					<tr style="font-size:13px">
						<th width="10%">id</th>
						<th width="15%">C&oacute;digo</th>
						<th width="60%">Concepto</th>
						<th width="15%">Valor</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						if($asistencia):
						foreach($asistencia as $row): 
					?>
						<tr style="font-size:13px" class="test" data-toggle="tooltip" data-placement="top">
							<td class="text-left"><?php echo $row->id?></td>
							<td class="text-left"><?php echo $row->codigo?></td>
							<td class="text-left"><?php echo $row->concepto?></td>
							<td class="text-left">
							<?php 
								$valor = "0";
								if($row->cant_conc_res > 0)$valor = $row->cant_conc_res;
								if($row->cant_conc_rem > 0)$valor = $row->cant_conc_rem;
								echo $valor;
							?>
							</td>
							<td class="text-left">
								<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">
								</div>
							</td>
						</tr>
					<?php
						endforeach;
						endif;
					?>
				</tbody>
			</table>
		</div>                                        
		
	</div>                                    
</div>





