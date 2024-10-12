<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Ubigeo extends Model
{
    use HasFactory;

    protected $fillable = [];

	function getDepartamento(){

        $cad = "select id_departamento,desc_ubigeo
        from ubigeos u
        where id_departamento!='00'
        and id_provincia='00'
        and id_distrito='00'
        and estado='1'
        order by desc_ubigeo ";

		$data = DB::select($cad);
        return $data;
    }

	function getProvincia($id_departamento){

        $cad = "select id_provincia,desc_ubigeo
        from ubigeos u
        where id_departamento!='00'
        and id_provincia!='00'
        and id_distrito='00'
        and id_departamento='".$id_departamento."'
        and estado='1'
        order by desc_ubigeo";

		$data = DB::select($cad);
        return $data;
    }

	function getDistrito($id_departamento,$id_provincia){

        $cad = "select id_ubigeo,id_distrito,desc_ubigeo
        from ubigeos u
        where id_departamento!='00'
        and id_provincia!='00'
        and id_distrito!='00'
        and id_departamento='".$id_departamento."'
        and id_provincia='".$id_provincia."'
        and estado='1'
        order by desc_ubigeo";

		$data = DB::select($cad);
        return $data;
    }

    public function almacenes()
    {
        return $this->HasOne(Almacene::class,"id_ubigeo","id_ubigeo");
    }

    public function departamentos() {
        $departamentos_opciones = Ubigeo::where([['estado', 1], ['id_departamento', '<>', '00'], ['id_provincia', '=', '00'], ['id_distrito', '=', '00']])->get();

        $array_opciones=[];

        foreach ($departamentos_opciones  as $key => $opcion) {
            $array_opciones[] = ['id' => $opcion->id_departamento, 'denominacion' => $opcion->desc_ubigeo];
        }

        $json = json_encode($array_opciones);
        $obj = json_decode($json);

        return $obj;
    }

    public function provincias($id_departamento) {
        $provincias_opciones = Ubigeo::where([['estado', 1], ['id_departamento', '=', $id_departamento], ['id_provincia', '<>', '00'], ['id_distrito', '=', '00']])->get();

        $array_opciones=[];

        foreach ($provincias_opciones  as $key => $opcion) {
            $array_opciones[] = ['id' => $opcion->id_provincia, 'denominacion' => $opcion->desc_ubigeo];
        }

        $json = json_encode($array_opciones);
        $obj = json_decode($json);

        return $obj;
    }

    public function distritos($id_ubigeo) {
        $id_departamento = substr($id_ubigeo,0,2);
        $id_provincia = substr($id_ubigeo,2,2);
        $distritos_opciones = Ubigeo::where([['estado', 1], ['id_departamento', $id_departamento], ['id_provincia', $id_provincia], ['id_distrito', '<>' , '00']])->get();

        $array_opciones=[];

        foreach ($distritos_opciones  as $key => $opcion) {
            $array_opciones[] = ['id' => $opcion->id_distrito, 'denominacion' => $opcion->desc_ubigeo];
        }

        $json = json_encode($array_opciones);
        $obj = json_decode($json);

        return $obj;
    }

    public function distritos_ajax($id_departamento, $id_provincia) {

        $distritos_opciones = Ubigeo::where([['estado', 1], ['id_departamento', $id_departamento], ['id_provincia', $id_provincia], ['id_distrito', '<>' , '00']])->get();

        $array_opciones=[];

        foreach ($distritos_opciones  as $key => $opcion) {
            $array_opciones[] = ['id' => $opcion->id_distrito, 'denominacion' => $opcion->desc_ubigeo];
        }

        $json = json_encode($array_opciones);
        $obj = json_decode($json);

        return $obj;
    }

    public function UbigeoCompletoAttribute($id_ubigeo) {
        $id_departamento = substr($id_ubigeo, 0, 2);
        $id_provincia = substr($id_ubigeo, 2, 2);
        $id_distrito = substr($id_ubigeo, 4, 2);

        $departamento = Ubigeo::where([["id_departamento", $id_departamento], ["id_provincia", "00"], ["id_distrito", "00"]])->pluck("desc_ubigeo")[0];

        $provincia = Ubigeo::where([["id_departamento", $id_departamento], ["id_provincia", $id_provincia], ["id_distrito", "00"]])->pluck("desc_ubigeo")[0];

        $distrito = Ubigeo::where([["id_departamento", $id_departamento], ["id_provincia", $id_provincia], ["id_distrito", $id_distrito]])->pluck("desc_ubigeo")[0];

        $ubigeo_completo = $departamento."-".$provincia."-".$distrito;

        return $ubigeo_completo;
    }
}
