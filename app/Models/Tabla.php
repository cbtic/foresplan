<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabla extends Model
{
    protected $guarded = [];
    protected $fillable = [
        'tab_ite1_cod', 'tab_ite2_cod', 'tab_larg_des', 'tab_cort_des', 'tab_mont_imp', 'tab_orde_vis', 'tab_tabl_est'
    ];
    use HasFactory;
}
