<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlmaceneRequest extends FormRequest
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

            'codigo' => ['required'],
            'denominacion' => ['required'],
            'id_ubigeo' => ['required', 'string', 'min:6'],
            'direccion' => ['required', 'string'],
            'telefono' => ['required', 'string'],
            'encargado' => ['required', 'string'],
            'estado' => ['required', 'string'],

        ];
    }
}
