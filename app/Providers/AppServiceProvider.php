<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

/**
 * Class AppServiceProvider.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        if (config('app.debug') && config('app.env') === 'local' && config('logging.log_sql_queries', false)) {
            DB::listen(function ($query) {
                Log::debug(sprintf(
                    "[SQL DEBUG] %s | bindings=%s | time=%sms",
                    $query->sql,
                    json_encode($query->bindings),
                    $query->time
                ));
            });
        }

        View::composer('*', function ($view) {
            $user = Auth::user();

            // Si no hay usuario logueado, no compartimos nada
            if (! $user) {
                $view->with('dropdownSedes', collect());
                $view->with('dropdownSelectedSedeId', null);
                return;
            }

            $sedes = $user->sedesFromRoles();

            $selectedSedeId = $user->defaultSedeIdForDropdown();

            $view->with('dropdownSedes', $sedes);
            $view->with('dropdownSelectedSedeId', $selectedSedeId);
        });
    }
}
