<?php

namespace App\Http\Middleware;

use App\Role;
use App\User;
use Closure;
use Auth;
use Illuminate\Support\Facades\Gate;
class AuthGatesAPI
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
        $user =  User::where('api_token', $request->api_token)->first();

        if(!app()->runningInConsole() && $user){
            $roles = Role::with('permissions')->get();
            foreach($roles as $role){
                foreach($role->permissions as $permissions){
                    $permissionArray[$permissions->title][] = $role->id;
                }
            }

            foreach($permissionArray as $title => $roles){
                Gate::define($title, function(\App\User $user) use ($roles){
                    return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
                });
            }
        }
        return $next($request);
    }
}