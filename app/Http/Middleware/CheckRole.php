<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check() || auth()->user()->role !== $role) {
          return redirect(route('login', absolute: false))
            ->with('error', 'No tienes permiso para acceder a esta página.');
        }
        return $next($request);
    }
}