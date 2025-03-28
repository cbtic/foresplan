<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Formula extends Model
{
    protected $fillable = ['id_planilla','id_subplanilla','id_concepto','formula_for'];

    protected $foreignKeys = [
        'planilla' => 'id_planilla', 
        'subplanilla' => 'id_subplanilla', 
        'concepto' => 'id_concepto'
    ];

    use HasFactory;


    public function planilla()
    {
        return $this->belongsTo(Tplanilla::class, $this->foreignKeys['planilla'], 'id');
    }

    public function subplanilla()
    {
        return $this->belongsTo(Subtplanilla::class, $this->foreignKeys['subplanilla'], 'id');
    }

    public function concepto()
    {
        return $this->belongsTo(Concepto::class, $this->foreignKeys['concepto'], 'id');
    }
     
    public function getForeignKeys(){
        return array_values($this->foreignKeys);
    }
    public function listar_formula_ajax($p){
		return $this->readFunctionPostgres('sp_listar_formula_paginado',$p);
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
}
