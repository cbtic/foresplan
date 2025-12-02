<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
    }
}