<!--<script src="<?php echo URL::to('/') ?>/js/manifest.js"></script>
<script src="<?php echo URL::to('/') ?>/js/vendor.js"></script>
<script src="<?php echo URL::to('/') ?>/js/frontend.js"></script>-->


<link rel="stylesheet" href="<?php echo URL::to('/') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!--<link rel="stylesheet" type="text/css" href="<?php echo URL::to('/') ?>assets/vendor/datatables/dataTables.bootstrap4.min.css">-->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
<!--<script src="<?php echo URL::to('/') ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>-->

<style>
	#tblAfiliado tbody tr{
		font-size:13px
	}
  .table-sortable tbody tr {
    cursor: move;
  }
	#global {
    height: 650px !important;
    width: auto;
    border: 1px solid #ddd;
		margin:15px
    /* background: #f1f1f1;*/
    /*overflow-y: scroll !important;*/
  }
  .margin{
    margin-bottom: 20px;
  }
  .margin-buscar{
    margin-bottom: 5px;
    margin-top: 5px;
  }
  .clickable{
    cursor: pointer;
  }
  .panel-body{
    display: block;
  }
	.dataTables_filter {
    display: none;
	}

</style>

@extends('frontend.layouts.app')

@section('title',  ' | ' . __('labels.frontend.contact.box_title'))

@section('breadcrumb')
<ol class="breadcrumb" style="padding-left:130px;margin-top:0px;background-color:#283659">
        <li class="breadcrumb-item text-primary">Inicio</li>
            <li class="breadcrumb-item active">Consulta de Terceros</li>
        </li>
    </ol>
@endsection

@section('content')
  <div class="justify-content-center">

    <div class="card">

      <div class="card-body">

        <div class="row">
          <div class="col-sm-5">
            <h4 class="card-title mb-0 text-primary">
              Consultar Terceros<!--<small class="text-muted">Usuarios activos</small>-->
            </h4>
          </div><!--col-->
        </div>

        <div class="row justify-content-center">

          <div class="col col-sm-12 align-self-center">

            <div class="card">
              <div class="card-header">
                <strong>
                  Lista de Terceros
                </strong>
              </div><!--card-header-->

              <form class="form-horizontal" method="post" action="{{ route('frontend.terceros.buscar')}}" id="frmTerceros" autocomplete="off">

                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                <div class="row" style="padding:20px 20px 0px 20px;">
                  <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                    <select class="form-control form-control-sm"
                      id="id_sede"
                      name="id_sede">
                      <option value="">Seleccion Sede</option>

                      @foreach($dropdownSedes as $sede)
                        @php
                          $isSelected =
                            (session('current_sede_id') == $sede->id) ||
                            ($dropdownSelectedSedeId == $sede->id && ! session()->has('current_sede_id'));
                        @endphp

                        <option value="{{ $sede->id }}" {{ $isSelected ? 'selected' : '' }}>
                          {{ $sede->denominacion }}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
                    <input class="form-control form-control-sm" id="numero_documento" name="numero_documento" placeholder="Numero de documento">
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <input class="form-control form-control-sm" id="persona" name="persona" placeholder="Apellidos y Nombres">
                  </div>
                  <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="padding-right:0px">
                    <input class="btn btn-warning pull-rigth" value="Buscar" type="button" id="btnBuscar" />
                  </div>
                </div>

                <div class="card-body">

                  <div class="table-responsive">
                    <table id="tblTercero" class="table table-hover table-sm">
                      <thead>
                        <tr style="font-size:13px">
                          <th>Id</th>
                          <th>Tipo Doc.</th>
                          <th>N.Documento</th>
                          <th>Nombres</th>
                          <th>F.Nac.</th>
                          <th>Género</th>
                          <th>Cond.Laboral</th>
                          <th>Área Trab.</th>
                          <th>Unidad Trab.</th>
                          <th>Estado</th>
                          <th>¿Sueldo? Registrar recibo?</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div><!--table-responsive-->

                </form>

              </div><!--card-body-->
            </div><!--card-->
          </div><!--col-->
        </div><!--row-->
      </div><!card-body-->
    </div><!card-->
  </div>

@endsection

<div id="openOverlayOpc" class="modal fade" role="dialog">
  <div class="modal-dialog" >
	  <div id="id_content_OverlayoneOpc" class="modal-content" style="padding: 0px;margin: 0px">
	    <div class="modal-body" style="padding: 0px;margin: 0px">
			  <div id="diveditpregOpc"></div>
	    </div>
	  </div>
  </div>
</div>

@push('after-scripts')

<script src="{{ asset('js/terceroLista.js') }}"></script>
@endpush
