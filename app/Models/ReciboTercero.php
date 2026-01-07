<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReciboTercero extends Model
{
    protected $table = 'recibos_terceros';

    protected $fillable = [
        'persona_id',
        'medio_pago_id',
        'descripcion',
        'observacion',
        'importe',
        'fecha_emision',
        'fecha_pago',
        'retencion',
        'importe_retenido',
    ];

    public function tercero()
    {
        return $this->belongsTo(Persona::class, 'persona_id');
    }

    public function medioPago()
    {
        return $this->belongsTo(MedioPago::class, 'medio_pago_id');
    }
}
