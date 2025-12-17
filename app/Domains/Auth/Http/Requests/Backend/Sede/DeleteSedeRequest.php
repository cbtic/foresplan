<?php

namespace App\Domains\Auth\Http\Requests\Backend\Sede;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSedeRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();

        if (! $user) {
            return false;
        }

        return $user->can('admin.access.sede.delete');
    }

    public function rules(): array
    {
        return [];
    }
}
