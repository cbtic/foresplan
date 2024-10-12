<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'id_producto' => ['required'],
            'numero_lote' => ['required', 'integer'],
            'numero_serie' => ['required'],
            'id_unidad_medida' => ['required'],
            'cantidad' => ['required'],
            'costo' => ['required'],
            'id_moneda' => ['required'],
            'fecha_fabricacion' => [],
            'fecha_vencimiento' => ['required'],
            'id_anaquel' => [],
            'estado' => ['required']

        ];
    }
}
