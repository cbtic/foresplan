<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use ReflectionFunction;

class LogRequest
{
    const BLUE   = "\033[34m";
    const YELLOW = "\033[33m";
    const GREEN  = "\033[32m";
    const GRAY   = "\033[90m";
    const RESET  = "\033[0m";

    protected static $renderedViews = [];

    public function handle($request, Closure $next)
    {
        $logRequests = config('request-logging.log_requests', true);
        $appDebug = config('app.debug', false);

        if (!$logRequests || !$appDebug) {
            return $next($request);
        }

        $excludePaths = config('request-logging.exclude_paths', [
            'telescope*',
            'horizon*',
            '_debugbar*',
            'livewire*',
        ]);

        foreach ($excludePaths as $pattern) {
            if ($request->is($pattern)) {
                return $next($request);
            }
        }

        Log::info(self::GRAY . str_repeat("-", 80) . self::RESET);

        $start = microtime(true);
        $input = $request->except(['password', 'password_confirmation', '_token']);
        $user  = Auth::check() ? Auth::user()->email : 'guest';

        self::$renderedViews = [];

        Log::info(self::BLUE . "Started {$request->method()} \"{$request->getPathInfo()}\" for {$request->ip()}" . self::RESET);
        Log::info(self::YELLOW . "  User: {$user}" . self::RESET);

        if (config('request-logging.log_parameters', true) && !empty($input)) {
            Log::info(self::YELLOW . "  Parameters: " . json_encode($input) . self::RESET);
        }

        DB::connection()->enableQueryLog();

        $response = $next($request);

        $route       = Route::current();
        $controller  = $this->resolveControllerInfo($route);

        Log::info(self::YELLOW . "  Controller: {$controller}" . self::RESET);

        if (config('request-logging.log_views', true) && !empty(self::$renderedViews)) {
            foreach (array_unique(self::$renderedViews) as $v) {
                Log::info(self::YELLOW . "  View: {$v}" . self::RESET);
            }
        }

        $queries = DB::getQueryLog();
        $dbTime  = 0;

        if (!empty($queries)) {
            Log::info(self::YELLOW . "  SQL Queries:" . self::RESET);

            foreach ($queries as $q) {
                $time = round($q['time'] ?? 0, 2);
                $dbTime += $time;

                $bindings = !empty($q['bindings']) ? ' [' . implode(', ', array_map(function($b) {
                    return is_string($b) ? "'{$b}'" : $b;
                }, $q['bindings'])) . ']' : '';

                Log::info(self::GRAY . "    SQL ({$time}ms) " . $q['query'] . $bindings . self::RESET);
            }
        }

        $totalMs = round((microtime(true) - $start) * 1000, 2);
        $dbTime  = round($dbTime, 2);
        $viewTime = max(0, round($totalMs - $dbTime, 2));

        Log::info(self::GREEN . "Completed {$response->getStatusCode()} in {$totalMs}ms (Views: {$viewTime}ms | DB: {$dbTime}ms)" . self::RESET);

        return $response;
    }

    public static function addRenderedView($viewName)
    {
        self::$renderedViews[] = $viewName;
    }

    private function resolveControllerInfo($route)
    {
        if (!$route) {
            return "Route not resolved";
        }

        $action = $route->getAction();

        if (isset($action['controller'])) {
            return $action['controller'];
        }

        if ($route->getAction('uses') instanceof \Closure) {
            $ref = new ReflectionFunction($route->getAction('uses'));
            return "Closure ({$ref->getFileName()}:{$ref->getStartLine()})";
        }

        if (isset($action['view'])) {
            return "View: " . $action['view'];
        }

        return "Unknown route handler";
    }
}