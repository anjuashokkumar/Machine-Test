<?php

namespace ContactForm\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminWebMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = session('admin_token');

        if (!$token) {
            return redirect('/admin/login');
        }

        try {
            $user = JWTAuth::setToken($token)->authenticate();
        } catch (\Exception $e) {
            return redirect('/admin/login');
        }

        if ($user->role !== 'admin') {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
