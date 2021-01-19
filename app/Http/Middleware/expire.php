<?php

namespace App\Http\Middleware;

use App\Models\Provider;
use Closure;
use Illuminate\Support\Facades\Auth;

class expire
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
        $subscribe = Provider::where('id', Auth::user()->provider)->get();
        if($subscribe[0]->subscribe == 0){
            return redirect()->route('provAdmin.expire');
        }
        return $next($request);
    }
}
