<?php

namespace App\Domains\Auth\Models;

use App\Domains\Auth\Models\Traits\Attribute\EmpresaAttribute;
use App\Domains\Auth\Models\Traits\Method\EmpresaMethod;
use App\Domains\Auth\Models\Traits\Scope\EmpresaScope;
use Database\Factories\RoleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cliente.
 */
class Empresa extends Model
{
    use HasFactory,
        EmpresaAttribute,
        EmpresaMethod,
        EmpresaScope;
        
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'empresas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ruc','nombre_comercial','razon_social','direccion','representante','email','telefono','estado'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return RoleFactory::new();
    }
}
