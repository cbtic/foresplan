@extends('backend.layouts.app')

@section('title', __('Crear Sede'))

@section('content')
<x-backend.card>
    <x-slot name="header">
        @lang('Crear Sede')
    </x-slot>

    <x-slot name="body">
        <x-forms.post :action="route('admin.auth.sede.store')">
            <div class="form-group">
                <label for="denominacion">@lang('Denominación')</label>
                <input type="text" name="denominacion" id="denominacion"
                       class="form-control" value="{{ old('denominacion') }}" required>
            </div>

            <div class="form-group">
                <label for="estado">@lang('Estado')</label>
                <select name="estado" id="estado" class="form-control">
                    <option value="1" selected>@lang('Activa')</option>
                    <option value="0">@lang('Inactiva')</option>
                </select>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" name="es_principal" id="es_principal"
                       class="form-check-input" value="1">
                <label class="form-check-label" for="es_principal">
                    @lang('Es sede principal')
                </label>
            </div>

            <button type="submit" class="btn btn-primary">
                @lang('Guardar')
            </button>

        </x-forms.post>
    </x-slot>
</x-backend.card>
@endsection
