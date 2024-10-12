<?php 
//print_r($cronogramaDetalle);
//$total = 0;
if($ubicacion):
foreach($ubicacion as $row):?>
<tr style="font-size:13px" class="test" data-toggle="tooltip" data-placement="top">
	<td class="text-left"><?php echo $row->id?></td>
	<td class="text-left"><?php echo $row->denominacion?></td>
</tr>
<?php
	//$total += $row->cuota_pagar;
endforeach;
endif;
?>
<!--
</tbody>
<tfoot>
<tr>
	<th colspan="3" style="text-align:right;padding-right:55px!important;padding-bottom:0px;margin-bottom:0px">Pago Total</th>
	<td colspan="2" style="padding-bottom:0px;margin-bottom:0px">
		<input type="text" readonly name="pagoTotal" id="pagoTotal" value="<?php //echo $total?>" class="form-control form-control-sm text-right"/>
	</td>
	<td colspan="2" style="padding-bottom:0px;margin-bottom:0px">&nbsp;
		
	</td>
</tr>
</tfoot>
-->