<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProxyHost
{
    public function handle(Request $request, Closure $next): Response
    {
        if (app()->isProduction()) {
            $domain = 'capeu.unma.ac.id';

            $request->headers->set('host', $domain);
            $request->headers->set('x-forwarded-host', $domain);

            $request->server->set('HTTP_HOST', $domain);
            $request->server->set('SERVER_NAME', $domain);

            if ($request->server->get('SERVER_NAME') === '$host') {
                $request->server->remove('SERVER_NAME');
            }
        }

        return $next($request);
    }
}
