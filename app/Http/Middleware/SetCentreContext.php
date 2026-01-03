<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetCentreContext
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if ($user) {
            if ($user->role == "super_admin") {
                if (!Session::has("active_center_id")) {
                    Session::put("active_center_id", $user->center);
                }
            } else {
                Session::put("active_center_id", $user->center);
            }
        }
        return $next($request);
    }
}
