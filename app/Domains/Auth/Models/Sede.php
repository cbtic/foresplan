<?php

namespace App\Domains\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domains\Auth\Models\Role;

class Sede extends Model
{
    use SoftDeletes;

    protected $table = 'sedes';

    protected $fillable = [
        'denominacion',
        'estado',
        'es_principal',
        'id_usuario_inserta',
        'id_usuario_actualiza',
    ];

    protected $casts = [
        'es_principal' => 'boolean',
        'estado'       => 'integer',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_sede')
            ->withTimestamps();
    }
}
