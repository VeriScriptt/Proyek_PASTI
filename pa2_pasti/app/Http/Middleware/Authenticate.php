<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->cookie('token') && !$request->is('login') && !$request->is('register') && !$request->is('register/*')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}