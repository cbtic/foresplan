<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ubigeo;
use Illuminate\Http\Request;

class UbigeoController extends Controller
{
    public function obtener_departamento($Pais){
        $ubigeo_model = new Ubigeo;
		$departamento = $ubigeo_model->getDepartamento($Pais);
        echo json_encode($departamento);
	}

    public function obtener_provincia($Departamento){
        $ubigeo_model = new Ubigeo;
		$provincia = $ubigeo_model->getProvincia($Departamento);
        echo json_encode($provincia);
	}
		
	public function obtener_distrito($Provincia){
        $ubigeo_model = new Ubigeo;
		$distrito = $ubigeo_model->getDistrito($Provincia);
        echo json_encode($distrito);
	}
}
