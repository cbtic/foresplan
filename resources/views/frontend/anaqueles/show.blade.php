@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ver Anaquel #{{ $anaqueles->id }}</div>

                <div class="card-body">
                    <x-forms.anaquele :anaqueles="$anaqueles"></x-forms.anaquele>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-scripts')
<script>
    var form = document.forms[1];

    [].slice.call( form.elements ).forEach(function(item){
      item.disabled = !item.disabled;
    });

    $(".btn.btn-secondary").hide();
    $(".btn.btn-primary").hide();

    $(document).ready(function() {
        $('.form-select').select2();
    });
</script>
@endpush
