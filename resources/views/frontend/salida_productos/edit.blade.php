@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Editar Salida #{{ $salida_productos->id }}</div>

                <div class="card-body">
                    <x-forms.SalidaProducto :salidaproducto="$salida_productos" />
                </div>
            </div>
        </div>


        <x-backend.card>
            <x-slot name="header">
                @lang("Detalle de Salida")
            </x-slot>
            <x-slot name="headerActions" :salida_producto="$salida_productos->id">
                <x-forms.SalidaProductoDetalle :salidaproducto="$salida_productos->id" />
            </x-slot>
            <x-slot name="body">
                <livewire:backend.salida-producto-detalles-table :salida_producto="$salida_productos->id">
            </x-slot>
        </x-backend.card>
    </div>
</div>
@endsection

@push('after-scripts')
<script>
    function rowclick(td){
        let rowId = td.parentElement.rowIndex;
        document.getElementsByClassName("btn btn-success btn-salida")[rowId-1].click();
        setTimeout(function(){
            redimensionaSelect2();
        }, 500);
    }

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

        $('.btn.btn-success').on('click', function() {
            setTimeout(function(){
                // alert(500);
                $('.form-select').select2();
            }, 500)
        });

        $('.btn.btn-default').on('click', function() {
            setTimeout(function(){
                // alert(500);
                $('.form-select').select2();
            }, 500)
        });
    });

    function redimensionaSelect2(){
        $('.form-select').select2({dropdownAutoWidth : true});
    }

</script>

@endpush
