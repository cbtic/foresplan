<?php

namespace App\Domains\Auth\Http\Requests\Backend\Sede;

use Illuminate\Foundation\Http\FormRequest;

class StoreSedeRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();

        if (! $user) {
            return false;
        }

        return $user->can('admin.access.sede.create');
    }

    public function rules(): array
    {
        return [
            'denominacion' => ['required', 'string', 'max:255'],
            'estado'       => ['required', 'integer', 'in:0,1'],
            'es_principal' => ['nullable', 'boolean'],
        ];
    }
}
