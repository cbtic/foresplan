
<?php 
if($metas_persona):
foreach($metas_persona as $row):?>
<tr style="font-size:13px" class="test">
	<td class="text-left"><input type="checkbox" class="mov" checked="checked" name="personas[]" value="<?php echo $row->id_persona?>" /></td>
	<td class="text-left"><?php echo $row->tipo_documento?></td>
	<td class="text-left"><?php echo $row->numero_documento?></td>
	<td class="text-left"><?php echo $row->persona?></td>
    <td class="text-left"><?php echo $row->area_trabajo?></td>
	<td class="text-left"><?php echo $row->unidad_trabajo?></td>
</tr>
<?php
endforeach;
endif;
?>

