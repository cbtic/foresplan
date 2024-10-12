@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Seccion #{{ $secciones->id }}</div>

                <div class="card-body">
                    <x-forms.seccione :secciones="$secciones"></x-forms.seccione>
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
