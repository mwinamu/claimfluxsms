<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Role;


class UserMiddleware
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
        if( $request->user()->hasRole('administrator')){

            return redirect( 'admin/dashboard' );

        }
        return $next($request);
    }
}
