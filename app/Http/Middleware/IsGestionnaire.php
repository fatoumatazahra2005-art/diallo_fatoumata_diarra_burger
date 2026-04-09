<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsGestionnaire
{
    public function handle(Request $request, Closure $next): Response
    {

        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('message', 'Connectez-vous pour accéder au dashboard.');
        }

        if (!auth()->user()->isGestionnaire()) {
            abort(403, 'Accès réservé au gestionnaire.');
        }

        return $next($request);
    }
}
