<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;


// Login
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (! $token = JWTAuth::attempt($credentials)) {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
    return response()->json(['token' => $token]);
});



Route::get('/ping', function () {
    return response()->json(['message' => 'API is working!']);
});
