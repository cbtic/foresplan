@extends('backend.layouts.app')

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Movimientos')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.movimientos-table />
        </x-slot>
    </x-backend.card>
@endsection
