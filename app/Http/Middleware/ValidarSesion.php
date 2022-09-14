<?php

namespace App\Http\Middleware;

use App\Usuario;
use Closure;
use Illuminate\Support\Facades\Auth;

class ValidarSesion
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
        error_log('pasa');
        
        if(is_null(Auth::id())){
            return redirect()->route('user.verLogin');
        }

        
        
        return $next($request);
    }
}
