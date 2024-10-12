<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class UbicacionTrabajo extends Model
{
    protected $table = 'ubicacion_trabajos';

    protected $fillable = ['id_cliente','id_empresa','estado'];

    use HasFactory;

	function getEmpresaAll($cliente){

        $cad = "select t2.id, t2.ruc, t2.nombre_comercial, t2.razon_social, t2.direccion, t2.representante, t2.email, t2.telefono
        from ubicacion_trabajos t1
        inner join empresas t2 on t1.id_empresa=t2.id
        Where id_cliente = '.$cliente.' and t1.estado='A'
		order by t2.nombre_comercial  
		";
    
        $data = DB::select($cad);
        if($data)return $data;
    }

    public function users() 
    {
        return $this->belongsToMany(User::Class);
    }
}
