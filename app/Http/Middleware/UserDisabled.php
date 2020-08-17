<?php

namespace App\Http\Middleware;

use Closure;

class UserDisabled
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
        if (!$request->user()->isEnable)
            return $next($request);
        return redirect('/');
    }
}
