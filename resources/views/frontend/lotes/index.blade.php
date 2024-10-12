@extends('backend.layouts.app')

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Lotes')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('frontend.lotes.create')"
                :text="__('Nuevo Lote')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.lote-table />
        </x-slot>
    </x-backend.card>
@endsection
