<table id="tblCubicaje" class="table table-hover table-sm">
<thead>
	<tr style="font-size:13px">
		<th width="2%">Cantidad</th>
		<th width="10%">Diametro DM(m)</th>
		<th width="10%">Longitud(m)</th>
		<th width="10%">Volumen M3</th>
		<th width="10%">Volumen Pies</th>
		<th width="10%">Volumen Total M3</th>
		<th width="10%">Volumen Total Pies</th>
		<th width="10%">Precio Unitario</th>
		<th width="10%">Precio Total</th>
	</tr>
</thead>
<tbody>
<?php 
if($cubicaje){
$volumen_pies=0;
$volumen_total_m3=0;
$volumen_total_pies=0;
$precio_total=0;
$cantidad_cubicaje=0;

foreach($cubicaje as $row){
	$volumen_pies += $row->volumen_pies;
	$volumen_total_m3 += $row->volumen_total_m3;
	$volumen_total_pies += $row->volumen_total_pies;
	$precio_total += $row->precio_total;
	$cantidad_cubicaje += $row->cantidad;
?>
<tr style="font-size:13px" class="test" data-toggle="tooltip" data-placement="top">
	<td class="text-center"><?php echo $row->cantidad?></td>
	<td class="text-right"><?php echo ($row->diametro_dm!=0)?$row->diametro_dm:""?></td>
	<td class="text-right"><?php echo ($row->longitud==0)?2.44:$row->longitud?></td>
    <td class="text-right"><?php echo ($row->volumen_m3!=0)?$row->volumen_m3:""?></td>
	<td class="text-right"><?php echo ($row->volumen_pies!=0)?$row->volumen_pies:""?></td>
	<td class="text-right"><?php echo ($row->volumen_total_m3!=0)?$row->volumen_total_m3:""?></td>
	<td class="text-right"><?php echo ($row->volumen_total_pies!=0)?$row->volumen_total_pies:""?></td>
	<td class="text-right"><?php echo ($row->precio_unitario!=0)?$row->precio_unitario:""?></td>
	<td class="text-right"><?php echo ($row->precio_total!=0)?$row->precio_total:""?></td>
</tr>
<?php
	}
}
?>
</tbody>
<tfoot>
	<tr>
		<th class="text-center"><?php echo $cantidad_cubicaje?></th>
		<th colspan="3"></th>
		<th class="text-right" style="padding-right:12px"><?php echo $volumen_pies?></th>
		<th class="text-right" style="padding-right:12px"><?php echo $volumen_total_m3?></th>
		<th class="text-right" style="padding-right:12px"><?php echo $volumen_total_pies?></th>
		<th></th>
		<th class="text-right" style="padding-right:12px"><?php echo $precio_total?></th>
	</tr>
</tfoot>
</table>
