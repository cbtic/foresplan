@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Editar Entrada #{{ $entrada_productos->id }}</div>

                <div class="card-body">
                    <x-forms.EntradaProducto :entradaproductos="$entrada_productos" />
                </div>
            </div>
        </div>


        <x-backend.card>
            <x-slot name="header">
                @lang("Detalle de Entrada")
            </x-slot>
            <x-slot name="headerActions" :entrada_producto="$entrada_productos->id">
                <x-forms.EntradaProductoDetalle :entradaproducto="$entrada_productos->id" />
            </x-slot>
            <x-slot name="body">
                <livewire:backend.entrada-producto-detalles-table :entrada_producto="$entrada_productos->id">
            </x-slot>
        </x-backend.card>
    </div>
</div>
@endsection

@push('after-scripts')
<!-- Modal Producto -->
<div class="modal fade" id="ModalProductoLote" role="dialog">
     <div class="modal-dialog">
     <!-- Modal contenido-->
     <div class="modal-content" style="padding: 0 !important">
        <div class="modal-body-producto">
        </div>
    </div>
</div>
<script>
    /* Llamando al formulario Modal para nuevo producto */
    $('.btnNuevoProducto').on('click',function(){
        $('.modal-body-producto').load('/productos/modal_create',function(){
            $('#ModalProductoLote').modal({show:true});
        });
    });

    /* Llamando al formulario Modal para nuevo lote */
    $('.btnNuevoLote').on('click',function(){
        $('.modal-body-producto').load('/lotes/modal_create',function(){
            $('#ModalProductoLote').modal({show:true});
        });
    });

    function rowclick(td){
        let rowId = td.parentElement.rowIndex;
        document.getElementsByClassName("btn btn-success btn-entrada")[rowId-1].click();
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

    function manejar_popup(parent_modal) {
        $("#ModalProductoLote > div > div > div > div > div > div > div > div.modal-header > button").on("click", function (event) {
            $('#ModalProductoLote').modal('hide');
            $('#'+parent_modal).modal('show');
        });
        $('.form-select').select2();

        // $("#ModalProductoLote > div > div > div > div > div > div > div > div.modal-header > button").on("click", $('#'+parent_modal).modal('show'));
        $("form").eq($("form").length-1).on( "submit", function( event ) {
            $('.form-select').select2();
            let _form = $("form").eq($("form").length-1);

            $.ajax({
                url: "{{ route('frontend.productos.store') }}",
                method: 'POST',
                dataType: 'json',
                data : _form.serialize(),
                success: function(data) {
                        // log response into console
                        console.log(data);
                        let insertar_item = data.denominacion;
                        let insertar_value = data.id;
                        var nuevoProducto = new Option(insertar_item, insertar_value, true, true);
                        // Append it to the select
                        $("#Id_producto").append(nuevoProducto).trigger('change');
                        // alert( "Enviar datos a: " + $("form").eq($("form").length-2).prop('action'));
                        $('#ModalProductoLote').modal('hide');
                        $('#'+parent_modal).modal('show');
                    },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log("some error");
                }
                });
            event.preventDefault();
        });
    }

    function manejar_popup_lote(parent_modal) {
        $("#ModalProductoLote > div > div > div > div > div > div > div > div.modal-header > button").on("click", function (event) {
            $('#ModalProductoLote').modal('hide');
            $('#'+parent_modal).modal('show');
        });
        $('.form-select').select2();
        // $("#ModalProductoLote > div > div > div > div > div > div > div > div.modal-header > button").on("click", $('#'+parent_modal).modal('show'));
        $("form").eq($("form").length-1).on( "submit", function( event ) {
            let _form = $("form").eq($("form").length-1);
            // let insertar_item = _form["Numero_lote"].value;
            // let insertar_value = "1000";
            // var nuevoLote = new Option(insertar_item, insertar_value, true, true);
            // // Append it to the select
            // $("#Numero_lote").append(nuevoLote).trigger('change');
            // // alert( "Enviar datos a: " + $("form").eq($("form").length-2).prop('action'));
            // $('#ModalProductoLote').modal('hide');
            // $('#'+parent_modal).modal('show');
            $.ajax({
                url: "{{ route('frontend.lotes.store') }}",
                method: 'POST',
                dataType: 'json',
                data : _form.serialize(),
                success: function(data) {
                        // log response into console
                        console.log(data);
                        let insertar_item = data.numero_serie;
                        let insertar_value = data.id;
                        var nuevoLote = new Option(insertar_item, insertar_value, true, true);
                        // Append it to the select
                        $("#Numero_lote").append(nuevoLote).trigger('change');
                        // alert( "Enviar datos a: " + $("form").eq($("form").length-2).prop('action'));
                        $('#ModalProductoLote').modal('hide');
                        $('#'+parent_modal).modal('show');
                    },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log("some error");
                }
                });
            event.preventDefault();
        });
    }

</script>
@endpush
