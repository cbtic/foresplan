
<?php 
if($metas_persona):
foreach($metas_persona as $row):?>
<tr style="font-size:13px" class="test" onclick="cargarConceptoPersona(<?php echo $id_periodo?>,<?php echo $row->id_persona?>,this);" >
	<td class="text-left"><?php echo $row->tipo_documento?></td>
	<td class="text-left"><?php echo $row->numero_documento?></td>
	<td class="text-left"><?php echo $row->persona?></td>
    <td class="text-left"><?php echo $row->area_trabajo?></td>
	<td class="text-left"><?php echo $row->unidad_trabajo?></td>
	<td class="text-left">
		<div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">
			<button style="font-size:12px;margin-left:5px" type="button" class="btn btn-sm btn-danger" data-toggle="modal" onclick="eliminarMetaPersona(<?php echo $row->id?>)" ><i class="fa fa-trash"></i> </button>
		</div>
	</td>
</tr>
<?php
endforeach;
endif;
?>

