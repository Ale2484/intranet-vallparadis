<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMagnamentOrAdministration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && ($request->user()->role == "equip_directiu" || $request->user()->role == "administracio")) {
            return $next($request);
        } else {
            return back()->with("error", "No tens permisos per accedir a aquest apartat");
        }
    }
}
