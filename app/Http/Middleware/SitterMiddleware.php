<?php

namespace App\Http\Middleware;


use Closure;
use Auth;

class SitterMiddleware
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
        if (Auth::check() && Auth::user()->usertype == 'sitter') {
        return $next($request);
    }
    else{
        return redirect('/forbidden');
    }
    }
}
