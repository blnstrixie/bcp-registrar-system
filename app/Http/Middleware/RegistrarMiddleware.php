<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RegistrarMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
    
            if ($user->role === 'Registrar') {
                return $next($request);
            } else {
                return redirect('/');
            }
        } else {
            return redirect()->route('auth/login');
        }
    }
}

