<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculoRequest extends FormRequest
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
            'placa' => ['required', 'string'],
            'ejes' => ['required'],
            'peso_tracto' => ['required'],
            'peso_carreta' => ['required'],
            'peso_seco' => ['required'],
            'estado' => ['required'],
        ];
    }
}
