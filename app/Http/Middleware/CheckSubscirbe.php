<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckSubscirbe
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

        $subscribe = Auth::user()->subscribe;
        if($subscribe == 0){
            return redirect()->route('subscribe_renewal');
        }
        return $next($request);
    }
}
