<?php

namespace ZigKart\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsDeliveryboy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->isDeliveryboy()) {
            return $next($request);
        }
        return redirect('/');
    }
}
