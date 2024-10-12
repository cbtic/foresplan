@extends('backend.layouts.app')

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Kardex')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.kardex-table />
        </x-slot>
    </x-backend.card>
@endsection
