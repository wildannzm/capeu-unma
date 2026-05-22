<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProxyHost
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('host') === '$host') {
            $request->headers->set('host', parse_url(config('app.url'), PHP_URL_HOST));
            $request->server->set('HTTP_HOST', parse_url(config('app.url'), PHP_URL_HOST));
        }
        return $next($request);
    }
}