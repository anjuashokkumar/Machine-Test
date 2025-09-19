<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //if (! $request->user() || $request->user()->role !== 'admin') {
        //    return response()->json(['error' => 'Unauthorized (Admin only)'], 403);
        //}

        //return $next($request);


        try {
            // Get user from JWT token
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized: Token invalid or missing'], 401);
        }

        // Check role
        if ($user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized: Admins only'], 403);
        }

        return $next($request);

   
    }
}
