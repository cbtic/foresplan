@extends('backend.layouts.app')

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Productos')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('frontend.productos.create')"
                :text="__('Nuevo Producto')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.productos-table />
        </x-slot>
    </x-backend.card>
@endsection
