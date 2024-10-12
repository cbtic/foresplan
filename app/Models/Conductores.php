<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conductores extends Model
{
    use HasFactory;
    protected $fillable = ["licencia","fecha_licencia","estado","id_personas"];

    public function personas()
    {
	  //return $this->hasMany(EstacionamientoEmpresa::class,'empresa_id');
        return $this->belongsTo(Persona::class,"id_personas");
    }

    public function full_name2($id, $activo='inactivo')
    {
        $nombre_completo_sin_dni = Conductores::find($id)->personas['nombre_completo_sin_dni'];

        return ['nombre_completo_sin_dni' => $nombre_completo_sin_dni];
    }

    public function full_name($activo='CANCELADO')
    {
        $conductores_estado = Conductores::where('estado', $activo)->get();

        $array_conductores=[];

        foreach ($conductores_estado  as $key => $conductor) {
            $array_conductores[] = ['id' => $conductor->id, 'nombre_completo_sin_dni' => $conductor->personas['nombre_completo_sin_dni']];
        }

        $json = json_encode($array_conductores);
        $obj = json_decode($json);

        return $obj;
    }

   public function vehiculos()
   {
       return $this->belongsToMany(Vehiculo::class,'vehiculos_conductores', 'id_vehiculos', 'id_conductores');
   }
}
