<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class DetaOperacione extends Model
{
    protected $fillable = ['fech_oper_ope','id_tipo_operacion','id_persona','tipo_oper_top','fech_inic_ope','fech_fina_ope','nume_dias_ope','nume_reso_ope','nomb_auto_ope','fech_reso_ope','tipo_hora_ope','fech_elab_ope','nume_minut_ope','secu_oper_ope','esta_oper_ope','obse_oper_ope','codi_relo_per','nro_citt_ope','nro_sevit_ope','nro_medi_ope','obse_jefe_ope','obse_rrhh_ope','rowidi','num_archivo','codi_moti_tmo','user_crea','fech_crea','user_modi','fech_modi'];

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
  
      function getPersonaAll(){
  
          $cad = "select id, tipo_documento, numero_documento, concat(apellido_paterno,' ',apellido_materno,' ',nombres) persona,fecha_nacimiento, sexo, estado
          from personas
          order by id desc";
          $data = DB::select($cad);
          return $data;
      }
      //use HasFactory;
      
      function getPersonaBuscar($term){
  
          $cad = "select id,apellido_paterno||' '||apellido_materno||' '||nombres persona 
          from personas 
          where estado='A' 
          and nombres||' '||apellido_paterno||' '||apellido_materno ilike '%".$term."%' ";
      
          $data = DB::select($cad);
          return $data;
      }
      
      public function listar_papeleta_ajax($p){
          return $this->readFunctionPostgres('sp_listar_papeleta_paginado',$p);
      }

      function getPapeletaById($id){

        $cad = "select d.id, p.numero_documento, p.id id_persona, di.abre_docu_did tipo_documento, p.apellido_paterno||' '||p.apellido_materno||' '||p.nombres persona, 
        d.id_tipo_operacion, (select sp_crud_obtiene_tabla_deno (d.id_tipo_operacion)) tipo_justificacion, d.nume_reso_ope, d.tipo_oper_top, 
        to_char(d.fech_inic_ope::timestamp,'dd/mm/yyyy')fech_inic_ope, to_char(d.fech_fina_ope::timestamp,'dd/mm/yyyy')fech_fina_ope, d.nume_dias_ope, 
        to_char(d.fech_inic_ope::timestamp,'HH24:MI:SS') horainicope, to_char(d.fech_fina_ope::timestamp,'HH24:MI:SS') horafinaope,d.obse_oper_ope, '' flag_omis_top,
        d.tipo_hora_ope, d.codi_relo_per, d.esta_oper_ope, d.obse_jefe_ope, d.obse_rrhh_ope, d.id_ubicacion, e.razon_social, d.nume_dias_ope, d.nume_minut_ope
        from deta_operaciones d
        inner join personas p on p.id = d.id_persona
        inner join documento_identidades di on di.id = p.tipo_documento
        inner join ubicacion_trabajos ut on ut.id = d.id_ubicacion 
        inner join empresas e on e.id = ut.id_empresa 
        Where d.id = ".$id;
		$data = DB::select($cad);
        return $data[0];
    }      
  
      public function readFunctionPostgres($function, $parameters = null){
      
          $_parameters = '';
          if (count($parameters) > 0) {
              $_parameters = implode("','", $parameters);
              $_parameters = "'" . $_parameters . "',";
          }
          $data = DB::select("BEGIN;");
          $cad = "select " . $function . "(" . $_parameters . "'ref_cursor');";
          $data = DB::select($cad);
          $cad = "FETCH ALL IN ref_cursor;";
          $data = DB::select($cad);
          return $data;
       }
    
       /*
       function getPersonas($empresa_id){
          $ubicacion = UbicacionTrabajo::where("ubicacion_empresa_id", $empresa_id)->first();
          $afiliaciones = Afiliacion::where("ubicacion_id", $ubicacion->id)->get("persona_id");
          $data = Persona::find($afiliaciones);
          // dd($data);
          return $data;
      }
      */
  
      function getPersona($tipo_documento,$numero_documento){
  
          $cad = "select id, tipo_documento, numero_documento, apellido_paterno, apellido_materno, nombres, fecha_nacimiento, sexo
          from personas 
          Where tipo_documento='".$tipo_documento."' And numero_documento='".$numero_documento."'";
          //echo $cad;
          $data = DB::select($cad);
          return $data[0];
      }
      function getPersonaExt($tipo_documento,$numero_documento){
          
          if($tipo_documento=="RUC"){
              /*$cad = "select t1.id,razon_social,t1.direccion,t1.representante,t2.id id_ubicacion
                      from empresas t1
                      inner join ubicacion_trabajos t2 on t1.id=t2.ubicacion_empresa_id
                      Where t1.ruc='".$numero_documento."'";*/
  
          }else{
              $cad = "Select codigo,tipo_documento,numero_documento,nombres,apellido_paterno,apellido_materno,fecha_nacimiento::date,sexo,telefono,email,foto,'A' estado From dblink ('dbname=".config('values.dblink_dbname')." port=".config('values.dblink_port')." host=".config('values.dblink_host')." user=".config('values.dblink_user')." password=".config('values.dblink_password')."','select codigo,tipo_documento,numero_documento,nombres,apellido_paterno,apellido_materno,fecha_nacimiento,sexo,telefono,email,foto,estado from personas where numero_documento=''".$numero_documento."'' and tipo_documento=''".$tipo_documento."''')ret
  (codigo varchar,tipo_documento varchar,numero_documento varchar,nombres varchar,apellido_paterno varchar,apellido_materno varchar,fecha_nacimiento varchar,sexo varchar,telefono varchar,email varchar,foto varchar,estado varchar)";
          }
          //echo $cad;
          $data = DB::select($cad);
          if(isset($data[0]))return $data[0];
      }
  
      function getPersonaBuscarT($tipo_documento,$numero_documento){
  
          if($tipo_documento=="RUC"){
              /*$cad = "select t1.id,razon_social,t1.direccion,t1.representante,t2.id id_ubicacion
                      from empresas t1
                      inner join ubicacion_trabajos t2 on t1.id=t2.ubicacion_empresa_id
                      Where t1.ruc='".$numero_documento."'";*/
  
          }else{
              $cad = "Select codigo,tipo_documento,numero_documento,nombres,apellido_paterno,apellido_materno,fecha_nacimiento::date,sexo,telefono,email,foto,'A' estado From dblink ('dbname=".config('values.dblink_dbname')." port=".config('values.dblink_port')." host=".config('values.dblink_host')." user=".config('values.dblink_user')." password=".config('values.dblink_password')."','select codigo,tipo_documento,numero_documento,nombres,apellido_paterno,apellido_materno,fecha_nacimiento,sexo,telefono,email,foto,estado from personas where numero_documento=''".$numero_documento."'' ')ret
  (codigo varchar,tipo_documento varchar,numero_documento varchar,nombres varchar,apellido_paterno varchar,apellido_materno varchar,fecha_nacimiento varchar,sexo varchar,telefono varchar,email varchar,foto varchar,estado varchar)";
          }
          //echo $cad;
          $data = DB::select($cad);
          if(isset($data[0]))return $data[0];
      }
  
      function apiperu_dev($dni){
         
          $curl = curl_init();
          
          curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://apiperu.dev/api/dni/'.$dni,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
              'Authorization: Bearer 20b6666ddda099db4204cf53854f8ca04d950a4eead89029e77999b0726181cb',
              'Cookie: XSRF-TOKEN=eyJpdiI6InNWRHJxUGpDT3pqSVRkUlFFTm5XMHc9PSIsInZhbHVlIjoiREtNUVFoTytVcHhRQmdFSGo2ejV1SVBhMnExYmpMc25ZYTZSdlEwYmRJekhDWUVpMC94bFJqeWs5T1pKN1RuUHdYNHhUalI4SXJOYVJoSzFOcUs1MDNiTitRamkxTm5TTElkUU1JMGdPK2ZteXlDQ1I4YkVBZFdrYis1QndCOUsiLCJtYWMiOiJlMjQ4ZWZmZmY0OTQzMDhlYjYyMTljOWVmMjI4ZWQ2M2Q1NTFkYjE2MmZhYWNlMzRkZWI1MmJhZGM2MmY0NjFkIn0%3D; apiperu_session=eyJpdiI6IjVkbkpDQ1MwVGx3THFiR0g0UjlyMnc9PSIsInZhbHVlIjoiUk5IWTFoYjVhWXJGaEhiQ2NMQ1phRHV5RjR5QWxVKzgrRjhpaVRRckQ3OGIrQUpSdk1tcXNTdmRKYk95Rml0MlVkWVdsSHlEbXcvcmNxUFNiNGp2SzdTWHJhYmtnck5KenFla1dPQ0lId3hWZitXaVkyNEtOR25GdVhibHVCS2QiLCJtYWMiOiI2OGI2MTFjNjhjMDFmY2UzMzhlOTJhNGJkZTUzZjY5MDU2ZWNkNDA4OGRkNjlmYjVjY2RlOGQ3ZDljY2E0ZDMxIn0%3D'
            ),
          ));
          //exit($dni);
          $response = curl_exec($curl);
          //echo($response);exit();
          
          curl_close($curl);
          return $response;
  
      
      }
  
}
