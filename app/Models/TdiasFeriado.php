<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class TdiasFeriado extends Model
{
    protected $fillable = ['fech_feri_tdf','flag_mdia_tdf','sali_mdia_tdf','moti_feri_tdf','flag_nlab_tdf','fech_frec_tdf','fech_irec_tdf','flag_recu_tdf'];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getfechaFeriado()
    {
        $dt = new DateTime($this->fech_feri_tdf);
        
        return $dt->format('d/m/Y');
    }

    use HasFactory;
}
