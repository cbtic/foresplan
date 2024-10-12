<header class="c-header c-header-light c-header-fixed">
    <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
        <i class="c-icon c-icon-lg cil-menu"></i>
    </button>

    <a class="c-header-brand d-lg-none" href="#">
        <svg width="118" height="46" alt="CoreUI Logo">
            <use xlink:href="{{ asset('img/brand/coreui.svg#full') }}"></use>
        </svg>
    </a>


    <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
        <i class="c-icon c-icon-lg cil-menu"></i>
    </button>

    <ul class="c-header-nav d-md-down-none">

		@auth

		<li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="{{ route('frontend.index') }}">@lang('Sistema')</a></li>

		@else
		<a href="{{ route('frontend.index') }}" class="navbar-brand">
				<img src="<?php echo URL::to('/') ?>/img/logo_forestalpama.jpg" alt="" width="190" style="padding:0px;margin:0px">
		</a>


		<a href="{{ route('frontend.auth.login') }}" style="color:#FFFFFF;font-size:16px">@lang('Login')</a>

		@if (config('boilerplate.access.user.registration'))
			<a href="{{ route('frontend.auth.register') }}" style="color:#FFFFFF;padding-left:30px;font-size:16px">@lang('Register')</a>
		@endif

		@endauth

        @if(config('boilerplate.locale.status') && count(config('boilerplate.locale.languages')) > 1)
            <li class="c-header-nav-item dropdown">
                <x-utils.link
                    :text="__(getLocaleName(app()->getLocale()))"
                    class="c-header-nav-link dropdown-toggle"
                    id="navbarDropdownLanguageLink"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false" />

                @include('includes.partials.lang')
            </li>
        @endif
    </ul>

    <ul class="c-header-nav ml-auto mr-4">
        <li class="c-header-nav-item dropdown">
            <x-utils.link class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <x-slot name="text">
                    <div class="c-avatar">
						@auth
                        <img class="c-avatar-img" src="{{ $logged_in_user->avatar }}" alt="{{ $logged_in_user->email ?? '' }}">
						@endauth
                    </div>
                </x-slot>
            </x-utils.link>

            <div class="dropdown-menu dropdown-menu-right pt-0">
                <div class="dropdown-header bg-light py-2">
                    <strong>@lang('Account')</strong>
                </div>

                <x-utils.link
                    class="dropdown-item"
                    icon="c-icon mr-2 cil-account-logout"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <x-slot name="text">
                        @lang('Logout')
                        <x-forms.post :action="route('frontend.auth.logout')" id="logout-form" class="d-none" />
                    </x-slot>
                </x-utils.link>

            </div>
        </li>
    </ul>

	@auth

    <div class="c-subheader justify-content-between px-3">
        @include('backend.includes.partials.breadcrumbs')

        <div class="c-subheader-nav mfe-2">
            @yield('breadcrumb-links')
        </div>
    </div><!--c-subheader-->

	@endauth



</header>
