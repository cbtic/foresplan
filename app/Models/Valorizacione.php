<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Valorizacione extends Model
{
    //

    function getValorizacion($tipo_documento,$persona_id){
        if($tipo_documento=="RUC"){
            $cad = "
			select R.*,
            round(cast(vsm_precio/1.18 as numeric),2) valor_unitario,
            round(cast(vsm_precio*1/1.18 as numeric),2) valor_venta_bruto,
            round(cast((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) valor_venta,
            round(cast(((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18 as numeric),2) igv,
            round(cast((((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18)+(vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) total,
            round(cast((((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) descuento_item
            from(
			select
            t1.val_estab, t1.val_codigo,t3.vsm_modulo,
			t3.vsm_smodulo,t1.val_fecha,t1.val_pac_nombre,t1.val_subtotal,t1.val_subtotal_plan,t1.val_total,
			t1.val_moneda,t2.vm_modulod,t2.vm_descripcion,t2.vm_precio,t3.vsm_smodulo,t3.vsm_smodulod,t3.vsm_precio,
			vsm_costo_plan,t4.smod_plancontable plancontable,
            t1.val_impuesto,
            t3.vsm_precio precio_venta,
            case when (select count(*) from valorizaciones t11
				inner join val_atencion_modulos t22 on t1.val_estab = t22.vm_vestab And t11.val_codigo = t22.vm_vnumero
				inner join val_atencion_smodulos t33 on t22.vm_vestab = t33.vsm_vestab And t22.vm_vnumero = t33.vsm_vnumero And t22.vm_modulo = t33.vsm_modulo
			where t11.val_estab_i = t1.val_estab_i and t11.val_codigo_i = t1.val_codigo_i and t33.vsm_modulo = t3.vsm_modulo and t33.vsm_smodulo = t3.vsm_smodulo) > 1 then null else t4.smod_descuento end descuento,
			COALESCE(plan_tipo_factura,smod_tipo_factura)smod_tipo_factura,smod_control,
			(case when t3.vsm_modulo=2 And t3.vsm_smodulo in (1,2,6,11,19,20) Then 0 else 1 end)flag_estado_cuenta
            from valorizaciones t1
            inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
            inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
            inner join sub_modulos t4 on t3.vsm_modulo = t4.smod_modulo And t3.vsm_smodulo = t4.smod_codigo
			left join plan_atenciones t5 on t1.val_plan = t5.id
            Where t1.val_estab=1
            And t1.val_ubicacion=".$persona_id."
            And val_tipo='E'
            /*And t1.val_estado_atencion='A' */
            And t1.val_anulado='N'
            /*And t1.val_facturado='N'*/
			And t3.vsm_facturado='N'
            And t2.vm_estado='A' And t2.vm_eliminado='N'
            And t3.vsm_estado='A' And t3.vsm_eliminado='N'
			And t3.vsm_precio > 0
			--And t3.vsm_smodulo!=23
			And t3.vsm_modulo::varchar||t3.vsm_smodulo::varchar!='223' 
			order by t1.val_fecha desc
			)R
			";
        }else{
            $cad = "
            select R.*,
            round(cast(vsm_precio/1.18 as numeric),2) valor_unitario,
            round(cast(vsm_precio*1/1.18 as numeric),2) valor_venta_bruto,
            round(cast((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) valor_venta,
            round(cast(((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18 as numeric),2) igv,
            round(cast((((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18)+(vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) total,
            round(cast((((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) descuento_item
            from(
            select
            t1.val_estab, t1.val_codigo,t3.vsm_modulo,
            t3.vsm_smodulo,t1.val_fecha,t1.val_pac_nombre,t1.val_subtotal,t1.val_subtotal_plan,t1.val_total,
            t1.val_moneda,t2.vm_modulod,t2.vm_descripcion,t2.vm_precio,t3.vsm_smodulo,t3.vsm_smodulod,t3.vsm_precio,
            t3.vsm_costo_plan, t4.smod_plancontable plancontable,
            t1.val_impuesto,
            t3.vsm_precio precio_venta,
            case when (select count(*) from valorizaciones t11
				inner join val_atencion_modulos t22 on t1.val_estab = t22.vm_vestab And t11.val_codigo = t22.vm_vnumero
				inner join val_atencion_smodulos t33 on t22.vm_vestab = t33.vsm_vestab And t22.vm_vnumero = t33.vsm_vnumero And t22.vm_modulo = t33.vsm_modulo
			where t11.val_estab_i = t1.val_estab_i and t11.val_codigo_i = t1.val_codigo_i and t33.vsm_modulo = t3.vsm_modulo and t33.vsm_smodulo = t3.vsm_smodulo) > 1 then null else t4.smod_descuento end descuento,
            COALESCE(plan_tipo_factura,smod_tipo_factura) smod_tipo_factura,smod_control,
			(case when t3.vsm_modulo=2 And t3.vsm_smodulo in (1,2,6,11,19,20) Then 0 else 1 end)flag_estado_cuenta
            from valorizaciones t1
            inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
            inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
            inner join sub_modulos t4 on t3.vsm_modulo = t4.smod_modulo And t3.vsm_smodulo = t4.smod_codigo
			left join plan_atenciones t5 on t1.val_plan = t5.id
            Where t1.val_estab=1
            And t1.val_persona=".$persona_id."
            And val_tipo='P'
            /*And t1.val_estado_atencion='A' */
            And t1.val_anulado='N'
            /*And t1.val_facturado='N'*/
			And t3.vsm_facturado='N'
            And t2.vm_estado='A' And t2.vm_eliminado='N'
            And t3.vsm_estado='A' And t3.vsm_eliminado='N'
			And t3.vsm_precio > 0 
			--And t3.vsm_smodulo!=23 
			And t3.vsm_modulo::varchar||t3.vsm_smodulo::varchar!='223'
            order by t1.val_fecha desc
            )R
			";
        }

        //echo $cad;
		$data = DB::select($cad);
        return $data;
    }
	
	function getDudoso($tipo_documento,$persona_id){
        if($tipo_documento=="RUC"){
            $cad = "
			select R.*,
            round(cast(vsm_precio/1.18 as numeric),2) valor_unitario,
            round(cast(vsm_precio*1/1.18 as numeric),2) valor_venta_bruto,
            round(cast((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) valor_venta,
            round(cast(((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18 as numeric),2) igv,
            round(cast((((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18)+(vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) total,
            round(cast((((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) descuento_item
            from(
			select
            t1.val_estab, t1.val_codigo,t3.vsm_modulo,
			t3.vsm_smodulo,t1.val_fecha,t1.val_pac_nombre,t1.val_subtotal,t1.val_subtotal_plan,t1.val_total,
			t1.val_moneda,t2.vm_modulod,t2.vm_descripcion,t2.vm_precio,t3.vsm_smodulo,t3.vsm_smodulod,t3.vsm_precio,
			vsm_costo_plan,t4.smod_plancontable plancontable,
            t1.val_impuesto,
            t3.vsm_precio precio_venta,
            case when (select count(*) from valorizaciones t11
				inner join val_atencion_modulos t22 on t1.val_estab = t22.vm_vestab And t11.val_codigo = t22.vm_vnumero
				inner join val_atencion_smodulos t33 on t22.vm_vestab = t33.vsm_vestab And t22.vm_vnumero = t33.vsm_vnumero And t22.vm_modulo = t33.vsm_modulo
			where t11.val_estab_i = t1.val_estab_i and t11.val_codigo_i = t1.val_codigo_i and t33.vsm_modulo = t3.vsm_modulo and t33.vsm_smodulo = t3.vsm_smodulo) > 1 then null else t4.smod_descuento end descuento,
			COALESCE(plan_tipo_factura,smod_tipo_factura)smod_tipo_factura,smod_control,
			(case when t3.vsm_modulo=2 And t3.vsm_smodulo in (1,2,6,11,19,20) Then 0 else 1 end)flag_estado_cuenta
            from valorizaciones t1
            inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
            inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
            inner join sub_modulos t4 on t3.vsm_modulo = t4.smod_modulo And t3.vsm_smodulo = t4.smod_codigo
			left join plan_atenciones t5 on t1.val_plan = t5.id
            Where t1.val_estab=1
            And t1.val_ubicacion=".$persona_id."
            And val_tipo='E'
            /*And t1.val_estado_atencion='A' */
            And t1.val_anulado='N'
            /*And t1.val_facturado='N'*/
			And t3.vsm_facturado='N'
            And t2.vm_estado='A' And t2.vm_eliminado='N'
            And t3.vsm_estado='D' And t3.vsm_eliminado='N'
			And t3.vsm_precio > 0
			--And t3.vsm_smodulo!=23
			And t3.vsm_modulo::varchar||t3.vsm_smodulo::varchar!='223' 
			order by t1.val_fecha desc
			)R
			";
        }else{
            $cad = "
            select R.*,
            round(cast(vsm_precio/1.18 as numeric),2) valor_unitario,
            round(cast(vsm_precio*1/1.18 as numeric),2) valor_venta_bruto,
            round(cast((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) valor_venta,
            round(cast(((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18 as numeric),2) igv,
            round(cast((((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18)+(vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) total,
            round(cast((((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) descuento_item
            from(
            select
            t1.val_estab, t1.val_codigo,t3.vsm_modulo,
            t3.vsm_smodulo,t1.val_fecha,t1.val_pac_nombre,t1.val_subtotal,t1.val_subtotal_plan,t1.val_total,
            t1.val_moneda,t2.vm_modulod,t2.vm_descripcion,t2.vm_precio,t3.vsm_smodulo,t3.vsm_smodulod,t3.vsm_precio,
            t3.vsm_costo_plan, t4.smod_plancontable plancontable,
            t1.val_impuesto,
            t3.vsm_precio precio_venta,
            case when (select count(*) from valorizaciones t11
				inner join val_atencion_modulos t22 on t1.val_estab = t22.vm_vestab And t11.val_codigo = t22.vm_vnumero
				inner join val_atencion_smodulos t33 on t22.vm_vestab = t33.vsm_vestab And t22.vm_vnumero = t33.vsm_vnumero And t22.vm_modulo = t33.vsm_modulo
			where t11.val_estab_i = t1.val_estab_i and t11.val_codigo_i = t1.val_codigo_i and t33.vsm_modulo = t3.vsm_modulo and t33.vsm_smodulo = t3.vsm_smodulo) > 1 then null else t4.smod_descuento end descuento,
            COALESCE(plan_tipo_factura,smod_tipo_factura) smod_tipo_factura,smod_control,
			(case when t3.vsm_modulo=2 And t3.vsm_smodulo in (1,2,6,11,19,20) Then 0 else 1 end)flag_estado_cuenta
            from valorizaciones t1
            inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
            inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
            inner join sub_modulos t4 on t3.vsm_modulo = t4.smod_modulo And t3.vsm_smodulo = t4.smod_codigo
			left join plan_atenciones t5 on t1.val_plan = t5.id
            Where t1.val_estab=1
            And t1.val_persona=".$persona_id."
            And val_tipo='P' 
            /*And t1.val_estado_atencion='A' */
            And t1.val_anulado='N'
            /*And t1.val_facturado='N'*/
			And t3.vsm_facturado='N'
            And t2.vm_estado='A' And t2.vm_eliminado='N'
            And t3.vsm_estado='D' And t3.vsm_eliminado='N'
			And t3.vsm_precio > 0 
			--And t3.vsm_smodulo!=23
			And t3.vsm_modulo::varchar||t3.vsm_smodulo::varchar!='223' 
            order by t1.val_fecha desc
            )R
			";
        }

        //echo $cad;
		$data = DB::select($cad);
        return $data;
    }
	
	function getValorizacionEstacionamiento($tipo_documento,$persona_id){
        if($tipo_documento=="RUC"){
            $cad = "
			select R.*,
            round(cast(vsm_precio/1.18 as numeric),2) valor_unitario,
            round(cast(vsm_precio*1/1.18 as numeric),2) valor_venta_bruto,
            round(cast((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) valor_venta,
            round(cast(((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18 as numeric),2) igv,
            round(cast((((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18)+(vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) total,
            round(cast((((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) descuento_item
            from(
			select
            t1.val_estab, t1.val_codigo,t3.vsm_modulo,
			t3.vsm_smodulo,t1.val_fecha,t1.val_pac_nombre,t1.val_subtotal,t1.val_subtotal_plan,t1.val_total,
			t1.val_moneda,t2.vm_modulod,t2.vm_descripcion,t2.vm_precio,t3.vsm_smodulo,t3.vsm_smodulod,t3.vsm_precio,
			vsm_costo_plan,t4.smod_plancontable plancontable,
            t1.val_impuesto,
            t3.vsm_precio precio_venta,
            case when (select count(*) from valorizaciones t11
				inner join val_atencion_modulos t22 on t1.val_estab = t22.vm_vestab And t11.val_codigo = t22.vm_vnumero
				inner join val_atencion_smodulos t33 on t22.vm_vestab = t33.vsm_vestab And t22.vm_vnumero = t33.vsm_vnumero And t22.vm_modulo = t33.vsm_modulo
			where t11.val_estab_i = t1.val_estab_i and t11.val_codigo_i = t1.val_codigo_i and t33.vsm_modulo = t3.vsm_modulo and t33.vsm_smodulo = t3.vsm_smodulo) > 1 then null else t4.smod_descuento end descuento,
			COALESCE(plan_tipo_factura,smod_tipo_factura)smod_tipo_factura,smod_control,
			(case when t3.vsm_modulo=2 And t3.vsm_smodulo in (1,2,6,11,19,20) Then 0 else 1 end)flag_estado_cuenta
            from valorizaciones t1
            inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
            inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
            inner join sub_modulos t4 on t3.vsm_modulo = t4.smod_modulo And t3.vsm_smodulo = t4.smod_codigo
			left join plan_atenciones t5 on t1.val_plan = t5.id
            Where t1.val_estab=1
            And t1.val_ubicacion=".$persona_id."
            And val_tipo='E'
            /*And t1.val_estado_atencion='A' */
            And t1.val_anulado='N'
            /*And t1.val_facturado='N'*/
			And t3.vsm_facturado='N'
            And t2.vm_estado='A' And t2.vm_eliminado='N'
            And t3.vsm_estado='A' And t3.vsm_eliminado='N'
			And t3.vsm_precio > 0
			--And t3.vsm_smodulo=23
			And t3.vsm_modulo::varchar||t3.vsm_smodulo::varchar='223' 
			order by t1.val_fecha desc
			)R
			";
        }else{
            $cad = "
            select R.*,
            round(cast(vsm_precio/1.18 as numeric),2) valor_unitario,
            round(cast(vsm_precio*1/1.18 as numeric),2) valor_venta_bruto,
            round(cast((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) valor_venta,
            round(cast(((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18 as numeric),2) igv,
            round(cast((((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18)+(vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) total,
            round(cast((((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) descuento_item
            from(
            select
            t1.val_estab, t1.val_codigo,t3.vsm_modulo,
            t3.vsm_smodulo,t1.val_fecha,t1.val_pac_nombre,t1.val_subtotal,t1.val_subtotal_plan,t1.val_total,
            t1.val_moneda,t2.vm_modulod,t2.vm_descripcion,t2.vm_precio,t3.vsm_smodulo,t3.vsm_smodulod,t3.vsm_precio,
            t3.vsm_costo_plan, t4.smod_plancontable plancontable,
            t1.val_impuesto,
            t3.vsm_precio precio_venta,
            case when (select count(*) from valorizaciones t11
				inner join val_atencion_modulos t22 on t1.val_estab = t22.vm_vestab And t11.val_codigo = t22.vm_vnumero
				inner join val_atencion_smodulos t33 on t22.vm_vestab = t33.vsm_vestab And t22.vm_vnumero = t33.vsm_vnumero And t22.vm_modulo = t33.vsm_modulo
			where t11.val_estab_i = t1.val_estab_i and t11.val_codigo_i = t1.val_codigo_i and t33.vsm_modulo = t3.vsm_modulo and t33.vsm_smodulo = t3.vsm_smodulo) > 1 then null else t4.smod_descuento end descuento,
            COALESCE(plan_tipo_factura,smod_tipo_factura) smod_tipo_factura,smod_control,
			(case when t3.vsm_modulo=2 And t3.vsm_smodulo in (1,2,6,11,19,20) Then 0 else 1 end)flag_estado_cuenta
            from valorizaciones t1
            inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
            inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
            inner join sub_modulos t4 on t3.vsm_modulo = t4.smod_modulo And t3.vsm_smodulo = t4.smod_codigo
			left join plan_atenciones t5 on t1.val_plan = t5.id
            Where t1.val_estab=1
            And t1.val_persona=".$persona_id."
            And val_tipo='P'
            /*And t1.val_estado_atencion='A' */
            And t1.val_anulado='N'
            /*And t1.val_facturado='N'*/
			And t3.vsm_facturado='N'
            And t2.vm_estado='A' And t2.vm_eliminado='N'
            And t3.vsm_estado='A' And t3.vsm_eliminado='N'
			And t3.vsm_precio > 0 
			--And t3.vsm_smodulo=23 
			And t3.vsm_modulo::varchar||t3.vsm_smodulo::varchar='223'
            order by t1.val_fecha desc
            )R
			";
        }

        //echo $cad;
		$data = DB::select($cad);
        return $data;
    }
	
	function getValorizacionAlmacen($tipo_documento,$persona_id){
        if($tipo_documento=="RUC"){
            $cad = "
			select R.*,
            round(cast(vsm_precio/1.18 as numeric),2) valor_unitario,
            round(cast(vsm_precio*1/1.18 as numeric),2) valor_venta_bruto,
            round(cast((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) valor_venta,
            round(cast(((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18 as numeric),2) igv,
            round(cast((((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18)+(vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) total,
            round(cast((((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) descuento_item
            from(
			select
            t1.val_estab, t1.val_codigo,t3.vsm_modulo,
			t3.vsm_smodulo,t1.val_fecha,t1.val_pac_nombre,t1.val_subtotal,t1.val_subtotal_plan,t1.val_total,
			t1.val_moneda,t2.vm_modulod,t2.vm_descripcion,t2.vm_precio,t3.vsm_smodulo,t3.vsm_smodulod,t3.vsm_precio,
			vsm_costo_plan,t4.smod_plancontable plancontable,
            t1.val_impuesto,
            t3.vsm_precio precio_venta,
            case when (select count(*) from valorizaciones t11
				inner join val_atencion_modulos t22 on t1.val_estab = t22.vm_vestab And t11.val_codigo = t22.vm_vnumero
				inner join val_atencion_smodulos t33 on t22.vm_vestab = t33.vsm_vestab And t22.vm_vnumero = t33.vsm_vnumero And t22.vm_modulo = t33.vsm_modulo
			where t11.val_estab_i = t1.val_estab_i and t11.val_codigo_i = t1.val_codigo_i and t33.vsm_modulo = t3.vsm_modulo and t33.vsm_smodulo = t3.vsm_smodulo) > 1 then null else t4.smod_descuento end descuento,
			COALESCE(plan_tipo_factura,smod_tipo_factura)smod_tipo_factura,smod_control,
			(case when t3.vsm_modulo=2 And t3.vsm_smodulo in (1,2,6,11,19,20) Then 0 else 1 end)flag_estado_cuenta
            from valorizaciones t1
            inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
            inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
            inner join sub_modulos t4 on t3.vsm_modulo = t4.smod_modulo And t3.vsm_smodulo = t4.smod_codigo
			left join plan_atenciones t5 on t1.val_plan = t5.id
            Where t1.val_estab=1
            And t1.val_ubicacion=".$persona_id."
            And val_tipo='E'
            /*And t1.val_estado_atencion='A' */
            And t1.val_anulado='N'
            /*And t1.val_facturado='N'*/
			And t3.vsm_facturado='N'
            And t2.vm_estado='A' And t2.vm_eliminado='N'
            And t3.vsm_estado='A' And t3.vsm_eliminado='N'
			And t3.vsm_precio > 0
			--And t3.vsm_smodulo in(21,22,23)
			And t3.vsm_modulo::varchar||t3.vsm_smodulo::varchar in('121','122','123')
			order by t1.val_fecha desc
			)R
			";
        }else{
            $cad = "
            select R.*,
            round(cast(vsm_precio/1.18 as numeric),2) valor_unitario,
            round(cast(vsm_precio*1/1.18 as numeric),2) valor_venta_bruto,
            round(cast((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) valor_venta,
            round(cast(((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18 as numeric),2) igv,
            round(cast((((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18)+(vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) total,
            round(cast((((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) descuento_item
            from(
            select
            t1.val_estab, t1.val_codigo,t3.vsm_modulo,
            t3.vsm_smodulo,t1.val_fecha,t1.val_pac_nombre,t1.val_subtotal,t1.val_subtotal_plan,t1.val_total,
            t1.val_moneda,t2.vm_modulod,t2.vm_descripcion,t2.vm_precio,t3.vsm_smodulo,t3.vsm_smodulod,t3.vsm_precio,
            t3.vsm_costo_plan, t4.smod_plancontable plancontable,
            t1.val_impuesto,
            t3.vsm_precio precio_venta,
            case when (select count(*) from valorizaciones t11
				inner join val_atencion_modulos t22 on t1.val_estab = t22.vm_vestab And t11.val_codigo = t22.vm_vnumero
				inner join val_atencion_smodulos t33 on t22.vm_vestab = t33.vsm_vestab And t22.vm_vnumero = t33.vsm_vnumero And t22.vm_modulo = t33.vsm_modulo
			where t11.val_estab_i = t1.val_estab_i and t11.val_codigo_i = t1.val_codigo_i and t33.vsm_modulo = t3.vsm_modulo and t33.vsm_smodulo = t3.vsm_smodulo) > 1 then null else t4.smod_descuento end descuento,
            COALESCE(plan_tipo_factura,smod_tipo_factura) smod_tipo_factura,smod_control,
			(case when t3.vsm_modulo=2 And t3.vsm_smodulo in (1,2,6,11,19,20) Then 0 else 1 end)flag_estado_cuenta
            from valorizaciones t1
            inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
            inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
            inner join sub_modulos t4 on t3.vsm_modulo = t4.smod_modulo And t3.vsm_smodulo = t4.smod_codigo
			left join plan_atenciones t5 on t1.val_plan = t5.id
            Where t1.val_estab=1
            And t1.val_persona=".$persona_id."
            And val_tipo='P'
            /*And t1.val_estado_atencion='A' */
            And t1.val_anulado='N'
            /*And t1.val_facturado='N'*/
			And t3.vsm_facturado='N'
            And t2.vm_estado='A' And t2.vm_eliminado='N'
            And t3.vsm_estado='A' And t3.vsm_eliminado='N'
			And t3.vsm_precio > 0 
			--And t3.vsm_smodulo in(21,22,23)
			And t3.vsm_modulo::varchar||t3.vsm_smodulo::varchar in('121','122','123')
            order by t1.val_fecha desc
            )R
			";
        }

        //echo $cad;
		$data = DB::select($cad);
        return $data;
    }
	
    function getPago($tipo_documento,$persona_id){

        if($tipo_documento=="RUC"){
           /*
            $cad = "select
            t1.val_codigo,t1.val_estab,t3.vsm_smodulo,t1.val_fecha,t1.val_pac_nombre,t1.val_subtotal,t1.val_total,t1.val_moneda,t2.vm_modulod,t2.vm_descripcion,t2.vm_precio,t3.vsm_smodulo,t3.vsm_smodulod,t3.vsm_precio
			,t4.fac_total,t1.val_fac_serie,t1.val_fac_numero
            from valorizaciones t1
            inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
            inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
			inner join facturas t4 on t1.val_fac_serie=t4.fac_serie And t1.val_fac_numero=t4.fac_numero
            Where t1.val_estab=1
            And t1.val_ubicacion=".$persona_id."
            And val_tipo='E'
            And t1.val_anulado='N'
            And t1.val_facturado='S'
            And t2.vm_estado='A' And t2.vm_eliminado='N'
            And t3.vsm_estado='A' And t3.vsm_eliminado='N'";
            */
			/*
            $cad = "select  distinct t4.id id_factura,t4.fac_tipo,t4.fac_fecha,t4.fac_serie,t4.fac_numero,t4.fac_total,
			(select string_agg(DISTINCT coalesce(smod_control,facd_descripcion), ',') from factura_detalles fac left join sub_modulos sm on fac.facd_descripcion=sm.smod_denominacion where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie) fact_descripcion,
			COALESCE(plan_tipo_factura,(select string_agg(DISTINCT smod_tipo_factura, ',') from factura_detalles fac left join sub_modulos sm on (fac.facd_descripcion=sm.smod_control or fac.facd_descripcion=sm.smod_denominacion) where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie)) smod_tipo_factura
            from valorizaciones t1
			inner join facturas t4 on t1.val_fac_serie=t4.fac_serie And t1.val_fac_numero=t4.fac_numero
			left join plan_atenciones t5 on t1.val_plan = t5.id
            Where t1.val_estab=1
            And t1.val_ubicacion=".$persona_id."
            And val_tipo='E'
	        And t4.fac_anulado='N'
            And t1.val_facturado='S'
            order by t4.fac_fecha desc";
			*/
			$cad = "select  distinct t4.id id_factura,t4.fac_tipo,t4.fac_fecha,t4.fac_serie,t4.fac_numero,t4.fac_total,
			(select string_agg(DISTINCT coalesce(smod_control,facd_descripcion), ',') from factura_detalles fac left join sub_modulos sm on fac.facd_descripcion=sm.smod_denominacion where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie) fact_descripcion,
			COALESCE(plan_tipo_factura,(select string_agg(DISTINCT smod_tipo_factura, ',') from factura_detalles fac left join sub_modulos sm on (fac.facd_descripcion=sm.smod_control or fac.facd_descripcion=sm.smod_denominacion) where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie)) smod_tipo_factura,
			first_name||' '||last_name as usuario_registro 
            from valorizaciones t1
			inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
			inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
			inner join sub_modulos t6 on t3.vsm_modulo = t6.smod_modulo And t3.vsm_smodulo = t6.smod_codigo
			inner join facturas t4 on t3.vsm_fac_tipo=t4.fac_tipo And t3.vsm_fac_serie=t4.fac_serie And t3.vsm_fac_numero=t4.fac_numero
			left join plan_atenciones t5 on t1.val_plan = t5.id 
			left join users t7 on t4.id_usuario = t7.id 
            Where t1.val_estab=1
            And t1.val_ubicacion=".$persona_id."
            And val_tipo='E'
	        And t4.fac_anulado='N'
            And t3.vsm_facturado='S'
			--And t3.vsm_smodulo!=23 
			And t3.vsm_modulo::varchar||t3.vsm_smodulo::varchar!='223'
            order by t4.fac_fecha desc";
        }else{

			$cad = "select distinct t4.id id_factura,t4.fac_tipo,t4.fac_fecha,t4.fac_serie,t4.fac_numero,t4.fac_total,
			(select string_agg(DISTINCT coalesce(smod_control,facd_descripcion), ',') from factura_detalles fac left join sub_modulos sm on fac.facd_descripcion=sm.smod_denominacion where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie) fact_descripcion,
			COALESCE(plan_tipo_factura,(select string_agg(DISTINCT smod_tipo_factura, ',') from factura_detalles fac left join sub_modulos sm on (fac.facd_descripcion=sm.smod_control or fac.facd_descripcion=sm.smod_denominacion) where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie)) smod_tipo_factura, 
			first_name||' '||last_name as usuario_registro 
			from valorizaciones t1
			inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
			inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
			inner join sub_modulos t6 on t3.vsm_modulo = t6.smod_modulo And t3.vsm_smodulo = t6.smod_codigo
			inner join facturas t4 on t3.vsm_fac_tipo=t4.fac_tipo And t3.vsm_fac_serie=t4.fac_serie And t3.vsm_fac_numero=t4.fac_numero
			left join plan_atenciones t5 on t1.val_plan = t5.id 
			left join users t7 on t4.id_usuario = t7.id 
			Where t1.val_estab=1
			And t1.val_persona=".$persona_id."
			And val_tipo='P'
			And t4.fac_anulado='N'
			And t3.vsm_facturado='S'
			order by t4.fac_fecha desc";
			/*
            $cad = "select  distinct t4.id id_factura,t4.fac_tipo,t4.fac_fecha,t4.fac_serie,t4.fac_numero,t4.fac_total,
			(select string_agg(DISTINCT coalesce(smod_control,facd_descripcion), ',') from factura_detalles fac left join sub_modulos sm on fac.facd_descripcion=sm.smod_denominacion where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie) fact_descripcion,
			COALESCE(plan_tipo_factura,(select string_agg(DISTINCT smod_tipo_factura, ',') from factura_detalles fac left join sub_modulos sm on (fac.facd_descripcion=sm.smod_control or fac.facd_descripcion=sm.smod_denominacion) where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie)
) smod_tipo_factura
            from valorizaciones t1
			inner join facturas t4 on t1.val_fac_serie=t4.fac_serie And t1.val_fac_numero=t4.fac_numero
			left join plan_atenciones t5 on t1.val_plan = t5.id
            Where t1.val_estab=1
            And t1.val_persona=".$persona_id."
            And val_tipo='P'
	        And t4.fac_anulado='N'
            And t1.val_facturado='S'
            order by t4.fac_fecha desc";
			*/
            /*
            $cad = "select
            t1.val_codigo,t1.val_estab,
            t3.vsm_smodulo,t1.val_fecha,t1.val_pac_nombre,t1.val_subtotal,t1.val_total,t1.val_moneda,t2.vm_modulod,t2.vm_descripcion,t2.vm_precio,t3.vsm_smodulo,t3.vsm_smodulod,
            (case when val_plan>0 then vsm_costo_plan else t3.vsm_precio end)vsm_precio
			,t4.fac_total,t1.val_fac_serie,t1.val_fac_numero
            from valorizaciones t1
            inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
            inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
			inner join facturas t4 on t1.val_fac_serie=t4.fac_serie And t1.val_fac_numero=t4.fac_numero
            Where t1.val_estab=1
            And t1.val_persona=".$persona_id."
            And val_tipo='P'
            And t1.val_anulado='N'
            And t1.val_facturado='S'
            And t2.vm_estado='A' And t2.vm_eliminado='N'
            And t3.vsm_estado='A' And t3.vsm_eliminado='N'";
            */
        }
        //echo $cad;
		$data = DB::select($cad);
        return $data;
    }
	
	function getPagoEstacionamiento($tipo_documento,$persona_id){

        if($tipo_documento=="RUC"){
           /*
            $cad = "select
            t1.val_codigo,t1.val_estab,t3.vsm_smodulo,t1.val_fecha,t1.val_pac_nombre,t1.val_subtotal,t1.val_total,t1.val_moneda,t2.vm_modulod,t2.vm_descripcion,t2.vm_precio,t3.vsm_smodulo,t3.vsm_smodulod,t3.vsm_precio
			,t4.fac_total,t1.val_fac_serie,t1.val_fac_numero
            from valorizaciones t1
            inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
            inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
			inner join facturas t4 on t1.val_fac_serie=t4.fac_serie And t1.val_fac_numero=t4.fac_numero
            Where t1.val_estab=1
            And t1.val_ubicacion=".$persona_id."
            And val_tipo='E'
            And t1.val_anulado='N'
            And t1.val_facturado='S'
            And t2.vm_estado='A' And t2.vm_eliminado='N'
            And t3.vsm_estado='A' And t3.vsm_eliminado='N'";
            */
			/*
            $cad = "select  distinct t4.id id_factura,t4.fac_tipo,t4.fac_fecha,t4.fac_serie,t4.fac_numero,t4.fac_total,
			(select string_agg(DISTINCT coalesce(smod_control,facd_descripcion), ',') from factura_detalles fac left join sub_modulos sm on fac.facd_descripcion=sm.smod_denominacion where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie) fact_descripcion,
			COALESCE(plan_tipo_factura,(select string_agg(DISTINCT smod_tipo_factura, ',') from factura_detalles fac left join sub_modulos sm on (fac.facd_descripcion=sm.smod_control or fac.facd_descripcion=sm.smod_denominacion) where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie)) smod_tipo_factura
            from valorizaciones t1
			inner join facturas t4 on t1.val_fac_serie=t4.fac_serie And t1.val_fac_numero=t4.fac_numero
			left join plan_atenciones t5 on t1.val_plan = t5.id
            Where t1.val_estab=1
            And t1.val_ubicacion=".$persona_id."
            And val_tipo='E'
	        And t4.fac_anulado='N'
            And t1.val_facturado='S'
            order by t4.fac_fecha desc";
			*/
			$cad = "select  distinct t4.id id_factura,t4.fac_tipo,t4.fac_fecha,t4.fac_serie,t4.fac_numero,t4.fac_total,
			(select string_agg(DISTINCT coalesce(smod_control,facd_descripcion), ',') from factura_detalles fac left join sub_modulos sm on fac.facd_descripcion=sm.smod_denominacion where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie) fact_descripcion,
			COALESCE(plan_tipo_factura,(select string_agg(DISTINCT smod_tipo_factura, ',') from factura_detalles fac left join sub_modulos sm on (fac.facd_descripcion=sm.smod_control or fac.facd_descripcion=sm.smod_denominacion) where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie)) smod_tipo_factura,
			first_name||' '||last_name as usuario_registro 
            from valorizaciones t1
			inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
			inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
			inner join sub_modulos t6 on t3.vsm_modulo = t6.smod_modulo And t3.vsm_smodulo = t6.smod_codigo
			inner join facturas t4 on t3.vsm_fac_tipo=t4.fac_tipo And t3.vsm_fac_serie=t4.fac_serie And t3.vsm_fac_numero=t4.fac_numero
			left join plan_atenciones t5 on t1.val_plan = t5.id 
			left join users t7 on t4.id_usuario = t7.id 
            Where t1.val_estab=1
            And t1.val_ubicacion=".$persona_id."
            And val_tipo='E'
	        And t4.fac_anulado='N'
            And t3.vsm_facturado='S'
			--And t3.vsm_smodulo=23
			And t3.vsm_modulo::varchar||t3.vsm_smodulo::varchar='223' 
            order by t4.fac_fecha desc";
        }else{

			$cad = "select distinct t4.id id_factura,t4.fac_tipo,t4.fac_fecha,t4.fac_serie,t4.fac_numero,t4.fac_total,
			(select string_agg(DISTINCT coalesce(smod_control,facd_descripcion), ',') from factura_detalles fac left join sub_modulos sm on fac.facd_descripcion=sm.smod_denominacion where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie) fact_descripcion,
			COALESCE(plan_tipo_factura,(select string_agg(DISTINCT smod_tipo_factura, ',') from factura_detalles fac left join sub_modulos sm on (fac.facd_descripcion=sm.smod_control or fac.facd_descripcion=sm.smod_denominacion) where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie)) smod_tipo_factura, 
			first_name||' '||last_name as usuario_registro 
			from valorizaciones t1
			inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
			inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
			inner join sub_modulos t6 on t3.vsm_modulo = t6.smod_modulo And t3.vsm_smodulo = t6.smod_codigo
			inner join facturas t4 on t3.vsm_fac_tipo=t4.fac_tipo And t3.vsm_fac_serie=t4.fac_serie And t3.vsm_fac_numero=t4.fac_numero
			left join plan_atenciones t5 on t1.val_plan = t5.id 
			left join users t7 on t4.id_usuario = t7.id 
			Where t1.val_estab=1
			And t1.val_persona=".$persona_id."
			And val_tipo='P'
			And t4.fac_anulado='N'
			And t3.vsm_facturado='S'
			order by t4.fac_fecha desc";
			/*
            $cad = "select  distinct t4.id id_factura,t4.fac_tipo,t4.fac_fecha,t4.fac_serie,t4.fac_numero,t4.fac_total,
			(select string_agg(DISTINCT coalesce(smod_control,facd_descripcion), ',') from factura_detalles fac left join sub_modulos sm on fac.facd_descripcion=sm.smod_denominacion where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie) fact_descripcion,
			COALESCE(plan_tipo_factura,(select string_agg(DISTINCT smod_tipo_factura, ',') from factura_detalles fac left join sub_modulos sm on (fac.facd_descripcion=sm.smod_control or fac.facd_descripcion=sm.smod_denominacion) where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie)
) smod_tipo_factura
            from valorizaciones t1
			inner join facturas t4 on t1.val_fac_serie=t4.fac_serie And t1.val_fac_numero=t4.fac_numero
			left join plan_atenciones t5 on t1.val_plan = t5.id
            Where t1.val_estab=1
            And t1.val_persona=".$persona_id."
            And val_tipo='P'
	        And t4.fac_anulado='N'
            And t1.val_facturado='S'
            order by t4.fac_fecha desc";
			*/
            /*
            $cad = "select
            t1.val_codigo,t1.val_estab,
            t3.vsm_smodulo,t1.val_fecha,t1.val_pac_nombre,t1.val_subtotal,t1.val_total,t1.val_moneda,t2.vm_modulod,t2.vm_descripcion,t2.vm_precio,t3.vsm_smodulo,t3.vsm_smodulod,
            (case when val_plan>0 then vsm_costo_plan else t3.vsm_precio end)vsm_precio
			,t4.fac_total,t1.val_fac_serie,t1.val_fac_numero
            from valorizaciones t1
            inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
            inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
			inner join facturas t4 on t1.val_fac_serie=t4.fac_serie And t1.val_fac_numero=t4.fac_numero
            Where t1.val_estab=1
            And t1.val_persona=".$persona_id."
            And val_tipo='P'
            And t1.val_anulado='N'
            And t1.val_facturado='S'
            And t2.vm_estado='A' And t2.vm_eliminado='N'
            And t3.vsm_estado='A' And t3.vsm_eliminado='N'";
            */
        }
        //echo $cad;
		$data = DB::select($cad);
        return $data;
    }
	
	function getPagoAlmacen($tipo_documento,$persona_id){

        if($tipo_documento=="RUC"){
           
			$cad = "select  distinct t4.id id_factura,t4.fac_tipo,t4.fac_fecha,t4.fac_serie,t4.fac_numero,t4.fac_total,
			(select string_agg(DISTINCT coalesce(smod_control,facd_descripcion), ',') from factura_detalles fac left join sub_modulos sm on fac.facd_descripcion=sm.smod_denominacion where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie) fact_descripcion,
			COALESCE(plan_tipo_factura,(select string_agg(DISTINCT smod_tipo_factura, ',') from factura_detalles fac left join sub_modulos sm on (fac.facd_descripcion=sm.smod_control or fac.facd_descripcion=sm.smod_denominacion) where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie)) smod_tipo_factura,
			first_name||' '||last_name as usuario_registro 
            from valorizaciones t1
			inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
			inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
			inner join sub_modulos t6 on t3.vsm_modulo = t6.smod_modulo And t3.vsm_smodulo = t6.smod_codigo
			inner join facturas t4 on t3.vsm_fac_tipo=t4.fac_tipo And t3.vsm_fac_serie=t4.fac_serie And t3.vsm_fac_numero=t4.fac_numero
			left join plan_atenciones t5 on t1.val_plan = t5.id 
			left join users t7 on t4.id_usuario = t7.id 
            Where t1.val_estab=1
            And t1.val_ubicacion=".$persona_id."
            And val_tipo='E'
	        And t4.fac_anulado='N'
            And t3.vsm_facturado='S'
			--And t3.vsm_smodulo in(21,22,23) 
			And t3.vsm_modulo::varchar||t3.vsm_smodulo::varchar in('121','122','123')
            order by t4.fac_fecha desc";
        }else{

			$cad = "select distinct t4.id id_factura,t4.fac_tipo,t4.fac_fecha,t4.fac_serie,t4.fac_numero,t4.fac_total,
			(select string_agg(DISTINCT coalesce(smod_control,facd_descripcion), ',') from factura_detalles fac left join sub_modulos sm on fac.facd_descripcion=sm.smod_denominacion where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie) fact_descripcion,
			COALESCE(plan_tipo_factura,(select string_agg(DISTINCT smod_tipo_factura, ',') from factura_detalles fac left join sub_modulos sm on (fac.facd_descripcion=sm.smod_control or fac.facd_descripcion=sm.smod_denominacion) where fac.facd_tipo=t4.fac_tipo And fac.facd_numero=t4.fac_numero And fac.facd_serie=t4.fac_serie)) smod_tipo_factura, 
			first_name||' '||last_name as usuario_registro 
			from valorizaciones t1
			inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
			inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
			inner join sub_modulos t6 on t3.vsm_modulo = t6.smod_modulo And t3.vsm_smodulo = t6.smod_codigo
			inner join facturas t4 on t3.vsm_fac_tipo=t4.fac_tipo And t3.vsm_fac_serie=t4.fac_serie And t3.vsm_fac_numero=t4.fac_numero
			left join plan_atenciones t5 on t1.val_plan = t5.id 
			left join users t7 on t4.id_usuario = t7.id 
			Where t1.val_estab=1
			And t1.val_persona=".$persona_id."
			And val_tipo='P'
			And t4.fac_anulado='N'
			And t3.vsm_facturado='S'
			--And t3.vsm_smodulo in(21,22,23)
			And t3.vsm_modulo::varchar||t3.vsm_smodulo::varchar in('121','122','123')
			order by t4.fac_fecha desc";
			
        }
        //echo $cad;
		$data = DB::select($cad);
        return $data;
    }
	
	function getValorizacionFactura($id_factura){

        $cad = "select R.*,
round(cast(vsm_precio/1.18 as numeric),2) valor_unitario,
round(cast(vsm_precio*1/1.18 as numeric),2) valor_venta_bruto,
round(cast((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) valor_venta,
round(cast(((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18 as numeric),2) igv,
round(cast((((vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18))*0.18)+(vsm_precio*1/1.18)-(((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) total,
round(cast((((COALESCE(descuento,0)*vsm_precio)/100)/1.18) as numeric),2) descuento_item
from(
select
t1.val_estab, t1.val_codigo,t3.vsm_modulo,
t3.vsm_smodulo,t1.val_fecha,t1.val_pac_nombre,t1.val_subtotal,t1.val_subtotal_plan,t1.val_total,
t1.val_moneda,t2.vm_modulod,t2.vm_descripcion,t2.vm_precio,t3.vsm_smodulo,t3.vsm_smodulod,t3.vsm_precio,
t3.vsm_costo_plan, t4.smod_plancontable plancontable,
t1.val_impuesto,
t3.vsm_precio precio_venta,
case when (select count(*) from valorizaciones t11
	inner join val_atencion_modulos t22 on t1.val_estab = t22.vm_vestab And t11.val_codigo = t22.vm_vnumero
	inner join val_atencion_smodulos t33 on t22.vm_vestab = t33.vsm_vestab And t22.vm_vnumero = t33.vsm_vnumero And t22.vm_modulo = t33.vsm_modulo
where t11.val_estab_i = t1.val_estab_i and t11.val_codigo_i = t1.val_codigo_i and t33.vsm_modulo = t3.vsm_modulo and t33.vsm_smodulo = t3.vsm_smodulo) > 1 then null else t4.smod_descuento end descuento,
COALESCE(plan_tipo_factura,smod_tipo_factura) smod_tipo_factura,
smod_control,
(case when t3.vsm_modulo=2 And t3.vsm_smodulo in (1,2,6,11,19,20) Then 0 else 1 end)flag_estado_cuenta
from valorizaciones t1
inner join val_atencion_modulos t2 on t1.val_estab = t2.vm_vestab And t1.val_codigo = t2.vm_vnumero
inner join val_atencion_smodulos t3 on t2.vm_vestab = t3.vsm_vestab And t2.vm_vnumero = t3.vsm_vnumero And t2.vm_modulo = t3.vsm_modulo
inner join sub_modulos t4 on t3.vsm_modulo = t4.smod_modulo And t3.vsm_smodulo = t4.smod_codigo
inner join facturas t5 on t3.vsm_fac_tipo=t5.fac_tipo And t3.vsm_fac_serie=t5.fac_serie And t3.vsm_fac_numero=t5.fac_numero
left join plan_atenciones t6 on t1.val_plan = t6.id
Where t1.val_estab=1
And t5.id=".$id_factura."
And val_tipo='P'
And t1.val_anulado='N'
And t3.vsm_facturado='S'
And t2.vm_estado='A' And t2.vm_eliminado='N'
And t3.vsm_estado='A' And t3.vsm_eliminado='N'
And t3.vsm_precio > 0
order by t1.val_fecha desc
)R";

		$data = DB::select($cad);
        return $data;
    }
	
    public function registrar_factura($serie,$numero,$tipo,$ubicacion,$persona,$total,$descripcion,$cod_contable,$codigo_v,$estab_v,$accion) {

        $cad = "Select sp_crud_factura(?,?,?,?,?,?,?,?,?,?)";
        echo "Select sp_crud_factura(".$serie.",".$numero.",".$tipo.",".$ubicacion.",".$persona.",".$total.",".$descripcion.",".$cod_contable.",".$codigo_v.",".$estab_v.",".$accion.")";
		$data = DB::select($cad, array($serie,$numero,$tipo,$ubicacion,$persona,$total,$descripcion,$cod_contable,$codigo_v,$estab_v,$accion));
        return $data[0]->sp_crud_factura;
    }

    public function registrar_caja_ingreso($datos) {

        $cad = "Select sp_crud_caja_ingreso(?,?,?,?,?,?,?,?)";
        //echo "Select sp_crud_caja_ingreso(".$datos[0].",".$datos[1].",".$datos[2].",".$datos[3].",".$datos[4].",".$datos[5].",".$datos[6].",".$datos[7].")";
		$data = DB::select($cad, array($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5],$datos[6],$datos[7]));
        return $data[0]->sp_crud_caja_ingreso;
    }
	
	public function registrar_caja_ingreso_moneda($datos) {

        //$cad = "Select sp_crud_caja_ingreso(?,?,?,?,?,?,?,?)";
		$cad = "Select sp_crud_caja_ingreso_moneda(?,?,?,?,?,?,?,?,?,?,?,?,?)";
        //echo "Select sp_crud_caja_ingreso(".$datos[0].",".$datos[1].",".$datos[2].",".$datos[3].",".$datos[4].",".$datos[5].",".$datos[6].",".$datos[7].",".$datos[8].",".$datos[9].",".$datos[10].",".$datos[11].",".$datos[12].")";
		$data = DB::select($cad, array($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5],$datos[6],$datos[7],$datos[8],$datos[9],$datos[10],$datos[11],$datos[12]));
        return $data[0]->sp_crud_caja_ingreso_moneda;
    }

    public function registrar_estado_cuenta_automatico($datos) {

        $cad = "Select sp_crud_automatico_new(?)";
		$data = DB::select($cad, array($datos[0]));
        return $data[0]->sp_crud_automatico_new;
    }
	
	public function renovar_ingreso_estacionamiento(/*$datos*/) {

        $cad = "Select sp_crud_renovar_ingreso_estacionamiento()";
		$data = DB::select($cad/*, array($datos[0])*/);
        return $data[0]->sp_crud_renovar_ingreso_estacionamiento;
    }

	public function registrar_estado_cuenta_automatico_exclusivo($datos) {

        $cad = "Select sp_crud_automatico_exclusivo(?)";
		$data = DB::select($cad, array($datos[0]));
        return $data[0]->sp_crud_automatico_exclusivo;
    }
	
    function getCajaIngresoByusuario($id_usuario,$tipo){

        $cad = "select t1.id,t1.id_caja,t1.saldo_inicial,
		(select coalesce(Sum(total),0) from comprobantes where id_caja = t1.id_caja And fecha >= fecha_inicio And fecha <= (case when fecha_fin is null then now() else fecha_fin end))total_recaudado,
	    ((select coalesce(Sum(total),0) from comprobantes where id_caja=t1.id_caja And fecha >= fecha_inicio And fecha <= (case when fecha_fin is null then now() else fecha_fin end)) + t1.saldo_inicial)saldo_total,
		t1.estado,t2.denominacion caja,t3.name usuario		
		from caja_ingresos t1
        inner join tabla_maestras t2 on t1.id_caja=t2.codigo::int
		inner join users t3 on t1.id_usuario = t3.id
        where t1.id_usuario= ".$id_usuario."
		And t2.tipo= '".$tipo."'
		and t1.estado='1'
		order by 1 desc
        limit 1";

		//echo $cad;
		$data = DB::select($cad);
        if($data)return $data[0];
    }

	function getLiquidacionAll(){

        $cad = "select
        t1.id,t1.id_caja,t4.first_name||' '||t4.last_name usuario,t1.saldo_inicial,
        (case when t1.estado='0' then total_recaudado else
(select coalesce(Sum(fac_total),0) from facturas where fac_caja_id=t1.id_caja And fac_fecha >= fecha_inicio And fac_fecha <= (case when fecha_fin is null then now() else fecha_fin end))
end)total_recaudado,
(case when t1.estado='0' then saldo_total else
((select coalesce(Sum(fac_total),0) from facturas where fac_caja_id=t1.id_caja And fac_fecha >= fecha_inicio And fac_fecha <= (case when fecha_fin is null then now() else fecha_fin end)) + t1.saldo_inicial)
end)saldo_total,
        t1.estado,t2.denominacion caja,t2.tipo,t1.fecha_inicio,t1.fecha_fin
        ,saldo_liquidado,observacion,t4.first_name||' '||t4.last_name usuario_contabilidad
        from caja_ingresos t1
        inner join tabla_maestras t2 on t1.id_caja=t2.id
        inner join users t3 on t1.id_usuario=t3.id
        inner join users t4 on t1.id_usuario=t4.id
        order by t1.id desc";
        //echo $cad;
		$data = DB::select($cad);
        return $data;
    }

	public function listar_estado_cuenta_ajax($p){
		return $this->readFunctionPostgres('sp_listar_estado_cuenta_paginado',$p);
    }

	public function listar_liquidacion_caja_ajax($p){
		return $this->readFunctionPostgres('sp_listar_liquidacion_caja_paginado',$p);
    }
	
	public function listar_pago_ingreso_estacionamiento_ajax($p){
		return $this->readFunctionPostgres('sp_listar_pago_ingreso_estacionamiento_paginado',$p);
    }
	
	public function readFunctionPostgres($function, $parameters = null){

      $_parameters = '';
      if (count($parameters) > 0) {
          $_parameters = implode("','", $parameters);
          $_parameters = "'" . $_parameters . "',";
      }
	  DB::select("BEGIN;");
	  $cad = "select " . $function . "(" . $_parameters . "'ref_cursor');";
	  DB::select($cad);
	  $cad = "FETCH ALL IN ref_cursor;";
	  $data = DB::select($cad);
	  DB::select("END;");
      return $data;
   }

}
