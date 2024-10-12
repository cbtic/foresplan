<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoOperacione extends Model
{
    protected $fillable = ['codi_oper_top','tipo_oper_top','codi_conc_tco','desc_oper_top','cont_dias_top','nume_dias_top','desc_pago_top','veri_reso_top','dcto_cts_top','clas_oper_top','flag_omis_top'];

    use HasFactory;
}
