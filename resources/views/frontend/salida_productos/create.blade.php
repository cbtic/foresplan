@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Crear una Salida</div>

                    <div class="card-body">
                        <x-forms.SalidaProducto />
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
        $('.form-select').select2({dropdownAutoWidth : true});
        if($('#Id_moneda').val()==1) {
            $('#Tipo_cambio_dolar').hide();
            $('#Tipo_cambio_dolar').val(0);
        }

        $('#Id_moneda').select2().on('change', function(e) {
            var x = this.value;
            if (x==1) {
                    $("#Tipo_cambio_dolar").hide();
                    $("#Tipo_cambio_dolar").val(0);
                } else {
                    $("#Tipo_cambio_dolar").show();
                    $("#Tipo_cambio_dolar").val(3.85);
                }
        });

        $('#Igv_compra').select2().on('change', function(e) {
            var x = this.value;
            if (x==0) {
                $("#Total_compra").val($("#Sub_total_compra").val());
            } else {
                $("#Total_compra").val($("#Sub_total_compra").val()*1.18);
            }
        });

    });

    function redimensionaSelect2(){
        $('.form-select').select2({dropdownAutoWidth : true});
    }

</script>

@endpush
