<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;
use DB;

class TdiasFeriado extends Model
{
    protected $fillable = ['fech_feri_tdf','flag_mdia_tdf','sali_mdia_tdf','moti_feri_tdf','flag_nlab_tdf','fech_frec_tdf','fech_irec_tdf','flag_recu_tdf'];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getfechaFeriado()
    {
        $dt = new DateTime($this->fech_feri_tdf);
        
        return $dt->format('d/m/Y');
    }

    public function listar_feriado_ajax($p){
		return $this->readFunctionPostgres('sp_listar_feriado_paginado',$p);
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

    use HasFactory;
}
