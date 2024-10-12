<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ConceptoPersona extends Model
{
    use HasFactory;
	
	public function procesar_concepto_persona($id_periodo) {
		
        $cad = "Select sp_procesar_concepto_persona(?)";
        $data = DB::select($cad, array($id_periodo));
        return $data[0]->sp_procesar_concepto_persona;
    }
	
	public function add_concepto_persona($id_periodo,$id_persona) {
		
        $cad = "Select sp_add_concepto_persona(?,?)";
        $data = DB::select($cad, array($id_periodo,$id_persona));
        return $data[0]->sp_add_concepto_persona;
    }
	
	
}
