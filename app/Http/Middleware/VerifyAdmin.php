<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $papel)
    {
        if(\Auth::check()){
            if(\Auth::user()->temPapel($papel)){
                return $next($request);
            }
        }
        abort(403, 'Acesso Negado');
    }
}
