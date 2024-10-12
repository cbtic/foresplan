<input type="hidden" name="tipo_factura" id="tipo_factura" value="" />
<?php 
$total = 0;
$descuento = 0;
$valor_venta_bruto = 0;
$valor_venta = 0;
$igv = 0;
foreach($dudoso as $key=>$row):?>
<tr style="font-size:13px">
	<td class="text-center">
        <div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">
			<?php if($row->flag_estado_cuenta==1){ ?>
            	<!--<input type="checkbox" class="mov_dudoso" value="<?php //echo $row->vsm_smodulo?>" onchange="calcular_dudoso(this)" />-->
				<!--<input type="checkbox" name="mov_dudoso[<?php echo $key?>]" value="<?php //echo $row->id?>" onchange="calcular_dudoso()" />-->
				<input type="hidden" name="detalle_dudoso[<?php echo $key?>][vestab]" value="<?php echo $row->val_estab?>" />
            	<input type="hidden" name="detalle_dudoso[<?php echo $key?>][vcodigo]" value="<?php echo $row->val_codigo?>" />
				<input type="hidden" name="detalle_dudoso[<?php echo $key?>][modulo]" value="<?php echo $row->vsm_modulo?>" />
            	<input type="hidden" name="detalle_dudoso[<?php echo $key?>][smodulo]" value="<?php echo $row->vsm_smodulo?>" />
				<input type="checkbox" name="mov_dudoso[<?php echo $key?>]" value="<?php echo $row->vsm_smodulo?>" onchange="calcular_dudoso()" />
			<?php } ?>
        </div>
    </td>
	<td class="text-left"><?php echo date("d/m/Y", strtotime($row->val_fecha))?></td>
    <td class="text-left"><?php echo $row->smod_control?>
	<?php
		if($row->flag_estado_cuenta==1){
			if($row->smod_tipo_factura=="FT")echo '<span id="badge_empresa" class="badge badge-success">RENTA</span>';
			if($row->smod_tipo_factura=="TK")echo '<span id="badge_empresa" class="badge badge-info">SERVICIOS</span>';
		}else{
			echo '<span id="badge_empresa" class="badge badge-warning">PESAJE</span>';
		}
	?>
	</td>
    <td class="text-right val_total_">
	<?php if($row->descuento<>"" && $row->descuento > 0)echo "<span style='float:left'>% Dscto: &nbsp;</span>";?>
	<span class="val_descuento_dudoso" style="float:left"><?php echo $row->descuento?></span>
	<span class="val_total_dudoso"><?php echo $row->vsm_precio?></span>
	</td>
</tr>
<?php 
	
	if($row->descuento!=""){
		$valor_venta_bruto = $row->vsm_precio/1.18;
		$descuento = ($row->vsm_precio*$row->descuento/100)/1.18;
		$valor_venta = $valor_venta_bruto - $descuento;
		$igv = $valor_venta*0.18;
		$total += $igv + $valor_venta_bruto - $descuento;
	}else{
		$total += $row->vsm_precio;
	}
	
endforeach;
?>

<tr>
	<th colspan="3" style="text-align:right;padding-right:55px!important;padding-bottom:0px;margin-bottom:0px">Deuda Total</th>
	<td style="padding-bottom:0px;margin-bottom:0px">
		<input type="text" readonly name="deudaTotalDudoso" id="deudaTotalDudoso" value="<?php echo $total?>" class="form-control form-control-sm text-right"/>
	</td>
</tr>
