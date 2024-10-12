<?php 
if($concepto):
foreach($concepto as $row):?>
<tr style="font-size:13px" class="test" data-toggle="tooltip" data-placement="top">
	<td class="text-left"><?php echo $row->id?></td>
	<td class="text-left"><?php echo $row->denominacion?></td>
	<td class="text-left"><?php echo $row->cant_conc_res?></td>
	<td class="text-left"><?php echo $row->cant_conc_rem?></td>
	<td class="text-left">
		<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">
			<button style="font-size:12px" type="button" class="btn btn-sm btn-success" data-toggle="modal" onclick="modalConceptoPersonaResumen(<?php echo $row->id?>,<?php echo $id_planilla?>,<?php echo $id_subplanilla?>,<?php echo $id_persona?>)" ><i class="fa fa-edit"></i> </button>
			<button style="font-size:12px;margin-left:5px" type="button" class="btn btn-sm btn-danger" data-toggle="modal" onclick="eliminarConceptoPersona(<?php echo $row->id?>)" ><i class="fa fa-trash"></i> </button>
			<!--<a href="javascript:void(0)" onclick="eliminarConceptoPersona(<?php //echo $row->id?>)" class="btn btn-sm btn-danger" style="font-size:12px;margin-left:10px">Eliminar</a>-->
		</div>
	</td>
</tr>
<?php
endforeach;
endif;
?>
