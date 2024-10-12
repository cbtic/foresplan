<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Marca extends Model
{
    use HasFactory;

    function getMarcaAll(){

        $cad = "select * from marcas m 
        where m.estado='1'";

		$data = DB::select($cad);
        return $data;
    }
}
