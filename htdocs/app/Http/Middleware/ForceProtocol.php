<?php

namespace App\Http\Middleware;

use Closure;

class ForceProtocol
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (! $request->secure() && true == config('env.force_ssl')) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}
