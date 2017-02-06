<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class isSysAdmin
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
        if (Auth::check() && Auth::user()->permission>=4) 
                return $next($request);
                
        return redirect('/');
    }
}
