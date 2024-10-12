<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Contrato extends Model
{    
    protected $fillable = ['peri_anno_con', 'nume_cont_con', 'tipo_cont_con', 'id_persona', 'fech_inic_cnt', 'fech_reso_cnt', 'nume_reso_cnt', 'fech_fina_cnt', 'fech_cese_cnt', 'codi_proy_pin', 'codi_depe_ctr', 'ubic_fisi_ctr', 'id_cargo', 'codi_enca_ctr', 'secu_func_sfu', 'codi_fuen_fto', 'mont_cont_ctr', 'nume_part_cnt', 'mont_part_cnt', 'deno_part_cnt', 'act2_cont_cnt', 'func_cont_cnt', 'deno_cont', 'nume_proc_con', 'fech_proc_con', 'codi_depe_tde', 'cont_refe_con', 'codi_proy_pry', 'codi_sede_sed', 'numero_archivo', 'cert_pres_num', 'user_crea', 'fech_crea', 'user_modif', 'fech_modif', 'cargo_cnfz', 'codi_empl_rep', 'codi_carg_rep', 'resol_rep', 'created_at', 'updated_at'];

    
    function getContratoByPersona($id_persona){
        $cad = "select id, peri_anno_con, nume_cont_con, tipo_cont_con, id_persona, fech_inic_cnt, fech_reso_cnt, nume_reso_cnt, fech_fina_cnt, fech_cese_cnt, codi_proy_pin, codi_depe_ctr, ubic_fisi_ctr, id_cargo, codi_enca_ctr, secu_func_sfu, codi_fuen_fto, mont_cont_ctr, nume_part_cnt, mont_part_cnt, deno_part_cnt, act2_cont_cnt, func_cont_cnt, deno_cont, nume_proc_con, fech_proc_con, codi_depe_tde, cont_refe_con, codi_proy_pry, codi_sede_sed, numero_archivo, cert_pres_num, user_crea, fech_crea, user_modif, fech_modif, cargo_cnfz, codi_empl_rep, codi_carg_rep, resol_rep, created_at, updated_at
            from contratos 
            where id_persona=".$id_persona."
            order by id desc";
            
        $data = DB::select($cad);
        return $data;
    }


    function fecha_actual(){
		
		$cad = "select to_char(current_date,'dd-mm-yyyy') as fecha_actual";

		$data = DB::select($cad);
        return $data[0]->fecha_actual;
		
	}
}
