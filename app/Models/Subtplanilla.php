<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtplanilla extends Model
{
    protected $fillable = ['tipo_plan_tpl','subt_plan_stp','desc_subt_stp','titu_subt_stp','tipo_docu_tpd','tipo_mcpp_stp','clase_mcpp_stp'];

    use HasFactory;
}
