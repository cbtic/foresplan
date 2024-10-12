<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Vacacione extends Model
{
    protected $fillable = ['codi_empl_per','ano_peri_vac','nume_peri_vac','fech_inic_vac','fech_fina_vac','id_corr','id_corrant','fg_estado','fech_registro','secu_oper_ope','nume_reso_ope'];

    use HasFactory;
	
	public function prueba(){
		
		$cad = "select * from vacaciones";
    
		$data = DB::select($cad);
        return $data;
		
	}
}
