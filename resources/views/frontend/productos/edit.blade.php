@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Producto #{{ $productos->id }}</div>

                <div class="card-body">
                    <x-forms.producto :productos="$productos"></x-forms.producto>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
