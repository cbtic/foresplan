@extends('backend.layouts.app')

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Entrada de Productos')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('frontend.entrada_productos.create')"
                :text="__('Nuevo Ingreso de Productos')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.entrada-productos-table />
        </x-slot>
    </x-backend.card>
@endsection
