<?php

namespace App\Http\Middleware;

use Closure;

class BasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // .envでベーシック認証設定
        if (true == config('env.basic_auth')) {
            httpBasicAuth(config('env.basic_auth_user'), config('env.basic_auth_password'));
        }
        return $next($request);
    }
}
