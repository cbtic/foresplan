<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Persona extends Model
{
    protected $fillable = ['nro_brevete', 'codigo', 'tipo_documento', 'numero_documento', 'nombres', 'apellido_paterno', 'apellido_materno', 'fecha_nacimiento', 'sexo', 'telefono', 'email', 'foto', 'ocupacion', 'titular_id', 'tipo_relacion','nombre_completo'];

    protected $appends = ['nombre_completo'];

    // contantes SEXO
    const SEXO_FEMENINO = 'F';
    const SEXO_MASCULINO = 'M';
    // contantes TIPO DOCUMENTO
    const TIPO_DOCUMENTO_DNI = 'DNI';
    const TIPO_DOCUMENTO_CARNET_EXTRANJERIA = 'CARNET_EXTRANJERIA';
    const TIPO_DOCUMENTO_PASAPORTE = 'PASAPORTE';
    const TIPO_DOCUMENTO_RUC = 'RUC';
    const TIPO_DOCUMENTO_CEDULA = 'CEDULA';
    const TIPO_DOCUMENTO_PTP = 'PTP/PTEP';
    const TIPO_DOCUMENTO_CPP = 'CPP/CSR';

    public function afiliaciones()
    {
        return $this->hasMany(Afiliacion::class);
    }

    public function conductores()
    {
        return $this->hasOne(Conductores::class,'id_conductores');
    }

    function getPersonas($empresa_id){
      //  $ubicacion = UbicacionTrabajo::where("ubicacion_empresa_id", $empresa_id)->first();
       // $afiliaciones = Afiliacion::where("ubicacion_id", $ubicacion->id)->get("persona_id");
        //$data = Persona::find($afiliaciones);

       // return $data;
    }

    function getPersona($tipo_documento,$numero_documento){

        $cad = "select t1.*
		from personas t1
		Where t1.id_tipo_documento='".$tipo_documento."' And t1.numero_documento='".$numero_documento."'";
		//echo $cad;
		$data = DB::select($cad);
        if(isset($data[0]))return $data[0];

    }

    public function getNombreCompletoAttribute() : string {
      return $this->numero_documento . " - " . $this->apellido_paterno ." " . $this->apellido_materno . ", " . $this->nombres;
    }

    public function getNombreCompletoSinDniAttribute() : string {
      return $this->apellido_paterno ." " . $this->apellido_materno . ", " . $this->nombres;
    }

	public function listar_persona_ajax($p){
		return $this->readFunctionPostgres('sp_listar_persona_paginado',$p);
    }

	function getPersonaBuscar($term){

        $cad = "select id,nombres||' '||apellido_paterno||' '||apellido_materno persona
		from personas
		where estado='1'
		and nombres||' '||apellido_paterno||' '||apellido_materno ilike '%".$term."%' ";

		$data = DB::select($cad);
        return $data;
    }


	public function readFunctionPostgres($function, $parameters = null){

      $_parameters = '';
      if (count($parameters) > 0) {
          $_parameters = implode("','", $parameters);
          $_parameters = "'" . $_parameters . "',";
      }
	  DB::select("BEGIN;");
	  $cad = "select " . $function . "(" . $_parameters . "'ref_cursor');";
	  DB::select($cad);
	  $cad = "FETCH ALL IN ref_cursor;";
	  $data = DB::select($cad);
	  DB::select("END;");
      return $data;
   }

}
