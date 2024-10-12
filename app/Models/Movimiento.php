<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_producto',
        'numero_lote',
        'tipo_movimiento',
        'entrada_salida_cantidad',
        'costo_entrada_salida',
        'id_users',
        'id_personas',
        'fecha_movimiento'
    ];
}
