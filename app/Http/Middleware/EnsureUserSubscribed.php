<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->subscribed('Suscripciones blog')) {
            return $next($request);
        }

        return redirect()->route('billings.index')->with('flash', [
            'banner' => 'Necesitas suscribirte para ver este contenido',
        ]);
    }
}
