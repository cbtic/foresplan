<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConductoresRequest extends FormRequest
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

            'id_personas' => ['required'],
            'licencia' => ['required', 'string', 'min:9'],
            'fecha_licencia' => ['required', 'date'],
            'estado' => ['required', 'string'],

        ];
    }
}
