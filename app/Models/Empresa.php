<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Empresa extends Model
{
    protected $fillable = ['ruc','nombre_comercial','razon_social','direccion','representante','email','telefono','estado'];
    
    function getEmpresaAll($cliente){

        $cad = "select t2.id, t2.ruc, t2.nombre_comercial, t2.razon_social, t2.direccion, t2.representante, t2.email, t2.telefono
        from ubicacion_trabajos t1
        inner join empresas t2 on t1.id_empresa=t2.id
        Where id_cliente = '".$cliente."' and t1.estado='A'
		order by t2.nombre_comercial  
		";
    
        $data = DB::select($cad);
        if($data)return $data;
    }

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class);
    }
}
