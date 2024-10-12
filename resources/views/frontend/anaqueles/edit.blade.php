@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Anaquel #{{ $anaqueles->id }}</div>

                <div class="card-body">
                    <x-forms.anaquele :anaqueles="$anaqueles"></x-forms.anaquele>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
