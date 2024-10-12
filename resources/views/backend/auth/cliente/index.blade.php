@extends('backend.layouts.app')

@section('title', __('Client Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Client Management')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.auth.cliente.create')"
                :text="__('Crear Cliente')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.clientes-table />
        </x-slot>
    </x-backend.card>
@endsection
