<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use DB;

class DetalleTurno extends Model
{
    protected $fillable = ['id_turno','nume_ndia_dtu','flag_labo_dtu','minu_tole_dtu','hora_sali_dtu','hora_entr_dtu'];
	
    use HasFactory;
	//public $exclude=['tur'];
	/*
	public function boards()
	{
		return $this->hasMany(Board::class);
	}
	*/
	
	public function tturnos()
    {
	  return $this->belongsTo(DetalleTurno::class,'id_turno');
    }
	/*
	public function detalle_turnos()
    {
	  return $this->belongsTo(DetalleTurno::class,'id');
    }
	*/
	/*
	public function tturnos()
    {
        return $this->belongsTo(Tturno::class);
    }
	*/
	/*
	public function tturno()
    {
	  return $this->hasMany(Tturno::class,'id');
    }
	*/
	
	
}
