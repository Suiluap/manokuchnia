<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ... $roles)
    {
        if (!Auth::check()){
            return redirect()->route('login');
        }

        if (!in_array(Auth::user()->role->name, $roles)) {
            return redirect()->route('index');
        }

        return $next($request);
    }
}
