<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class TablaMaestra extends Model
{
    protected $fillable = ['tipo', 'denominacion', 'orden', 'estado', 'codigo', 'tipo_nombre'];

    // contantes TIPO
    const NC = 'NC';
    const ND = 'ND';
    const GUIA = 'GUIA';
    const DOC_RELA = 'DOC_RELA';
    const TIPO_OPE = 'TIPO_OPE';
    const TIPO_IGV = 'TIPO_IGV';
    const UNIDADES = 'UNIDADES';
    const CODIGOBYS = 'CODIGOBYS';
    const ESTADO_BALANZA = 'ESTADO BALANZA';
    const G_DOC_RELA = 'G_DOC_RELA';
    const MOTIVO_T = 'MOTIVO_T';
    const MODAL_T = 'MODAL_T';
    const SERIES = 'SERIES';
    const CAJA = 'CAJA';
    const BALANZA = 'BALANZA';
    const CARRETA = 'CARRETA';
    const ESPACIO = 'ESPACIO';
    const ESTACIONAMIENTO = 'ESTACIONAMIENTO';

    const ACTIVO = 'A';
    const CANCELADO = 'C';

    use HasFactory;

	public function listar_tabla_maestras_ajax($p){
		return $this->readFunctionPostgres('sp_listar_tabla_maestra_paginado',$p);
    }

    function getMaestroByTipo($tipo){

        $cad = "select codigo,denominacion
                from tabla_maestras
                where tipo='".$tipo."'
				and estado='1'
                order by orden ";

		$data = DB::select($cad);
        return $data;
    }

	function getMaestroByTipoAndSubTipo($tipo,$sub_codigo){

        $cad = "select codigo,denominacion
                from tabla_maestras
                where tipo='".$tipo."'
				and sub_codigo='".$sub_codigo."'
				and estado='1'
                order by orden ";

		$data = DB::select($cad);
        return $data;
    }

    function getMaestro($tipo){

        $cad = "select id,denominacion
                from tabla_maestras
                where tipo='".$tipo."'
                order by orden ";

		$data = DB::select($cad);
        return $data;
    }
    function getMaestroC($tipo, $codigo){

        $cad = "select id,denominacion,codigo
                from tabla_maestras
                where tipo='".$tipo."'
                and codigo ='".$codigo."'
                order by orden ";

		$data = DB::select($cad);
        return $data;
    }

	public function readFunctionPostgres($function, $parameters = null){

        $_parameters = '';
        if (count($parameters) > 0) {
            $_parameters = implode("','", $parameters);
            $_parameters = "'" . $_parameters . "',";
        }
        $data = DB::select("BEGIN;");
        $cad = "select " . $function . "(" . $_parameters . "'ref_cursor');";
        $data = DB::select($cad);
        $cad = "FETCH ALL IN ref_cursor;";
        $data = DB::select($cad);
        return $data;
     }

    public function por_tipo($tipo) {
        $tabla_maestra_opciones = TablaMaestra::where([['estado', 1], ['tipo',strval($tipo)]])->get();

        $array_opciones=[];

        foreach ($tabla_maestra_opciones  as $key => $opcion) {
            $array_opciones[] = ['id' => $opcion->id, 'denominacion' => $opcion->denominacion];
        }

        $json = json_encode($array_opciones);
        $obj = json_decode($json);

        return $obj;
    }

    function getCaja($tipo){

        $cad = "Select t1.codigo,t1.denominacion 
		from tabla_maestras t1
		where t1.tipo='".$tipo."' and t1.estado='1' 
		And t1.codigo::int not in (select distinct id_caja from caja_ingresos where estado='1')
		order by t1.orden"; 
    
		$data = DB::select($cad);
        return $data;
    }
}
