<input type="hidden" name="tipo_factura" id="tipo_factura" value="" />
<?php 
$total = 0;
$descuento = 0;
$valor_venta_bruto = 0;
$valor_venta = 0;
$igv = 0;
foreach($valorizacion as $key=>$row):?>
<tr style="font-size:13px">
	<td class="text-center">
        <div class="btn-group btn-group-sm" role="group" aria-label="Log Viewer Actions">
            <!--<input type="checkbox" name="mov[<?php echo $key?>]" value="<?php echo $row->val_codigo?>" onchange="calcular_total()" />-->
			
			<?php if($row->flag_estado_cuenta==1){ ?>
            <input type="hidden" name="factura_detalle[<?php echo $key?>][vestab]" value="<?php echo $row->val_estab?>" />
            <input type="hidden" name="factura_detalle[<?php echo $key?>][vcodigo]" value="<?php echo $row->val_codigo?>" />			
            <input type="hidden" name="factura_detalle[<?php echo $key?>][modulo]" value="<?php echo $row->vsm_modulo?>" />
            <input type="hidden" name="factura_detalle[<?php echo $key?>][denominacion]" value="<?php echo $row->smod_control//$row->vsm_smodulod?>" />
            <input type="checkbox" class="mov" name="factura_detalles[<?php echo $key?>][smodulo]" value="<?php echo $row->vsm_smodulo?>" onchange="calcular_total(this)" />
            <input type="hidden" name="factura_detalle[<?php echo $key?>][smodulo]" value="<?php echo $row->vsm_smodulo?>" />

            <input type="hidden" name="factura_detalle[<?php echo $key?>][cantidad]" value="1" />            
            <input type="hidden" name="factura_detalle[<?php echo $key?>][precio_venta]" value="<?php echo $row->precio_venta?>" />
            <input type="hidden" name="factura_detalle[<?php echo $key?>][valor_unitario]" value="<?php echo $row->valor_unitario?>" />
            <input type="hidden" name="factura_detalle[<?php echo $key?>][valor_venta_bruto]" value="<?php echo $row->valor_venta_bruto?>" />
            <input type="hidden" name="factura_detalle[<?php echo $key?>][valor_venta]" value="<?php echo $row->valor_venta?>" />            
            <input type="hidden" name="factura_detalle[<?php echo $key?>][igv]" value="<?php echo $row->igv?>" />
            <input type="hidden" name="factura_detalle[<?php echo $key?>][total]" value="<?php echo $row->total?>" />
            <input type="hidden" name="factura_detalle[<?php echo $key?>][descuento_item]" value="<?php echo $row->descuento_item?>" />
            <input type="hidden" name="factura_detalle[<?php echo $key?>][descuento]" value="<?php echo $row->descuento?>" />

            <input type="hidden" name="factura_detalle[<?php echo $key?>][plancontable]" value="<?php echo $row->plancontable?>" />
			
			<!--<input type="hidden" name="val_total[<?php echo $key?>]" value="<?php echo $row->vsm_costo_plan?>" />
			<input type="hidden" name="vsm_smodulod[<?php echo $key?>]" value="<?php echo $row->vsm_smodulod?>" />-->
			
			<?php } ?>
        </div>
    </td>
	<td class="text-left"><?php echo date("d/m/Y", strtotime($row->val_fecha))?></td>
    <!--<td class="text-left"><?php echo $row->vsm_smodulo?></td>-->
    <td class="text-left"><?php echo $row->smod_control//$row->vsm_smodulod?>
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
	<span class="val_descuento" style="float:left"><?php echo $row->descuento?></span>
	<span class="val_total"><?php echo $row->vsm_precio?></span>
	<input type="hidden" class="tipo_factura" value="<?php echo $row->smod_tipo_factura?>" />
	</td>
    <!--<td class="text-left">Pagado</td>-->
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
		<input type="text" readonly name="deudaTotal" id="deudaTotal" value="<?php echo $total?>" class="form-control form-control-sm text-right"/>
	</td>
</tr>
