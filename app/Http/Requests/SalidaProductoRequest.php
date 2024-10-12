<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalidaProductoRequest extends FormRequest
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
            'fecha_salida' => ['required'],
            'id_tipo_documento' => ['required'],
            'unidad_destino' => ['required', 'string'],
            'numero_comprobante' => ['required', 'string'],
            'fecha_comprobante' => ['required'],
            'id_moneda' => ['required'],
            'tipo_cambio_dolar' => ['required', 'string'],
            'sub_total_compra' => ['required', 'string'],
            'igv_compra' => ['required', 'string'],
            'total_compra' => ['required', 'string'],
            'cerrado' => ['required', 'string'],
            'observacion' => ['required', 'string'],
            'estado' => ['required', 'string'],
        ];
    }
}
