<?php

namespace App\Http\Middleware;

use Closure;

class UserEnabled
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
        if ($request->user()->isEnabled)
            return $next($request);
        \Log::alert('The user with ID ' . $request->user()->id . ' was logged in the system, but it is not enable user.');
        return redirect('/user_disabled');
    }
}
