<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Tturno extends Model
{
    use SoftDeletes;

    protected $fillable = ['nomb_desc_tur','hora_entr_tur','hora_sali_tur','minu_tole_tur','tipo_refr_tur','refr_sali_tur','refr_entr_tur','refr_tole_tur','domi_dsem_tur','lune_dsem_tur','mart_dsem_tur','mier_dsem_tur','juev_dsem_tur','vier_dsem_tur','saba_dsem_tur','flag_tole_tur','hora_sema_tur','tiemp_refr_min','perm_dia_tur'];

    use HasFactory;
	
	public function tturnos()
    {  	
		//return $this->belongsTo(Tturno::class,'id_turno','id');
		return $this->belongsTo(Tturno::class,'id');
    }
	
	
}
