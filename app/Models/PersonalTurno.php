<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

use Illuminate\Database\Eloquent\SoftDeletes;
//use Persona;

class PersonalTurno extends Model
{
    use SoftDeletes;
	
    protected $fillable = ['id_persona','id_turno','codi_tarj_etu','fech_asig_ttu','flag_cont_asis','flag_sobt_ent'];

    use HasFactory;
	
	public function persona()
    {
	  //return $this->belongsTo(PersonalTurno::class,'id_persona');
	  
	  //return $this->belongsTo(Persona::class,'id');
	  
	  //return $this->hasMany(Persona::class,'id');
	  
	  //return $this->hasMany(Persona::class,'id');
	  
	  //return $this->hasMany(PersonalTurno::class,'id_persona');
	  
	  //return $this->hasOne(PersonalTurno::class, 'id_persona');
		
		return $this->belongsTo(Persona::class,'id_persona','id');
    }
	
	/*
	public function personal_turnos(){
		
		return $this->hasMany(PersonalTurno::class,'id');
		
	}
	*/
	
	public function tturno()
    {
	
		//return $this->belongsTo(PersonalTurno::class,'id_turno');
		
	  	//return $this->belongsTo(DetalleTurno::class,'id_turno');
	  
	  	//return $this->hasMany(Tturno::class,'id');
	  	
		return $this->belongsTo(Tturno::class,'id_turno','id');
		
    }
	
	function getPersonaSinTurno($id,$id_area_trabajo,$id_unidad_trabajo){
		
		$cad = "select t1.id, tipo_documento, numero_documento, concat(apellido_paterno,' ',apellido_materno,' ',nombres) persona,fecha_nacimiento, sexo, t1.estado
        from personas t1
		inner join persona_detalles t2 on t1.id=t2.id_persona and t2.estado ='A' and t2.eliminado ='N'
		left join personal_turnos t3 on t1.id=t3.id_persona and t3.deleted_at is null
		left join tturnos t4 on t4.id=t3.id_turno
		Where 1=1 ";
		
		//if($id>0)$cad .= "And (t3.id is null or t1.id=".$id.") ";
		//else $cad .= "And t3.id is null ";

		if($id>0)$cad .= " And ((t3.id is null or t4.deleted_at is not null) is null or t1.id=".$id.") ";
		else $cad .= " And (t3.id_turno is null or t4.deleted_at is not null) ";
		
		if($id_area_trabajo>0)$cad .= " And t2.id_area_trabajo='".$id_area_trabajo."' ";
		if($id_unidad_trabajo>0)$cad .= " And t2.id_unidad_trabajo='".$id_unidad_trabajo."' ";
		
		$cad .= " And t1.estado='A' order by id desc "; 
		//echo $cad;
		$data = DB::select($cad);
        return $data;
    }
		
}
