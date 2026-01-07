<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedioPago extends Model
{
    protected $table = 'medio_pagos';

    protected $fillable = ['codigo', 'descripcion'];

    public function recibos()
    {
        return $this->hasMany(ReciboTercero::class, 'medio_pago_id');
    }
}
