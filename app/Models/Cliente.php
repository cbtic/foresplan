<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['denominacion','estado'];

    use HasFactory;

    public function users() 
    {
        return $this->belongsToMany(User::Class);
    }

    public function empresas()
    {
        return $this->belongsToMany(Empresa::class);
    }
}
