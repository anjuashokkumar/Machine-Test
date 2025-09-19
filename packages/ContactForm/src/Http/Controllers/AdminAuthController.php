<?php

namespace ContactForm\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AdminAuthController
{
    public function showLogin()
    {
        return view('contactform::admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        
        if (! $token = Auth::guard('api')->attempt($credentials)) {
            return back()->withErrors(['email' => 'Invalid credentials.']);
        }

        session()->put('admin_token', $token);
        session()->save();                 

        return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully!');
    }

    public function logout(Request $request)
    {
        $token = session('admin_token');

        if ($token) {
            try {
                JWTAuth::setToken($token)->invalidate();
            } catch (\Exception $e) {

            }
        }

        session()->forget('admin_token');

        return redirect('/admin/login');
    }
}
