<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #173E39;">
    <div class="container">
        <x-utils.link
            :href="route('frontend.index')"
            :text="appName()"
            class="navbar-brand" />

        <a href="{{ route('frontend.index') }}" class="navbar-brand">
            <img src="<?php echo URL::to('/') ?>/img/logo_sigplan_white.png" alt="" width="50" height="50" style="padding:0px;margin:0px">
        </a>
        <br>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('Toggle navigation')">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @if(config('boilerplate.locale.status') && count(config('boilerplate.locale.languages')) > 1)
                    <li class="nav-item dropdown">
                        <x-utils.link
                            :text="__(getLocaleName(app()->getLocale()))"
                            class="nav-link dropdown-toggle"
                            id="navbarDropdownLanguageLink"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false" />

                        @include('includes.partials.lang')
                    </li>
                @endif

                @guest
                    <li class="nav-item">
                        <x-utils.link
                            :href="route('frontend.auth.login')"
                            :active="activeClass(Route::is('frontend.auth.login'))"
                            :text="__('Login')"
                            class="nav-link" />
                    </li>

                    @if (config('boilerplate.access.user.registration'))
                        <li class="nav-item">
                            <x-utils.link
                                :href="route('frontend.auth.register')"
                                :active="activeClass(Route::is('frontend.auth.register'))"
                                :text="__('Register')"
                                class="nav-link" />

                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownPrueba" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Asistencia</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownPrueba">
                                <!--<a href="" class="dropdown-item">Consulta de Asistencias</a>-->
								<a href="/asistencia/listar_asistencia" class="dropdown-item">Consulta de Asistencias</a>
                                <!--<a href="/asistencia/resumen" class="dropdown-item">Resumen de Asistencias</a>-->
                        </div>

                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownPrueba" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Planillas</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownPrueba">
                                <!--<a href="" class="dropdown-item">Consulta de Asistencias</a>-->

								<a href="/planilla/listar_planilla_persona" class="dropdown-item">Planilla Periodo</a>
								<!--<a href="/planilla/create_planilla_persona" class="dropdown-item">Registrar Planilla Persona</a>-->
								<!--<a href="/planilla/create" class="dropdown-item">Registrar Planilla Persona</a>-->
								<a href="/planilla/listar_planilla_resumen" class="dropdown-item">Planilla Resumen</a>
                                <a href="/planilla/create" class="dropdown-item">Planilla Calculada</a>
								<!--<a href="/planilla/create_resumen_asistencia" class="dropdown-item">Registrar Resumen Asistencia</a>-->
                        </div>
                    </li>

					<li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownPrueba" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Reporte</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownPrueba">
								<a href="/reporte/reporte_area" class="dropdown-item">Reporte por Area</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownPrueba" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Mantenimiento</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownPrueba">
                                <a href="{{route('frontend.manten.index')}}" class="dropdown-item">Tipos</a>
                                <a href="/manten/conceptos" class="dropdown-item">Conceptos</a>

                                <a href="/concepto_plan/create" class="dropdown-item">Concepto Plan</a>

                                <!--
                                <a href="{{route('frontend.persona')}}" class="dropdown-item">Personas</a>
                                <a href="/manten/persona-detalles" class="dropdown-item">Persona Detalles</a>
-->

                                <a href="{{route('frontend.persona.create')}}" class="dropdown-item">Personal</a>
								<a href="/manten/clientes" class="dropdown-item">Clientes</a>
								<a href="/manten/vacaciones" class="dropdown-item">Vacaciones</a>

								<a href="/manten/tturnos" class="dropdown-item">Turnos</a>
								<!--<a href="/manten/detalle_turnos" class="dropdown-item">Detalle Turnos</a>-->
								<a href="/manten/personal_turnos" class="dropdown-item">Asignar Persona Turno</a>

                                <a href="/feriado/create" class="dropdown-item">Feriados</a>

                                <a href="/formula/create" class="dropdown-item">Formulas</a>

                                <a href="/manten/subtplanillas" class="dropdown-item">Sub Planillas</a>

                                <a href="/papeleta/create" class="dropdown-item">Papeletas</a>

								<a href="/maestro/create_ubicacion_maestro" class="dropdown-item">Maestros por Cliente</a>

                                <a href="/cliente_usuario/create" class="dropdown-item">Cliente Usuario</a>

                                <a href="/tarjeta/create" class="dropdown-item">Asignar Persona Tarjeta</a>

                                <a href="{{route('frontend.persona.create_contacto_emergencia')}}" class="dropdown-item">Contacto Emergencia Personal</a>

                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownPrueba" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Control de Alimentaci&oacute;n</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownPrueba">
                            <a href="/menu_persona/create_menu" class="dropdown-item">Registro Menu</a>
                            <a href="/menu_persona/create_persona_menu" class="dropdown-item">Registro Menu Persona</a>
                        </div>
                    </li>

                    @php
                        $currentSedeId = session('current_sede_id') ?? $dropdownSelectedSedeId ?? null;
                        $currentSede   = $dropdownSedes->firstWhere('id', $currentSedeId);
                    @endphp

                    <li class="nav-item dropdown">
                        <a href="#"
                           class="nav-link dropdown-toggle"
                           id="navbarDropdownSede"
                           data-toggle="dropdown"
                           aria-haspopup="true"
                           aria-expanded="false">
                            Sede: {{ $currentSede->denominacion ?? 'Seleccionar sede' }}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdownSede">
                            @foreach($dropdownSedes as $sede)
                                <form action="{{ route('frontend.sede.cambiar') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="sede_id" value="{{ $sede->id }}">
                                    <button type="submit"
                                            class="dropdown-item {{ $currentSedeId == $sede->id ? 'active' : '' }}">
                                        {{ $sede->denominacion }}
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <x-utils.link
                            href="#"
                            id="navbarDropdown"
                            class="nav-link dropdown-toggle"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                            v-pre
                        >
                            <x-slot name="text">
                                <img class="rounded-circle" style="max-height: 20px" src="{{ $logged_in_user->avatar }}" />
                                {{ $logged_in_user->name }} <span class="caret"></span>
                            </x-slot>
                        </x-utils.link>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if ($logged_in_user->isAdmin())
                                <x-utils.link
                                    :href="route('admin.dashboard')"
                                    :text="__('Administration')"
                                    class="dropdown-item" />
                            @endif

                            @if ($logged_in_user->isUser())
                                <x-utils.link
                                    :href="route('frontend.user.dashboard')"
                                    :active="activeClass(Route::is('frontend.user.dashboard'))"
                                    :text="__('Dashboard')"
                                    class="dropdown-item"/>
                            @endif

                            <x-utils.link
                                :href="route('frontend.user.account')"
                                :active="activeClass(Route::is('frontend.user.account'))"
                                :text="__('My Account')"
                                class="dropdown-item" />

                            <x-utils.link
                                :text="__('Logout')"
                                class="dropdown-item"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <x-slot name="text">
                                    @lang('Logout')
                                    <x-forms.post :action="route('frontend.auth.logout')" id="logout-form" class="d-none" />
                                </x-slot>
                            </x-utils.link>
                        </div>
                    </li>
                @endguest
            </ul>
        </div><!--navbar-collapse-->
    </div><!--container-->
</nav>

@if (config('boilerplate.frontend_breadcrumbs'))
    @include('frontend.includes.partials.breadcrumbs')
@endif
