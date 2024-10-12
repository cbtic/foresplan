@extends('backend.layouts.app')

@section('title', __('Enterprise Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Enterprise Management')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.auth.cliente.create')"
                :text="__('Crear Empresa')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.empresas-table />
        </x-slot>
    </x-backend.card>
@endsection
