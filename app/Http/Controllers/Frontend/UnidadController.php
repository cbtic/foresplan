<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UnidadTrabajo;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    public function obtener_unidad($area){
        $unidad_model = new UnidadTrabajo;
		$unidad = $unidad_model->getUnidad($area);
        echo json_encode($unidad);
	}
}
