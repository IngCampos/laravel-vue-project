<?php

namespace App\Http\Middleware;

use Closure;

class PermissionUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission_id)
    {
        // This middleware checks if the user has te permission
        if ($request->user()->permissions->where('pivot.permission_id', $permission_id) != "[]")
            return $next($request);
        \Log::alert('The user with ID ' . $request->user()->id . ' tried to access to section without permission(' . $permission_id . ').');
        return redirect('/');
    }
}
