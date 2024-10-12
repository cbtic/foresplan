@extends('backend.layouts.modal')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="modal-header">
                        <h5 class="modal-title">Crear Nuevo Lote</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="card-body">
                        <x-forms.lote :modal="$modal"></x-forms.lote>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
<script>
</script>
@endpush
