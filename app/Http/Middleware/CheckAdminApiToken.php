<?php

namespace App\Http\Middleware;

use Closure;

use App\User;

class CheckAdminApiToken
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
        if(!User::where('api_token', $request->api_token)->exists()){
            abort(403);
        }
       
        return $next($request);
    }
}
