<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
     
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  ...$role // ein oder mehrerre Rollen
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        if (! $request->user()->authorizeRoles($role))
        {
            return redirect('home');
        }

        return $next($request);
    }

}
