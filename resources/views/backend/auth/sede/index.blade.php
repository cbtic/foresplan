@extends('backend.layouts.app')

@section('title', __('Sedes'))

@section('content')
<x-backend.card>
    <x-slot name="header">
        @lang('Sedes')
    </x-slot>

    <x-slot name="headerActions">
        <x-utils.link
            :href="route('admin.auth.sede.create')"
            class="btn btn-sm btn-primary"
            icon="cui-plus"
        >
            @lang('Nueva Sede')
        </x-utils.link>
    </x-slot>

    <x-slot name="body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>@lang('ID')</th>
                    <th>@lang('Denominación')</th>
                    <th>@lang('Estado')</th>
                    <th>@lang('Es principal')</th>
                    <th>@lang('Acciones')</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sedes as $sede)
                    <tr>
                        <td>{{ $sede->id }}</td>
                        <td>{{ $sede->denominacion }}</td>
                        <td>{{ $sede->estado ? __('Activa') : __('Inactiva') }}</td>
                        <td>{{ $sede->es_principal ? __('Sí') : __('No') }}</td>
                        <td>
                            <x-utils.edit-button :href="route('admin.auth.sede.edit', $sede)" />
                            <x-utils.delete-button :href="route('admin.auth.sede.destroy', $sede)" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $sedes->links() }}
    </x-slot>
</x-backend.card>
@endsection
