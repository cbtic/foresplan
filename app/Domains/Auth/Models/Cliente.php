<?php

namespace App\Domains\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * Class Cliente.
 */
class Cliente extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clientes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['denominacion','estado'];
}
