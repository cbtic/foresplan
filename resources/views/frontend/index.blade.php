@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

	@auth

    <x-backend.card>
        <x-slot name="header">
            @lang('Welcome :Name', ['name' => $logged_in_user->name])
        </x-slot>

        <x-slot name="body">
            @lang('Welcome to the Dashboard')
        </x-slot>
    </x-backend.card>

	@else

	<div class="container col-sm-12">

        <div id="app" class="">

			<div class="row mb-3">
				<div class="col">
					<div class="card">
						<div class="card-header">
							<strong>
								<i style="padding:15px 0px" class="fas fa-tachometer-alt"></i> FELMO SRL TDA
							</strong>
						</div><!--card-header-->

						<div class="card-body">
							<div class="row">

								<div class="col-md-12 order-2 order-sm-1">
									<br>
									<div class="card-header">
											<i style="padding:15px 0px" class=""></i> Lema del trabajador de FELMO SRL TDA
											<strong>"</strong>
												Honestidad, Trabajo y Honradez
											<strong>"</strong>
									</div>
									<br>

									<div class="row">
										<div class="col">
											<div class="card mb-4">
												<div class="card-header">
													MISIÓN
												</div><!--card-header-->

												<div class="card-body">
													Brindar un servicio de calidad a los inversionistas dentro del proceso de Gestión Inmobiliaria,  propiciando la transparencia en todo el proceso.
												</div><!--card-body-->
											</div><!--card-->
										</div><!--col-md-6-->
									</div><!--row-->

									<div class="row">
										<div class="col">
											<div class="card mb-4">
												<div class="card-header">
													VISIÓN
												</div><!--card-header-->

												<div class="card-body">
													Ser la empresa modelo en Gestión Inmobiliaria y recuperación de activos.
												</div><!--card-body-->
											</div><!--card-->
										</div><!--col-md-6-->
									</div><!--row-->


								</div><!--col-md-8-->
							</div><!-- row -->
						</div> <!-- card-body -->
					</div><!-- card -->
				</div><!-- row -->
			</div><!-- row -->


        </div><!--app-->



</div>

	@endauth


@endsection
