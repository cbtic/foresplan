@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Vehiculo #{{ $vehiculos->id }}</div>

                <div class="card-body">
                    <x-forms.vehiculo :vehiculos="$vehiculos"></x-forms.vehiculo>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-scripts')
<script>
    $(document).ready(function() {
        $('.form-select').select2();
    });
</script>
@endpush
