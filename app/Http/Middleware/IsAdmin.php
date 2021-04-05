<?php

namespace ZigKart\Http\Middleware;

use Closure;

class IsAdmin
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
        if(auth()->user()->isAdmin() || auth()->user()->isDeliveryboy()) {
            return $next($request);
        }
		return redirect('/');
    }
}
