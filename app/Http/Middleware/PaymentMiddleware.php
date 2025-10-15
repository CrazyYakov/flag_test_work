<?php

namespace App\Http\Middleware;

use App\Services\Payments\TokenService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PaymentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            TokenService::decodeToken($request->get('token'));
        } catch (Throwable) {
            abort(403);
        }

        return $next($request);
    }
}
