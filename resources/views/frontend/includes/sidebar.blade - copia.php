
<?php  $routeName = \Request::route()->getName();
	$grupo = explode(".",$routeName);
	if(isset($grupo[0]) && $grupo[0]!="admin"){
?>

<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">

        <!--
        <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#full') }}"></use>
        </svg>
        <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#signet') }}"></use>
        </svg>
		-->

        <a href="{{ route('frontend.index') }}" class="navbar-brand">
            <img src="<?php echo URL::to('/') ?>/img/logo_forestalpama.jpg" alt="" width="190" style="padding:0px;margin:0px">
        </a>

    </div><!--c-sidebar-brand-->

    @auth

    <ul class="c-sidebar-nav">
        <!--
		<li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.dashboard')"
                :active="activeClass(Route::is('admin.dashboard'), 'c-active')"
                icon="c-sidebar-nav-icon cil-speedometer"
                :text="__('Dashboard')" />
        </li>
		-->

@if(Gate::check('Ingreso de Camiones') || Gate::check('Cubicaje de Troncos'))

        @if (
        $logged_in_user->hasAllAccess() ||
        (
        $logged_in_user->can('admin.access.user.list') ||
        $logged_in_user->can('admin.access.user.deactivate') ||
        $logged_in_user->can('admin.access.user.reactivate') ||
        $logged_in_user->can('admin.access.user.clear-session') ||
        $logged_in_user->can('admin.access.user.impersonate') ||
        $logged_in_user->can('admin.access.user.change-password')
        )
        )
        <li class="c-sidebar-nav-title">@lang('System')</li>

        <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.auth.user.*') || Route::is('admin.auth.role.*'), 'c-open c-show') }}">
            <x-utils.link href="#" icon="c-sidebar-nav-icon cil-user" class="c-sidebar-nav-dropdown-toggle" :text="__('Materia Prima')" />

            <ul class="c-sidebar-nav-dropdown-items">
                @if (
                $logged_in_user->hasAllAccess() ||
                (
                $logged_in_user->can('admin.access.user.list') ||
                $logged_in_user->can('admin.access.user.deactivate') ||
                $logged_in_user->can('admin.access.user.reactivate') ||
                $logged_in_user->can('admin.access.user.clear-session') ||
                $logged_in_user->can('admin.access.user.impersonate') ||
                $logged_in_user->can('admin.access.user.change-password')
                )
                )
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('frontend.ingreso_vehiculo_tronco')" class="c-sidebar-nav-link" :text="__('Ingreso Camion')" :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                </li>
                @endif

                @if ($logged_in_user->hasAllAccess())
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('frontend.ingreso_vehiculo_tronco.cubicaje')" class="c-sidebar-nav-link" :text="__('Cubicaje Tronco')" :active="activeClass(Route::is('admin.auth.role.*'), 'c-active')" />
                </li>
                @endif
            </ul>
        </li>
        @endif

@endif

        @if ($logged_in_user->hasAllAccess())
        <li class="c-sidebar-nav-dropdown">
            <x-utils.link href="#" icon="c-sidebar-nav-icon cil-list" class="c-sidebar-nav-dropdown-toggle" :text="__('Acerrado')" />

            <!--
                <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::dashboard')"
                            class="c-sidebar-nav-link"
                            :text="__('Dashboard')" />
                    </li>
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('log-viewer::logs.list')"
                            class="c-sidebar-nav-link"
                            :text="__('Logs')" />
                    </li>
                </ul>
				-->

        </li>
        @endif

        @if ($logged_in_user->hasAllAccess())

        <li class="c-sidebar-nav-dropdown">
            <x-utils.link href="#" icon="c-sidebar-nav-icon cil-list" class="c-sidebar-nav-dropdown-toggle" :text="__('Control Mantenimiento')" />

        </li>


        <li class="c-sidebar-nav-dropdown">
            <x-utils.link href="#" icon="c-sidebar-nav-icon cil-list" class="c-sidebar-nav-dropdown-toggle" :text="__('Almacenes')" />
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('frontend.almacenes.create')" class="c-sidebar-nav-link" :text="__('Almacenes')" :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('frontend.secciones.index')" class="c-sidebar-nav-link" :text="__('Secciones')" :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('frontend.anaqueles.index')" class="c-sidebar-nav-link" :text="__('Anaqueles')" :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('frontend.productos.index')" class="c-sidebar-nav-link" :text="__('Productos')" :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('frontend.lotes.index')" class="c-sidebar-nav-link" :text="__('Lotes')" :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('frontend.entrada_productos.index')" class="c-sidebar-nav-link" :text="__('Entradas')" :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('frontend.salida_productos.index')" class="c-sidebar-nav-link" :text="__('Salidas')" :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('frontend.kardex.index')" class="c-sidebar-nav-link" :text="__('Kardex')" :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('frontend.movimientos.index')" class="c-sidebar-nav-link" :text="__('Movimientos')" :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                </li>
            </ul>

        </li>

        <li class="c-sidebar-nav-dropdown">
            <x-utils.link href="#" icon="c-sidebar-nav-icon cil-list" class="c-sidebar-nav-dropdown-toggle" :text="__('Consultas')" />

        </li>

        <li class="c-sidebar-nav-dropdown">
            <x-utils.link href="#" icon="c-sidebar-nav-icon cil-list" class="c-sidebar-nav-dropdown-toggle" :text="__('Mantenimiento')" />
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('frontend.personas')" class="c-sidebar-nav-link" :text="__('Personas')" :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('frontend.empresas')" class="c-sidebar-nav-link" :text="__('Empresas')" :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('frontend.vehiculos.index')" class="c-sidebar-nav-link" :text="__('Vehiculos')" :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                </li>

                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('frontend.tablamaestras.index')" class="c-sidebar-nav-link" :text="__('Tablas Maestras')" />
                </li>
                <li class="c-sidebar-nav-item">
                    <x-utils.link :href="route('frontend.conductores.index')" class="c-sidebar-nav-link" :text="__('Conductores')" />
                </li>


            </ul>

        </li>

        <li class="c-sidebar-nav-dropdown">
            <x-utils.link href="#" icon="c-sidebar-nav-icon cil-list" class="c-sidebar-nav-dropdown-toggle" :text="__('Reportes')" />

        </li>

        @endif

        @else


        @endauth

    </ul>

    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div><!--sidebar-->
<?php } ?>
