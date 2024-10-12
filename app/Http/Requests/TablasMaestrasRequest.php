<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TablasMaestrasRequest extends FormRequest
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
            'tipo' => ['required'],
            'denominacion' => ['required'],
            'orden' => ['required'],
            'estado' => ['required'],
            'codigo' => ['required'],
            'tipo_nombre' => ['required'],
        ];
    }
}
