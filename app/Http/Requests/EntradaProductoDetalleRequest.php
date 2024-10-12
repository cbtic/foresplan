<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntradaProductoDetalleRequest extends FormRequest
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

            'id_entrada_productos' => ['required'],
            'id_producto' => ['required'],
            'item' => ['required'],
            'cantidad' => ['required'],
            'numero_lote' => ['required'],
            'fecha_vencimiento' => ['required'],
            'aplica_precio' => ['required'],
            'id_um' => ['required'],
            'id_estado_bien' => ['required'],
            'id_marca' => ['required'],
            'estado' => ['required']

        ];
    }
}
